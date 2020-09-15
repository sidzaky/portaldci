<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pmslan_m extends CI_Model 
{
		
	public function select_all(){
		$sql="SELECT a.*, b.USERNAME from pms_lan a
			  left join user b on b.ID =a.user_set_status_SIK
			";
		if ($_POST['id_pms_lan']!=null){
			$sql .=" where id_pms_lan='".$_POST['id_pms_lan']."'";
		}
		$sql.="  order by a.status_SIK asc, a.tanggal_sik desc";
		return $this->db->query($sql)->result_array(); 	
	}
	
	public function input_request_tarikan_m(){
		$message="update new PMSlan Request";
		if ($_POST['surat']['id_pms_lan']==null){
			$_POST['surat']['id_pms_lan']=substr($this->uuid->v4(),(rand(2, 4)*(-1)))."PMSin".substr($this->uuid->v4(),(rand(4, 5)*(-1)));
			$message="input new PMSlan Request";
		}
		
		$_POST['surat']['user_input']=$this->session->userdata('user_id');
		$this->db->insert('pms_lan', $_POST['surat']);
		
		for ($i=0;$i<sizeof($_POST['tarikan']['jenis_tarikan']);$i++){
			if ($_POST['tarikan']['jumlah_tarikan'][$i]!='' )
				{	$idreq=substr($this->uuid->v4(),(rand(2, 4)*(-1)))."PMSreq".substr($this->uuid->v4(),(rand(4, 6)*(-1)));
					$sql="insert into pms_lan_request values ('".$idreq."',
														  '".$_POST['surat']['id_pms_lan']."',
														  '".$_POST['tarikan']['jenis_tarikan'][$i]."',
														  '".$_POST['tarikan']['jumlah_tarikan'][$i]."',
														  '".$_POST['tarikan']['titik_pertama_tarikan'][$i]."',
														  '".$_POST['tarikan']['titik_kedua_tarikan'][$i]."',
														  '".$_POST['tarikan']['keterangan'][$i]."')";								  
					$this->db->query($sql); 
					}		
		}
		
		if ($_POST['surat']['status_SIK']==null){
			$idnotif=substr($this->uuid->v4(),(rand(3, 4)*(-1)))."not".substr($this->uuid->v4(),-5);
			$sql="insert into user_notif values('".$idnotif."',
												'21',
												'<span>
												 <span>Request Tarikan</span>
												 <span class=\"time\">".$_POST['surat']['unit_kerja']."</span>
												 </span>
												 <span class=\"message\">".$_POST['surat']['keterangan_surat_masuk']."</span>',
												 '".time()."',
												 '0')";
			$this->db->query($sql); 
			// $this->controll->telegramnotif('group', "Work Order Masuk<br>id_pms_lan : <br>".$_POST['surat']['id_pms_lan'].
													// "<br>WO/Sik : ".$_POST['surat']['nomor_SIK'].
													// "<br>".$_POST['surat']['keterangan_surat_masuk'].
													// "<br>Copas Text dibawah untuk Download WO","0");
			// $this->controll->telegramnotif('group',"/getpmslan ".$_POST['surat']['id_pms_lan'],"0");
		
		}
	
		
		$message .="with ip pmslan = ".$_POST['surat']['id_pms_lan'];
	
		$this->activity_m->writelog('pmslan',$message);
	}
	
	public function update_by_case_m(){
		$sql="update pms_lan set status_by_case='true', 
								 user_set_status_by_case='".$this->session->userdata('user_id')."'
			  where id_pms_lan='".$_POST['id_pms_lan']."'";
		$this->db->query($sql);
	}
	
	public function dokument_sik(){
		$this->db->insert('pms_lan', $dokument);
	}
	
	public function update_request_tarikan_m($i){
		$sql="delete from pms_lan_request where id_pms_lan='".$_POST['surat']['id_pms_lan'].$_POST['id_pms_lan']."'";
		$this->db->query($sql);
		$sql="delete from pms_lan where id_pms_lan='".$_POST['surat']['id_pms_lan'].$_POST['id_pms_lan']."'";
		$this->db->query($sql); 
		if ($i!="justdel"){
			$this->input_request_tarikan_m();
		}
	}
	
	public function get_unitkerja(){
		$sql="select DISTINCT(unit_kerja) from pms_lan";
		return $this->db->query($sql)->result_array();
	}
	
	public function get_tarikan_m($id){
		$sql="select * from pms_lan_request where id_pms_lan='".$id."'";
		return $this->db->query($sql)->result();
	}
	
	public function upload_document_m($data){
		$sql="update pms_lan set document_".$_POST['type']."='".$data['document']."' where id_pms_lan='".$data['id_pms_lan']."'";
		$this->db->query($sql);
		$message='upload new document_'.$_POST['type'].' with id pmslan='.$data['id_pms_lan'];
		$this->activity_m->writelog('pmslan',$message);
	}
	
	public function update_status_SIK_m(){
		$sql="update pms_lan set status_SIK='".$_POST['status_SIK']."',
								 update_status_SIK='".time()."',
								 user_set_status_SIK='".$this->session->userdata('user_id')."'
			  where id_pms_lan = '".$_POST['id_pms_lan']."'";
		$this->db->query($sql);
		$message='update status SIK to '.$_POST['status_SIK'].' id pmslan='.$_POST['id_pms_lan'];
		$this->activity_m->writelog('pmslan',$message);
	}
	
	/////////////////////////////////////////////report summary///////////////////////////////////////////////////
	
	public function summary(){

		$sql="SELECT COUNT(CASE WHEN status_SIK = '' THEN 1 ELSE NULL END) AS On_progress, 
					 COUNT(CASE WHEN status_SIK = 'Done' THEN 1 ELSE NULL END) AS Done, 
					 COUNT(CASE WHEN status_SIK = 'Cancel' THEN 1 ELSE NULL END) AS Cancel, 
					 COUNT(*) AS Total FROM pms_lan
					 WHERE tanggal_surat_masuk BETWEEN '".date("Y-m-d" , (strtotime($_POST['date1'])))."' AND '".date("Y-m-d" , strtotime($_POST['date2']))."';
					 ";	
		return $this->db->query($sql)->result_array();
	}
	
	public function tarikan_summary(){
		
		$sql="select DISTINCT(a.jenis_pms_lan) as jenis_pms_lan, sum(a.jumlah_pms_lan) as jumlah_pms_lan from pms_lan_request a
			  left join pms_lan b on b.id_pms_lan=a.id_pms_lan
			  where b.tanggal_surat_masuk BETWEEN '".date("Y-m-d" , strtotime($_POST['date1']))."'  and  '".date("Y-m-d" , strtotime($_POST['date2']))."'
			  group by a.jenis_pms_lan
		";
		return $this->db->query($sql)->result();
	}
	
	public function tarikan_done_time(){
		$sql="select *, floor((update_status_SIK-(unix_timestamp(tanggal_SIK)))/(60*60*24)) as day 
			  from pms_lan 
			  where tanggal_surat_masuk BETWEEN '".date("Y-m-d" , strtotime($_POST['date1']))."' and '".date("Y-m-d" , strtotime($_POST['date2']))."'
			  and status_SIK='Done'";
		if ($_POST['where']!=null){
			$sql .= " and floor((update_status_SIK-(unix_timestamp(tanggal_SIK)))/(60*60*24)) = '".$_POST['where']."'";
		}	 
			$sql .= " order by day asc";
			
		return $this->db->query($sql);
	}
	
	
	
	public function dettarikan_m(){
		$sql="select a.*, b.keterangan_surat_masuk, b.unit_kerja, b.nomor_SIK, b.tanggal_SIK from pms_lan_request a
			  left join pms_lan b on a.id_pms_lan=b.id_pms_lan 
			  where jenis_pms_lan='".$_POST['where']."' and 
			  b.tanggal_surat_masuk BETWEEN '".date("Y-m-d" , strtotime($_POST['date1']))."'  and  '".date("Y-m-d" , strtotime($_POST['date2']))."'";
		return $this->db->query($sql)->result();
	}
	
	
	
	public function progress_summary($i){
		$sql="select * from pms_lan WHERE status_SIK='' and tanggal_surat_masuk BETWEEN '".date("Y-m-d" , strtotime($_POST['date1']))."' AND NOW()";
		if ($i==true) $sql .= " and datediff(NOW(), tanggal_surat_masuk)  ".$_POST['where'];
		// echo $sql;
		return $this->db->query($sql)->result_array();
	}
	
	public function detsummary_m(){
		$sql="select * from pms_lan WHERE 
			  status_SIK='".$_POST['where']."' and 
			  tanggal_surat_masuk BETWEEN '".date("Y-m-d" , strtotime($_POST['date1']))."' AND '".date("Y-m-d" , strtotime($_POST['date2']))."'";
		// echo $sql;
		return $this->db->query($sql)->result_array();
	}
	/*
	cek telat
	select nomor_surat_masuk, keterangan_surat_masuk, nomor_SIK, 
			((SLA)-(DATEDIFF(tanggal_SIK,DATE_FORMAT(FROM_UNIXTIME(update_status_SIK), '%Y-%m-%d')))*-1) as pengerjaan, 
			tanggal_sik, SLA, DATE_FORMAT(FROM_UNIXTIME(update_status_SIK), '%Y-%m-%d') as done
			from pms_lan WHERE status_SIK='Done' and ((SLA)-(DATEDIFF(tanggal_SIK,DATE_FORMAT(FROM_UNIXTIME(update_status_SIK), '%Y-%m-%d')))*-1)<0 and tanggal_surat_masuk BETWEEN '2019-12-01' AND '2019-12-31'
	
	*/
	public function SLA(){
	$sql="select * from pms_lan WHERE 
			  status_SIK='Done' and status_by_case is null and kategori='pms_lan' and
			  tanggal_surat_masuk BETWEEN '".date("Y-m-d" , strtotime($_POST['date1']))."' AND '".date("Y-m-d" , strtotime($_POST['date2']))."'";
		return $this->db->query($sql)->result_array();
	}
    

}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */