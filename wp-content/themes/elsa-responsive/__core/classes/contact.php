<?php
class contact  {
	var $args;	
	public function __construct($emailto, $type) {
		$this->args['step'] = $_POST['step'];
		$this->nonce = $_POST['checknc'];
		if(!wp_verify_nonce($this->nonce, 'my-nonce' )) return;
		if(!empty($_POST['name'])) return;	/// contre les spams
		if($_POST['check']!=4) return;	/// contre les spams
		$this->$emailto=$emailto;
			

		//modification des informations 
		if (($_SERVER["REQUEST_METHOD"] == "POST") && wp_verify_nonce($this->nonce, 'my-nonce' ) && $this->args['step']=='subscribe'){
				$this->args['nom']=sanitize_text_field($_POST['nom']);
				$this->args['prenom']=sanitize_text_field($_POST['prenom']);
				$this->args['email']=sanitize_text_field($_POST['email']);
				$this->args['sujet']=sanitize_text_field($_POST['sujet']);
				$this->args['message']=sanitize_text_field($_POST['message']);
			    $this->args['copie']=sanitize_text_field($_POST['copie']);	
					
					
					
					if(!empty($this->args['copie'])){
					$message = "
	Bonjour ,
	Votre message a bien été envoyé à notre équipe qui le traitera dans les meilleurs délais :".
		" 
	Votre nom : ". $this->args['prenom'] ." " .$this->args['nom'] ." 
	Votre email : ". $this->args['email'] ."
	Votre sujet : ". $this->args['sujet']."
	Votre message : 
	« ". $this->args['message'] ." »
	
	Nous vous en remercions.
	Cordialement
	L'équipe de la plate-forme ELSA ";
	
	wp_mail($this->args['email'], "Plate-forme ELSA : votre message", $message);
					}
			$message = "
	Bonjour,
	Une message a été postée sur le site par :".
	" ".
	$this->args['prenom'] ." " .$this->args['nom'] ." 
	Email : ". $this->args['email'] ."
	Sujet : ". $this->args['sujet']."
	Message : 
	« ". $this->args['message'] ." »
";
			
			
				   wp_mail($this->$emailto, "Plate-forme ELSA : Nouveau message ", $message);
				   $this->args['step']='valid';

				   
				
		}
		
	}
	public function get_args(){
		return $this->args;  
	}

}
