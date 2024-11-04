// https://www.smashingmagazine.com/2018/02/jquery-vue-javascript/
// https://fr.vuejs.org/guide/quick-start.html
// https://css-tricks.com/how-to-build-vue-components-in-a-wordpress-theme/#lets-do-this



const initMainScript = () => {


  /*------------------------------------*\
      VARIABLES
  \*------------------------------------*/

  // Globals
  const header = document.querySelector('.site-header');
  const body = document.body;

  // Dropdowns
  const dropdowns_trigger = document.querySelectorAll('.js-dropdown-trigger > a');

  // Search
  const sec_search = document.querySelector('.sec_search');

  // Modals
  const empty_modal = document.querySelector('#empty_modal');
  const empty_modal_content = empty_modal?.querySelector('.modal_content');
  const modal_trigger = document.querySelectorAll('.js-open-modal');



/*------------------------------------*\
      ???
  \*------------------------------------*/

  // document.querySelectorAll('a').forEach( el => {
  //    const a = new RegExp('/' + window.location.host + '/');
  //    if ( !a.test(this.href)) {
  //       el.setAttribute("target","_blank");
  //    }
  // });



  /*------------------------------------*\
      TARTE AU CITRON
  \*------------------------------------*/

  document.getElementById('tarteaucitronManager').addEventListener('click', e => {
    e.preventDefault()
  })



  /*------------------------------------*\
      OPEN A MODAL WITH SOME PAGE CONTENT
  \*------------------------------------*/
  
    modal_trigger.forEach( el => {

      el.addEventListener('click', event => {

        event.preventDefault();

        // DATAS
        const data = new FormData();
        const ajaxurl = ajax_datas.ajaxUrl;
        data.set('nonce', ajax_datas.nonce);
        data.set('action', 'load_popin');
        data.set('type', el.getAttribute('data-type'));

        if( el.getAttribute('data-type') === 'pdf') {
          data.set('type', el.getAttribute('data-type'));
          data.set('this_url', el.getAttribute('data-src'));
        }
        else {
          data.set('type', 'page_content' );
          data.set('this_url', el.getAttribute('href'));
        }
        console.log('data', data)
        
        fetch(ajaxurl, {
          method: 'POST',
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
              'Cache-Control': 'no-cache',
          },
          body: new URLSearchParams(data),
        })
        .then(response => response.json())
        .then(body => {
        
            if (!body.success) {
                return;
            }
            empty_modal.classList.add('open');
            empty_modal_content.innerHTML = body.data;

        });

      });

    });







  /*------------------------------------*\
      MODALS
  \*------------------------------------*/


  // $('.js-newsletter-trigger a').on('click', function(event) {
  //   event.preventDefault();

  //   $('.modal-newsletter').show();
  //   body.classList.add('no-scroll');
  // });

  // $('.js-sharebymail').on('click', function(event) {
  //   event.preventDefault();

  //   $('.modal-sharebymail').show();
  //   body.classList.add('no-scroll');
  // });


  // $('.modal_close').on('click', function(event) {
  //   event.preventDefault();

  //   body.classList.remove('no-scroll');
  //   $('.modal').hide();
  // }); 
 

  // $('.close-dd-btn').on('click', function(event) {
  //   event.preventDefault();

  //   $(this).closest('.e-open').removeClass('e-open');
  // })



  document.addEventListener(
    "click",
    function(event) {

      console.log(event.target)
      if ( event.target.closest('.close-modal-btn') || ! event.target.closest(".modal_inner") ) {
        closeModal()
      }
      if ( ! event.target.matches('.js-dropdown-trigger a') && !event.target.closest(".dropdown-item") ) {
        closeDropdown()
      }
    },
    false
  )
  
  function closeModal() {
    empty_modal.classList.remove('open');
  }
  function closeDropdown() {
    document.querySelectorAll('.e-open').forEach( el => el.classList.remove('e-open') );
  }

 
  /*------------------------------------*\
      DROPDOWNS
  \*------------------------------------*/

  dropdowns_trigger.forEach( el => {

    el.addEventListener('click', event => {

      if( ! el.parentNode.classList.contains('direct-link') ) {

        event.preventDefault();

        const dropdowns_container = el.parentNode

        if( dropdowns_container.classList.contains('e-open') ) {
        
          if( dropdowns_container.classList.contains('e-open') ) {
            dropdowns_container.classList.remove('e-open');
            body.classList.remove('no-scroll');
          }
          else {
            dropdowns_container.classList.remove('e-open');
            dropdowns_container.classList.add('e-open');
            body.classList.add('no-scroll');
          }
        }
        else {
          dropdowns_container.classList.add('e-open');
          body.classList.add('no-scroll');
        }
      }

    });
  })







  /*------------------------------------*\
      STICKY MENU
  \*------------------------------------*/

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
      else if ( st < 700 ) {
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






  /*------------------------------------*\
      VALIDATION
  \*------------------------------------*/

  // jQuery("#contact").validate({
  //   rules: {
  //     contname: "required",
  //     contfirtname: "required",
  //     title: "required",
  //     contemail: {
  //       required: true,
  //       email: true
  //     },
  //     contemail2: {
  //       required: true,
  //       equalTo: "#contemail",
  //     },
  //     check: {
  //       required: true,
  //        range:[4,4]
  //     },
  //   }
  // });

  // jQuery.extend(jQuery.validator.messages, {
  //   minlength: 'Merci de saisir un numéro à 10 chiffres',
  //   maxlength: 'Merci de saisir un numéro à 10 chiffres',
  //   number: 'Merci de saisir un numéro à 10 chiffres',
  //   required: 'Ce champ est obligatoire',
  //   range: 'Merci de renseigner le chiffre exact ( = 4)',
  //   email: 'Merci de renseigner un mail valide',
  //   equalTo: 'Merci de saisir le même email'
  // });


}


document.addEventListener('DOMContentLoaded', initMainScript());






