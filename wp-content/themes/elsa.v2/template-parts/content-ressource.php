
    <article class="main-content clearfix noback">
        <div class="page_title ressource_title">

          <div class="wrap">
              <?php $cnSite->get_back_link(); ?> 

              <h1 class="h1">
                  <?php the_title();?>
              </h1>  
          </div>     
        </div>


        <div class="page_content clearfix">
            <div class="wrap row">
                <div class="m-5col">
                  
                  <?php the_content();?>

                  <div class="page_actions">
                  
                    <?php 
                      if($format == 'video' && !empty($link)) echo wp_oembed_get($link);
                    ?>

                    <?php if( $format=='link' && !empty($link) ) echo "<div class='dlDoc'>{$link}<a href='{$link}' title='Voir le site' target='_blank'><div class='bttDL'>Voir le site</a></div><div class='clear'></div></div>"?>

                    <?php if( $format!='link' && $format!='video' && !empty($link) ) echo "<div class='dlDoc'>Télécharger le document<a href='{$link}' title='Télécharger le document' target='_blank'><div class='bttDL'>Télécharger</a></div><div class='clear'></div></div>"?>
                     
                    <?php if(!empty($link_crips)) echo "<div class='dlDoc crips'>Notice issue du CRIPS<a href='{$link_crips}' title='Accéder au document sur le site du CRIPS' target='_blank'><div class='bttDL'>Accéder au document sur le site du CRIPS</a></div><div class='clear'></div></div>"?>

                    <?php
                      $files = rwmb_meta( 'file', 'type=file' );
                      foreach ( $files as $info ) {
                    
                        $size = filesize( $info['path'] );
                        $kind = pathinfo($info['path'], PATHINFO_EXTENSION);
                        $size = false === $size ? 0 : size_format( $size, 2 );
                        
                        echo "<div class='dlDoc'>{$info['title']} ({$kind} -{$size} )<a href='{$info['url']}' title='{$info['title']}' target='_blank'><div class='bttDL'>Télécharger</a></div></div>";
                      }?>

                  </div><!-- .page_actions -->

                </div>


                <div class="m-3col page_aside">

                    <div class="page_media">
                      <?php the_post_thumbnail('large'); ?>
                    </div>
                    
                    <div class="page_metas">
                        
                      <div class="auteurs">
                        <?php if(!empty($auteurs)) echo 'Auteur(s) : '.$auteurs;?> </div>

                        <?php 
                          $main_authors= get_post_meta($post->ID, 'first_org', false);
                          
                          if(!empty($main_authors)){
                            foreach($main_authors as $main_author){
                              $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($main_author), 'thumbnail' );
                              $url = $thumb['0'];
                              $permalink = get_permalink( $main_author );
                              if(!empty($url)) echo "<a href='{$permalink}'><img src='{$url}'  /></a>";
                            }
                          } 
                        ?>

                        <div class="detailName"><?php if( count(wp_get_object_terms( $post->ID, 'pays_assoc')) > 0 ) echo 'Pays :'?></div>
                        
                        <div class="detail"><?php echo cnLib::get_term_list_link( $post->ID, 'pays_assoc', '/pays/' ); ?> </div>

                        <div class="detailName"><?php if(!empty($date_edition)) echo 'Date d’édition :';?> </div>
                        <div class="detail"><?php echo $date_edition;?></div>


                        <div class="datepost">mis en ligne le
                          <?php the_date( 'd F Y' ); ?>
                        </div>

                        <?php if( !empty($tools) && $tools==1 ): ?>
                          <div class="tools"></div>
                          <?php endif ?>

                        <div class="">
                          <?php if( cnLib::get_main_term($post->ID, 'category','Général') !='' ) echo 'Thème(s) :'?>
                        </div>
                        
                        <div class="">
                          <?php if( cnLib::get_main_term($post->ID, 'category','Général') !='' )  the_category(', '); ?>
                        </div>

                        <?php echo get_the_tag_list('<div class="detailName"> Mots clés :</div><div class="detail">',', ','</div>');  ?>

                    </div><!-- .metas -->


                </div><!-- .ressource_aside -->
            </div><!-- .wrap -->
        </div><!-- .page_content -->


        <div class="page_tools blocs_group">
          <div class="wrap row">
    
            <div class="group_title--small m-2col">
              <?php $cnSite->get_fiche_nav();?> 
            </div>

            <div class="group_content m-6col">
              <a href="#">Lire plus tard</a>
              <div>Partagez ! <a href="#">Facebook</a> <a href="#">Twitter</a> <a href="#">mail</a> </div>
              <a href="/soumettre" class="btn-secondary">Soumettre une ressource</a>
            </div>

          </div>
        </div><!-- .page_tools -->        
    
    </article>