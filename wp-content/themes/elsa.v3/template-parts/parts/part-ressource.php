<?php  
    global $cnSite;

    $results[] = $post->ID;
    $cat = cnLib::get_term_list_link($post->ID, 'category', 'category/');
    $pays = cnLib::get_term_list_link($post->ID, 'pays_assoc', 'pays/');
    $main_author = get_post_meta($post->ID, 'first_org', true);
    $format = cnLib::get_main_term_slug($post->ID, 'format');
?>


    <div class="ressource-item">
        <?php if (!empty($format)) : ?>
            <span class="metas"><?= $format ?></span>
        <?php endif; ?>
        
        <h4 class="title h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    
        <p class="ressource-meta small"><span>Thématiques :</span> <?= $cat ?></p>

        <?php if( !empty($main_author) || $cnSite->get_authors($post->ID) !== ''){ ?>
            <p class="ressource-meta small">
                <span>Auteur(s) : </span>
                <?php $permalink = get_permalink( $main_author );
                if(!empty($url)) echo "<a href='{$permalink}'>{$main_author}</a>"; ?>
                <?php echo $cnSite->get_authors($post->ID); ?>
            </p>
        <?php } ?>
    </div>