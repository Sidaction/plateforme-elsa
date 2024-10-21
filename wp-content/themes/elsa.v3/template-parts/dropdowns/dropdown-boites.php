<?php

  $dd_boite_titre = get_field('dd-boite-title', 'options');
  $dd_boite_img_datas = get_field('dd-boite-img', 'options');
  $dd_boite_texte = get_field('dd-boite-text', 'options');

    // thumbnail
    $thumb_size = 'small';
    $dd_boite_img = $dd_boite_img_datas['sizes'][ $thumb_size ];
    $width = $dd_boite_img_datas['sizes'][ $thumb_size . '-width' ];
    $height = $dd_boite_img_datas['sizes'][ $thumb_size . '-height' ];
    $alt = $dd_boite_img_datas['alt'];
?>

<div class="dropdown">
  <div class="wrapper">

    <h3 class="h3 mb-l"><?php echo $dd_boite_titre; ?></h3>
      
    <div class="grid gap-xl">

      <div class="s-5col">
        <?php echo $dd_boite_texte; ?>
      </div>

      <div class="s-7col">
        <?php
          $terms = get_terms( 'boiteoutils', array(
              'hide_empty' => false,
          ) );

          if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
              echo '<ul>';
              foreach ( $terms as $term ) {
                  echo '<li><a class="menu-item2" href="' . esc_url( get_term_link( $term ) ) . '" title="">' . $term->name . '</a></li>';
              }
              echo '</ul>';
          }

        ?>      
      </div>

    </div>
    
  </div>
</div>
