let navbar = document.getElementById('navbar');

window.onscroll = function(){
  let scroll = window.scrollY;
  if(scroll>100){
    navbar.classList.add('scroll');
  }else{
    navbar.classList.remove('scroll');
  }
};
