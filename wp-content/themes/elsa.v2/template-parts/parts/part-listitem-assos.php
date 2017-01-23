                    <li class="list_item">
                      <a href="<?php the_permalink();?>">
                        <h2 class="h2"><?php the_title();?></h2>
                      </a>
                      
                      <div class="row">
                        <div class="m-1col list_item-pays">
                          <span class="meta"> <?php echo cnLib::get_terms_withoutlink($post->ID, "pays_assoc", $separ = ", ");?></span>
                        </div>

                        <div class="m-5col list_item-publics">
                          <span class="meta">Public(s) cible(s) : </span><?php echo cnLib::get_terms_withoutlink($post->ID, "public_cibles", $separ = ", ");?>
                          <div class="clearfix"></div>
                          <span class="meta">Activité(s) : </span><?php echo cnLib::get_terms_withoutlink($post->ID, "activites", $separ = ", ");?>
                        </div>
                        
                        <div class="m-2col list_item-contact">
                          <ul class="no-bullets">

                            <?php if(!empty(get_post_meta($post->ID, 'tel', true))):?>
                              <li>
                                <span class="btn-inline"><?php echo get_post_meta($post->ID, 'tel', true);?></span>
                              </li>
                            <?php endif;?>

                            <?php if(!empty($link)):?>
                              <li><a href="<?php echo $link;?>" class="btn-inline" target="_blank">Site internet</a></li>
                            <?php endif;?>

                            <?php if(!empty($email)):?>
                              <li><a class="btn-inline" href="mailto:<?php echo $email;?>">Email</a></li>
                            <?php endif;?>
                          </ul>
                        </div>
                        
                      </div>  

                    </li>