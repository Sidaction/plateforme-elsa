<?php
global $gema75_ril_frontend;
?>

        <div class="page_tools blocs_group">
          <div class="wrap row">
    
            <div class="group_title--small m-2col">
              <?php $cnSite->get_fiche_nav();?> 
            </div>

            <div class="group_content m-6col">

              <div class="is-on-left btn-secondary"><?php echo $gema75_ril_frontend->show_readitlater_after_content(''); ?></div>

              <div class="is-on-left btn-secondary share_links">
                Partager 
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><span class=" icon-facebook"></span></a></li>
                <a href="http://twitter.com/share?text=#BiennalePhotoMondeArabe&url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" ><span class=" icon-twitter"></span></a>
                <a href="#"><span class=" icon-mail"></span></a> </div>
              
              <div class="is-on-left"><a href="/soumettre" class="btn-secondary">Soumettre une ressource</a></div>

            </div>

          </div>
        </div><!-- .page_tools -->   