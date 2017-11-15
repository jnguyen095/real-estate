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

	public function findByCatIdCityIdHasProduct($catId, $cityId){
		$sql = 'select d.districtid as DistrictID, d.districtname as DistrictName, count(p.productid) as Total from district d';
		$sql .= ' inner join city c on d.cityid = c.cityid';
		$sql .= ' left join product p on p.districtid = d.districtid ';
		$sql .= ' where d.cityid = '.$cityId.' and p.categoryid = '.$catId;
		$sql .= ' group by d.districtid order by d.districtname asc';
		$query = $this->db->query($sql);
		return $query->result();
	}
}
