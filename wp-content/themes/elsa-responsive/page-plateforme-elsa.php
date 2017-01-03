<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Page Plateforme Elsa
 Template Name: Page Plateforme Elsa
 //////////////////////////////////////////////////////////////*/
 $cnSite->page_type='pays';
 get_header(); ?>
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
 $pays=$post->post_name;
 $format=cnLib::get_main_term_slug($post->ID, 'format');
 ?>

<section id="contentSite" class="orange">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="#"><?php the_title();?></a></div>
    </div>
     <div id="contentWrapper">
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        <article>
        
        	<div class="blockPlateforme">

            
            <?php $wp_query  = new WP_Query( 'pagename=/plateforme-elsa/qui-sommes-nous/');
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
			<h2><?php  the_title();?></h2>
			<?php the_excerpt(); ?>
             <a href="<?php the_permalink(); ?>">» en savoir plus</a>
			<?php endwhile; wp_reset_query();wp_reset_postdata();?>
            </div>
            
            <div class="blockPlateforme">
            	 <?php $wp_query  = new WP_Query( 'pagename=/plateforme-elsa/associations-membres-de-la-plateforme-elsa/');
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
			<h2><?php  the_title();?></h2>
			<?php the_excerpt(); ?>
             <a href="<?php the_permalink(); ?>">» Découvrez les programmes des associations membres</a>
			<?php endwhile; wp_reset_query();wp_reset_postdata();?>
            </div>
            
            <div class="blockPlateforme">
            	 <?php $wp_query  = new WP_Query( 'pagename=/plateforme-elsa/fonctionnement-et-activites-delsa/');
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
			<h2><?php  the_title();?></h2>
			<?php the_excerpt(); ?>
             <a href="<?php the_permalink(); ?>">» Découvrez le programme 2012-2015</a>
			<?php endwhile; wp_reset_query();wp_reset_postdata();?>
            </div>
            
            <div class="blockPlateforme">
            	<?php $wp_query  = new WP_Query( 'pagename=/plateforme-elsa/associations-partenaires-de-la-plateforme-elsa/');
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
			<h2><?php  the_title();?></h2>
			<?php the_excerpt(); ?>
             <a href="<?php the_permalink(); ?>">» Découvrez nos partenaires</a>
			<?php endwhile; wp_reset_query();wp_reset_postdata();?>
            </div>
            
            <div class="blockPlateforme">
            	<h2>Intranet des membres de la plateforme ELSA</h2>
                 <a href="/extranet/" target="_blank">» Accédez à l'intranet</a>
            </div>
            
            <div class="blockPlateforme">
            	<?php $wp_query  = new WP_Query( 'pagename=/plateforme-elsa/soutiens/');
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
			<h2><?php  the_title();?></h2>
			<?php the_excerpt(); ?>
             <a href="<?php the_permalink(); ?>">» en savoir plus</a>
			<?php endwhile; wp_reset_query();wp_reset_postdata();?>
            </div>
        
            <section id="rechercheThema">
                 <?php get_template_part( '_blocs/form', 'search' ); ?>
            </section>
        </article>      
              
        <aside id="sidebarCms" class="noMargin">
        	<div class="shadowRight"></div> 
          
         <div class="actusPlateforme">
                 <h2>Actualités <span>de la plateforme</span></h2>
                 <?php $wp_query  = new WP_Query( 'pagename=/plateforme-elsa/actualites/');
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
			<?php the_content(); ?>
             
			<?php endwhile; wp_reset_query();wp_reset_postdata();?>
               
                <div class="clear"></div>
                </div>
          

          <?php get_template_part( '_blocs/side', 'ressources' ); ?>
                
         </aside>
        <div class="clear"></div>
        
        
     </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>