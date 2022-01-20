const openMenu = document.getElementById("show-menu");
const hideMenu =  document.getElementById("hide-menu");
const sideMenu =  document.getElementById("nav-menu");


openMenu.addEventListener("click", function() {
	sideMenu.classList.add("active");
})


hideMenu.addEventListener("click", function() {
	sideMenu.classList.remove('active')
})