<div class="breadcrumb">
    <a href="<?php echo get_home_url(); ?>">
        <?php get_template_part('svg/svg', 'home', array( 'strokes' => '#fff' )); ?>
    </a>
    <?php if (is_category()) : ?>
        <span>Thématiques</span>
        <a href="<?php echo get_category_link(get_queried_object_id()); ?>"><?php single_cat_title(); ?></a>
    <?php elseif (is_single()) : ?>
        <a href="<?php echo get_permalink(get_page_by_path('recherche-documentaire')); ?>">Ressources</a>
        <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
    <?php elseif (is_tax()) : ?>
        <span>Boite à outils</span>
        <a href="<?php echo get_term_link(get_queried_object_id()); ?>"><?php single_term_title(); ?></a>
    <?php else : ?>
        <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
    <?php endif; ?>
</div>