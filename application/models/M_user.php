<?php
class m_user extends MY_CRUD {
	function __construct() {
		parent::__construct ();
		$this->_table = 'user';
		$this->primary_key = 'UID';
	}
	function user_exist($UserName) {
		$sql = " SELECT user.UID ";
		$sql .= " FROM user WHERE user.UserName='$UserName' ";
		$Q = $this->db->query ( $sql );
		// echo "<br />".$this->db->last_query();
		if ($Q->num_rows () >= 1) {
			$Q->c ();
			return TRUE;
		} else {
			$Q->free_result ();
			return FALSE;
		}
	}
	function create_user($data) {
		if ($this->user_exist ( $data ["UserName"] )) {
			return FALSE;
		}
		$this->db->insert ( 'user', $data );
		return TRUE;
	}
	function get_my_favour_drug_list($favour_id, $stock_id = null) {
		$dataset = array ();
		$sql = " select  who_drug.name,who_drug.dose,who_drug.formulation ,user_favour_drug_items.who_drug_id as wd_id,user_favour_drug_items.frequency,user_favour_drug_items.how_long ,drug_count.who_drug_count ";
		$sql .= " FROM user_favour_drug_items";
		$sql .= " LEFT JOIN `who_drug` ON who_drug.wd_id = user_favour_drug_items.who_drug_id ";
		$sql .= " left JOIN `drug_count` ON drug_count.who_drug_id= who_drug .wd_id";
		$sql .= " WHERE (user_favour_drug_items.user_favour_drug_id ='$favour_id') and ( user_favour_drug_items.Active)
		and ( drug_count.drug_stock_id = '$stock_id')
		";
		$Q = $this->db->query ( $sql );
		if ($Q->num_rows () > 0) {
			foreach ( $Q->result_array () as $row ) {
				$dataset [] = $row;
			}
		}
		$Q->free_result ();
		return $dataset;
	}
	function get_my_favour($uid) {
		$dataset = array ();
		$sql = " select  user_favour_drug.name ,user_favour_drug.user_favour_drug_id ";
		$sql .= " FROM user_favour_drug";
		$sql .= " WHERE (user_favour_drug.uid ='$uid') and ( user_favour_drug.Active) order by name";
		$Q = $this->db->query ( $sql );
		if ($Q->num_rows () > 0) {
			foreach ( $Q->result_array () as $row ) {
				$dataset [] = $row;
			}
		}
		$Q->free_result ();
		return $dataset;
	}
	
	// PP configuration
	// Change status to production in PP Mode if Admin or Programmer Usergroup
	public function start_production() {
		$sql = "UPDATE `hhimsv2`.`PP_Status` SET `Status` = 'production' WHERE `PP_Status`.`Status` = 'configuration'";
		$Q = $this->db->query ( $sql );
		$this->session->set_userdata ( 'Config', 'production' );
		header ( "Location: /hhims/index.php/preference" );
	}
}
