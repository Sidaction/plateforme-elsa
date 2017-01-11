<?php 
/*
 * Page Annuaire
 * Template Name: Page Annuaire
 */
 

  $args = array(
    'post_type' => array('structure'), 
    'posts_per_page' => -1, 
    'orderby' => 'title', 
    'order' => 'ASC',
    'type_structure' => 'partenaires-elsa-associations-du-reseau-elsa');
 
  $args['pays_assoc'] =  $_GET['pays_assoc'];
  $args['activites'] = $_GET['activites'];
  $args['public_cibles'] = $_GET['public_cibles'];
 
  $_SESSION['argstructures'] = $args;
  $results = array();
 
  get_header(); 
?>


 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



  <section id="site-content" class="site-content search-results">


    <article class="main-content clearfix noback">
        <div class="page_title archives_title">

          <div class="wrap">
              <h1 class="h1">
                  <?php the_title();?>
              </h1>
              Vous avez <?php echo $wp_query->found_posts;?> résultats...
          </div>     
        
        </div>

        <?php the_content();?>

        <div class="search_filters bg-cut blocs_group">
          <div class="wrap row">

            <div class="group_title m-2col">
              Filtre d'affichage
              <div class="exportxls"><a href="../extract">Exporter au format xls</a></div>
            </div>
            
            <div class="m-6col">
              <form id="rech">
                <?php cnLib::custom_taxonomy_dropdown("pays_assoc", "selectBox", "Pays",'','',false); ?>
                <?php cnLib::custom_taxonomy_dropdown("public_cibles", "selectBox", "Publics cibles",'','',false); ?>
                <?php cnLib::custom_taxonomy_dropdown("activites", "selectBox", "Activités",'','',false); ?>
              </form>
            </div>

          </div>
        </div>


      <div class="search_list bg-cut">
        <div class="wrap ">          

            <ul class="no-bullets">

              <?php $wp_query = new WP_Query(); $wp_query->query($args); ?>
              
              <?php if ($wp_query->have_posts()) ?> 
              
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
              
                  $email=get_post_meta($post->ID, 'email', true);
                  $link=get_post_meta($post->ID, 'link', true);?>

                    <li class="search-item">
                      <a href="<?php the_permalink();?>"><?php the_title();?></a>
                        
                        <?php echo cnLib::get_terms_withoutlink($post->ID, "pays_assoc", $separ = ", ");?>
                        <?php echo cnLib::get_terms_withoutlink($post->ID, "public_cibles", $separ = ", ");?></td>
                        <?php echo cnLib::get_terms_withoutlink($post->ID, "activites", $separ = ", ");?></td>
                        <?php echo get_post_meta($post->ID, 'tel', true);?></td>
                        <?php if(!empty($link)):?><a href="<?php echo $link;?>" class="webIco" target="_blank"></a><?php endif;?></td>
                       <?php if(!empty($email)):?><a href="mailto:<?php echo $email;?>"></a><?php endif;?></td>
                    </li>

                <?php endwhile; wp_reset_query(); wp_reset_postdata(); $args=null; ?>


            </ul>

        </div><!-- search_list -->
      </div>

  </section><!-- .site-content -->



<script>
  $(window).ready(function(){
		$(".selectBox").change(function(){$('#rech').submit()});	
 })
</script>



<?php endwhile; ?>
<?php get_footer(); ?>