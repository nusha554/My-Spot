
function getUserPreference(accessToken, userId) {
  let playlistName = prompt("Please enter your playlist's name", "My Playlist");
  //If cancel was pressed
  if (playlistName == null)
    return;
  
  let playlistDescription = prompt("Please enter your playlist's description", "My Spot recommended playlist");
  //If cancel was pressed
  if (playlistDescription == null)
    return;
  
  let isPublic = prompt("Would you like to go public and let everyone enjoy your music? y/n", "y");
  //If cancel was pressed
  if (isPublic == null)
    return;

  if (isPublic != "n" && isPublic != "y") {
    alert("Oops! That's not an option :(");
    return;
  }
  isPublic = (isPublic == 'y') ? true: false;
  createNewSpotifyPlaylist(accessToken, userId, playlistName, playlistDescription, isPublic);
}


function createNewSpotifyPlaylist(accessToken, userId, playlistName, playlistDescription, isPublic) {

    var urlString = 'https://api.spotify.com/v1/users/' + userId + '/playlists';
    var jsonData = {
          "name": playlistName,
          "description": playlistDescription,
          "public": isPublic
        };

    fetch(urlString, {
       method: "POST",
       headers: {
         'Authorization': 'Bearer ' + accessToken,
          Accept: "application/json",
         "Content-Type": "application/json"
       },
       body: JSON.stringify(jsonData),
    }).then(res => res.json())
    //.then(data =>  window.localStorage.setItem('playlistId', data.id))
    .then(data => addTracksToPlaylist(accessToken, data.id))
    .catch(err => console.log(err)); 
}

//Save the uri of each track and retrieve it here
function addTracksToPlaylist(accessToken, playlistId) {
  // Get uris of the tracks from the generated recommended playlist
  var uris = JSON.parse(sessionStorage.getItem('uris')) || [];
  var urlString = `https://api.spotify.com/v1/playlists/${playlistId}/tracks`;
  var jsonData = {
        "uris": uris,
      };

  fetch(urlString, {
     method: "POST",
     headers: {
       'Authorization': 'Bearer ' + accessToken,
        Accept: "application/json",
       "Content-Type": "application/json"
     },
     body: JSON.stringify(jsonData),
  }).then(res => res.json())
  .catch(err => console.log(err)); 

}


document.getElementById('exportSpotify').addEventListener('click', function() {
  var accessToken = localStorage.getItem("access_token");
  var userId = localStorage.getItem("userID");
  getUserPreference(accessToken, userId);
});




document.getElementById('refreshPage').addEventListener('click', function() {
  const albumCoverBackground = sessionStorage.getItem(sessionStorage.getItem('trackIDPlay'));
  document.getElementById("albumCoverBackground").style.cssText+=`background-image:url(${albumCoverBackground});
               background-size: cover; background-position: center;`;
 location.reload();
});
