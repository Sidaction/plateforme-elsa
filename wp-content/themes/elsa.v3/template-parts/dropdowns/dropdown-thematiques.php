
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

    <h3 class="h3 mb-l">Les thématiques</h3>

    <div class="grid gap-xl">

      <div class="s-5col">
        <h4 class="h4 mb-s"><?php the_field('dd-theme-title-1', 'options'); ?> : <?php echo $theme_1_datas->name; ?></h4>

        <div class="dd_text m-2col">
          <?php the_field('dd-theme-1-text', 'options'); ?>
        </div>

        <a class="btn" href="/category/<?php echo $theme_1_datas->slug; ?>">
          <svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M14.7132 0.726395L20.2464 6.21274L20.2927 6.25567C20.4778 6.43926 20.5856 6.68138 20.6016 6.96745L20.6007 7.06362C20.5872 7.29023 20.5006 7.50671 20.33 7.7007L20.2654 7.76735L14.7132 13.2735C14.3026 13.6807 13.6387 13.6807 13.2281 13.2735C12.8151 12.8639 12.8151 12.198 13.2281 11.7884L17.0617 7.98624L1.65394 7.98662C1.07373 7.98662 0.601593 7.51843 0.601593 6.93867C0.601593 6.35891 1.07374 5.89072 1.65394 5.89072L16.938 5.89034L13.2281 2.21154C12.8151 1.80194 12.8151 1.136 13.2281 0.726395C13.6387 0.319229 14.3026 0.319229 14.7132 0.726395Z" fill="#FFFFFF"/>
          </svg>
        </a>
      </div>

      <div class="s-7col">
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


