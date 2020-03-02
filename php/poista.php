
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
$id = 7;
$sql = "DELETE FROM uutiset WHERE id = ?" ;
            
$stmt = mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);
?>