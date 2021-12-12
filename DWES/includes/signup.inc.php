<?php

if (isset($_POST["submit"])) {

	$uid = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$pwdRepeat = $_POST["pwdRepeat"];
	$email = $_POST["email"];

	include "../classes/dbh.classes.php";
	include "../classes/signup.classes.php";
	include "../classes/signup-contr.classes.php";
	$signup = new SignupContr($uid, $email, $pwd, $pwdRepeat);

	$signup->signupUser();

	header("location: ../login.php");
}