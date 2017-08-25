<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/25/2017
 * Time: 11:22 PM
 */
class ProductDetail_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function findByProductId($productId) {
		$this->db->where(array("ProductID" => $productId));
		$query = $this->db->get("productdetail");
		$product = $query->row();
		return $product;
	}
}
