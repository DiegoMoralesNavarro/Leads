




(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('.parallax').parallax();

  }); // end of document ready
})(jQuery); // end of jQuery name space



document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('select').formSelect();
  });







$('.menu-trigger').on('click', function() {
  $('.menu').addClass('slide-in');
  $('.overlay').removeClass('hide');
});

$('.menu-close, .overlay, .menu-page-link').on('click', function() {
  $('.menu').removeClass('slide-in');
  $('.overlay').addClass('hide');
});







