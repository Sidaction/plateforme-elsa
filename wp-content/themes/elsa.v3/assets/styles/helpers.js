

/*
 * JS & jQuery Helpers
 * 
 * more here : https://css-tricks.com/snippets/jquery/
 */



// Dom ready

  $(document).ready(function () {
    $("p").text("The DOM is now loaded and can be manipulated.");
  });



// Declare function : http://www.sitepoint.com/5-ways-declare-functions-jquery/

  jQuery.fn.extend({
      zigzag: function () {
          var text = $(this).text();
          var zigzagText = '';
          var toggle = true; //lower/uppper toggle
        $.each(text, function(i, nome) {
          zigzagText += (toggle) ? nome.toUpperCase() : nome.toLowerCase();
          toggle = (toggle) ? false : true;
        });
    return zigzagText;
      }
  });

  console.log($('#tagline').zigzag());
  //output: #1 jQuErY BlOg fOr yOuR DaIlY NeWs, PlUgInS, tUtS/TiPs & cOdE SnIpPeTs.

  //chained example
  console.log($('#tagline').zigzag().toLowerCase());
  //output: #1 jquery blog for your daily news, plugins, tuts/tips & code snippets.




/* Tiny jQuery Plugin
 * by Chris Goodchild
 * 
 * usage 
    $('div.test').exists(function() {
      this.append('<p>I exist!</p>');
    });
 */

  $.fn.exists = function(callback) {
    var args = [].slice.call(arguments, 1);

    if (this.length) {
      callback.call(this, args);
    }

    return this;
  };




