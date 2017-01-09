<?php



/**
 * Enqueue scripts and styles.
 */
function bourron_scripts() {
    wp_enqueue_style( 'elsa-style', get_stylesheet_uri() );

    wp_enqueue_script( 'elsa-scripts', get_stylesheet_directory_uri() . '/js/all.min.js', array( 'jquery' ), '1.0.0', true );
    
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


