<?php 
/*
 * Single for Contenu post type
 */
 
   $cnSite->page_type = 'contenu';  
  $format = cnLib::get_main_term_slug($post->ID, 'format');
  $category = cnLib::get_main_term_slug($post->ID, 'category');
  $link = get_post_meta($post->ID, 'link', true);
  $link_crips = get_post_meta($post->ID, 'link_crips', true);
  $date_edition = get_post_meta($post->ID, 'date-start', true);
  $auteurs = $cnSite->get_authors_withlink($post->ID);
  $tools= get_post_meta($post->ID, 'outil', true);

  set_query_var( 'format', $format ); 
  set_query_var( 'category', $category ); 
  set_query_var( 'date_edition', $date_edition ); 
  set_query_var( 'link', $link ); 
  set_query_var( 'auteurs', $auteurs );     

get_header(); ?>

  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <?php

      if( has_term( 'video', 'format' ) || has_term( 'diaporama', 'format' ) ) {
          get_template_part('template-parts/content', 'media');
      }
      else {
        echo ' Ce contenu n\'est ni une vidéo, ni un diaporama et il n\'y a pas de chemin défini...';
        // get_template_part('template-parts/content', 'ressource');
      }
    ?>

  <?php endwhile; ?>

<?php get_footer(); ?>
