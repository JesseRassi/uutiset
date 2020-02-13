<?php
$id = 4;
$otsikko = $_POST["otsikko"];
$kirjoittaja = $_POST["kirjoittaja"];
$artikkeli = $_POST["artikkeli"];

// W3Schools
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

// https://programmerblog.net/how-to-generate-xml-files-using-php/
$xml = new DOMDocument("1.0", "utf-8");
$xml_otsikko = $xml->createElement("Otsikko", $otsikko);
$xml_kirjoittaja = $xml->createElement("Kirjoittaja", $kirjoittaja);
$xml_artikkeli = $xml->createElement("Artikkeli", $artikkeli);
$xml_kuva = $xml->createElement("Kuvapolku", $target_file);
$xml->appendChild($xml_otsikko);
$xml->appendChild($xml_kirjoittaja);
$xml->appendChild($xml_artikkeli);
$xml->appendChild($xml_kuva);
$xml->save("../xml/{$id}.xml");


?>