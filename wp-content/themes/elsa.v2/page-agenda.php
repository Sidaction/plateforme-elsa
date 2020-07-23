<?php 

/*
 * Page "Agenda"
 * Template Name: Page Agenda
 */

$rebonds = get_field('rebonds_default', 'option'); 

get_header(); ?>


 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <section id="site-content" class="site-content medias_archives">

    <article class="main-content clearfix noback">
        
        <div class="page_title static_title">
       
            <div class="wrap row">
                <h1 class="h1 m-6col is-centered text-on-center">
                    <?php the_title(); ?>
                </h1>
            </div>     
        
        </div>

        <div class="page_content clearfix">
            <div class="wrap">

                    <?php

                        $args = array(
                            'posts_per_page' => 16,
                            'post_type' => array('evenement'),
                            'post_status' => 'publish',
                            'paged' => get_query_var( 'paged' )
                        );

                        $the_query = new WP_Query( $args ); 
                        $totalpages = $the_query->max_num_pages;?>

                        <?php if ( $the_query->have_posts() ) : ?>

                            <div class="row medias_list">
                                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                                    <?php set_query_var( 'type', 'media' ); ?>
                                    <?php set_query_var( 'cnSite', $cnSite ); ?>

                                    <?php get_template_part('template-parts/parts/part', 'bloc'); ?>

                                <?php endwhile; ?>
                            </div>

                            <div class="results_nav clearfix row">
                                <div class="nav_pager-bottom m-5col m-last">
                                    <?php cnLib::pagination($totalpages); ?>
                                </div>
                            </div>

                            <?php wp_reset_postdata(); ?>

                        <?php else : ?>
                            <p><?php _e( 'Désolé, il n\'y a aucun post correspondant.' ); ?></p>
                        <?php endif; ?>

            </div><!-- .wrap -->
        </div><!-- .page_content -->

    </article>


   
  </div>
</section>


<?php endwhile; ?>
<?php get_footer(); ?>