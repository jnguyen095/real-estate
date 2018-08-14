<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 13/08/2018
 * Time: 11:15 PM
 */
class Advertise_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('Banner_Model');
		$this->load->library('user_agent');
	}

	public function index($id) {
		$data = [];
		$data['IpAddress'] = $this->input->ip_address();
		if ($this->agent->is_browser())
		{
			$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
			$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
		}
		else
		{
			$agent = 'Unidentified User Agent';
		}

		$data['UserAgent'] = $agent;
		$data['Platform'] = $this->agent->platform();

		$this->Banner_Model->increaseCounterAndUpdateView($id, $data);
		$banner = $this->Banner_Model->findById($id);
		redirect($banner->TargetUrl, "refresh");
	}
}
