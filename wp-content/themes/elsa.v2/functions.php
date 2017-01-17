<?php



require_once('__core/themeManager.php' );
$cnSite = new themeManager();


/**
 * ENQUEUE STYLES & SCRIPTS
 */

function bourron_scripts() {
    wp_enqueue_style( 'elsa-style', get_stylesheet_uri() );

    wp_enqueue_script( 'elsa-scripts', get_stylesheet_directory_uri() . '/_js/all.js', array( 'jquery' ), '1.0.0', true );
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'bourron_scripts' );

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
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

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


