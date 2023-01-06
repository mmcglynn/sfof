const searchbtn = document.getElementById('search-toggle');
const searchnav = document.getElementById('site-navigation');

searchbtn.addEventListener("click", function() {
	searchnav.classList.toggle('search-toggled');
});
