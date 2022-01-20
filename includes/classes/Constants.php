<?php 

class Constants {

	// Registration error messages
	public static $passwordsDoNotMatch = "Passwords do not match. Please try again.";
	public static $passwordNotAlphanumeric = "Password contains illegal character. Please try again.";
	public static $passwordLength = "Your password must be between 6 and 25 characters.Please try again.";
	public static $emailInvalid = "Email is invalid. Please try again.";
	public static $emailsDontMatch = "Email confirmation failed. Please try again.";
	public static $lastnameLength = "Your last name must be between 2 and 25 characters. Please try again.";
	public static $firstnameLength = "Your first name must be between 2 and 25 characters. Please try again.";
	public static $usernameLength = "Your username must be between 4 and 25 characters. Please try again.";
	public static $usernameTaken = "Your username already exists. Please try again.";
	public static $emailTaken = "Your email already exists. Please try again.";

	//Login error messages
	public static $loginFailed = "Your username or password are invalid. Please try again.";
}


?>