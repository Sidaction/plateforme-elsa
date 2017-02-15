<?php 
/*
 * Page d'accueil
 * Template Name: Page d'accueil
 *
*/

get_header(); 

$image = get_field('zoom_image');
$zoom_thematique = get_field('zoom_thematique');
$zoom_pays = get_field('zoom_pays');
$zoom_association = get_field('zoom_association');
$zoom_association_text = get_field('zoom_association_text');

?>


<section id="site-content" class="site-content template-home">

    
    <div id="" class="home-featured">
        <div class="featured-cover bg_cover" style="background-image:url(<?php echo $image['url']; ?>);">

        </div>
        <div class="featured-content">

            <div class="wrap">
                <div class="featured_name"><h3 class="h3_alt">Zoom sur</h3></div>
                <div class="featured-title row">
                    <h2 class="h1_alt m-7col m-clearfix"><?php the_field('zoom_titre'); ?></h2>
                </div>

                <div class="row">
                    <div class="m-4col">
                        <div class="featured_intro"><?php the_field('zoom_texte'); ?></div>
                    
                        <div class="featured_actions">
                            <a class="btn-primary" href="/category/<?php echo $zoom_thematique->slug; ?>">En savoir plus</a>
                            <a href="/recherche-documentaire/?totalcat=<?php echo $zoom_thematique->slug; ?>" class="btn-secondary">Les ressources de la thématique</a>
                        </div>
                    </div>


                    <div class="m-2col featured-asso">
                        <h4 class="h2"><?php echo $zoom_association->post_title; ?></h4>
                        <p><?php echo $zoom_association_text; ?></p>
                        <a href="/structure/<?php echo $zoom_association->post_name?>" class="featured_btns"><span class="icon-arrow_right"></span></a>
                    </div>

                    <div class="m-2col featured-pays">
                        <h4 class="h2"><?php echo $zoom_pays->post_title; ?></h4>
                        <p><img src="<?php echo get_field('zoom_pays_img'); ?>"></p>
                        <a href="/pays/<?php echo $zoom_pays->post_name?>" class="featured_btns"><span class="icon-arrow_right"></span></a>
                    </div>
                </div>
            </div><!-- .wrap -->   

        </div>
    </div><!-- .home-featured -->
    
    

<?php 

    $page_1 = get_field('grille_page_1');
    $page_2 = get_field('grille_page_2');
    $page_3 = get_field('grille_page_3');
    $grille_media = get_field('grille_media');

?>
    
    <div id="" class="home-grid blocs_group">
        <div class="wrap row">

            <div class="group_title grid-title m-2col">
                <h3 class="h3_alt"><?php the_field('grille_titre'); ?></h3>
            </div>
    	    
            <div class="group_list grid-list">
                <?php 	
                    $args = array(
                        'post_type' => array('post'), 
                        'posts_per_page' => 5,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'format',
                                'field'    => 'slug',
                                'terms'    => array('video', 'diaporama', 'audio'),
                                'operator' => 'NOT IN',
                            ),
                        ),
                        'orderby'    => 'date',
                        'order'      => 'DESC'
                    );

                    $grille_posts = get_posts($args);

                    array_splice($grille_posts, 2, 0, array($grille_media) );
                    array_splice($grille_posts, 3, 0, array($page_1) );
                    array_splice($grille_posts, 5, 0, array($page_2) );
                    array_splice($grille_posts, 8, 0, array($page_3) );
                    $i = 0; 

                    foreach ( $grille_posts as $post ) : setup_postdata( $post ); ?>

                            <?php if( $i == 0 ) : ?>
                                <div class="m-2col">
                                    <?php set_query_var( 'type', 'ressource' ); ?>
                                    <?php set_query_var( 'cnSite', $cnSite ); ?>

                            <?php elseif ( $i == 1 ) : ?>
                                <div class="m-4col">
                                    <?php set_query_var( 'type', 'ressource' ); ?>
                                    <?php set_query_var( 'cnSite', $cnSite ); ?>

                            <?php elseif ( $i == 2 ) : ?>
                                <div class="m-4col m-clearfix">
                                    <?php set_query_var( 'type', 'media' ); ?>

                            <?php elseif ( $i == 3 ) : ?>
                                <div class="m-2col">
                                    <?php set_query_var( 'type', 'statique' ); ?>

                            <?php elseif ( $i == 5 ) : ?>
                                <div class="m-2col m-clearfix">
                                    <?php set_query_var( 'type', 'statique' ); ?>

                            <?php elseif ( $i == 8 ) : ?>
                                <div class="m-2col">
                                    <?php set_query_var( 'type', 'statique' ); ?>


                            <?php else : ?>
                                <div class="m-2col">
                                    <?php set_query_var( 'type', 'ressource' ); ?>


                            <?php endif; ?>

                                    <?php get_template_part('template-parts/parts/part', 'bloc'); ?>

                                </div><!-- end .col -->


                        <?php $i++; ?>
                            

                    <?php endforeach; 
                    wp_reset_postdata();?>

            </div><!-- .grid-list -->

        </div><!-- .wrap -->
     </div>


</section>

<?php get_footer(); ?>
