<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Character extends CI_Controller {

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

	public function add_character()
	{
		$data['name'] = strip_tags($this->input->post('new_character_name'));
		$data['party_id'] = intval($this->input->post('party_id'));
		$data['armour_current'] = intval($this->input->post('armour'));
		$data['charisma_current'] = intval($this->input->post('charisma_current'));
		$data['charisma_max'] = intval($this->input->post('charisma_max'));
		$data['fight_current'] = intval($this->input->post('fight_current'));
		$data['fight_max'] = intval($this->input->post('fight_max'));
		$data['health_current'] = intval($this->input->post('health_current'));
		$data['health_max'] = intval($this->input->post('health_max'));
		$data['lore_current'] = intval($this->input->post('lore_current'));
		$data['lore_max'] = intval($this->input->post('lore_max'));
		$data['notes'] = strip_tags($this->input->post('character_notes'));
		$data['stealth_current'] = intval($this->input->post('stealth_current'));
		$data['stealth_max'] = intval($this->input->post('stealth_max'));
		$data['survive_current'] = intval($this->input->post('survival_current'));
		$data['survive_max'] = intval($this->input->post('survival_max'));

		$return_val = $this->character_model->add_party_character($data);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function update_character()
	{
		$character_id = intval($this->input->post('character_id'));

		$data['armour_current'] = intval($this->input->post('armour_current'));
		$data['charisma_current'] = intval($this->input->post('charisma_current'));
		$data['charisma_max'] = intval($this->input->post('charisma_max'));
		$data['fight_current'] = intval($this->input->post('fight_current'));
		$data['fight_max'] = intval($this->input->post('fight_max'));
		$data['health_current'] = intval($this->input->post('health_current'));
		$data['health_max'] = intval($this->input->post('health_max'));
		$data['lore_current'] = intval($this->input->post('lore_current'));
		$data['lore_max'] = intval($this->input->post('lore_max'));
		$data['notes'] = strip_tags($this->input->post('character_notes'));
		$data['stealth_current'] = intval($this->input->post('stealth_current'));
		$data['stealth_max'] = intval($this->input->post('stealth_max'));
		$data['survive_current'] = intval($this->input->post('survival_current'));
		$data['survive_max'] = intval($this->input->post('survival_max'));

		$return_val = $this->character_model->update_character($data, $character_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function delete_character()
	{
		$character_id = intval($this->input->post('character_id'));

		$return_val = $this->character_model->delete_party_character($character_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}
}
