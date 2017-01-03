<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Page liste des associations
 Template Name: Page accueil associations
 //////////////////////////////////////////////////////////////*/
  $cnSite->page_type='structure';	
 get_header(); 
 global $searchedletter;
   
		  add_filter('posts_where', 'letter_where' );
			function letter_where( $where )	{
				global $searchedletter;
				global $wp_query;
				global $wpdb;
				if( isset( $searchedletter )) {
				$where .= " AND $wpdb->posts.post_title LIKE '".$searchedletter."%'";
				}
				return $where;
			}
   
   ?>
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section id="contentSite" class="marronclair associations">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="#">Associations</a></div>
    </div>
     <div id="contentWrapper">
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        
        <h1><?php the_title();?></h1>
           <div class="txtListe"><?php the_content();?></div>
        
        <article>

           <!---- Carte ---->
           <div id="mapPays" style="450px"></div>
           <!---- Carte ---->
      
        </article>      
        
        
        <aside id="sidebarCms">
        	<div class="shadowRight"></div>
          <ul class="listeLettres">
            <?php $aLetters = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
			foreach($aLetters as $letter){
				 $searchedletter= $letter;
				 $args = array('post_type' => array('structure'), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC','type_structure' => 'partenaires-elsa-associations-du-reseau-elsa');
				 $wp_query = new WP_Query($args);
				if($wp_query->found_posts==0){
					$str= '<li class="off">'.$letter.'</li>';
				}else{
					$str= '<li ><a href="?letter='.$letter.'"'.'>'.$letter.'</a></li>';
				}
				echo $str;
				wp_reset_query();wp_reset_postdata(); $args=null;
			}
            
              ?>
            </ul>
        
          <!---- Liste des associations ---->
          <div class="colsAsso">
          <ul class="listeAsso">
		  <?php 
		$results="";
		  $posts=array();
		  /*add_filter('query_vars', 'letter_queryvar' );
			function letter_queryvar( $qvars ){
			  $qvars[] = 'letter';
			  return $qvars;
			}*/
			
			   $searchedletter=(isset($wp_query->query_vars['letter']))?$wp_query->query_vars['letter']:'';

				  $args = array('post_type' => array('structure'), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC','type_structure' => 'partenaires-elsa-associations-du-reseau-elsa');
			$wp_query = new WP_Query($args);

			if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();
				$slug=get_permalink($post->ID);
				$results.='<li><a href="'. $slug .'" title="'. get_the_title() .'">' . get_the_title() .'</a></li>';
				$coord=get_post_meta($post->ID, 'loc', true);
				list( $lat, $lng ) = explode( ',', $coord);
				$posts[] = array('lat'=> $lat, 'lng'=> $lng, 'slug'=>$slug, 'title'=>get_the_title(), 'infos'=>'');
			endwhile; wp_reset_query();wp_reset_postdata(); $args=null;
			remove_filter('posts_where', 'letter_where' );
			$results.='</ul></div>';
			echo $results;
		  
	
		  ?>
          
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			  <script type="text/javascript">
			   var imgdir=' <?php echo $cnSite->templatelink;?>';
            <?php echo 'var datas ='.json_encode($posts);?>
            </script>
  			<script type="text/javascript" src="<?php echo  $cnSite->templatelink; ?>/_js/mappays.js"></script>
          
          <!---- Liste des pays ---->
         </aside>
        <div class="clear"></div>
        
     </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>