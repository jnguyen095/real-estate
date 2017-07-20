<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/20/2017
 * Time: 3:18 PM
 */
class Category_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function getCategories() {
		$this->db->where("ParentID IS NULL and Active = 1");
		$query = $this->db->get("category");

		$data['categories'] = $query->result();

		$child = [];
		foreach ($data as $key=>$value){
			foreach ($data[$key] as $k=>$v){
				$categoryId = $v->CategoryID;
				if($categoryId != null){
					$this->db->where("ParentID = ". $categoryId);
					$query = $this->db->get("category");
					$child[$categoryId] = $query->result();
				}
			}
		}
		$data['child'] = $child;

		return $data;
	}
}
