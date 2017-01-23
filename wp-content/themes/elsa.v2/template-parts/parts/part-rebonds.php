    <?php $rebonds = get_field('rebonds_default', 'option'); ?>
    <?php if( $rebonds) : ?>
    <aside class="blocs_group--rebonds">
      <div class="wrap row">

        <div class="group_title m-2col dark">
          <h3 class="h3_alt">A lire aussi</h3>
        </div>
        
        <div class="group_list">
          <?php $i = 1; ?>
          <?php foreach ( $rebonds as $post ) : setup_postdata( $post ); ?>

              <?php 
                $post_type = $post->post_type; 
                switch ($post_type) {
                  case 'page':
                    $type = 'statique';
                    break;

                  case 'post':
                    if( true ) {
                      $type = 'ressource';
                    } else {
                      $type = 'media';
                    }
                    break;
                  
                  default:
                    $type = 'ressource';
                    break;
                }
              ?>

                    <?php if( $i % 4 == 0 ) : ?>
                        <div class="m-2col m-clearfix">

                    <?php else : ?>
                        <div class="m-2col">

                    <?php endif; ?>
                        
                        <?php set_query_var( 'type', $type ); ?>
                        <?php set_query_var( 'cnSite', $cnSite ); ?>
                        <?php get_template_part('template-parts/parts/part', 'bloc'); ?>

                      </div><!-- end .col -->

                <?php $i++; ?>                  

            <?php endforeach; ?>


        </div><!-- .group_list -->

      </div><!-- .row -->
    </aside>
    <?php endif; ?>