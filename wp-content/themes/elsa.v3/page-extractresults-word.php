<?php 
	/** 
	 	* Resultats Recherche extract word
   		* Template Name: Page Resultats extract word
 	*/


 		global $cnSite;
		session_start();
		
		$sitename = sanitize_key( get_bloginfo( 'name' ) );
		$filename = $sitename . '-resultats-' . date( 'Y-m-d' ) . '.doc';
		header('Content-type: application/word');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Type: text/html; charset=utf-8');
		$output = '<html xmlns:x="urn:schemas-microsoft-com:office:word">
		<head>	
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
			<!--[if gte mso 9]>
			<xml>
				<x:ExcelWorkbook>
					<x:ExcelWorksheets>
						<x:ExcelWorksheet>
							<x:Name>Sheet 1</x:Name>
							<x:WorksheetOptions>
								<x:Print>
									<x:ValidPrinterInfo/>
								</x:Print>
							</x:WorksheetOptions>
						</x:wordWorksheet>
					</x:WordWorksheets>
				</x:WordWorkbook>
			</xml>
			<![endif]-->
		</head>
		
		<body>';
	   				
  		
 			if(!empty($_SESSION['args'])){
 				
				$args = $_SESSION['args'];
				$args['posts_per_page']= -1;
			
				$wp_query = new WP_Query($args);
  			
				if ( $wp_query->have_posts() ) while ($wp_query->have_posts()) : $wp_query->the_post(); 
					$files = rwmb_meta( 'file', 'type=file' );
					$link=get_post_meta($post->ID, 'link', true);
					$download='';
					foreach ( $files as $info )	{
						$download .="<a href='{$info['url']}' title='{$info['title']}' target='_blank'>{$info['title']}</a>&nbsp;&nbsp;";
					}	
					
					$output .='<h4>'.get_the_title().'</h4>';
					$output .='<a href='.get_permalink($post->ID).'>voir la ressource en ligne sur le site Plateforme ELSA</a><br>';
					$output .='Format de la ressource : '. cnLib::get_terms_withoutlink($post->ID, 'format').'<br>';
					$output .='Auteur(s) : '.  $cnSite->get_authors($post->ID) .'<br>';
					$output .='Pays concerné(s) : '. cnLib::get_terms_withoutlink($post->ID, 'pays_assoc').'<br>';
					$output .='Thématique(s) : '. cnLib::get_terms_withoutlink($post->ID, 'category').'<br>';
					$output .='Mots cles : '.cnLib::get_terms_withoutlink($post->ID, 'post_tag').'<br>';
					$output .='Date d\'édition : '.get_post_meta($post->ID, 'date-start', true).'<br><br>';
					$output .=''.strip_tags(get_the_content()).'<br>';
					$output .='Lien du document : '.$download.'<br>';
					$output .='<a href='.$link.'>'.$link.'</a><br><br><br>';
					
				
				endwhile; 	
			
			}
													   
			$output .= '</body></html>';
			print $output;

			session_destroy();

			exit;
			
		

 
 ?>
