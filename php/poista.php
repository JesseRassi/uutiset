<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobbaripojat";

// tarkista yhteys
$yhteys = new mysqli($servername, $username, $password, $dbname);
// tarkista yhteys
if ($yhteys->connect_error) {
    die("Connection failed: " . $yhtyes->connect_error);
} 

// sql tiedoston poisto
$id = $_GET['uid'];
$sql = "DELETE FROM uutiset WHERE id = ?" ;
            
$stmt = mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);
// xml tiedoston poisto   
$file_pointer = "../xml/{$id}.xml";
$kuva = simplexml_load_file($file_pointer)->kuvapolku;
if (!unlink($file_pointer)) {  
    echo ("$file_pointer error");  
}  
else {  
    echo ("$file_pointer on poistettu");  
}  
if (!unlink($kuva)) {  
    echo ("$kuva error");  
}  
else {  
    echo ("$kuva on poistettu");  
}  
  
header("Location: ../feed.php");
?> 