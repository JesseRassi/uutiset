<?php
session_start();
if (isset( $_SESSION['user_id']) ) {
    unset($_SESSION["user_id"]);
    header("Location: ../feed.php");
} else {
    header("Location: ../feed.php");
}
?>