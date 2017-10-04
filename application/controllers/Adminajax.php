<?php
		defined('BASEPATH') OR exit('No direct script access allowed');

	class Adminajax extends CI_Controller  
		{
			
			public function __construct()
				{
					parent::__construct();
						
						$this->load->model("AdminModel");
						//$this->load->model("EmailModel");
				}
			public function adminlogin()
				{
					echo $this->AdminModel->adminlogin();
				}
		
			public function updateprofilepass()
				{
					echo $this->AdminModel->updateprofilepass();      
				}
			
		}

?>