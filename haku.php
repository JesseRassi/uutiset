<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobbaripojat";
$yhteys = new mysqli($servername, $username, $password, $dbname);

$hakusana = $_POST["hakusana"];

function hae_uutinen($id){
    $file = "xml/{$id}.xml";
    $xml = simplexml_load_file($file);
    return $xml;
}
function get_words($sentence, $count = 15) {
    preg_match("/(?:[^\s,\.;\?\!]+(?:[\s,\.;\?\!]+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}

function uutiset($yhteys, $hakusana){
    // ei turvallinen, sql-injektio riski
    $sql = "SELECT id, pvm FROM uutiset WHERE '{$hakusana}' IN(avainsana0, avainsana1, avainsana2, avainsana3, avainsana4) ORDER BY pvm DESC";
    $result = $yhteys->query($sql);
    if($result->num_rows == 0){
        echo '<h3>Ei hakutuloksia</h3>';
    }
    for ($set = array (); $row = $result->fetch_assoc(); $set[] = $row);
    $i = (int)0;
    while ($i < count($set)) {
        $id = $set[$i]["id"];
        echo 
        '<div class="card mb-3" onclick="location.href=' . "'php/uutinen.php?id=" . hae_uutinen($id)->id . "'" . '">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="' . substr(hae_uutinen($id)->kuvapolku, 3) . '" class="card-img" alt="' . hae_uutinen($id)->otsikko . '">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">' . hae_uutinen($id)->otsikko . '</h5>
                        <p class="card-text">' . substr(get_words(hae_uutinen($id)->artikkeli), 0, -2) . '..</p>
                        <p class="card-text"><small class="text-muted">' . date("M jS, Y", strtotime($set[$i]['pvm'])) . '</small></p>
                    </div>
                </div>
            </div>
        </div>';
        $i++;
    }
}
?>
<html lang="en" style="overflow-y: scroll;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hakutulokset</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tyyli.css">
</head>

<body>

<div class="container-fluid">

<div class="row">

    <div class="col mx-auto">

        <nav class="navbar float-right sticky-top">

            <ul class="navbar-nav">

                <li class="nav-item mb-2">
                    <a href="feed.php"><img class="mx-auto d-block" src="iltajobbari.png"/></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="feed.php#kotimaa">Kotimaa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="feed.php#ulkomaat">Ulkomaat</a>                            
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="feed.php#politiikka">Politiikka</a>                            
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="feed.php#talous">Talous</a>                            
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="feed.php#urheilu">Urheilu</a>                            
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="feed.php#viihde">Viihde</a>                            
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link mt-1 btn btn-outline-danger" href="feed.php#terveys">Terveys</a>                            
                </li>                  

                <div class="lg-form mt-0">
                    <form class="form-inline" action="haku.php" method="POST">
                        <input class="form-control" type="text" name="hakusana">
                        <input class="btn btn-secondary ml-sm-2" type="submit" value="Haku">
                    </form>         
                </div>
                <?php 
                    if ( isset( $_SESSION['user_id'] ) ) {
                        echo '<a class="btn btn-secondary btn-sm mb-2" href="uusi.php">Lisää artikkeli</a>';
                        echo '<a class="btn btn-secondary btn-sm mb-2" href="php/lisaa_kayttaja.php">Lisää käyttäjä</a>';
                        echo '<a class="btn btn-secondary btn-sm" href="php/logout.php">Kirjaudu ulos</a>';
                    } else {
                        echo '<a class="btn btn-secondary btn-sm" href="php/yllapito.php">Kirjaudu sisään</a>';
                    }
                ?>
            </ul>

        </nav>

    </div>

    <div class="col-lg-6">
        <div class="container-fluid row">
            <div class="col mx-auto"></div>
            <div class="col-lg-10 bg-light min-vh-100"> 
                <h1 class="mt-5 mb-3 display-4">Hakutulokset: <?php echo $hakusana;?></h1>
                <?php uutiset($yhteys, $hakusana);?>
            </div>
            <div class="col mx-auto"></div>
        </div>
    </div>

    <div class="col mx-auto"></div>

</div>

</div>

<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>