<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobbaripojat";
$yhteys = new mysqli($servername, $username, $password, $dbname);

$id = haeID($yhteys) + 1;
$otsikko = $_POST["otsikko"];
$kirjoittaja = $_POST["kirjoittaja"];
$artikkeli = $_POST["artikkeli"];
$avainsanat = $_POST["avainsanat"];
$kuvateksti = $_POST["kuvateksti"];
$pvm = date("Y-m-d H:i:s");
$check_uutiset = (int)isset($_POST["uutiset"]);
$check_kotimaa = (int)isset($_POST["kotimaa"]);
$check_ulkomaat = (int)isset($_POST["ulkomaat"]);
$check_politiikka = (int)isset($_POST["politiikka"]);
$check_talous = (int)isset($_POST["talous"]);
$check_urheilu = (int)isset($_POST["urheilu"]);
$check_viihde = (int)isset($_POST["viihde"]);
$check_terveys = (int)isset($_POST["terveys"]);

$sql = "INSERT INTO uutiset (id, xml, pvm, avainsana0, avainsana1, avainsana2, avainsana3, avainsana4, uutiset, kotimaa, ulkomaat, politiikka, talous, urheilu, viihde, terveys) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "iissssssiiiiiiii", $id, $id, $pvm, $avainsanat, $avainsanat, $avainsanat, $avainsanat, $avainsanat, $check_uutiset, $check_kotimaa, $check_ulkomaat, $check_politiikka, $check_talous, $check_urheilu, $check_viihde, $check_terveys);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);
#region // W3Schools
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

$uutinen = new DOMDocument("1.0", "utf-8");
$uutinen->formatOutput = true;
$uutinen_otsikko = $uutinen->createElement("Otsikko", $otsikko);
$uutinen_kirjoittaja = $uutinen->createElement("Kirjoittaja", $kirjoittaja);
$uutinen_artikkeli = $uutinen->createElement("Artikkeli", $artikkeli);
$uutinen_kuva = $uutinen->createElement("Kuvapolku", $target_file);
$uutinen_kuvateksti = $uutinen->createElement("Kuvateksti", $kuvateksti);
$uutinen->appendChild($uutinen_otsikko);
$uutinen->appendChild($uutinen_kirjoittaja);
$uutinen->appendChild($uutinen_artikkeli);
$uutinen->appendChild($uutinen_kuva);
$uutinen->appendChild($uutinen_kuvateksti);
$uutinen->save("../xml/{$id}.xml");

/* 
$sql = "INSERT INTO uutiset (id, 'xml', pvm, aiheet, avainsana0, avainsana1, avainsana2, avainsana3, avainsana4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'iidsssss', );
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);

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
function get_words($sentence, $count = 15) {
    preg_match("/(?:[^\s,\.;\?\!]+(?:[\s,\.;\?\!]+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}

function haeID($yhteys){
    $sql = "SELECT MAX(id) FROM uutiset LIMIT 1";
    $stmt = mysqli_prepare($yhteys, $sql);
    mysqli_stmt_execute($stmt);
    $id = mysqli_fetch_object(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return reset($id);
}
?>