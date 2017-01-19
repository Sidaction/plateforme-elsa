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

        <div class="page_content clearfix  bg-cut blocs_group">
            <div class="wrap row">

                <div class="group_title m-2col">
                  <div class="exportxls"><a href="../extract" class="btn-inline">Exporter au format xls</a></div>
                </div>

                <div class="m-5col m-last">
                    <?php the_content(); ?>
                </div>

                <div class="clearfix">
                    <?php echo do_shortcode( '[gema75_ril]' ); ?>
                </div>
                
            </div><!-- .wrap -->
        </div><!-- .page_content -->

    </article>

   
  </div>
</section>


<?php endwhile; ?>
<?php get_footer(); ?>