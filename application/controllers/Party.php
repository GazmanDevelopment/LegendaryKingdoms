<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        // Load the models before ion_auth
        $this->load->model('party_model');
        $this->load->model('equipment_model');
        $this->load->model('character_model');
        $this->load->model('army_model');
        $this->load->model('fleet_model');
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
    	$this->load->view('template/nav_bar', $header_info);
		$this->load->view('party/party_list', $data);
		$this->load->view('template/footer_party_list');
	}

	public function show_party($party_id)
	{
		$header_info['title'] = 'Legendary Kingdoms - Party Tracker';
		$user_id = $this->ion_auth->user()->row()->id;
		
		$party = $this->party_model->get_party_details($user_id, intval($party_id));
		$party_codes = $this->party_model->get_party_codes(intval($party_id));
		$party_log = $this->party_model->get_party_logs(intval($party_id));
		$party_chars = $this->character_model->get_party_characters($user_id, intval($party_id));
		$party_equipment = $this->equipment_model->get_equipment_for_party(intval($party_id));
		$party_armies = $this->army_model->get_party_armies($party_id);
		$party_fleet = $this->fleet_model->get_party_fleet($party_id);
		$enemy_battlefield = $this->battlefield_model->get_battlefield_status($party_id, BATTLEFIELD_ENEMY);
		$party_battlefield = $this->battlefield_model->get_battlefield_status($party_id, BATTLEFIELD_PARTY);

		// Load up character equipment and build a new character array
		$party_characters = array();
		
		foreach($party_chars as $char) {
			$character['info'] = $char;
			
			$char_equip = $this->equipment_model->get_equipment_for_character($char['id']);
			$character['equipment'] = $char_equip;
			
			array_push($party_characters, $character);
		}
		
    	$data['party_info'] = $party;
    	$data['party_codes'] = $party_codes;
    	$data['party_log'] = $party_log;
    	$data['party_characters'] = $party_characters;
    	$data['party_equipment'] = $party_equipment;
    	$data['armies'] = $party_armies;
    	$data['fleet'] = $party_fleet;
    	if ($enemy_battlefield) {
    		$data['bf_enemy'] = $enemy_battlefield[0];
    	} else {
    		$data['bf_enemy'] = null;
    	}

    	if ($party_battlefield) {
    		$data['bf_party'] = $party_battlefield[0];
    	} else {
    		$data['bf_party'] = null;
    	}
    	
		
		$this->load->view('template/header', $header_info);
    	$this->load->view('template/nav_bar', $header_info);
		$this->load->view('party/show_party', $data);
		$this->load->view('template/footer_party_list');
		/*
		$config = Array(
			'protocol' => 'sendmail',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
			);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		

	    $this->email->from('no-reply@horscrust.com', 'Legends Party Tracker');
	    $this->email->to('djadumbration@gmail.com');
	    $this->email->subject('Registration Verification:');
	    $message = "Thanks for signing up! Your account has been created...!";
	    $this->email->message($message);
	    if ( ! $this->email->send()) {
	        show_error($this->email->print_debugger());
	    } */
	}
	
	public function add_party()
	{
		$data['name'] = strip_tags($this->input->post('party_name'));
		$data['notes'] = strip_tags($this->input->post('party_notes'));
		$data['user_id'] = $this->ion_auth->user()->row()->id;
		
		$return_val = $this->party_model->add_party($data);
		
		header('Content-type: application/json');
    	echo json_encode($return_val);
	}
	
	public function delete_party()
	{		
		$return_val= $this->party_model->delete_party($id, $this->ion_auth->user()->row()->id);
		
		header('Content-type: application/json');
    	echo json_encode($return_val);
	}

	public function add_code()
	{
		$data['code'] = strip_tags($this->input->post('party_code'));
		$data['party_id'] = intval($this->input->post('party_id'));		

		// If the remove flag is set, delete the code instead of adding
		if (isset($_POST['remove'])) {
			$return_val = $this->party_model->delete_party_code($data['party_id'], $data['code']);
		} else {
			$return_val = $this->party_model->add_party_code($data['party_id'], $data['code']);
		}
		

		header('Content-type: application/json');
		echo json_encode($return_val);
	}

	public function update_party()
	{
		$data['party_id'] = intval($this->input->post('party_id_view'));
		$data['party_name'] = strip_tags($this->input->post('party_name'));
		$data['curr_loc'] = intval($this->input->post('current_location'));
		$data['silver'] = intval($this->input->post('silver'));
		$data['notes'] = strip_tags($this->input->post('party_notes'));

		$return_val = $this->party_model->update_party_details($data['party_id'], $data['silver'], $data['notes'], $data['party_name'], $data['curr_loc']);

		header('Content-type: application/json');
		echo json_encode($return_val);
	}
}
