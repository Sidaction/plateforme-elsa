 <?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Page détail d'une catégorie
 //////////////////////////////////////////////////////////////*/
 $cat = get_category( get_query_var( 'cat' ) );	

 $cat_id = $cat->cat_ID;
 $cat_slug=$cat->slug;
$meta = get_option('info');
if (empty($meta)) $meta = array();
if (!is_array($meta)) $meta = (array) $meta;
$meta = isset($meta[$cat_id]) ? $meta[$cat_id] : array();
$presentation = $meta['presentation']; get_header(); 
$details = $meta['details']; 
$vignette = $meta['image']; 

get_header(); 

?>
<section id="contentSite" class="bleu">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="#">Accueil</a> » <a href="/dossiers-thematiques/">Dossiers thématiques</a> » <a href="#"><?php echo  single_cat_title("", false); ?></a></div>
    </div>
     <div id="contentWrapper">
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        <article>
		<h1><?php echo  single_cat_title("", false); ?></h1>           
        
            <?php echo   wpautop($presentation); ?>
		
        <div id="recommandations">
	    <h3>La plateforme ELSA vous recommande</h3>
        <!-- Recommande -->
         <div class="recomWrapper">
            <?php 	$args = array('post_type' => array('post'), 'posts_per_page' => 5, 'cat' =>  $cat_id, 'meta_key' => 'homefiche', 'meta_value' => '1');
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
                 <div class="recom">
					<a href="<?php the_permalink();?>">
					<div class="leftProg">
						<?php the_post_thumbnail('medium');?>
                    </div>
                    <div class="rightProg">
						<span class="first_org"><?php echo cnLib::get_related_post($post->ID, 'first_org');?></span><br />
                        
                        <?php $cat= cnLib::get_terms_withoutlink($post->ID, 'category');
						$pays=cnLib::get_main_term_slug($post->ID, 'pays_assoc');?>
                        <?php if(!empty($cat) or !empty($pays)) :?>
                    <span class="category"><?php if(!empty($cat)) echo $cat;?><?php if(!empty($cat) && !empty($pays)) echo  ' - ';?><?php echo $pays;?></span><br /><?php endif;?>
                       
                        <span class="title"><?php the_title();?></span><br />
                        <span class="excerpt"><?php cnLib::the_excerpt_max_charlength(100); ?></span>
                        <!-- <?php echo cnLib::get_main_term_slug($post->ID, 'format');?> -->
                    </div>
                    </a>  
                </div> 
             <?php endwhile; wp_reset_query();wp_reset_postdata(); $args=null; ?>
        </div> 
        <!-- Recommande -->
        

         <!-- dernier -->
         <div class="derniersDocuments"> 
         <div class="dernierWrapper">
         <h4 class="derRes"><span>Dernières</span> ressources</h4>			
            <?php 	$args = array('post_type' => array('post'), 'posts_per_page' => 6, 'cat' =>  $cat_id);
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
                
                 <div class="derRessource">
					<a href="<?php the_permalink();?>">
                    <div class="titleDernier"><?php the_title();?></div>
                   <!-- <div class="sllDernier">Publié le <?php echo get_the_date('j M Y');?></div>-->
					<div class="sllDernier"><?php echo cnLib::get_related_post($post->ID, 'first_org');?></div>
                    <div class="sllDernier"><?php echo cnLib::get_main_term_slug($post->ID, 'pays_assoc');?></div>
                    </a>  
                </div> 
             <?php endwhile; wp_reset_query();wp_reset_postdata(); $args=null; ?>
        </div>
         <a href="/recherche-documentaire/?totalcat=<?php echo $cat_slug;?>" class="tousLesDocs">» tous les documents</a>
        </div>
        <!-- dernier -->
        <div class="clear"></div>
        </div>
        
        
	            
             <?php $cnSite->share_links();?>
             <div class="clear"></div>
        
        
        <div id="headerComments">     
             <div id="nbComments">Vos commentaires</div>
        <div id="bubbleComments"><span>
          <?php comments_number( '0', '1', '% ' ); ?>
          </span></div>
          
          </div>
			 <?php comments_template( '', true ); ?>

            
        </article>
        
        <aside id="sidebarCms">
        	<div class="shadowRight"></div>
        <div class="imgCat"><?php $src = wp_get_attachment_image_src($vignette[0], 'medium'); 
   			 $src = $src[0];
	   		 echo "<img src='{$src}' />";?></div>

        	<div id="descCat">
				<?php echo wpautop($details); ?>
                
               <?php //$cnSite::get_cat_tagcloud($cat_id);?>
        	</div>
        
        	<?php get_template_part( '_blocs/rss', 'feeds' ); ?>
            
          
              <?php get_template_part( '_blocs/side', 'dossierthematiques' ); ?>
        	 <?php get_template_part( '_blocs/side', 'reseau' ); ?>
            <?php get_template_part( '_blocs/side', 'fichepays' ); ?>
           <?php get_template_part( '_blocs/side', 'ressources' ); ?>
        </aside>
        <div class="clear"></div>
        
        
        
        
     </div>
</section>
<?php get_footer(); ?>