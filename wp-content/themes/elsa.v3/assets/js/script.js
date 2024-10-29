

// https://www.smashingmagazine.com/2018/02/jquery-vue-javascript/
// https://fr.vuejs.org/guide/quick-start.html
// https://css-tricks.com/how-to-build-vue-components-in-a-wordpress-theme/#lets-do-this



jQuery(document).ready(function($){


  var dropdowns_trigger = $('.js-dropdown-trigger > a');
  const header = document.querySelector('.site-header');
  const sec_search = document.querySelector('.sec_search');


  const empty_modal = $('#empty_modal');
  const empty_modal_content = empty_modal.find('.modal_content');

  const popin = $('.js-popin');


  $('a').each(function() {
     var a = new RegExp('/' + window.location.host + '/');
     if (!a.test(this.href)) {
        $(this).attr("target","_blank");
     }
  });

  document.getElementById('tarteaucitronManager').addEventListener('click', function(e) {
    e.preventDefault()
  })



/*
 * Popins
 */

  if( popin.length > 0 ) {
  
    popin.click(function(event){
      event.preventDefault();

      var this_url = $(this).attr('href');

      $.ajax({
        url : myAjax.ajaxurl,
        method : 'post',
        data : {
          action: "load_popin",
          this_url : this_url
        },
  
        beforeSend: function( response ) {
          empty_modal.show();
        },
        success : function( response ) {
          empty_modal_content.html( response );
          // $('#loading-msg').hide();
        },

        error : function( data ) { // en cas d'échec
          // Sinon je traite l'erreur
          //console.log( 'Erreur…' );
        }

      });

    });
  }





/*
 * VALIDATE 
 */

  jQuery("#contact").validate({
      rules: {
        contname: "required",
        contfirtname: "required",
        title: "required",
        contemail: {
          required: true,
          email: true
        },
        contemail2: {
          required: true,
          equalTo: "#contemail",
        },
        check: {
          required: true,
           range:[4,4]
        },
    }
  });
  
  jQuery.extend(jQuery.validator.messages, {
    minlength: 'Merci de saisir un numéro à 10 chiffres',
    maxlength: 'Merci de saisir un numéro à 10 chiffres',
    number: 'Merci de saisir un numéro à 10 chiffres',
    required: 'Ce champ est obligatoire',
    range: 'Merci de renseigner le chiffre exact ( = 4)',
    email: 'Merci de renseigner un mail valide',
    equalTo: 'Merci de saisir le même email'
  });




  /*
   * STICKY MENU
   */

  var main_nav_trigger = $('.main_nav-trigger');
  main_nav_trigger.on('click', function() {
    $('.main-navigation').toggle();
    $('.top-nav-outer').toggle();
    $(this).toggleClass('e-open');
    $('body').toggleClass('no-scroll');

    if( dropdowns_trigger.hasClass('e-open') ) {
      dropdowns_trigger.removeClass('e-open');
      $('body').removeClass('no-scroll');
      $('#site-content').removeClass('dd-open');
    }
  });




  /*
   * MODALS
   */

  $('.js-newsletter-trigger a').on('click', function(event) {
    event.preventDefault();

    $('.modal-newsletter').show();
    $('body').addClass('no-scroll');
  });

  $('.js-sharebymail').on('click', function(event) {
    event.preventDefault();

    $('.modal-sharebymail').show();
    $('body').addClass('no-scroll');
  });


  $('.modal_close').on('click', function(event) {
    event.preventDefault();

    $('body').removeClass('no-scroll');
    $('.modal').hide();
  }); 
 

  $('.close-dd-btn').on('click', function(event) {
    event.preventDefault();

    $(this).closest('.e-open').removeClass('e-open');
  })


 
  /*
   * DROPDOWNS
   */

  dropdowns_trigger.on('click', function(event) {

    if( !$(this).parent().hasClass('direct-link') ) {

      event.preventDefault();

      var header = $('.site-header');
      var viewportHeight = $(window).height();
      var headerHeight = header.outerHeight();
      var dropdowns_container = $(this).parent()

      var dropdownHeight = viewportHeight - headerHeight;
      var dropdownHeightPourcentage = ( dropdownHeight * 100 ) / viewportHeight - 12;

      if( dropdowns_container.hasClass('e-open') ) {
      
        if( dropdowns_container.hasClass('e-open') ) {
          dropdowns_container.removeClass('e-open');
          $('#site-content').removeClass('dd-open');

          if( main_nav_trigger.hasClass('e-open') ) {

          }
          else {
            $('body').removeClass('no-scroll');
          }
        }
        else {
          dropdowns_container.removeClass('e-open');
          dropdowns_container.addClass('e-open');
          $('#site-content').addClass('dd-open');
          $('body').addClass('no-scroll');
          dropdowns_container.siblings('.dropdown-item').css('max-height', dropdownHeightPourcentage + 'vh');
        }
      }
      else {
        dropdowns_container.addClass('e-open');
        $('#site-content').addClass('dd-open');
        $('body').addClass('no-scroll');
        dropdowns_container.siblings('.dropdown-item').css('max-height', dropdownHeightPourcentage + 'vh');
      }
    }

  });
 







  let didScroll;
  let lastScrollTop = 0;
  let delta = 20;

  const documentIsScrolling = function () {
      didScroll = true;

      setInterval(function() {
          if (didScroll) {
              handleScrollForMenu();
              didScroll = false;
          }
      }, 250);
  }

  const handleScrollForMenu = function () {
      var st = window.scrollY;

      // Make sure they scroll more than delta
      if (Math.abs(lastScrollTop - st) <= delta)
          return;
      
      if ( st < 100 ) {
          //console.log('documentIsScrolling BACKTOTHETOP');
          header.classList.remove('out');
          header.classList.add('at-top');
      }
      else if ( st < 300 ) {
        sec_search.classList.remove('stickyfied');
      }
      else if (st > lastScrollTop ){
          //console.log('documentIsScrolling DOWN');
          header.classList.add('out');
          header.classList.remove('at-top');

          const nbr = document.querySelector('#foundPosts') ? document.querySelector('#foundPosts').getAttribute('data-posts') : 0;

          if(nbr > 10) {
            sec_search.classList.add('stickyfied');
          }
      } 
      else {
          //console.log('documentIsScrolling UP');
          header.classList.remove('out');
          header.classList.remove('at-top');
      }

      lastScrollTop = st;
  }

  document.addEventListener("scroll", documentIsScrolling, false);


});





