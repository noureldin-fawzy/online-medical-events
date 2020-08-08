window.onscroll = function() {myFunction()};
var header = document.getElementById("sub-header");
var sticky = header.offsetTop;
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky-top-header");

  } else {
    header.classList.remove("sticky-top-header");
  }
}
jQuery(function() {
    $(document).ready(function(){
        $('.owl-speakers').owlCarousel({
            nav:true,
            dots:false,
            autoplay:true,
            autoplayTimeout:4000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:4
                },
                1000:{
                    items:5
                }
            }
        });
        });
			
});
