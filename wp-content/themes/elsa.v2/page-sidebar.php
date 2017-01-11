<?php 

/*
 * Page avec sidebar à gauche
 * Template Name: Page avec Colonne à gauche
 */

get_header(); ?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



<section id="site-content" class="site-content single-ressource">

    <article class="main-content clearfix noback">
        
        <div class="page_title ressource_title">

            <?php the_post_thumbnail('large'); ?>
        
            <div class="wrap row">
                <h1 class="h1 m-6col is-centered">
                    <?php echo $title; ?>
                </h1>  
            </div>     
        
        </div>

        <div class="page_content clearfix">
            <div class="wrap row">

                <nav class="m-2col">
                    <?php echo 'colonne'; ?>

                </nav>

                <div class="m-5col m-last">
                    <?php the_content();?>
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