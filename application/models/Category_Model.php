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
		$this->db->where("ParentID IS NULL and Active = 1 and Menu = ". CATEGORY_MENU);
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

	public function findById($catId){
		$this->db->where("CategoryID = " . $catId);
		$query = $this->db->get("category");

		$data = $query->row();
		if(isset($data->ParentID)){
			$this->db->where("CategoryID = " . $data->ParentID);
			$query = $this->db->get("category");

			$data->Parent = $query->row();
		}
		return $data;
	}

	public function findByNotChildId($catId){
		$this->db->where("CategoryID = " . $catId);
		$query = $this->db->get("category");
		$data = $query->row();
		return $data;
	}


	public function findByParentId($parentId=null, $currentId=null){
		//$this->output->enable_profiler(TRUE);
		if($parentId != null){
			$sql = 'select c.*, (select count(*) from product p where p.categoryid = c.categoryid) as total from category c where c.ParentID = '. $parentId;
			if($currentId != null){
				$sql .= ' and c.CategoryID != '. $currentId;
			}
			$query = $this->db->query($sql);
			return $query->result();
		}else if($currentId != null){
			$sql = 'select c.*, (select count(*) from product p where p.categoryid = c.categoryid) as total from category c where c.ParentID = '. $currentId;
			$query = $this->db->query($sql);
			return $query->result();
		}
	}

}
