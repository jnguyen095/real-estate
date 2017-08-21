<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/27/2017
 * Time: 11:22 PM
 */
class City_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function getAllActive(){
		$this->db->where("Status", ACTIVE);
		$this->db->order_by("CityName","asc");
		$query = $this->db->get("city");
		return $query->result();
	}
}
