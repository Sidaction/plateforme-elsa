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

                <div class="agenda_filters">
                  

                    <form id="searchEvents" action="/agenda/" class="">

                        <div class="row filter_group">

                            <div class="filter-thematique m-2col m-clearfix">
                              <div class="input--select">
                                <?php cnLib::custom_taxonomy_dropdown('evenement_type','selectBox','Type évenement','','',false);?>
                                <span class="icon-arrow_right-big"></span>
                              </div>
                            </div>

                            <div class="filter-date m-2col">
                              <div class="input--select">
                                <?php cnLib::custom_taxonomy_dropdown('evenement_lieu','selectBox','Pays / En ligne','','',false);?>
                                <span class="icon-arrow_right-big"></span>
                              </div>
                            </div>

                            <div class="filter-date m-2col">
                              <div class="input--select">
                                <?php cnLib::custom_taxonomy_dropdown('category','selectBox','Thématique','','',false);?>
                                <span class="icon-arrow_right-big"></span>
                              </div>
                            </div>

                            <div class="m-2col">
                                <input type="submit" id="formatbtn" class="btn-primary plain" value="Filtrer">
                            </div>

                        </div>
                    </form>

                </div><!-- end .agenda_filters -->

                <div class="agenda_events">

                    <?php
                        
                        $date_now = date('Y-m-d H:i:s');

                        $args = array(
                            'posts_per_page'    => 16,
                            'post_type'         => array('evenement'),
                            'post_status'       => 'publish',
                            'paged'             => get_query_var( 'paged' ),
                            'meta_key'          => 'date_evenement',
                            'orderby'           => 'meta_value_num',
                            'order'             => 'ASC',
                            'meta_type'         => 'DATETIME',
                            'meta_query'        => array(
                                array(
                                    'key'           => 'date_evenement',
                                    'compare'       => '>=',
                                    'value'         => $date_now,
                                    'type'          => 'DATETIME',
                                )
                            ),
                        );


                        // SI type d'évenement is set
                        if(isset($_GET['evenement_type'])) {
                          $args['evenement_type'] = $_GET['evenement_type'];
                        } 
                        else {
                          $args['evenement_type'] = '';
                        }

                        // Si Pays / En ligne is set
                        if(isset($_GET['evenement_lieu'])) {
                          $args['evenement_lieu'] = $_GET['evenement_lieu'];
                        } 
                        else {
                          $args['evenement_lieu'] = '';
                        }

                        // Si thématique is set
                        if(isset($_GET['category'])) {
                          $args['category_name'] = $_GET['category'];
                        } 
                        else {
                          $args['category_name'] = '';
                        }






                        $the_query = new WP_Query( $args ); 
                        $totalpages = $the_query->max_num_pages;?>

                        <?php if ( $the_query->have_posts() ) : ?>

                            <div class="row events_list">
                                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                                    <?php set_query_var( 'type', 'media' ); ?>
                                    <?php set_query_var( 'cnSite', $cnSite ); ?>

                                    <?php get_template_part('template-parts/parts/part', 'evenement'); ?>

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

                    </div>

            </div><!-- .wrap -->
        </div><!-- .page_content -->

    </article>


   
  </div>
</section>


<?php endwhile; ?>
<?php get_footer(); ?>