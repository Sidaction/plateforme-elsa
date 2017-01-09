<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Page liste des pays
 Template Name: Page accueil pays
 //////////////////////////////////////////////////////////////*/
 $cnSite->page_type='pays';
 get_header(); ?>
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section id="contentSite" class="marron">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="#">Pays d'afrique</a></div>
    </div>
     <div id="contentWrapper">
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        <article class="noback">
        <h1><?php the_title();?></h1>
           <div class="txtListe"><?php the_content();?></div>
           
           <!---- Carte ---->
           <div id="mapPays"></div>
           <!---- Carte ---->
      	
        	<?php $cnSite->share_links();?>
            
           <div class="clear"></div>
            <hr class="shadowBottom" />
            
            <section id="rechercheThema">
               <?php get_template_part( '_blocs/form', 'search' ); ?>
            </section>
            
            
        </article>      
        
        
        <aside id="sidebarCms">
        	<div class="shadowRight"></div>
          
          <!--<div class="blocVert">
                N’hésitez pas à nous signaler<br>
                <strong>toute information utile</strong><br>
                pour les mettre à jour ou les enrichir.
            </div>-->
          
          <!---- Liste des pays ---->
          <?php 
		  $posts=array();
		  $regions= get_terms( 'region', array( 'orderby' => 'slug', 'order' =>'ASC',  'hide_empty'  => true, 'exclude'=>array(351,131,126,161,278) )  ); 
		  
		  foreach($regions as $region) {
		  	
			$args = array('post_type' => array('pays'), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC','region' => $region->slug);
			$wp_query = new WP_Query($args);
			
			if ($wp_query->have_posts()) :
			$results='<h3>'.$region->name.'</h3>';
			$results.='<ul class="listePays">';
			while ($wp_query->have_posts()) : $wp_query->the_post();
				$slug=get_permalink($post->ID);
				$results.='<li><a href="'. $slug .'" title="'. get_the_title() .'">»  ' . get_the_title() .'</a></li>';
				$coord=get_post_meta($post->ID, 'loc', true);
				list( $lat, $lng ) = explode( ',', $coord);
				$posts[] = array('lat'=> $lat, 'lng'=> $lng, 'slug'=>$slug, 'title'=>get_the_title(), 'infos'=>get_post_meta($post->ID, 'infos', true));
			endwhile; 
			
			$results.='</ul>';
			endif;wp_reset_query();wp_reset_postdata(); $args=null;
			echo $results;
		  
		  }  
		  ?>
          
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			  <script type="text/javascript">
			   var imgdir=' <?php echo $cnSite->templatelink;?>';
            <?php echo 'var datas ='.json_encode($posts);?>
            </script>
  			<script type="text/javascript" src="<?php echo  $cnSite->templatelink; ?>/_js/mappays.js"></script>
          
          <!---- Liste des pays ---->
         
        <?php get_template_part( '_blocs/side', 'ressources' ); ?>
         
         
         </aside>
        <div class="clear"></div>
        
     </div>
</section>

<?php endwhile; ?>
<?php get_footer(); ?>