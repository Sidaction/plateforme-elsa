<?php 
/*
 * Fiche ressource (post)
 */
 


  $cnSite->page_type = 'ressource';	
  $format = cnLib::get_main_term_slug($post->ID, 'format');
  $category = cnLib::get_main_term_slug($post->ID, 'category');
  $link = get_post_meta($post->ID, 'link', true);
  $link_crips = get_post_meta($post->ID, 'link_crips', true);
  $date_edition = get_post_meta($post->ID, 'date-start', true);
  $auteurs = $cnSite->get_authors_withlink($post->ID);
  $tools= get_post_meta($post->ID, 'outil', true);

  set_query_var( 'cnSite', $cnSite ); 
  set_query_var( 'format', $format ); 
  set_query_var( 'category', $category ); 
  set_query_var( 'date_edition', $date_edition ); 
  set_query_var( 'link', $link ); 
  set_query_var( 'auteurs', $auteurs );     

  get_header(); 
?>



<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


  <section id="site-content" class="site-content single-ressource">


    <?php
      // AIGUILLER SI MEDIAS OU RESSSOURCE "SIMPLE" (pdf, link, etc.)
      if( has_term( 'video', 'format' ) || has_term( 'diaporama', 'format' ) ) {
          get_template_part('template-parts/content', 'media');
      }
      else {
        get_template_part('template-parts/content', 'ressource');
      }
    ?>


    <aside class="blocs_group--rebonds">
      <div class="wrap row">

        <div class="group_title m-2col">
          <h3 class="A lire aussi">A lire aussi</h3>
        </div>
        
        <div class="group_list">
          <div class="group_bloc m-2col">hello</div>
          <div class="group_bloc m-2col">hello</div>
          <div class="group_bloc m-2col">hello</div>
        </div>

      </div>
    </aside>

   
  </div>
</section>



<?php endwhile; ?>

<?php get_footer(); ?>
