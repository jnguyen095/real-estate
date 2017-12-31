<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 12/28/2017
 * Time: 11:07 AM
 */
class Sitemap_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function deleteByProductId($productId){
		$this->db->delete('sitemap', array('ProductID' => $productId));
	}

	public function findProductNotIndexYet($lookbackDays){
		// $this->output->enable_profiler(TRUE);
		$previousDays = date('Y-m-d', strtotime("-{$lookbackDays} days"));
		$sql = "select p.* from product p where p.productid not in(select distinct(sm.productid) from sitemap sm) and date(p.postdate) >= '{$previousDays}'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function save($data){
		$this->db->insert('sitemap', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function findBySitemapIndexId($sitemapIndexId, $offset=0, $limit){
		$query = $this->db->select('s.*, p.Title as Title, p.View as View')
			->from('sitemap s')
			->join('product p', 's.ProductID = p.ProductID', 'inner')
			->where('SitemapIndexID', $sitemapIndexId)
			->limit($limit, $offset)
			->order_by("LastModified", "DESC")
			->get();

		$result['items'] = $query->result();

		$query = $this->db->where('SitemapIndexID', $sitemapIndexId)->get('sitemap');
		$result['total'] = $query->num_rows();
		return $result;
	}

	public function findAllBySitemapIndexId($sitemapIndexId){
		$query = $this->db->select('s.*, p.Title as Title')
			->from('sitemap s')
			->join('product p', 's.ProductID = p.ProductID', 'inner')
			->where('SitemapIndexID', $sitemapIndexId)
			->get();
		return $query->result();
	}


}
