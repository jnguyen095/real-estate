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

	public function findById($cityId){
		$this->db->where("CityID", $cityId);
		$query = $this->db->get("city");
		return $query->row();
	}

	public function findTopCityHasProduct($top){
		$sql = 'select c.CityID, c.CityName, count(p.productid) as TotalProduct from city c left join product p on c.cityid = p.cityid';
		$sql .= ' group by c.cityid';
		$sql .= ' order by TotalProduct desc';
		$sql .= ' limit '. $top;
		$query = $this->db->query($sql);
		return $query->result();
	}
}
