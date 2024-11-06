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
                <div class="entry-content">
                    <?php the_content();?>
                </div>

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
                        <button class="btn btn--secondary on-desktop js-open-modal" data-type="pdf" data-src="<?= $info['url'] ?>" aria-label="Prévisualiser le document">
                            <svg width="31" height="24" viewBox="0 0 31 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M30.7109 12C30.7109 11.8195 30.6852 11.6648 30.6723 11.652C30.6723 11.5617 30.6336 11.3941 30.6078 11.3168C30.5949 11.3039 30.5949 11.2781 30.582 11.2523C30.5691 11.2008 30.5563 11.1492 30.5305 11.1105C27.7203 4.96172 21.6875 0.849609 15.5 0.849609C9.3125 0.849609 3.27969 4.97461 0.482422 11.0719C0.44375 11.1363 0.430859 11.2008 0.405078 11.2523C0.405078 11.2652 0.392188 11.291 0.392188 11.3039C0.340625 11.4715 0.340625 11.5746 0.340625 11.5488C0.314844 11.6648 0.289062 11.8969 0.289062 11.8969C0.289062 11.9742 0.289062 12.0258 0.289062 12.0902C0.289062 12.0902 0.314844 12.2965 0.327734 12.3352C0.327734 12.3996 0.340625 12.477 0.366406 12.5543C0.379297 12.6188 0.405078 12.6832 0.430859 12.7477C0.44375 12.7992 0.456641 12.8379 0.469531 12.8766C3.27969 19.0254 9.3125 23.1504 15.5 23.1504C21.6746 23.1504 27.7203 19.0254 30.5047 12.9539C30.5434 12.8766 30.5691 12.7992 30.5949 12.7348C30.6078 12.7219 30.6078 12.6961 30.6078 12.6832C30.6594 12.5414 30.6723 12.4254 30.6594 12.4254C30.6852 12.3223 30.7109 12.1805 30.7109 12ZM28.6613 12.0773C28.6484 12.1031 28.6484 12.116 28.6484 12.1289C26.1605 17.5043 20.8883 21.1137 15.5 21.1137C10.1375 21.1137 4.87813 17.5172 2.35156 12.116C2.35156 12.1031 2.35156 12.0773 2.33867 12.0645C2.33867 12.0516 2.33867 12.0387 2.33867 12.0258C2.33867 12.0129 2.33867 12 2.33867 11.9871V11.9742C2.33867 11.9484 2.35156 11.9355 2.35156 11.8969C2.35156 11.884 2.35156 11.8711 2.36445 11.8582C4.85234 6.46992 10.1246 2.87344 15.5129 2.87344C20.9012 2.87344 26.1605 6.48281 28.6613 11.8582C28.6613 11.8711 28.6613 11.8711 28.6742 11.884C28.6742 11.8969 28.6742 11.8969 28.6871 11.9098C28.7 11.9484 28.7 11.9871 28.7 12.0129C28.6742 12.0387 28.6742 12.0516 28.6613 12.0773ZM15.5 6.92109C12.7027 6.92109 10.434 9.20273 10.434 11.9871C10.434 14.7844 12.7156 17.0531 15.5 17.0531C18.2973 17.0531 20.566 14.7715 20.566 11.9871C20.566 9.20273 18.2973 6.92109 15.5 6.92109ZM15.5 15.0422C13.8242 15.0422 12.4578 13.6758 12.4578 12C12.4578 10.3242 13.8242 8.95781 15.5 8.95781C17.1758 8.95781 18.5422 10.3242 18.5422 12C18.5422 13.6758 17.1758 15.0422 15.5 15.0422Z" fill="white"/>
                            </svg>

                            <span><?= $info['title'] ?> (prévisualisation)</span>
                        </button>
                    <?php endif; ?>
    
                    <a href="<?= $info['url'] ?>" title="<?= $info['title'] ?>" class="btn" target="_blank" <?= $kind === 'pdf' ? 'download' : '' ?> aria-label="télécharger le document">
                        <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.9165 4.125V8.95833C16.9165 9.2788 17.0438 9.58615 17.2704 9.81275C17.497 10.0394 17.8044 10.1667 18.1248 10.1667H22.9582" stroke="white" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.5415 25.875H8.45817C7.81723 25.875 7.20254 25.6204 6.74933 25.1672C6.29612 24.714 6.0415 24.0993 6.0415 23.4583V6.54167C6.0415 5.90073 6.29612 5.28604 6.74933 4.83283C7.20254 4.37961 7.81723 4.125 8.45817 4.125H16.9165L22.9582 10.1667V23.4583C22.9582 24.0993 22.7036 24.714 22.2503 25.1672C21.7971 25.6204 21.1824 25.875 20.5415 25.875Z" stroke="white" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.5 21.0416V13.7916" stroke="white" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.479 18.0209L14.4998 21.0417L17.5207 18.0209" stroke="white" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
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
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.96875 10.9375L1 5.96875L5.96875 1" fill="black"/>
                                <path d="M5.96875 10.9375L1 5.96875L5.96875 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button next">
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 10.9375L5.96875 5.96875L1 1" fill="black"/>
                                <path d="M1 10.9375L5.96875 5.96875L1 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>

                    <div class="swiper-wrapper">

                        <?php foreach ($related as $post) {
                            setup_postdata($post); 
                            $format = cnLib::get_main_term_slug($post->ID, 'format');
                            
                            ?>
                            <div class="ressource-item mobile-paper swiper-slide">

                                <?php if (!empty($format)) : ?>
                                    <span class="metas"><?= $format ?></span>
                                <?php endif; ?>

                                <h4 class="title h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p class="ressource-meta small"><span>Thématiques : </span><?php the_category(', '); ?></p>
                                
                                <?php if( !empty($main_author) || $cnSite->get_authors($post->ID) !== ''){ ?>
                                    <p class="ressource-meta small small">
                                        <span>Auteur(s) : </span>
                                        <?php $permalink = get_permalink( $main_author );
                                        if(!empty($url)) echo "<a href='{$permalink}'>{$main_author}</a>"; ?>
                                        <?php echo $cnSite->get_authors($post->ID); ?>
                                    </p>
                                <?php } ?>

                                <div class="action on-mobile">
                                    <a href="<?php the_permalink(); ?>" class="button btn btn--tertiary" aria-label="En savoir plus sur la ressource <?php the_title(); ?>">
                                        <svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.7132 0.726395L20.2464 6.21274L20.2927 6.25567C20.4778 6.43926 20.5856 6.68138 20.6016 6.96745L20.6007 7.06362C20.5872 7.29023 20.5006 7.50671 20.33 7.7007L20.2654 7.76735L14.7132 13.2735C14.3026 13.6807 13.6387 13.6807 13.2281 13.2735C12.8151 12.8639 12.8151 12.198 13.2281 11.7884L17.0617 7.98624L1.65394 7.98662C1.07373 7.98662 0.601593 7.51843 0.601593 6.93867C0.601593 6.35891 1.07374 5.89072 1.65394 5.89072L16.938 5.89034L13.2281 2.21154C12.8151 1.80194 12.8151 1.136 13.2281 0.726395C13.6387 0.319229 14.3026 0.319229 14.7132 0.726395Z" fill="#ED1B24"/>
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        <?php }
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