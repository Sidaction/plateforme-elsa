<?php

global $gema75_read_it_later;


//start framework
$option = new Gema75_input_boxes();


//enqueue color pickers
wp_enqueue_script('wp-color-picker');
wp_enqueue_style( 'wp-color-picker' );

//enqueue image upload scripts
wp_enqueue_script( 'gema75_wc_wl-image-upload',untrailingslashit( plugins_url( '/', __FILE__ ) ).'/includes/image_upload.js' ,array( 'jquery', 'media-upload', 'thickbox' ) );
wp_enqueue_style( 'thickbox' );



//save admin options on submit
if(isset($_POST['gema75_readitlater_submit'])) {

	$gema75_read_it_later->save_admin_options();
}

//get saved options 
$gema75_read_it_later_options = $gema75_read_it_later->get_admin_saved_options()	;

//print_r($gema75_read_it_later_options);

?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
        $('#readitlater_bg_color,#readitlater_text_color').wpColorPicker({
        	color: true,
        });
	});
</script>

<div class="wrap" style="background-color: #fff;padding: 20px;">
	<h2>Read It Later Options</h2>

	<form method="post" >
		<table class="form-table">
		
		
			<tr valign="top">
				<th scope="row">Show after title </th>
				<td  colspan="3">
	
					<?php	
					$boxi = array(
						'type' => 'select',
						'std' => $gema75_read_it_later_options['show_readitlater_link_after_title'],
						'id'=>'show_readitlater_after_title_input',
						'options' => array('yes'=>'Yes','no'=>'No'),
						'description' => 'Show "Read it later" after title '
					);
					
					$option->input($boxi);

					?>

				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row">Show after the content </th>
				<td  colspan="3">
	
					<?php	
					$boxi2 = array(
						'type' => 'select',
						'id' => 'show_on_shop_page',
						'std' => $gema75_read_it_later_options['show_readitlater_link_after_content'],
						'options' => array('yes'=>'Yes','no'=>'No'),
						'description' => 'Show "Read it later" after the post content '
					);

					$option->input($boxi2);
					?>

				</td>
			</tr>
		
			<tr valign="top">
				<th scope="row">Slide position </th>
				<td  colspan="3">
					<?php	
					$boxi_position = array(
						'type' => 'select',
						'id' => 'ril_position',
						'std' => $gema75_read_it_later_options['ril_position'],
						'options' => array('top'=>'Top','bottom'=>'Bottom'),
						'description' => 'Position of the slide-out container '
					);

					$option->input($boxi_position);
					?>					
				</td>
			</tr>
			
			
			<tr valign="top">
				<th scope="row">Page with shortcode </th>
				<td  colspan="3">
					<?php	
					
						  wp_dropdown_pages(array('name'=>'gema75_page_id_with_ril_shortcode','selected'=>$gema75_read_it_later_options['page_id_with_readitlater_shortcode']));
					?>			
		
					<p class="description">Select the page that has the shortcode inserted:<strong>  [gema75_ril] </strong></p>
					
				</td>
			</tr>			
			
	
			
			<tr valign="top">
				<th scope="row">Open slide-out when </th>
				<td  colspan="3">
					<?php	
					$boxi_open_with = array(
						'type' => 'select',
						'id' => 'open_ril_tab_when',
						'std' => $gema75_read_it_later_options['open_ril_tab_when'],
						'options' => array('click'=>'Clicked','hover'=>'Mouse Over'),
						'description' => 'Open the slide-out when clicked or mouse is over '
					);

					$option->input($boxi_open_with);
					?>					
				</td>
			</tr>		

			<tr valign="top">
				<th scope="row">Tab text or Image </th>
				<td  colspan="3">
					<?php	
					$boxi_ril_use_text_or_image_for_slideout_tab = array(
						'type' => 'select',
						'id' => 'ril_use_text_or_image_for_slideout_tab',
						'std' => $gema75_read_it_later_options['ril_use_text_or_image_for_slideout_tab'],
						'options' => array('text'=>'Text','image'=>'Image'),
						'description' => 'Use text or an image for the slide tab'
					);

					$option->input($boxi_ril_use_text_or_image_for_slideout_tab);
					?>					
				</td>
			</tr>			



			<tr valign="top">
				<th scope="row">Panel Width (%)</th>
				<td  colspan="3">
					<?php	
					$boxi_ril_panel_width = array(
						'type' => 'text',
						'id' => 'ril_panel_width_in_percent',
						'std' => $gema75_read_it_later_options['ril_panel_width_in_percent'],
						'description' => 'Panel width in percentage . Write only the number  i.e 60 ... 70  ... 90'
					);

					$option->input($boxi_ril_panel_width);
					?>					
				</td>
			</tr>			

			
			<tr valign="top">
				<th scope="row">Margin Left/Right (%)</th>
				<td  colspan="3">
					<?php	
					$boxi_ril_panel_margin = array(
						'type' => 'text',
						'id' => 'ril_panel_margin_in_percent',
						'std' => $gema75_read_it_later_options['ril_panel_margin_in_percent'],
						'description' => 'Panel margin in percentage . Write only the number  i.e 5...6...7...10'
					);

					$option->input($boxi_ril_panel_margin);
					?>					
				</td>
			</tr>			

			<tr valign="top">
				<th scope="row"><h3> Text customization </h3>	 </th>
				<td  colspan="3">&nbsp;</td>
			</tr>			
			
			<tr valign="top">
				<th scope="row">Slide-out Tab Text </th>
				<td  colspan="3">
					<?php	
					$boxi_ril_tab_header_text = array(
						'type' => 'text',
						'id' => 'ril_slider_tab_header',
						'std' => $gema75_read_it_later_options['ril_slider_tab_header'],
						'description' => 'Slide-out tab text'
					);

					$option->input($boxi_ril_tab_header_text);
					?>					
				</td>
			</tr>	
			
			
			<tr valign="top">
				<th scope="row">Slide-out Tab Image </th>
				<td  colspan="3">
					<?php	
					$boxi_ril_tab_header_image = array(
						'type' => 'upload',
						'id' => 'ril_slider_tab_image',
						'std' => $gema75_read_it_later_options['ril_slider_tab_image'],
						'description' => 'Slide-out tab image'
					);

					$option->input($boxi_ril_tab_header_image);
					?>	
					
					<div id="ril_slider_tab_image_preview"></div>
				</td>
			</tr>			

			<tr valign="top">
				<th scope="row">"Read it later" Text </th>
				<td  colspan="3">
					<?php	
					$boxi_read_it_later_text = array(
						'type' => 'text',
						'id' => 'read_it_later_text',
						'std' => $gema75_read_it_later_options['read_it_later_text'],
						'description' => 'Customize "Read it later" text'
					);

					$option->input($boxi_read_it_later_text);
					?>					
				</td>
			</tr>		

			<tr valign="top">
				<th scope="row">"Already on list" Text </th>
				<td  colspan="3">
					<?php	
					$boxi_already_on_ril_text = array(
						'type' => 'text',
						'id' => 'already_on_ril_text',
						'std' => $gema75_read_it_later_options['already_on_ril_text'],
						'description' => 'Customize "Already on list" text'
					);

					$option->input($boxi_already_on_ril_text);
					?>					
				</td>
			</tr>			
			
			<tr valign="top">
				<th scope="row">"Remove" Text </th>
				<td  colspan="3">
					<?php	
					$boxi_remove_from_ril_text = array(
						'type' => 'text',
						'id' => 'remove_from_readitlater_text',
						'std' => $gema75_read_it_later_options['remove_from_readitlater_text'],
						'description' => 'Customize "Remove from read it later list" text'
					);

					$option->input($boxi_remove_from_ril_text);
					?>					
				</td>
			</tr>
			
			
			<tr valign="top">
				<th scope="row">"Remove all from list" Text </th>
				<td  colspan="3">
					<?php	
					$boxi_remove_all_from_ril_text = array(
						'type' => 'text',
						'id' => 'remove_all_from_ril_text',
						'std' => $gema75_read_it_later_options['remove_all_from_ril_text'],
						'description' => 'Customize "Remove all from list" text'
					);

					$option->input($boxi_remove_all_from_ril_text);
					?>					
				</td>
			</tr>			
			
			<tr valign="top">
				<th scope="row">"Added to list" Text </th>
				<td  colspan="3">
					<?php	
					$boxi_added_to_ril_list_text = array(
						'type' => 'text',
						'id' => 'added_to_ril_list_text',
						'std' => $gema75_read_it_later_options['added_to_ril_list_text'],
						'description' => 'Customize "Added to Read it later list" text'
					);

					$option->input($boxi_added_to_ril_list_text);
					?>					
				</td>
			</tr>
			

			
			
			<tr valign="top">
				<th scope="row">List Counter </th>
				<td  colspan="3">
					<?php	
					$boxi_ril_tab_header_counter = array(
						'type' => 'select',
						'id' => 'ril_slider_tab_header_show_counter',
						'std' => $gema75_read_it_later_options['ril_slider_tab_header_show_counter'],
						'options' => array('yes'=>'Yes','no'=>'No'),
						'description' => 'Show numeric counter on the slideout tab '
					);
					$option->input($boxi_ril_tab_header_counter);
					?>					
				</td>
			</tr>				
			
			<tr valign="top">
				<th scope="row">Styles </th>

				<td  colspan="1">
					<?php
					$boxi_text_color = array(
						'type' => 'colorpicker',
						'id' => 'readitlater_bg_color',
						'std' => $gema75_read_it_later_options['readitlater_bg_color'],
						'description' => 'Background color '
					);
					$option->input($boxi_text_color);		
					?>					
				</td>				
				
				<td  colspan="1">
					<?php
					$boxi_text_color = array(
						'type' => 'colorpicker',
						'id' => 'readitlater_text_color',
						'std' => $gema75_read_it_later_options['readitlater_text_color'],
						'description' => 'Text color '
					);
					$option->input($boxi_text_color);		
					?>					
				</td>				
				
				
				<td  colspan="1">
					<?php
					$boxi_text_size = array(
						'type' => 'colorpicker',
						'id' => 'readitlater_text_size',
						'std' => $gema75_read_it_later_options['readitlater_text_size'],
						'description' => 'Font size in pixel '
					);
					$option->input($boxi_text_size);		
					?>					
				</td>
			</tr>	


			<tr valign="top">
				<th scope="row"><h3>Social Share </h3>	 </th>
				<td  colspan="3">&nbsp;</td>
			</tr>

			<tr valign="top">
				<th scope="row">Image URL</th>
				<td  colspan="3">
					<?php	
					$boxi_social_share_logo_url = array(
						'type' => 'text',
						'id' => 'social_share_logo_url',
						'std' => $gema75_read_it_later_options['social_share_logo_url'],
						'description' => 'URL of an image or website logo to be used for Facebook and Pinterest sharing'
					);
					$option->input($boxi_social_share_logo_url);
					?>
				</td>
			</tr>			
			
			<tr valign="top">
				<th scope="row">Facebook Share</th>
				<td  colspan="3">
					<?php	
					$boxi_allow_sharing_on_facebook = array(
						'type' => 'select',
						'id' => 'allow_sharing_on_facebook',
						'std' => $gema75_read_it_later_options['allow_sharing_on_facebook'],
						'options' => array('yes'=>'Yes','no'=>'No'),
						'description' => 'Allow list to be shared on Facebook '
					);
					$option->input($boxi_allow_sharing_on_facebook);
					?>
				</td>
			</tr>			

			<tr valign="top">
				<th scope="row">&nbsp; </th>
				<td  colspan="3">
					<?php
					$boxi_social_share_facebook_text = array(
						'type' => 'textarea',
						'id' => 'social_share_facebook_text',
						'std' => $gema75_read_it_later_options['social_share_facebook_text'],
						'description' => 'Predefined Facebook message. Used as OG:Meta description'
					);
					$option->input($boxi_social_share_facebook_text);
					?>					
				</td>
			</tr>			

			
			<tr valign="top">
				<th scope="row">Twitter Share </th>
				<td  colspan="3">
					<?php
					$boxi_allow_sharing_on_twitter = array(
						'type' => 'select',
						'id' => 'allow_sharing_on_twitter',
						'std' => $gema75_read_it_later_options['allow_sharing_on_twitter'],
						'options' => array('yes'=>'Yes','no'=>'No'),
						'description' => 'Allow list to be shared on Twitter'
					);
					$option->input($boxi_allow_sharing_on_twitter);
					?>					
				</td>
			</tr>	
			<tr valign="top">
				<th scope="row">&nbsp; </th>
				<td  colspan="3">
					<?php
					$boxi_social_share_twitter_text = array(
						'type' => 'textarea',
						'id' => 'social_share_twitter_text',
						'std' => $gema75_read_it_later_options['social_share_twitter_text'],
						'description' => 'Predefined twitter status message. The URL of the list will be appended last '
					);
					$option->input($boxi_social_share_twitter_text);
					?>					
				</td>
			</tr>	


			<tr valign="top">
				<th scope="row">Pinterest Share </th>
				<td  colspan="3">
					<?php
					$boxi_allow_sharing_on_pinterest = array(
						'type' => 'select',
						'id' => 'allow_sharing_on_pinterest',
						'std' => $gema75_read_it_later_options['allow_sharing_on_pinterest'],
						'options' => array('yes'=>'Yes','no'=>'No'),
						'description' => 'Allow list to be shared on Pinterest'
					);
					$option->input($boxi_allow_sharing_on_pinterest);
					?>					
				</td>
			</tr>	
			<tr valign="top">
				<th scope="row">&nbsp; </th>
				<td  colspan="3">
					<?php
					$boxi_social_share_pinterest_text = array(
						'type' => 'textarea',
						'id' => 'social_share_pinterest_text',
						'std' => $gema75_read_it_later_options['social_share_pinterest_text'],
						'description' => 'Predefined pinterest status message'
					);
					$option->input($boxi_social_share_pinterest_text);
					?>					
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">Google+ Share</th>
				<td  colspan="3">
					<?php	
					$boxi_allow_sharing_on_googleplus = array(
						'type' => 'select',
						'id' => 'allow_sharing_on_googleplus',
						'std' => $gema75_read_it_later_options['allow_sharing_on_googleplus'],
						'options' => array('yes'=>'Yes','no'=>'No'),
						'description' => 'Allow list to be shared on Google+ '
					);
					$option->input($boxi_allow_sharing_on_googleplus);
					?>
				</td>
			</tr>			

			<tr valign="top">
				<th scope="row">Email to a friend</th>
				<td  colspan="3">
					<?php
					$boxi_allow_sharing_via_email = array(
						'type' => 'select',
						'id' => 'allow_sharing_on_email',
						'std' => $gema75_read_it_later_options['allow_sharing_on_email'],
						'options' => array('yes'=>'Yes','no'=>'No'),
						'description' => 'Allow list to be shared via Email'
					);
					$option->input($boxi_allow_sharing_via_email);
					?>					
				</td>
			</tr>	
			<tr valign="top">
				<th scope="row">&nbsp; </th>
				<td  colspan="3">
					<?php
					$boxi_social_share_email_subject_text = array(
						'type' => 'text',
						'id' => 'social_share_email_subject_text',
						'std' => $gema75_read_it_later_options['social_share_email_subject_text'],
						'description' => 'Predefined email subject message'
					);
					$option->input($boxi_social_share_email_subject_text);
					?>					
				</td>
			</tr>		
			<tr valign="top">
				<th scope="row">&nbsp; </th>
				<td  colspan="3">
					<?php
					$boxi_social_share_email_message_body_text = array(
						'type' => 'textarea',
						'id' => 'social_share_email_body_text',
						'std' => $gema75_read_it_later_options['social_share_email_body_text'],
						'description' => 'Predefined email body message'
					);
					$option->input($boxi_social_share_email_message_body_text);
					?>					
				</td>
			</tr>

			<tr>
				<td>
					<input type="submit" name="gema75_readitlater_submit" value="Save Changes">
				</td>
			</tr>
		</table>
	</form>			
</div>