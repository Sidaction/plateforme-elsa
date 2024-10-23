<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
//@ini_set( 'max_execution_time', '300' );

global $gema75_ril_frontend;

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

// Check that the class exists before trying to use it
if (class_exists('Gema75_Read_It_Later_Frontend_User')) {
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
                    
                        $content = ' <div class="bookmark">  <a href="#" class="removeFromRILButton" data-readitlater-id="'. $post->ID .'" alt="'. $gema75_read_it_later->remove_from_readitlater_text .'" title="'. $gema75_read_it_later->remove_from_readitlater_text  .'"><img src="'. get_template_directory_uri() . '/assets/img/book_full.png" alt="Cette ressource est déjà dans votre sélection. Cliquer pour la retirer de la sélection" title="Cette ressource est déjà dans votre sélection. Cliquer pour la retirer de la sélection"></a></div> ' ;
                    
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
}


/**
 * ENQUEUE STYLES & SCRIPTS
 *
 * Use any number above 10 for priority as the default is 10 
 * any number after 10 will load after
 */

// if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
// function my_jquery_enqueue() {
//    wp_deregister_script('jquery');
//    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
//    wp_enqueue_script('jquery');
// }


function remove_mycred() {
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
    wp_enqueue_style( 'elsa-style', get_stylesheet_directory_uri() . '/assets/style.css' );

    wp_enqueue_script('vue', 'https://unpkg.com/vue@3/dist/vue.global.js', null, null, true); // change to vue.min.js for production
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/main.js', array('vue', 'jquery'), null, true);
    wp_enqueue_script('slider', get_template_directory_uri() . '/assets/js/slider.js', null, null, true);

    wp_localize_script( 'elsa-scripts', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
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








if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2592000)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp



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




/*
 * Variable for number of posts in RiL
 */

if( get_current_user_id() > 0 ) {
  $userid = get_current_user_id();
  $user_readitlater_list = get_option('gema75_readitlater_for_user_id_'.$userid);
}
else {
  //non logged in users
  $user_readitlater_list = $gema75_ril_frontend->get_ril_non_logged_in(); 
}




/*
 * Add Selection Item in top menu
 */

add_filter('wp_nav_menu_items','add_selection_item_to_menu', 10, 2);
function add_selection_item_to_menu( $items, $args ) {

    global $gema75_ril_frontend;

    //logged in users
    if( get_current_user_id() > 0 ) {
      $userid = get_current_user_id();
      $user_readitlater_list = get_option('gema75_readitlater_for_user_id_'.$userid);
    }
    else {
      //non logged in users
      $user_readitlater_list = $gema75_ril_frontend->get_ril_non_logged_in(); 
    }

    if( is_array($user_readitlater_list ) ) {
        $bookmark_posts = count($user_readitlater_list['posts_in_ril']);
    }
    else {
        $bookmark_posts = 0;
    }

    if( $args->theme_location == 'secondary' )
        return $items.'<li id="menu-item-7922" class="item-selection menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-7794 current_page_item menu-item-7922"><a href="/ma-selection/">Ma sélection</a><span class="gema75_wc_wc_count_badge">' . $bookmark_posts . '</span></li>';

    return $items;
}



   function theme_addrole() {

        global $wp_roles;
        
        remove_role( 'partenaire');

        add_role( 'partenaire', 'Compte partenaire',
            array(
            'read' => true,
            'level_0' => 1,
            ) 
        );  
        
        // ajout de l'acces à la partie privée
        $part = get_role( 'partenaire' );
        $part->add_cap( 'edit_pending_parts' );
        $part->add_cap( 'edit_parts' );
        $part->add_cap( 'manage_parts' );
        $part->add_cap( 'edit_pending_conts' );
        $part->add_cap( 'edit_conts' );
        $part->add_cap( 'manage_conts' );
        $part->add_cap( 'publish_conts' );
        $part->add_cap('upload_files');


        // ajout de la bibliotheque media aux contributors
        $contributor = get_role( 'contributor' );
        //$contributor->add_cap('upload_files');


        // ajouter aux administrateurs et éditeurs l'accès à la partie privée
        $administrator = get_role( 'administrator' );
        // $administrator->add_cap( 'access_espace_partenaire' );
        // $administrator->add_cap( 'publish_parts' );
        // $administrator->add_cap( 'edit_parts' );
        // $administrator->add_cap( 'edit_others_parts' );
        // $administrator->add_cap( 'delete_parts' );
        // $administrator->add_cap( 'delete_others_parts' );
        // $administrator->add_cap( 'read_private_parts' );
        // $administrator->add_cap( 'manage_parts' );
        // $administrator->add_cap( 'publish_conts' );
        // $administrator->add_cap( 'edit_conts' );
        // $administrator->add_cap( 'edit_others_conts' );
        // $administrator->add_cap( 'delete_conts' );
        // $administrator->add_cap( 'delete_others_conts' );
        // $administrator->add_cap( 'read_private_conts' );
        // $administrator->add_cap( 'manage_conts' );
        // $administrator->add_cap( 'manage_exports' );



        $editor = get_role( 'editor' );
        // $editor->add_cap( 'access_espace_partenaire' );
        // $editor->add_cap( 'publish_parts' );
        // $editor->add_cap( 'edit_parts' );
        // $editor->add_cap( 'edit_others_parts' );
        // $editor->add_cap( 'delete_parts' );
        // $editor->add_cap( 'delete_others_parts' );
        // $editor->add_cap( 'read_private_parts' );
        // $editor->add_cap( 'manage_parts' );
        // $editor->add_cap( 'publish_conts' );
        // $editor->add_cap( 'edit_conts' );
        // $editor->add_cap( 'edit_others_conts' );
        // $editor->add_cap( 'delete_conts' );
        // $editor->add_cap( 'delete_others_conts' );
        // $editor->add_cap( 'read_private_conts' );
        // $editor->add_cap( 'manage_conts' );
        // $editor->add_cap( 'manage_exports' );



    }  

    //add_action( 'init', 'theme_addrole' );  

