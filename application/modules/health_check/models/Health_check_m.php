<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Health_check_m extends CI_Model 
{
	public function select_all() {
		$sql = "SELECT * FROM health_check
				order by month desc
				";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	
	public function insert($month, $jenis_test, $oil_g1, $solar_g1, $accu_g1, $oil_g2, $solar_g2, $accu_g2, $oil_g3, $solar_g3, $accu_g3, $oil_g4, $solar_g4, $accu_g4, $accu_pkg, $keterangan, $lampiran) {
		$sql = "INSERT INTO health_check(month, jenis_test, oil_g1, solar_g1, accu_g1, oil_g2, solar_g2, accu_g2, oil_g3, solar_g3, accu_g3, oil_g4, solar_g4, accu_g4,accu_pkg, keterangan, lampiran) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->db->query($sql, array($month, $jenis_test, $oil_g1, $solar_g1, $accu_g1, $oil_g2, $solar_g2, $accu_g2, $oil_g3, $solar_g3, $accu_g3, $oil_g4, $solar_g4, $accu_g4, $accu_pkg, $keterangan, $lampiran));
		return $result->result_array();
	}
}