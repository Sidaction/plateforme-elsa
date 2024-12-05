<?php
  $boite = get_the_term_list( $post->ID, 'boiteoutils', 'People: ', ', ' );
  $tools = get_post_meta($post->ID, 'outil', true);
  $reco = get_post_meta($post->ID, 'homefiche', true);
?>


  <li class="list_item">


      <div class="list_item_inner">


          <div class="list_item-icons">
            <?php if( isset($reco) && $reco ) : ?>
              <span class="icon-recommandation"></span>
            <?php endif; ?>
            <?php if( isset($boite) && $boite ) : ?>
              <span class="icon-boite"></span>
            <?php elseif( isset($tools) && $tools === '1' ) : ?>
              <span class="icon-boite"></span>
            <?php endif; ?>
          </div>

          <a href="<?php the_permalink();?>?ref=search" class="linkProg">
            <h2 class="h2 list_item-title"><?php the_title();?></h2>
          </a>

          <div class="row">
            <div class="m-1col list_item-format">
                <span class="meta"><?php echo $format; ?></span>
            </div>

            <div class="m-4col list_item-thematiques">
              <?php if( !empty($cat) ) : ?>
                <div><span class="meta">Thématiques : </span>
                <?php echo $cat ;?></div>
              <?php endif; ?>

              <?php if( !empty($pays) ) : ?>
                <div><span class="meta">Pays : </span>
                <?php echo $pays;?></div>
              <?php endif; ?>
            </div>

              <?php    
              if( !empty($main_author) || $cnSite->get_authors($post->ID) !== ''){ ?>
                <div class="m-3col list_item-auteurs">
                  <span class="meta">Auteur(s) : </span>
                  <?php $permalink = get_permalink( $main_author );
                  if(!empty($url)) echo "<a href='{$permalink}'>{$main_author}</a>"; ?>
                  <?php echo $cnSite->get_authors($post->ID); ?>
                </div>
              <?php } ?>
            
          </div>
      </div>
  </li>