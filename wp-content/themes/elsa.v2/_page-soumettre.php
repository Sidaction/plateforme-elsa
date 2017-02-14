<?php 

/*
 * Page formulaire de soumission d'un document
 * Template Name: Formulaire de soumission de document
 */


 // require('__core/classes/soumettre.php' );
 // $doc = new doc();
 // $args = $doc->get_args();  


// ======================================================================================
// Codes to put on your page template header
// Remember, the above piece of code needs to be placed between <?php and get_header();
// ======================================================================================

/**
 * Add required acf_form_head() function to head of page
 * @uses Advanced Custom Fields Pro
 */
add_action( 'get_header', 'tsm_do_acf_form_head', 1 );
function tsm_do_acf_form_head() {
  // Bail if not logged in or not able to post
  if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
    return;
  }
  acf_form_head();
}

/**
 * Deregister the admin styles outputted when using acf_form
 */
add_action( 'wp_print_styles', 'tsm_deregister_admin_styles', 999 );
function tsm_deregister_admin_styles() {
  // Bail if not logged in or not able to post
  if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
    return;
  }
  wp_deregister_style( 'wp-admin' );
}









 get_header(); 

?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <section id="site-content" class="site-content page">

    <article class="main-content clearfix noback">

      <div class="page_title static_title">
          <div class="wrap row">
              <h1 class="h1 m-6col is-centered text-on-center">
                  <?php the_title();?>
              </h1>  
          </div>     
      </div>

      <div class="page_content clearfix">
        <div class="wrap row">

          <nav class="m-2col page_sidebar">
              <?php the_field('sidebar_content') ?>
          </nav>

          <div class="m-5col m-last">
              <?php the_content();?>

            
                        
                <div class="row">

                  <div class="m-4col m-clearfix">






                <?php 
                // ======================================================================================
                // Codes to put on your content body area
                // ======================================================================================


                // Bail if not logged in or able to post
                  if ( ! ( is_user_logged_in()|| current_user_can('publish_posts') ) ) {
                    echo '<p>You must be a registered author to post.</p>';
                    return;
                  }

                  $new_post = array(
                    'post_id'            => 'new', // Create a new post
                    // PUT IN YOUR OWN FIELD GROUP ID(s)
                    'field_groups'       => array(7822), // Create post field group ID(s)
                    'form'               => true,
                    'html_before_fields' => '',
                    'html_after_fields'  => '',
                    'submit_value'       => 'Submit Post',
                    'updated_message'    => 'Saved!'
                  );
                  acf_form( $new_post );

                ?>



                    
                  </div>                        
                </div>
                
                        


            </div>

     </article>
</section>

<?php endwhile; ?>


<?php get_footer(); ?>