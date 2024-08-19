<?php global $cnSite; ?>
<div id="rssFeedsWrapper">
        	<h5>Fil d’infos</h5>
            <ul id="rssFeeds">
				<li>
                	<img src="<?php echo $cnSite->templatelink; ?>/assets/img/vih.png" width="70" height="20" />
					<?php  //cnLib::get_rss_feed("http://www.vih.org/articles/feed",3); ?>
                <li>
                	<img src="<?php echo $cnSite->templatelink; ?>/assets/img/onusida.png" width="113" height="19" />
					<?php  cnLib::get_rss_feed("http://www.unaids.org/fr/rss/pressreleases/index.xml",3); ?>
                </li>
                </li>
                
     		</ul>
        </li>    
        </div> 