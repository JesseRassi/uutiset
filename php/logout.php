<?php
session_start();
if (!isset( $_SESSION['user_id']) ) {
    header("Location: yllapito.php");
} else {
    unset($_SESSION["user_id"]);
    header("Location: ../feed.php");
}
?>