<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/30/2017
 * Time: 5:45 PM
 */
class Cooperate_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function findTopLatest($limit){
		$query = $this->db->order_by('ModifiedDate', 'desc')->get_where('cooperate', array("Status" => ACTIVE), $limit, 0);
		$news = $query->result();
		return $news;
	}

	public function findById($postId){
		$this->db->where(array("CooperateID" => $postId));
		$query = $this->db->get("cooperate");
		$product = $query->row();
		if($product != null) {
			// Fetch City
			if ($product->CityID != null) {
				$this->db->where("CityID", $product->CityID);
				$query = $this->db->get("city");
				$product->City = $query->row();
			}

			// Fetch District
			if ($product->DistrictID != null) {
				$this->db->where("DistrictID", $product->DistrictID);
				$query = $this->db->get("district");
				$product->District = $query->row();
			}

			// Fetch Ward
			if ($product->WardID != null) {
				$this->db->where("WardID", $product->WardID);
				$query = $this->db->get("ward");
				$product->Ward = $query->row();
			}

			// Fetch Ward
			if ($product->UnitID != null) {
				$this->db->where("UnitID", $product->UnitID);
				$query = $this->db->get("unit");
				$product->Unit = $query->row();
			}
		}
		return $product;
	}

	public function updateViewForCooperate($id){
		$this->db->set('View', 'View + 1', false);
		$this->db->where('CooperateID', $id);
		$this->db->update('cooperate');
	}

	public function searchByProperties($start, $limit=null){
		$sql = 'select p.*, c.cityname as city, d.districtname as district from cooperate p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.Status = '.ACTIVE;
		$sql .= ' order by date(p.ModifiedDate) desc';
		$sql .= ' limit '.$start.','.$limit;


		$query = $this->db->query($sql);
		$cooperates = $query->result();

		$this->db->where('Status', ACTIVE);
		$total = $this->db->count_all_results('cooperate');

		$data['cooperates'] = $cooperates;
		$data['total'] = $total;
		return $data;
	}

	public function saveNewPost($data){
		// Get Unit
		$this->db->where("UnitID", $data['unit']);
		$query = $this->db->get("unit");
		$unit = $query->row();

		$newdata = array(
			'Title' => $data['title'],
			'Brief' => strip_tags(substr($data['description'], 0, 400).'...'),
			'Price' => $data['price'],
			'PriceString' => ($data['price'] != null && $data['price'] > 0) ? $data['price'].' '.$unit->Title : "Thỏa thuận",
			'Area' => ($data['area'] != null && $data['area'] > 0) ? $data['area'].' m²' : "KXĐ",
			'Thumb' => $data['image'],
			'PostDate' => date('Y-m-d H:i:s'),
			'ModifiedDate' => date('Y-m-d H:i:s'),
			'ExpireDate' => date('Y-m-d', strtotime('+1 month')),
			'CityID' => $data['city'],
			'DistrictID' => $data['district'],
			'Street' => $data['street'],
			'Status' => ACTIVE,
			'View' => 0,
			'CreatedByID' => $data['CreatedByID'],
			'UnitID' => $data['unit'],
			'Address' => $data['address'],
			'IpAddress' => $data['ipaddress'],
			'ContactPhone' => $data['contact_phone'],
			'ContactAddress' => $data['contact_address'],
			'ContactEmail' => $data['txt_email'],
			'ContactName' => $data['contact_name'],
			'Detail' => $data['description']
		);

		if($data['ward'] != null && $data['ward'] > 0){
			$newdata['WardID'] = $data['ward'];
		}

		$this->db->insert('cooperate', $newdata);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
}
