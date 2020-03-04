<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobbaripojat";
$yhteys = new mysqli($servername, $username, $password, $dbname);

$muokkaus = (bool)$_GET["e"];
echo var_dump($muokkaus);
$otsikko = $_POST["otsikko"];
$kirjoittaja = $_POST["kirjoittaja"];
$artikkeli = $_POST["artikkeli"];
$avainsanat = str_word_count((string)$_POST["avainsanat"], 1);
$kuvateksti = $_POST["kuvateksti"];
$kuvapolku = $_POST["kuvapolku"];
$pvm = date("Y-m-d H:i:s");

if (!$muokkaus){
    $id = hae_id($yhteys) + 1;
} else {
    $id = $_POST["id"];
}

if (!$muokkaus) {
    #region // W3Schools image upload
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg") {
        echo "Sorry, only JPG files are allowed.<br>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    #endregion
} else {
    $kuvapolku = $_POST["kuvapolku"];
}

$check_uutiset = (int)isset($_POST["uutiset"]);
$check_kotimaa = (int)isset($_POST["kotimaa"]);
$check_ulkomaat = (int)isset($_POST["ulkomaat"]);
$check_politiikka = (int)isset($_POST["politiikka"]);
$check_talous = (int)isset($_POST["talous"]);
$check_urheilu = (int)isset($_POST["urheilu"]);
$check_viihde = (int)isset($_POST["viihde"]);
$check_terveys = (int)isset($_POST["terveys"]);

$as0 = $avainsanat[0];
$as1 = $avainsanat[1];
$as2 = $avainsanat[2];
$as3 = $avainsanat[3];
$as4 = $avainsanat[4];

if(!$muokkaus){
    $sql = "INSERT INTO uutiset (pvm, avainsana0, avainsana1, avainsana2, avainsana3, avainsana4, uutiset, kotimaa, ulkomaat, politiikka, talous, urheilu, viihde, terveys, id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
} else {
    $sql = "UPDATE uutiset SET pvm = ?, avainsana0 = ?, avainsana1 = ?, avainsana2 = ?, avainsana3 = ?, avainsana4 = ?, uutiset = ?, kotimaa = ?, ulkomaat = ?, politiikka = ?, talous = ?, urheilu = ?, viihde = ?, terveys = ? WHERE id = ?";
}
$stmt = mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ssssssiiiiiiiii", $pvm, $as0, $as1, $as2, $as3, $as4, $check_uutiset, $check_kotimaa, $check_ulkomaat, $check_politiikka, $check_talous, $check_urheilu, $check_viihde, $check_terveys, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);

$uutinen = new DOMDocument("1.0", "utf-8");
$uutinen->formatOutput = true;
// luodaan xml elementit
$uutinen_wrap = $uutinen->createElement("uutinen");
$uutinen_id = $uutinen->createElement("id", $id);
$uutinen_otsikko = $uutinen->createElement("otsikko", $otsikko);
$uutinen_kirjoittaja = $uutinen->createElement("kirjoittaja", $kirjoittaja);
$uutinen_artikkeli = $uutinen->createElement("artikkeli", $artikkeli);
$uutinen_kuvateksti = $uutinen->createElement("kuvateksti", $kuvateksti);
// jos muokataan artikkelia, ei päivitetä kuvapolkua
if(!$muokkaus){
    $uutinen_kuva = $uutinen->createElement("kuvapolku", $target_file);
} else {
    $uutinen_kuva = $uutinen->createElement("kuvapolku", $kuvapolku);
}
// siirretään xml elementit uutinen -wrapperin sisään
$uutinen_wrap->appendChild($uutinen_id);
$uutinen_wrap->appendChild($uutinen_otsikko);
$uutinen_wrap->appendChild($uutinen_kirjoittaja);
$uutinen_wrap->appendChild($uutinen_artikkeli);
$uutinen_wrap->appendChild($uutinen_kuvateksti);
$uutinen_wrap->appendChild($uutinen_kuva);
$uutinen->appendChild($uutinen_wrap);
$uutinen->save("../xml/{$id}.xml");

header("Location: ../feed.php");
/*
$uutisfeed = new DOMDocument("1.0", "utf-8");
$uutisfeed->load("../xml/uutisfeed.xml");
$uutiset = $uutisfeed->getElementsByTagName("Uutiset")->item(0);
$feed_single = $uutisfeed->createElement("Uutinen");
$single_id = $uutisfeed->createElement("ID", $id);
$single_otsikko = $uutisfeed->createElement("Otsikko", $otsikko);
$single_kirjoittaja = $uutisfeed->createElement("Kirjoittaja", $kirjoittaja);
$single_artikkeli = $uutisfeed->createElement("Ingressi", (substr(get_words($artikkeli), 0, -3) . '...'));
$single_kuva = $uutisfeed->createElement("Kuvapolku", $target_file);
$uutisfeed->appendChild($feed_single);
$feed_single->appendChild($single_id);
$feed_single->appendChild($single_otsikko);
$feed_single->appendChild($single_kirjoittaja);
$feed_single->appendChild($single_artikkeli);
$feed_single->appendChild($single_kuva);
$uutiset->appendChild($feed_single);
$uutisfeed->formatOutput = true;
$uutisfeed->save("../xml/uutisfeed.xml");
*/

// https://stackoverflow.com/questions/5956610/how-to-select-first-10-words-of-a-sentence
function get_words($sentence, $count) {
    preg_match("/(?:[^\s,\.;\?\!]+(?:[\s,\.;\?\!]+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}

function hae_id($yhteys){
    $sql = "SELECT MAX(id) FROM uutiset LIMIT 1";
    $stmt = mysqli_prepare($yhteys, $sql);
    mysqli_stmt_execute($stmt);
    $id = mysqli_fetch_object(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return reset($id);
}
?>