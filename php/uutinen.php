<?php
$id = $_GET["id"];
$file = "../xml/{$id}.xml";
$xml = simplexml_load_file($file);
?>
<html>   

<head>
<link rel="stylesheet" href="../css/bootstrap.min.css">

<style>

.jumbotron{
    padding-top: 0%;
    padding-bottom: 0%;
    margin: 0%;
}
.container-fluid{
 text-align: center;
 
 
 background-color: lightblue; 
}
.figure-caption{
    text-align: left;
}
p{
    padding-left: 20%;
    padding-right: 20%;
}

</style>


</head>

<body>

<div class="container-fluid h-100">

<div class="row h-100">

    <div class="col mx-auto">
        <!-- A vertical navbar -->
        <nav class="navbar bg-light float-right">

            <!-- Links -->
            <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../feed.php">Koti</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../feed.php#kotimaa">Kotimaa</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../feed.php#ulkomaat">Ulkomaat</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../feed.php#politiikka">Politiikka</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../feed.php#talous">Talous</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../feed.php#urheilu">Urheilu</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../feed.php#viihde">Viihde</a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../feed.php#terveys">Terveys</a>
                            
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

    <div class="jumbotron d-flex align-items-center">
    <div class="container-fluid col-md-offset-3">
        <h1><?php echo $xml->otsikko;?></h1>   
        <figure class="figure">
            <img id="img" src="../<?php echo $xml->kuvapolku;?>" height="300px" width="450px">
            <figcaption class="figure-caption"><?php echo $xml->kuvateksti;?></figcaption>
        </figure>
        <p><?php echo $xml->kirjoittaja;?></p>
        <p><?php echo nl2br($xml->artikkeli);?></p>
    </div>
</div>

    </div>
    <div class="col mx-auto"></div>
</div>
</div>
</div>
</body>
</html>
