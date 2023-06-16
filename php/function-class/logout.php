<?php

session_start();

if (isset($_SESSION['user_id'])) {
	include_once "connection.php";
	$logout_id = mysqli_real_escape_string($con, $_GET['logout_id']);
	if (isset($logout_id)) {
		session_unset();
		session_destroy();
		header("location: ../onboarding.php");
	} else {
		header("location: ../php/chat.php?bot_id=2");
	}
} else {
	header("location: ../onboarding.php");
}
