<?php 

// Login button was pressed
if (isset($_POST['loginButton'])) {
	$username = $_POST['loginUserName'];
	$password = $_POST['loginPassword'];

	// Login function call
	$result = $account->login($username, $password);

	// If the login was successful, redirect to index page
	if ($result) {
		$_SESSION['userLoggedIn'] = $username;
		header("Location: index.php");
	}
}

 ?>