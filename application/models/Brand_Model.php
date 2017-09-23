<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/22/2017
 * Time: 2:50 PM
 */
class Brand_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function findAll(){
		$query = $this->db->query("select * from brand order by BrandName ASC");
		return $query->result();
	}

	public function findById($branchId){
		$this->db->where("BrandID", $branchId);
		$query = $this->db->get("brand");
		return $query->row();
	}

	public function findTopBranchHasProduct($top){
		$sql = 'select b.BrandID, b.BrandName from brand b left join product p on b.brandid = p.brandid';
		$sql .= ' group by b.BrandID';
		$sql .= ' order by count(p.productid) desc';
		$sql .= ' limit '. $top;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function findTopBranchHasProductAndData($top){
		$sql = 'select b.BrandID, b.BrandName, b.Thumb, b.Description from brand b left join product p on b.brandid = p.brandid';
		$sql .= ' where b.Thumb is not null';
		$sql .= ' group by b.BrandID';
		$sql .= ' order by count(p.productid) desc';
		$sql .= ' limit '. $top;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function findHotBranch($top){
		$this->db->where("Hot", ACTIVE);
		$this->db->limit($top);
		$query = $this->db->get("brand");
		return $query->result();
	}

}
