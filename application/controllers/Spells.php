<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spells extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        // Load the models before ion_auth
        $this->load->model('spell_model');
        
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

	public function add_spell()
	{
		$character_id = intval($this->input->post('character_id'));
		$data['name'] = strip_tags($this->input->post('spell_name'));
		$data['description'] = strip_tags($this->input->post('spell_descr'));
		$data['recharge'] = intval($this->input->post('spell_recharge'));
		$data['used'] = intval($this->input->post('used_charge'));

		$return_val = $this->spell_model->add_spell($data, $character_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function delete_spell()
	{
		$spell_id = intval($this->input->post('delete_spell_id'));

		$return_val = $this->spell_model->delete_spell($spell_id);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function update_spell()
	{
		$character_id = intval($this->input->post('character_id'));
		$data['name'] = strip_tags($this->input->post('spell_name'));
		$data['description'] = strip_tags($this->input->post('spell_descr'));
		$data['recharge'] = intval($this->input->post('spell_recharge'));
		$data['used'] = intval($this->input->post('used_charge'));

		$return_val = $this->spell_model->update_spell($spell_data, $character_id)

		header('Content-type: application/json');
		echo json_encode($return_val);
	}
}
