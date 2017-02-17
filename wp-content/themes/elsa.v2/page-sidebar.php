<?php 

/*
 * Page avec sidebar à gauche
 * Template Name: Page avec Colonne à gauche
 */

get_header(); ?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



<section id="site-content" class="site-content single-ressource">

    <article class="main-content clearfix noback">
        

        <?php if( has_post_thumbnail()  ) { ?> 
            <div class="page_title-outer page_cover bg_cover" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></div>

        <?php } else { ?>
            <div class="page_nocover"></div>

        <?php } ?>

        <div class="page_content clearfix">
            <div class="wrap row">

                <nav class="m-2col page_sidebar">
                    <?php the_field('sidebar_content') ?>

                </nav>

                <div class="m-5col m-last">
                    <h1 class="h1"><?php the_title(); ?></h1> 
                    <?php the_content();?>
                </div>

            </div><!-- .wrap -->
        </div><!-- .page_content -->

    </article>

    <?php set_query_var( 'cnSite', $cnSite ); ?>
    <?php get_template_part('template-parts/parts/part', 'rebonds'); ?>
   
  </div>
</section>


<?php endwhile; ?>
<?php get_footer(); ?>