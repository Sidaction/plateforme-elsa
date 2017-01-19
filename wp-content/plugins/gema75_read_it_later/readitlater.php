<?php
/*
Plugin Name: Gema75 - Read It Later
Plugin URI: http://codecanyon.net/user/Gema75/portfolio
Description: Add posts and pages to a Read it Later list
Version: 1.2
Author: Gema75
Author URI: http://codecanyon.net/user/Gema75
*/



if (!class_exists('Gema75_Read_It_Later')) {

	class Gema75_Read_It_Later {

		

		public $show_readitlater_link_after_content = 'no';

		public $show_readitlater_link_after_title = 'no';
		
		public $page_id_with_readitlater_shortcode = '1';
		
		public $ril_position = 'top';
		
		//text of the slideout tab
		public $ril_slider_tab_header = 'Read it Later';
		
		//image of the slideout tab 
		public $ril_slider_tab_image ='';
		
		//image of the slideout tab 
		public $ril_slider_tab_image_width ='';

		//image of the slideout tab 
		public $ril_slider_tab_image_height ='';		
		
		//use text or image for the slideout tab
		public $ril_use_text_or_image_for_slideout_tab = 'text';
		
		//panel width in percentage
		public $ril_panel_width_in_percent = '80';
		
		//panel margin in percent
		public $ril_panel_margin_in_percent = '5';
		
		
		//"Read it later" text
		public $read_it_later_text = 'Read it later';
		
		//"Added to Read it later list" text
		public $added_to_ril_list_text = 'Added to Read it later list';
		
		//"Already on the list" text
		public $already_on_ril_text = 'Already on the list';
		

		
		//"remove" from RIL
		public $remove_from_readitlater_text = 'Remove';		
		
		//"remove all" from RIL  
		public $remove_all_from_ril_text = 'Remove all';
		
		//show counter of how many post/pages on RIL tab
		public $ril_slider_tab_header_show_counter = 'yes';
		
		//open RIL tab when clicked or hover
		public $open_ril_tab_when = 'click';
		
		// background color
		public $readitlater_bg_color= '#dd3333';
		
		//text color
		public $readitlater_text_color= '#336699';
		
		//text size in pixel
		public $readitlater_text_size = '14';
		
		//facebook share 
		public $allow_sharing_on_facebook = 'yes';
		
		//facebook description
		public $social_share_facebook_text='Facebook share text description';
		
		//twitter share 
		public $allow_sharing_on_twitter = 'yes';
		
		//text for the twitt
		public $social_share_twitter_text = 'Look what i found for twitter';

		//pinterest share
		public $allow_sharing_on_pinterest = 'yes';
		
		//text for pinterest
		public $social_share_pinterest_text = 'Text for pinterest';

		//pinterest share
		public $allow_sharing_on_googleplus = 'yes';		
		
		//image or logo url for social share . to be used as banner of OG:IMAGE and Pinterest
		public $social_share_logo_url='';

		//email share
		public $allow_sharing_on_email = 'yes';
		
		//text for email subject
		public $social_share_email_subject_text = 'Text for email subject';

		//text for email message body
		public $social_share_email_body_text = 'Text for email message body';	

		

		function __construct(){
			
			define( 'GEMA75_READITLATER_PLUGIN_URL', untrailingslashit( plugins_url( '/', __FILE__ ) ) );
			define( 'GEMA75_READITLATER_PLUGIN_DIR', plugin_dir_path(__FILE__) );
			

			//add admin menu
			add_action( 'admin_menu', array($this,'add_admin_menu') );	

			//hook for our social share templates
			add_action('template_redirect',  array($this,'my_url_handler') );	
			add_filter('init',  array($this,'social_rewrite_rules'));
			
	 		$get_saved_options = get_option('gema75_readitlater_saved_admin_options',true);

			//add default options on plugin activation
			if(!isset($get_saved_options['first_time_installation'])) {
				register_activation_hook( __FILE__, array( $this, 'add_default_options_first_time' ) );
			}


			//get saved options for admin 
			$this->get_admin_saved_options();

			//footer scripts
			add_action('wp_footer',array($this,'append_container_on_footer'));
			add_action('wp_footer',array($this,'enqueue_scripts_and_styles'));

		}
		
		
		function add_admin_menu(){
			add_menu_page( 'Read It Later', 'Read It Later','manage_options', 'gema_readitlater_settings',array( $this, 'show_options_page' ) );
		}	

		
		function show_options_page(){
		
			//include inputs framework
			require_once( GEMA75_READITLATER_PLUGIN_DIR . 'gema75.input.boxes.class.php');

			//open page
			require_once( GEMA75_READITLATER_PLUGIN_DIR . 'admin_options.php');

		}	




		function enqueue_scripts_and_styles(){
				//load slideout assets
				wp_enqueue_script( 'tabslideout-jquery',GEMA75_READITLATER_PLUGIN_URL.'/includes/slidein/jquery.tabslideout.js',array( 'jquery'), '1.3.0', true );
				wp_enqueue_style( 'tabslideout-css',GEMA75_READITLATER_PLUGIN_URL.'/includes/slidein/tabslideout.css' );
				

				//load owl carousel assets
				wp_enqueue_script( 'owlcarousel-jquery',GEMA75_READITLATER_PLUGIN_URL.'/includes/owncarousel/owl.carousel.min.js',array( 'jquery'), '1.3.0', true );
				wp_enqueue_style( 'owlcarousel-css',GEMA75_READITLATER_PLUGIN_URL.'/includes/owncarousel/owl.carousel.css' );
				wp_enqueue_style( 'owlcarousel-theme-css',GEMA75_READITLATER_PLUGIN_URL.'/includes/owncarousel/owl.theme.css' );
				
				//load our own style
				wp_enqueue_style( 'gema75-style-css',GEMA75_READITLATER_PLUGIN_URL.'/styles.css' );
				
				//scripts
				wp_enqueue_script( 'fo-scripts-jquery',GEMA75_READITLATER_PLUGIN_URL.'/includes/scripts.js',array( 'jquery'), '1.3.0', true );
				
				//localize Javascript
				wp_localize_script( 'fo-scripts-jquery', 'gema75_readitlater_js_strings',$this->localize_js() );
				
		}
		
		
		function localize_js() {
		
	
		
			return array(
				'AlreadyExists' 				=> $this->already_on_ril_text,
				'removeFromRIL' 				=> $this->remove_from_readitlater_text,
				'addedToRilList' 				=> $this->added_to_ril_list_text,
				'position'						=> $this->ril_position,
				'open_ril_tab_with'				=> $this->open_ril_tab_when,
				'readitlater_bg_color'			=> $this->readitlater_bg_color,
				'readitlater_text_color'		=> $this->readitlater_text_color,
				'readitlater_text_size'			=> $this->readitlater_text_size,
				'ril_tab_text_or_image'			=> $this->ril_use_text_or_image_for_slideout_tab,
				'slider_tab_image_url'			=> $this->ril_slider_tab_image,
				'slider_tab_image_height'		=> $this->ril_slider_tab_image_width,
				'slider_tab_image_width'		=> $this->ril_slider_tab_image_height,
				'admin_ajax_url'				=> admin_url( 'admin-ajax.php')
			);
		}

		function get_admin_saved_options(){

			$saved_options = get_option('gema75_readitlater_saved_admin_options',true);


			if($saved_options['show_readitlater_link_after_title'] === 'yes'){
				$this->show_readitlater_link_after_title = 'yes' ;
				
			}

			if($saved_options['show_readitlater_link_after_content']==='yes'){
				$this->show_readitlater_link_after_content = 'yes' ;
			}
			
			if(isset($saved_options['page_id_with_readitlater_shortcode'])){
				$this->page_id_with_readitlater_shortcode = $saved_options['page_id_with_readitlater_shortcode'] ;
			}			

			if(isset($saved_options['ril_position'])){
				$this->ril_position = $saved_options['ril_position'] ;
			}	

			if(isset($saved_options['ril_slider_tab_header'])){
				$this->ril_slider_tab_header = $saved_options['ril_slider_tab_header'] ;
			}	

			if(isset($saved_options['ril_panel_width_in_percent'])){
				$this->ril_panel_width_in_percent = $saved_options['ril_panel_width_in_percent'] ;
			}			
			
			if(isset($saved_options['ril_panel_margin_in_percent'])){
				$this->ril_panel_margin_in_percent = $saved_options['ril_panel_margin_in_percent'] ;
			}				
			
			
			if(isset($saved_options['read_it_later_text'])){
				$this->read_it_later_text = $saved_options['read_it_later_text'] ;
			}
			
			if(isset($saved_options['added_to_ril_list_text'])){
				$this->added_to_ril_list_text = $saved_options['added_to_ril_list_text'] ;
			}			
	
			
			if(isset($saved_options['already_on_ril_text'])){
				$this->already_on_ril_text = $saved_options['already_on_ril_text'] ;
			}			
			
			if(isset($saved_options['remove_from_readitlater_text'])){
				$this->remove_from_readitlater_text = $saved_options['remove_from_readitlater_text'] ;
			}			
			
			if(isset($saved_options['remove_all_from_ril_text'])){
				$this->remove_all_from_ril_text = $saved_options['remove_all_from_ril_text'] ;
			}			
			
		
			

			if(isset($saved_options['ril_slider_tab_image'])){
				$this->ril_slider_tab_image = $saved_options['ril_slider_tab_image'] ;
			}			
			
			if(isset($saved_options['image_handler_width'])){
				$this->ril_slider_tab_image_width = $saved_options['image_handler_width'] ;
			}			
			
			if(isset($saved_options['image_handler_height'])){
				$this->ril_slider_tab_image_height = $saved_options['image_handler_height'] ;
			}
		
			
			if(isset($saved_options['ril_use_text_or_image_for_slideout_tab'])){
				$this->ril_use_text_or_image_for_slideout_tab = $saved_options['ril_use_text_or_image_for_slideout_tab'] ;
			}			
			

			if(isset($saved_options['ril_slider_tab_header_show_counter'])){
				$this->ril_slider_tab_header_show_counter = $saved_options['ril_slider_tab_header_show_counter'] ;
			}			
			
			if(isset($saved_options['open_ril_tab_when'])){
				$this->open_ril_tab_when = $saved_options['open_ril_tab_when'] ;
			}
	
			if(isset($saved_options['readitlater_bg_color'])){
				$this->readitlater_bg_color = $saved_options['readitlater_bg_color'] ;
			}	
			
			if(isset($saved_options['readitlater_text_color'])){
				$this->readitlater_text_color = $saved_options['readitlater_text_color'] ;
			}				
			
			
			if(isset($saved_options['readitlater_text_size'])){
				$this->readitlater_text_size = $saved_options['readitlater_text_size'] ;
			}			
			
			if(isset($saved_options['allow_sharing_on_facebook'])){
				$this->allow_sharing_on_facebook = $saved_options['allow_sharing_on_facebook'] ;
			}			
			
			if(isset($saved_options['social_share_facebook_text'])){
				$this->social_share_facebook_text = $saved_options['social_share_facebook_text'] ;
			}		

			if(isset($saved_options['allow_sharing_on_twitter'])){
				$this->allow_sharing_on_twitter = $saved_options['allow_sharing_on_twitter'] ;
			}
			
			if(isset($saved_options['social_share_twitter_text'])){
				$this->social_share_twitter_text = $saved_options['social_share_twitter_text'] ;
			}			

			if(isset($saved_options['allow_sharing_on_pinterest'])){
				$this->allow_sharing_on_pinterest = $saved_options['allow_sharing_on_pinterest'] ;
			}

			if(isset($saved_options['social_share_pinterest_text'])){
				$this->social_share_pinterest_text = $saved_options['social_share_pinterest_text'] ;
			}			
			
			if(isset($saved_options['allow_sharing_on_googleplus'])){
				$this->allow_sharing_on_googleplus = $saved_options['allow_sharing_on_googleplus'] ;
			}			
			
			if(isset($saved_options['social_share_logo_url'])){
				$this->social_share_logo_url = $saved_options['social_share_logo_url'] ;
			}			

			
			if(isset($saved_options['allow_sharing_on_email'])){
				$this->allow_sharing_on_email = $saved_options['allow_sharing_on_email'] ;
			}
			if(isset($saved_options['social_share_email_subject_text'])){
				$this->social_share_email_subject_text = $saved_options['social_share_email_subject_text'] ;
			}	
			if(isset($saved_options['social_share_email_body_text'])){
				$this->social_share_email_body_text = $saved_options['social_share_email_body_text'] ;
			}			

		

			return $saved_options;


		}


		function save_admin_options(){

			$opts_array = array();

			$opts_array['show_readitlater_link_after_title'] = (isset($_POST['show_readitlater_after_title_input'])) ? sanitize_text_field($_POST['show_readitlater_after_title_input']) : 'no';
			
			$opts_array['show_readitlater_link_after_content']   = (isset($_POST['show_on_shop_page'])) ? sanitize_text_field($_POST['show_on_shop_page']) : 'no';
			
			$opts_array['page_id_with_readitlater_shortcode']   = (isset($_POST['gema75_page_id_with_ril_shortcode'])) ? sanitize_text_field($_POST['gema75_page_id_with_ril_shortcode']) : '1';
			
			$opts_array['ril_position']   = (isset($_POST['ril_position'])) ? sanitize_text_field($_POST['ril_position']) : 'bottom';
			$opts_array['ril_slider_tab_header']   = (isset($_POST['ril_slider_tab_header'])) ? sanitize_text_field($_POST['ril_slider_tab_header']) : 'Read it Later';
			$opts_array['read_it_later_text']   = (isset($_POST['read_it_later_text'])) ? sanitize_text_field($_POST['read_it_later_text']) : 'Read it later';
			$opts_array['added_to_ril_list_text']   = (isset($_POST['added_to_ril_list_text'])) ? sanitize_text_field($_POST['added_to_ril_list_text']) : 'Added to Read it later list';
			$opts_array['already_on_ril_text']   = (isset($_POST['already_on_ril_text'])) ? sanitize_text_field($_POST['already_on_ril_text']) : 'Already on the list';
			$opts_array['remove_from_readitlater_text']   = (isset($_POST['remove_from_readitlater_text'])) ? sanitize_text_field($_POST['remove_from_readitlater_text']) : 'Remove';
			$opts_array['remove_all_from_ril_text']   = (isset($_POST['remove_all_from_ril_text'])) ? sanitize_text_field($_POST['remove_all_from_ril_text']) : 'Remove all';
		
			$opts_array['ril_slider_tab_image']   = (isset($_POST['ril_slider_tab_image'])) ? sanitize_text_field($_POST['ril_slider_tab_image']) : '';
			
			$opts_array['ril_use_text_or_image_for_slideout_tab']   = (isset($_POST['ril_use_text_or_image_for_slideout_tab'])) ? sanitize_text_field($_POST['ril_use_text_or_image_for_slideout_tab']) : 'text';
			
			$opts_array['ril_panel_width_in_percent']   = (isset($_POST['ril_panel_width_in_percent'])) ? sanitize_text_field($_POST['ril_panel_width_in_percent']) : '80';
			
			$opts_array['ril_panel_margin_in_percent']   = (isset($_POST['ril_panel_margin_in_percent'])) ? sanitize_text_field($_POST['ril_panel_margin_in_percent']) : '5';
			
			
			
			
			$opts_array['ril_slider_tab_header_show_counter']   = (isset($_POST['ril_slider_tab_header_show_counter'])) ? sanitize_text_field($_POST['ril_slider_tab_header_show_counter']) : 'yes';
			$opts_array['open_ril_tab_when']   = (isset($_POST['open_ril_tab_when'])) ? sanitize_text_field($_POST['open_ril_tab_when']) : 'click';
			$opts_array['readitlater_bg_color']   = (isset($_POST['readitlater_bg_color'])) ? sanitize_text_field($_POST['readitlater_bg_color']) : '#dd3333';
			
			$opts_array['readitlater_text_color']   = (isset($_POST['readitlater_text_color'])) ? sanitize_text_field($_POST['readitlater_text_color']) : '#fff';
			
			$opts_array['readitlater_text_size']   = (isset($_POST['readitlater_text_size'])) ? sanitize_text_field($_POST['readitlater_text_size']) : '14';
			
			$opts_array['allow_sharing_on_facebook']   = (isset($_POST['allow_sharing_on_facebook'])) ? sanitize_text_field($_POST['allow_sharing_on_facebook']) : 'yes';
			$opts_array['social_share_facebook_text']   = (isset($_POST['social_share_facebook_text'])) ? sanitize_text_field($_POST['social_share_facebook_text']) : 'Facebook share text description';
			$opts_array['allow_sharing_on_twitter']   = (isset($_POST['allow_sharing_on_twitter'])) ? sanitize_text_field($_POST['allow_sharing_on_twitter']) : 'yes';
			$opts_array['social_share_twitter_text']   = (isset($_POST['social_share_twitter_text'])) ? sanitize_text_field($_POST['social_share_twitter_text']) : 'Look what i found for twitter';
		
			$opts_array['allow_sharing_on_pinterest']   = (isset($_POST['allow_sharing_on_pinterest'])) ? sanitize_text_field($_POST['allow_sharing_on_pinterest']) : 'yes';
			$opts_array['social_share_pinterest_text']   = (isset($_POST['social_share_pinterest_text'])) ? sanitize_text_field($_POST['social_share_pinterest_text']) : 'Text for pinterest';
			
			$opts_array['allow_sharing_on_googleplus']   = (isset($_POST['allow_sharing_on_googleplus'])) ? sanitize_text_field($_POST['allow_sharing_on_googleplus']) : 'yes';
			
			$opts_array['social_share_logo_url']   = (isset($_POST['social_share_logo_url'])) ? sanitize_text_field($_POST['social_share_logo_url']) : '';
			
			$opts_array['allow_sharing_on_email']   = (isset($_POST['allow_sharing_on_email'])) ? sanitize_text_field($_POST['allow_sharing_on_email']) : 'yes';
			$opts_array['social_share_email_subject_text']   = (isset($_POST['social_share_email_subject_text'])) ? sanitize_text_field($_POST['social_share_email_subject_text']) : 'Text for email subject';	
			$opts_array['social_share_email_body_text']   = (isset($_POST['social_share_email_body_text'])) ? sanitize_text_field($_POST['social_share_email_body_text']) : 'Text for email body message';	

			
			//if we have an image as tab header , get image size
			if($opts_array['ril_slider_tab_image']!='' && $opts_array['ril_use_text_or_image_for_slideout_tab']=='image' ){
				//save image width,height
				$image_url = getimagesize($opts_array['ril_slider_tab_image']);
				$opts_array['image_handler_width']   = $image_url[0];
				$opts_array['image_handler_height']  = $image_url[1];
			}

			//update option 
			update_option('gema75_readitlater_saved_admin_options',$opts_array);

			//print_r(get_option('gema75_readitlater_saved_admin_options',true));
			//die();
			
		}	

		
		/*
		*  adds default plugin admin options 	
		*/
		static function add_default_options_first_time() {

		    $opts = array(
		    		'show_readitlater_link_after_title' 			=> 'no',
		    		'show_readitlater_link_after_content' 			=> 'yes',
					'page_id_with_readitlater_shortcode'			=> '1',
					'ril_position'									=> 'bottom',
					'open_ril_tab_when'								=> 'click',
		    		'readitlater_bg_color'							=> '#dd3333',
		    		'readitlater_text_color'						=> '#336699',
		    		'readitlater_text_size'							=> '14',
		    		'ril_slider_tab_header'							=> 'Read it Later',
		    		'read_it_later_text'							=> 'Read it later',
		    		'added_to_ril_list_text'						=> 'Added to Read it later list',
		    		'already_on_ril_text'							=> 'Already on the list',
		    		'remove_from_readitlater_text'					=> 'Remove',
		    		'remove_all_from_ril_text'					=> 'Remove all',
		    		'ril_slider_tab_image'							=> '',
		    		'ril_use_text_or_image_for_slideout_tab'		=> 'text',
					'ril_panel_width_in_percent'					=> '80',
					'ril_panel_margin_in_percent'					=> '5',
		    		'ril_slider_tab_header_show_counter'		=> 'yes',
		    		
					'allow_sharing_on_facebook'						=> 'yes',
					'social_share_facebook_text'					=> 'Facebook share text description',
		    		
					'allow_sharing_on_twitter'						=> 'yes',
		    		'social_share_twitter_text'						=> 'Look what i found for twitter',
						
					'allow_sharing_on_pinterest'					=> 'yes',
					'social_share_pinterest_text'					=> 'Text for pinterest',
					
					'allow_sharing_on_googleplus'					=> 'yes',
					
					'social_share_logo_url'							=> '',
					
					'allow_sharing_on_email'						=> 'yes',
					'social_share_email_subject_text'				=> 'Text for email subject',		
					'social_share_email_body_text'					=> 'Text for email message body',		
		
	
		
		    		'first_time_installation'						=> 'no' //mark as installed
		    		);

			update_option('gema75_readitlater_saved_admin_options', $opts);
			
			flush_rewrite_rules();
		}
		



		
		/*
		*	Append the main RIL slideout container on the footer 
		*/
		public function append_container_on_footer(){ 

			global $wp_query, $wp_rewrite;

			
			//show image or text for the slideout tab
			if($this->ril_use_text_or_image_for_slideout_tab === 'image' && $this->ril_slider_tab_image != ''){
				$slideout_tab_content =  '<img src="'.$this->ril_slider_tab_image.'">'; 
			}else{
				$slideout_tab_content =  $this->ril_slider_tab_header; 
			}
			
			//slideout tab counter
			if($this->ril_slider_tab_header_show_counter==='yes'){ 
				$tab_counter= '<span id="gema75_wc_wc_count_badge"></span>';
			}else{
				$tab_counter='';
			} 
					
			$slideout_variables_array=array(
											'slideout_tab_header' => $slideout_tab_content,	
											'slideout_tab_counter' => $tab_counter,	
											'slideout_remove_all_text' => $this->remove_all_from_ril_text,	
											);
					
			
			
			
			$slideout_variables= $slideout_variables_array;
			
			//locate slideout header template
			include($this->locate_slideout_template( 'slideout_header.php'));
					
					
			if(is_user_logged_in()){ 
		
				$ril_social_share_array = array();
				
				$ril_social_share_array['ril_url'] = $this->get_ril_social_url();
				
			
				if($this->allow_sharing_on_facebook==='yes'){

					$ril_social_share_array['facebook_link'] = 'https://www.facebook.com/sharer/sharer.php?u='.$ril_social_share_array['ril_url'];
					$ril_social_share_array['facebook_icon'] = $this->locate_social_share_icons('facebook');
				}
				
				if($this->allow_sharing_on_twitter==='yes'){

					$ril_social_share_array['twitter_link'] = 'https://twitter.com/share?url='.$ril_social_share_array['ril_url'].'&amp;text='.$this->social_share_twitter_text;
					$ril_social_share_array['twitter_icon'] = $this->locate_social_share_icons('twitter');
				}
				
				if($this->allow_sharing_on_pinterest==='yes'){

					$ril_social_share_array['pinterest_link'] = 'https://pinterest.com/pin/create/button/?url='.$ril_social_share_array['ril_url'].'&amp;media='.$this->social_share_logo_url.'&description='.$this->social_share_pinterest_text;
					$ril_social_share_array['pinterest_icon'] = $this->locate_social_share_icons('pinterest');
				}	
				
				if($this->allow_sharing_on_googleplus==='yes'){

					$ril_social_share_array['googleplus_link'] = 'https://plus.google.com/share?url='.$ril_social_share_array['ril_url'];
					$ril_social_share_array['googleplus_icon'] = $this->locate_social_share_icons('googleplus');
				}	

				if($this->allow_sharing_on_email==='yes'){

					$ril_social_share_array['email_link'] = 'mailto:?Subject='.$this->social_share_email_subject_text.'&amp;Body='.$this->social_share_email_body_text . ' '. $ril_social_share_array['ril_url'];
					$ril_social_share_array['email_icon'] = $this->locate_social_share_icons('email');
				}							

				
				
				$social_links = $ril_social_share_array;
				
				include($this->locate_slideout_template( 'share_buttons.php'));
			
			} //end if user is loggedin  

			
			
			include($this->locate_slideout_template( 'slideout_footer.php'));
			
			echo '<style>
				body div.slide-out-div , body div.slide-out-div.open{
					width:'. (int) $this->ril_panel_width_in_percent .'%;
					margin: 0px '. (int) $this->ril_panel_margin_in_percent .'%;
					}
			</style>';
		
		} 	

		
		/*
		*	Returns the URL for social sharing depending on permalink structure
		*/
		public function get_ril_social_url(){
			
			global $wp_query, $wp_rewrite;
			
			//check if using pretty permalinks or not
			if ($wp_rewrite->using_permalinks()) {	
			
				$url = get_bloginfo('url').'/rilsoc/'.get_current_user_id().'/';
				
			}else{
			
				$url  = get_bloginfo('url').'/?rilsoc&userid='.get_current_user_id();
				
			}
			
			return urlencode($url);
			
		}
		

		/*
		*  Prepares and returns the URL to be added to OG:URL depending on the shared URL and permalink structure
		*/
		public function prepare_og_meta_url(){
			    
				global $wp_query, $wp_rewrite;
 
				//check if using pretty permalinks or not
				if ($wp_rewrite->using_permalinks()) { 		 
				
					$user_id = $wp_query->query_vars['userid'];
					$url = get_bloginfo('url').'/rilsoc/'.$user_id.'/';
			 
				} else {
			 
					$user_id = $_GET['userid'];
					$url  = get_bloginfo('url').'/?rilsoc&userid='.$user_id;
				}
				
				return $url;
		}

		
		
		/*
		*  Add rewrite rule for social sharing
		*/
		function social_rewrite_rules() {
		
			global $wp;
		
			$wp->add_query_var( 'rilsoc' );
			
			$wp->add_query_var( 'userid' );
			
			add_rewrite_rule('rilsoc/([^/]*)/?','index.php?rilsoc&userid=$matches[1]','top');
			
		}

		
		/*
		*  Redirect to our social share templates
		*/
		public function my_url_handler(){
		
			global $wp_query;

			if (isset($wp_query->query_vars['rilsoc']) ) {

				//check if we are overriding from the theme folder
				if (file_exists(TEMPLATEPATH . '/gema75_read_it_later_templates/read_it_later_share.php')){
					$return_template = TEMPLATEPATH . '/gema75_read_it_later_templates/read_it_later_share.php';
				}
				else {
					//no overridings. use the templates from plugin folder
					$return_template = GEMA75_READITLATER_PLUGIN_DIR . '/gema75_read_it_later_templates/read_it_later_share.php';
				}
				
				
				include($return_template);
				
				die();
			
			}
		

		}
		
		
		/*
		*	Locate slideout template in theme folder or plugin folder
		*/
		public function locate_slideout_template($file,$atts=array()){

				//check if we are overriding from the theme folder
				if (file_exists(TEMPLATEPATH . '/gema75_read_it_later_templates/'.$file)){
					$return_template = TEMPLATEPATH .'/gema75_read_it_later_templates/'.$file;
				}
				else {
					//no overridings. use the templates from plugin folder
					$return_template = GEMA75_READITLATER_PLUGIN_DIR . '/gema75_read_it_later_templates/'.$file;
				}
				
				
				return $return_template;
			
		}
		

		
		
		/*
		*  Return the social share icons found on theme-s plugin override folder or plugin original folder
		*/
		private function locate_social_share_icons($what_network){
		
				if (file_exists(TEMPLATEPATH. '/gema75_read_it_later_templates/social_icons/'.$what_network.'.png')){
				
					$return_icon = get_stylesheet_directory_uri() . '/gema75_read_it_later_templates/social_icons/'.$what_network.'.png';
					
				}else {
				
					//no overridings. use the images from plugin folder
					$return_icon = GEMA75_READITLATER_PLUGIN_URL . '/gema75_read_it_later_templates/social_icons/'.$what_network.'.png';
					
				}
	
				return $return_icon;	
		}

		
		/*
		*	Add shortcode 
		*/
		public function gema75_ril_shortcode(){
		
			ob_start();
			
			$template = $this->locate_slideout_template('read_it_later.php');
			
			include($template);
			
			$rendered_output = ob_get_clean();
			
			return $rendered_output;
			
		}
	
		
	} //end class Gema75_Read_It_Later

	



} //end if class exists Gema75_Read_It_Later


$GLOBALS['gema75_read_it_later'] = new Gema75_Read_It_Later();

require_once( GEMA75_READITLATER_PLUGIN_DIR . 'readitlater.frontend.class.php');


global $gema75_read_it_later;

add_shortcode( 'gema75_ril', array( $gema75_read_it_later, 'gema75_ril_shortcode' ) );

//print_r($gema75_read_it_later );
//unset($gema75_read_it_later);