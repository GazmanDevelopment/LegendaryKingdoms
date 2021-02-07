<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        // Load the models before ion_auth
        $this->load->model('party_model');
        $this->load->model('equipment_model');
        $this->load->model('character_model');
        
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

	public function add_log()
	{
		$data['party_id'] = intval($this->input->post('party_id'));
		$data['comments'] = strip_tags($this->input->post('new_log_comments'));
		$data['location'] = intval($this->input->post('new_log_location'));
		$data['completed'] = intval($this->input->post('new_log_completed'));

		$return_val = $this->party_model->add_party_log($data);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function update_log()
	{
		$log_id = intval($this->input->post('edit_log_id'));

		$data['comments'] = strip_tags($this->input->post('edit_log_comments'));
		$data['location'] = intval($this->input->post('edit_log_location'));
		$data['completed'] = intval($this->input->post('edit_log_completed'));

		$return_val = $this->party_model->update_party_log( $log_id, $data);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function delete_log()
	{
		$log_id = intval($this->input->post('delete_log_id'));

		$return_val = $this->party_model->delete_party_log($log_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}
}
