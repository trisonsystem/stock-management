<?php
class MQuotation extends CI_Model {

	public function __construct(){
		parent::__construct();

	}

	public function save_data(){
		$aSave  = array();
		$aSave['product'] = "4,2,9,5";
		$aSave['status']  = "1";
		$aSave['remark']  = "";
		$aSave['create_date'] = date("Y-m-d H:i:s");
		$aSave['create_by'] = "admin";
		$aSave['update_by'] = "admin";
		
		if ($this->db->replace('table', $aSave)) {
			# code...
		}
	}
}