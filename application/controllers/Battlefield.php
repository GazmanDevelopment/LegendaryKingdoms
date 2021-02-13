<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Battlefield extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        // Load the models before ion_auth
        $this->load->model('battlefield_model');
        
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
		$header_info['title'] = 'Legendary Kingdoms - Party Tracker';
		
    	$parties = $this->party_model->get_user_parties($this->ion_auth->user()->row()->id);
    	$data['party_list'] = $parties;

    	$this->load->view('template/header', $header_info);
		$this->load->view('party/party_list', $data);
		$this->load->view('template/footer_party_list');
	}

	public function initialise_battlefield($party_id)
	{
		$party_id = intval($party_id);

		$return_val_1 = $this->battlefield_model->init_battlefield($party_id, BATTLEFIELD_PARTY);
		$return_val_2 = $this->battlefield_model->init_battlefield($party_id, BATTLEFIELD_ENEMY);

		$return_val = ($return_val_1 && $return_val_2);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function update_battlefield()
	{
		$party_id = intval($this->input->post('bf_party_id'));
		$bf_type = strip_tags($this->input->post('bf_type'));

		$data['lf_support'] = intval($this->input->post('lf_support'));
		$data['c_support'] = intval($this->input->post('c_support'));
		$data['rf_support'] = intval($this->input->post('rf_support'));
		$data['lf_front'] = intval($this->input->post('lf_front'));
		$data['c_front'] = intval($this->input->post('c_front'));
		$data['rf_front'] = intval($this->input->post('rf_front'));

		$return_val = $this->battlefield_model->update_battlefield($data, $party_id, $bf_type);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function get_battlefield($party_id, $bf_type)
	{
		$party = intval($party_id);
		$bf_type = strip_tags($bf_type);

		$return_val = $this->battlefield_model->get_battlefield_status($party, $bf_type);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}
}
