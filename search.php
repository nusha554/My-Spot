<?php 
	include("includes/config.php");

	if(isset($_GET['term'])) {
		$term = $_GET['term'];
	}
	else {
		$term = "";
	}

?>


<!-- First include jquery js -->
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<!-- Then include bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!-- jQuery Cookies -->
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://apis.google.com/js/platform.js"></script>
<script src="./assets/js/apiHandler.js"></script>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>MySpot</title>
	<!-- Load Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!-- Loading our stylesheet -->
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<link rel="stylesheet" type="text/css" href="assets/css/index.css">
	<link rel="stylesheet" type="text/css" href="assets/css/search.css">

</head>
<body>	
	<div id="mainContainer">
		<div id="topContainer">
			<?php include("includes/navBarContainer.php"); ?>
			<div id="mainViewContainer">
				<div id="mainContent">
					<h1 class="header searchContainer">
						Search for your favorite song <br> 
						To discover some new music<br>
						That you just might like as well
					</h1>
					<div class="searchContainer">						
						<div class="searchBarContainer">
							<div class="searchBar"> 
								<i class="fas fa-search"></i>
								<i class="fas fa-microphone" id="searchSpeak" value="Loading" disabled></i>
								<i class="fas fa-times" onclick="document.getElementById('controlDisplay').value = ''"></i>
								<input type="text" name="searchString" id="controlDisplay" class="searchInput" placeholder="Search your track..." value="<?php echo $term; ?>" onfocus="this.value = this.value">
							</div>
						</div>
						<button type="button" id="button" name="loginButton" class="getPlaylistButton" onclick = "validSearch();"> 
							Let's get it!
						</button>
						<div class="searchResult">
							<!-- List of tracks result -->
							<ul class="trackList">
								<div class="container" id="song-list">
									<div id="song_0" onclick="markSelected('0');"></div>
									<div id="song_1" onclick="markSelected('1');"></div>
									<div id="song_2" onclick="markSelected('2');"></div>
									<div id="song_3" onclick="markSelected('3');"></div>
									<div id="song_4" onclick="markSelected('4');"></div>
								</div>
							</ul> <!-- Tracks list-->
						</div>
					</div> <!-- Search container--> 														
				</div>  <!-- mainContent -->
			</div> <!-- mainViewContainer -->
		</div><!--  topContainer -->
	</div> 	<!-- mainContainer -->
</body>
<script src="./assets/js/searchSpeech.js"></script>
<script src="./assets/js/manageSearchTab.js"></script>
<script src="./assets/js/markSelectedSong.js"></script>
<script src="./assets/js/searchValidation.js"></script>
<script type="text/javascript">
	window.addEventListener("load", onPageLoad());
	window.addEventListener("load", function(){
  		$('.searchResult').hide();
	});
</script>
</html>