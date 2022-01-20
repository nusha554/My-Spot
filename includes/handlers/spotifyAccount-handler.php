<script src="./assets/js/apiHandler.js"></script>
<?php 

	// Connect to Spotify button was pressed
	if (isset($_POST['loginButton'])) {
		$spotifyUsername = $_POST['spotifyUsername'];

		// Login function call
		$result = $spotifyAccount->login($spotifyUsername);

		// If the login was successful, redirect to search page
		if ($result) {
			header("Location: search.php");
		}
	}


 ?>