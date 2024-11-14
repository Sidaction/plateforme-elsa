<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
  Resultats Recherche extract xls
  Template Name: Page Resultats extract xls
 //////////////////////////////////////////////////////////////*/
 		global $cnSite;

		session_start();

		$sitename = sanitize_key( get_bloginfo( 'name' ) );
		$filename = $sitename . '-resultats-' . date( 'Y-m-d' ) . '.xls';
		header('Content-type: application/excel');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Type: text/html; charset=utf-8');
		$output = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
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
						</x:ExcelWorksheet>
					</x:ExcelWorksheets>
				</x:ExcelWorkbook>
			</xml>
			<![endif]-->
		</head>
		
		<body>
		   <table><tr><td><b></b></td><td><b>Titre</b></td><td><b>Format</b></td><td><b>Auteur(s)</b></td><td><b>Pays</b></td><td><b>Thématiques</b></td><td><b>Date d\'édition</b></td><td><b>Résumé</b></td><td><b>Document(s) à télécharger</b></td><td><b>Lien complémentaire</b></td><td><b>Mots clés</b></td></tr>';

		
  		
 			if(!empty($_SESSION['args'])){
 				
				$args = $_SESSION['args'];
				$args['posts_per_page']= -1;
			
				$wp_query = new WP_Query($args);
  			
				if ( $wp_query->have_posts() ) while ($wp_query->have_posts()) : $wp_query->the_post(); 
					$files = rwmb_meta( 'file', 'type=file' );
					$link = get_post_meta($post->ID, 'link', true);
					$download = '';

					foreach ( $files as $info )	{
						$download .="<a href='{$info['url']}' title='{$info['title']}' target='_blank'>{$info['title']}</a>&nbsp;&nbsp;";
					}	
					
					$output .='<tr>';
					$output .='<td><a href='.get_permalink($post->ID).'>voir en ligne</a></td>';
					$output .='<td>'.get_the_title().'</td>';
					$output .='<td>'. cnLib::get_terms_withoutlink($post->ID, 'format').'</td>';
					$output .='<td>'.  $cnSite->get_authors($post->ID) .'</td>';
					$output .='<td>'. cnLib::get_terms_withoutlink($post->ID, 'pays_assoc').'</td>';
					$output .='<td>'. cnLib::get_terms_withoutlink($post->ID, 'category').'</td>';
					$output .='<td>'.get_post_meta($post->ID, 'date-start', true).'</td>';
					$output .='<td>'.strip_tags(get_the_content()).'</td>';
					$output .='<td>'.$download.'</td>';
					$output .='<td><a href='.$link.'>'.$link.'</a></td>';
					$output .='<td>'.cnLib::get_terms_withoutlink($post->ID, 'post_tag').'</td>';				
					$output .='</tr>';
				endwhile; 	
			
			} 

			elseif( !empty($_SESSION['results'])) {
				$args = array(
					'post__in' => $_SESSION['results'],
					'posts_per_page' => -1,
					);
				//$args['posts_per_page']= -1;

				$wp_query = new WP_Query($args);
  			
				if ( $wp_query->have_posts() ) while ($wp_query->have_posts()) : $wp_query->the_post(); 
					$files = rwmb_meta( 'file', 'type=file' );
					$link = get_post_meta($post->ID, 'link', true);
					$download = '';

					foreach ( $files as $info )	{
						$download .="<a href='{$info['url']}' title='{$info['title']}' target='_blank'>{$info['title']}</a>&nbsp;&nbsp;";
					}	
										
					$output .='<tr>';
					$output .='<td><a href='.get_permalink($post->ID).'>voir en ligne</a></td>';
					$output .='<td>'.get_the_title().'</td>';
					$output .='<td>'. cnLib::get_terms_withoutlink($post->ID, 'format').'</td>';
					$output .='<td>'.  $cnSite->get_authors($post->ID) .'</td>';
					$output .='<td>'. cnLib::get_terms_withoutlink($post->ID, 'pays_assoc').'</td>';
					$output .='<td>'. cnLib::get_terms_withoutlink($post->ID, 'category').'</td>';
					$output .='<td>'.get_post_meta($post->ID, 'date-start', true).'</td>';
					$output .='<td>'.strip_tags(get_the_content()).'</td>';
					$output .='<td>'.$download.'</td>';
					$output .='<td><a href='.$link.'>'.$link.'</a></td>';
					$output .='<td>'.cnLib::get_terms_withoutlink($post->ID, 'post_tag').'</td>';
					$output .='</tr>';
				endwhile; 	



			}	 
													   
			$output .= '</table></body></html>';
			print $output;
			exit;
			
		

 
 ?>
