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

                <div class="row"> Pagination</div>

                <div class="row">

                    <?php

                        $args = array(
                            'posts_per_page' => 4,
                            'post_type' => array('post', 'contenu'),
                            'format' => 'video',
                            'post_status' => 'publish'
                        );
                        $medias = get_posts( $args ); 

                        foreach ( $medias as $post ) : setup_postdata( $post ); ?>

                            <?php get_template_part('template-parts/parts/part', 'media'); ?>


                        <?php endforeach; 
                        wp_reset_postdata();?>


                </div>

                <div class="row"> Pagination</div>


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