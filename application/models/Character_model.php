<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Character_model extends CI_Model {

	public function __construct()	
	{
		parent::__construct();
		$this->load->database(); 
	}
	
	public function delete_party_character($character_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		return $this->db->where("id", intval($character_id))
						->delete("character_list");
	}
	
	public function add_party_character($character_data)
	{
		// Parse all the data in case someone is not doing it in the controller
		$data['name'] = strip_tags($character_data['name']);
		$data['fight_max'] = intval($character_data['fight_max']);
		$data['fight_current'] = intval($character_data['fight_current']);
		$data['stealth_max'] = intval($character_data['stealth_max']);
		$data['stealth_current'] = intval($character_data['stealth_current']);
		$data['lore_max'] = intval($character_data['lore_max']);
		$data['lore_current'] = intval($character_data['lore_current']);
		$data['survive_max'] = intval($character_data['survive_max']);
		$data['survive_current'] = intval($character_data['survive_current']);
		$data['charisma_max'] = intval($character_data['charisma_max']);
		$data['charisma_current'] = intval($character_data['charisma_current']);
		$data['health_max'] = intval($character_data['health_max']);
		$data['health_current'] = intval($character_data['health_current']);
		$data['armour_current'] = intval($character_data['armour_current']);
		$data['notes'] = strip_tags($character_data['notes']);
		$data['party_id'] = intval($character_data['party_id']);
		
		$this->db->reset_query();
		$this->db->flush_cache();
		
		return $this->db->insert("character_list", $data);
	}
	
	public function get_party_characters($user_id, $party_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->select("*")->from("character_list")
			//->join('party', 'party.id = character_list.party_id')
			->where("character_list.party_id", intval($party_id));
			//->where("party.user_id", intval($user_id));
		
		return $this->db->get()->result_array();
	}
	
	public function update_character($character_data, $character_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();

		// Parse all the data in case someone is not doing it in the controller
		$data['fight_max'] = intval($character_data['fight_max']);
		$data['fight_current'] = intval($character_data['fight_current']);
		$data['stealth_max'] = intval($character_data['stealth_max']);
		$data['stealth_current'] = intval($character_data['stealth_current']);
		$data['lore_max'] = intval($character_data['lore_max']);
		$data['lore_current'] = intval($character_data['lore_current']);
		$data['survive_max'] = intval($character_data['survive_max']);
		$data['survive_current'] = intval($character_data['survive_current']);
		$data['charisma_max'] = intval($character_data['charisma_max']);
		$data['charisma_current'] = intval($character_data['charisma_current']);
		$data['health_max'] = intval($character_data['health_max']);
		$data['health_current'] = intval($character_data['health_current']);
		$data['armour_current'] = intval($character_data['armour_current']);
		$data['notes'] = strip_tags($character_data['notes']);
		
		return $this->db->where('id', intval($character_id))
						->update('character_list', $data);
	}
}

?>