<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/31/2017
 * Time: 5:48 PM
 */
class Transfer_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function addNewRow($data){
		$this->output->enable_profiler(TRUE);
		$newdata = array(
			'UserID' => $data['UserID'],
			'Money' => $data['Money'],
			'Type' => $data['Type'],
			'Reason' => $data['Reason'],
			'TransferTime' => date('Y-m-d H:i:s'),
			'ActorID' => $data['ActorID'],
			'Status' => $data['Status']
		);
		if(isset($data['ProductID']) && $data['ProductID'] > 0){
			$newdata['ProductID'] = $data['ProductID'];
		}
		$this->db->insert('purchasehistory', $newdata);
		$insert_id = $this->db->insert_id();

		//update table User
		$dataChanged = false;
		if($data['Type'] == PAYMENT_DEPOSIT && $data['Status'] == ACTIVE){
			$this->db->set('AvailableMoney', 'AvailableMoney + '.$data['Money'], false);
			$this->db->set('DepositedMoney', 'DepositedMoney + '.$data['Money'], false);
			$dataChanged = true;
		}else if($data['Type'] == PAYMENT_WITHDRAW && $data['Status'] == ACTIVE){
			$this->db->set('AvailableMoney', 'AvailableMoney - '.$data['Money'], false);
			$this->db->set('SpentMoney', 'SpentMoney - '.$data['Money'], false);
			$dataChanged = true;
		}
		if($dataChanged){
			$this->db->set("UpdatedDate", date('Y-m-d H:i:s'));
			$this->db->where('Us3rID', $data['UserID']);
			$this->db->update('us3r');
		}
	}

	public function findByUserId($userId) {
		$sql = "select pc.*, us.FullName from purchasehistory pc inner join us3r us on pc.ActorID = us.Us3rID where pc.UserID = {$userId} order by pc.TransferTime desc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function findById($id){
		$this->db->where(array("PurchaseHistoryID" => $id));
		$query = $this->db->get("purchasehistory");
		$product = $query->row();
		return $product;
	}

	public function changeStatusProcess($processId, $status){
		$this->db->set('Status', $status);
		$this->db->where('PurchaseHistoryID', $processId);
		return $this->db->update('purchasehistory');
	}

	public function updateMeny4User($userId, $processType, $money){
		if($processType == PAYMENT_DEPOSIT){
			$this->db->set('AvailableMoney', 'AvailableMoney + '.$money, false);
			$this->db->set('DepositedMoney', 'DepositedMoney + '.$money, false);
		}else if($processType == PAYMENT_WITHDRAW){
			$this->db->set('AvailableMoney', 'AvailableMoney - '.$money, false);
			$this->db->set('SpentMoney', 'SpentMoney - '.$money, false);
		}
		$this->db->set("UpdatedDate", date('Y-m-d H:i:s'));
		$this->db->where('Us3rID', $userId);
		$this->db->update('us3r');
	}

	public function deleteById($purchaseID){
		// Update In User table
		$this->db->where(array("PurchaseHistoryID" => $purchaseID));
		$query = $this->db->get("purchasehistory");
		$deleteRow = $query->row();

		if($deleteRow->Type == 1){
			$this->db->set('AvailableMoney', 'AvailableMoney - '.$deleteRow->Money, false);
			$this->db->set('DepositedMoney', 'DepositedMoney - '.$deleteRow->Money, false);
		}else if($deleteRow->Type == -1){
			$this->db->set('AvailableMoney', 'AvailableMoney + '.$deleteRow->Money, false);
			$this->db->set('DepositedMoney', 'SpentMoney + '.$deleteRow->Money, false);
		}
		$this->db->set("UpdatedDate", date('Y-m-d H:i:s'));
		$this->db->where('Us3rID', $deleteRow->UserID);
		$this->db->update('us3r');

		$this->db->delete('purchasehistory', array('PurchaseHistoryID' => $purchaseID));
	}
}
