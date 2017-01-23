<?php 

/*
 * Page "Nos médias"
 * Template Name: Page archives médias
 */

$rebonds = get_field('rebonds_default', 'option'); 

get_header(); ?>


 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <section id="site-content" class="site-content single-ressource">

    <article class="main-content clearfix noback">
        
        <div class="page_title archives_title">
       
            <div class="wrap row">
                <h1 class="h1 m-6col is-centered">
                    <?php the_title(); ?>
                </h1>  
            </div>     
        
        </div>

        <div class="page_content clearfix">
            <div class="wrap">


                <div class="row">

                    <?php

                        $args = array(
                            'posts_per_page' => 10,
                            'post_type' => array('post', 'contenu'),
                            'format' => array('video', 'diaporama', 'audio'),
                            'post_status' => 'publish',
                            'paged' => get_query_var( 'paged' )
                        );


                        $the_query = new WP_Query( $args ); 
                        $totalpages = $the_query->max_num_pages;?>

                        <?php if ( $the_query->have_posts() ) : ?>
                            <?php $i = 0; ?>
                            <div class="results_nav clearfix row">
                                <div class="nav_postperpage m-2col">
                                    <select class="selectBox" id="pager1">
                                        <option value="10">10 résultats par page</option>
                                        <option value="20">20 résultats par page</option>
                                        <option value="50">50 résultats par page</option>
                                        <option value="-1">Tous les résultats</option>
                                    </select>
                                </div>
                                <div class="nav_pager m-5col m-last">
                                    <?php cnLib::pagination($totalpages); ?>
                                </div>
                            </div>


                            <div class="row">
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                                <?php set_query_var( 'type', 'media' ); ?>
                                <?php set_query_var( 'cnSite', $cnSite ); ?>

                                <?php if ( $i % 2 == 0 ) : ?>
                                    <div class="m-4col m-clearfix">

                                <?php else : ?>
                                    <div class="m-4col">

                                <?php endif; ?>

                                        <?php get_template_part('template-parts/parts/part', 'bloc'); ?>
                                    </div>

                                <?php $i++; ?>

                            <?php endwhile; ?>
                            </div>

                            <div class="results_nav clearfix row">
                                <div class="nav_postperpage m-2col">
                                    <select class="selectBox" id="pager1">
                                        <option value="10">10 résultats par page</option>
                                        <option value="20">20 résultats par page</option>
                                        <option value="50">50 résultats par page</option>
                                        <option value="-1">Tous les résultats</option>
                                    </select>
                                </div>
                                <div class="nav_pager m-5col m-last">
                                    <?php cnLib::pagination($totalpages); ?>
                                </div>
                            </div>

                            <?php wp_reset_postdata(); ?>

                        <?php else : ?>
                            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                        <?php endif; ?>


                </div>

            </div><!-- .wrap -->
        </div><!-- .page_content -->

    </article>



    <aside class="blocs_group--rebonds">
      <div class="wrap row">

        <div class="group_title m-2col dark">
          <h3 class="h3_alt">A lire aussi</h3>
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



   
  </div>
</section>


<?php endwhile; ?>
<?php get_footer(); ?>