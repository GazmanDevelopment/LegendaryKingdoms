<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party_model extends CI_Model {

	public function __construct()	
	{
		parent::__construct();
		$this->load->database(); 
	}
	
	public function delete_party($party_id, $user_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		// Delete party members
		$this->db->where("party_id", intval($party_id));
		$this->db->delete("character_list");
		
		$this->db->reset_query();
		$this->db->flush_cache();
		
		// Delete the party
		$this->db->where("party_id", intval($party_id));
		$this->db->delete("party");
	}
	
	public function add_party($party_data)
	{
		$data['party_name'] = strip_tags($party_data['name']);
		$data['party_notes'] = strip_tags($party_data['notes']);
		$data['party_silver'] = 0; // Parties start with no silver
		$data['user_id'] = intval($party_data['user_id']);
		
		$this->db->reset_query();
		$this->db->flush_cache();
		
		return $this->db->insert("party", $data);
	}
	
	public function get_user_parties($user_id) 
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->select("id, party_name, party_silver, party_notes")->from("party")
			->where("user_id", intval($user_id));
			
		return $this->db->get()->result_array();
	}
	
	public function get_party_details($user_id, $party_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->select("id, party_name, party_silver, party_notes, current_location")->from("party")
			->where("user_id", intval($user_id))
			->where("id", intval($party_id));
			
		return $this->db->get()->result_array();
	}
	
	public function update_party_details($party_id, $silver, $notes, $name, $current_location)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$data['party_silver'] = intval($silver);
		$data['party_notes'] = strip_tags($notes);
		$data['party_name'] = strip_tags($name);
		$data['current_location'] = strip_tags($current_location);
		
		$this->db->where('id', intval($party_id));
		return $this->db->update("party", $data);
	}
	
	/***********************************************************************
	 * Party Code Management
	 **********************************************************************/
	public function delete_party_code($party_id, $code)
	{
		$this->db->reset_query();
		$this->db->flush_cache();		
		
		$this->db->group_start();
			$this->db->where("code ", strip_tags($code));
			$this->db->where("party_id", intval($party_id));
		$this->db->group_end();
		return $this->db->delete("party_codes");
	}
	
	public function add_party_code($party_id, $code)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$data['party_id'] = intval($party_id);
		$data['code'] = strip_tags($code);
		
		return $this->db->insert("party_codes", $data);
	}
	
	public function get_party_codes($party_id)
	{
		$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->select("*")->from("party_codes")
			->where("party_id", intval($party_id))
			->order_by("code", "ASC");
		
		return $this->db->get()->result_array();
	}
	
	/***********************************************************************
	 * Party Log Management
	 **********************************************************************/
	 public function delete_party_log($log_id)
	 {
	 	$this->db->reset_query();
		$this->db->flush_cache();
		
		return $this->db->where("id", intval($log_id))
						->delete("party_log");
	 }
	 
	 public function add_party_log($log_data)
	 {
	 	$data['party_id'] = intval($log_data['party_id']);
	 	$data['comments'] = strip_tags($log_data['comments']);
		$data['location'] = intval($log_data['location']);
		$data['completed'] = intval($log_data['completed']);
	 
	 	$this->db->reset_query();
		$this->db->flush_cache();
		
		return $this->db->insert("party_log", $data);
	 }
	 
	 public function get_party_logs($party_id)
	 {
	 	$this->db->reset_query();
		$this->db->flush_cache();
		
		$this->db->select("*")->from("party_log")
			->where("party_id", intval($party_id))
			->order_by("log_date", "DESC");
			
		return $this->db->get()->result_array();
	 }
	 
	 public function update_party_log($log_id, $log_data)
	 {
	 	$data['comments'] = strip_tags($log_data['comments']);
	 	$data['location'] = intval($log_data['location']);
		$data['completed'] = intval($log_data['completed']);
	 
	 	$this->db->reset_query();
		$this->db->flush_cache();
		
		return $this->db->where("id", intval($log_id))
						->update("party_log", $data);
	 }
}

?>
