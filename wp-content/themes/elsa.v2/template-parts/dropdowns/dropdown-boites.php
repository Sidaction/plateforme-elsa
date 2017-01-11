

<div class="dd_group">
  <div class="wrap">

    <h4>Toutes les Boites à outils</h4>
    
    <div class="row">

      <div class="m-2col">
        <img src="" class="">
      </div>
      
      <div class="m-3col">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmo tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut al.
      </div>


      <div class="m-2col">
    <?php
      $terms = get_terms( 'boiteoutils', array(
          'hide_empty' => false,
      ) );

      if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
          echo '<ul>';
          foreach ( $terms as $term ) {
              echo '<li>' . $term->name . '</li>';
          }
          echo '</ul>';
      }

    ?>      </div>
    </div>
    

  </div>
</div>
