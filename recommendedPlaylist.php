<?php
include("includes/config.php");

if(isset($_GET['term'])) {
	$term = $_GET['term'];
}
else {
	$term = "";
}
?>

<!--

	search.php -> search.js -> apihandler & recommendedPlaylist


	--->


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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="module" src="./assets/js/recommendedPlaylist.js"></script>
<script type="module" src="./assets/js/exportSpotify.js"></script>
<script type="module" src="./assets/js/apiHandler.js"></script>


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
	<link rel="stylesheet" type="text/css" href="assets/css/index.css">
	<link rel="stylesheet" type="text/css" href="assets/css/recommendedPlaylist.css">
	
</head>
<body>
	<div id="mainContainer">
		<div id="topContainer">
			<!-- Navigation bar right side part -->
			<?php include("includes/navBarContainer.php"); ?>
			<div id="mainViewContainer">
				<div id="mainContent">
					<div class="headerContainer" id="albumCoverBackground">
						<script type="text/javascript">
													
						    const albumCoverBackground = sessionStorage.getItem(sessionStorage.getItem('trackIDPlay'));
						     document.getElementById("albumCoverBackground").style.cssText+=`
						     		background-image: linear-gradient(to right,#121212 0%,#181817 100%), 
						     			url(${albumCoverBackground});
						          	background-position: center;
						           	background-blend-mode:lighten;`;
						</script>
						<span class="header"> We found some new jams</br> You might just like</span>
					</div>
					<div class="buttonsContainer">
						<button id="savePlaylist"> <i class="fas fa-heart"></i></button>
						<button id="exportSpotify"><i class="fas fa-arrow-down"></i></button>
						<button id="refreshPage"> <i class="fas fa-sync-alt"></i> </button>
						<button onclick="location.href = 'search.php';"
						 id="searchPage"> <i class="fas fa-search"></i> </button>
					</div>
					<script>
						
					</script>
 					<div class="searchContainer">
 						<div class="searchResult">
 							<!-- List of tracks result -->
							<ul class="trackList">
								<div id="song-list">
									<div id="song_0" onclick="playClickedSong();"></div>
									<div id="song_1" onclick="playClickedSong();"></div>
									<div id="song_2" onclick="playClickedSong();"></div>
									<div id="song_3" onclick="playClickedSong();"></div>
									<div id="song_4" onclick="playClickedSong();"></div>
									<div id="song_5" onclick="playClickedSong();"></div>
									<div id="song_6" onclick="playClickedSong();"></div>
									<div id="song_7" onclick="playClickedSong();"></div>
									<div id="song_8" onclick="playClickedSong();"></div>
									<div id="song_9" onclick="playClickedSong();"></div>
									<div id="song_10" onclick="playClickedSong();"></div>
									<div id="song_11" onclick="playClickedSong();"></div>
									<div id="song_12" onclick="playClickedSong();"></div>
									<div id="song_13" onclick="playClickedSong();"></div>
									<div id="song_14" onclick="playClickedSong();"></div>
									<script>
									    function playClickedSong() {									      
									         let trackIDPlay = sessionStorage.getItem('trackIDPlay');
									         let trackLink = `https://open.spotify.com/embed/track/${trackIDPlay}`;
											let iframe = 
								               `<div class='song'>
								              <iframe id="trackFrame" src=${trackLink} frameborder="0" allowtransparency="true" allow="encrypted-media" 
								              style="width: 100%; 
													height: 100%;"></iframe>
								              </div>`; 
								             let parent_div = $('#nowPlayingBar');   			                        
								             parent_div.html(iframe);						
									    }
									</script>
								</div>	<!-- searchResult --> -->
							</ul>
						</div>	<!-- searchResult -->
 					</div>	<!-- searchContainer -->
 					<?php include("includes/nowPlayingBar.php"); ?>
				</div>  <!-- mainContent -->
			</div> <!-- mainViewContainer -->
		</div><!--  topContainer -->
	</div> 	<!-- mainContainer -->
</body>
</html>