// carousel-interval
$('.carousel').carousel({
    interval: 3500
  })

// navbar-transition-on-scroll
document.onreadystatechange = function() {
  let lastScrollPosition = 0;
  const navbar = document.querySelector('.navbar');
  window.addEventListener('scroll', function(e) {
    lastScrollPosition = window.scrollY;
    
    if (lastScrollPosition > 100)
      navbar.classList.add('navbar-dark');
    else
      navbar.classList.remove('navbar-dark');
  });
}

function change_image(image){

  var container = document.getElementById("main-image");
  
  container.src = image.src;
  }
  