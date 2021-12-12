<?php

class SignupContr extends Signup {

	private $uid;
	private $pwd;
	private $pwdRepeat;
	private $email;

	public function __construct($uid,$email,$pwd,$pwdRepeat) {

		$this->uid = $uid;
		$this->email = $email;
		$this->pwd = $pwd;
		$this->pwdRepeat = $pwdRepeat;
	}

	public function signupUser() {


		if ($this->emptyInput() == false) {
			header("location: ../signup.php?error=emptyInput");
			exit();
		}

		if ($this->invalidUid() == false) {
			header("location: ../signup.php?error=invalidUid");
			exit();
		}

		if ($this->invalidMail() == false) {
			header("location: ../signup.php?error=invalidMail");
			exit();
		}

		if ($this->pwdMatch() == false) {
			header("location: ../signup.php?error=pwdMatch");
			exit();
		}

		if ($this->usersMatch() == false) {
		 	header("location: ../signup.php?error=usersMatch");
			exit();
		}

		$this->setUser($this->uid, $this->pwd, $this->email);
		
	}

	private function emptyInput() {
		$result;
		if (empty($this->uid) || empty($this->email) || empty($this->pwd) || empty($this->pwdRepeat)) {
			$result = false;
		}

		else {
			$result = true;
		}
		return $result;
	}

	private function invalidUid() {
		$result;
		if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
			$result = false;
		}

		else {
			$result = true;
		}
		return $result;
	}

	private function invalidMail() {
		$result;
		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$result = false;
		}

		else {
			$result = true;
		}
		return $result;
	}

	private function pwdMatch() {
		$result;
		if ($this->pwd !== $this->pwdRepeat) {
			$result = false;
		}

		else {
			$result = true;
		}
		return $result;
	}

	private function usersMatch() {

		$result;
		if (!$this->checkUser($this->uid, $this->email)) {
			$result = false;
		}

		else {
			$result = true;
		}

		return $result;
	}

}