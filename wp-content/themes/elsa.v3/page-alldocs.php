<?php 
    /* 
     * Template Name: Tous les documents ELSA 
     */

    $title = get_the_title();
    $root = get_the_ID();
    set_query_var( 'cnSite', $cnSite );

    get_header(); 
?>

 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <section id="site-content" class="site-content page">

    <article class="main-content clearfix noback">

        <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $root ), 'large' ); ?>

        <?php if( $large_image_url) { ?> 
            <div class="page_title-outer page_cover bg_cover" style="background-image: url(<?php echo $large_image_url[0]; ?>)"></div>
        <?php } ?>

        <?php if( !$large_image_url ) { ?>
            <div class="page_nocover"></div>

                <div class="page_title static_title">
                    <div class="wrap row">
                        <h1 class="h1 m-6col is-centered text-on-center">
                            <?php echo $title; ?>
                        </h1>  
                    </div>     
                </div>

        <?php } ?>


        <div class="page_content clearfix">
            <section class="wrap row">

                    <div class="m-6col is-centered">
                        <?php if( is_array($large_image_url) ) { ?> 
                            <h1 class="h1">
                                <?php echo $title; ?>
                            </h1>  
                        <?php } ?>

                        <?php the_content(); ?>


                    
                    </div>

            </section><!-- .wrap -->


            <section class="home_featured_docs m-clearfix">
                <div class="wrap">
                                

                                <div class="docs_container">
                                    <?php
                                    $featured_posts = get_field('docs_files');
                                    if( $featured_posts ): ?>
                                        <?php foreach( $featured_posts as $post ): 

                                            setup_postdata($post); ?>
                                            <div class="doc_item">
                                                <?php set_query_var( 'type', 'statique' ); ?>

                                                <?php get_template_part('template-parts/parts/part', 'bloc-image'); ?>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php 
                                        wp_reset_postdata(); ?>
                                    <?php endif; ?>

                                </div>


                </div>
            </section>

    

        </div><!-- .page_content -->

    </article>


    <?php get_template_part('template-parts/content', 'rebonds'); ?>


   
  </div>
</section>


<?php endwhile; ?>
<?php get_footer(); ?>