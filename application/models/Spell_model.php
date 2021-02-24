<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spell_model extends CI_Model {

	public function __construct()	
	{
		parent::__construct();
		$this->load->database(); 
	}
	
	public function get_spells($character_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->select('*')->from('spells');
		$this->db->where('character_id', intval($character_id));
		
		return $this->db->get()->result_array();
	}
	
	public function delete_spell($spell_id)
	{
	 	$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->where("id", intval($spell_id));
		$this->db->delete("spells");
		
		return $this->db->affected_rows();
	}
	 
	public function add_spell($spell_data, $character_id)
	{
	 	$this->db->reset_query();
		$this->db->flush_cache();

		$data['character_id'] = intval($character_id);
		$data['name'] = strip_tags($spell_data['spell_name']);
		$data['description'] = strip_tags($spell_data['spell_descr']);
		$data['recharge'] = intval($spell_data['spell_recharge']);
		$data['used'] = intval($spell_data['used_charge']);

		$this->db->insert('party_equipment', $data);
		
		return $this->db->affected_rows();
	}
	
	public function update_spell($spell_data, $character_id)
	{
	 	$this->db->reset_query();
		$this->db->flush_cache();
		
		$data['name'] = strip_tags($spell_data['spell_name']);
		$data['description'] = strip_tags($spell_data['spell_descr']);
		$data['recharge'] = intval($spell_data['spell_recharge']);
		$data['used'] = intval($spell_data['used_charge']);
		
		$this->db->where('id', intval($character_id));
		$this->db->update('spells', $data);
		
		return $this->db->affected_rows();
	}
}

?>
