<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {

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

	public function add_equipment()
	{
		$data['equip_name'] = strip_tags($this->input->post('new_item_name'));
		$data['vault_id'] = intval($this->input->post('new_item_party_id'));
		$data['character_id'] = intval($this->input->post('new_item_character_id'));
		$data['notes'] = strip_tags($this->input->post('new_item_notes'));
		$data['skill_mod'] = strip_tags($this->input->post('new_item_skill_mod'));
		$data['mod_value'] = intval($this->input->post('new_item_mod_value'));

		$return_val = $this->equipment_model->add_new_equipment($data);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function return_to_valut()
	{
		$equip_id = intval($this->input->post('return_item_id'));
		$party_id = intval($this->input->post('return_item_party_id'));

		$return_val = $this->equipment_model->move_equipment_to_vault($equip_id, $party_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function drop_equipment()
	{
		$equip_id = intval($this->input->post('drop_item_id'));

		$return_val = $this->equipment_model->delete_party_equipment($equip_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function assign_equipment()
	{
		$equip_id = intval($this->input->post('assign_item_id'));
		$character_id = intval($this->input->post('assign_item_character'));

		$return_val = $this->equipment_model->add_equipment_to_character($equip_id, $character_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}
}
