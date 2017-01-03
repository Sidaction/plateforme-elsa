<form id="rechRess" action="/recherche-documentaire/" class="minisearch">
                <div id="titleRechRess">Rechercher une ressource</div>
                <div id="linksRechRess"><a href="<?php echo $cnSite->rootlink; ?>/aide-a-la-recherche/">» que chercher ?</a>   <a href="<?php echo $cnSite->rootlink; ?>/aide-a-la-recherche/">» comment chercher ?</a></div>
                <div class="clear"></div>
                    <div id="recherche">
                    <input type="text" placeholder="Mots clés, titre ou auteurs" name="totaltags" value=""/>
                    <?php  cnLib::custom_taxonomy_dropdown('category','selectBox','Thématique','','',false,'','totalcat');?>
                     <?php cnLib::custom_taxonomies_dropdown("region, pays_assoc", "selectBox", "Pays",'','',false,'','pays_assoc',array(351,131,161,126,278)); ?>

                    <input type="hidden" name="totalpays" value="" />
            		<input type="hidden" name="totalregions" value="" />

                    <button>OK</button>
                    <div class="clear"></div>
                    </div>
                </form>
                <div class="clear"></div>