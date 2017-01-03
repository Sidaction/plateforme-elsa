<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 //////////////////////////////////////////////////////////////*/
 get_header(); ?>
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section id="contentSite" class="orange">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="/plateforme-elsa/">Plateforme Elsa</a> » <a href="#"><?php the_title();?></a></div>
    </div>
     <div id="contentWrapper">
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        <article>
        <h1><?php the_title();?></h1>
           <?php the_content();?>
            
           <?php $cnSite->share_links();?>
            
        </article>
        <?php get_sidebar(); ?>
     </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>