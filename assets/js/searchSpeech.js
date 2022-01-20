
var said, timer, wasVoice = false;;
const albumImg = new Map();

var voice = {
  // (A) INIT SPEECH RECOGNITION
  sfield : null, // HTML SEARCH FIELD
  sbtn : null, // HTML VOICE SEARCH BUTTON
  recog : null, // SPEECH RECOGNITION OBJECT
  init : () => {
    // (A1) GET HTML ELEMENTS
    voice.sfield = document.getElementById("controlDisplay");
    voice.sbtn = document.getElementById("searchSpeak");

    // (A2) GET MICROPHONE ACCESS
    navigator.mediaDevices.getUserMedia({ audio: true })
    .then((stream) => {
      // (A3) SPEECH RECOGNITION OBJECT + SETTINGS
      const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
      voice.recog = new SpeechRecognition();
      voice.recog.lang = "en-US";
      voice.recog.continuous = false;
      voice.recog.interimResults = false;

      // (A4) POPUPLATE SEARCH FIELD ON SPEECH RECOGNITION
      voice.recog.onresult = (evt) => {
        said = evt.results[0][0].transcript.toLowerCase();
        voice.sfield.value = said;
        wasVoice = true;
        // voice.sform.submit();
        // OR RUN AN AJAX/FETCH SEARCH
        voice.stop();
        searchInput();
      };

      // (A5) ON SPEECH RECOGNITION ERROR
      voice.recog.onerror = (err) => { console.error(err); };

      // (A6) READY!
      voice.sbtn.disabled = false;
      voice.stop();
    })
    .catch((err) => {
      console.error(err);
      voice.sbtn.value = "Please enable access and attach microphone.";
    });
  },

  // (B) START SPEECH RECOGNITION
  start : () => {
    voice.recog.start();
    voice.sbtn.onclick = voice.stop;
    voice.sbtn.value = "Speak Now Or Click Again To Cancel";
  },

  // (C) STOP/CANCEL SPEECH RECOGNITION
  stop : () => {
    voice.recog.stop();
    voice.sbtn.onclick = voice.start;
    voice.sbtn.value = "Press To Speak";
  }
};

function searchInput() {
  var accessToken = localStorage.getItem("access_token");
  clearTimeout(timer);
  timer = setTimeout(function() {
    var search_query;
    if (wasVoice) {
        search_query = said;
      }
    else {
      var raw_search_query = $(".searchInput").val();
      search_query = encodeURI(raw_search_query);
    }
      // Make Spotify API call using the track API endpoint.
    $.ajax({ 
        url: `https://api.spotify.com/v1/search?q=${search_query}&type=track`, 
        type: 'GET',
        headers: {
            'Authorization' : 'Bearer ' + accessToken
        },
        success: function(data) {
          console.log(search_query);
          // Load our songs from Spotify into our page
            let num_of_tracks = data.tracks.items.length;
            let count = 0;
            // Max number of songs is 12
            const max_songs = 15;
            //console.log(num_of_tracks);
            while(count < max_songs && count < num_of_tracks) {
              // Extract the id of the FIRST song from the data object
              let id = data.tracks.items[count].id;
              // Constructing two different iframes to embed the song
              let trackID = `https://open.spotify.com/embed/track/${id}`;

              albumImg.set(id, data.tracks.items[count].album.images[0].url)
              
              let iframe = 
               `<div class='song'>
              <iframe src=${trackID} frameborder="0" allowtransparency="true" allow="encrypted-media" 
              style="padding:50px;"></iframe>
              </div>`; 

              let songResult = `<span id = "${id}" onClick="getTrackID(this.id)"> 
                                      ${data.tracks.items[count].name} by ${data.tracks.items[count].artists[0].name}
                                  </span> 
                                  <script>
                                    function getTrackID(trackID) {
                                       sessionStorage.setItem('trackID' , trackID);
                                       sessionStorage.setItem('trackIDPlay' , trackID);
                                      sessionStorage.setItem('trackIDImg', albumImg.get(trackID));
                                    }
                                  </script>
                                `;

               //console.log(songResult);
              let parent_div = $('#song_'+ count);              
              parent_div.html(songResult);
              count++;
            }
        } //end of success
    }); // End of Spotify ajax call

    wasVoice = false;

  }, 100);   
}

window.addEventListener("DOMContentLoaded", voice.init);//start only when the uaer clicks on microphone
const input = document.getElementById('controlDisplay');
input.addEventListener('input', searchInput);