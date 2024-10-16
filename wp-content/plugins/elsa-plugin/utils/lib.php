<?php
/* ///////////////////////////////////////////////////////////////
  FONCTIONS GENERALES
  Clair et Net.
  ////////////////////////////////////////////////////////////// */

require_once('strings.php' );
require_once('dates.php' );

//////////////////////////////////////////////////////////////////////////////////////////////  
///////////////////////////
///////////// POSTS & PAGES
///////////////////////////
class cnLib {
  
  // Get rss feed
  public function get_rss_feed($url,$total='1'){
    $xml = ($url);
    
        $xmlDoc = new DOMDocument();
        $xmlDoc->load($xml);
    
    
    if(!empty($xmlDoc)):
      $channel = $xmlDoc->getElementsByTagName('channel')->item(0);
      $x = $xmlDoc->getElementsByTagName('item');
      for ($i = 0; $i< $total; $i++) {
        $item_title = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
        $item_link = $x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
        $item_desc = $x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
        preg_match_all('/<img[^>]+>/i', $item_desc, $out);
        $imgs = $out[0];
  
        echo ("<a href='" . $item_link
        . "' target='_blank'><p>" . cnStrings::returnstripString($item_title,70) . "</p>");
        echo (" </a>");
      }
    endif;
  }
  
// Associated Post name (relation post by meta box)
    public static function get_related_post($post_id, $post_relation) {
    $related= get_post_meta($post_id, $post_relation, true);
    
     if(!empty($related)) return get_the_title($related);
  
  
  }


// Related Post
    public static function get_related_posts($post_id, $tax, $term, $post_types = 'post') {
        wp_reset_query();
        $query = new WP_Query();

        $arguments = array(
            'post_type' => $post_types,
            'post__not_in' => array($post_id),
            'orderby' => 'rand',
            'showposts' => '3',
        );
        $arguments[$tax] = $term;
        $query = new WP_Query($arguments);
        return $query;
        wp_reset_query();
    }

    public static function get_related_posts_bytax($post_id, $taxname, $taxterm, $post_types = 'post') {
        wp_reset_query();
        $query = new WP_Query();
        $arguments = array(
            'post_type' => $post_types,
            'post_status' => array('publish'),
            'post__not_in' => array($post_id),
            'orderby' => 'rand',
            'showposts' => '3',
        );
        $arguments[$taxname] = $taxterm;
        $start_date = date('Y-m-d', strtotime('-3 months'));
        $Now = getdate();
        $whereq = " AND post_date >= '" . $start_date . "'";
        $where_func = '$where_query = "' . $whereq . '";' . '$where .= $where_query; return $where;';
        $filter_where = create_function('$where', $where_func);
        add_filter('posts_where', $filter_where);

        $query = new WP_Query($arguments);
        remove_filter('posts_where', $filter_where);
        return $query;
        wp_reset_query();
    }

// Récupération d'un id par le slug
    public static function get_ID_by_page_name($page_name, $post_type = 'post') {
        global $wpdb;
    
        $page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '" . $page_name . "' AND post_type = '" . $post_type . "'");
        return $page_name_id;
    }
  
  public static function search_ID_by_title($page_name, $post_type = 'post') {
  
        global $wpdb;
    $page_name=str_replace("%", "\%", $page_name);
    //$query="SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%" . $page_name . "%' AND post_type = '" . $post_type . "'";
    $query="SELECT ID FROM $wpdb->posts WHERE post_title LIKE '" . $page_name . "' AND post_type = '" . $post_type . "'";
    
    
        $page_name_id = $wpdb->get_var($query);
    return $page_name_id;
    }
  
  

// Récupération du slug par l'id
    public static function the_slug($postID = "") {
        global $post;
        $postID = ( $postID != "" ) ? $postID : $post->ID;
        $post_data = get_post($postID, ARRAY_A);
        $slug = $post_data['post_name'];
        return $slug;
    }

/// Personnalisation du résumé
    public static function the_excerpt_max_charlength($charlength) {
        global $post;
        $excerpt = strip_tags(get_the_excerpt());
        $charlength++;

        if (mb_strlen($excerpt) > $charlength) {
            $subex = mb_substr($excerpt, 0, $charlength - 5);
            $exwords = explode(' ', $subex);
            $excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
            if ($excut < 0) {
                echo mb_substr($subex, 0, $excut);
            } else {
                echo $subex;
            }
            echo '...';
        } else {
            echo $excerpt;
        }
    }

/// Personnalisation d'un contenu
    public static function string_max_charlength($str, $charlength) {
        $excerpt = strip_tags($str);
        $charlength++;

        if (mb_strlen($excerpt) > $charlength) {
            $subex = mb_substr($excerpt, 0, $charlength - 5);
            $exwords = explode(' ', $subex);
            $excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
            if ($excut < 0) {
                echo mb_substr($subex, 0, $excut);
            } else {
                echo $subex;
            }
            echo '[...]';
        } else {
            echo $str;
        }
    }

// retourne les custom fields image

    public static function get_metafield_image($name, $size) {
        $image_id = get_post_meta(get_the_ID(), $name, true);
        $image_attributes = wp_get_attachment_image_src($image_id, $size);
        if (!empty($image_attributes)) {
            echo "<img src='$image_attributes[0]' width='$image_attributes[1]' height='$image_attributes[2]' />";
        }
    }

// Personnalisation du résumé de la page détail pour vérifier s'il un résumé existe
    public static function theme_single_excerpt() {
        global $post;
        if (!empty($post->post_excerpt)) {
            $excerpt = get_the_excerpt();
            echo $excerpt;
        }
    }

// Personnalisation du résumé des row pour afficher contenu si c'est un communique
    public static function theme_row_excerpt() {
        global $post;
        if ($post->post_type == 'communique') {
            //$excerpt=get_the_excerpt ($post->ID);
            the_content();
        } else {
            the_excerpt_max_charlength(100);
        }
    }

// Récupération du lien en fonction du type de post
    public static function theme_get_link() {
        global $post;
        switch ($post->post_type) {
            //case 'communique': return get_post_meta($post->ID, '_communique_link', true);
            default : return get_permalink($postid);
        }
    }

////// LES POSTS LES PLUS LUS
   public static  function setPostViews($postID) {
        $count_key = 'cm_views';
        $count = get_post_meta($postID, $count_key, true);
        if (!isset($count)) {
            add_post_meta($postID, $count_key, '1');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }

        //echo $count.' Views';
    }



// TERMS
//////////////////////

/// récupérer l'id d'un tag par son nom
    public static function get_tag_id_by_name($tag_name) {
        global $wpdb;
        $tag_ID = $wpdb->get_var("SELECT term_id FROM " . $wpdb->terms . " WHERE  `name` =  '" . $tag_name . "'");
        print_r($tag_ID);
    }

/// récupérer l'id d'un tag par son nom sur une taxonomy specifique
    public static function get_term_id($cat_name, $typeof = 'category') {
        $term = get_term_by('name', $cat_name, $typeof);
        if (isset($term->term_id))
            return $term->term_id;
    }

// retourne les terms list sans les liens
    public static function get_terms_withoutlink($postId, $taxonomy, $separ = ", ") {
        //$terms = get_the_terms($postId, $taxonomy);
    $terms = wp_get_object_terms($postId,$taxonomy,array("orderby"=>"slug"));
        if ($terms) :

            foreach ($terms as $term) {
               if($term->name!='Général') $list[] = $term->name; // exclut général pour ELSA
          
            }
              if(!empty($list)) return implode($separ, $list). " ";
        endif;
    }
  
  
    public static function get_term_list_link($postId, $taxonomy, $prefix = "", $separ = ", ") {
        $terms = get_the_terms($postId, $taxonomy);
        if ($terms) :

            foreach ($terms as $term) {
                $list[] = '<a href="/'.$prefix.$term->slug.'"/>'.$term->name.'</a>';
          
            }
            return implode($separ, $list). " ";
        endif;
    }

////////////////////////
//////////// TAXONOMY
////////////////////////

/// récupération du term principal sur un post (1er) d'une taxo
    public static function get_main_term($postid, $taxo, $excludname="") {
        $main = wp_get_post_terms($postid, $taxo);
    if($main[0]->name!=$excludname or $main[0]->name!="Général" ) return $main[0]->name;
    }

    public static function get_main_term_parent($postid, $taxo) {
        $terms = wp_get_post_terms($postid, $taxo);
        foreach ($terms as $term) {

            if ($term->parent == 0) {
                return $term->name;
                exit();
            }
        }
    }
  
  public static function get_main_term_parent_slug($postid, $taxo) {
        $terms = wp_get_post_terms($postid, $taxo);
        foreach ($terms as $term) {

            if ($term->parent == 0) {
                return $term->slug;
                exit();
            }
        }
    }

    public static function get_main_term_slug($postid, $taxo) {
        $main = wp_get_post_terms($postid, $taxo,array("parent" => 0));
        if(!empty($main)) return $main[0]->slug;
    }
  
  public static function get_main_term_id($postid, $taxo) {
        $main = wp_get_post_terms($postid, $taxo);
         if(!empty($main)) return $main[0]->term_id;
    }

/// récupérer l'id d'un tag par son nom
    public static function get_category_id_by_slug($cat_name, $typeof = 'category') {
        $term = get_term_by('slug', $cat_name, $typeof);
        if (isset($term->term_id))
            return $term->term_id;
    }

/// récupérer le titre d'une taxonomy par son slug
    public static function get_taxonomy_title($slug, $taxonomy) {
        $term = get_term_by('slug', $slug, $taxonomy);
        return $term->name;
    }

// retourne les id de posts à partir du slug de la taxonomie rattachée
    public static function get_postsId_from_termslug($postId, $taxomony, $posttype) {
        global $wpdb;
        $terms = wp_get_post_terms($postId, $taxomony, array("fields" => "slugs"));
        $page_id[] = 0;
        foreach ($terms as $term) {
            $page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '" . $term . "' AND post_type = '" . $posttype . "'");
            $page_id[] = $page_name_id;
        }
        return $page_id;
    }

/// récupérer le parent d'une taxonomy
    public static function get_term_top_most_parent($term_id, $taxonomy) {
        $parent = get_term_by('id', $term_id, $taxonomy);
        while ($parent->parent != '0') {
            $term_id = $parent->parent;
            $parent = get_term_by('id', $term_id, $taxonomy);
        }
        return $parent;
    }

//////// Liste déroulante d'une custom Taxonomy 
public static function custom_taxonomy_dropdown($taxonomy, $class = '', $libfirst = 'Sélectionnez', $liball = '', $selected = '', $hide_empty = true, $parent = '',$name='') {
        $args = array(
            'orderby' => 'slug',
            'hide_empty' => $hide_empty,
            'parent' => $parent,
            'exclude' =>1
        );
        //print_r($args);
        $terms = get_terms($taxonomy, $args);

        if ($terms) {
            $name=(!empty($name))?$name:$taxonomy;
            printf('<select name="%s" class="%s" id="select-%s">', $name, $class, $taxonomy);
            echo '<option value="">' . $libfirst . '</option>', " \n ";
            if ($liball != '')
                echo '<option value="">' . $liball . '</option>';
            foreach ($terms as $term) {
                $label = substr($term->name, 0, 50);
                $slug = $term->slug;
                if ($slug == $selected)
                    printf('<option name="%s[]" value="%s" selected>%s</option>', $taxonomy, $term->slug, $label);
                else
                    printf('<option name="%s[]" value="%s">%s</option>', $taxonomy, $term->slug, $label);
            }
            print( '</select>');
        }
    }



    public static function custom_taxonomies_dropdown($taxonomies, $class = '', $libfirst = 'Sélectionnez', $liball = '', $selected = '', $hide_empty = true, $parent = '',$name='',$exclude='1' ) {
    if(empty($taxonomies)) exit;
    printf('<select name="%s" class="%s" id="select-%s">', $name, $class, $name);
    echo '<option value="">' . $libfirst . '</option>', " \n ";
    if ($liball != '')
      echo '<option value="">' . $liball . '</option>';
      
    $taxonomies=explode(", ",$taxonomies);
    foreach($taxonomies as $taxonomy){

      $args = array(
        'orderby' => 'slug',
        'hide_empty' => $hide_empty,
        'parent' => $parent,
        'exclude' =>$exclude
      );
  
      //print_r($args);
      $terms = get_terms($taxonomy, $args);
      if ($terms) {
        foreach ($terms as $term) {
          $label = substr($term->name, 0, 50);
          $slug = $term->slug;
          if ($slug == $selected)
            printf('<option name="%s[]" value="%s" selected>%s</option>', $taxonomy, $term->slug, $label);
          else
            printf('<option name="%s[]" value="%s">%s</option>', $taxonomy, $term->slug, $label);
        }
      }
    }
    print( '</select>');

    }


//////// Liste déroulante de post
    public static function custom_post_dropdown($post_type, $class = '', $libfirst = 'Sélectionnez', $liball = '', $selected = '', $hide_empty = true, $parent = '') {

        printf('<select name="%s" class="%s" id="select-%s">', $post_type, $class, $post_type);
        echo '<option value="">' . $libfirst . '</option>', " \n ";
    
        if ($liball != '') echo '<option value="">' . $liball . '</option>';
     
        $args = array('post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC');
        $wp_query = new WP_Query($args);
        
        if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();
            
            $postid=get_the_ID();
            if ($postid == $selected)
                printf('<option name="%s[]" value="%s" selected>%s</option>', $post_type, $postid, get_the_title());
            else
                printf('<option name="%s[]" value="%s">%s</option>', $post_type,  $postid, get_the_title());
   
        endwhile; wp_reset_query();wp_reset_postdata(); $args=null;  
        print( '</select>');

    } 



/// case à cocher d'une taxo
    public static function custom_taxonomy_inputlist($taxonomy, $class = '', $selected ,$hide_empty = true ) {
  if(empty($selected)) $selected=array();
        $args = array(
            'order' => 'slug',
      'hide_empty' => $hide_empty,
        );
        $terms = get_terms($taxonomy);
        if ($terms) {

            foreach ($terms as $term) {
      $check =in_array($term->slug, $selected)?' checked' :'';
                printf('<input  name="%s[]" type="checkbox" value="%s" class="%s" %s />%s<br />',$taxonomy, $term->slug, $class, $check,$term->name);
            }
        }
    }

/// case à cocher d'une list de custom post
    public static function custom_post_inputlist($post_type, $name_id, $selected = array()) {
        
        if(empty($selected)) $selected=array();
        
        $args = array('post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC');
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();
            $postid=get_the_ID();
            $check =in_array($postid, $selected)?' checked' :'';
            printf('<input  name="%s[]" type="checkbox" value="%s"  %s />%s<br />',$name_id,  $postid,$check, get_the_title());
        endwhile; wp_reset_query();wp_reset_postdata(); $args=null;       
    }



// idem permet de ressortir la liste des catégories générales sur une custom cat
    public static function get_category_categories($args) {
        global $wpdb;
        $tags = $wpdb->get_results
                ("
    SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, terms2.slug as tag_slug
    FROM
      " . $wpdb->posts . " as p1
      LEFT JOIN  " . $wpdb->term_relationships . " as r1 ON p1.ID = r1.object_ID
      LEFT JOIN  " . $wpdb->term_taxonomy . " as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
      LEFT JOIN " . $wpdb->terms . " as terms1 ON t1.term_id = terms1.term_id,

      " . $wpdb->posts . " as p2
      LEFT JOIN " . $wpdb->term_relationships . " as r2 ON p2.ID = r2.object_ID
      LEFT JOIN " . $wpdb->term_taxonomy . " as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
      LEFT JOIN " . $wpdb->terms . " as terms2 ON t2.term_id = terms2.term_id
    WHERE
      t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (" . $args['categories'] . ") AND
      t2.taxonomy = 'category' AND p2.post_status = 'publish'
      AND p1.ID = p2.ID
    ORDER by tag_name
  ");
        $count = 0;
        /* foreach ($tags as $tag) {
          $tags[$count]->tag_link = get_tag_link($tag->tag_id);
          $count++;
          } */
        return $tags;
    }

    public static function get_category_taxonomy($args, $taxonomy, $posttype = 'post') {
        global $wpdb;
        $tags = $wpdb->get_results
                ("
    SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, terms2.slug as tag_slug
    FROM
      " . $wpdb->posts . " as p1
      LEFT JOIN  " . $wpdb->term_relationships . " as r1 ON p1.ID = r1.object_ID
      LEFT JOIN  " . $wpdb->term_taxonomy . " as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
      LEFT JOIN " . $wpdb->terms . " as terms1 ON t1.term_id = terms1.term_id,

      " . $wpdb->posts . " as p2
      LEFT JOIN " . $wpdb->term_relationships . " as r2 ON p2.ID = r2.object_ID
      LEFT JOIN " . $wpdb->term_taxonomy . " as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
      LEFT JOIN " . $wpdb->terms . " as terms2 ON t2.term_id = terms2.term_id
    WHERE
      t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (" . $args['categories'] . ") AND
      terms1.term_id NOT IN (" . $args['category__not_in'] . ") AND
      
      t2.taxonomy = '" . $taxonomy . "' AND p2.post_status = 'publish' AND p2.post_type = '" . $posttype . "' 
      AND p1.ID = p2.ID
    ORDER by tag_name
  ");
        $count = 0;
        /* foreach ($tags as $tag) {
          $tags[$count]->tag_link = get_tag_link($tag->tag_id);
          $count++;
          } */
        return $tags;
    }




 /*
  * PAGINATION
  */
    public static function pagination($pages = '', $range = 2) {

        $showitems = ($range * 2) + 1;

        global $paged;

        if (empty($paged))
            $paged = 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if (!$pages) {
                $pages = 1;
            }
        }

        if (1 != $pages) {
            $template_dir=get_bloginfo( 'template_url' );
            $nextpage=($paged==$pages)?$pages:$paged+1;
            $prevpage=($paged==1)?1:$paged-1;
            
            echo '<div class="navigation">';
                echo '<ul class="no-bullets">';
                    echo '<li>
                            <a class="previous btn" href="' . get_pagenum_link($prevpage) . '">  
                                <svg width="7" height="13" viewBox="0 0 7 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 11.9832L1.03125 6.78792L6 1.59265" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Page précédente

                            </li>';

                    for ($i = 1; $i <= $pages; $i++) {
                        if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
                            echo ($paged == $i) ? '<li><a class="btn active" href="#" >' . $i . '</a></li>' : '<li><a class="btn" href="' . get_pagenum_link($i) . '" >' . $i . '</a></li>';
                        }
                    }
              
                    echo '<li>
                            <a class="next btn" href="' . get_pagenum_link($nextpage) . '">
                                Page suivante
                                <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.5 11.9832L6.46875 6.78792L1.5 1.59265" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                         </li>';
                echo '</ul>';
            echo '</div>';       
        }
    }
}



//////////////////////////////////////////////////////////////////////////////////////////////  
/////////////RECHERCHE
/// permettre affichage de la page de recherche même quand requete vide

////// recherche sur les tags 
///add_filter( 'posts_search', 'cn_tags_search', 500, 2 );
function cn_tags_search( $search, &$wp_query ) {
    global $wpdb;
   
    if ( empty( $search ))
      return $search;
   
    $terms = $wp_query->query_vars[ 's' ];
    $exploded = explode( ' ', $terms );
    if( $exploded === FALSE || count( $exploded ) == 0 )
      $exploded = array( 0 => $terms );
       
    $search = '';
    foreach( $exploded as $tag ) {
      $search .= " AND (
        ({$wpdb->posts}.post_title LIKE '%$tag%')
        OR ({$wpdb->posts}.post_content LIKE '%$tag%')
        OR EXISTS
        (
          SELECT * FROM {$wpdb->terms}
          INNER JOIN {$wpdb->term_taxonomy}
            ON {$wpdb->term_taxonomy}.term_id = {$wpdb->terms}.term_id
          INNER JOIN {$wpdb->term_relationships}
            ON {$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id
          WHERE taxonomy = 'post_tag'
            AND object_id = {$wpdb->posts}.ID
            AND {$wpdb->terms}.name LIKE '%$tag%'
        )
      )";
    }
   
    return $search;
  }


/* utilisation : $wp_query = new WP_Query();
  add_filter('posts_where','tag_search_where');
  add_filter('posts_join', 'tag_search_join');
  add_filter('posts_groupby', 'tag_search_groupby');
  $wp_query->query($args); */

add_filter('request', 'my_request_filter');

function my_request_filter($query_vars) {
    if (isset($_GET['s']) && empty($_GET['s'])) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}






//// filtres pour étendre la recherche aux taxonomies (à ajouter avant de lancer la requete
function tag_search_where($where) {
    global $wpdb;
    if (is_search())
        $where .= "OR (t.name LIKE '%" . get_search_query() . "%' AND {$wpdb->posts}.post_status = 'publish'  AND {$wpdb->posts}.post_type = 'post')";
    return $where;
  
}

function tag_search_join($join) {
    global $wpdb;
    if (is_search())
        $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
    return $join;
}

function tag_search_groupby($groupby) {
    global $wpdb;
    $groupby_id = "{$wpdb->posts}.ID";
    if (!is_search() || strpos($groupby, $groupby_id) !== false)
        return $groupby;
    if (!strlen(trim($groupby)))
        return $groupby_id;
    return $groupby . ", " . $groupby_id;
  
}




/// personnalisation de l'affichage des commentaires dans l'article
if (!function_exists('theme_comment')) :

    function theme_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
        <li>
            <div class="avatar"><?php
        $avatar_size = 68;
        if ('0' != $comment->comment_parent)
            $avatar_size = 39;
        //echo get_avatar( $comment, $avatar_size );
        ?>
            </div>
            <div class="comment"> <span class="pseudo"><?php comment_author(); ?> - le <?php comment_date(); ?> à   <?php comment_time(); ?></span>
                <p><?php if ($comment->comment_approved == '0') : ?>
                        <em class="comment-awaiting-moderation">Votre commentaire est en attente de validation.</em>
                        <br />
        <?php endif; ?>
                    <?php comment_text(); ?></p>
            </div>
            <div class="repondre_btt"><a href="#commentform"></a></div>
            <div class="clear"></div>
        </li>







        <?php
    }




  endif;
        
