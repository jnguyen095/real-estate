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
		$this->db->where("ProductID", $productId);
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
			$query = $this->db->get("Brand");
			$product->Brand = $query->row();
		}

		// Fetch City
		if($product->BrandID != null){
			$this->db->where("CityID", $product->CityID);
			$query = $this->db->get("City");
			$product->City = $query->row();
		}

		// Fetch District
		if($product->DistrictID != null){
			$this->db->where("DistrictID", $product->DistrictID);
			$query = $this->db->get("District");
			$product->District = $query->row();
		}

		// Fetch Ward
		if($product->WardID != null){
			$this->db->where("WardID", $product->WardID);
			$query = $this->db->get("Ward");
			$product->Ward = $query->row();
		}

		// Fetch Street
		if($product->StreetID != null){
			$this->db->where("StreetID", $product->StreetID);
			$query = $this->db->get("Street");
			$product->Street = $query->row();
		}


		return $product;
	}

	public function findByCatId($catId){
		$this->db->where("CategoryID", $catId);
		$query = $this->db->get("product");
		$products = $query->result();
		return $products;
	}
}
