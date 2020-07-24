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
                <div class="m-7col">

                    <h1 class="h1">
                        <?php the_title();?>
                    </h1>

                    <div class="event_metas row">
                        <div class=" event_date">
                            <span><?php 
                                $unixtimestamp = strtotime( get_field('date_evenement') );
                                echo date_i18n( "l d F Y - H\hi", $unixtimestamp ); 
                            ?></span> | <span class="event_type"><?php $type = get_field('type_evenement'); echo $type[0]->name; ?></span>
                        </div>



                        <div class="event_place">
                            <?php 
                                $place = get_field('lieu_evenement'); 

                                echo $place ? '<span class="place_name">' . $place[0]->name . '</span> - ' . $place[0]->description : 'lieu non précisé' ; ?>
                        </div>
                    </div>

                </div>
          </div>     
        </div>


        <div class="page_content clearfix">
            <div class="wrap row">

                <div class="m-5col">

                    <div class="event_shortdescription">
                        <?php the_field('description_courte'); ?>
                    </div>

                    <div class="event_content">
                        <?php the_content(); ?>
                    </div>

                </div>

                <div class="m-3col m-last">

                    <div class="event_media">
                        <?php the_post_thumbnail(); ?>
                    </div>

                    <div class="event_action">
                        <?php if( get_field('resa_url')) : ?>
                            <a role="button" class="btn-primary" target="_blank" href="<?php the_field('resa_url'); ?>"><?php the_field('resa_label'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>

            </div><!-- .wrap -->


            <div class="row wrap">
                <a href="/agenda" class="btn-secondary">retour à l'agenda</a>
            </div>
        </div><!-- .page_content -->


    </article>





   



</section>



<?php endwhile; ?>
<?php get_footer(); ?>