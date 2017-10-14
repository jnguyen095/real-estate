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
		$sql = 'select c.CityID, c.CityName from city c left join product p on c.cityid = p.cityid';
		$sql .= ' group by c.cityid';
		$sql .= ' order by count(p.productid) desc';
		$sql .= ' limit '. $top;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function findByTopProductOfCategoryGroupByCity(){
		$sql = 'select p.CityID, ct.CityName, p.CategoryID, c.CatName';
		$sql .= ' from product p';
		$sql .= ' inner join category c on p.categoryid = c.categoryid';
		$sql .= ' inner join city ct on ct.cityid = p.cityid';
		$sql .= ' where ct.Hot = '.ACTIVE;
		$sql .= ' group by p.cityid, p.categoryid';
		$sql .= ' order by count(p.productid) desc, c.CatName asc';
		$query = $this->db->query($sql);
		$items = $query->result();

		$result = array();
		foreach ($items as $value){
			if (!array_key_exists($value->CityID, $result)) {
				$result[$value->CityID] = array('CityName' => $value->CityName, 'child' => array());
			}
			array_push($result[$value->CityID]['child'], $value);
		}
		return $result;
	}

	public function findCityByCategoryId($categoryId){
		$sql = "select p.CityID, ct.CityName, count(p.productid) as Total";
		$sql .= " from product p";
		$sql .= " inner join category c on p.categoryid = c.categoryid";
		$sql .= " inner join city ct on ct.cityid = p.cityid";
		$sql .= " where c.categoryid = {$categoryId}";
		$sql .= " group by p.cityid, p.categoryid";
		$sql .= " order by count(p.productid) desc, c.CatName asc";
		$query = $this->db->query($sql);
		$items = $query->result();
		return $items;
	}
}
