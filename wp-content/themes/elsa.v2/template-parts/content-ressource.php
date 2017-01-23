



  <section id="site-content" class="site-content single-ressource">


    <article class="main-content clearfix noback">
        <div class="page_title ressource_title">

          <div class="wrap row">
              <?php $cnSite->get_back_link(); ?> 

              <h1 class="h1 m-5col m-clearfix">
                  <?php the_title();?>
              </h1>  
          </div>     
        </div>


        <div class="page_content clearfix">
            <div class="wrap row">
                <div class="m-5col page_text">
                  
                  <?php the_content();?>

                  <div class="page_actions">

                    <?php if( $format == 'lien' && !empty($link) ) echo "<a href='{$link}' title='Voir le site' target='_blank' class='btn-primary'>Voir le site ( {$link} )</a>"?>

                    <!--   <?php if( $format!='lien' && $format!='video' && !empty($link) ) echo "<div class='dlDoc'>Télécharger le document<a href='{$link}' title='Télécharger le document' target='_blank'><div class='bttDL'>Télécharger</a></div><div class='clear'></div></div>"?> -->
                     
                    <?php if(!empty($link_crips)) echo "<a href='{$link_crips}' class='btn-primary' title='Accéder au document sur le site du CRIPS' target='_blank'>Accéder au document sur le site du CRIPS</a>"?>

                    <?php
                      $files = rwmb_meta( 'file', 'type=file' );
                      foreach ( $files as $info ) {
                    
                        $size = filesize( $info['path'] );
                        $kind = pathinfo($info['path'], PATHINFO_EXTENSION);
                        $size = false === $size ? 0 : size_format( $size, 2 );
                        
                        echo "<a href='{$info['url']}' title='{$info['title']}' class='btn-primary' target='_blank'>Consultez la ressource <br> [{$info['title']} ({$kind} -{$size} )]</a>";
                      }?>

                  </div><!-- .page_actions -->  

                </div>


                <div class="m-3col page_aside">

                    <div class="page_media clearfix ">
                      <?php the_post_thumbnail('post_thumb'); ?>
                    </div>
                    
                    <div class="page_metas">

                        <?php if(!empty($auteurs)) : ?>
                          <div class="page_metas_row">
                            <?php echo '<span>Auteur(s) : </span>'.$auteurs; ?>
                          </div>
                        <?php endif; ?>
                        
                        <div class="page_metas_row">
                          <?php echo get_the_term_list( $post->ID, 'pays_assoc', '<span>Pays : </span>', ', ' ); ?>
                        </div>

                        <div class="page_metas_row">
                          <?php if(!empty($date_edition)) echo '<span>Date d’édition : </span>' . $date_edition;?> 
                        </div>

                        <div class="page_metas_row">
                          <span>Thème(s) :</span> <?php the_category(', '); ?>
                        </div>

                        <div class="page_metas_row">
                          <?php echo get_the_tag_list('<span>Mots clés : </span>',', ');  ?>
                        </div>

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
              <div class="is-on-left"><a class="btn-secondary" href="#">Lire plus tard</a></div>
              <div class="is-on-left btn-secondary share_links">
                Partagez ! 
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><span class=" icon-facebook"></span></a></li>
                <a href="http://twitter.com/share?text=#BiennalePhotoMondeArabe&url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" ><span class=" icon-twitter"></span></a>
                <a href="#"><span class=" icon-twitter"></span></a> </div>
              <div class="is-on-left"><a href="/soumettre" class="btn-secondary">Soumettre une ressource</a></div>
            </div>

          </div>
        </div><!-- .page_tools -->        
    
    </article>