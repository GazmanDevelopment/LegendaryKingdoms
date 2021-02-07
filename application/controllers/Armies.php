<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Armies extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        // Load the models before ion_auth
        $this->load->model('army_model');
        
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

	public function add_army()
	{
		$data['unit'] = strip_tags($this->input->post('new_army_unit'));
		$data['party_id'] = intval($this->input->post('new_army_party_id'));
		$data['initial_strength'] = intval($this->input->post('new_army_strength'));
		$data['current_strength'] = intval($this->input->post('new_army_strength'));
		$data['initial_morale'] = intval($this->input->post('new_army_morale'));
		$data['current_morale'] = intval($this->input->post('new_army_morale'));
		$data['garrison'] = strip_tags($this->input->post('new_army_garrison'));
		$data['current_location'] = intval($this->input->post('new_army_location'));
		$data['found_location'] = intval($this->input->post('new_army_location'));
		$data['notes'] = strip_tags($this->input->post('new_army_notes'));

		$return_val = $this->army_model->add_army($data);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function update_army()
	{
		$army_id = intval($this->input->post('army_id'));
		$data['current_strength'] = intval($this->input->post('strength_current'));
		$data['current_morale'] = intval($this->input->post('morale_current'));
		$data['current_location'] = intval($this->input->post('location_current'));
		$data['notes'] = strip_tags($this->input->post('army_notes'));

		$return_val = $this->army_model->update_army($data, $army_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function delete_army()
	{
		$army_id = intval($this->input->post('army_id'));

		$return_val = $this->army_model->delete_army($army_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}
}
