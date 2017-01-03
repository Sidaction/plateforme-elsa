<?php
/* ///////////////////////////////////////////////////////////////
  CUSTOM META DU THEME ELSA avec class metaBox
  / Clair et Net.
  ////////////////////////////////////////////////////////////// */

add_action('admin_init', 'rw_register_meta_box');

function rw_register_meta_box() {
    if (!class_exists('RW_Meta_Box'))
        return;
    $meta_boxes = array();
	
    // Diaporama

    $meta_boxes[] = array(
        'title' =>'Détails',
        'pages' => array('diaporama'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => 'Lien',
                'desc' => 'Entrez l\'url complète',
                'id' => 'link',
                'type' => 'text',
                'std' => '',
                'style' => 'width:300px'
            ),
			array(
                'name' => 'Sur-titre',
                'id' => 'surtitre',
                'type' => 'text',
                'std' => '',
                'style' => 'width:300px'
            ),
			array(
                'name' => 'Ouvrir le lien dans une nouvelle fenêtre ?',
                'id' => 'blank',
                'type' => 'radio',
                'options' => array(1=>'Oui ', 0=>'Non')
            ),
             
           
        )
    );

	
	// Ressources
	$meta_boxes[] = array(
        'title' => 'Informations complémentaires',
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
			array(
					'name' => 'Date d\'édition',
					//'desc' => 'Entrez la date (aaaa-mm-jj)',
					'id' => 'date-start',
					'type' => 'text',
				),
						  
			 array(
					'name' => 'Fichier si document à télécharger',
					'id'   => "file",
					'type' => 'file_advanced'
			),
			 array(
                'name' => 'Lien si document en ligne ou vidéo',
                'id' => 'link',
                'type' => 'text',
                'std' => '',
            ),
			/* array(
				'name'    => 'Categorie(s) secondaire(s)',
				'id'      => 'cat_second',
				'type'    => 'taxonomy-advanced',
				'multiple' => true,
				'options' => array(
					'taxonomy' => 'category',
					// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
					'type' => 'checkbox_list',
					
				),
			),*/
			 array(
                'name' => 'Remontée Fiche Thématique',
                'id' => 'homefiche',
                'type' => 'radio',
                'options' => array(1=>'Oui ', 0=>'Non')
            ),
			 array(
                'name' => 'Lien CRIPS',
                'id' => 'link_crips',
                'type' => 'text'
            ),
			 array(
                'name' => 'Outil',
                'id' => 'outil',
                'type' => 'radio',
                'options' => array(1=>'Oui ', 0=>'Non')
            ),
			 
			 array(
					'name' => 'Likes',
					'id' => 'like',
					'type' => 'text',
					 'std' => '0',
				),
			  
		 )
    );
	
	$meta_boxes[] = array(
        'title' => 'Auteurs et organismes associés',
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
						  
			
			 array(
					'name' => 'Auteur-e(s)',
					'id'   => 'auteur',
					'type' => 'textarea'
			),

			 array(
				'name'    => 'Membre ELSA',
				'id'      => 'first_org',
				'type'    => 'post',
				'post_type' => 'structure',
				'field_type' => 'select_advanced',
				'multiple' => true,
				'query_args' => array(
					'orderby' => 'title',
					'order' => 'ASC'
				),
				
			),
			 
			array(
				'name'    => 'Autres Organismes',
				'id'      => 'second_org',
				'type'    => 'post',
				'multiple' => true,
				'post_type' => 'structure',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'orderby' => 'title',
					'order' => 'ASC'
				),
			),
			
			array(
				'name'    => 'Associations partenaires ELSA',
				'id'      => 'other_org',
				'type'    => 'post',
				'multiple' => true,
				'post_type' => 'structure',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'orderby' => 'title',
					'order' => 'ASC'
				),
			),
			  
		 )
    );
	
	$meta_boxes[] = array(
        'title' => 'Contribution',
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
						  
			array(
                'name' => 'Nom du contributeur',
                'id' => 'contname',
                'type' => 'text',
                'std' => '',
            ),
			array(
                'name' => 'Prénom du contributeur',
                'id' => 'contfirtname',
                'type' => 'text',
                'std' => '',
            ),

			 array(
                'name' => 'Email du contributeur',
                'id' => 'contemail',
                'type' => 'text',
                'std' => '',
            ),
			
			 array(
                'name' => 'Email du contributeur',
                'id' => 'contassoc',
                'type' => 'text',
                'std' => '',
            ),
			  
		 )
    );
	
	
	// Structures
	$meta_boxes[] = array(
        'title' => 'Détails',
        'pages' => array('structure'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
			array(
                'name' => 'Nom long',
                'id' => 'nomlong',
                'type' => 'text',

            ),
			array(
                'name' => 'Lien',
                'desc' => 'Entrez l\'url complète',
                'id' => 'link',
                'type' => 'url',
            ),
			array(
                'name' => 'Page Facebook',
                'desc' => 'Entrez l\'url complète',
                'id' => 'link2',
                'type' => 'url',
            ),
			array(
                'name' => 'Téléphone',
                'id' => 'tel',
                'type' => 'text',
            ),
			array(
                'name' => 'Email',
                'id' => 'email',
                'type' => 'text',
            ),
			array(
                'name' => 'Ligne d\'écoute',
                'id' => 'ligne',
                'type' => 'text',

            ),
			array(
                'name' => 'Adresse',
                'id' => 'adresse',
                'type' => 'text',

            ),
			array(
                'name' => 'Code postal',
                'id' => 'cp',
                'type' => 'text',

            ),
			array(
                'name' => 'Ville',
                'id' => 'ville',
                'type' => 'text',

            ),
			array(
                'name' => 'Pays pour la géoloc.',
                'id' => 'pays',
				'type'    => 'text',

            ),
			 array(
                'id' => 'loc',
                'name' => 'Géolocalisation',
                'type' => 'map',
                'style' => 'width: 500px; height: 300px',
				'address_field' => 'adresse,cp,ville,pays', 
                
            ),
			 array(
				'name'             => 'Diaporama',
				'id'               => "diaporama",
				'type'             => 'image_advanced',
				
			),
			 
             array(
                'name' => 'Date de création',
                'id' => 'datecreation',
                'type' => 'text',
            ),
			 array(
                'name' => 'Rapport d\'activité',
                'desc' => 'Entrez l\'url complète (externe ou de la bibliothèque média)',
                'id' => 'rapport_activite',
                'type' => 'url',
            ),
			  array(
				'name'    => 'Partenaires ELSA',
				'id'      => 'first_org',
				'type'    => 'post',
				'multiple' => true,
				'post_type' => 'structure',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'orderby' => 'title',
					'order' => 'ASC'
				),
			),
			 
			array(
				'name'    => 'Organisme(s) secondaire(s)',
				'id'      => 'second_org',
				'type'    => 'post',
				'multiple' => true,
				'post_type' => 'structure',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'orderby' => 'title',
					'order' => 'ASC'
				),
			),
			
			/*array(
				'name'    => 'Autre(s) organisme(s)',
				'id'      => 'other_org',
				'type'    => 'post',
				'multiple' => true,
				'post_type' => 'structure',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'orderby' => 'title',
					'order' => 'ASC'
				),
			),*/
			
			array(
                'name' => 'Sur le web',
                'id' => 'web',
                'type' => 'wysiwyg',

            ),
						  
						  
		
			
			)
    );

	
	// Antennes
	$meta_boxes[] = array(
        'title' => 'Détails',
        'pages' => array('antenne'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
			array(
				'name'    => 'Structure associée',
				'id'      => 'struct',
				'type'    => 'post',
				'post_type' => 'structure',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'orderby' => 'title',
					'order' => 'ASC'
				),
			),
						  
			array(
                'name' => 'Adresse',
                'id' => 'adresse',
                'type' => 'text',

            ),
			array(
                'name' => 'Code postal',
                'id' => 'cp',
                'type' => 'text',

            ),
			array(
                'name' => 'Ville',
                'id' => 'ville',
                'type' => 'text',

            ),
			array(
                'name' => 'Pays pour la géoloc',
                'id' => 'pays',
				'type'    => 'post',
				'post_type' => 'pays',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'orderby' => 'title',
					'order' => 'ASC'
				),

            ),
			 array(
                'id' => 'loc',
                'name' => 'Géolocalisation',
                'type' => 'map',
                'style' => 'width: 500px; height: 300px',
				'address_field' => 'adresse,cp,ville,pays',
                
            ),
            
			
			)
    );
	
	
	// Agenda
    $meta_boxes[] = array(
        'title' => 'Informations',
        'pages' => array('agenda'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => 'Date de début(*)',
                'desc' => 'Entrez la date (aaaa-mm-jj)',
                'id' => 'date-start',
                'type' => 'date',
            ),
            array(
                'name' => 'Date de fin(*)',
                'desc' => 'Entrez la date (aaaa-mm-jj) / à renseigner même si identique à date de début',
                'id' => 'date-end',
                'type' => 'date',
            ),
            array(
                'name' => 'Afficher en home',
                'id' => 'home',
                'type' => 'radio',
                'options' => array(1=>'Oui ', 0=>'Non')
            )
			 
        ),
        
    );
	
	// Pays
    $meta_boxes[] = array(
        'title' => 'Informations',
        'pages' => array('pays'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(		  
 			array(
                'name' => 'Informations générales',
                'id' => 'infos',
                'type' => 'wysiwyg',

            ),
			array(
                'name' => 'Rapport national',
                'id' => 'rapport',
                'type' => 'wysiwyg',

            ),
			array(
                'name' => 'Autres liens',
                'id' => 'liens',
                'type' => 'wysiwyg',

            ),
			array(
                'name' => 'Acteurs Locaux (hors associations)',
                'id' => 'infoscomp',
                'type' => 'wysiwyg',

            ),
			array(
                'name' => 'Ligne d\'écoute',
                'id' => 'ligne_ecoute',
                'type' => 'wysiwyg',

            ),
			array(
				'name'    => 'Partenaires',
				'id'      => 'first_org',
				'type'    => 'post',
				'multiple' => true,
				'post_type' => 'structure',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'orderby' => 'title',
					'order' => 'ASC'
				),
			),
				
             array(
                'id' => 'adresse',
                'name' => __('Capitale', 'rwmb'),
                'type' => 'text',
            ),
            array(
                'id' => 'loc',
                'name' => __('Geolocation', 'rwmb'),
                'type' => 'map',
                'style' => 'width: 500px; height: 300px',
                'address_field' => 'adresse', // Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
            ),
			
			
			 
        ),
        
    );
	
	
	// Contenus comp.
	$meta_boxes[] = array(
        'title' => 'Détails',
        'pages' => array('contenu'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
			array(
                'name' => 'Structure',
                'id' => 'structure',
				'type'    => 'post',
				'post_type' => 'structure',
				'multiple' => true,
				'field_type' => 'select_advanced',
				'query_args' => array(
					'orderby' => 'title',
					'order' => 'ASC'
				),
            ),				  
			 array(
					'name' => 'Fichier audio si son',
					'id'   => "file",
					'type' => 'file_advanced'
			),
			 array(
					'name' => 'Code Youtube ou DailyMotion si vidéo',
					'id'   => "link",
					'type' => 'text'
			),
			 array(
				'name' => 'Date de fin',
				'id'   => "end_date",
				'type' => 'date',
			),
			 
			 
		 )
    );
	
	




    foreach ($meta_boxes as $meta_box) {
        $my_box = new RW_Meta_Box($meta_box);
    }
}



/////// TAXONOMIES//////////////////
add_action( 'admin_init', 'register_taxonomy_meta_boxes' );

function register_taxonomy_meta_boxes(){
	if ( !class_exists( 'RW_Taxonomy_Meta' ) )
                return;





$meta_sections = array();



      //  $meta_sections = array();
        $meta_sections[] = array(
                'title'      => 'Informations',             
                'taxonomies' => array('category'), 
                'id'         => 'info',                
                'fields' => array(
						array(
                                'name' => 'Texte de présentation',     // field name
                                 'id'   => 'presentation',
                                'type' => 'wysiwyg',                   // field type
                        ),
						array(
                                'name' => 'Détails',     // field name
                                 'id'   => 'details',
                                'type' => 'wysiwyg',                   // field type
                        ),
						array(
                                'name' => 'Vignette',                  // field name
                                 'id'   => 'image',
								'type' => 'image',
                        ),
						
                ),
        );


        foreach ( $meta_sections as $meta_section )        {
                new RW_Taxonomy_Meta( $meta_section );
        }
}


?>
