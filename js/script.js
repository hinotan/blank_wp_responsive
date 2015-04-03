jQuery(document).ready(function($){

  // Mobile menu button
  $('#m-menu').click(function(){
    $('body').toggleClass('menu-on');
  });

  // Scroll to top button
  $(function (){
    var $toTop = $('#scroll-to-top');
    var $window = $(window);
    $toTop.hide();
    $window.scroll(function(){
      if($window.scrollTop() > 400) {
        $toTop.fadeIn('50');
      } else {
        $toTop.fadeOut('50');
      }
    });
  });

  // Initiate image album slideshow
  $('.flexslider').flexslider({
    animation: "slide",
    pauseOnHover: true,
    animationLoop: true,
    prevText: "",
    nextText: "",
    controlNav: false,
    slideshow: true,
    animationSpeed: 1000,
    slideshowSpeed: 5000
  });

  // onMediaQuery
  var queries = [
    {
      context: 'mobile',
      match: function() {
        console.log('Mobile callback. Maybe hook up some tel: numbers?');
        // Your mobile specific logic can go here.
      },
      unmatch: function() {
        // We're leaving mobile.
      }
    },
    {
      context: 'desktop',
      match: function() {
        console.log('wide-screen callback woohoo! Load some heavy desktop JS badddness.');
        // your desktop specific logic can go here.
      }
    }
  ];

  MQ.init(queries);


});
