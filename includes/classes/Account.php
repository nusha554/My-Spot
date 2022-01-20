<?php 

class Account {

	private $errorArray;
	private $con;

	public function __construct($con) {
		$this->errorArray = array();
		$this->con = $con;
	}

	public function login($un, $pw1) {
		$pw1 = md5($pw1);

		// check if the username exists 
		$query = mysqli_query($this->con, "SELECT * FROM  myspot_users WHERE username='$un'
			AND user_password='$pw1'");

		// The user was found in DB successfully
		if (mysqli_num_rows($query) == 1)
			return true;
		else {
			array_push($this->errorArray, Constants::$loginFailed);
			return false;
		}
	}

	public function register($un, $fn, $ln, $em1, $em2, $pw1, $pw2) {
		$this -> validateUserName($un);
		$this -> validateFirstName($fn);
		$this -> validateLastName($ln);
		$this -> validateEmails($em1, $em2);
		$this -> validatePasswords($pw1,$pw2);

		// The details are valid - insert into DB
		if (empty($this->errorArray)) {
			return $this->insertUserDetails($un, $fn, $ln, $em1, $pw1);
		}
		else {
			return false;
		}
	}

	public function getError($error) {
		if (!in_array($error, $this->errorArray)) {
			$error = "";
		}

		return "<span class='errorMessage'>$error</span>";
	}

	//Inserts details to myspot DB
	private function insertUserDetails($un, $fn, $ln, $em1, $pw1) {
		$encryptedPw = md5($pw1); //Insert an encrypted password to the DB
		$profilePic = "assets/img/profile-pics/'thor.jpg";
		$date = date("Y-m-d");

		$result = mysqli_query($this->con, "INSERT INTO myspot_users VALUES ('','$un', '$fn', '$ln', '$em1', '$encryptedPw', '$date', 'profilePic', '', '', '')");

		return $result;
	}

	private function validateUserName($un) {
		if (strlen($un) > 25 || strlen($un) < 4) {
			array_push($this->errorArray , Constants::$usernameLength);
			return;
		}

		$checkUserNameQuery = mysqli_query($this->con, "SELECT username FROM myspot_users WHERE username='$un'");
		if (mysqli_num_rows($checkUserNameQuery) != 0) {
			array_push($this->errorArray, Constants::$usernameTaken);
			return;
		}

	}

	private function validateFirstName($fn) {
		if (strlen($fn) > 25 || strlen($fn) < 2) {
			array_push($this->errorArray , Constants::$firstnameLength);
			return;
		}
	}

	private function validateLastName($ln) {
		if (strlen($ln) > 25 || strlen($ln) < 2) {
			array_push($this->errorArray , Constants::$lastnameLength);
			return;
		}
	}

	private function validateEmails($em1, $em2) {
		if ($em1 != $em2) {
			array_push($this->errorArray , Constants::$emailsDontMatch);
			return;
		}

		if (!filter_var($em1, FILTER_VALIDATE_EMAIL)) {
			array_push($this->errorArray , Constants::$emailInvalid);
			return;
		}

		$checkEmailQuery = mysqli_query($this->con, "SELECT user_email FROM myspot_users WHERE user_email='$em1'");
		if (mysqli_num_rows($checkEmailQuery) != 0) {
			array_push($this->errorArray, Constants::$emailTaken);
			return;
		}
	}

	private function validatePasswords($pw1, $pw2) {
		if ($pw1 != $pw2) {
			array_push($this->errorArray , Constants::$passwordsDoNotMatch);
			return;
		}

		if (preg_match('/[^A-Za-z0-9]/', $pw1)) {
			array_push($this->errorArray , Constants::$passwordNotAlphanumeric);
			return;
		}

		if (strlen($pw1) > 25 || strlen($pw1) < 6) {
			array_push($this->errorArray , Constants::$passwordLength);
			return;
		}
	}
}

?>