


const init = () => {

    console.log('search')

    /*------------------------------------*\
        VARIABLES
    \*------------------------------------*/

    // ELEMENTS
    const page = document.querySelector('main')
    const sec_search_results_wrapper = document.querySelector('#search-results_wrapper');
    const sec_search_pagination = document.querySelector('.sec_search-pagination');
    const sec_search_more = document.querySelector('.sec_search-more');

    const filter_format_btns = document.querySelectorAll('.filter-format input')
    const found_posts_label = document.querySelector('#foundPostsLabel');

    // UTILS
    let offset = 0;
    let step = 20;
    let format = '';

    // DATAS
    const data = new FormData();
    const ajaxurl = ajax_datas.ajaxUrl;
    data.set('nonce', ajax_datas.nonce);
    data.set('step', step);
    data.set('offset', offset);
    data.set('format', format);



    /*------------------------------------*\
        UTILS FUNCS
    \*------------------------------------*/

    const displayFoundPosts = async () => {
        setTimeout( () => {
            const nbr = document.querySelector('#foundPosts') ? document.querySelector('#foundPosts').getAttribute('data-posts') : 0;
            found_posts_label.innerHTML = nbr;
            console.log('nbr', nbr)
        }, 500)
    }

    const fetchAndDisplayDatas = async ( append = false ) => {

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
                console.log(body);
                return;
            }
        
            if( append ) {
                sec_search_results_wrapper.insertAdjacentHTML('beforeend', body.data); 
            }else {
                sec_search_results_wrapper.innerHTML = body.data; 
            }
        });

    }

    const resetDisplay = async () => {
        data.set('offset', 0);
        data.set('keyword', '');

        page.classList.add('loading')

        fetchAndDisplayDatas().then( () => {
            page.classList.remove('loading')
        });

    }


    /*------------------------------------*\
        LOADING FUNCS
    \*------------------------------------*/

    const load_contents = async (event) => {
        event.preventDefault();
        page.classList.add('loading')
        
        data.set('action', 'handle_contents_loading');
        data.set('keyword',  document.querySelector('input[name=filter_totaltags]').value );
        data.set('offset', offset);

        fetchAndDisplayDatas().then( () => {

            displayFoundPosts();

            sec_search_pagination.classList.add('is-hidden');
            sec_search_more.classList.remove('is-hidden');

            page.classList.remove('loading')
        });

    }

    const load_more_contents = async (event) => {
        event.preventDefault();
        offset += step;

        data.set('offset', offset);

        fetchAndDisplayDatas( true ).then( () => {
            page.classList.remove('loading')
        });

    }


    const filter_format_contents = async (event, el) => {

        console.log(el);
        el.checked = "checked";
        el.classList.add('checked');

        console.log(el.checked);

        let format = el.value;
        data.set('format', format);
        load_contents(event)

    }


    
    /*------------------------------------*\
        TRIGGERS
    \*------------------------------------*/

    const search_txt_form = document.querySelector('#search_txt_form')
    search_txt_form.addEventListener('submit', event => load_contents(event) )

    const load_more_btn = document.querySelector('#load_more')
    load_more_btn.addEventListener('click', event => load_more_contents(event) )

    filter_format_btns.forEach( el => {
        el.addEventListener('click', event => {
            const activeFormat = document.querySelector('input.checked');
            activeFormat.classList.remove('checked')
            filter_format_contents(event, el)
        })
    })
    


        // // XX RESULTS PER PAGE
        // $("#pager1, #pager2").change(function(event){
        //     event.preventDefault();
      
        //     var posts_per_page = $(this).val();
      
        //     $.ajax({
        //       url : myAjax.ajaxurl,
        //       method : 'post',
        //       data : {
        //         action: "load_medias",
        //         posts_per_page : posts_per_page,
        //       },
        
        //       beforeSend: function( response ) {
        //         medias_list.html('Nous recherchons les associations correspondantes...');
        //       },
        //       success : function( response ) {
        //         medias_list.html( response );
        //       },
      
        //       error : function( data ) { // en cas d'échec
        //         // Sinon je traite l'erreur
        //         // console.log( 'Erreur…' );
        //       }
      
        //     });
      
        //   });




}


document.addEventListener('DOMContentLoaded', init());


