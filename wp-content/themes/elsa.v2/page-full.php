<?php 

/*
 * Page full width
 * Template Name: Page full width
 */

get_header(); ?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



<section id="site-content" class="site-content single-ressource">

    <article class="main-content clearfix noback">
        

        <?php if( has_post_thumbnail()  ) { ?> 
            <div class="page_title-outer page_cover bg_cover" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>)"></div>

        <?php } else { ?>
            <div class="page_nocover"></div>

        <?php } ?>

        <div class="clearfix">
            <?php the_content();?>
        </div>

    </article>

    <?php set_query_var( 'cnSite', $cnSite ); ?>
    <?php get_template_part('template-parts/content', 'rebonds'); ?>
   
  </div>
</section>


<?php endwhile; ?>
<?php get_footer(); ?>