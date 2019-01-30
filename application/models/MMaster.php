<?php
class MMaster extends CI_Model {

	public function __construct(){
		parent::__construct();

	}

	public function autocProduct(){

		$keysearch 	= $this->input->get('term');
		$sql 		= "select * from product where name like '%".$keysearch."%' limit 50";
		$query 		= $this->db->query($sql);
		
		$arr = array();
		foreach ($query->result_array() as $key => $value) {

			$bb['label'] = $value['name'];
			$bb['value'] = $value;
			$arr[] = $bb;
		}

		return $arr;
	}
}