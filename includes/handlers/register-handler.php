<?php 

// Sanitize the username form beform insert into DB
function legalFormUserName($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}

// Sanitize the paasword form beform insert into DB
function legalFormPassword($inputText) {
	$inputText = strip_tags($inputText);
	return $inputText;
}

// Sanitize the string form beform insert into DB
function legalFormString($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}


// register button was pressed
if (isset($_POST['registerButton'])) {
	
	// Sanitize all the registration input
	$username = legalFormUserName($_POST['userName']);
	$firstname = legalFormString($_POST['firstName']);
	$lastname = legalFormString($_POST['lastName']);
	$email = legalFormString($_POST['email']);
	$confirmEmail = legalFormString($_POST['confirmEmail']);
	$password = legalFormPassword($_POST['password']);
	$confirmPassword = legalFormPassword($_POST['confirmPassword']);

	// Perform the registration
	$wasSuccessful = $account->register($username, $firstname, $lastname, $email, $confirmEmail, $password, $confirmPassword);

	// If the registraton was successful, redirect to index page
	if ($wasSuccessful){
		$_SESSION['userLoggedIn'] = $username;
		header("Location: index.php");
	}
}

 ?>
