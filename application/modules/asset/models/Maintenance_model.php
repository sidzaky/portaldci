<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance_model extends CI_Model {
	public function select_all() {
		$sql = "
			SELECT A.ID, ASSET_ID, HOSTNAME, IP_ADDRESS, EVENT_DATE, DESCRIPTION, DOCUMENT_PATH FROM asset_maintenance A left JOIN ASSET B ON A.ASSET_ID = B.ID ";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function insert($asset_id, $event_date, $description, $document_path, $user_id){
		$sql = "
			INSERT INTO asset_maintenance(ASSET_ID, EVENT_DATE, DESCRIPTION, DOCUMENT_PATH, USER_ID) VALUES (?, ?, ?, ?, ?)";
		$this->db->query($sql, array($asset_id, $event_date, $description, $document_path, $user_id));
	}

	public function update($asset_id, $event_date, $description, $document_path, $id){
		$sql = "
			UPDATE asset_maintenance SET 
				ASSET_ID = ?,  EVENT_DATE = ?,  DESCRIPTION = ?, DOCUMENT_PATH = ?
			WHERE ID = ?";
		$this->db->query($sql, array(
			$asset_id, $event_date, $description, $document_path, 
			$id));
	}

	public function delete($id){
		$sql = "DELETE FROM asset_maintenance WHERE ID = ?";
		$this->db->query($sql, array($id));
	}

	public function select_by_asset_id($asset_id){
		$sql = "SELECT ID, ASSET_ID, EVENT_DATE, DESCRIPTION FROM asset_maintenance WHERE ASSET_ID = ?";
		$result = $this->db->query($sql, array($asset_id));
		return $result->result_array();
	}

	public function select_by_id($id){
		$sql = "SELECT ID, ASSET_ID, EVENT_DATE, DESCRIPTION, DOCUMENT_PATH FROM asset_maintenance WHERE ID = ?";
		$result = $this->db->query($sql, array($id));
		return $result->row_array();
	}
	
	
	public function input_maintenance_asset_report_m(){
		$sql="select b.jenis_nama from asset a 
				left join  asset_jenis b on a.jenis_id=b.jenis_id
				where a.ID='".$_POST['asset_id']."'
				";
		$data=$this->db->query($sql)->result();
		$_POST['time']=time();
		//print_r ($this->session->all_userdata());
		$_POST['user_id']=$this->session->userdata('user')['id'];
		$this->db->insert('maintenance_report_asset_'.$data[0]->jenis_nama, $_POST);
	}

	public function getups(){
		$sql='select * from maintenance_report_asset_ups';
		return $this->db->query($sql)->result();	
	}
}
?>