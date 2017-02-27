<?php
  $reco = get_field('recommandation');
  $boite = get_the_term_list( $post->ID, 'boiteoutils', 'People: ', ', ' );
  $tools = get_post_meta($post->ID, 'outil', true);

  global $Bookmarks;
  global $gema75_read_it_later;
?>


  <li class="list_item">


      <div class="list_item_inner">

          <?php if( is_search() ) : ?>
            <?php echo $Bookmarks->show_bookmark_btn(); ?>

          <?php elseif( is_page_template( 'page-boomarks.php' ) ) : ?>
            <div class="bookmark">
            <a href="#" class="removeFromRILButton" data-readitlater-id="<?php echo $post->ID ;?>" alt="<?php echo $gema75_read_it_later->remove_from_readitlater_text ;?>" title="<?php echo $gema75_read_it_later->remove_from_readitlater_text ;?>">
              <img src="<?php echo get_template_directory_uri(); ?>/_img/book_full.png" alt="<?php echo $gema75_read_it_later->remove_from_readitlater_text ;?>" title="<?php echo $gema75_read_it_later->remove_from_readitlater_text ;?>">
            </a>
            </div>
            
          <?php endif; ?>



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