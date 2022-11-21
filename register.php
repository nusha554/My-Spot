
<?php 
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if (isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/index.css">
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php 

		if (isset($_POST['registerButton'])) {
			echo '<script>
					$(document).ready(function() {
						$("#loginForm").hide();
						$("#registerForm").show();
					});
				</script>';
			}
			else {
				echo '<script>
						$(document).ready(function() {
							$("#loginForm").show();
							$("#registerForm").hide();
						});
					</script>';
		}
	?>

<div id="background">
	<div id="inputContainer"> 
		<h2 id="headerTop"> Welcome to </h2>
		<a href="register.php" class="logo">
			<img src="assets/img/icons/logo2.png" id="logoImg">
		</a>
		<!--  Login Form -->
		<form id="loginForm" action="register.php" method="POST">
			<h2 id="headerBottom"> Login to Your Account </h2>
			<p>
				<span id="errorMessage">
					<?php echo $account->getError(Constants::$loginFailed);?>
				</span>
				<input id="loginUserName" name="loginUserName" type="text" placeholder="Username" value="<?php getInputValue('loginUserName') ?>" required>
			</p>
			<p>
				<input id="loginPassword" name="loginPassword" type="password" placeholder = "Password" required>
			</p>
			<button type="submit" id="button" name="loginButton"> Log In</button>	
			<div class="hasAccountText">
				<span id="hideLogin">Don't have an account yet? Sign Up here.</span>
			</div>		
		</form>

		<!--  Register Form -->
		<form id="registerForm" action="register.php" method="POST">
			<h2 id="headerBottom"> Create your free Account</h2>
			<p>
				<span id="errorMessage">
					<?php echo $account->getError(Constants::$usernameLength);?>
					<?php echo $account->getError(Constants::$usernameTaken);?> 
				</span>
				<input id="userName" name="userName" type="text" placeholder="Insert Your Username" 
				value="<?php getInputValue('userName') ?>" required>
			</p>

			<p>
				<span id="errorMessage">
					<?php echo $account->getError(Constants::$firstnameLength);?>
				</span>
				<input id="firstName" name="firstName" type="text" placeholder="Insert Your Name" 
				value="<?php getInputValue('firstName')?>" required>
			</p>

			<p>
				<span id="errorMessage">
					<?php echo $account->getError(Constants::$lastnameLength);?>
				</span>
				<input id="lastName" name="lastName" type="text" placeholder="Insert Your Last Name" 
				value="<?php getInputValue('lastName')?>" required>
			</p>

			<p>
				<span id="errorMessage">
					<?php echo $account->getError(Constants::$emailsDontMatch);?>
					<?php echo $account->getError(Constants::$emailInvalid);?>
					<?php echo $account->getError(Constants::$emailTaken);?> 
				</span>
				<input id="email" name="email" type="email" placeholder="Insert Your Email" 
				value="<?php getInputValue('email')?>" required>
			</p>
			<p>
				<input id="confirmEmail" name="confirmEmail" type="email" placeholder="Confirm Your Email" 
				value="<?php getInputValue('confirmEmail')?>" required>
			</p>
			<p>
				<span id="errorMessage">
					<?php echo $account->getError(Constants::$passwordsDoNotMatch);?>
					<?php echo $account->getError(Constants::$passwordNotAlphanumeric);?>
					<?php echo $account->getError( Constants::$passwordLength);?>
				</span>
				<input id="password" name="password" type="password" placeholder = "Insert Your Password"
				value="<?php getInputValue('password')?>" required>
			</p>

			<p>
				<input id="confirmPassword" name="confirmPassword" type="password" placeholder = "Confirm Your Password" 
				value="<?php getInputValue('confirmPassword')?>" required>
			</p>
			<button type="submit" id="button" name="registerButton"> Sign Up</button>	
			<div class="hasAccountText">
				<span id="hideRegister">Already have an acount? Login here.</span>	
			</div>
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
</body>
</html>