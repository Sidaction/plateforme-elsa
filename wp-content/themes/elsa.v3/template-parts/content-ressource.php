<?php 
    wp_enqueue_script('swiper');
    wp_enqueue_script('slider');
    wp_enqueue_style('swiper-styles');

    if($link) {
    $parse = parse_url($link);
    $domain = $parse['host'];  
    }
?>

<main id="ressource">

    <section class="sec_ressource-hero" style="background-image:url(<?= get_template_directory_uri(); ?>/assets/img/search/bg-search.png);">
        <div class="wrapper">
            <?php get_template_part('components/breadcrumb'); ?>

            <div class="container grid">
        
                <div class="t-12col m-6col">
                    
                    <h1 class="h2 mb-s"><?php the_title() ?></h1>
                    
                    <?php if(!empty($auteurs)) : ?>
                        <p class="ressource-meta small"><span>Auteur(s) : </span><?= $auteurs ?></p>
                    <?php endif; ?>
        
                    <?php if(!empty($date_edition)) : ?>
                        <p class="ressource-meta small"><span>Date d'édition : </span><?= $date_edition ?></p>
                    <?php endif; ?>
        
                    <?php if(has_category()) : ?>
                        <p class="ressource-meta small"><span>Thématique(s) : </span><?php the_category(', '); ?></p>
                    <?php endif; ?>
        
                </div>
                <div class="t-12col m-6col thumbnail">
                    <?php the_post_thumbnail('post_thumb'); ?>
                </div>
            </div>
        </div>
    </section>


    <section class="sec_ressource-content">
        <div class="container grid wrapper">
            <div class="t-12col l-8col">
                <div class="entry-content mb-xxl">
                    <?php the_content();?>
                </div>

                <nav class="social-links">
                        <h4 class="h4 mb-m">Partager</h4>
                        <ul class="flex gap-xs">
                            <li>
                                <a data-type="facebook" rel="nofollow" aria-label="Partager ce contenu sur Facebook" class="btn -share-desktop" href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>" data-title="Pour les moins de 26 ans, le dépistage des IST est désormais gratuit">
                                    <?php get_template_part('svg/svg-facebook'); ?>
                                </a>
                            </li>

                            <li>
                                <a data-type="twitter" rel="nofollow" aria-label="Partager ce contenu sur Twitter" class="btn -share-desktop" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>+<?php the_permalink(); ?>">
                                    <?php get_template_part('svg/svg-twitter'); ?>
                                </a>
                            </li>

                            <li>
                                <a data-type="linkedin" rel="nofollow" aria-label="Partager ce contenu sur LinkedIn" class="btn -share-desktop" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>">
                                    <?php get_template_part('svg/svg-linkedin'); ?>
                                </a>
                            </li>
                            
                            <li>
                                <a data-type="link" rel="nofollow" aria-label="Copier le lien de l'article" class="btn -share-desktop" href="<?php the_permalink(); ?>">
                                    <?php get_template_part('svg/svg-link'); ?>
                                </a>
                                <div class="etiquette small">Lien copié</div>
                            </li>
                        </ul>
                </nav>
                    

                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>

                <div class="navigation-buttons flex space on-desktop">
                    <?php if (!empty($prev_post)): ?>
                        <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-btn">
                            <?php get_template_part('svg/svg', 'carotLeft', array( 'strokes' => '#767676' )); ?>
                            Ressource précédente
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($next_post)): ?>
                        <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-btn">
                            Ressource Suivante
                            <?php get_template_part('svg/svg', 'carot', array( 'strokes' => '#767676' )); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="ressources t-12col l-4col flex column gap-s end-y mb-l">

                <?php if( $format == 'lien' && !empty($link) ) : ?>
                    <a href='<?= $link ?>' title='Voir le site' target='_blank' class='btn mb-l'>Voir le site</a>
                <?php endif ?>

                <?php if( $format!='lien' && $format!='video' && !empty($link) ) : ?>
                    <a href='<?= $link ?>' title='Voir le site' target='_blank' class='btn mb-l'>Voir le site</a>
                <?php endif ?>


                <?php 
                    $files = rwmb_meta( 'file', 'type=file' );

                    foreach ( $files as $info ) {

                        $size = filesize( $info['path'] );
                        $kind = pathinfo($info['path'], PATHINFO_EXTENSION);
                        $size = false === $size ? 0 : size_format( $size, 2 );
                ?>
                    <?php if ($kind === 'pdf') : ?>
                        <button class="btn btn --secondary on-desktop js-open-modal" data-type="pdf" data-src="<?= $info['url'] ?>" aria-label="Prévisualiser le document">
                            <?php get_template_part('svg/svg', 'preview', array( 'fill' => '#FFF' )); ?>
                            <span><?= $info['title'] ?> (prévisualisation)</span>
                        </button>
                    <?php endif; ?>
    
                    <a href="<?= $info['url'] ?>" title="<?= $info['title'] ?>" class="btn" target="_blank" <?= $kind === 'pdf' ? 'download' : '' ?> aria-label="télécharger le document">
                        <?php get_template_part('svg/svg', 'download', array( 'strokes' => '#FFF' )); ?>

                        <span>
                        <?= $info['title'] ?> 
                        <br> 
                        (<em><?= $kind ?> - <?= $size ?></em>)
                        </span>
                    </a>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="sec_related-ressources">
        <div class="container">
            <h2 class="title h2 mb-l">Ressources en lien</h2>
            <div class="swiper flex column gap-l">
                <?php
                $related = get_posts(array(
                    'category__in' => wp_get_post_categories($post->ID),
                    'numberposts' => 3,
                    'post__not_in' => array($post->ID)
                ));

                if ($related) { ?>

                    <div class="navigation">
                        <div class="swiper-button prev">
                            <?php get_template_part('svg/svg', 'swiperprev'); ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button next">
                            <?php get_template_part('svg/svg', 'swipernext'); ?>
                        </div>
                    </div>

                    <div class="swiper-wrapper">

                        <?php foreach ($related as $post) {
                            setup_postdata($post); 
                            get_template_part('template-parts/parts/part', 'ressource', array('slided' => true)); 
                        }
                        wp_reset_postdata(); ?>
                    </div>
                <?php } else {
                    echo '<p>Aucune ressource liée trouvée.</p>';
                }
                ?>
            </div>
        </div>
    </section>
<main>