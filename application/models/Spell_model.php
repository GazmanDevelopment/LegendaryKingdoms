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
		$data['name'] = strip_tags($spell_data['name']);
		$data['description'] = strip_tags($spell_data['description']);
		$data['recharge'] = intval($spell_data['recharge']);
		$data['used'] = intval($spell_data['used_charge']);

		$this->db->insert('spells', $data);
		
		return $this->db->affected_rows();
	}
	
	public function use_spell($spell_data, $spell_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$used = intval($spell_data['used_charge']);
		
		$sql = "update spells set used = used - ? where id = ?";
		
		$this->db->query($sql, array($used, intval($spell_id)));
		
		return $this->db->affected_rows();
	}
	
	public function recharge_spell($spell_data, $spell_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$recharge_amount = intval($spell_data['recharge_amount']);
		
		// If the recharge amount would be more than the max amount, set to the max amount
		$sql = "update spells set used = case when (used + ?) < recharge then (used + ?) else recharge end where id=?";
		
		$this->db->query($sql, array($recharge_amount, $recharge_amount, intval($spell_id)));		
		
		return $this->db->affected_rows();
	}
}

?>
