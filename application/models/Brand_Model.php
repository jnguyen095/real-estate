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

	public function findByIdHasImage($branchId){
		$sql = 'select * from brand where brandid = ' .$branchId;
		$sql .= ' and Thumb is not null';
		$query = $this->db->query($sql);
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
		$sql .= ' where b.Thumb is not null and b.Hot = 1';
		$sql .= ' group by b.BrandID';
		$sql .= ' order by p.ModifiedDate desc';
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

	function findAndFilter($offset=0, $limit, $st = "", $orderField, $orderDirection){

		$query = $this->db->select('b.*, count(p.productid) as TotalProduct')
			->from('brand b')
			->join('product p', 'b.brandID = p.brandID', 'left')
			->like('BrandName', $st)
			->limit($limit, $offset)
			->group_by("p.brandID")
			->order_by($orderField, $orderDirection)
			->get();

		$result['items'] = $query->result();


		$query = $this->db->like('BrandName', $st)->get('brand');
		$result['total'] = $query->num_rows();
		return $result;
	}

	function updateHotForBrand($brandId, $hot){
		$this->db->set('Hot', $hot);
		$this->db->set('ModifiedDate', 'NOW()', false);
		$this->db->where('BrandID', $brandId);
		$this->db->update('brand');
	}

}
