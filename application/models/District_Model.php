<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/17/2017
 * Time: 10:47 AM
 */
class District_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function findByCityId($cityId){
		$this->db->where("CityID", $cityId);
		$this->db->order_by("DistrictName","asc");
		$query = $this->db->get("district");
		return $query->result();
	}

	public function findById($districtId){
		$this->db->where("DistrictID", $districtId);
		$query = $this->db->get("district");
		return $query->row();
	}
}
