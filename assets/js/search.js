

//var timer;

// Search button has been clicked
const albumImg = new Map();

function searchInput() {	
	var accessToken = localStorage.getItem("access_token");
	clearTimeout(timer);
	var timer = setTimeout(function() {
		
		var raw_search_query = $(".searchInput").val();
		var search_query = encodeURI(raw_search_query);
	    // Make Spotify API call using the track API endpoint.
		$.ajax({ 
	      url: `https://api.spotify.com/v1/search?q=${search_query}&type=track`, 
	      type: 'GET',
	      headers: {
	          'Authorization' : 'Bearer ' + accessToken
	      },
	      success: function(data) {
	        // Load our songs from Spotify into our page
	          let num_of_tracks = data.tracks.items.length;
	          let count = 0;
	          const max_songs = 15;
	          while(count < max_songs && count < num_of_tracks) {
	            // Extract the id of the FIRST song from the data object
	            let id = data.tracks.items[count].id;
	            // Constructing two different iframes to embed the song
	            let trackID = `https://open.spotify.com/embed/track/${id}`;

	            let songResult = `<span id = "${id}" onClick="getTrackID(this.id)"> 
	                              		${data.tracks.items[count].name} byihih ${data.tracks.items[count].artists[0].name}
	                              	</span> 
	                              	<script>
	                              		function getTrackID(trackID) {
	                              			 sessionStorage.setItem('trackID' , trackID);
	                              			 sessionStorage.setItem('trackIDPlay' , trackID);
	                              			 console.log(albumImg)
	                              			 // sessionStorage.setItem('albumImg' , albumImg.get(trackID));
	                              		}
	                              	</script>
	                              `;


	            let parent_div = $('#song_'+ count);	            
	            parent_div.html(songResult);
	            count++;
	          }
	      },
	      //error in search, redirect to authenticate again
	      error: function(){
        	window.location.href = 'index.php';
      	  }
		}); // End of Spotify ajax call

	}, 1000);
  	  
}


const input = document.getElementById("controlDisplay");
input.addEventListener('input', searchInput);




