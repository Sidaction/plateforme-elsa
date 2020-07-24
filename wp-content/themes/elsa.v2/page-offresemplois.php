<?php 

/*
 * Page "Offres d'emploi"
 * Template Name: Page Offres d'emploi
 */

$rebonds = get_field('rebonds_default', 'option'); 

get_header(); ?>


 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <section id="site-content" class="site-content medias_archives">

    <article class="main-content clearfix noback">
        
        <div class="page_title static_title">
       
            <div class="wrap row">
                <h1 class="h1 m-6col is-centered text-on-center">
                    <?php the_title(); ?>
                </h1>
            </div>     
        
        </div>

        <div class="page_content clearfix">
            <div class="wrap">


  <div class="agenda_filters">
                    
<div class="row filter_group">

                    <div class="filter-thematique m-2col m-clearfix">
                      <div class="input--select">
                        <select name="category" class="selectBox" id="select-category"><option value="">Thématique</option> 
 <option name="category[]" value="acces-aux-soins-et-aux-droits">Accès aux soins et aux droits</option><option name="category[]" value="capitalisation-2">Capitalisation</option><option name="category[]" value="coinfection">Coïnfections</option><option name="category[]" value="enfants">Enfants &amp; Adolescent.e.s</option><option name="category[]" value="financements-de-la-lutte-contre-le-sida">Financements</option><option name="category[]" value="formation">Formation</option><option name="category[]" value="genre">Genre</option><option name="category[]" value="pharmacie">Pharmacie</option><option name="category[]" value="plaidoyer">Plaidoyer</option><option name="category[]" value="populations-cles">Populations clés</option><option name="category[]" value="prevention">Prévention</option><option name="category[]" value="prise-en-charge-medicale">Prise en charge médicale</option><option name="category[]" value="prise-en-charge-psychosociale">Prise en charge psychosociale</option><option name="category[]" value="relation-daide-a-distance">Relation d'aide à distance</option><option name="category[]" value="sante-sexuelle-et-reproductive-2">Santé sexuelle et reproductive</option><option name="category[]" value="structuration-associative">Structuration associative</option></select>                        <span class="icon-arrow_right-big"></span>
                      </div>
                    </div>
                    
                    <div class="filter-date m-2col">
                      <div class="input--select">
                        <select class="selectBox" name="period" id="period">
                          <option value="debut">Depuis le début</option>
                          <option value="1semaine">Moins d'une semaine</option>
                          <option value="1mois">Moins d'un mois</option>
                          <option value="3mois">Moins de 3 mois</option>
                          <option value="6mois">Moins de 6 mois</option>
                          <option value="1an">Moins d'un an</option>
                        </select>
                        <span class="icon-arrow_right-big"></span>
                      </div>
                    </div>

                    <div class="filter-pays m-2col">
                      <div class="input--select">
                        <select name="pays_assoc" class="selectBox" id="select-pays_assoc"><option value="">Pays</option> 
 <option name="region[]" value="01-afrique-du-nord">Afrique du Nord</option><option name="region[]" value="02-afrique-de-louest">Afrique de l'Ouest</option><option name="region[]" value="03-afrique-centrale">Afrique Centrale</option><option name="region[]" value="04-afrique-de-lest">Afrique de l'Est</option><option name="region[]" value="05-afrique-australe">Afrique Australe</option><option name="pays_assoc[]" value="algerie">Algérie</option><option name="pays_assoc[]" value="benin">Bénin</option><option name="pays_assoc[]" value="burkina-faso">Burkina Faso</option><option name="pays_assoc[]" value="burundi">Burundi</option><option name="pays_assoc[]" value="cameroun">Cameroun</option><option name="pays_assoc[]" value="cap-vert">Cap Vert</option><option name="pays_assoc[]" value="centrafrique">République Centrafricaine</option><option name="pays_assoc[]" value="comores">Comores</option><option name="pays_assoc[]" value="cote-divoire">Côte d'Ivoire</option><option name="pays_assoc[]" value="djibouti">Djibouti</option><option name="pays_assoc[]" value="gabon">Gabon</option><option name="pays_assoc[]" value="guinee">Guinée</option><option name="pays_assoc[]" value="guinee-equatoriale">Guinée équatoriale</option><option name="pays_assoc[]" value="ile-maurice">Île Maurice</option><option name="pays_assoc[]" value="madagascar">Madagascar</option><option name="pays_assoc[]" value="mali">Mali</option><option name="pays_assoc[]" value="maroc">Maroc</option><option name="pays_assoc[]" value="mauritanie">Mauritanie</option><option name="pays_assoc[]" value="niger">Niger</option><option name="pays_assoc[]" value="ouganda">Ouganda</option><option name="pays_assoc[]" value="republique-democratique-du-congo">République démocratique du Congo</option><option name="pays_assoc[]" value="republique-du-congo">République du Congo</option><option name="pays_assoc[]" value="rwanda">Rwanda</option><option name="pays_assoc[]" value="senegal">Sénégal</option><option name="pays_assoc[]" value="seychelles">Seychelles</option><option name="pays_assoc[]" value="tchad">Tchad</option><option name="pays_assoc[]" value="togo">Togo</option><option name="pays_assoc[]" value="tunisie">Tunisie</option></select>                        <span class="icon-arrow_right-big"></span>
                      </div>
                    </div>

    <div class="m-2col">
        <input type="submit" id="formatbtn" class="btn-primary plain" value="Filtrer">

    </div>


                  </div>



                  <div>
                    <?php

                        $args = array(
                            'posts_per_page' => 16,
                            'post_type' => array('emploi'),
                            'post_status' => 'publish',
                            'paged' => get_query_var( 'paged' )
                        );

                        $the_query = new WP_Query( $args ); 
                        $totalpages = $the_query->max_num_pages;?>

                        <?php if ( $the_query->have_posts() ) : ?>

                            <div class="row medias_list">
                                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                                    <?php set_query_var( 'type', 'media' ); ?>
                                    <?php set_query_var( 'cnSite', $cnSite ); ?>

                                    <?php get_template_part('template-parts/parts/part', 'emploi'); ?>

                                <?php endwhile; ?>
                            </div>

                            <div class="results_nav clearfix row">
                                <div class="nav_pager-bottom m-5col m-last">
                                    <?php cnLib::pagination($totalpages); ?>
                                </div>
                            </div>

                            <?php wp_reset_postdata(); ?>

                        <?php else : ?>
                            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                        <?php endif; ?>

                    </div>
            </div><!-- .wrap -->
        </div><!-- .page_content -->

    </article>


   
  </div>
</section>


<?php endwhile; ?>
<?php get_footer(); ?>