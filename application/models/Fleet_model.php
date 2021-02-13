<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fleet_model extends CI_Model {

	public function __construct()	
	{
		parent::__construct();
		$this->load->database(); 
	}
	
	public function delete_ship($ship_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		return $this->db->where("id", intval($ship_id))
						->delete("fleet");
	}
	
	public function add_ship($ship_data)
	{
		// Parse all the data in case someone is not doing it in the controller
		$data['ship_name'] = strip_tags($ship_data['ship_name']);
		$data['party_id'] = intval($ship_data['party_id']);
		$data['fight_current'] = intval($ship_data['fight_current']);
		$data['health_current'] = intval($ship_data['health_current']);
		$data['cargo_units'] = intval($ship_data['cargo_units']);
		$data['location'] = intval($ship_data['location']);
		$data['cargo'] = strip_tags($ship_data['cargo']);
		$data['notes'] = strip_tags($ship_data['notes']);
		
		$this->db->reset_query();
		$this->db->flush_cache();
		
		return $this->db->insert("fleet", $data);
	}
	
	public function get_party_fleet($party_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->select("*")->from("fleet")
			->where("fleet.party_id", intval($party_id));
		
		return $this->db->get()->result_array();
	}
	
	public function update_ship($ship_data, $ship_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();

		// Parse all the data in case someone is not doing it in the controller
		$data['fight_current'] = intval($ship_data['fight_current']);
		$data['health_current'] = intval($ship_data['health_current']);
		$data['cargo_units'] = intval($ship_data['cargo_units']);
		$data['location'] = intval($ship_data['location']);
		$data['cargo'] = strip_tags($ship_data['cargo']);
		$data['notes'] = strip_tags($ship_data['notes']);
		
		return $this->db->where('id', intval($ship_id))
						->update('fleet', $data);
	}
}

?>