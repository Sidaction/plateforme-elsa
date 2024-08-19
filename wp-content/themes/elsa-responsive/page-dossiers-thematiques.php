<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Page Les dossiers thématiques
 Template Name: Les dossiers thématiques
 //////////////////////////////////////////////////////////////*/
 get_header(); ?>
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section id="contentSite" class="bleu">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="/dossiers-thematiques/">Dossiers thématiques</a></div>
    </div>
     <div id="contentWrapper">
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        <article class="noback">
        <h1><?php the_title();?></h1>
        <div class="dossiersThemContent"><?php the_content();?></div>
            
          <ul id="listThematiques">
            	<?php wp_list_categories('orderby=name&exclude=1&title_li='); ?> 
            </ul>
            
            <div class="clear"></div>
            <?php $cnSite->share_links();?>
               <div class="clear"></div>
          <hr class="shadowBottom" />
        
        <section id="rechercheThema">
             <?php get_template_part( '_blocs/form', 'search' ); ?>
        </section>
        
           
        </article>
        
		<aside id="sidebarCms">
        	<div class="shadowRight"></div>
        	
          <div class="imgTheme"><?php the_post_thumbnail('large');?></div>
          <!-- <div class="imgTheme"><img src="<?php echo $cnSite->templatelink; ?>/assets/img/thematiques.jpg" width="262" height="468" /></div> -->
		 <?php get_template_part( '_blocs/side', 'ressources' ); ?>
        </aside>
        <div class="clear"></div>
        
        
        
  </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>