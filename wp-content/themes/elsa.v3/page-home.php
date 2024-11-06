<?php 
/*
 * Page d'accueil
 * Template Name: Page d'accueil
 *
*/
wp_enqueue_script('swiper');
wp_enqueue_script('slider');
wp_enqueue_style('swiper-styles');

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
    // $thumb_size = 'small';
    // $pays_small_img = $zoom_pays_img['sizes'][ $thumb_size ];
    // $width = $zoom_pays_img['sizes'][ $thumb_size . '-width' ];
    // $height = $zoom_pays_img['sizes'][ $thumb_size . '-height' ];

?>


<main id="home-page">

    <section class="sec_home-hero">

        <img class="cover" src="<?= $cover ?>" alt="site cover">
            
        <div class="grid center-y wrapper">
            <div class="left t-12col m-8col">
                <span class="zoom p big">Zoom sur</span>
                <h2 class="h2 mb-l"><?php the_field('zoom_titre'); ?></h2>
                <div class="featured_intro"><?php the_field('zoom_texte'); ?></div>
            </div>
            <div class="right t-12col m-4col">
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

    <section class="sec_home-ressources">
        <div class="container">
            <h2 class="h2 title"><?php the_field('grille_titre'); ?></h2>
            
            <div class="ressources swiper">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order'   => 'DESC',
                );

                $media_posts = new WP_Query($args);

                
                if ($media_posts->have_posts()) : ?>

                    <div class="navigation">
                        <div class="swiper-button prev">
                            <?php get_template_part('svg/svg', 'swiperprev'); ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button next">
                            <?php get_template_part('svg/svg', 'swipernext'); ?>
                        </div>
                    </div>

                    <div class="swiper-wrapper grid">
                        <?php while ($media_posts->have_posts()) : $media_posts->the_post(); ?>
                            <div class="ressource-paper swiper-slide s-4col flex column start-y space gap-m">
                                <div class="texts">
                                    <div class="metas">
                                        <?php
                                            $category = get_the_category()[0];
                                            $terms = get_the_terms(get_the_ID(), 'format');
                                            if($terms) {
                                                $format = get_the_terms(get_the_ID(), 'format')[0];
                                            }


                                            if (!empty($category)) {
                                                echo '<p class="ressource-meta small">' . esc_html($category->name);
                                            }
                                            if (!empty($category) && !empty($format)) {
                                                echo ' | ';
                                            }
                                            if ($format && !empty($format)) {
                                                echo esc_html($format->name) . '</p>';
                                            } else {
                                                echo '</p>';
                                            }
                                        ?>
                                    </div>
                                    <h3 class="h3 title"><?php the_title(); ?></h3>
                                    <div><?php the_excerpt(); ?></div>
                                </div>
                                <div class="action">
                                    <a href="<?php the_permalink(); ?>" class="button btn btn--tertiary">
                                        <?php get_template_part('svg/svg', 'arrow', array( 'fill' => '#ED1B24' ) ); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; 
                        wp_reset_postdata(); ?>
                    </div>

                <?php else : ?>
                    <p>No media posts found.</p>
                <?php endif; ?>
            </div>

            <div class="more-btn flex center">
                <a href="/recherche-documentaire/" class="btn">Toutes les ressources</a>
            </div>
        </div>
    </section>

    <section class="sec_home-videos">
        <div class="container">
            
            <h2 class="title h2"><?php the_field('video_title'); ?></h2>
    
            <div class="videos swiper">
                <?php
                $featured_posts = get_field('video_url');
                if( $featured_posts ): ?>

                    <div class="navigation">
                        <div class="swiper-button prev">
                            <?php get_template_part('svg/svg', 'swiperprev'); ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button next">
                            <?php get_template_part('svg/svg', 'swipernext'); ?>
                        </div>
                    </div>

                    <div class="swiper-wrapper grid gap-m">
                        <?php foreach( $featured_posts as $post ): ?>
                            <div class="video s-6col swiper-slide">
                                <?php setup_postdata($post); 
                                set_query_var( 'type', 'media' ); 
                                set_query_var( 'hide_allmediasbtn', true );
                                
                                ?>

                                <div class="video__infos">
                                    <div class="video__categories">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty( $categories) ) {
                                            $category_count = count($categories);
                                            foreach ( $categories as $index => $category ) {
                                                echo '<span class="category">' . esc_html( $category->name );
                                                if ($index < $category_count - 1) echo ', ';
                                                echo '</span>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    
                                    <div class="video__title-container">
                                        <a href="<?php the_permalink(); ?>" class="h3 video__title"><?=get_the_title()?></a>
                                    </div>
                                </div>
                                <img class="video__cover" src="<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); }  ?>" alt="video cover">
                            </div>
                        <?php endforeach;
                        wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex center">
                <a href="<?php the_field('video_btn1_url'); ?>" class="btn"><?php the_field('video_btn1_label'); ?></a>

                <!-- <a href="<?php the_field('video_btn2_url'); ?>" class="btn-primary"><?php the_field('video_btn2_label'); ?></a> -->
            </div>
    
        </div>
    </section>

</main>

<?php get_footer(); ?>
