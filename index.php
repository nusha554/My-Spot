<?php 
	include("includes/config.php");

		//session_destroy();

		// Check if the user was logged in
	if (isset($_SESSION['userLoggedIn'])) {
		$userLoggedIn = $_SESSION['userLoggedIn'];
	}
		// If not, redirect him back to register page
	else {
		header("Location: register.php");
	}

?>

<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>MySpot</title>
	<!-- Load Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!-- Loading our stylesheet -->
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

	<link rel="stylesheet" type="text/css" href="assets/css/spotifyRegister.css">
	<script src="./assets/js/apiHandler.js"></script>
</head>

<body>
<div id="background">
	<div id="inputContainer">
		<h2 id="headerTop"> Welcome to </h2>
		<a href="register.php" class="logo">
			<img src="assets/img/icons/logo2.png" id="logoImg">
		</a>
		<form id="loginForm" action="index.php" method="POST">
			<h2 id="headerBottom"> Login to Your Spotify Account </h2>
			<i class="fa fa-question-circle" id="questionSymbol" onclick="popSpotifyUser()"></i>
			 <div class="popup">
			  <span class="popUpText" id="popSpotifyUserContainer"> Click on "Account" at the top right of the Spotify website.</br> At "Account overview" page below "Profile" get your "Username"</span>
			</div>
    		<p>
        		<input type="text" class="form-control spotifyUser" name="spotifyUsername" id="userID" placeholder="Spotify Username" required>
    		</p>
    		<button type="submit" name="loginButton" id="button" onclick="submitForm();">Connect Me to My Spotify!</button>
    		<script type="text/javascript">
    			window.submitForm = function submitForm() {
						 if(($("#loginForm")[0].checkValidity())) {
						 	event.preventDefault(); 
						 	document.getElementById('loginForm').submit();
						 	return requestAuthorization();
						 } 
					}
    		</script>
		</form>
	</div>
	<div id="loginText">
		<h1> Discover new music<br/>    with MySpot </h1>
		<h2> Create playlists based on your favored jams </h2>
		<ul>
			<li> Pick up a song you've been listening on repeat. </li>
			<li> Get a playlist with a new music made just for you </li>
			<li> Save it on your Spotify account and share with friends. </li>
		</ul>
	</div>		
</div>
<script>
// When the user clicks on <div>, open the popup
function popSpotifyUser() {
	var popup = document.getElementById("popSpotifyUserContainer");
	popup.classList.toggle("show");
}
</script>
<script src="https://apis.google.com/js/platform.js"></script>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Loading our JavaScript -->
<!-- <script src="assets/js/apiHandler.js"></script> -->
</body>
</html>