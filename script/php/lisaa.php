<?php
    $id = 4;

    $otsikko = $_POST["otsikko"];
    $kirjoittaja = $_POST["kirjoittaja"];
    $artikkeli = $_POST["artikkeli"];

    $xml = new DOMDocument("1.0", "utf-8");
    $xml_otsikko = $xml->createElement("Otsikko", $otsikko);
    $xml_kirjoittaja = $xml->createElement("Kirjoittaja", $kirjoittaja);
    $xml_artikkeli = $xml->createElement("Artikkeli", $artikkeli);
    $xml->appendChild($xml_otsikko);
    $xml->appendChild($xml_kirjoittaja);
    $xml->appendChild($xml_artikkeli);
    $xml->save("../xml/{$id}.xml");
?>