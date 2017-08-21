<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/17/2017
 * Time: 1:08 PM
 */
class Street_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function findByName($keyword){
		$this->db->like("StreetName", $keyword);
		$this->db->limit(10);
		$query = $this->db->get("street");
		return $query->result();
	}
}
