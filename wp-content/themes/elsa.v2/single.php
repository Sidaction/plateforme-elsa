<?php 
/*
 * Fiche ressource (post)
 */
 


  $cnSite->page_type = 'ressource';	
  $format = cnLib::get_main_term_slug($post->ID, 'format');
  $category = cnLib::get_main_term_slug($post->ID, 'category');
  $link = get_post_meta($post->ID, 'link', true);
  $embed = get_post_meta($post->ID, 'embed', true);
  $link_crips = get_post_meta($post->ID, 'link_crips', true);
  $date_edition = get_post_meta($post->ID, 'date-start', true);
  $auteurs = $cnSite->get_authors_withlink($post->ID);
  $tools= get_post_meta($post->ID, 'outil', true);

  set_query_var( 'cnSite', $cnSite ); 
  set_query_var( 'format', $format ); 
  set_query_var( 'category', $category ); 
  set_query_var( 'date_edition', $date_edition ); 
  set_query_var( 'link', $link ); 
  set_query_var( 'embed', $embed ); 
  set_query_var( 'auteurs', $auteurs );     

  get_header(); 
?>



<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


    <?php
      // AIGUILLER SI MEDIAS OU RESSSOURCE "SIMPLE" (pdf, link, etc.)
      if( has_term( 'video', 'format' ) || has_term( 'diaporama', 'format' )  || has_term( 'audio', 'format' )) {
          get_template_part('template-parts/content', 'media');
      }
      else {
        get_template_part('template-parts/content', 'ressource');
      }
    ?>



    <?php $rebonds = get_field('rebonds_default', 'option'); ?>
    <?php if( $rebonds) : ?>
    <aside class="blocs_group--rebonds">
      <div class="wrap row">

        <div class="group_title m-2col dark">
          <h3 class="A lire aussi">A lire aussi</h3>
        </div>
        
        <div class="group_list">
          <?php $i = 1; ?>
          <?php foreach ( $rebonds as $post ) : setup_postdata( $post ); ?>

              <?php 
                $post_type = $post->post_type; 
                switch ($post_type) {
                  case 'page':
                    $type = 'statique';
                    break;

                  case 'post':
                    if( true ) {
                      $type = 'ressource';
                    } else {
                      $type = 'media';
                    }
                    break;
                  
                  default:
                    $type = 'ressource';
                    break;
                }
              ?>

                    <?php if( $i % 4 == 0 ) : ?>
                        <div class="m-2col m-clearfix">

                    <?php else : ?>
                        <div class="m-2col">

                    <?php endif; ?>
                        
                        <?php set_query_var( 'type', $type ); ?>
                        <?php set_query_var( 'cnSite', $cnSite ); ?>
                        <?php get_template_part('template-parts/parts/part', 'bloc'); ?>

                      </div><!-- end .col -->

                <?php $i++; ?>                  

            <?php endforeach; ?>


        </div><!-- .group_list -->

      </div><!-- .row -->
    </aside>
    <?php endif; ?>
   
  </div>
</section>



<?php endwhile; ?>

<?php get_footer(); ?>
