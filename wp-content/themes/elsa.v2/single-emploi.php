<?php 
/*
 * Fiche pays
 */


 $cnSite->page_type='pays';
 get_header(); 

 if ( have_posts() ) while ( have_posts() ) : the_post(); 
    $pays = $post->post_name;
?>



<section id="site-content" class="site-content single-emploi">

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

                <div class="m-5col">

                    <div class="page_shortdescription">
                        <?php the_field('description_courte'); ?>
                    </div>

                    <div class="page_maincontent">
                        <?php the_content(); ?>
                    </div>

                </div>


                <div class="m-3col m-last">

                    <div class="page_practical_group">
                        <div class="emploi_contrat">
                            <?php $contrat = get_the_terms( $post->ID, 'emploi_contrat' ); echo $contrat ? $contrat[0]->name : 'type de contrat non renseigné'; ?> <br>
                            <?php $domaine = get_the_terms( $post->ID, 'emploi_domaine' ); echo $domaine ? $domaine[0]->name : 'domaine non renseigné'; ?>

                        </div>
                        <div class="emploi_place">
                            <?php the_field('emploi_place'); ?>
                            <?php $place = get_the_terms( $post->ID, 'emploi_lieu'); echo $place ? $place[0]->name : 'lieu non renseigné'; ?>
                        </div>



                        <?php if( get_field('emploi_fiche')) : ?>
                            <a role="button" class="btn-inline" target="_blank" href="<?php the_field('emploi_fiche'); ?>"><?php print_r('Lire le détail du poste'); ?></a>
                        <?php endif; ?>

                    </div>


                    <div class="emploi_action">
                        <?php if( get_field('emploi_link')) : ?>
                            <a role="button" class="btn-primary" target="_blank" href="<?php the_field('emploi_link'); ?>"><?php print_r('Postuler'); ?></a>
                        <?php endif; ?>
                    </div>


                </div>


            </div><!-- .wrap -->




            <div class="row wrap page_action">

                <?php
                    $post_prev = get_adjacent_post(false,'',true);
                    if ($post_prev) :?>
                        <a href="<?php echo get_permalink($post_prev->ID); ?>" class="btn-secondary">&lt; Offre précédente (<em><?php echo $post_prev->post_title;?></em>)</a>
                    <?php endif; ?>

                <a href="/offres-demploi" class="btn-secondary"><?php print_r('retour aux offres d\'emploi'); ?></a>

                <?php 
                    $post_next = get_adjacent_post(false,'',false);
                    if ($post_next):?>
                        <a href="<?php echo get_permalink($post_next->ID); ?>" class="btn-secondary">&gt; Offre suivante (<em><?php echo $post_next->post_title;?></em>)</a>
                    <?php endif; ?>

            </div>


        </div><!-- .page_content -->


    </article>




   



</section>



<?php endwhile; ?>
<?php get_footer(); ?>