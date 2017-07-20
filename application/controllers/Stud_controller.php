<?php

/**
 * Created by IntelliJ IDEA.
 * User: Ban Vien
 * Date: 7/19/2017
 * Time: 10:00 AM
 */
class Stud_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->db->where("ParentID IS NULL and Active = 1");
		$query = $this->db->get("category");

		$data['categories'] = $query->result();
		//print_r($data);
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

		$this->load->helper('url');
		$this->load->view('Stud_view', $data);
	}

	public function add_student_view() {
		$this->load->helper('form');
		$this->load->view('Stud_add');
	}

	public function add_student() {
		$this->load->model('Stud_Model');

		$data = array(
			'roll_no' => $this->input->post('roll_no'),
			'name' => $this->input->post('name')
		);

		$this->Stud_Model->insert($data);

		$query = $this->db->get("stud");
		$data['records'] = $query->result();
		$this->load->view('Stud_view',$data);
	}

	public function update_student_view() {
		$this->load->helper('form');
		$roll_no = $this->uri->segment('3');
		$query = $this->db->get_where("stud",array("roll_no"=>$roll_no));
		$data['records'] = $query->result();
		$data['old_roll_no'] = $roll_no;
		$this->load->view('Stud_edit',$data);
	}

	public function update_student(){
		$this->load->model('Stud_Model');

		$data = array(
			'roll_no' => $this->input->post('roll_no'),
			'name' => $this->input->post('name')
		);

		$old_roll_no = $this->input->post('old_roll_no');
		$this->Stud_Model->update($data,$old_roll_no);

		$query = $this->db->get("stud");
		$data['records'] = $query->result();
		$this->load->view('Stud_view',$data);
	}

	public function delete_student() {
		$this->load->model('Stud_Model');
		$roll_no = $this->uri->segment('3');
		$this->Stud_Model->delete($roll_no);

		$query = $this->db->get("stud");
		$data['records'] = $query->result();
		$this->load->view('Stud_view',$data);
	}
}
