<?php

    $dbhost = "localhost:3306";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "kaagapai";

    if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("Failed to connect: " . mysqli_connect_error());
    }

?>