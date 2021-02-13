<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Battlefield_model extends CI_Model {

	public function __construct()	
	{
		parent::__construct();
		$this->load->database(); 
	}
	
	public function init_battlefield($party_id, $bf_type)
	{
		// Parse all the data in case someone is not doing it in the controller
		$data['party_id'] = intval($party_id);
		$data['type'] = strip_tags($bf_type);
		$data['lf_support'] = 0;
		$data['c_support'] = 0;
		$data['rf_support'] = 0;
		$data['lf_front'] = 0;
		$data['c_front'] = 0;
		$data['rf_front'] = 0;
		
		$this->db->reset_query();
		$this->db->flush_cache();

		// Clear any pre-existing data
		$where_array = array("party_id" => $data['party_id'], "type" => $data['type']);
		$this->db->delete("battlefield", $where_array);

		return $this->db->insert("battlefield", $data);	
	}
	
	public function get_battlefield_status($party_id, $bf_type)
	{
		$this->db->reset_query();
		$this->db->flush_cache();

		$where_array = array('party_id' => intval($party_id), 'type' => strip_tags($bf_type));

		$this->db->select("*")
			->from("battlefield")
			->where($where_array);
		
		return $this->db->get()->result_array();
	}
	
	public function update_battlefield($bf_data, $party_id, $bf_type)
	{
		$this->db->reset_query();
		$this->db->flush_cache();

		// Parse all the data in case someone is not doing it in the controller
		$data['lf_support'] = intval($bf_data['lf_support']);
		$data['c_support'] = intval($bf_data['c_support']);
		$data['rf_support'] = intval($bf_data['rf_support']);
		$data['lf_front'] = intval($bf_data['lf_front']);
		$data['c_front'] = strip_tags($bf_data['c_front']);
		$data['rf_front'] = strip_tags($bf_data['rf_front']);
		
		$where_array = array('party_id' => intval($party_id), 'type' => strip_tags($bf_type));

		$this->db->where($where_array);

		return $this->db->update('battlefield', $data);		
	}
}

?>