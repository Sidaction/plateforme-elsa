<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
//@ini_set( 'max_execution_time', '300' );

require_once('__core/themeManager.php' );
$cnSite = new themeManager();



function change_post_menu_label() {
    global $menu;
    global $submenu;
    $submenu['edit.php'][15][0] = 'Thématiques'; // Change name for categories
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );





/*
 * Load filtred associations with AJAX
 */

add_action("wp_ajax_load_assos", "load_assos");
add_action("wp_ajax_nopriv_load_assos", "load_assos");

function load_assos() {

    $select_val = $_REQUEST["select_val"];
    $select_name = $_REQUEST["select_name"];

    $args = array(
        'post_type' => array('structure'), 
        'posts_per_page' => -1, 
        'orderby' => 'title', 
        'order' => 'ASC',
        'type_structure' => 'partenaires-elsa-associations-du-reseau-elsa'
    );
    $args[ $select_name ] = $select_val;

    $_SESSION['argstructures'] = $args;

    ob_start();
    ?>

        <ul class="no-bullets">

          <?php $wp_query = new WP_Query(); $wp_query->query($args); ?>
          
          <?php if ($wp_query->have_posts()) : ?> 
          
            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
          
                $email = get_post_meta($post->ID, 'email', true);
                $link = get_post_meta($post->ID, 'link', true);

                set_query_var( 'email', $email );
                set_query_var( 'link', $link );
                set_query_var( 'cnSite', $cnSite );

                get_template_part('template-parts/parts/part', 'listitem-assos');

            endwhile; wp_reset_query(); wp_reset_postdata(); $args=null; 

            else : ?>

            <p>Désolé, il n'y a aucune association dans ce pays. </p>
        <?php endif; ?>
        </ul>

  <?php

  $content = ob_get_clean();

  echo $content;
  die();
}





/*
 * Load xx media per page with AJAX
 */

add_action("wp_ajax_load_medias", "load_medias");
add_action("wp_ajax_nopriv_load_medias", "load_medias");

function load_medias() {

    $posts_per_page = $_REQUEST["posts_per_page"];

    $args = array(
        'posts_per_page' => $posts_per_page,
        'post_type' => array('post', 'contenu'),
        'format' => array('video', 'diaporama', 'audio'),
        'post_status' => 'publish',
        'paged' => get_query_var( 'paged' )
    );

    ob_start();
    ?>

        <?php $the_query = new WP_Query( $args ); ?>
          
          <?php if ($the_query->have_posts()) : ?> 
            <?php $i = 0; ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post(); 
          
                set_query_var( 'type', 'media' );
                set_query_var( 'cnSite', $cnSite );
                set_query_var( 'ref', 'media' ); 

                if ( $i % 2 == 0 ) : ?>
                    <div class="m-4col m-clearfix">

                <?php else : ?>
                    <div class="m-4col">

                <?php endif; ?>
                        <?php get_template_part('template-parts/parts/part', 'bloc'); ?>
                    </div>

                <?php $i++; 

            endwhile; wp_reset_query(); wp_reset_postdata(); $args=null; 

            else : ?>

            <p>Désolé, il n'y a aucune association dans ce pays. </p>
        <?php endif; ?>

  <?php

  $content = ob_get_clean();

  echo $content;
  die();
}



/**
 * ENQUEUE STYLES & SCRIPTS
 *
 */


function remove_mycred() {
    wp_dequeue_script( 'jquery');
    wp_deregister_script( 'jquery');   
    wp_dequeue_script('jquery-position');
    wp_deregister_script( 'jquery-position' );
    wp_dequeue_style('SearchAutocomplete-theme');
    wp_dequeue_style('contact-form-7');
}
if (!is_admin()) add_action( 'wp_enqueue_scripts', 'remove_mycred', 10 );


function remove_from_footer() {
    wp_dequeue_script('tabslideout-jquery');
    wp_dequeue_script('owlcarousel-jquery');
    wp_dequeue_style('tabslideout-css');
    wp_dequeue_style('owlcarousel-css');
    wp_dequeue_style('owlcarousel-theme-css');
    wp_dequeue_style('gema75-style-css');
}
if (!is_admin()) add_action( 'wp_footer', 'remove_from_footer', 10 );


function remove_from_init() {
    wp_dequeue_style('validate-engine-css');

}
if (!is_admin()) add_action( 'init', 'remove_from_init', 10 );


function my_custom_scripts() {

    // Main Style File
    wp_enqueue_style( 'elsa-style', get_stylesheet_directory_uri() . '/assets/style.css' );
    wp_dequeue_style( 'wp-block-library' );

    // VUE JS for tests
    //wp_enqueue_script('vue', 'https://unpkg.com/vue@3/dist/vue.global.js', null, null, true); // change to vue.min.js for production


    // Main Script File
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/main.min.js', array(), null, true);

    wp_add_inline_script( 'main', 'const ajax_datas = ' . json_encode( array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'handle_contents_loading' )
    ) ), 'before' );


    // Search Script File
    wp_register_script('search', get_template_directory_uri() . '/assets/js/search.js', array(), null, true);
    

    // Validation 
    wp_register_script('validation', get_template_directory_uri() . '/assets/js/validation.js', array(), null, true);


    // Swiper stuffs
    wp_register_style('swiper-styles', get_template_directory_uri() . '/assets/swiper/swiper-bundle.min.css', null);
    wp_register_script('swiper', get_template_directory_uri() . '/assets/swiper/swiper-bundle.min.js', null, true);
    wp_register_script('slider', get_template_directory_uri() . '/assets/js/slider.js', array('swiper'), null, true);


    // Tarte Au Citron stuffs
    wp_register_script('tac-src', get_template_directory_uri() . '/assets/js/tarteaucitron/tarteaucitron.js', null, array( 'strategy'  => 'defer', 'in_footer' => true ));
    wp_register_script('tac-init', get_template_directory_uri() . '/assets/js/tac.js', array('tac-src'), null, array( 'strategy'  => 'defer', 'in_footer' => true ));

}
add_action( 'wp_enqueue_scripts', 'my_custom_scripts', 100 );



remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' ); 




/**
 * IMAGES SIZES
 */

add_image_size( 'archives_square', 500, 500, array( 'center', 'center' ) );
add_image_size( 'post_thumb', 500, 9999 );
add_image_size( 'media_thumb', 500, 9999 );
add_image_size( 'small', 300, 9999 );
add_image_size( 'diaporama', 1024, 9999 );
add_image_size( 'cover', 1500, 500, array( 'center', 'center' ) );



/**
 * CHAR LIMITS
 */

function custom_excerpt_length( $length ) {
    return 17;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function limit_char($string, $limit = 50, $end = ' (...)'){
    print_r( substr($string,0,$limit) . $end );
}

function limit_words($string, $word_limit = 10){
    $words = explode(" ",$string);
    if( count($words)>$word_limit ){
        $output = implode(" ",array_splice($words, 0, $word_limit));
        $output .= ' (...)';
        print_r( $output );

    }
    else{
       print_r( $string );
    }
}



/**
 * Back-end creation of new candidate post
 * @uses Advanced Custom Fields Pro
 */
add_filter('acf/pre_save_post' , 'tsm_do_pre_save_post' );
function tsm_do_pre_save_post( $post_id ) {

    // Bail if not logged in or not able to post
    if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
        return;
    }

    // check if this is to be a new post
    if( $post_id != 'new_post' ) {
        return $post_id;
    }

    // Create a new post
    $post = array(
        'post_type'     => 'post', // Your post type ( post, page, custom post type )
        'post_status'   => 'draft', // (publish, draft, private, etc.)
        'post_title'    => true,
    );

    // insert the post
    $post_id = wp_insert_post( $post );

    // Save the fields to the post
    do_action( 'acf/save_post' , $post_id );
    return $post_id;
}



/**
 * REGISTER MENU & ADD WALKER
 */

class Menu_With_Description extends Walker_Nav_Menu {

    function description_walker() {
        $this->templateURL = get_theme_root() . '/' . get_template() . '/';
    }
    
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        $class_names = $value = '';
        $description = $item->description;

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="main_nav_item ' . esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a class=""'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= '<div class="dropdown-item dd-'. $description .'">';

        ob_start();
        get_template_part( 'template-parts/dropdowns/dropdown', $description);
        $item_output .= ob_get_contents();
        ob_end_clean();
        
        $item_output .=  '</div>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

register_nav_menus( array(
    'primary' => esc_html__( 'Menu principal à gauche', 'elsa' ),
    'headright' => esc_html__( 'Menu principal à droite', 'elsa' ),
    'secondary' => esc_html__( 'Menu secondaire (top)', 'elsa' ),
    'footer' => esc_html__( 'Menu du pied de page', 'elsa' ),
    'bottom' => esc_html__( 'Menu tout en bas.... (mentions légales...)', 'elsa' ),
) );




function wp_get_attachment( $attachment_id ) {

    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}






add_action('wp_ajax_handle_contents_loading','handle_contents_loading');
add_action( 'wp_ajax_nopriv_handle_contents_loading', 'handle_contents_loading' );
function handle_contents_loading() {

     // Vérification de sécurité
    if( 
        ! isset( $_REQUEST['nonce'] ) or 
        ! wp_verify_nonce( $_REQUEST['nonce'], 'handle_contents_loading' ) 
    ) {
        wp_send_json_error( "Vous n’avez pas l’autorisation d’effectuer cette action.", 403 );
    }
    
    ob_start();

        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 20,
            'offset'            => $_REQUEST['offset'],
            'post_status'       => 'publish'
        );

        $args['s'] = $_REQUEST['keyword'];	
        add_filter( 'posts_search', 'cn_tags_search', 500, 2 );
        

        // SI FORMAT
        if( isset($_REQUEST['format']) ) {

            if( $_REQUEST['format'] === 'outils') {
                $args['meta_key'] = 'outil';
                $args['meta_value'] = '1';
            }
            else {
                $args['format'] = $_REQUEST['format'];
            }
        } 
        else {
            $args['format'] = '';
        }


        // SI BOITES A OUTILS
        $args['boiteoutils'] = (isset($_REQUEST['boites']))?$_REQUEST['boites']:'';


        // SI CATEGORY
        $args['category_name'] = (isset($_REQUEST['thematique']))?$_REQUEST['thematique']:'';
        $args['pays_assoc'] = (isset($_REQUEST['pays']))?$_REQUEST['pays']:'';


        // SI PERIODE  IS SET
        if( isset($_REQUEST['period']) ) {

            $period = $_REQUEST['period'];
            switch($period){
                case '1semaine':
                    $after='1 week ago';
                break;
                case '1mois':
                    $after='1 month ago';
                break;
                case '3mois':
                    $after='3 months ago';
                break;
                case '6mois':
                    $after='3 months ago';
                break;
                case '1an':
                    $after='1 year ago';
                break;
                default:
                    $after='50 years ago';
                break;
            }
            $args['date_query'] = array(
                array(
                    'column'        => 'post_date_gmt',
                    'after'         => $after,
                    'before'        => 'today',
                    'inclusive'     => true,
                )
            );
        }

        $_SESSION['args'] = $args;

        $wp_query = new WP_Query();
        $wp_query->query($args); ?>
        
        <div id="foundPosts" style="display:none" data-posts="<?php echo $wp_query->found_posts; ?>"></div>

        <?php if ( $wp_query->have_posts() ) : ?>

            <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                <?php get_template_part('template-parts/parts/part', 'ressource'); ?>

            <?php endwhile; ?>
        <?php else : ?>
            <p>Désolé, il n'y a pas de résultats sur les critères sélectionnés</p>
        <?php endif;


    $content = ob_get_clean();
    wp_send_json_success( $content );
    wp_die();
}




/*
 * GEt & Display content with ajax
 */

 add_action("wp_ajax_load_popin", "load_popin");
 add_action("wp_ajax_nopriv_load_popin", "load_popin");
 
 function load_popin() {
 
    if( $_REQUEST["type"] === 'pdf' ) : ?>

        <iframe id="pdf-popin-iframe" style="width: 100%; height: 100%; border: none;" src="<?php echo $_REQUEST["this_url"] ?>" title="Document PDF"></iframe>
    
    <?php else : 

    $the_slug = $_REQUEST["this_url"];
 
    $args = array(
         'name'  => $the_slug,
         'post_type' => array('post', 'page'),
         'post_status' => 'publish',
    );
    $search = new WP_Query( $args );
 
    ob_start(); ?>
 
    <div class="page_content">    
         <?php if ( $search->have_posts() ) : ?>
             <?php while ( $search->have_posts() ) : $search->the_post(); ?>              
                 <h1 class="h1"> <?php the_title(); ?> </h1>
                 <?php the_content(); ?>
             <?php endwhile; endif; ?>
         <?php wp_reset_postdata(); ?>
    </div>
 

    <?php endif;

    $content = ob_get_clean();
    wp_send_json_success( $content );
    wp_die();
}



function add_defer_attribute($tag, $handle) {
    if ( 'main' !== $handle && 'search' !== $handle  )
      return $tag;
    return str_replace( ' src', ' defer="defer" src', $tag );
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);



