<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment_model extends CI_Model {

	public function __construct()	
	{
		parent::__construct();
		$this->load->database(); 
	}
	
	 public function delete_party_equipment($equipment_id)
	 {
	 	$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->where("id", intval($equipment_id));
		return $this->db->delete("party_equipment");
	 }
	 
	 public function move_equipment_to_vault($equipment_id, $party_id)
	 {
	 	$this->db->reset_query();
		$this->db->flush_cache();

		$data['vault_id'] = intval($party_id);
		$data['character_id'] = null;
		
		$this->db->where('id', intval($equipment_id));
		return $this->db->update("party_equipment", $data);
	 }
	 
	 public function add_equipment_to_character($equipment_id, $character_id)
	 {
	 	$this->db->reset_query();
		$this->db->flush_cache();

		$data['vault_id'] = null;
		$data['character_id'] = intval($character_id);

		$this->db->where('id', intval($equipment_id));
		return $this->db->update('party_equipment', $data);
	 }
	 
	 public function add_new_equipment($data)
	 {
	 	$this->db->reset_query();
		$this->db->flush_cache();

		return $this->db->insert("party_equipment", $data);
	 }
	 
	 public function update_equipment($data)
	 {
	 	// CHange skill mod, mod value, notes etc
	 }
	 
	public function get_equipment_for_character($character_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->select("*")->from("party_equipment")
			->where("character_id", intval($character_id));
			
		return $this->db->get()->result_array();
	}
	
	public function get_equipment_for_party($party_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->select("*")->from("party_equipment")
			->where("vault_id", intval($party_id));
			
		return $this->db->get()->result_array();
	}
}

?>