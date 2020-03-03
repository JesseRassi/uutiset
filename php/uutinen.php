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

<div class="jumbotron d-flex align-items-center">
    <div class="container-fluid col-md-offset-3">
        <h1><?php echo $xml->otsikko;?></h1>   
        <figure class="figure">
            <img id="img" src="../<?php echo $xml->kuvapolku;?>" height="300px" width="450px">
            <figcaption class="figure-caption" id="demo1"></figcaption>
        </figure>
        <p><?php echo $xml->kirjoittaja;?></p>
        <p><?php echo nl2br($xml->artikkeli);?></p>
        <p><?php echo $xml->kuvateksti;?></p>
    </div>
</div>

<!--     
    <script>
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myFunction(this);                

            }
        };
        xhttp.open("GET", "1.xml", true);
        xhttp.send();

        function myFunction(xml) {
            var xmlDoc = xml.responseXML;

            document.getElementById("demo").innerHTML =
            xmlDoc.getElementsByTagName("otsikko")[0].childNodes[0].nodeValue;

            document.getElementById("demo1").innerHTML =
            xmlDoc.getElementsByTagName("kirjoittaja")[0].childNodes[0].nodeValue;
                                 
            img.src = xmlDoc.getElementsByTagName("Kuva")[0].childNodes[0].nodeValue;
            
            document.getElementById("demo2").innerHTML =
            xmlDoc.getElementsByTagName("artikkeli")[0].childNodes[0].nodeValue;


            document.getElementById("demo4").innerHTML =
            xmlDoc.getElementsByTagName("kuvapolku")[0].childNodes[0].nodeValue;
            
        }        
        </script>
     -->

    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
