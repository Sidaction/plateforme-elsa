<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
  Popup agenda
 //////////////////////////////////////////////////////////////*/
  
 ?>
 
 <!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php wp_head();?>
 
  <!-- STYLES -->
  <link href="<?php echo $cnSite->templatelink; ?>/_css/reset.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Dosis:400,600,700' rel='stylesheet' type='text/css'>
  <link href="<?php echo $cnSite->templatelink; ?>/_css/jquery.fancybox.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $cnSite->templatelink; ?>/_css/selectbox.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $cnSite->templatelink; ?>/_css/global.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $cnSite->templatelink; ?>/_css/search.css" rel="stylesheet" type="text/css">
  <!-- STYLES -->
  
  <!-- JS -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.11.5/TweenMax.min.js"></script>
	<script type="text/javascript" src="<?php echo $cnSite->templatelink; ?>/_js/selectbox.js"></script>
    <script type="text/javascript" src="<?php echo $cnSite->templatelink; ?>/_js/jquery.fancybox.pack.js"></script>
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

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section id="contentSite" class="bleu agenda">
	<article>
      <h1><?php the_title();?></h1>
      
      <div class="thumbLeft">
        <?php the_post_thumbnail('large'); ?>
      </div>
      <div class="evt ficheagenda <?php echo cnLib::get_main_term_slug($post->ID, 'type_date');?>">
          <?php the_content();?>
          <?php
						$shareurl='http://www.google.com/calendar/event?action=TEMPLATE&trp=false';
						$shareurl.="&text=" .urldecode(get_the_title());
						$shareurl.="&dates=".str_replace("-", "", $date_debut)."T000029Z";
						$shareurl.="/".str_replace("-", "", $date_end)."T000029Z" ;
						$shareurl.="&location=";
						$shareurl.="&details=".urldecode(get_the_excerpt());
						$shareurl.="&sprop="
					?>
          
          <div class="bttAjout"><a href="<?php echo $shareurl;?>" target="_blank">Ajouter à mon agenda</a></div>
          </div>
  </article>   
</section>
<?php endwhile; ?>
</body>
</html>

