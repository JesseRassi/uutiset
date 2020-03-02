<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobbaripojat";
$yhteys = new mysqli($servername, $username, $password, $dbname);

$id = 2;

$sql = "SELECT * FROM uutiset WHERE id = ?";
$stmt = mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_object(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

$avainsanat = $row->avainsana0 . " " . $row->avainsana1 . " " . $row->avainsana2 . " " . $row->avainsana3 . " " . $row->avainsana4;
$check_uutiset = $row->uutiset;
$check_kotimaa = $row->kotimaa;
$check_ulkomaat = $row->ulkomaat;
$check_politiikka = $row->politiikka;
$check_talous = $row->talous;
$check_urheilu = $row->urheilu;
$check_viihde = $row->viihde;
$check_terveys = $row->terveys;

$file = "../xml/{$id}.xml";
$xml = simplexml_load_file($file);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Muokkaa Artikkelia</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tyyli.css">
</head>

<body style="height:100vh">

    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col mx-auto"></div>
            <div class="col-md-6 bg-primary h-100">
                <form action="lisaa.php?e=1" method="POST" enctype="multipart/form-data">
                    <input type="number" name="id" value="<?php echo $xml->id;?>" readonly style="display: none">
                    <br>Otsikko:<br>
                    <input type="text" name="otsikko" value="<?php echo $xml->otsikko;?>">
                    <br>Kirjoittaja:<br>
                    <input type="text" name="kirjoittaja" value="<?php echo $xml->kirjoittaja;?>">
                    <br>Artikkeli:<br>
                    <textarea name="artikkeli"><?php echo $xml->artikkeli;?></textarea>
                    <br>Valitse aiheet:<br>
                    <ul>
                        <li><input type="checkbox" name="uutiset" <?php echo ($check_uutiset) ? "checked" : false;?>> Uutiset</li>
                        <li><input type="checkbox" name="kotimaa" <?php echo ($check_kotimaa) ? "checked" : false;?>> Kotimaa</li>
                        <li><input type="checkbox" name="ulkomaat" <?php echo ($check_ulkomaat) ? "checked" : false;?>> Ulkomaat</li>
                        <li><input type="checkbox" name="politiikka" <?php echo ($check_politiikka) ? "checked" : false;?>> Politiikka</li>
                        <li><input type="checkbox" name="talous" <?php echo ($check_talous) ? "checked" : false;?>> Talous</li>
                        <li><input type="checkbox" name="urheilu" <?php echo ($check_urheilu) ? "checked" : false;?>> Urheilu</li>
                        <li><input type="checkbox" name="viihde" <?php echo ($check_viihde) ? "checked" : false;?>> Viihde</li>
                        <li><input type="checkbox" name="terveys" <?php echo ($check_terveys) ? "checked" : false;?>> Terveys</li>
                    </ul>
                    Avainsanat (5):<br>
                    <input type="text" name="avainsanat" value="<?php echo $avainsanat;?>">
                    <br>Kuvateksti:<br>
                    <input type="text" name="kuvateksti" value="<?php echo $xml->kuvateksti;?>">
                    <input type="text" name="kuvapolku" value="<?php echo $xml->kuvapolku;?>" readonly style="display: none">
                    <br><br>
                    <input type="submit" name="laheta" value="Lähetä">
                </form>
            </div>
            <div class="col mx-auto"></div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>