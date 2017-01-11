<?php

/* ///////////////////////////////////////////////////////////////
  PERSONNALISATION DES CUSTOM POSTS / CUSTOM FIELDS / TAXONOMIES
  PLATEFORME ELSA / Clair et Net.
  ////////////////////////////////////////////////////////////// */

//////////////////////////////////////////////////////////////////////////////////
///////////////// CUSTOM POSTS + TAXONOMIES///////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////*/

function register_custompost() {

    // post type pays
    $args = array(
        'labels' => array(
            'name' => _x('Pays', 'taxonomy general name'),
            'singular_name' => _x('Pays', 'taxonomy singular name'),
            'add_new_item' => __('Ajouter un pays'),
            'edit_item' => __('Editer le pays'),
        ),
        'public' => true,
        'show_ui' => true,
        'query_var' => 'pays',
        'has_archive' => true,
    'menu_icon' => '',
    'supports' => array('title', 'thumbnail', 'excerpt', 'author')
    );

    register_post_type('pays', $args);
  
  $capabilities = array(
      'publish_posts' => 'publish_parts',
      'edit_posts' => 'edit_parts',
      'edit_others_posts' => 'edit_others_parts',
      'delete_posts' => 'delete_parts',
      'delete_others_posts' => 'delete_others_parts',
      'read_private_posts' => 'read_private_parts',
      'edit_post' => 'edit_part',
      'delete_post' => 'delete_part',
      'read_post' => 'read_partpage',
      'edit_published_posts' => 'edit_published_parts',
      'edit_published_post' => 'edit_published_part',     
    );
    
  
  
  // post type autres structures
    $args = array(
        'labels' => array(
            'name' => _x('Structures', 'taxonomy general name'),
            'singular_name' => _x('Structure', 'taxonomy singular name'),
            'add_new_item' => __('Ajouter une structure'),
            'edit_item' => __('Editer la structure'),
        ),
        'public' => true,
        'show_ui' => true,
        'query_var' => 'structure',
        'has_archive' => true,
    'capability_type' => 'part',
      'capabilities' => $capabilities,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author')
    );

    register_post_type('structure', $args);
  

  
  register_taxonomy(
    'type_structure', array('structure'), 
    array(
        'public' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'labels' => array
            (
            'name' => _x('Types de structure', 'taxonomy general name'),
            'singular_name' => _x('Type de structure', 'taxonomy singular name'),
        )
            )
    );
  
  register_taxonomy(
    'public_cibles', array('structure'), 
    array(
        'public' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'labels' => array
            (
            'name' => _x('Public cibles', 'taxonomy general name'),
            'singular_name' => _x('Publics cibles', 'taxonomy singular name'),
        )
            )
    );
  
  register_taxonomy(
    'activites', array('structure'), 
    array(
        'public' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'labels' => array
            (
            'name' => _x('Activites', 'taxonomy general name'),
            'singular_name' => _x('Activite', 'taxonomy singular name'),
        )
            )
    );
  

  
  
  // post type diaporama
    $args = array(
        'labels' => array(
            'name' => _x('Diaporama', 'taxonomy general name'),
            'singular_name' => _x('Diaporama', 'taxonomy singular name'),
            'add_new_item' => __('Ajouter une slide'),
            'edit_item' => __('Editer la slide'),
        ),
        'public' => true,
        'show_ui' => true,
        'query_var' => 'slide',
        'has_archive' => true,
    'menu_icon' => '',
        'supports' => array('title', 'thumbnail','excerpt')
    );

    register_post_type('diaporama', $args);
  
    $capabilities_cont = array(
      'publish_posts' => 'publish_conts',
      'edit_posts' => 'edit_conts',
      'edit_others_posts' => 'edit_others_conts',
      'delete_posts' => 'delete_conts',
      'delete_others_posts' => 'delete_others_conts',
      'read_private_posts' => 'read_private_conts',
      'edit_post' => 'edit_part',
      'delete_post' => 'delete_part',
      'read_post' => 'read_partpage',
      'edit_published_posts' => 'edit_published_conts',
      'edit_published_post' => 'edit_published_part',     
    );
  
  
  
  // post type contenus complémentaires
    $args = array(
        'labels' => array(
            'name' => _x('Contenu complémentaires', 'taxonomy general name'),
            'singular_name' => _x('Contenus complémentaires', 'taxonomy singular name'),
            'add_new_item' => __('Ajouter un contenu'),
            'edit_item' => __('Editer le contenu'),
        ),
        'public' => true,
        'show_ui' => true,
        'query_var' => 'contenu',
    'capability_type' => 'cont',
    'capabilities' => $capabilities_cont,
        'has_archive' => true,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author')
    );

    register_post_type('contenu', $args);
  

   
  
  register_taxonomy(
    'boiteoutils', array('post'), 
    array(
        'public' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'labels' => array
            (
            'name' => _x('Boites à outils', 'taxonomy general name'),
            'singular_name' => _x('Boite à outils', 'taxonomy singular name'),
        )
            )
    );

  
  register_taxonomy(
    'region', array('post','pays'), 
    array(
        'public' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'labels' => array
            (
            'name' => _x('Régions', 'taxonomy general name'),
            'singular_name' => _x('Région', 'taxonomy singular name'),
        )
            )
    );

  register_taxonomy(
    'pays_assoc', array('post','contenu','structure','antenne'), 
    array(
        'public' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'labels' => array
            (
            'name' => _x('Pays associés', 'taxonomy general name'),
            'singular_name' => _x('Pays associé', 'taxonomy singular name'),
        )
            )
    );
  
  register_taxonomy(
    'format', array('post', 'contenu'), 
    array(
      'public' => true,
      'show_admin_column' => true,
      'hierarchical' => true,
      'capabilities' => array (
      'manage_terms' => 'manage_categories', //by default only admin
      'edit_terms' => 'manage_categories',
      'delete_terms' => 'manage_categories',
      'assign_terms' => 'publish_conts'  // means administrator', 'editor', 'author', 'contributor'
         ),
      'labels' => array(
            'name' => _x('Format', 'taxonomy general name'),
            'singular_name' => _x('Format', 'taxonomy singular name'),
        )
            )
    );

}

add_action('init', 'register_custompost', 0);
$post_types = array('post', 'pays', 'association', 'agenda');


 
function add_menu_icons_styles(){
?>
 
<style>
#adminmenu .menu-icon-post div.wp-menu-image:before{content: "\f123";}
#adminmenu .menu-icon-pays div.wp-menu-image:before {content: "\f319";}
#adminmenu .menu-icon-diaporama div.wp-menu-image:before {content: "\f232";}
#adminmenu .menu-icon-antenne div.wp-menu-image:before {content: "\f230";}
#adminmenu .menu-icon-agenda div.wp-menu-image:before {content: "\f145";}
#adminmenu .menu-icon-contenu div.wp-menu-image:before {content: "\f133";}
#adminmenu .menu-icon-structure div.wp-menu-image:before {content: "\f307";}
#association_assoc-adder{display:none}
#pays_assoc-adder{display:none}
#strut_auteur-adder{display:none}
</style>
 
 
<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );



/// HOOKS POUR LE FRONT 
if (!is_admin()) {
    add_filter('request', 'myfeed_request');
    add_filter('request', 'post_type_tags_fix');
   // add_filter('pre_get_posts', 'filter_search');
}


//remove_filter('pre_get_posts', 'filter_search');



// Ajout automatique de la taxonomie attachée quand ajout ou édition d'un custom post     
add_action('transition_post_status', 'my_save', 10, 3);

function my_save($new, $old, $post) {
    if ($new == 'publish') {
        switch ($post->post_type) {
          case 'pays':
                my_saveupdate_term($post->post_title, $post->post_name, 'pays_assoc');
                break;
/*      case 'association':
                my_saveupdate_term($post->post_title, $post->post_name, 'association_assoc');
                break;
      case 'structure':
                my_saveupdate_term($post->post_title, $post->post_name, 'struct_auteur');
                break;  */
        }
    }
}

function my_saveupdate_term($title, $slug, $taxonomy) {

    $term = get_term_by('slug', $slug, $taxonomy);
    if (empty($term)) {
        wp_insert_term($title, $taxonomy, array('slug' => $slug));
    } else {
        wp_update_term($term->term_id, $taxonomy, array('name' => $title, 'slug' => $slug));
    }
}

// suppression automatique des termes associés qd suppression des posts

add_action('delete_post', 'my_delete_function');

function my_delete_function($post_id) {
    $post = get_post($post_id);
    switch ($post->post_type) {
    case 'pays':
            $termid = get_term_id($post->post_name, 'pays_assoc');
            wp_delete_term($termid, 'pays_assoc');
        break;
    /*case 'association':
            $termid = get_term_id($post->post_name, 'association_assoc');
            wp_delete_term($termid, 'association_assoc');
        break;
    case 'structure':
            $termid = get_term_id($post->post_name, 'struct_auteur');
            wp_delete_term($termid, 'struct_auteur');
        break;*/
    }
}









// inclure les custom field dans le rss
function myfeed_request($qv) {
    if (isset($qv['feed']) && !isset($qv['post_type']))
        $qv['post_type'] = $post_types;
    return $qv;
}

// etendre à tous les custom post la page archives tag 
function post_type_tags_fix($request) {
    if (isset($request['tag']) && !isset($request['post_type']))
        $request['post_type'] = $post_types;
    return $request;
}

// inclure les custom post dans la recherche...
function filter_search($query) {

    if ($query->is_search) {
        //print_r($query);
        $query->set('post_type', $post_types);
    };
    return $query;
}



//// filtres en admin pour afficher les custom taxonomy
if (is_admin()) {
    add_action('restrict_manage_posts', 'restrict_manage_posts');
    add_filter('parse_query', 'convert_restrict');
}

function restrict_manage_posts() {
    global $typenow;

    $filters = get_object_taxonomies($typenow);
  


    foreach ($filters as $tax_slug) {
  if(!empty($tax_slug)):
  
        $tax_obj = get_taxonomy($tax_slug);
    
    $selectitem=(isset($_GET[$tax_obj->query_var]))?$_GET[$tax_obj->query_var]:'';
        wp_dropdown_categories(array(
            'show_option_all' => __('' . $tax_obj->label),
            'taxonomy' => $tax_slug,
            'name' => $tax_obj->name,
            'orderby' => 'term_order',
            'selected' => $selectitem,
            'hierarchical' => $tax_obj->hierarchical,
            'show_count' => false,
            'hide_empty' => false,
      'hide_if_empty' => true
        ));
    endif;
    }
  
}

function convert_restrict($query) {
    global $pagenow;
    global $typenow;
    if ($pagenow=='edit.php') {
        $filters = get_object_taxonomies($typenow);

        foreach ($filters as $tax_slug) {
            $var = &$query->query_vars[$tax_slug];
            if (!empty($var) ) {
                $term = get_term_by('id',$var,$tax_slug);
                if (!empty($term) ) $var = $term->slug;
            }
        }
    }
    return $query;
}




    
/// MODIFICATION DES LABELS ARTICLES
add_action( 'registered_post_type', 'and_posts_become_canvases', 10, 2 );
function and_posts_become_canvases($post_type, $args) {
  if ( $post_type != 'post' )
    return;
 
  global $wp_post_types;
  $wp_post_types['post']->label       = _x("Ressources", 'post type general name', 'mon-theme');
  $wp_post_types['post']->labels->name      = _x("Ressources", 'post type general name', 'mon-theme');
  $wp_post_types['post']->labels->singular_name   = _x("Ressource", 'post type singular name', 'mon-theme');
//  $wp_post_types['post']->labels->add_new     = __("Add");
  $wp_post_types['post']->labels->add_new_item    = __("Ajouter une ressource", 'mon-theme');
  $wp_post_types['post']->labels->edit_item   = __("Editer la ressource", 'mon-theme');
  $wp_post_types['post']->labels->new_item    = __("Nouvelle ressource", 'mon-theme');
  $wp_post_types['post']->labels->view_item   = __("Voir la ressource", 'mon-theme');
  $wp_post_types['post']->labels->search_items    = __("Rechercher", 'mon-theme');
  $wp_post_types['post']->labels->not_found   = __("No Actualité", 'mon-theme');
  $wp_post_types['post']->labels->not_found_in_trash  = __("No Actualité found in trash", 'mon-theme');
//  $wp_post_types['post']->labels->parent_item_colon = null;
  $wp_post_types['post']->labels->all_items   = __("Toutes les ressources", 'mon-theme');
  $wp_post_types['post']->labels->menu_name   = _x("Ressources", 'post type general name', 'mon-theme');
  $wp_post_types['post']->labels->name_admin_bar    = _x("Ressources", 'post type singular name', 'mon-theme');
}

add_action('admin_menu', 'sf_admin_menu', 11);
function sf_admin_menu() {
  global $menu, $submenu;
  if( $menu[5][0] == __('Posts') )
    $menu[5][0] = _x('Ressources', 'post type general name', 'mon-theme');
  if( isset($submenu['edit.php'][5][0]) && $submenu['edit.php'][5][0] == __('All Posts') )
    $submenu['edit.php'][5][0] = __('Toutes les ressources', 'mon-theme');
}
