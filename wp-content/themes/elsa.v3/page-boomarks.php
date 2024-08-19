<?php 
    /* 
     * Page de la sélection (plugin Read It Later)
     * Template Name: Page Ma séléction
     */

get_header(); 

global $user_readitlater_list;
    if( is_array( $user_readitlater_list ) ) {
        $bookmark_posts = count($user_readitlater_list['posts_in_ril']);
    }
    else {
        $bookmark_posts = 0;
    }

?>

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
                        <p class="clearfix">Vous avez actuellement <span><?php echo $bookmark_posts; ?></span> ressources sélectionnées</p>
                    </div>
                </div>     
            
            </div>

        <?php if( has_post_thumbnail() ) { ?> 
            </div>
        <?php } ?>

        <div class="clearfix bg-cut blocs_group">
            <div class="wrap row">

                <div class="group_title m-2col">
                    <?php    if( is_array($user_readitlater_list ) ) { ?>
                        <div class="group_title_actions">
                            <a href="../extract" class="btn-inline">Télécharger la liste des résultats</a>
                        </div>
                    <?php } ?>
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