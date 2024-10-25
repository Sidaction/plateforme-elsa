



const init = () => {
    console.log('search')

    const sec_search_results_wrapper = document.querySelector('#search-results_wrapper');
    const search_txt_form = document.querySelector('#search_txt_form')
    const filter_format_btns = document.querySelector('.filter-format input')
    const page = document.querySelector('main')


    const load_contents = async (event) => {
        event.preventDefault();
        console.log('load_contents: ', event)
        page.classList.add('loading')

        const data = new FormData();
        data.append('_ajax_nonce', ajax_datas.nonce);
        data.append('action', 'wp_ajax_handle_contents_loading');

        console.log('load_contents: ',data)


        await fetch(ajax_datas.ajaxUrl, {
            method: 'POST',
            credentials: 'same-origin',
            body: data
        })
            .then((response) => response.json())
            .then((data) => {
                console.log('data: ', data)
                if (data) {
                    sec_search_results_wrapper.html = data;
                }
                page.classList.remove('loading')

            })
            .catch((error) => {
                console.log('[WP Pageviews Plugin]');
                console.error(error);
            });



    }



    search_txt_form.addEventListener('submit', event => load_contents(event) )



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


