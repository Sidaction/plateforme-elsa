<?php
/*///////////////////////////////////////////////////////////////
 ROLES
 / Clair et Net.  
 //////////////////////////////////////////////////////////////*/

/*	
add_action('transition_post_status','cn_send_notification_publish_to_contributor',10,3);

function cn_send_notification_publish_to_contributor( $new_status, $old_status, $post ) {
	if($new_status == 'publish' ) {
   
		$author = get_userdata($post->post_author);
		update_post_meta($post->ID, 'structure', 'aa');
	
	$message = "Bonjour ".$author->display_name.",
				Votre article, ".$post->post_title." vient d\'être publié !";
	wp_mail($author->user_email, "Votre article est publié", $message);
	
   }
}
  */ 
  
 // Ajout des rôles 
 
 function my_map_meta_cap( $caps, $cap, $user_id, $args ) {
	
	/* If editing, deleting, or reading an blog, get the post and post type object. */
	if ( 'edit_part' == $cap || 'delete_part' == $cap || 'read_part' == $cap || 'edit_pending_parts' == $cap  ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );
		$caps = array();
		
		switch( $cap ) {
			case 'edit_part':
			$caps[] = ( $user_id == $post->post_author ) ? $post_type->cap->edit_posts : $post_type->cap->edit_others_posts;
			break;
			case 'delete_part':
			$caps[] = ( $user_id == $post->post_author ) ? $post_type->cap->delete_posts : $post_type->cap->delete_others_posts;
			break;
			case 'read_part':
			$caps[] = ( 'private' != $post->post_status || $user_id == $post->post_author ) ? $caps[] = 'read' : $post_type->cap->read_private_posts;
			break;
			case 'edit_pending_parts':
			$caps[] = $post_type->cap->edit_pending_posts;
			break;
		
		}
	}
	
	if ( 'edit_cont' == $cap || 'delete_cont' == $cap || 'read_cont' == $cap || 'edit_pending_conts' == $cap  ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );
		$caps = array();
		
		switch( $cap ) {
			case 'edit_cont':
			$caps[] = ( $user_id == $post->post_author ) ? $post_type->cap->edit_posts : $post_type->cap->edit_others_posts;
			break;
			case 'delete_cont':
			$caps[] = ( $user_id == $post->post_author ) ? $post_type->cap->delete_posts : $post_type->cap->delete_others_posts;
			break;
			case 'read_cont':
			$caps[] = ( 'private' != $post->post_status || $user_id == $post->post_author ) ? $caps[] = 'read' : $post_type->cap->read_private_posts;
			break;
			case 'edit_pending_conts':
			$caps[] = $post_type->cap->edit_pending_posts;
			break;
		
		}
	}
	
	
	return $caps;
	}
	
	add_filter( 'map_meta_cap', 'my_map_meta_cap', 10, 4 );
 
 
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
	$contributor->add_cap('upload_files');
	

	// ajouter aux administrateurs et éditeurs l'accès à la partie privée
	$administrator = get_role( 'administrator' );
	$administrator->add_cap( 'access_espace_partenaire' );
	$administrator->add_cap( 'publish_parts' );
	$administrator->add_cap( 'edit_parts' );
	$administrator->add_cap( 'edit_others_parts' );
	$administrator->add_cap( 'delete_parts' );
	$administrator->add_cap( 'delete_others_parts' );
	$administrator->add_cap( 'read_private_parts' );
	$administrator->add_cap( 'manage_parts' );
	$administrator->add_cap( 'publish_conts' );
	$administrator->add_cap( 'edit_conts' );
	$administrator->add_cap( 'edit_others_conts' );
	$administrator->add_cap( 'delete_conts' );
	$administrator->add_cap( 'delete_others_conts' );
	$administrator->add_cap( 'read_private_conts' );
	$administrator->add_cap( 'manage_conts' );
	
	$administrator->add_cap( 'manage_exports' );
	$editor = get_role( 'editor' );
	$editor->add_cap( 'access_espace_partenaire' );
	$editor->add_cap( 'publish_parts' );
	$editor->add_cap( 'edit_parts' );
	$editor->add_cap( 'edit_others_parts' );
	$editor->add_cap( 'delete_parts' );
	$editor->add_cap( 'delete_others_parts' );
	$editor->add_cap( 'read_private_parts' );
	$editor->add_cap( 'manage_parts' );
	$editor->add_cap( 'publish_conts' );
	$editor->add_cap( 'edit_conts' );
	$editor->add_cap( 'edit_others_conts' );
	$editor->add_cap( 'delete_conts' );
	$editor->add_cap( 'delete_others_conts' );
	$editor->add_cap( 'read_private_conts' );
	$editor->add_cap( 'manage_conts' );
	
	$editor->add_cap( 'manage_exports' );
	
	
	
}  


add_action( 'init', 'theme_addrole' );  




/// Ajout des comptes partenaires dans les listes déroulantes auteurs
add_filter('wp_dropdown_users', 'MySwitchUser');

function MySwitchUser($output){
	global $post;
	if($post->post_type=='partenaire'){

		$users = get_users('role=partenaire');
	
		$output = "<select id=\"post_author_override\" name=\"post_author_override\" class=\"\">";
	
		//Leave the admin in the list
		$output .= "<option value=\"1\">Admin</option>";
		foreach($users as $user)
		{
			$sel = ($post->post_author == $user->ID)?"selected='selected'":'';
			$output .= '<option value="'.$user->ID.'"'.$sel.'>'.$user->user_login.'</option>';
		}
		$output .= "</select>";
	
		return $output;
	}else{
	$users = get_users();
	
		$output = "<select id=\"post_author_override\" name=\"post_author_override\" class=\"\">";
	
		//Leave the admin in the list
		$output .= "<option value=\"1\">Admin</option>";
		foreach($users as $user)
		{
			$sel = ($post->post_author == $user->ID)?"selected='selected'":'';
			$output .= '<option value="'.$user->ID.'"'.$sel.'>'.$user->user_login.'</option>';
		}
		$output .= "</select>";
	
		return $output;
	}
	
	
}


// suppression de certains sous menu
function hide_add_new_custom_type(){
	 ob_start();
    global $submenu;
	global $current_user;
     get_currentuserinfo();

if (in_array('partenaire', $current_user->roles)) {

  		echo '<style>.add-new-h2,.subsubsub,.search-box,#wp-admin-bar-new-content,#menu-posts-structure .wp-submenu,#postexcerpt,#type_structurediv,#public_ciblesdiv,#activitesdiv,#pays_assocdiv,#postimagediv,#structures-associees,#format-104,#format-74,#format-73,#format-347{display: none;}</style>';

		
	//$page = remove_submenu_page(  'edit.php?post_type=structure','post-new.php?post_type=structure' );
	//remove_submenu_page( 'edit.php?post_type=structure', 'post-new.php?post_type=structure' );
	
	}

}
add_action('admin_menu', 'hide_add_new_custom_type');