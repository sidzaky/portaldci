<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_m extends CI_Model 
{
	public function select_all() {
		$sql = "SELECT * FROM inventory
				order by tgl_masuk desc
				";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	
	public function insert($jenis, $tipe, $sn, $tgl_masuk, $pemilik, $koordinat, $no_unit, $lampiran) {
		$sql = "INSERT INTO INVENTORY(jenis, tipe, sn, tgl_masuk, pemilik, koordinat, no_unit, lampiran) VALUES (?, ?, ?, ? ,? ,?, ?, ?)";
		$this->db->query($sql, array($jenis, $tipe, $sn, $tgl_masuk, $pemilik, $koordinat, $no_unit, $lampiran));
	}
	
	public function update($jenis, $tipe, $sn, $tgl_masuk, $pemilik, $koordinat, $no_unit, $lampiran, $id) {
		$sql = "UPDATE inventory SET jenis = ?, tipe = ?, sn = ? , tgl_masuk = ?,  pemilik = ?, koordinat = ?, no_unit = ?, lampiran = ?  WHERE id = ?";
		$this->db->query($sql, array($jenis, $tipe, $sn, $tgl_masuk, $pemilik, $koordinat, $no_unit, $lampiran, $id));
	}
	
	public function select_by_id($id){
		$sql = "SELECT * FROM inventory 
				WHERE id = ?";
		$result = $this->db->query($sql, array($id));
		return $result->row_array();
	}
	
	public function delete($id){
		$sql = "DELETE FROM inventory WHERE ID = ?";
		$this->db->query($sql, array($id));
	}
}