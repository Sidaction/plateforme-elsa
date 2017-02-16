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
 
  if( isset($_GET['pays_assoc']) ) {
    $args['pays_assoc'] = $_GET['pays_assoc'];
  }

  if( isset($_GET['activites']) ) {
    $args['activites'] = $_GET['activites'];
  }

  if( isset($_GET['public_cibles']) ) {
    $args['public_cibles'] = $_GET['public_cibles'];
  }

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
          </div>     
        
        </div>

        <div class="page_content">
          <div class="wrap row">
            <div class="m-4col">
              <?php the_content();?>
            </div>
            <div class="page_media m-3col m-last">
              <?php the_post_thumbnail(); ?>
            </div>
          </div>
        </div>
        
        <div class="search_filters bg-cut blocs_group">
          <div class="wrap row">

            <div class="group_title m-2col">
              <h3 class="h3_alt">Affiner votre recherche</h3>

              <div class="group_title_actions">
                <a href="../extract-structure" class="btn-inline">Télécharger la liste</a>
              </div>
            
            </div>
            
            <div class="">
              <form id="assos_filters">

                <div class="m-3col">
                  <div class="input--select">
                    <?php cnLib::custom_taxonomy_dropdown("pays_assoc", "js-selectBox", "Pays",'','',false); ?>
                    <span class="icon-arrow_right-big"></span>
                  </div>
                </div>

                <div class="m-3col">  
                  <div class="input--select">
                    <?php cnLib::custom_taxonomy_dropdown("public_cibles", "js-selectBox", "Publics cibles",'','',false); ?>
                    <span class="icon-arrow_right-big"></span>
                  </div>
                </div>

                <div class="m-6col">  
                  <div class="input--select">
                    <?php cnLib::custom_taxonomy_dropdown("activites", "js-selectBox", "Domaines d'intervention",'','',false); ?>
                    <span class="icon-arrow_right-big"></span>
                  </div>
                </div>
              </form>
            
              <div class="m-6col asso_filter_name"></div>

              <?php if( isset($_GET['pays_assoc']) && $_GET['pays_assoc'] != '' ) {
                // $pays = get_term_by('slug', $_GET['pays_assoc'], 'pays_assoc'); 
                // $name = $pays->name; 
                // echo 'Vous avez filtré sur un "pays" : <span class="meta">' . $name . '</span>';
              }

              if( isset($_GET['activites']) && $_GET['activites'] != ''  ) {
                // $activites = get_term_by('slug', $_GET['activites'], 'activites'); 
                // $name = $activites->name; 
                // echo 'Vous avez filtré sur une a"ctivité"" : <span class="meta">' . $name . '</span>';
              }

              if( isset($_GET['public_cibles']) && $_GET['public_cibles'] != ''  ) {
                // $public_cibles = get_term_by('slug', $_GET['public_cibles'], 'public_cibles'); 
                // $name = $public_cibles->name; 
                // echo 'Vous avez filtré sur un "public cible" : <span class="meta">' . $name . '</span>';
              } ?>

            </div>

          </div>

          <div class="wrap search_list">          

            <ul class="no-bullets">

              <?php $wp_query = new WP_Query(); $wp_query->query($args); ?>
              
              <?php if ($wp_query->have_posts()) ?> 
              
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
              
                  $email = get_post_meta($post->ID, 'email', true);
                  $link = get_post_meta($post->ID, 'link', true);

                  set_query_var( 'email', $email );
                  set_query_var( 'link', $link );
                  set_query_var( 'cnSite', $cnSite );

                  get_template_part('template-parts/parts/part', 'listitem-assos');

                endwhile; wp_reset_query(); wp_reset_postdata(); $args=null; ?>

            </ul>

          </div><!-- search_list -->
      </div>

  </section><!-- .site-content -->




<?php endwhile; ?>
<?php get_footer(); ?>