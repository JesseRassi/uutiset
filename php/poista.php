<?php
include ("header");
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobbaripojat";

// Create connection
$yhteys = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($yhteys->connect_error) {
    die("Connection failed: " . $yhtyes->connect_error);
} 

// sql to delete a record
$id = $_POST['id'];
            
            $sql = "DELETE FROM uutiset WHERE id = $id" ;
            mysql_select_db('test_db');
            $retval = mysql_query( $sql, $yhtyes );
            
            if(! $retval ) {
               die('Could not delete data: ' . mysql_error());
            }

$yhteys->close();
?>