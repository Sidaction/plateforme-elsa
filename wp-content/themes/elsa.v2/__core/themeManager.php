<?php
//flush_rewrite_rules();
/* ///////////////////////////////////////////////////////////////
  PERSONNALISATION DU THEME GREEN SHEEP
  / Clair et Net.
  ////////////////////////////////////////////////////////////// */

class themeManager {

    public $emailadmin,$templatelink,$rootlink,$currentpage,$page_type,$search_args,$search_results ;

    public function __construct() {

        //setlocale(LC_TIME, 'fr_FR'); // Serveur Win32
        //global $emailadmin;
        $this->emailadmin = "info@clair-et-net.com";
    $this->templatelink= get_bloginfo( 'template_url' ); 
    $this->rootlink =  get_bloginfo( 'url' );
    $this->pagename='';
    $this->univers='';
    add_filter( 'wp_mail_from',  array(&$this,'cn_from_email'));
    add_filter( 'wp_mail_from_name', array(&$this, 'cn_from_name' ));

        add_action('after_setup_theme', array(&$this, 'cn_setup'));
        add_filter('excerpt_length', array(&$this, 'my_excerpt_length'));
        add_action('init', array(&$this, 'setup_addmenus'));
        if (!is_admin()) {
            $this->remove_wpheaders();
            //SEO dans libs/seo.php
            add_action('wp_head', 'fb_header', 3);
            add_action('wp_head', 'excerpt_to_description', 2);
            add_action('wp_head', 'generate_title', 1);
            // suppression de la barre admin du front
            //show_admin_bar(false);
        }



        add_action('login_head', array(&$this, 'childtheme_custom_login'));
        add_shortcode('iframe', array(&$this, 'iframe_shortcode'));
        add_shortcode('2COLS', array(&$this, 'stylecol2'));
    add_action('init', array(&$this, 'my_add_excerpts_to_pages' ));
    remove_shortcode('gallery', 'gallery_shortcode'); // removes the original shortcode
    add_filter( 'img_caption_shortcode', array(&$this, 'cn_img_caption_shortcode_filter'), 10, 3 );
    //add_action( 'init',  array(&$this, 'rewriterules_init')); 
    add_filter('query_vars',  array(&$this, 'add_query_vars')); 
    
    add_action('wp_head', array(&$this, 'frontend_ajaxurl')); 
    add_action('wp_ajax_doc_like', array(&$this, 'doc_like' )); 
    add_action('wp_ajax_nopriv_doc_like',  array(&$this,'doc_like')); 
    add_filter('wp_head', array(&$this,'sb_force_comment'));
    
    if(function_exists('add_action')) {
      add_action('preprocess_comment', array(&$this,'preprocess_new_comment'));
    }
    }

  //////// PERSONNALISATION ENVOI MAIL
  function cn_from_name( $name ) {
    return get_bloginfo('name');
  }
  
  function cn_from_email( $email ) {
    return 'info@plateforme-elsa.org';
  }

      function cn_setup() {
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(604, 270, true);
        /* add_theme_support( 'post-formats', array(
          'audio', 'gallery', 'video'
          ) );
         */
    }

  
  function the_category_filter( $thelist, $separator=' ') {
  if(!defined('WP_ADMIN')) {
    //Category IDs to exclude
    $exclude = array(1,5);

    $exclude2 = array();
    foreach($exclude as $c) {
      $exclude2[] = get_cat_name($c);
    }

    $cats = explode( $separator, $thelist );
    $newlist = array();
    foreach($cats as $cat) {
      $catname = trim(strip_tags($cat));
      if(!in_array($catname,$exclude2))
        $newlist[] = $cat;
    }
    return implode($separator,$newlist);
  } else {
    return $thelist;
  }
}

  
  function add_query_vars($vars) {
    $vars[] = "letter";
    return $vars;
    print_r($vars);
  
  }

   public function get_footer_text() {
    $contentfooter="texte-footer-general";
    global $cnSite;
    if($cnSite->page_type=='pays') $contentfooter="texte-footer-pays";
    if($cnSite->page_type=='structure') $contentfooter="texte-footer-structure";
    if($cnSite->page_type=='ressource') $contentfooter="texte-footer-ressources";
    $pageID=cnLib::get_ID_by_page_name($contentfooter, 'page');
    $post=get_post($pageID);
    if(!empty($post)) echo $post->post_content;
  }
  
  
  public function get_cat_tagcloud($catID){
    if(empty($catID)) return;
    $custom_query = new WP_Query('posts_per_page=-1&cat='.$catID);
    if ($custom_query->have_posts()) :
      while ($custom_query->have_posts()) : $custom_query->the_post();
        $posttags = get_the_tags();
        if ($posttags) {
          foreach($posttags as $tag) {
            $all_tags[] = $tag->term_id ;
          }
        }
      endwhile;
    endif;
    
    $tags_arr = array_unique($all_tags);
    $tags_str = implode(",", $tags_arr);
    
    $args = array(
    'smallest'  => 12,
    'largest'   => 12,
    'unit'      => 'px',
    'number'    => 0,
    'format'    => 'list',
    'include'   => $tags_str
    );
    wp_tag_cloud($args);
    
    

  }
  
  public function get_back_link() {

    global $post;
    
    if ( isset($_GET['ref']) ) {
      if( $post->post_type == 'post' && $_GET['ref'] == 'search' ) {
        
        $postlist = $_SESSION['results'];
        $ids = array();

        if(!empty($postlist)):
          foreach ($postlist as $thepost) {
             $ids[] = $thepost;
          }
        endif;

        $backlink = "/recherche-documentaire/?ref=search";
        $lib = "Document";

      } 
      else {
        switch( $post->post_type ){

          case 'pays':
            $backlink = "/pays-dafrique/";
            $lib = "Pays";
          break;
          
          case 'structure':
            $backlink = "/associations-africaines-du-reseau-elsa/";
            $lib = "";
          break;
          
          case 'post':
            $backlink = "/category/".cnLib::get_main_term_slug($post->ID, 'category');
            $lib = "Document";
          break;

        }
      }

      $nav = '<a href="'.$backlink.'">Retourner aux résultats</a>';
      echo $nav;
    } 
    else {
      return;
    }



  }
  
   public function get_fiche_nav() {
  
    global $post;
    
    
      $args = array(
         'posts_per_page'  => -1,
         'orderby'         => 'title',
         'order'           => 'ASC',
         'post_type'       => $post->post_type,
      ); 
      
      if( $post->post_type == 'structure' ) {
        $args['type_structure'] = 'partenaires-elsa-associations-du-reseau-elsa';
      }

      if( $post->post_type == 'post' ) {
        $args['orderby'] = 'DATE';
        $args['order'] = 'DESC';
      }
    
      
      $postlist = get_posts( $args );
      $ids = array();
      foreach ($postlist as $thepost) {
         $ids[] = $thepost->ID;
      }
          
    
    $thisindex = array_search($post->ID, $ids);
    $previd = $ids[$thisindex-1];
    $nextid = $ids[$thisindex+1];
    
    $referer=(isset($_GET['ref']) && $_GET['ref']=='search')?'?ref=search':'';
    
    $nav='<ul id="navFiches">';
    if (!empty($previd)) $nav.='<li><a href="'.get_permalink($previd ).$referer.'">Ressource précédente</a></li>';
    if (!empty($nextid)) $nav.='<li><a href="'.get_permalink($nextid).$referer.'">Ressource suivante</a></li>';
    $nav.=' </ul>';
    echo $nav;
  }
  
  
  
  public function get_bloc_text($blocname) {
    $pageID=cnLib::get_ID_by_page_name($blocname, 'page');
    $post=get_post($pageID);
    if(!empty($post)) echo $post->post_content;
  }
  
  public function get_authors($postID) {
  
    $authors=array();
    $auteur=get_post_meta($postID, 'auteur', true);
    if(!empty($auteur)) $authors[]=$auteur;
    $main_authors= get_post_meta($postID, 'first_org', false);
    if(!empty($main_authors)){
      foreach($main_authors as $main_author){
        $authors[]=get_the_title($main_author);
      }
    }
    
    $second_authors= get_post_meta($postID, 'second_org', false);
    if(!empty($second_authors)){
      foreach($second_authors as $second_author){
        $authors[]=get_the_title($second_author);
      }
    }
    
    $others_authors= get_post_meta($postID, 'other_org', false);
    if(!empty($others_authors)){
      foreach($others_authors as $others_author){
        $authors[]=get_the_title($others_author);
      }
    }
    return implode(', ', $authors);
  }
    
  
  public function get_authors_withlink($postID) {
  
    $authors=array();
    $auteur=get_post_meta($postID, 'auteur', true);
    if(!empty($auteur)) $authors[]=$auteur;
    $main_authors= get_post_meta($postID, 'first_org', false);
    if(!empty($main_authors)){
      foreach($main_authors as $main_author){
        $authors[]='<a href="/recherche-documentaire/?struct='.$main_author.'">'.get_the_title($main_author).'</a>';
      }
    }
    
    $second_authors= get_post_meta($postID, 'second_org', false);
    if(!empty($second_authors)){
      foreach($second_authors as $second_author){
        $authors[]='<a href="/recherche-documentaire/?struct='.$second_author.'">'.get_the_title($second_author).'</a>';
      }
    }
    
    $others_authors= get_post_meta($postID, 'other_org', false);
    if(!empty($others_authors)){
      foreach($others_authors as $others_author){
        $authors[]='<a href="/recherche-documentaire/?struct='.$others_author.'">'.get_the_title($others_author).'</a>';
      }
    }
    return implode(', ', $authors);
  }
  
   
   
   

  
    function setup_addmenus() {

    }


    /////// Supprimer du header les liens générateurs...
    function remove_wpheaders() {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'rel_canonical');
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
        remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
        remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

        add_filter('index_rel_link', array(&$this, 'disable_stuff'));
        add_filter('parent_post_rel_link', array(&$this, 'disable_stuff'));
        add_filter('start_post_rel_link', array(&$this, 'disable_stuff'));
        add_filter('previous_post_rel_link', array(&$this, 'disable_stuff'));
        add_filter('next_post_rel_link', array(&$this, 'disable_stuff'));
        add_filter('next_post_rel_link', array(&$this, 'disable_stuff'));
        add_filter('feed_links', array(&$this, 'disable_stuff'));
        add_filter('feed_links_extra', array(&$this, 'disable_stuff'));
        add_filter('feed_links_extra', array(&$this, 'disable_stuff'));
    
        add_action( 'init',array(&$this, 'cn_add_excerpts_to_pages'));
    
        
    
    }
  
  
  // personnalisation de la taille du résumé
    function my_excerpt_length($length) {
        return 50;
    }
  

  function cn_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
  
  }


    function disable_stuff($data) {
        return false;
    }

    /// personnalisation du logo admin
    function childtheme_custom_login() {
        echo '<link rel="stylesheet" type="text/css" href="' . $this->templatelink . '/_css/login.css" />';
    }
    
  //// AJout de l'excerpt aux pages
  function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
  }
  
  

    /////SHORTCODES
    function iframe_shortcode($atts, $content = null) {

        extract(shortcode_atts(array(
            'src' => '',
            'scrolling' => 'no',
            'width' => '100%',
            'height' => '500',
            'frameborder' => '0',
            'marginheight' => '0',
                        ), $atts));

        if (empty($src))
            return 'http://';

        return '<p><iframe src="' . $src . '" title="" scrolling="' . $scrolling . '" width="' . $width . '" height="' . $height . '" frameborder="' . $frameborder . '" marginheight="' . $marginheight . '"></iframe></p>';
    }

    function stylecol2($atts, $content = null) {
        return '<div class="cols2">' . $content . '</div>';
    }
  function styleapplat($atts, $content = null) {
        return '<div class="applat">' . $content . '</div>';
    }
  
  function stylebtnplus($atts, $content = null) {
        return '<div class="btnplus btn ">' . $content . '</div><div class="clear"></div>';
    }
  
  
  


// remplacer le shortcode caption
function cn_img_caption_shortcode_filter($val, $attr, $content = null){
  extract(shortcode_atts(array(
    'id'      => '',
    'align'   => 'aligncenter',
    'width'   => '',
    'caption' => ''
  ), $attr));
  
  if ( 1 > (int) $width || empty($caption) )
    return $val;
 
  if ( $id )
    $id = esc_attr( $id );
     
  $content = str_replace('<img', '<img itemprop="contentURL"', $content);

  return '<div class="imgcaption ' . esc_attr($align) . '">' . do_shortcode( $content ) . '<div class="caption">' . $caption . '</div></div>';
}



// Nettoyage de la galerie



 function cn_gallery_shortcode($attr) {
    $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
    if ( empty( $attr['orderby'] ) )
      $attr['orderby'] = 'post__in';
    $attr['include'] = $attr['ids'];
  }

  $output = apply_filters('post_gallery', '', $attr);
  if ( $output != '' )
    return $output;

  if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
      unset( $attr['orderby'] );
  }

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post ? $post->ID : 0,
    'itemtag'    => 'dl',
    'icontag'    => 'dt',
    'captiontag' => 'dd',
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => ''
  ), $attr, 'gallery'));

  $id = intval($id);
  if ( 'RAND' == $order )
    $orderby = 'none';

  if ( !empty($include) ) {
    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( !empty($exclude) ) {
    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  } else {
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  }

  if ( empty($attachments) )
    return '';

  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment )
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    return $output;
  }

  $itemtag = tag_escape($itemtag);
  $captiontag = tag_escape($captiontag);
  $icontag = tag_escape($icontag);
  $valid_tags = wp_kses_allowed_html( 'post' );
  if ( ! isset( $valid_tags[ $itemtag ] ) )
    $itemtag = 'dl';
  if ( ! isset( $valid_tags[ $captiontag ] ) )
    $captiontag = 'dd';
  if ( ! isset( $valid_tags[ $icontag ] ) )
    $icontag = 'dt';

  $columns = intval($columns);
  $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
  $float = is_rtl() ? 'right' : 'left';

  $selector = "gallery-{$instance}";
  $blogurl=get_bloginfo( 'template_url' );
  $gallery_style = $gallery_div = '';
  if ( apply_filters( 'use_default_gallery_style', true ) )
    $gallery_style = "";
  $size_class = sanitize_html_class( $size );
  $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
  $output = "
  

   <div id='wrapperGalerieImagesThumbs' class='videoalaune'>
          <div class='encartDiapo'>Diaporama</div>
        </div>
        <div class='clear'></div>
  <script src='{$blogurl}/_js/jquery.bgngallery.js'></script> 
    <script>
  var imgGalleryArray = [" ;

  $i = 0;
  foreach ( $attachments as $id => $attachment ) {
    if ( ! empty( $attr['link'] ) && 'file' === $attr['link'] )
      $image_output = wp_get_attachment_link( $id, $size, false, false );
    elseif ( ! empty( $attr['link'] ) && 'none' === $attr['link'] )
      $image_output = wp_get_attachment_image( $id, $size, false );
    else
      $image_output = wp_get_attachment_link( $id, $size, true, false );

    $image_meta  = wp_get_attachment_metadata( $id );
    
    $thumb = wp_get_attachment_image_src($attachment->ID, 'thumbnail' );
    $thumb_url = $thumb['0'];
    //$thumb_caption= wptexturize(trim($attachment->post_excerpt));
    $thumb_caption=str_replace("\r", "\n", $attachment->post_excerpt);
    $thumb_caption=str_replace("’", "'", $thumb_caption);
    $output .= "{mini:'{$thumb_url}', img:'{$attachment->guid}'";
    //$output .= ", credits:'" . addslashes($thumb_caption) . "' ";
    $output .= ", credits:'" . addslashes($thumb_caption) . "' ";
      $output .= ", w:" . $image_meta['width'] . ", h:".$image_meta['height'];
    $orientation=($image_meta['width']>=$image_meta['height'])?'horizontal':'vertical';
    $output .= ", orientation:'".$orientation."'";  
    
      $output .="},";
    
      
  }

  $output .= "
           ];
       
       $(document).ready(function(e) {
      var galery =        \"<div id='FullScreenGalerieImages'><div id='bggallery'></div><div class='btnClose'></div><div id='wrapperFooter'><div id='galleryControls'><div class='btn_prev' title='Image précédente'></div><div class='btn_stop' title='Pause / Reprendre'></div><div class='btn_next' title='Image suivante'></div></div><div id='photoCredits'></div><div class='thumbs'></div><div id='timeBar'></div></div></div>\"

      $('body').append(galery)
      $('#bggallery').resizebggallery();
      $.fn.initGallery();
      $('.encartDiapo', '#wrapperGalerieImagesThumbs').click(function(e) {
        $.fn.showGallery();
      });
    });
    <!-- Disable 
    function disableselect(e){ 
    return false 
    } 
    
    function reEnable(){ 
    return true 
    } 
    
    //if IE4+ 
    document.onselectstart=new Function ('return false') 
    document.oncontextmenu=new Function ('return false') 
    //if NS6 
    if (window.sidebar){ 
    document.onmousedown=disableselect 
    document.onclick=reEnable 
    } 
    //--> 
       
  </script>

    ";
  

  return $output;
  
}


  
  
  
  // function addthis
  function share_links() {
  ?>
  <div id="sharebottom">
    <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style">
                <a class="addthis_button_preferred_1"></a>
                <a class="addthis_button_preferred_2"></a>
                <a class="addthis_button_preferred_3"></a>
                <a class="addthis_button_preferred_4"></a>
                <a class="addthis_button_compact"></a>
                <a class="addthis_counter addthis_bubble_style"></a>
            </div>
     </div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52fcab66343ea4ed"></script>
     <?php
  }
  
  // ajout des commentaires à la catégorie page
  function sb_force_comment( ) {
  global $withcomments;
    if(is_category())
      $withcomments = true; //force to show the comment on category page
    }

  
  function frontend_ajaxurl() {
  ?>
  <script type="text/javascript">var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>
  <?php
  }

  
  function doc_like() {
    $postID = wp_strip_all_tags($_POST['postID']);
    
    $count_key = 'like';
    $count = get_post_meta($postID, $count_key, true);
      if(!isset($count)) {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
        
      }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
      }
    echo $count;
  }
  
  // Suppression des spams
  function preprocess_new_comment($commentdata) {
  
    if(!isset($_POST['is_legit'])) {
      die('sorry ;)');
    }
    return $commentdata;
  }
  
  

}

