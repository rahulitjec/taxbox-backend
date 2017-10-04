<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	//set the class variable.
			
		public $template  = array();
		public $data      = array();
	
	public function __contruct(){
		parent::__construct();
	   $this->load->model('Common_model');
	}
	
	
	/*	Admin Page Layout*/

		public function adminLayout( $data ) 
			{
				$this->template['header']   = $this->load->view("back/includes/header",   $data , true);
				$this->template['sidebar']  = $this->load->view('back/includes/sidebar',   $data , true);
				$this->template['footer']   = $this->load->view('back/includes/footer',   $data , true);
			return $this->template ;
			}

	/*	Admin Page Layout*/
	
	
	public function password($pass,$salt = null, $type){
		
		if($type == 'encrypt'){
			return $this->encryption->encrypt($salt.$pass);				
		}else if($type == 'decrypt'){
			return $this->encryption->decrypt($pass);		
		}else{
			return false;
		}
	}
	
}