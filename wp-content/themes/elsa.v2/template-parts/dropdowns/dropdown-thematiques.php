
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

<div class="dd_group bg-cut">
  <div class="wrap">

    <div class="row">
      <div class="dd_title m-3col">
        <h4 class="h4 text-on-right">Les thématiques</h4>
      </div>
    </div>

    <div class="dd_content clearfix row">

      <div class="dd_thema_featured item m-4col">
        <h4 class="h4"><?php the_field('dd-theme-title-1', 'options'); ?></h4>

        <div class="row">
          <a href="/category/<?php echo $theme_1_datas->slug; ?>">

            <div class="media m-2col m-clearfix">
              <?php echo $theme_1_vignette_src; ?>
            </div>

            <div class="dd_text m-2col">
              <h5 class="h5"><?php echo $theme_1_datas->name; ?></h5>
              <?php the_field('dd-theme-1-text', 'options'); ?>
              <span class="btn-inline"></span>
            </div>
          </a>         
        </div>
      </div>

      <div class="dd_thema_list m-4col m-last">

        <h4 class="h4"><?php the_field('dd-theme-title-2', 'options'); ?></h4>

        <div class="dd_actions clearfix">
          <?php
            $terms = get_terms( 'category', array(
                'hide_empty'  => false,
                'exclude'     => '1' // "general"
            ) );

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                echo '<ul class="no-bullets has-2col">';
                foreach ( $terms as $term ) {
                    echo '<li class=""><a class="btn-inline" href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a></li>';
                }
                echo '</ul>';
            }

          ?>
        </div>

      </div>
  
    </div>

  </div>
</div>


