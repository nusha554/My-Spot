<div id="nowPlayingBarContainer">

	<div id="nowPlayingBar"> 
		<script>
			let trackIDPlay = sessionStorage.getItem('trackIDPlay');
			
			// if (!trackIDPlay)
			// 	 window.location.href = 'index.php';

			let trackLink = `https://open.spotify.com/embed/track/${trackIDPlay}`;
			let iframe = 
               `<div class='song'>
              <iframe id="trackFrame" src=${trackLink} frameborder="0" allowtransparency="true" allow="encrypted-media" 
              style="width: 100%; 
					height: 100%;"></iframe>
              </div>`; 
              let parent_div = $('#nowPlayingBar');   
                        
              parent_div.html(iframe);
		</script>		
	</div>
</div"