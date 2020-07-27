<?php 

/*
 * Page "Offres d'emploi"
 * Template Name: Page Offres d'emploi
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


              <div class="agenda_filters">
  
                <form id="searchJobs" action="/offres-demploi/" class="">

                  <div class="row filter_group">

                    <div class="filter-thematique m-2col m-clearfix">
                          <div class="input--select">
                            <?php cnLib::custom_taxonomy_dropdown('emploi_lieu','selectBox','Lieu','','',false);?>
                            <span class="icon-arrow_right-big"></span>
                          </div>
                    </div>
                    
                    <div class="filter-date m-2col">
                          <div class="input--select">
                            <?php cnLib::custom_taxonomy_dropdown('emploi_contrat','selectBox','Type de contrat','','',false);?>
                            <span class="icon-arrow_right-big"></span>
                          </div>
                    </div>

                    <div class="m-2col">
                        <input type="submit" id="formatbtn" class="btn-primary plain" value="Filtrer">
                    </div>

                  </div>
                
                </form>

              </div>

                  <div>
                    <?php

                        $args = array(
                            'posts_per_page' => 16,
                            'post_type' => array('emploi'),
                            'post_status' => 'publish',
                            'paged' => get_query_var( 'paged' )
                        );

                        // SI lieu
                        if(isset($_GET['emploi_lieu'])) {
                          $args['emploi_lieu'] = $_GET['emploi_lieu'];
                        } 
                        else {
                          $args['emploi_lieu'] = '';
                        }

                        // SI Type contrat
                        if(isset($_GET['emploi_contrat'])) {
                          $args['emploi_contrat'] = $_GET['emploi_contrat'];
                        } 
                        else {
                          $args['emploi_contrat'] = '';
                        }



                        $the_query = new WP_Query( $args ); 
                        $totalpages = $the_query->max_num_pages;?>

                        <?php if ( $the_query->have_posts() ) : ?>

                            <div class="row medias_list">
                                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                                    <?php set_query_var( 'type', 'media' ); ?>
                                    <?php set_query_var( 'cnSite', $cnSite ); ?>

                                    <?php get_template_part('template-parts/parts/part', 'emploi'); ?>

                                <?php endwhile; ?>
                            </div>

                            <div class="results_nav clearfix row">
                                <div class="nav_pager-bottom m-5col m-last">
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


   
  </div>
</section>


<?php endwhile; ?>
<?php get_footer(); ?>