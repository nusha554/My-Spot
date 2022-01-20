
// Get the access token and the selected track id
var accessToken = localStorage.getItem('access_token');
var trackID = sessionStorage.getItem('trackID');
//Create array of uris for future possible export recommended playlist to Spotify
// and save it in local storage
var uris = [];
sessionStorage.setItem("uris", JSON.stringify(uris));
sessionStorage.setItem("validSearch", "invalid");


function millisToMinutesAndSeconds(millis) {
  var minutes = Math.floor(millis / 60000);
  var seconds = ((millis % 60000) / 1000).toFixed(0);
  return minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
}


$.ajax({ 
  url: `https://api.spotify.com/v1/recommendations?limit=15&seed_tracks=${trackID}`,
  type: 'GET',
  headers: {
      'Authorization' : 'Bearer ' + accessToken
  },
  success: function(data) {

    // Load our songs from Spotify into our page
      let num_of_tracks = data.tracks.length;
      let count = 0;
      // Max number of songs is 15
      const max_songs = 15;
      while(count < max_songs && count < num_of_tracks) {
        // Extract the id of the FIRST song from the data object
        let id = data.tracks[count].id;
        // document.getElementById("albumCoverBackground").style.cssText+=`background-image:url(${sessionStorage.getItem('trackIDImg')});     background-size: cover; background-position: center;`;
        


 document.getElementById("albumCoverBackground").style.cssText+=`
                    background-image: linear-gradient(to right,#121212 0%,#181817 100%), 
                      url("${sessionStorage.getItem('trackIDImg')}");
                        background-position: center;
                         background-size: cover;
                        background-blend-mode:screen;`;


        $( "#halbumCoverBackground" ).load(window.location.href + " #albumCoverBackground" );
        let songDuration = millisToMinutesAndSeconds(data.tracks[count].duration_ms)
        console.log(data.tracks[count].album.images[0].url)
        let songResult = `<table id = "${id}" onClick="getTrackID(this.id)">
                                 <thead>
                                  <tr>
                                      <td id = "counter">${count + 1}</td>
                                      <td><img src=${data.tracks[count].album.images[0].url}></td>
                                      <td>${data.tracks[count].name}</td>
                                      <td>${data.tracks[count].artists[0].name}</td>
                                      <td>${data.tracks[count].album.name}</td>
                                      <td>${songDuration}</td>
                                    </tr>
                                  </thead>                 
                                  <tbody></tbody>
                               </table>
                            <script>
                              function getTrackID(trackID) {
                                  sessionStorage.setItem('trackIDPlay' , trackID);
                                
                              }
                            </script>
                          `;
        //Save the uri of each track for exportPlaylist 
        uris = JSON.parse(sessionStorage.getItem("uris") || "[]");
        uris.push(data.tracks[count].uri);
        sessionStorage.setItem("uris", JSON.stringify(uris));             
        let parent_div = $('#song_'+ count);              
        parent_div.html(songResult);
        count++;
      }
  },
  error: function() {
    window.location.href = 'index.php';
  }

}); // End of Spotify ajax call

