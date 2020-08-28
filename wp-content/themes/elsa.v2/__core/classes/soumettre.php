<?php
include_once ABSPATH . 'wp-admin/includes/media.php';
include_once ABSPATH . 'wp-admin/includes/file.php';
include_once ABSPATH . 'wp-admin/includes/image.php';

class doc  {

	var $args, $nonce, $user_id;	

	public function __construct() {
		
		$this->args['alert'] = '';
		$this->args['format'] = '';
		
		$this->nonce = (isset($_POST['checknc']))?$_POST['checknc']:'';
		
		$this->args['step'] =(isset($_POST['step']))? $_POST['step']:'';
		
		if ( ($_SERVER["REQUEST_METHOD"] == "POST") ) {
			self::register_doc();
		}
		
		$user_id = 3;
	}
	

	private function register_doc(){


		if (($_SERVER["REQUEST_METHOD"] == "POST") && wp_verify_nonce($this->nonce, 'my-nonce' )) {
			
			self::get_datas();

			$newpost_id = self::insert_post();
			
			if(!empty($newpost_id)){

				wp_set_object_terms($newpost_id, $this->args['format'], 'format', true);
				wp_set_object_terms($newpost_id, $this->args['category'], 'category', true);
				
				if(!empty($this->args['date-start']	)) add_post_meta($newpost_id, 'date-start', $this->args['date-start'], true);
				if(!empty($this->args['link'])) add_post_meta($newpost_id, 'link', $this->args['link'], true);
				if(!empty($this->args['auteur'])) add_post_meta($newpost_id, 'auteur', $this->args['auteur'], true);
				if(!empty($this->args['contname'])) add_post_meta($newpost_id, 'contname', $this->args['contname'], true);
				if(!empty($this->args['contfirtname'])) add_post_meta($newpost_id, 'contfirtname', $this->args['contfirtname'], true);
				if(!empty($this->args['contemail'])) add_post_meta($newpost_id, 'contemail', $this->args['contemail'], true);
				add_post_meta($newpost_id, 'likes', 0, true);
				if(!empty($this->args['contassoc'])) add_post_meta($newpost_id, 'contassoc', $this->args['contassoc'], true);
				
				if(!empty($this->args['pays_assoc'])){
					foreach($this->args['pays_assoc'] as $pays){
						wp_set_object_terms($newpost_id, $pays, 'pays_assoc', true);
					}
				}
				
				if(!empty($this->args['post_tag'])){
					foreach($this->args['post_tag'] as $pays){
						wp_set_object_terms($newpost_id, $pays, 'post_tag', true);
					}
				}
				
				if(!empty($this->args['organisme'])){
					foreach($this->args['organisme'] as $organisme){
						add_post_meta($newpost_id, 'second_org', $organisme);
					}
				}
			
				$this->args['step']='validregister';
				self::upload_img($newpost_id);
				self::upload_file($newpost_id);
			}	

			$to = get_bloginfo('admin_email');
			$subject = 'Une ressource a été soumise';
			$body = 'Bonjour,<br>';
			$body .= 'La ressource <em>' . $this->args['title'] . '</em> (au format "'. $this->args['format'] .'") a été soumise par ' . $this->args['contname'] . ' (' . $this->args['contemail'] . ') ' . '.<br>La ressource peut être retrouvée dans la page médias du site.<br>';
			$body .= 'Bonne journée ! :)<br>';
			$headers = array('Content-Type: text/html; charset=UTF-8', 'Cc: hello@thomasflorentin.net');

			wp_mail( $to, $subject, $body, $headers );

		
		}
	}
	
	private function insert_post(){
		 $my_post = array();
		 $my_post['post_title'] = $this->args['title'];
		 $my_post['post_content'] = $this->args['desc'];
		 $my_post['post_author'] = $this->user_id;
		 $my_post['post_type'] = 'post';
		 $my_post['post_status'] = 'pending';
		 $newpost_id = wp_insert_post($my_post);




		 return $newpost_id;
	}
	
	
	private function get_datas(){
		if (($_SERVER["REQUEST_METHOD"] == "POST") && wp_verify_nonce($this->nonce, 'my-nonce' )) {
			$this->args['title']				= wp_strip_all_tags( addslashes($_POST['title']));	 
			$this->args['desc']					= wp_strip_all_tags( addslashes($_POST['desc']));
			$this->args['format']				= wp_strip_all_tags( addslashes($_POST['format']));
			$this->args['date-start']		= wp_strip_all_tags( addslashes($_POST['date-start']));
			$this->args['link']					= wp_strip_all_tags( addslashes($_POST['link']));
		//	$this->args['auteur']				= wp_strip_all_tags( addslashes($_POST['auteur']));
			$this->args['contname']			= wp_strip_all_tags( addslashes($_POST['contname']));
		//	$this->args['contfirtname']	= wp_strip_all_tags( addslashes($_POST['contfirtname']));
			$this->args['contemail']		= wp_strip_all_tags( addslashes($_POST['contemail']));
			$this->args['category']			= wp_strip_all_tags( addslashes($_POST['category']));
			$this->args['contassoc']		= wp_strip_all_tags( addslashes($_POST['contassoc']));
			$this->args['pays_assoc']		= $_POST['pays_assoc'];
		//	$this->args['post_tag']			= $_POST['post_tag'];
		//	$this->args['organisme']		= $_POST['organisme'];
			$this->args['name']					= wp_strip_all_tags( addslashes($_POST['name']));/// contre les spams	  
	
		}
		if(!empty($this->args['name'])) return;	/// contre les spams
		if($_POST['check']!=4) return;	/// contre les spams
	}
	
	
	private function upload_img($newpost_id){

		if (wp_verify_nonce($this->nonce, 'my-nonce' ) && !empty($_FILES['image_file']['tmp_name']) ) :
			$file   = $_FILES['image_file'];
			///// Check
			define('MAX_UPLOAD_SIZE', 2000000);  
			define('TYPE_WHITELIST', serialize(array(  
			  'image/jpeg',  
			  'image/png',  
			  'image/gif'
			  )));  
			  
			$image_data = getimagesize($file['tmp_name']);  
	
			if(!in_array($image_data['mime'], unserialize(TYPE_WHITELIST))){  
				$this->args['alert'] = 'wrongformat';
			}elseif(($file['size'] > MAX_UPLOAD_SIZE)){
				$this->args['alert'] = 'wrongsize'; 
			}  
			
			///// upload
			if(empty($this->args['alert'])):
				$attach_id = media_handle_upload('image_file',$newpost_id);
				update_post_meta($newpost_id, '_thumbnail_id', $attach_id); 
			endif;

		endif;
	}
	

	private function upload_file($newpost_id){

		if (wp_verify_nonce($this->nonce, 'my-nonce' ) && !empty($_FILES['doc_source']['tmp_name']) ) :
		
			$file2 = $_FILES['doc_source'];

			define('MAX_UPLOAD_SIZE', 2000000);  
			define('TYPE_WHITELIST', serialize(array(  
			  'application/pdf',  
			  'image/jpeg',  
			  'image/png',  
			  'image/gif'
		  )));  
			  
			
		  if(!in_array($file2['type'], unserialize(TYPE_WHITELIST))){  
				$this->args['alert'] = 'wrongformat'; 
			
		  }
		  elseif(($file2['type'] > MAX_UPLOAD_SIZE)){  
				$this->args['alert'] = 'wrongsize'; 
			}  

			///// upload
			if(empty($this->args['alert'])):
				$attach_id2 = media_handle_upload('doc_source',$newpost_id);
				update_post_meta($newpost_id, 'file', $attach_id2);
				//update_post_meta($attach_id, 'file', $attach_id); 
				endif;

		endif;
	}


	public function get_args(){
		return $this->args;
	}

}


