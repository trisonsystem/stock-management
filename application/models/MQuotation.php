<?php
class MQuotation extends CI_Model {

	public function __construct(){
		parent::__construct();

	}

	public function save_data( $aData ){
		$pd = "";
		foreach ($aData as $k => $v) {
			$pd .= ",".$k."=".$v;
		}

		$aSave  = array();
		$aSave['product'] = substr($pd, 1);
		$aSave['status']  = "1";
		$aSave['remark']  = "";
		$aSave['create_date'] = date("Y-m-d H:i:s");
		$aSave['create_by'] = "admin";
		$aSave['update_date'] = date("Y-m-d H:i:s");
		$aSave['update_by'] = "admin";

		
		$aReturn = array();
		if ($this->db->replace('quotation', $aSave)) {
			$aReturn["flag"] = true;
			$aReturn["msg"] = "success";
		}else{
			$aReturn["flag"] = false;
			$aReturn["msg"] = "Error SQL !!!";
		}

		return $aReturn;
	}
}