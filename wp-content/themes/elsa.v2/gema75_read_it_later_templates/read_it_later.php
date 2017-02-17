<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global  $post , $gema75_ril_frontend , $gema75_read_it_later, $cnSite;

$results = array();

//remove the "add to RIL" action
remove_action( 'the_content', array( $gema75_ril_frontend, 'show_readitlater_after_content' ),30 );
remove_action( 'the_content', array( $gema75_ril_frontend, 'show_read_it_later_after_title' ),30 );


//logged in users
if(get_current_user_id() > 0){
  $userid= get_current_user_id();
  $user_readitlater_list = get_option('gema75_readitlater_for_user_id_'.$userid);
}else{
  //non logged in users
  $user_readitlater_list = $gema75_ril_frontend->get_ril_non_logged_in(); 
}


if(isset($user_readitlater_list['posts_in_ril']) && count($user_readitlater_list['posts_in_ril'])>=1){ ?>

  <ul class="no-bullets">
  <?php foreach($user_readitlater_list['posts_in_ril'] as $single_post){ 
  
    $post_id = absint( $single_post['id'] );

    if ( $post_id ) {

      $results[] = $post->ID; 

      $post = get_post( $post_id );
      setup_postdata( $post );

      $cat = cnLib::get_terms_withoutlink($post->ID, 'category');
      $pays = cnLib::get_main_term_slug($post->ID, 'pays_assoc');
      $main_author = get_post_meta($post->ID, 'first_org', true);
      $format = cnLib::get_main_term_slug($post->ID, 'format');

      set_query_var( 'cat', $cat );
      set_query_var( 'pays', $pays );
      set_query_var( 'main_author', $main_author );
      set_query_var( 'format', $format );
      set_query_var( 'cnSite', $cnSite );
      set_query_var( 'gema75_read_it_later', $gema75_read_it_later );

      get_template_part('template-parts/parts/part', 'listitem');
     
    }
  }
  
  $_SESSION['results'] = $results;
  $_SESSION['args'] = array();

  var_dump($_SESSION['results']);
  var_dump($_SESSION['args']);

  wp_reset_postdata(); ?>
  
</ul>
<?php }
