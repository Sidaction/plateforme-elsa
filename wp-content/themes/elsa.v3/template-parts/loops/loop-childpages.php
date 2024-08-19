

<?php 

    global $wp;
    $current_url = home_url( add_query_arg( array(), $wp->request) ) . '/';

    $childpages = new WP_Query( array(
      'post_type'      => 'page', 
      'post_parent'    => $root,
      'posts_per_page' => -1,
      'orderby'        => 'menu_order'
    )); ?>

    <ul class="dark childrenpages-menu no-bullets">

      <?php while ( $childpages->have_posts() ) : $childpages->the_post(); ?>

        <li class="childpage-item <?php if( strpos($current_url, get_permalink() ) !== false ) { echo 'current'; } ?>">
          <a href="<?php the_permalink(); ?>" class="btn-inline"><?php the_title(); ?></a>
        </li>
    
      <?php endwhile; wp_reset_query(); ?>

    </ul>
