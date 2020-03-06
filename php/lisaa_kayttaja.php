<?php
session_start();
if ($_SESSION['user_id'] != 5 ) {
    require '../db_config.php';
    $yhteys = new mysqli($servername, $username, $password, $dbname);
    if ( ! empty( $_POST ) ) {
        if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
            $tunnus = $_POST['username'];
            $psw = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO yllapito (kayttaja, salasana) VALUES (?, ?)";
            $stmt = mysqli_prepare($yhteys, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $tunnus, $psw);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($yhteys);
        }
    }
    header("Location: logout.php");
} else {
    header("Location: yllapito.php");
}
?>