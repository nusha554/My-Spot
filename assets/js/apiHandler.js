
var redirect_uri = "http://localhost/MySpot/search.php";
var client_id = '52ef4258ab0e41cda44c709ba1ce8ff8';
var client_secret = '72381a13b2024cde85d0c0bf593717fb';
var access_token = null;
var refresh_token = null;
var spotifyUserValid = true;
const AUTHORIZE = "https://accounts.spotify.com/authorize"
const TOKEN = "https://accounts.spotify.com/api/token";
const PLAYLISTS = "https://api.spotify.com/v1/me/playlists";
localStorage.setItem("client_id", client_id);
localStorage.setItem("client_secret", client_secret); // In a real app you should not expose your client_secret to the user


function onPageLoad(){
   //client_id = localStorage.getItem("client_id");
   // client_secret = localStorage.getItem("client_secret");
    if ( window.location.search.length > 0 ){
        handleRedirect();
    }
    else{
        var access_token = localStorage.getItem("access_token");
        // if ( access_token == null ){
        //     // we don't have an access token so present token section
        //     //document.getElementById("tokenSection").style.display = 'block';  
        // }
        // else {
        //     // we have an access token so present device section
        //    // document.getElementById("deviceSection").style.display = 'block';  
        //    // refreshDevices();
        //    // refreshPlaylists();
        //    // currentlyPlaying();
        // }
    }
    //refreshRadioButtons();
}

function handleRedirect(){
    let code = getCode();
    fetchAccessToken(code);
    window.history.pushState("", "", redirect_uri); // remove param from url
}


function getCode(){
    let code = null;
    const queryString = window.location.search;
    if ( queryString.length > 0 ){
        const urlParams = new URLSearchParams(queryString);
        code = urlParams.get('code')
    }
    return code;
}



function requestAuthorization() {

    var userID = document.getElementById("userID").value;
    localStorage.setItem('userID', userID);
    let url = AUTHORIZE;
    url += "?client_id=" + client_id;
    url += "&response_type=code";
    url += "&redirect_uri=" + encodeURI(redirect_uri);
    url += "&show_dialog=true";
    url += "&scope=playlist-modify-public playlist-modify-private";

    // Redirect to Spotify's authorization screen
    window.location.href = url; 
    window.open(url,"_top");
}

function fetchAccessToken(code){

    let body = "grant_type=authorization_code";
    body += "&code=" + code; 
    body += "&redirect_uri=" + encodeURI(redirect_uri);
    body += "&client_id=" + client_id;
    body += "&client_secret=" + client_secret;
    callAuthorizationApi(body);
}

function refreshAccessToken(){
    refresh_token = localStorage.getItem("refresh_token");
    let body = "grant_type=refresh_token";
    body += "&refresh_token=" + refresh_token;
    body += "&client_id=" + client_id;
    callAuthorizationApi(body);
}

function callAuthorizationApi(body){

    let xhr = new XMLHttpRequest();
    xhr.open("POST", TOKEN, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('Authorization', 'Basic ' + btoa(client_id + ":" + client_secret));
    xhr.send(body);
    xhr.onload = handleAuthorizationResponse;
}

function handleAuthorizationResponse(){

    if ( this.status == 200 ){
        var data = JSON.parse(this.responseText);
        if ( data.access_token != undefined ){
            access_token = data.access_token;
            localStorage.setItem("access_token", access_token);
            userID = localStorage.getItem("userID");
            connectToSpotifyAccount(access_token, userID);
        }
        if ( data.refresh_token  != undefined ){
            refresh_token = data.refresh_token;
            localStorage.setItem("refresh_token", refresh_token);
        }
        onPageLoad();
    }
    else {
        console.log(this.responseText);
        alert(this.responseText);
    }
}

function connectToSpotifyAccount(accessToken, userID) {
     
    $.ajax({ 
      url: `https://api.spotify.com/v1/users/${userID}`, 
      type: 'GET',
      headers: {
          'Authorization' : 'Bearer ' + accessToken
      },
      success: function(data) {
        localStorage.setItem("userName", data.display_name);
      },
      // Illigal spotify username
      error: function(){
        window.location.href = 'index.php';
      }

    });
}