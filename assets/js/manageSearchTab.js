


setInterval(function() { 
    // If value is not empty
  if ($('#controlDisplay').val().length == 0) {
    // Hide the element
    $('.searchResult').hide();
     $('.fa-times').hide();
     sessionStorage.setItem("validSearch", "invalid");
  } else {
    // Otherwise show it
    $('.searchResult').show();
    $('.fa-times').show();
  }
 }, 100);