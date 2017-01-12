

<?php 

    global $wp;
    $current_url = home_url( add_query_arg( array(), $wp->request) ) . '/';

    $childpages = new WP_Query( array(
      'post_type'      => 'page', 
      'post_parent'    => $root,
      'posts_per_page' => -1,
      'orderby'        => 'menu_order'
    )); ?>

    <?php while ( $childpages->have_posts() ) : $childpages->the_post(); ?>

      <ul class="dark childrenpages-menu no-bullets">

        <li class="childpage-item <?php if( strpos($current_url, get_permalink() ) !== false ) { echo 'current'; } ?>">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>

      </ul>
    
    <?php endwhile; wp_reset_query(); ?>