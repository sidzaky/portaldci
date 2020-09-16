<?php

/**
 * @author dzaky hidayat
 * @copyright 2017
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_m extends CI_Model 
{
	
	 function login($email, $password)
    {		
			$sql="select * from user where USERNAME='".$email."' and ACTIVE='Y' AND PASSWORD='".$password."'";
			$query = $this->db->query($sql);
			if($query->num_rows()==1){
				
				return $query->result();
				}
			else{ 
				return null; }
	}
         
	
	function getnotification(){
		$sql="select * from user_notif where id_user='".$this->session->userdata('user_id')."'";
		return $this->db->query($sql)->result_array();
		
	}
	
	public function getallpermissionForspeciallogin(){
		$sql="select id_module from module_portal";
		return $this->db->query($sql)->result_array();
	}
	public function getdcpermission($id){
		$sql="select * from user_dc a left join asset_dc b on a.id_asset_dc=b.id_asset_dc where a.id_user='".$id."'";
		return $this->db->query($sql)->result_array();
		
	}
	
	public function getallpermission($id){
		$sql="select module, access from module_permission where id_user='".$id."'";
		return $this->db->query($sql)->result_array();
		
	}
	
	public function updateuser_m(){
		$sql="update user set ";
		$length=sizeof($_POST);
		$i=2;
		foreach ($_POST as $key => $value){
			if ($value!='' && $key!='id'){
				$sql .= ($i!=$length && $i!=2 ? " , " : "" ).$key ."='" .($key=='PASSWORD' ? MD5($value) : $value) ."'";
				$i++;  
			}
		}
		$sql .= " where ID='".$this->session->userdata('user_id')."'";
		$this->db->query($sql);
		
		$this->activity_m->writelog('profile',"update profile where ".$this->session->userdata('nama_user')." to ".$_POST['USERNAME']);
		return true;
	}
	
	public function disuser_m(){
		$sql="update user set ACTIVE='N' where ID='".$_POST['ID']."'";
		$this->db->query($sql);
		$this->activity_m->writelog('profile',"Disable user dengan ID=".$_POST['ID']." oleh ".$this->session->userdata('nama_user')."(".$this->session->userdata('user_id').")");
	}
	
	public function checkpmslan_m(){
		$sql="select * from pms_lan
						where 	nomor_surat_masuk like '%".$_POST['data']."%' or 
								keterangan_surat_masuk like '%".$_POST['data']."%' or
								unit_kerja like '%".$_POST['data']."%' or
								nomor_SIK like '%".$_POST['data']."%' 
							
						order by tanggal_surat_masuk desc
						limit 3
					";
		return $this->db->query($sql)->result_array();
	}
	
    //protected $collection_name = 'user';

}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */