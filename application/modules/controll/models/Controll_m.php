<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controll_m extends CI_Model 
{

	
	function getuserlist_m($id){
		$sql="select * from user where ACTIVE='Y' ";
		if ($_POST['ID']!='' || $id!='') $sql.= " and ID='".$_POST['ID'].$id."'";
		
		return $this->db->query($sql)->result_array();
	}
	
	function getmoduleaccess_m($id){
		$sql="select * from module_permission";
		if ($_POST['id_user']!='' || $id!='') 	$sql.= " where id_user='".$_POST['id_user'].$id."'";
		$sql .=" order by module asc"; 
		return $this->db->query($sql)->result_array();
	}
		
	function getuserdc_m($id){
		$sql="select * from user_dc a left join asset_dc b on a.id_asset_dc=b.id_asset_dc ";
		if ($_POST['id_user']!='' || $id!='') 	$sql.= " where a.id_user='".$_POST['id_user'].$id."'";
		return $this->db->query($sql)->result_array();
	}
	
	function delmoduleaccess_m(){
		$datauser=$this->getmoduleaccess_m();
		$sql="delete from module_permission where id_user='".$_POST['id_user']."' and module='".$_POST['module']."'";
		return $this->db->query($sql);
	}	
	
	function input_user_m(){
		$_POST['PASSWORD']=MD5($_POST['PASSWORD']);
		return $this->db->insert('user',$_POST);
		
		
	}
	function addmoduleaccess_m(){
		return $this->db->insert(module_permission,$_POST);
	}
	
	
	function addmoduledc_m(){
		return $this->db->insert('user_dc',$_POST);	
	}
	
	function getmoduleportal_m(){
			$sql="select * from module_portal";
			return $this->db->query($sql)->result_array();
	}
	
	function getmoduledc_m(){
			$sql="select * from asset_dc ";
			return $this->db->query($sql)->result_array();
	}
	
}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */