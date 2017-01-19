<?php
  $reco = get_field('recommandation');
  $boite = get_the_term_list( $post->ID, 'boiteoutils', 'People: ', ', ' );
?>


  <li class="list_item">


      <a href="#" class="removeFromRILButton list_item-bookmark" data-readitlater-id="<?php echo $post->ID ;?>" >
        <span class="icon-bookmark_full"><span class="path1"></span><span class="path2"></span></span>
      </a>

      <div class="list_item_inner">

          <div class="list_item-icons">

            <?php if( isset($reco) && $reco ) : ?>
              <span class="icon-recommandation"></span>
            <?php endif; ?>
            <?php if( isset($boite) && $boite ) : ?>
              <span class="icon-boite"></span>
            <?php endif; ?>
          </div>

          <a href="<?php the_permalink();?>?ref=search" class="linkProg">
            <h4 class="h4 list_item-title"><?php the_title();?></h4>
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

            <div class="m-3col list_item-auteurs">
              <?php                              
              if(!empty($main_author)){ ?>
                <span class="meta">Auteur(s) : </span>
                <?php $permalink = get_permalink( $main_author );
                if(!empty($url)) echo "<a href='{$permalink}'>{$main_author}</a>";
              }
              else { ?>
                <span class="meta">Auteur(s) : </span>
                <?php echo $cnSite->get_authors($post->ID);
              } ?>
            </div>
            
          </div>
      </div>
  </li>