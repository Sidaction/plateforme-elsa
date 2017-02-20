<?php



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
 * GEt & Display content with ajax
 */

add_action("wp_ajax_load_popin", "load_popin");
add_action("wp_ajax_nopriv_load_popin", "load_popin");

function load_popin() {

    $the_slug = $_REQUEST["this_url"];

    $args = array(
        'name'  => $the_slug,
        'post_type' => array('post', 'page'),
        'post_status' => 'publish',
    );
    $search = new WP_Query( $args );

    ob_start();

    ?>

    <div class="page_content">    
    <?php if ( $search->have_posts() ) : ?>

        <?php while ( $search->have_posts() ) : $search->the_post(); ?>              
            <h1 class="h1"> <?php the_title(); ?> </h1>
            <?php the_content(); ?>
    
        <?php endwhile; endif; ?>

    <?php wp_reset_postdata(); ?>

    </div>

  <?php

  $content = ob_get_clean();

  echo $content;
  die();

}


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





/*
 * Custom Bookmarks btn. Based on ReadItLater plugin.
 */

class Bookmarks extends Gema75_Read_It_Later_Frontend_User {

        //shows "add to readitlater" link/button on single product page
        function show_bookmark_btn(){

            global $post , $gema75_read_it_later ;
            
            $content = "";

            //if logged in 
            if( is_user_logged_in() ){
                
                    $current_user_id = get_current_user_id();
                    
                    $current_user_readitlater_list = get_option('gema75_readitlater_for_user_id_'.$current_user_id);
                    
                    if(isset($current_user_readitlater_list['posts_in_ril'][$post->ID])){
                    
                        $content = ' <div class="bookmark">  <a href="#" class="removeFromRILButton" data-readitlater-id="'. $post->ID .'" alt="'. $gema75_read_it_later->remove_from_readitlater_text .'" title="'. $gema75_read_it_later->remove_from_readitlater_text  .'"><img src="'. get_template_directory_uri() . '/_img/book_full.png" alt="Cette ressource est déjà dans votre sélection. Cliquer pour la retirer de la sélection" title="Cette ressource est déjà dans votre sélection. Cliquer pour la retirer de la sélection"></a></div> ' ;
                    
                    }else{

                        $content = ' <div class="bookmark">  <a href="#" title="Ajouter cette ressource à la sélection" alt="Ajouter cette ressource à la sélection"><span class="gema75_read_it_later_text addToReadItLaterButton" data-readitlater-id="'.$post->ID.'"> &nbsp;</span></a>  </div>' ;
                        
                    }
                    
                    return $content;

            }   
            
            //Non logged in users
            if( !is_user_logged_in() ){
                
                if(!isset($_SESSION['gema75_ril_post_array'][$post->ID])){

                    $content =  ' <div class="bookmark"> <a href="#" title="Cette ressource est déjà ajoutée à la sélection" alt="Cette ressource est déjà ajoutée à la sélection"><span class="gema75_read_it_later_text addToReadItLaterButton" data-readitlater-id="'.$post->ID.'"> &nbsp; </span></a>  </div>' ;
                
                }else {

                    $content =  ' <div class="bookmark">  <a href="#" title="Ajouter cette ressource à la sélection" alt="Ajouter cette ressource à la sélection"><span class="gema75_read_it_later_text " data-readitlater-id="'.$post->ID.'"> &nbsp; </span></a>  </div>' ;
                    
                }
            
            }           
            
            
            return $content;
        
        }

}

$Bookmarks =  new Bookmarks();



/**
 * ENQUEUE STYLES & SCRIPTS
 */

function elsa_scripts() {
    wp_enqueue_style( 'elsa-style', get_stylesheet_directory_uri() . '/style.min.css' );
    wp_register_script( 'elsa-scripts', get_stylesheet_directory_uri() . '/_js/all.min.js', array( 'jquery' ), '1.0.0', true );
    wp_localize_script( 'elsa-scripts', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

    wp_dequeue_script('jquery-migrate');
    wp_dequeue_script('jquery-position');
    // wp_deregister_script('jquery');
    // wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

    wp_enqueue_script( 'elsa-scripts' );

    wp_dequeue_style('SearchAutocomplete-theme');
    wp_dequeue_style('tabslideout-css');
    wp_dequeue_style('owlcarousel-css');
    wp_dequeue_style('owlcarousel-theme-css');
    wp_dequeue_style('gema75-style-css');
    wp_dequeue_style('contact-form-7');
    wp_dequeue_style('validate-engine-css');
    wp_deregister_style( 'validate-engine-css' );
    
    wp_dequeue_script('tabslideout-jquery');
    //wp_dequeue_script('owlcarousel-jquery');
}
add_action( 'wp_enqueue_scripts', 'elsa_scripts' );

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
        $item_output .= '<a class="js-dropdown-trigger"'. $attributes .'>';
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
    'primary' => esc_html__( 'Menu principal', 'elsa' ),
    'secondary' => esc_html__( 'Menu secondaire (top)', 'elsa' ),
    'footer' => esc_html__( 'Menu du pied de page', 'elsa' ),
    'bottom' => esc_html__( 'Menu tout en bas.... (mentions légales...)', 'elsa' ),
) );






/**
 * From previous theme.
 */
	function tinymce_excerpt_js(){ ?>
	<script type="text/javascript">
	jQuery(document).ready( function () { 
		jQuery("#excerpt").addClass("mceEditor"); 
		if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
		jQuery("#excerpt").wrap( "<div id='editorcontainer'></div>" ); 
		tinyMCE.execCommand("mceAddControl", false, "excerpt");
		}
	}); 
	</script>
	 
	<?php
	}

    add_action( 'admin_head-post.php', 'tinymce_excerpt_js');
    add_action( 'admin_head-post-new.php', 'tinymce_excerpt_js');
    function tinymce_css(){ ?>
        <style type='text/css'>
                    #postexcerpt .inside{margin:0;padding:0;background:#fff;}
                    #postexcerpt .inside p{padding:0px 0px 5px 10px;}
                    #postexcerpt #excerpteditorcontainer { border-style: solid; padding: 0; }
        </style>
    <?php
	}
    add_action( 'admin_head-post.php', 'tinymce_css');
    add_action( 'admin_head-post-new.php', 'tinymce_css');

    function prepareExcerptForEdit($e){
        return nl2br($e);
    }
    add_action( 'excerpt_edit_pre','prepareExcerptForEdit');






/*function to add async to all scripts*/
function js_async_attr($tag){

    # Do not add async to these scripts
    $scripts_to_exclude = array();
     
    foreach($scripts_to_exclude as $exclude_script){
        if(true == strpos($tag, $exclude_script ) )
        return $tag;    
    }

    # Add async to all remaining scripts
    return str_replace( ' src', ' async="async" src', $tag );
}
add_filter( 'script_loader_tag', 'js_async_attr', 10 );

