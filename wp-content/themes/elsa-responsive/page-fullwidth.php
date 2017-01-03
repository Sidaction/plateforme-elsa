<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Page 100%
 Template Name: Page 100%
 //////////////////////////////////////////////////////////////*/
 get_header(); ?>
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section id="contentSite" class="orange">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="#">Plateforme Elsa</a> » <a href="#">Qui sommes-nous ?</a></div>
    </div>
     <div id="contentWrapper">
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        <article class="fullPage">
        <div class="shadowLeftFull"></div>
        
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
        
           <?php the_content();?>
            <div class="clear"></div> 
           <?php $cnSite->share_links();?>
           <div class="clear"></div> 
        </article>
     </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>