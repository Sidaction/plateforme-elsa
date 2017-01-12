<?php 

/*
 * Page "Nos médias"
 * Template Name: Page archives médias
 */

get_header(); ?>

 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <section id="site-content" class="site-content single-ressource">

    <article class="main-content clearfix noback">
        
        <div class="page_title ressource_title">
       
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
                            'format' => array('video', 'diaporama'),
                            'post_status' => 'publish',
                            'paged' => get_query_var( 'paged' )
                        );


                        $the_query = new WP_Query( $args ); 
                        $totalpages = $the_query->max_num_pages;?>

                        <?php if ( $the_query->have_posts() ) : ?>

                            <div class="navDlSearch results_nav clearfix">
                                <select class="selectBox" id="pager1">
                                    <option value="10">10 résultats par page</option>
                                    <option value="20">20 résultats par page</option>
                                    <option value="50">50 résultats par page</option>
                                    <option value="-1">Tous les résultats</option>
                                </select>
                                <?php cnLib::pagination($totalpages); ?>
                            </div>


                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                <?php get_template_part('template-parts/parts/part', 'media'); ?>
                            <?php endwhile; ?>


                            <div class="navDlSearch results_nav clearfix">
                                <select class="selectBox" id="pager1">
                                    <option value="10">10 résultats par page</option>
                                    <option value="20">20 résultats par page</option>
                                    <option value="50">50 résultats par page</option>
                                    <option value="-1">Tous les résultats</option>
                                </select>
                                <?php cnLib::pagination($totalpages); ?>
                            </div>

                            <?php wp_reset_postdata(); ?>

                        <?php else : ?>
                            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                        <?php endif; ?>


                </div>

            </div><!-- .wrap -->
        </div><!-- .page_content -->

    </article>



    <aside class="blocs_group--rebonds bg-cut">
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