<?php

  $dd_boite_titre = get_field('dd-boite-title', 'options');
  $dd_boite_img = get_field('dd-boite-img', 'options');
  $dd_boite_texte = get_field('dd-boite-text', 'options');

?>

<div class="dd_group bg-cut">
  <div class="wrap">

    <div class="dd_title m-2col">
      <h4 class="h4"><?php echo $dd_boite_titre; ?></h4>
    </div>
      
    <div class="row">

      <div class="m-2col dd_img">
        <img src="<?php echo $dd_boite_img; ?>" class="">
      </div>
      
      <div class="m-3col dd_content">
        <?php echo $dd_boite_texte; ?>
      </div>

      <div class="m-2col dd_content">
        <?php
          $terms = get_terms( 'boiteoutils', array(
              'hide_empty' => false,
          ) );

          if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
              echo '<ul>';
              foreach ( $terms as $term ) {
                  echo '<li><a class="btn-inline" href="' . esc_url( get_term_link( $term ) ) . '" title="">' . $term->name . '</a></li>';
              }
              echo '</ul>';
          }

        ?>      
      </div>
    </div>
    

  </div>
</div>
