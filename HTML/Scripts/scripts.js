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


