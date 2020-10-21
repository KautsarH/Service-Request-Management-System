window.addEventListener("scroll", function(){
	const logoImage = document.querySelector
	(".logo img");
	const mainNav = document.getElementById("mainNav");

	if(window.pageYOffset > 0){
		logoImage.style.height = "40px";
		/*mainNav.classList.add('bg-black');
		mainNav.classList.add('txt-white');*/
	} 
	else {
		logoImage.style.height = "70px";
		mainNav.classList.remove('bg-black');
		mainNav.classList.remove('txt-white');
	}
});

/*$(document).on("scroll", function() {
	$("#slide").css("top", Math.max(180 - 0.2*window.scrollY, 0) + "px");
  $(".image1 img").css("opacity", Math.max(1 - 0.2*window.scrollY, 0));
});*/