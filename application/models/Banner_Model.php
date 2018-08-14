<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 12/08/2018
 * Time: 4:01 PM
 */
class Banner_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	function addOrUpdateBanner($data)
	{
		$dateOne = DateTime::createFromFormat("d/m/Y", $data['from_date']);
		$dateTwo = DateTime::createFromFormat("d/m/Y", $data['to_date']);
		$id = $data['BannerID'];
		if($id == null){
			// Create new
			$newdata = array(
				'Code' => $data['txt_code'],
				'TargetUrl' => $data['txt_target'],
				'Status' => $data['ch_status'],
				'Priority' => $data['txt_priority'],
				'Click' => 0,
				'FromDate' => $dateOne->format('Y-m-d'),
				'ToDate' => $dateTwo->format('Y-m-d'),
				'Image' => $data['txt_image']
			);
			$this->db->insert('banner', $newdata);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}else{
			// Update
			$updateData = array(
				'Code' => $data['txt_code'],
				'TargetUrl' => $data['txt_target'],
				'Status' => $data['ch_status'],
				'Priority' => $data['txt_priority'],
				'FromDate' => $dateOne->format('Y-m-d'),
				'ToDate' => $dateTwo->format('Y-m-d'),
				'Image' => $data['txt_image']
			);
			$this->db->where('BannerID', $data['BannerID']);
			$this->db->update('banner', $updateData);
			return $data['BannerID'];
		}

	}

	function findAndFilter($offset=0, $limit, $st = "", $orderField, $orderDirection){
		//$this->output->enable_profiler(TRUE);
		$query = $this->db->select('bn.*')
			->from('banner bn')
			//->like('Code', $st)
			->limit($limit, $offset)
			->order_by($orderField, $orderDirection)
			->get();

		$result['items'] = $query->result();

		$query = $this->db->get('banner');
		$result['total'] = $query->num_rows();

		return $result;
	}

	public function findById($bannerId) {
		$this->db->where(array("BannerID" => $bannerId));
		$query = $this->db->get("banner");
		$banner = $query->row();
		return $banner;
	}

	function loadByCode($code){
		//$this->output->enable_profiler(TRUE);
		$query = $this->db->select('bn.BannerID, bn.Image, bn.TargetUrl')
			->from('banner bn')
			->where('Code', $code)
			->where('Status', ACTIVE)
			->limit(1)
			->order_by("Priority", "ASC")
			->get();
		return $query->row();
	}

	function increaseCounterAndUpdateView($id, $data){
		$this->db->set('Click', 'Click + 1', false);
		$this->db->where('BannerID', $id);
		$this->db->update('banner');

		$newdata = array(
			'BannerID' => $id,
			'IpAddress' => $data['IpAddress'],
			'UserAgent' => $data['UserAgent'],
			'Platform' => $data['Platform'],
			'HitTime' => date('Y-m-d H:i:s')
		);
		$this->db->insert('bannerdetail', $newdata);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function findModelDetail($bannerId, $page, $per_page){
		//$this->output->enable_profiler(TRUE);
		$data = [];
		$this->db->where("BannerID", $bannerId);
		$this->db->order_by("HitTime", "DESC");
		$this->db->limit($per_page, $page);
		$query = $this->db->get("bannerdetail");
		$data['details'] = $query->result();

		$this->db->where(array("BannerID" => $bannerId));
		$total = $this->db->count_all_results('bannerdetail');
		$data['total'] = $total;

		return $data;
	}
}
