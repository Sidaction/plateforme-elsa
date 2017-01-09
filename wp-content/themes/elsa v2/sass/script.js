
/*
 * https://github.com/AllThingsSmitty/jquery-tips-everyone-should-know/
 */


/*
 * Back to top
 */

$('a.top').click(function (e) {
  e.preventDefault();
  $(document.body).animate({scrollTop: 0}, 800);
});

// <!-- Create an anchor tag -->
// <a class="top" href="#">Back to top</a>




/*
 * Preload Images
 */

$.preloadImages = function () {
  for (var i = 0; i < arguments.length; i++) {
    $('img').attr('src', arguments[i]);
  }
};

$.preloadImages('img/hover-on.png', 'img/hover-off.png');



/*
 * Checking If Images Are Loaded
 */

$('img').load(function () {
  console.log('image load successful');
});



/*
 * Fix Broken Images Automatically
 */

$('img').on('error', function () {
  $(this).prop('src', 'img/broken.png');
});


/*
 * Toggle Classes on Hover
 */
$('.btn').hover(function () {
  $(this).addClass('hover');
  }, function () {
    $(this).removeClass('hover');
  });

// Simpler
$('.btn').hover(function () {
  $(this).toggleClass('hover');
});




/*
 * Stop the Loading of Links
 */

$('a.no-link').click(function (e) {
  e.preventDefault();
});


/*
 * Make Two Divs the Same Height
 */
var $columns = $('.column');
var height = 0;
$columns.each(function () {
  if ($(this).height() > height) {
    height = $(this).height();
  }
});
$columns.height(height);


/*
 * Open External Links in New Tab/Window
 */

$('a[href^="http"]').attr('target','_blank');
$('a[href^="//"]').attr('target','_blank');
$('a[href^="'+window.location.origin+'"]').attr('target','_self');


/*
 * Find Element By Text
 */

var search = $('#search').val();
$('div:not(:contains("'+search+'"))').hide();

