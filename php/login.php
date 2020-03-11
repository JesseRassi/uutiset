<?php
session_start();
require '../db_config.php';
if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
        // Getting submitted user data from database
        $stmt = $yhteys->prepare("SELECT * FROM yllapito WHERE kayttaja = ?");
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();
        echo var_dump($user);
    	// Verify user password and set $_SESSION
    	if ( password_verify($_POST['password'], $user->salasana) ) {
    		$_SESSION['user_id'] = $user->id;
    	} else{
            echo "Error";
        }
    }
}
header("Location: ../feed.php")
?>