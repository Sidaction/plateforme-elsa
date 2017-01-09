<?php get_header(); ?>


<section id="contentSite" class="marron home">

    
    <div id="sliderHome">

    </div>
    
    
    
     <div id="contentWrapper">
        
        <section id="rechercheThema" class="searchPage">
            <form id="rechRess" action="/recherche-documentaire/" class="minisearch">
            <div id="titleRechRess">Rechercher une ressource sur le VIH / Sida</div>
<div id="linksRechRess"><a href="<?php echo $cnSite->rootlink; ?>/aide-a-la-recherche/">» que chercher ?</a>   <a href="<?php echo $cnSite->rootlink; ?>/aide-a-la-recherche/">» comment chercher ?</a></div>
            <div class="clear"></div>
                <div id="recherche">
                <input type="text" placeholder="Mots clés, titre ou auteurs" name="totaltags" value=""/>
               <?php  cnLib::custom_taxonomy_dropdown('category','selectBox','Thématique','','',false,'','totalcat');?>
            		<?php cnLib::custom_taxonomies_dropdown("region, pays_assoc", "selectBox", "Pays",'','',false,'','pays_assoc',array(351,131,161,126,278)); ?>

                    <input type="hidden" name="totalpays" value="" />
            		<input type="hidden" name="totalregions" value="" />
                <button>OK</button>       
            <div class="clear"></div>
        </section>
        
        
        <article class="homepage">
        
        <div id="newsRessources">
	    <h3>Nouvelles ressources publiées</h3>
        <!-- Recommande -->
         <div class="recomWrapper">
         <div class="shadowLeft"></div>
            <?php 	$args = array('post_type' => array('post'), 'posts_per_page' => 5);
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
                 <div class="recom">
					<a href="<?php the_permalink();?>">
                    
                    <div class="format"><img src="<?php echo $cnSite->templatelink; ?>/_img/<?php echo cnLib::get_main_term_slug($post->ID, 'format');?>.png" /></div>
                  
                    
					<div class="leftProg">
						<?php the_post_thumbnail('medium');?>
                    </div>
                    <div class="rightProg">
						<span class="first_org"><?php echo $auteurs=$cnSite->get_authors($post->ID);?></span><br />
                        <?php $cat= cnLib::get_terms_withoutlink($post->ID, 'category');
							$pays=cnLib::get_main_term_slug($post->ID, 'pays_assoc');?>
                        <?php if(!empty($cat) or !empty($pays)) :?>
                    <span class="category"><?php if(!empty($cat)) echo $cat;?><?php if(!empty($cat) && !empty($pays)) echo  ' - ';?><?php echo $pays;?></span><br />
                    <?php endif;?>
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
         <div class="recomRight"> 
             <div class="pqRessources">
             <h4><span>Pourquoi un centre</span><br />ressources<br />francophone ?</h4>
             <hr />
             <?php $wp_query  = new WP_Query( 'pagename=bloc-home-pourquoi-un-centre-ressources');
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
			<?php the_content(); ?>
			<?php endwhile; wp_reset_query();wp_reset_postdata();?>
            
             </div>
         	 <div class="aPropos">
             <h4><span>A PROPOS DE</span><br />LA PLATEFORME ELSA</h4>
             <hr />
             <?php $wp_query  = new WP_Query( 'pagename=bloc-home-a-propos-de-la-plateforme');
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
			<?php the_content(); ?>
			<?php endwhile; wp_reset_query();wp_reset_postdata();?>
             </div>
             <div class="infoFinancement">
             <h4><span>Info</span><br />financement</h4>
             <hr />
             <?php $wp_query  = new WP_Query( 'pagename=bloc-home-info-financement');
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
			<?php the_content(); ?>
			<?php endwhile; wp_reset_query();wp_reset_postdata();?>
             </div>
        </div>
        <!-- dernier -->
        <div class="clear"></div>
        </div>
            
        </article>
        
		
        <aside id="sidebarCms">
        <div class="shadowRight"></div>
        
        <?php get_template_part( '_blocs/rss', 'feeds' ); ?>  
        
        
        <div id="nextEvtHome">
        <h5>Prochains événements</h5>
		  
		<div class="prochEvnts">
     	   <ul>
		  <?php 	
		  $today = cnDates::getTodayDate();
		  $args = array('post_type' => array('agenda'), 
		  'posts_per_page' =>-1, 
		  	'meta_key' => 'date-start',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'meta_query'=>array(
				'relation'=>'AND',
				array(
					'key' => 'date-end',
					'value' => $today,
					'compare' => '>=',
					'type' => 'CHAR'
				),
				array(
					'key' => 'home',
					'value' => 1
				)
			)	 
		  );
                    $wp_query = new WP_Query($args);
                        if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();
                         $date_debut = get_post_meta($post->ID, 'date-start', true);
                        $date_fin = get_post_meta($post->ID, 'date-end', true);?>
            
        
        <li>
            <div class="dateEvtHome"><?php echo cnDates::getPeriode($date_debut, $date_fin); ?></div>
            <div class="thumbHome"><?php the_post_thumbnail('medium');?></div>
			<div class="txtEvtHome">
				<?php the_title();?><br />
                <?php cnLib::the_excerpt_max_charlength(60); ?><br />
                <a href="/agenda-elsa/">» en savoir plus</a><br />
               <!-- <a href="/agenda-elsa/">» tous les événements</a>-->
            </div>
           <div class="clear"></div>
           
           </li>
          <?php endwhile; wp_reset_query();wp_reset_postdata(); $args=null; ?>
   		</ul>
        <script>	
		(function($) {
			$(function() {
				if($('.prochEvnts').length){
					$('.prochEvnts').jcarousel({
						wrap: 'circular'
					});
					$('.prochEvnts').jcarouselAutoscroll({
						autostart: true,
						interval: 5000
					});
					$('.prochEvnts').hover(function() {
						$(this).jcarouselAutoscroll('stop');
					}, function() {
						$(this).jcarouselAutoscroll('start');
					});
				}
			});
		})(jQuery);
		</script>
    </div>
   

        </div>
            <?php get_template_part( '_blocs/side', 'ressources' ); ?>  
        </aside>
        <div class="clear"></div>
        
        
        
     </div>
</section>

<?php get_footer(); ?>
