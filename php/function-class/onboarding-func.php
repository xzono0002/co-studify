<?php

session_start();

if (isset($_SESSION['user_id'])) {
    include_once "connection.php";
    session_unset();
    session_destroy();
    header("location: ../login.php");
} else {
    header("location: ../login.php");
}
