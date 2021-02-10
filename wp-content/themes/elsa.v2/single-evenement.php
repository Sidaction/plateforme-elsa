<?php 
/*
 * Fiche pays
 */

setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');

 $cnSite->page_type='pays';
 get_header(); 

 if ( have_posts() ) while ( have_posts() ) : the_post(); 
    $pays = $post->post_name;
?>



<section id="site-content" class="site-content single-event">

    <article class="main-content clearfix noback">
        <div class="page_title pays_title">

            <div class="wrap row">
                <div class="m-7col">

                    <h1 class="h1">
                        <?php the_title();?>
                    </h1>

                    <div class="event_metas row">
                        <div class="page_practical_group">
                            <div class="event_date">
                                <?php 

                                    $date = get_field('date_evenement');
                                    $end_date = get_field('end_date_evenement');

                                    $date = strtotime($date); 
                                    $end_date = strtotime($end_date); 

                                    if( strftime('%A %d %B %G', $date ) == strftime('%A %d %B %G', $end_date ) ) {
                                        echo 'Le ' . strftime('%A %d %B %G ・ %kh%M', $date );   
                                        echo ' - ' . strftime('%kh%M', $end_date );
                                    }
                                    else {
                                        echo 'Du ' . strftime('%A %d %B %G ・ %kh%M', $date );   
                                        echo ' <br>au ' . strftime('%A %d %B %G ・ %kh%M', $end_date ); 
                                    } 
                                      
            
                                    if( get_field('utc_evenement') != '' ) {
                                        echo ' (' . get_field('utc_evenement') . ')';
                                    }
            
                                ?> 
                            </div>
                            <div class="event_type">
                                <?php $type = get_the_terms( $post->ID, 'evenement_type' ); echo $type ? $type[0]->name : '' ; ?>
                            </div>
                        </div>
                    </div>

                </div>
          </div>     
        </div>


        <div class="page_content clearfix">
            <div class="wrap row">

                <div class="m-5col">
<!-- 
                    <div class="page_shortdescription">
                        <?php the_field('description_courte'); ?>
                    </div> -->

                    <div class="page_maincontent">
                        <?php the_content(); ?>
                    </div>

                </div>

                <div class="m-3col m-last">

                    <div class="event_media">
                        <?php the_post_thumbnail('post_thumb'); ?>
                    </div>

                    <div class="event_place">
                        <?php the_field('adresse_evenement'); ?>
                        <?php $place = get_the_terms( $post->ID, 'evenement_lieu' ); 
                        echo $place ? $place[0]->name : 'Pays non précisé' ; ?>
                    </div>

                    <div class="event_action">
                        <?php if( get_field('resa_url')) : ?>
                            <a role="button" class="btn-primary" target="_blank" href="<?php the_field('resa_url'); ?>"><?php the_field('resa_label'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>

            </div><!-- .wrap -->


            <div class="row wrap page_action">

                <?php
                    $post_prev = get_adjacent_post(false,'',true);
                    if ($post_prev) :?>
                        <a href="<?php echo get_permalink($post_prev->ID); ?>" class="btn-secondary">&lt; Événement précédent (<em><?php echo $post_prev->post_title;?></em>)</a>
                    <?php endif; ?>

                <a href="/agenda" class="btn-secondary">retour à l'agenda</a>

                <?php 
                    $post_next = get_adjacent_post(false,'',false);
                    if ($post_next):?>
                        <a href="<?php echo get_permalink($post_next->ID); ?>" class="btn-secondary">&gt; Événement suivant (<em><?php echo $post_next->post_title;?></em>)</a>
                    <?php endif; ?>

            </div>
        </div><!-- .page_content -->


    </article>





   



</section>



<?php endwhile; ?>
<?php get_footer(); ?>