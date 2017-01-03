<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Page Annuaire
 Template Name: Page Annuaire
 //////////////////////////////////////////////////////////////*/
 
  $args = array('post_type' => array('structure'), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC','type_structure' => 'partenaires-elsa-associations-du-reseau-elsa');
 
 $args['pays_assoc'] =  $_GET['pays_assoc'];
 $args['activites'] = $_GET['activites'];
 $args['public_cibles'] = $_GET['public_cibles'];
 



  $_SESSION['argstructures']=$args;

  $results=array();


 
 get_header(); ?>
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section id="contentSite" class="orange">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="/associations-africaines-du-reseau-elsa">Associations africaines du réseau ELSA</a> » <a href="#">Annuaire</a></div>
    </div>
     <div id="contentWrapper">
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        <article class="fullPage">
        <h1><?php the_title();?></h1>
           <?php the_content();?>
           <div class="exportxls"><a href="../extract">Exporter au format xls</a></div>
           <div class="clear"></div>
           
           <hr class="shadowBottom" />
           
           <form id="rech">
             <table width="940" id="triAssos">
                  <tr id="firstLine">
                    <td class="nom">
                    	<!--<div class="triTop"><a href="#"></a></div>
                        <div class="triBot"><a href="#"></a></div>-->
                        Nom
                    </td>
                    <td class="zonegeo">
                    	<!--<div class="triTop"><a href="#"></a></div>
                        <div class="triBot"><a href="#"></a></div>-->
                    	Zone géographique<br />
                    </td>
                    <td class="public">
                    	<!--<div class="triTop"><a href="#"></a></div>
                        <div class="triBot"><a href="#"></a></div>-->
                        Public cibles
                    </td>
                    <td class="activites">
                    	Activités
                    </td>
                    <td class="telephone">Téléphone</td>
                    <td class="site">Site web</td>
                    <td class="contact">Email</td>
                  </tr>
                  <tr id="selectLine">
                    <td class="nom"><a href="#">&nbsp;</a></td>
                    <td class="zonegeo">
                    	<?php cnLib::custom_taxonomy_dropdown("pays_assoc", "selectBox", "Pays",'','',false); ?>
                    </td>
                    <td class="public">
                    	<?php cnLib::custom_taxonomy_dropdown("public_cibles", "selectBox", "Publics cibles",'','',false); ?>
                    </td>
                    <td class="activites">
                    	<?php cnLib::custom_taxonomy_dropdown("activites", "selectBox", "Activités",'','',false); ?>
                    </td>
                    <td class="telephone">&nbsp;</td>
                    <td class="site">&nbsp;</td>
                    <td class="contact">&nbsp;</td>
                  </tr>
                  
                  <?php   $wp_query = new WP_Query(); $wp_query->query($args);
				  if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post(); 
				  $email=get_post_meta($post->ID, 'email', true);
				   $link=get_post_meta($post->ID, 'link', true);?>
                  <tr>
                    <td class="nom"><a href="<?php the_permalink();?>"><?php the_title();?></a></td>
                    <td class="zonegeo"><?php echo cnLib::get_terms_withoutlink($post->ID, "pays_assoc", $separ = ", ");?> </td>
                    <td class="public"><?php echo cnLib::get_terms_withoutlink($post->ID, "public_cibles", $separ = ", ");?></td>
                    <td class="activites"><?php echo cnLib::get_terms_withoutlink($post->ID, "activites", $separ = ", ");?></td>
                    <td class="telephone"><?php echo get_post_meta($post->ID, 'tel', true);?></td>
                    <td class="site"><?php if(!empty($link)):?><a href="<?php echo $link;?>" class="webIco" target="_blank"></a><?php endif;?></td>
                    <td class="contact"><?php if(!empty($email)):?><a href="mailto:<?php echo $email;?>"></a><?php endif;?></td>
                  </tr>
                  <?php endwhile; wp_reset_query();wp_reset_postdata(); $args=null;?>
                  
                  
                </table>
           </form>
           
           <div class="clear"></div>
           
           <?php $cnSite->share_links();?>
               <div class="clear"></div>
           
           <article class="bottomAnnuaire">
                <section id="rechercheThema">
                     <?php get_template_part( '_blocs/form', 'search' ); ?>
                </section>
           </article>
           <aside id="sidebarCms" class="bottomAnnuaire">
           <?php get_template_part( '_blocs/side', 'ressources' ); ?>
           </aside>
            <div class="clear"></div>
            <hr class="shadowBottom" />
        </article>
     </div>
</section>
<script>

$(window).ready(function(){

		$(".selectBox").change(function(){$('#rech').submit()});	


 })
</script>
<?php endwhile; ?>
<?php get_footer(); ?>