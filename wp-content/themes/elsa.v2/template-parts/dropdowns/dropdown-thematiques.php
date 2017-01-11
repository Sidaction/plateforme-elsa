

<div class="dd_group">
  <div class="wrap">

    <div class="row">
      <div class="groupe_title m-2col">
        <h4>Thématiques à la une</h4>
      </div>
    </div>

    <div class="groupe_content clearfix row">

      <div class="item m-4col">
        <div class="media"><img src=""> </div>
        <div class="text">
          <strong>Prise en charge médicale</strong>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi.
        </div>
      </div>

      <div class="item m-4col">
        <div class="media"><img src=""> </div>
        <div class="text">
          <strong>Prise en charge médicale</strong>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi.
        </div>
      </div>

    </div>

  </div>
</div>



<div class="dd_group">
  <div class="wrap">

    <h4>Toutes les thématiques</h4>

    <?php
      $terms = get_terms( 'category', array(
          'hide_empty' => false,
      ) );

      if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
          echo '<ul class="no-bullets">';
          foreach ( $terms as $term ) {
              echo '<li class=""><a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a></li>';
          }
          echo '</ul>';
      }

    ?>

  </div>
</div>
