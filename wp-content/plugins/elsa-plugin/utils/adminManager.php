<?php
/* ///////////////////////////////////////////////////////////////
  ADMIN ET ROLES GENERIQUES
  gestion des droits via Plugin Capability Manager Enhanced
  / Clair et Net.
  ////////////////////////////////////////////////////////////// */


// Email de notifications


add_action( 'transition_post_status', 'intercept_all_status_changes', 10, 3 );
function intercept_all_status_changes( $new_status, $old_status, $post ) {
	global $current_user;
    get_currentuserinfo();


	if (($new_status == 'publish') && ($post->post_type=='structure')){
$message =  "Bonjour ,
La fiche association ".get_the_title($post->ID)." a été modifié par ". $current_user->display_name ." : 
".get_bloginfo( 'url' )."/wp-admin/post.php?post=".$post->ID."&action=edit
Connectez-vous au back office pour consulter la fiche

Cordialement
";
			wp_mail('info@plateforme-elsa.org', 'Modification de la fiche association : '.get_the_title($post->ID), $message);	
	}
}


class adminManager {

    protected $user_role;
    protected $user_programme;
    protected $user_id;

    public function __construct() {
        global $current_user;
        get_currentuserinfo();
        $this->user_role = $current_user->roles;
        $this->user_id = $current_user->ID;
        $this->user_programme = get_user_meta($current_user->ID, 'programme_assoc', true);
		
      
		
		add_filter( 'login_redirect',  array(&$this, 'soi_login_redirect'), 10, 3 );
		
		add_filter( 'login_redirect',  array(&$this, 'soi_login_redirect'), 10, 3 );
	   add_action( 'wp_login_failed', array(&$this, 'redirect_login_failed'));
		
		if (is_admin()) {
		//Par défaut suppression des attachment link
		update_option('image_default_link_type','none');
		

        if (in_array('partenaire', $this->user_role)) {
		
		 //pour auteur : ajout automatique du programme associé
			//add_action('transition_post_status', array(&$this, 'add_programme_automatically'), 10, 3);
            //pour auteur : suppression des pages non proprietaires 
           // add_filter('page_attributes_dropdown_pages_args', array(&$this, 'show_only_author_pages'));
           // add_filter('quick_edit_dropdown_pages_args', array(&$this, 'show_only_author_pages'));
            
            // pour auteur : suppression de la metabox prog assoc et ajout de l'indication du prog
            //add_action('add_meta_boxes', array(&$this, 'add_meta_programme_assoc'));
			 add_action('save_post', array(&$this, 'add_programme_automatically'));
             add_action('pre_get_posts', array(&$this, 'query_set_only_author'));
			 add_action('show_user_profile', array(&$this, 'extra_user_profile_fields'));
        	 add_action('edit_user_profile', array(&$this, 'extra_user_profile_fields'));
       		 add_action('personal_options_update', array(&$this, 'save_extra_user_profile_fields'));
        	 add_action('edit_user_profile_update', array(&$this, 'save_extra_user_profile_fields'));
			 add_action( 'admin_menu', array(&$this, 'remove_partenaires_menus'));
        }

 

        // nettoyage de l'admin 
        add_action('admin_head', array(&$this, 'hide_personal_options'));
        add_filter('user_contactmethods', array(&$this, 'edit_contactmethods'), 10, 1);
        add_action('widgets_init', array(&$this, 'unregister_default_widgets'), 11);
        add_action('admin_init', array(&$this, 'remove_dashboard_widgets'));
        add_action('admin_menu', array(&$this, 'remove_menus'));

        // redirection en fonction des profils et si mauvais mot de pass
        //si éditeur : ajout de la gestion des users sauf pour les admin + gestion des menus
        if (in_array('editor', $this->user_role)) {
            add_action('init', array(&$this, 'editor_useradmin'));
            add_filter('editable_roles', array(&$this, 'editable_roles'));
            add_filter('map_meta_cap', array(&$this, 'map_meta_cap'), 10, 4);
         
        }

        // si pas admin : suppression des messages d'alerte
        if (!in_array('administrator', $this->user_role)) {
            add_action('init', create_function('$a', "remove_action( 'init', 'wp_version_check' );"), 2);
            add_filter('pre_option_update_core', create_function('$a', "return null;"));
            add_filter('pre_site_transient_update_core', create_function('$a', "return null;"));
        }


        add_filter('post_mime_types', array(&$this, 'modify_post_mime_types'));
		}
    }

     //pour partenaire : suppression des menus médias et contenus associés
    function remove_partenaires_menus() {
       remove_menu_page( 'edit.php?post_type=contenu' );  
	   remove_menu_page( 'upload.php' );    
    }
	
	//pour auteur : suppression des pages non proprietaires
    function show_only_author_pages($args) {
        global $post;
        $args['authors'] = $post->post_author;
        return $args;
    }


    // pour auteur : suppression de l'affichage des autres posts dans l'admin
    function query_set_only_author($wp_query) {
        global $current_user;
		global $post;
		$screen = get_current_screen();
	
        if (is_admin() && !current_user_can('edit_others_posts') && (isset($post)&& $post->post_type=="contenu")  ) {
           $wp_query->set('author', $current_user->ID);
           add_filter('views_edit-post', array(&$this, 'fix_post_counts'));
           add_filter('views_edit-agenda', array(&$this, 'fix_post_counts'));
        }
    }

    function fix_post_counts($views) {
        global $current_user, $wp_query;
        unset($views['mine']);
        $types = array(
            array('status' => NULL),
            array('status' => 'publish'),
            array('status' => 'draft'),
            array('status' => 'pending'),
            array('status' => 'trash')
        );
        foreach ($types as $type) {
            $query = array(
                'author' => $current_user->ID,
                'post_type' => 'post',
                'post_status' => $type['status']
            );
            $result = new WP_Query($query);
            $class='';
            if ($type['status'] == NULL): 
               if(!isset($wp_query->query_vars['post_status'])) $class ='class="current"';
                $views['all'] = sprintf(__('<a href="%s"' . $class . '>Tous <span class="count">(%d)</span></a>', 'all'), admin_url('edit.php?post_type=post'), $result->found_posts);
            elseif ($type['status'] == 'publish'):
                if(isset($wp_query->query_vars['post_status'])) $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
                $views['publish'] = sprintf(__('<a href="%s"' . $class . '>Publié <span class="count">(%d)</span></a>', 'publish'), admin_url('edit.php?post_status=publish&post_type=post'), $result->found_posts);
            elseif ($type['status'] == 'draft'):
                if(isset($wp_query->query_vars['post_status'])) $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
                $views['draft'] = sprintf(__('<a href="%s"' . $class . '>Brouillon' . ((sizeof($result->posts) > 1) ? "s" : "") . ' <span class="count">(%d)</span></a>', 'draft'), admin_url('edit.php?post_status=draft&post_type=post'), $result->found_posts);
               elseif ($type['status'] == 'trash'):
               if(isset($wp_query->query_vars['post_status']))  $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
                $views['trash'] = sprintf(__('<a href="%s"' . $class . '>Corbeille <span class="count">(%d)</span></a>', 'trash'), admin_url('edit.php?post_status=trash&post_type=post'), $result->found_posts);
            endif;
        }
        return $views;
    }

    // admin ajout des champs personnalisé sur les users des programmes associés
    function extra_user_profile_fields($user) {
        ?>
        <h3><?php _e("Structure associée", "blank"); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="programme"><?php _e("Structure"); ?></label></th>
                <td>
        <?php cnLib::custom_post_dropdown('structure','', 'Sélectionnez', '',  esc_attr(get_the_author_meta('programme_assoc', $user->ID)));?>
                </td>
            </tr>
        </table>
        <?php
    }

    function save_extra_user_profile_fields($user_id) {

        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }
        update_user_meta($user_id, 'programme_assoc', $_POST['structure']);
    }

	 //pour partenaire : ajout automatique du partenaire associé à l'ajout de contenus
    function add_programme_automatically($post_ID) {
		global $wpdb;
		$post=get_post($post_ID);
		if($post->post_type=="contenu"){
			wp_set_object_terms($post_ID, 'vie-associative', 'format', true);
		}
		
		
		
		//add_post_meta($post->ID, 'structure', 'aa');
	
		/*if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
     	 return;
		
        global $wpdb;
		$mypost=get_post($post_ID);
		echo $mypost->post_type;
		if($mypost->post_type=='contenu'){
			print_r($mypost);
			//update_post_meta($post_ID, 'coucout', 'sssaa' );
			
			echo $post_ID.'joj'.$this->user_programme;
		}*/
       
    }

    //Nettoyage de l'admin : widget, champs profils inutiles...
    // suppression des champs inutile du profil user sur le back
    function hide_personal_options() {
        echo "\n" . '<script type="text/javascript">jQuery(document).ready(function($) { $(\'form#your-profile > h3:first\').hide(); $(\'form#your-profile > table:first\').hide(); $(\'form#your-profile\').show(); });$(\'label[for=url], input#url\').hide();</script>' . "\n";
		echo '<style>
    #post-body .rwmb-select-advanced {height: auto;max-width: 400px;}
  </style>'. "\n";
    }

    function edit_contactmethods($contactmethods) {
        unset($contactmethods['yim']);
        unset($contactmethods['aim']);
        unset($contactmethods['jabber']);
        return $contactmethods;
    }

    // redirection en fonction des profils
    function soi_login_redirect($redirect_to, $request, $user) {
        if (is_array($user->roles)) {
            if (in_array('administrator', $user->roles)) {
                return admin_url();
            } else if (in_array('editor', $user->roles)) {
                return admin_url();
            } else if (in_array('partenaire', $user->roles)) {
                return admin_url('edit.php?post_type=structure');
            } else {
                return get_bloginfo('url') . '/';
            }
        }
    }
	
	

    // Redirection si mauvais mot de passe
	function redirect_login_failed( $username ) {
     $referrer = $_SERVER['HTTP_REFERER'];  
		 if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
			  wp_redirect($referrer . '/?login=failed' );  
			  exit;
		 }
	}
	
	


    //si éditeur : ajout de la gestion des users sauf pour les admin + gestion des menu
    function editor_useradmin() {
        global $wp_roles;
        $editor = get_role('editor');
        $editor->add_cap('list_users');
        $editor->add_cap('edit_users');
        $editor->add_cap('delete_users');
        $editor->add_cap('create_users');
        $editor->add_cap( 'edit_theme_options' );
    }

// Remove 'Administrator' from the list of roles if the current user is not an admin
    function editable_roles($roles) {
        if (isset($roles['administrator']) && !current_user_can('administrator')) {
            unset($roles['administrator']);
        }
        return $roles;
    }

    // If someone is trying to edit or delete and admin and that user isn't an admin, don't allow it
    function map_meta_cap($caps, $cap, $user_id, $args) {

        switch ($cap) {
            case 'edit_user':
            case 'remove_user':
            case 'promote_user':
                if (isset($args[0]) && $args[0] == $user_id)
                    break;
                elseif (!isset($args[0]))
                    $caps[] = 'do_not_allow';
                $other = new WP_User(absint($args[0]));
                if ($other->has_cap('administrator')) {
                    if (!current_user_can('administrator')) {
                        $caps[] = 'do_not_allow';
                    }
                }
                break;
            case 'delete_user':
            case 'delete_users':
                if (!isset($args[0]))
                    break;
                $other = new WP_User(absint($args[0]));
                if ($other->has_cap('administrator')) {
                    if (!current_user_can('administrator')) {
                        $caps[] = 'do_not_allow';
                    }
                }
                break;
            default:
                break;
        }
        return $caps;
    }
	

    // supprimer les widgets du dashboard des widgets
    function unregister_default_widgets() {
        unregister_widget('WP_Widget_Pages');
        unregister_widget('WP_Widget_Calendar');
        unregister_widget('WP_Widget_Archives');
        unregister_widget('WP_Widget_Links');
        unregister_widget('WP_Widget_Meta');
        unregister_widget('WP_Widget_Search');
        unregister_widget('WP_Widget_Text');
        unregister_widget('WP_Widget_Categories');
        unregister_widget('WP_Widget_Recent_Posts');
        unregister_widget('WP_Widget_Recent_Comments');
        //unregister_widget('WP_Widget_RSS');
        unregister_widget('WP_Widget_Tag_Cloud');
        unregister_widget('WP_Nav_Menu_Widget');
    }

    function remove_dashboard_widgets() {
        //remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // right now
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // recent comments
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // incoming links
        remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // plugins

        remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');  // quick press
        //remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');  // recent drafts
        remove_meta_box('dashboard_primary', 'dashboard', 'normal');   // wordpress blog
        remove_meta_box('dashboard_secondary', 'dashboard', 'normal');   // other wordpress news
    }

    // suppression dans l'admin des champs liens et commentaires
    function remove_menus() {
        global $menu;
        $restricted = array(__('Links'), __('Comments'));
        end($menu);
        while (prev($menu)) {
            $value = explode(' ', $menu[key($menu)][0]);
            if (in_array($value[0] != NULL ? $value[0] : "", $restricted)) {
                unset($menu[key($menu)]);
            }
        }
    }

//// Ajout du pdf dans la bibliotheque
    function modify_post_mime_types($post_mime_types) {
        $post_mime_types['application/pdf'] = array(__('PDF'), __('Manage PDF'), _n_noop('PDF <span class="count">(%s)</span>', 'PDF <span class="count">(%s)</span>'));
        return $post_mime_types;
    }


}

