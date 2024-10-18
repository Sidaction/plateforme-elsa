<div class="breadcrumb">
    <a href="<?php echo get_home_url(); ?>">
        <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.0978 10.7467H16.1677V18.2471C16.1677 18.7254 15.788 19.1081 15.3135 19.1081H12.0106C11.7259 19.1081 11.4791 18.8593 11.4791 18.5723V13.2149C11.4791 12.947 11.2703 12.7174 10.9856 12.7174H8.13827C7.87252 12.7174 7.64473 12.9279 7.64473 13.2149V18.5723C7.64473 18.8593 7.39797 19.1081 7.11324 19.1081H3.81036C3.33581 19.1081 2.95617 18.7254 2.95617 18.2471V10.7467H2.02605C1.03898 10.7467 0.564432 9.56036 1.24778 8.85241L8.78366 1.25633C9.22024 0.81625 9.9036 0.81625 10.3402 1.25633L17.8761 8.85241C18.5594 9.54123 18.0849 10.7467 17.0978 10.7467Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round"/>
        </svg>
    </a>
    <?php if (is_category()) : ?>
        <a href="<?php echo get_category_link(get_queried_object_id()); ?>"><?php single_cat_title(); ?></a>
    <?php elseif (is_single()) : ?>
        <a href="<?php echo get_post_type_archive_link('ressource'); ?>">Ressources</a>
        <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
    <?php else : ?>
        <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
    <?php endif; ?>
</div>