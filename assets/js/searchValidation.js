
function validSearch() {
	//If s song was selected, enable search
	let button = document.getElementById("button");
	let validSearch = sessionStorage.getItem("validSearch");
	if (validSearch === "valid")
		window.location.href = 'recommendedPlaylist.php';
}