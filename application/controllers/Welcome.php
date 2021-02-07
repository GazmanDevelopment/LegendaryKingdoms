<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		// Required
        parent::__construct();
         
        // Load the models before ion_auth
        $this->load->model('party_model');
        
        // Load stuff
		$this->load->library(['session', 'upload', 'ion_auth', 'pagination']);
		$this->load->helper('url');	
		
		// If not logged in, go to login section
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
	}
	
	public function index()
	{
    	//$parties = $this->party_model->get_user_parties(1);
    	$data['party_list'] = $parties;
    	
    	$this->load->view('template/header');
		$this->load->view('welcome_message', $data);
		$this->load->view('template/footer');
	}
}
