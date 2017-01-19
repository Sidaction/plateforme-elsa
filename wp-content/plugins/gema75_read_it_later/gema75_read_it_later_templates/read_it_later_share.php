<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global  $post , $gema75_ril_frontend , $gema75_read_it_later;





//remove the "add to RIL" action
remove_action( 'the_content', array( $gema75_ril_frontend, 'show_readitlater_after_content' ),30 );
remove_action( 'the_content', array( $gema75_ril_frontend, 'show_read_it_later_after_title' ),30 );



//Add the OG:META 
$gema75_ril_frontend->insert_og_meta_in_head();


get_header();



$userid = $wp_query->query_vars['userid'];

$user_readitlater_list = get_option('gema75_readitlater_for_user_id_'.$userid);

if(isset($user_readitlater_list['posts_in_ril']) && count($user_readitlater_list['posts_in_ril'])>=1){

	//echo '<div class="wishlist_content" style="width:80%;margin:0 auto">';
	
	

	foreach($user_readitlater_list['posts_in_ril'] as $single_post){ 
	

		$post_id = absint( $single_post['id'] );

		if ( $post_id ) {

			// Get the post data 
			$post = get_post( $post_id );

			setup_postdata( $post );
		
			//include the template
			include($gema75_read_it_later->locate_slideout_template( 'read_it_later_share_loop_items.php'));

		}

	}
	
	wp_reset_postdata();
	

}else{

	//include no items on the "read it later" list
	include($gema75_read_it_later->locate_slideout_template( 'read_it_later_share_no_items.php'));


}

?>



<?php
get_footer();
?>