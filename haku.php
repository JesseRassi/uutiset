<?php
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
    $sql = "SELECT id, pvm FROM uutiset WHERE '{$hakusana}' IN(avainsana0, avainsana1, avainsana2, avainsana3, avainsana4) ORDER BY pvm DESC";
    $result = $yhteys->query($sql);
    for ($set = array (); $row = $result->fetch_assoc(); $set[] = $row);
    $i = (int)0;
    while ($i < count($set)) {
        $id = $set[$i]["id"];
        echo 
        '<div class="media" id="' . hae_uutinen($id)->id . '" onclick="location.href=' . "'php/uutinen.php?id=" . hae_uutinen($id)->id . "'" . '">
        <img class="mr-3" src="' . hae_uutinen($id)->kuvapolku . '" height="300px" width="450px">
        <div class="media-body">
            <span>Posted at ' . $set[$i]['pvm'] . '</span>
            <h5 class="mt-0">' . hae_uutinen($id)->otsikko . '</h5>
            <p>' . substr(get_words(hae_uutinen($id)->artikkeli), 0, -2) . '..</p>
            
        </div>
        </div>
        <div class="row mt-3">
        </div>'
        ;
        $i++;
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Uutiset</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tyyli.css">
</head>

<body style="height:100vh">

    <div class="container-fluid h-100">

        <div class="row h-100">

            <div class="col mx-auto">
                <!-- A vertical navbar -->
                <nav class="navbar bg-light float-right">

                    <!-- Links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="feed.php">Koti</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feed.php#kotimaa">Kotimaa</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feed.php#ulkomaat">Ulkomaat</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feed.php#politiikka">Politiikka</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feed.php#talous">Talous</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feed.php#urheilu">Urheilu</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feed.php#viihde">Viihde</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feed.php#terveys">Terveys</a>
                            
                        </li>


                        

                        <div class="md-form mt-0">
                            <form action="haku.php" method="POST">
                            <input type="text" name="hakusana">
                            <input type="submit" value="Haku">
                            </form>         
                        </div>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6 h-100">

            <?php
            uutiset($yhteys, $hakusana);
            ?>

                <!-- <div class="media" id="<?php //echo hae_uutinen(2)->id;?>" onclick="location.href='php/uutinen.php?id=' + this.id">
                    <img class="mr-3" src="<?php //echo hae_uutinen(2)->kuvapolku?>" height="300px" width="450px">
                    <div class="media-body">
                        <h5 class="mt-0"><?php //echo hae_uutinen(2)->otsikko?></h5>
                        <p><?php //echo get_words(hae_uutinen(2)->artikkeli);?></p>
                    </div>
                </div>

                <div class="row mt-3">

                </div>

                <div class="media">
                    <img class="mr-3" src="https://files.luolasto.org/20585/tiedosto.jpg" height="300px" width="450px">
                    <div class="media-body">
                        <h5 class="mt-0">Uutisotsikko</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div> -->

            </div>
            <div class="col mx-auto"></div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>