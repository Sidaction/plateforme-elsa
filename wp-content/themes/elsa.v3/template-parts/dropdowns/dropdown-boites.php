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
    
    <div class="flex space start-y">
      <h3 class="h3 mb-l"><?php echo $dd_boite_titre; ?></h3>
      <button class="close-dd-btn on-mobile">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6l-12 12"></path>
            <path d="M6 6l12 12"></path>
        </svg>
      </button>
    </div>
      
    <div class="grid gap-xl">

      <div class="t-12col m-5col">
        <?php echo $dd_boite_texte; ?>
      </div>

      <div class="t-12col m-7col">
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
