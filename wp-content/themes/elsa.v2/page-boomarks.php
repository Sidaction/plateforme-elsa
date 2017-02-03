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

            <div class="page_title ressource_title">

                <div class="wrap row">
                    <div class="m-5col m-2col-push">
                        <h1 class="h1">
                            <?php echo the_title(); ?>
                        </h1> 
                        <p class="clearfix">Vous avez actuellement <span class="selection_count"></span> ressources sélectionnées</p>
                    </div>
                </div>     
            
            </div>

        <?php if( has_post_thumbnail() ) { ?> 
            </div>
        <?php } ?>

        <div class="clearfix bg-cut blocs_group">
            <div class="wrap row">

                <div class="group_title m-2col">
                    <div class="group_title_actions">
                        <a href="../extract" class="btn-inline">Télécharger la liste des résultats</a>
                    </div>
                </div>

                <div class="group_intro m-5col m-last">
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