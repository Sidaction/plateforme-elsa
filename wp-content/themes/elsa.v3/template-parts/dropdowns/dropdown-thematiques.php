
<?php 

  $meta = get_option('info');
  if (empty($meta)) 
    $meta = array();
    
  if (!is_array($meta)) 
    $meta = (array) $meta;

  $theme_1 = get_field('dd-theme-1', 'options');
  $theme_1_id = $theme_1[0];
  $theme_1_datas = get_term_by('id', $theme_1_id, 'category');
  $theme_1_datas_ = $meta[$theme_1_id];
  $theme_1_vignette = $theme_1_datas_['image']; 
  $theme_1_vignette_src = wp_get_attachment_image($theme_1_vignette[0], 'small');

?>

<div class="dropdown">
  <div class="wrapper">

    <div class="flex space start-y">
      <h3 class="h3 mb-l">Les thématiques</h3>
      <button class="close-dd-btn on-mobile" aria-label="Fermer la fenêtre">
        <?php get_template_part('svg/svg', 'close', array( 'strokes' => '#000' )); ?>
      </button>
    </div>

    <div class="grid gap-xl">

      <div class="t-12col m-5col">
        <h4 class="h4 mb-s"><?php the_field('dd-theme-title-1', 'options'); ?> : <?php echo $theme_1_datas->name; ?></h4>

        <div class="dd_text m-2col">
          <?php the_field('dd-theme-1-text', 'options'); ?>
        </div>

        <a class="btn" href="/category/<?php echo $theme_1_datas->slug; ?>">
          <?php get_template_part('svg/svg', 'arrow', array( 'fill' => '#FFF' )); ?>
        </a>
      </div>

      <div class="t-12col m-7col">
        <?php
          $terms = get_terms( 'category', array(
              'hide_empty'  => false,
              'exclude'     => '1' // "general"
          ) );

          if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
              echo '<ul>';
              foreach ( $terms as $term ) {
                  echo '<li class=""><a class="menu-item2" href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a></li>';
              }
              echo '</ul>';
          }

        ?>
      </div>
  
    </div>

  </div>
</div>


