
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
  $theme_1_vignette_datas = wp_get_attachment_image_src($theme_1_vignette[0], 'archives_square'); 
  $theme_1_vignette_src = $theme_1_vignette_datas[0];

  $theme_2 = get_field('dd-theme-2', 'options');
  $theme_2_id = $theme_2[0];
  $theme_2_datas = get_term_by('id', $theme_2_id, 'category');
  $theme_2_datas_ = $meta[$theme_2_id];
  $theme_2_vignette = $theme_2_datas_['image']; 
  $theme_2_vignette_datas = wp_get_attachment_image_src($theme_2_vignette[0], 'archives_square'); 
  $theme_2_vignette_src = $theme_2_vignette_datas[0];

?>

<div class="dd_group bg-cut">
  <div class="wrap">

    <div class="row">
      <div class="dd_title m-2col">
        <h4><?php the_field('dd-theme-title-1', 'options'); ?></h4>
      </div>
    </div>

    <div class="dd_content clearfix row">
      <div class="item m-4col">
        <div class="media">
          <img src="<?php echo $theme_1_vignette_src; ?>">
        </div>

        <div class="text">
          <strong><?php echo $theme_1_datas->name; ?></strong>
          <?php the_field('dd-theme-1-text', 'options'); ?>
        </div>
        
        <a href="/category/<?php echo $theme_1_datas->slug; ?>" class="btn-inline"></a>
      </div>

      <div class="item m-4col">
        <div class="media">
          <img src="<?php echo $theme_2_vignette_src; ?>">
        </div>
        <div class="text">
          <strong><?php echo $theme_2_datas->name; ?></strong>
          <?php the_field('dd-theme-2-text', 'options'); ?>
        </div>
        <a href="/category/<?php echo $theme_2_datas->slug; ?>" class="btn-inline"></a>
      </div>

    </div>

  </div>
</div>



<div class="dd_group bg-cut">
  <div class="wrap">

    <div class="dd_title">
      <h4><?php the_field('dd-theme-title-2', 'options'); ?></h4>
    </div>

    <div class="dd_content">
      <?php
        $terms = get_terms( 'category', array(
            'hide_empty' => false,
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            echo '<ul class="no-bullets has-3col">';
            foreach ( $terms as $term ) {
                echo '<li class=""><a class="btn-inline" href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a></li>';
            }
            echo '</ul>';
        }

      ?>
    </div>
    
  </div>
</div>
