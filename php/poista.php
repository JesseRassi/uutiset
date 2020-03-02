<?php
include ("header");
?>

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
$id = $_POST['id'];
            
            $sql = "DELETE FROM uutiset WHERE id = $id" ;
            mysql_select_db('jobbaripojat');
            $retval = mysql_query( $sql, $yhtyes );
            
            if(! $retval ) {
               die('Could not delete data: ' . mysql_error());
            }

$yhteys->close();
?>