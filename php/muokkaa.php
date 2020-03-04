<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobbaripojat";
$yhteys = new mysqli($servername, $username, $password, $dbname);

$id = $_GET['uid'];

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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tyyli.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col mx-auto"></div>
            <div class="col-lg-3" style="min-width: 600px">
                <h1>Lisää artikkeli</h1>
                <div class="form-group">
                    <form action="lisaa.php?e=1" method="POST" enctype="multipart/form-data">
                        <input type="number" name="id" value="<?php echo $xml->id;?>" readonly style="display: none">

                        <label for="otsikko">Otsikko</label>
                        <input class="form-control" id="otsikko" value="<?php echo $xml->otsikko;?>" type="text" name="otsikko">

                        <label for="kirjoittaja">Kirjoittaja</label>
                        <input class="form-control" id="kirjoittaja" value="<?php echo $xml->kirjoittaja;?>" type="text" name="kirjoittaja">

                        <label for="artikkeli">Artikkeli</label>
                        <textarea class="form-control" id="artikkeli" type="text" name="artikkeli" rows="7"><?php echo $xml->artikkeli;?></textarea>

                        <label for="aiheet">Valitse aiheet</label>
                        <div class="form-group ml-5" id="aiheet">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo ($check_uutiset) ? "checked" : false;?> id="uutiset" name="uutiset">
                                <label class="form-check-label" for="uutiset">Uutiset</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo ($check_kotimaa) ? "checked" : false;?> id="kotimaa" name="kotimaa">
                                <label class="form-check-label" for="kotimaa">Kotimaa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo ($check_ulkomaat) ? "checked" : false;?> id="ulkomaat" name="ulkomaat">
                                <label class="form-check-label" for="ulkomaat">Ulkomaat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo ($check_politiikka) ? "checked" : false;?> id="politiikka" name="politiikka">
                                <label class="form-check-label" for="politiikka">Politiikka</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo ($check_talous) ? "checked" : false;?> id="talous" name="talous">
                                <label class="form-check-label" for="talous">Talous</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo ($check_urheilu) ? "checked" : false;?> id="urheilu" name="urheilu">
                                <label class="form-check-label" for="urheilu">Urheilu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo ($check_viihde) ? "checked" : false;?> id="viihde" name="viihde">
                                <label class="form-check-label" for="viihde">Viihde</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?php echo ($check_terveys) ? "checked" : false;?> id="terveys" name="terveys">
                                <label class="form-check-label" for="terveys">Terveys</label>
                            </div>
                        </div>

                        <label for="avainsanat">Avainsanat (5)</label>
                        <input class="form-control" id="avainsanat" value="<?php echo $avainsanat;?>" type="text" name="avainsanat">

                        <label for="kuvateksti">Kuvateksti</label>
                        <input class="form-control" id="kuvateksti" value="<?php echo $xml->kuvateksti;?>" type="text" name="kuvateksti">

                        <div class="custom-file mt-3" id="liskuva">
                            <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
                            <label class="custom-file-label" for="fileToUpload">Valitse kuva</label>
                        </div>

                        <input type="text" name="kuvapolku" value="<?php echo $xml->kuvapolku;?>" readonly style="display: none">
                        <button type="submit" class="btn btn-primary mt-4">Lähetä</button>
                    </form>
                </div>

            </div>
            <div class="col mx-auto"></div>
        </div>
    </div>

    <script src="../js/jquery-3.4.1.slim.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>