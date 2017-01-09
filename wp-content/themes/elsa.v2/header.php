<?php global $cnSite; ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php wp_head();?>
  
  <!--[if lt IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="<?php echo $cnSite->templatelink; ?>/_img/favicon.png" />
 
    <!--[if lt IE 9]>
    	<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>  
    <![endif]-->
    
    <!--[if (gte IE 6)&(lte IE 8)]>
    	<script type="text/javascript" src="<?php echo $cnSite->templatelink; ?>/_js/selectivizr.js"></script>
    	<noscript><link rel="stylesheet" href="[fallback css]" /></noscript>
    <![endif]-->
  
</head>
<body>

<header>

    <div class="row wrap subheader">

        <div class="m-4col">
            <img src="" alt="logo ELSA">
            <div class="site-branding">Plateforme ELSA</div>
            <p>Centre de ressources francophones sur le VIH/side en Afrique</p>
        </div>
        <div class="m-8col">menu secondaire</div>

    </div><!-- .wrap -->


    <div class="main-navigation">
        <div class="wrap">

            <section id="rechercheThema" class="searchPage">
                <form id="rechRess" action="/recherche-documentaire/" class="minisearch">   <div id="recherche">
                        <input type="text" placeholder="Taper un terme ou laisser vide pour tout voir" name="totaltags" value=""/>
          
                        <input type="hidden" name="totalpays" value="" />
                        <input type="hidden" name="totalregions" value="" />
                        <button>Rechercher</button>
                    </div>
                </form>  
            </section>
    
            menu principal
        </div>
    </div>       

</header>
