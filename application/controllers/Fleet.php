<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fleet extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        // Load the models before ion_auth
        $this->load->model('fleet_model');
        
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

	public function add_ship()
	{
		$data['ship_name'] = strip_tags($this->input->post('new_ship_name'));
		$data['party_id'] = intval($this->input->post('new_ship_party_id'));
		$data['fight_current'] = intval($this->input->post('new_ship_fight'));
		$data['health_current'] = intval($this->input->post('new_ship_health'));
		$data['cargo_units'] = intval($this->input->post('new_ship_cargo_units'));
		$data['location'] = intval($this->input->post('new_ship_location'));
		$data['cargo'] = strip_tags($this->input->post('new_ship_cargo'));
		$data['notes'] = strip_tags($this->input->post('new_ship_notes'));

		$return_val = $this->fleet_model->add_ship($data);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function update_ship()
	{
		$ship_id = intval($this->input->post('ship_id'));

		$data['fight_current'] = intval($this->input->post('fight_current'));
		$data['health_current'] = intval($this->input->post('health_current'));
		$data['cargo_units'] = intval($this->input->post('cargo_units'));
		$data['location'] = intval($this->input->post('location'));
		$data['cargo'] = strip_tags($this->input->post('cargo'));
		$data['notes'] = strip_tags($this->input->post('ship_notes'));

		$return_val = $this->fleet_model->update_ship($data, $ship_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function delete_ship()
	{
		$ship_id = intval($this->input->post('ship_id'));

		$return_val = $this->fleet_model->delete_ship($ship_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}
}
