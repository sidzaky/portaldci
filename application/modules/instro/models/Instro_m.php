<?php

/**
 * @author si.dzaky
 * @copyright 2018
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instro_m extends CI_Model 
{
		
	public function select_all(){
		
		$sql="SELECT a.* from instro_log a
			  ";
		$sql .=" where a.active=''";
		if ($_POST['id_instro']!=null) $sql.= " and a.id_instro='".$_POST['id_instro']."'" ;
		
		$sql .= " order by a.time_input desc" ;
		return $this->db->query($sql)->result_array(); 	
	}
	
	public function input_instro_m(){
		$message="update Insident Trouble";
		if ($_POST['id_instro']==null){
			$_POST['id_instro']=substr($this->uuid->v4(),(rand(2, 5)*(-1)))."i".substr($this->uuid->v4(),(rand(4, 5)*(-1)));
			$message="insert new Insident Trouble";
		}
		else $_POST['time_update']=time();
		$_POST['user_input']=$this->session->userdata('user_id');
		$_POST['time_start_instro']=strtotime($_POST['time_start_instro']);
		if ($_POST['time_solve_instro']!= null)  $_POST['time_solve_instro']=strtotime($_POST['time_solve_instro']);
		$this->db->insert('instro_log', $_POST);
		
		$message .=" with id Insident Trouble = ".$_POST['id_instro'];
		$this->activity_m->writelog('Instro',$message);
	}
	
	public function update_instro_m($i){
		$sql="delete from instro_log where id_instro='".$_POST['id_instro']."'";
		$this->db->query($sql);
		if ($i!="justdel"){
			$this->input_instro_m();
		}
	}
	
	public function disable_instro_log_m(){
		$sql="update instro_log set active='N' where id_instro='".$_POST['id_instro']."'";
		$this->db->query($sql);
		$message =" delete insident trouble with id Insident Trouble = ".$_POST['id_instro'];
		$this->activity_m->writelog('Instro',$message);
	}
	
	public function get_document_m($id){
		$sql="select * from file_instro_log where id_instro_log='".$id."' and active!='N'" ;
		return $this->db->query($sql)->result();
	}
	public function get_instroasset_m($id){
		$sql="select a.*,b.HOSTNAME from instro_log_asset a 
			 left join asset b on a.id_asset=b.ID
			 where a.id_instro_log='".$id."'";
		return $this->db->query($sql)->result();
	}
	
	public function instroaddasset_m(){
		$_POST['id_instro_log_asset']=substr($this->uuid->v4(),(rand(1, 3)*(-1)))."Inas".substr($this->uuid->v4(),(rand(2, 4)*(-1)));
		$this->db->insert('instro_log_asset', $_POST);
		
	}
	
	
	public function deleteassetlog_m(){
		$sql="delete from instro_log_asset where id_instro_log_asset='".$_POST['id_instro_log_asset']."'";
		return $this->db->query($sql);
		$message =" delete asset on insident trouble with id_instro_log_asset = ".$_POST['id_instro_log_asset'];
		$this->activity_m->writelog('Instro',$message);
	}
	
	
	public function upload_document_instro_m($data){
		$id_document=substr($this->uuid->v4(),(rand(1, 3)*(-1)))."fi".substr($this->uuid->v4(),(rand(2, 4)*(-1)));
		$sql="insert into file_instro_log values ('".$id_document."',
												  '".$data['id_instro']."',
												  '".$data['document']['url']."',
												  '".$data['document']['name']."',
												  'Y'
												  )";
		$this->db->query($sql);
	}
	
	
	
	public function disable_document_instro_m(){
		
		$sql="update file_instro_log set active='N' where id_file_instro_log='".$_POST['id_file_instro_log']."'";
		// echo $sql;
		$this->db->query($sql);
	}
	
	
	public function report_by_asset($pending=false){
		$sql=" select a.HOSTNAME as label, count(a.ID) as data , c.time_start_instro, c.time_solve_instro from asset a
				inner join instro_log_asset b on a.ID=b.id_asset
				inner join instro_log c on c.id_instro=b.id_instro_log
				where c.time_input between '".strtotime($_POST['date1'])."' and  '".(strtotime($_POST['date2']))."' ";
		if ($pending==true) $sql .=" and c.time_solve_instro='' ";
		
		$sql .=" and c.active='' GROUP BY a.ID
			   ORDER BY data desc";
		return $this->db->query($sql)->result_array();
	}
	
	public function report_by_instro(){
		$sql="select a.id_instro, a.keterangan_instro as label, count(b.id_asset) as data from instro_log a
				left join instro_log_asset b on a.id_instro=b.id_instro_log
				where a.time_input between '".strtotime($_POST['date1'])."' and  '".(strtotime($_POST['date2']))."'
				group by b.id_instro_log
				order by data desc";
		return $this->db->query($sql)->result_array();
	}
	
	public function time_solved_instro(){
		$sql="select LEFT( c.keterangan_instro, 20) as label, round(((time_solve_instro)-(time_start_instro))/3600 , 2) as time_problem  from asset a 
				inner join instro_log_asset b on a.ID=b.id_asset 
				inner join instro_log c on c.id_instro=b.id_instro_log 
				where c.time_input between  '".strtotime($_POST['date1'])."' and  '".(strtotime($_POST['date2']))."' and c.time_solve_instro<>'' and c.active=''
				limit 10
				";
		return $this->db->query($sql)->result_array();
	}


}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */