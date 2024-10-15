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
$zoom_pays_img = get_field('zoom_pays_img');

$zoom_association = get_field('zoom_association');
$zoom_association_text = get_field('zoom_association_text');
set_query_var( 'cnSite', $cnSite ); 

    // cover
    $cover_size = 'cover';
    $cover = $image['sizes'][ $cover_size ];

    // thumbnail
    $thumb_size = 'small';
    $pays_small_img = $zoom_pays_img['sizes'][ $thumb_size ];
    // $width = $zoom_pays_img['sizes'][ $thumb_size . '-width' ];
    // $height = $zoom_pays_img['sizes'][ $thumb_size . '-height' ];

?>


<main id="home-page">


    <section class="sec_hero">

        <img class="cover" src="<?= $cover ?>" alt="site cover">
            
        <div class="grid gap-xl center-y wrapper">
            <div class="left s-8col">
                <span class="zoom p big">Zoom sur</span>
                <!-- <h2 class="h2"><?php the_field('zoom_titre'); ?></h2> -->
                <div class="featured_intro"><?php the_field('zoom_texte'); ?></div>
            </div>
            <div class="s-4col">
                <?php 
                    $link = get_field('zoom_thematique_link');
                    
                    if( $link ) : 
                        $zoom_thematique_link = $link['url'];
                    else : 
                        $zoom_thematique_link = "/category/" . $zoom_thematique->slug;
                    endif; 
                ?>
                <a href="/recherche-documentaire/?totalcat=<?php echo $zoom_thematique->slug; ?>" class="btn btn--secondary">Les ressources de la thématique</a>
                <a class="btn" href="<?php echo $zoom_thematique_link; ?>">En savoir plus</a>
            </div>

        </div>
        
    </section>

    <section class="sec_ressources">
        <div class="wrapper">
            <h2 class="h2 title"><?php the_field('grille_titre'); ?></h2>
            
            <div class="ressources grid gap-m">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order'   => 'DESC',
                );

                $media_posts = new WP_Query($args);

                if ($media_posts->have_posts()) :
                    while ($media_posts->have_posts()) : $media_posts->the_post(); ?>
                        <div class="ressource s-4col flex column start-y space gap-m" style="background-image:url(<?= get_template_directory_uri(); ?>/assets/img/ressources/bg-ressource-<?= $media_posts->current_post + 1; ?>.png);">
                            <div>
                                <div class="ressource__metas">
                                    <?php
                                        $category = get_the_category()[0];
                                        $format = get_the_terms(get_the_ID(), 'format')[0];

                                        if (!empty($category)) {
                                            echo '<p class="category small">' . esc_html($category->name);
                                        }
                                        if (!empty($category) && !empty($format)) {
                                            echo ' | ';
                                        }
                                        if (!empty($format)) {
                                            echo esc_html($format->name) . '</p>';
                                        } else {
                                            echo '</p>';
                                        }
                                    ?>
                                </div>
                                <h3 class="h3 ressource__title"><?php the_title(); ?></h3>
                                <div><?php the_excerpt(); ?></div>
                            </div>    
                            <a href="<?php the_permalink(); ?>" class="ressource__button btn btn--tertiary">
                                <svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.7132 0.726395L20.2464 6.21274L20.2927 6.25567C20.4778 6.43926 20.5856 6.68138 20.6016 6.96745L20.6007 7.06362C20.5872 7.29023 20.5006 7.50671 20.33 7.7007L20.2654 7.76735L14.7132 13.2735C14.3026 13.6807 13.6387 13.6807 13.2281 13.2735C12.8151 12.8639 12.8151 12.198 13.2281 11.7884L17.0617 7.98624L1.65394 7.98662C1.07373 7.98662 0.601593 7.51843 0.601593 6.93867C0.601593 6.35891 1.07374 5.89072 1.65394 5.89072L16.938 5.89034L13.2281 2.21154C12.8151 1.80194 12.8151 1.136 13.2281 0.726395C13.6387 0.319229 14.3026 0.319229 14.7132 0.726395Z" fill="#ED1B24"/>
                                </svg>
                            </a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p>No media posts found.</p>
                <?php endif; ?>
            </div>

            <div class="more-btn flex center">
                <a href="/recherche-documentaire/" class="btn">Toutes les ressources</a>
            </div>
        </div>
    </section>


    
    <!-- <div id="" class="home-featured">
        <div class="featured-cover bg_cover" style="background-image:url(<?php echo $cover; ?>);">

        </div>
        <div class="featured-content">

            <div class="wrap">
                <div class="featured_name"><h3 class="h3_alt">Zoom sur</h3></div>
                <div class="featured-title row">
                    <h2 class="h1_alt m-7col m-clearfix"><?php the_field('zoom_titre'); ?></h2>
                </div>

                <div class="row">

                    <?php if( get_field('hide_zoom_association') || get_field('hide_zoom_pays') ) : 
                        $class = "m-6col";
                    else: 
                        $class = "m-4col";
                    endif; ?>


                    <div class="<?php echo $class; ?>">
                        <div class="featured_intro"><?php the_field('zoom_texte'); ?></div>
                    
                        <div class="featured_actions">

                            <?php 
                                $link = get_field('zoom_thematique_link');
                                
                                if( $link ) : 
                                    $zoom_thematique_link = $link['url'];
                                else : 
                                    $zoom_thematique_link = "/category/" . $zoom_thematique->slug;
                                endif; 
                            ?>


                            <a class="btn-primary" href="<?php echo $zoom_thematique_link; ?>">En savoir plus</a>
                            <a href="/recherche-documentaire/?totalcat=<?php echo $zoom_thematique->slug; ?>" class="btn-secondary">Les ressources de la thématique</a>
                        </div>
                    </div>


                    <div class="m-2col featured-asso">
                        <?php if( ! get_field('hide_zoom_association') ) : ?>
                            <?php 
                                $link = get_field('zoom_association_link');
                                
                                if( $link ) : 
                                    $zoom_association_link = $link['url'];
                                else : 
                                    $zoom_association_link = "/structure/" . $zoom_association->post_name;
                                endif; 
                            ?>
                            <a href="<?php echo $zoom_association_link; ?>" class="featured_btns">
                                <h4 class="h2"><?php echo $zoom_association->post_title; ?></h4>
                                <div><?php echo $zoom_association_text; ?></div>
                                <br>
                                <span class="btn-link">En savoir plus</span>
                            </a>

                        <?php endif; ?>
                    </div>

                    <div class="m-2col featured-pays">
                        <?php if( ! get_field('hide_zoom_pays') ) : ?>

                            <?php 
                                $link = get_field('zoom_pays_link');
                                
                                if( $link ) : 
                                    $zoom_pays_link = $link['url'];
                                else : 
                                    $zoom_pays_link = "/pays/" . $zoom_pays->post_name;
                                endif; 
                            ?>                        

                            <a href="<?php echo $zoom_pays_link; ?>" class="featured_btns">
                                <h4 class="h2"><?php echo $zoom_pays->post_title; ?></h4>
                                <p><img src="<?php echo $pays_small_img; ?>"></p>
                                <br>
                                <span class="btn-link">En savoir plus</span>
                            </a>

                       <?php endif; ?>
                    </div>
                </div>
            </div>  

        </div>
    </div> -->
    

    <!-- <?php if( get_field('video_title') != '') : ?>

        <section class="home_featured_vid m-clearfix blocs_group">
            <div class="wrap row">
                
                <div class="group_title grid-title m-2col">
                    <h3 class="h3_alt"><?php the_field('video_title'); ?></h3>
                </div>

                <div class="m-6col">

                    <div class="docs_container row">
                        <?php
                        $featured_posts = get_field('video_url');
                        if( $featured_posts ):
                            foreach( $featured_posts as $post ): ?>
                                <div class="s-8col m-4col">
                                    <?php setup_postdata($post); 
                                    set_query_var( 'type', 'media' ); 
                                    set_query_var( 'hide_allmediasbtn', true );
                                    get_template_part('template-parts/parts/part', 'bloc'); ?>

                                </div>
                            <?php endforeach;
                            wp_reset_postdata();
                        endif; ?>



                    </div>

                </div>

                    <div class="section_action text-on-center">
                        <a href="<?php the_field('video_btn1_url'); ?>" class="btn-primary"><?php the_field('video_btn1_label'); ?></a>

                        <a href="<?php the_field('video_btn2_url'); ?>" class="btn-primary"><?php the_field('video_btn2_label'); ?></a>
                    </div>

            </div>
        </section>

    <?php endif; ?> -->





<?php 

    $page_1 = get_field('grille_page_1');
    $page_2 = get_field('grille_page_2');
    $page_3 = get_field('grille_page_3');
    $grille_media = get_field('grille_media');

?>
    
    <section id="" class="home-grid blocs_group">
        <div class="wrap row">

            <div class="group_title grid-title m-2col">
                <h3 class="h3_alt"><?php the_field('grille_titre'); ?></h3>
            </div>
    	    
            <div class="group_list grid-list">
                <?php 	
                    $args = array(
                        'post_type' => array('post'), 
                        'posts_per_page' => 5,
                        // 'tax_query' => array(
                        //     array(
                        //         'taxonomy' => 'format',
                        //         'field'    => 'slug',
                        //         'terms'    => array('video', 'diaporama', 'audio'),
                        //         'operator' => 'NOT IN',
                        //     ),
                        // ),
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

                                    <?php 
                                    set_query_var( 'hide_allmediasbtn', false );
                                    set_query_var( 'type', 'media' ); ?>

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


            <div class="text-on-center">
                <a href="/recherche-documentaire/" class="btn-primary">Toutes les ressources</a>
            </div>

        </div><!-- .wrap -->
     </section>




    <section class="home_featured_docs m-clearfix">
        <div class="wrap">
            
            <h2 class="text-on-center h3_alt"><?php the_field('docs_title'); ?></h2>

            <div class="docs_container">
                <?php
                $featured_posts = get_field('docs_files');
                if( $featured_posts ): ?>
                    <?php foreach( $featured_posts as $post ): 

                        setup_postdata($post); ?>
                        <div class="doc_item">
                            <?php get_template_part('template-parts/parts/part', 'bloc-image'); ?>
                        </div>
                    <?php endforeach; ?>
                    <?php 
                    wp_reset_postdata(); ?>
                <?php endif; ?>

            </div>


            <?php if( get_field('docs_btn_label' ) != '' ) : ?>
                <div class="section_action text-on-center">
                    <a href="<?php the_field('docs_btn_url'); ?>" class="btn-primary"><?php the_field('docs_btn_label'); ?></a>
                </div>
            <?php endif; ?>

        </div>
    </section>



</main>

<?php get_footer(); ?>
