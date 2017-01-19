<?php 
    /* 
     * Page par défaut.
     * Template Name: Page Ma séléction
     */

get_header(); ?>

 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <section id="site-content" class="site-content page">

    <article class="main-content clearfix noback">

        <?php if( has_post_thumbnail() ) { ?> 
            <div class="page_title-outer bg_cover" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
        <?php } ?>

            <div class="page_title page_title">

                <div class="wrap row">
                    <h1 class="h1 m-6col is-centered">
                        <?php echo the_title(); ?>
                    </h1>  
                </div>     
            
            </div>

        <?php if( has_post_thumbnail() ) { ?> 
            </div>
        <?php } ?>

        <div class="page_content clearfix">
            <div class="wrap row">

                <?php the_content(); ?>

                <?php echo do_shortcode( '[gema75_ril]' ); ?>

            </div><!-- .wrap -->
        </div><!-- .page_content -->

    </article>

   
  </div>
</section>


<?php endwhile; ?>
<?php get_footer(); ?>