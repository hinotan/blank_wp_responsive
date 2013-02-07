// mobile menu
$('#m-menu').click(function(){
  $('body').toggleClass('menu-on');
});
$('#m-menu').toggle(function(){
  $(this).text('返回 «');
}, function(){
  $(this).text('更多 »');
});


$(function (){ // back to top
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