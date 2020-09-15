

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document_m extends CI_Model 
{
   public function select_all() {
		$sql = "SELECT a.*, b.USERNAME  FROM document a 
				left join user b on a.user_input=b.ID
				order by time desc
				";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function insert($name, $description, $path, $kategori='Document') {
		$sql = "INSERT INTO DOCUMENT(NAME, DESCRIPTION, PATH, kategori, time, user_input) VALUES (?, ?, ?, ? ,? ,?)";
		$this->db->query($sql, array($name, $description, $path, $kategori, time(), $this->session->userdata('user_id')));
	}

	public function update($name, $description, $path, $kategori='Document', $id) {
		$sql = "UPDATE document SET NAME = ?, DESCRIPTION = ?, PATH = ? , kategori = ?,  time= ?  WHERE ID = ?";
		$this->db->query($sql, array($name, $description, $path, $kategori,time(), $id));
	}

	public function delete($id){
		$sql = "DELETE FROM document WHERE ID = ?";
		$this->db->query($sql, array($id));
	}

	public function select_by_id($id){
		$sql = "SELECT a.*, b.USERNAME  FROM document a 
				left join user b on a.user_input=b.ID
				WHERE a.ID = ?";
		$result = $this->db->query($sql, array($id));
		return $result->row_array();
	}	

}