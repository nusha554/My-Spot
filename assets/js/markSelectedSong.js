//If the song already selected, unselect it
// If the song not yet selected, select it and unselect all other
function markSelected(id) {
	if (document.getElementById('song_' + id).style.background) {
		document.getElementById('song_' + id).style.background = "";
		sessionStorage.setItem("validSearch", "invalid");
	}
	else {
	document.getElementById('song_' + id).style.background = "#FF4447";
	sessionStorage.setItem("validSearch", "valid");
	// Unselect all other
	for (let i = 0; i < 5; i++) {
		if (i != id)
			document.getElementById('song_' + i).style.background = "";
	}
	$('#controlDisplay').keyup(function() {
	  // If search is empty, reset the last selected song
	  if ($(this).val().length == 0) {
	  	document.getElementById('song_' + id).style.background = "";
	  	// If a song was marked, disable search button
	  	sessionStorage.setItem("validSearch", "invalid");
	  }
	}).keyup();
	}
}