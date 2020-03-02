<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobbaripojat";
$yhteys = new mysqli($servername, $username, $password, $dbname);

$sql_kaikki = "SELECT * FROM uutiset ORDER BY 'pvm' ASC LIMIT 5";
$sql_uutiset = "SELECT * FROM uutiset WHERE uutiset = 1 ORDER BY 'pvm' ASC LIMIT 5";
$sql_kotimaa = "SELECT * FROM uutiset WHERE kotimaa = 1 ORDER BY 'pvm' ASC LIMIT 5";
$sql_ulkomaat = "SELECT * FROM uutiset WHERE ulkomaat = 1 ORDER BY 'pvm' ASC LIMIT 5";
$sql_politiikka = "SELECT * FROM uutiset WHERE politiikka = 1 ORDER BY 'pvm' ASC LIMIT 5";
$sql_talous = "SELECT * FROM uutiset WHERE talous = 1 ORDER BY 'pvm' ASC LIMIT 5";
$sql_urheilu = "SELECT * FROM uutiset WHERE urheilu = 1 ORDER BY 'pvm' ASC LIMIT 5";
$sql_viihde = "SELECT * FROM uutiset WHERE viihde = 1 ORDER BY 'pvm' ASC LIMIT 5";
$sql_terveys = "SELECT * FROM uutiset WHERE terveys = 1 ORDER BY 'pvm' ASC LIMIT 5";



function luo_uutinen($id){
  return $xml;
}
$file = "xml/2.xml";
$xml = simplexml_load_file($file);
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
                            <a class="nav-link" href="#">Koti</a>
                        </li>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aiheet
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Politiikka</a>
                                <a class="dropdown-item" href="#">Urheilu</a>
                                <a class="dropdown-item" href="#">Kotimaa</a>
                                <a class="dropdown-item" href="#">Ulkomaa</a>

                            </div>
                            <div class="row mt-3">

                            </div>

                            <div class="md-form mt-0">

                                <input class="form-control" type="text" placeholder="Haku" aria-label="Haku">

                            </div>

                        </div>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6 bg-primary h-100">

                <div class="media" id="<?php echo $xml->id;?>" onclick="location.href='php/uutinen.php?id=' + this.id">
                    <img class="mr-3" src="uutiset/<?php echo $xml->kuvapolku?>" height="300px" width="450px">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo $xml->otsikko?></h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <div class="row mt-3">

                </div>

                <div class="media">
                    <img class="mr-3" src="https://files.luolasto.org/20585/tiedosto.jpg" height="300px" width="450px">
                    <div class="media-body">
                        <h5 class="mt-0">Uutisotsikko</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

            </div>
            <div class="col mx-auto"></div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
