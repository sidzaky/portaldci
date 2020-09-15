<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asset_model extends CI_Model 
{
	public function select_all() {
		$sql = "
			SELECT
				A.ID, A.SPECIFICATION, A.GROUP_ID, A.LOCATION_DC, D.nama_dc, BRAND, TYPE, B.NAME AS 'GROUP',C.jenis_nama  as jenis_nama, C.jenis_id, LOCATION, 
				HOSTNAME, IP_ADDRESS, ACTIVE, OPERATING_SYSTEM, SERIAL_NUMBER 
			FROM asset A
			JOIN asset_group B ON(A.GROUP_ID = B.ID)
			LEFT JOIN asset_jenis C ON A.jenis_id=C.jenis_id	
			LEFT JOIN asset_dc D ON A.LOCATION_DC=D.id_asset_dc
			order by A.HOSTNAME asc
			";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function insert(
		$hostname, $brand, $type, $ip_address, $location_dc, $location, $operating_system, $serial_number, $group_id, $active, $photo,
		$buy_price, $buy_date, $expired_maintenance_date, $end_of_sale_date, $end_of_life_date, $cable_type,
		$cable_x_coordinate, $cable_y_coordinate, $ha_mode, $asset_function, $specification, $user_id, $port,
		$end_of_support_date,$jenis_id ) {

		$sql = "
			INSERT INTO ASSET (
				HOSTNAME, BRAND, TYPE, IP_ADDRESS, LOCATION_DC, LOCATION, OPERATING_SYSTEM, SERIAL_NUMBER, GROUP_ID, ACTIVE, PHOTO,
				BUY_PRICE, BUY_DATE, EXPIRED_MAINTENANCE_DATE, END_OF_SALE_DATE, END_OF_LIFE_DATE, CABLE_TYPE,
				CABLE_X_COORDINATE, CABLE_Y_COORDINATE, HA_MODE, ASSET_FUNCTION, SPECIFICATION, USER_ID, PORT,
				END_OF_SUPPORT_DATE,JENIS_ID
			) VALUES (
				?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?, ?, ?, ?
			)";
		$this->db->query($sql, array(
			$hostname, $brand, $type, $ip_address, $location_dc, $location, $operating_system, $serial_number, $group_id, $active, $photo,
			$buy_price, $buy_date, $expired_maintenance_date, $end_of_sale_date, $end_of_life_date, $cable_type,
			$cable_x_coordinate, $cable_y_coordinate, $ha_mode, $asset_function, $specification, $this->session->userdata('user_id'), $port,
			$end_of_support_date, $jenis_id
		));

		return $this->db->insert_id();
	}

	public function update(
		$hostname, $brand, $type, $ip_address, $location_dc, $location, $operating_system, $serial_number, $group_id, $jenis_id, $active, $photo,
		$buy_price, $buy_date, $expired_maintenance_date, $end_of_sale_date, $end_of_life_date, $cable_type,
		$cable_x_coordinate, $cable_y_coordinate, $ha_mode, $asset_function, $specification, $last_update_user_id, $port,
		$end_of_support_date, $id) {

		$sql = "
			UPDATE ASSET SET
				HOSTNAME = ?, BRAND = ?, TYPE = ?, IP_ADDRESS = ?, LOCATION_DC= ?, LOCATION = ?, OPERATING_SYSTEM = ?, SERIAL_NUMBER = ?,
				GROUP_ID = ?,jenis_id=? , ACTIVE = ?, PHOTO = ?, BUY_PRICE = ?, BUY_DATE = ?, EXPIRED_MAINTENANCE_DATE = ?,
				END_OF_SALE_DATE = ?, END_OF_LIFE_DATE = ?, CABLE_TYPE = ?, CABLE_X_COORDINATE = ?, CABLE_Y_COORDINATE = ?,
				HA_MODE = ?, ASSET_FUNCTION = ?, SPECIFICATION = ?, LAST_UPDATE = NOW(), LAST_UPDATE_USER_ID = ?, PORT = ?,
				END_OF_SUPPORT_DATE = ?
			WHERE ID = ? ";

		$this->db->query($sql, array(
			$hostname, $brand, $type, $ip_address, $location_dc, $location, $operating_system, $serial_number,
			$group_id, $jenis_id, $active, $photo, $buy_price, $buy_date, $expired_maintenance_date,
			$end_of_sale_date, $end_of_life_date, $cable_type, $cable_x_coordinate, $cable_y_coordinate,
			$ha_mode, $asset_function, $specification, $last_update_user_id, $port, $end_of_support_date,
			$id
		));
	}

	public function delete($id){
		$sql = "DELETE FROM ASSET WHERE ID = ?";
		$this->db->query($sql, array($id));
	}

	public function insert_port($asset_id, $port, $ip_address){
		$sql = "INSERT INTO ASSET_PORT(ASSET_ID, PORT, IP_ADDRESS) VALUES (?, ?, ?)";
		$this->db->query($sql, array($asset_id, $port, $ip_address));
	}

	public function delete_port_by_asset_id($asset_id){
		$sql = "DELETE FROM ASSET_PORT WHERE ASSET_ID = ?";
		$this->db->query($sql, array($asset_id));
	}

	public function insert_document($asset_id, $tmp_name, $tmp_description, $path){
		$sql = "INSERT INTO ASSET_DOCUMENT(ASSET_ID, NAME, DESCRIPTION, PATH) VALUES (?, ?, ?, ?)";
		$this->db->query($sql, array($asset_id, $tmp_name, $tmp_description, $path));
	}

	public function delete_document_by_asset_id($asset_id){
		$sql = "DELETE FROM ASSET_DOCUMENT WHERE ASSET_ID = ?";
		$this->db->query($sql, array($asset_id));
	}

	public function select_by_id($id){
		$sql = "
			SELECT
				A.ID, D.nama_dc, BRAND, TYPE, A.JENIS_ID,  B.ID GROUP_ID,  B.NAME GROUP_NAME , BUY_DATE,   EXPIRED_MAINTENANCE_DATE, PHOTO, LOCATION,
				BUY_PRICE, CABLE_X_COORDINATE, CABLE_Y_COORDINATE, CABLE_TYPE, SERIAL_NUMBER, HA_MODE, SPECIFICATION,
				ASSET_FUNCTION, ACTIVE, HOSTNAME, END_OF_LIFE_DATE, END_OF_SALE_DATE, IP_ADDRESS, OPERATING_SYSTEM, PORT,
				END_OF_SUPPORT_DATE
			FROM asset A
			JOIN asset_group B ON(A.GROUP_ID = B.ID)
			LEFT JOIN asset_dc D ON A.LOCATION_DC=D.id_asset_dc
			WHERE A.ID = ? ";
		$result = $this->db->query($sql, array($id));
		return $result->row_array();
	}

	public function select_port_by_asset_id($asset_id){
		$sql = "SELECT ID, PORT, IP_ADDRESS FROM asset WHERE ID = ?";
		$result = $this->db->query($sql, array($asset_id));
		return $result->result_array();
	}

	public function select_document_by_asset_id($asset_id){
		$sql = "SELECT ID, ASSET_ID, NAME, PATH, DESCRIPTION FROM asset_document WHERE ASSET_ID = ?";
		$result = $this->db->query($sql, array($asset_id));
		return $result->result_array();
	}
	
	
	public function get_dc_location(){
		$sql= "select * from asset_dc";
		return $this->db->query($sql)->result_array();
	}
}


/* End of file user_m.php */
/* Location: ./application/models/user_m.php */