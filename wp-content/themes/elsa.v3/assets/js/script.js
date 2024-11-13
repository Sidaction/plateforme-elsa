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


  const mobileCheck = () => {
    let check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
  };

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
 

  document.querySelectorAll('.close-dd-btn').forEach( el => {
    el.addEventListener('click', function(event) {
      event.preventDefault();
      el.closest('.e-open').classList.remove('e-open');
    })
  })



  document.addEventListener(
    "click",
    function(event) {

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
    body.classList.remove('no-scroll');
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
          dropdowns_container.classList.remove('e-open');
          body.classList.remove('no-scroll');
        }
        else {
          const dropdowns_container_open = document.querySelector('.e-open')
          if( dropdowns_container_open ) dropdowns_container_open.classList.remove('e-open');

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
        if (mobileCheck) sec_search?.classList.remove('stickyfied');
      }
      else if (st > lastScrollTop ){
          //console.log('documentIsScrolling DOWN');
          header.classList.add('out');
          header.classList.remove('at-top');

          const nbr = document.querySelector('#foundPosts') ? document.querySelector('#foundPosts').getAttribute('data-posts') : 0;

          if(nbr > 10) {
            if (mobileCheck) sec_search?.classList.add('stickyfied');
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




}


document.addEventListener('DOMContentLoaded', initMainScript());






