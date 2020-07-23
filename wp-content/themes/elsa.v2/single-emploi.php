<?php 
/*
 * Fiche pays
 */


 $cnSite->page_type='pays';
 get_header(); 

 if ( have_posts() ) while ( have_posts() ) : the_post(); 
    $pays = $post->post_name;
?>



<section id="site-content" class="site-content single-ressource">

    <article class="main-content clearfix noback">
        <div class="page_title pays_title">

            <div class="wrap row">
                <div class="m-5col">

                    <h1 class="h1">
                        <?php the_title();?>
                    </h1>

                </div>
          </div>     
        </div>


        <div class="page_content clearfix">
            <div class="wrap row">

                <div>
                    <?php the_field('description_courte'); ?>
                </div>
<br><br>
                <div>
                    <?php the_content(); ?>
                </div>

            </div><!-- .wrap -->
        </div><!-- .page_content -->


    </article>





   



</section>



<?php endwhile; ?>
<?php get_footer(); ?>