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
    
  <!-- STYLES -->
  <link href="<?php echo $cnSite->templatelink; ?>/_css/reset.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Dosis:400,600,700' rel='stylesheet' type='text/css'>
  <link href="<?php echo $cnSite->templatelink; ?>/_css/selectbox.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $cnSite->templatelink; ?>/_css/global.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $cnSite->templatelink; ?>/_css/search.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $cnSite->templatelink; ?>/_css/responsive.css?v=3" rel="stylesheet" type="text/css">
  <!-- STYLES -->
  
  <!-- JS -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.11.5/TweenMax.min.js"></script>
  <script type="text/javascript" src="<?php echo $cnSite->templatelink; ?>/_js/jquery.jcarousel.min.js"></script>
  <script type="text/javascript" src="<?php echo $cnSite->templatelink; ?>/_js/selectbox.js"></script>
  <script type="text/javascript" src="<?php echo $cnSite->templatelink; ?>/_js/interface.js"></script>
  <!-- JS -->
  
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

<div id="menuResp"></div>

    <div id="topFollow">
        <div id="topFollowWrapper">
            <ul>
                <li><a href="/nous-contacter">NOUS CONTACTER</a></li>
                <li class="newsletterTop">NEWSLETTER</li>
                <li><a href="#">NOUS SUIVRE</a></li>
                <li class="facebookTop"><a href="https://www.facebook.com/pages/Plateforme-ELSA/843936832288790" target="_blank"></a></li>
                <li class="twitterTop"><a href="https://twitter.com/PlateformeELSA" target="_blank"></a></li>
                <!-- <li class="youtubeTop"><a href="#"></a></li> -->
                <li class="rssTop"><a href="/rss-plateforme-elsa" target="_blank"></a></li>
            </ul>
        </div>
    </div>
    <div id="newsletterTop">
        <div id="newsletterTopWrapper">
            <ul>
                <li>Pour recevoir notre newsletter, veuillez renseigner votre email :</li>
                <li>
                   
<script type="text/javascript" src="http://www.plateforme-elsa.org/wp-content/plugins/wysija-newsletters/js/validate/languages/jquery.validationEngine-fr.js?ver=2.6.5"></script>
<script type="text/javascript" src="http://www.plateforme-elsa.org/wp-content/plugins/wysija-newsletters/js/validate/jquery.validationEngine.js?ver=2.6.5"></script>
<script type="text/javascript" src="http://www.plateforme-elsa.org/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.5"></script>
<script type="text/javascript">
                /* <![CDATA[ */
                var wysijaAJAX = {"action":"wysija_ajax","controller":"subscribers","ajaxurl":"http://www.plateforme-elsa.org/wp-admin/admin-ajax.php","loadingTrans":"Chargement..."};
                /* ]]> */
                </script><script type="text/javascript" src="http://www.plateforme-elsa.org/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.5"></script>
<!--END Scripts-->

<div class="widget_wysija_cont html_wysija"><div id="msg-form-wysija-html53511c8a3fd9d-1" class="wysija-msg ajax"></div><form id="form-wysija-html53511c8a3fd9d-1" method="post" action="/confirmation-dinscription/#wysija" class="newsletter">
   
    	<input type="text" name="wysija[user][email]" class="wysija-input validate[required,custom[email]]" title="E-mail"  value="" />
   
    

<button>OK</button>

    <input type="hidden" name="form_id" value="1" />
    <input type="hidden" name="action" value="save" />
    <input type="hidden" name="controller" value="subscribers" />
    <input type="hidden" value="1" name="wysija-page" />

    
        <input type="hidden" name="wysija[user_list][list_ids]" value="1" />
    
 </form>
                </li>
            </ul>
        </div>
    </div>
    <div id="logoWrapper">
        <div id="logo">
            <a href="/">
                <h1>Centre de <strong>ressources francophones</strong><br>
                sur le <strong>VIH/sida</strong> en <strong>Afrique</strong></h1>
            </a>
        </div>
        <a href="/plateforme-elsa/" class="plateforme">La plateforme ELSA</a>
    </div>
    <div id="menu" class="home">
        <nav id="menuWrapper">
            <ul>
                <li class="home"><a href="/"></a></li>
                <li><h2><a href="<?php echo $cnSite->rootlink; ?>/dossiers-thematiques/">Dossiers Thématiques</a></h2>
                <div class="ssMenu">
                    	<ul>
                        	<?php wp_list_categories('orderby=name&exclude=1&title_li='); ?> 
                        </ul>
                    </div>
                </li>
                <li><h2><a href="<?php echo $cnSite->rootlink; ?>/pays-dafrique/">Pays d'Afrique</a></h2></li>
                <li>
                	<h2><a href="<?php echo $cnSite->rootlink; ?>/associations-africaines-du-reseau-elsa/">Associations africaines</a></h2>
                    <div class="ssMenu">
                    	<ul>
                        	<li><a href="<?php echo $cnSite->rootlink; ?>/associations-africaines-du-reseau-elsa/">Par nom / par pays</a></li>
                            <li><a href="<?php echo $cnSite->rootlink; ?>/associations-africaines-du-reseau-elsa/annuaire/">Annuaire</a></li>
                        </ul>
                    </div>
                </li>
                <li class="agenda"><h2><a href="<?php echo $cnSite->rootlink; ?>/agenda-elsa/">Agenda</a></h2></li>
                <li class="recherche"><h2><a href="<?php echo $cnSite->rootlink; ?>/recherche-documentaire">Recherche documentaire</a></h2></li>
            </ul>
        </nav>
    </div>
</header>
