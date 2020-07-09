
  // Get current path and find target link
  var path = window.location;

  // Account for home page with empty path
  if ( path == '' ) {
    path = 'index.php';
  }

  //console.log(path);

  var target = $('.nav li a[href="'+path+'"]');
  // Add active class to target link
  target.parent().addClass('active');

  /*$("#minimizeSidebar").click ( function () {

    $(".logo-normal img").toggle();
    $(".logo-mini img").toggle();

  })*/
