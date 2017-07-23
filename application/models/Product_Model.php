<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/20/2017
 * Time: 3:42 PM
 */
class Product_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function findById($productId) {
		$this->db->where(array("ProductID" => $productId, 'Status' => 1));
		$query = $this->db->get("product");
		$product = $query->row();
		return $product;
	}

	public function findByIdFetchAll($productId) {
		$this->db->where("ProductID", $productId);
		$query = $this->db->get("product");
		$product = $query->row();

		// Fetch Brand
		if($product->BrandID != null){
			$this->db->where("BrandID", $product->BrandID);
			$query = $this->db->get("brand");
			$product->Brand = $query->row();
		}

		// Fetch City
		if($product->BrandID != null){
			$this->db->where("CityID", $product->CityID);
			$query = $this->db->get("city");
			$product->City = $query->row();
		}

		// Fetch District
		if($product->DistrictID != null){
			$this->db->where("DistrictID", $product->DistrictID);
			$query = $this->db->get("district");
			$product->District = $query->row();
		}

		// Fetch Ward
		if($product->WardID != null){
			$this->db->where("WardID", $product->WardID);
			$query = $this->db->get("ward");
			$product->Ward = $query->row();
		}

		// Fetch Street
		if($product->StreetID != null){
			$this->db->where("StreetID", $product->StreetID);
			$query = $this->db->get("street");
			$product->Street = $query->row();
		}

		// Product Assets
		$this->db->where("ProductID", $productId);
		$query = $this->db->get("productasset");
		$product->Assets = $query->result();

		return $product;
	}

	public function findByCatId($catId, $start=null, $limit=null){
		$query = $this->db->get_where('product', array('CategoryID' => $catId, "Status" => 1), $limit, $start);
		$products = $query->result();


		$this->db->where('CategoryID', $catId);
		$total = $this->db->count_all_results('product');

		$data['products'] = $products;
		$data['total'] = $total;
		return $data;
	}
}
