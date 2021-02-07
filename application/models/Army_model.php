<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Army_model extends CI_Model {

	public function __construct()	
	{
		parent::__construct();
		$this->load->database(); 
	}
	
	public function delete_army($army_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		return $this->db->where("id", intval($army_id))
						->delete("armies");
	}
	
	public function add_army($army_data)
	{
		// Parse all the data in case someone is not doing it in the controller
		$data['unit'] = strip_tags($army_data['unit']);
		$data['party_id'] = intval($army_data['party_id']);
		$data['initial_strength'] = intval($army_data['initial_strength']);
		$data['current_strength'] = intval($army_data['current_strength']);
		$data['initial_morale'] = intval($army_data['initial_morale']);
		$data['current_morale'] = intval($army_data['current_morale']);
		$data['garrison'] = strip_tags($army_data['garrison']);
		$data['current_location'] = intval($army_data['current_location']);
		$data['found_location'] = intval($army_data['found_location']);
		$data['notes'] = strip_tags($army_data['notes']);
		
		$this->db->reset_query();
		$this->db->flush_cache();
		
		return $this->db->insert("armies", $data);
	}
	
	public function get_party_armies($party_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->select("*")->from("armies")
			->where("armies.party_id", intval($party_id));
		
		return $this->db->get()->result_array();
	}
	
	public function update_army($army_data, $army_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();

		// Parse all the data in case someone is not doing it in the controller
		$data['current_strength'] = intval($army_data['current_strength']);
		$data['current_morale'] = intval($army_data['current_morale']);
		$data['current_location'] = intval($army_data['current_location']);
		$data['notes'] = strip_tags($army_data['notes']);
		
		return $this->db->where('id', intval($army_id))
						->update('armies', $data);
	}
}

?>