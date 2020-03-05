<?php
session_start();

$id = $_GET["id"];
$file = "../xml/{$id}.xml";
$xml = simplexml_load_file($file);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobbaripojat";
$yhteys = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT pvm FROM uutiset WHERE id = {$id} LIMIT 1";
$result = $yhteys->query($sql);
$row = mysqli_fetch_assoc($result);

?>
<html lang="en" style="overflow-y: scroll;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $xml->otsikko;?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tyyli.css">
</head>

<body>

<div class="container-fluid">

<div class="row">

    <div class="col mx-auto">

        <nav class="navbar float-right sticky-top">

            <ul class="navbar-nav">

                <li class="nav-item mb-2">
                    <a href="../feed.php"><img class="mx-auto d-block" src="../iltajobbari.png"/></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="../feed.php#kotimaa">Kotimaa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="../feed.php#ulkomaat">Ulkomaat</a>                            
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="../feed.php#politiikka">Politiikka</a>                            
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="../feed.php#talous">Talous</a>                            
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="../feed.php#urheilu">Urheilu</a>                            
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="../feed.php#viihde">Viihde</a>                            
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="../feed.php#terveys">Terveys</a>                            
                </li>                  

                <div class="md-form mt-0">
                    <form class="form-inline" action="../haku.php" method="POST">
                        <input class="form-control" type="text" name="hakusana">
                        <input class="btn btn-secondary ml-sm-2" type="submit" value="Haku">
                    </form>         
                </div>
                <?php 
                    if ( isset( $_SESSION['user_id'] ) ) {
                        echo '<a class="btn btn-secondary btn-sm mb-2" href="../uusi.php">Lisää artikkeli</a>';
                        if ($_SESSION['user_id'] == 5){
                            echo '<a class="btn btn-secondary btn-sm mb-2" href="lisaa_kayttaja.php">Lisää käyttäjä</a>';
                        }
                        echo '<a class="btn btn-secondary btn-sm" href="logout.php">Kirjaudu ulos</a>';
                    } else {
                        echo '<a class="btn btn-secondary btn-sm" href="yllapito.php">Kirjaudu sisään</a>';
                    }
                ?>
            </ul>

        </nav>

    </div>

    <div class="col-lg-6">
        <div class="container-fluid row">
            <div class="col mx-auto"></div>
            <div class="col-lg-10 bg-light min-vh-100"> 
                <h1 class="mt-5"><?php echo $xml->otsikko;?></h1><br>
                <span>Kirjoittanut: <?php echo $xml->kirjoittaja;?></span><span style="float: right;">
                <?php
                echo "Lisätty: " . date("M jS, Y", strtotime($row['pvm']));
                    if ( isset( $_SESSION['user_id'] ) ) {
                        echo
                            '<button class="btn btn-secondary btn-sm ml-5" type="button" onclick="location.href=' . "'../php/poista.php?uid=" . $id . "'" . '">Poista</button>
                            <button class="btn btn-secondary btn-sm" type="button" onclick="location.href=' . "'../php/muokkaa.php?uid=" . $id . "'" . '">Muokkaa</button>';
                    }?></span>
                <br>
                <br>
                <figure class="figure w-100">
                    <img id="img" src="<?php echo $xml->kuvapolku;?>" width="100%">
                    <figcaption class="figure-caption"><?php echo $xml->kuvateksti;?></figcaption>
                </figure>
                <p><?php echo nl2br($xml->artikkeli);?></p>
            </div>
            <div class="col mx-auto"></div>
        </div>
    </div>

    <div class="col mx-auto"></div>

</div>

</div>

<script src="../js/jquery-3.4.1.slim.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>
