let navbar = document.getElementById('navbar');
let dark_mode = navbar.classList.contains('dark');

window.onscroll = function(){
  let scroll = window.scrollY;
  if(scroll>100){
    navbar.classList.add('scroll');
    if(dark_mode) navbar.classList.remove('dark');
  }else{
    navbar.classList.remove('scroll');
    if(dark_mode) navbar.classList.add('dark');
  }
};
