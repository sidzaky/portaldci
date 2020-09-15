

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dailymonitoring_m extends CI_Model 
{
  public function getups(){
		$sql='select a.*,c.nama_dc, b.* from asset a	
			  left join asset_jenis b on a.jenis_id=b.jenis_id
			  left join asset_dc c on a.LOCATION_DC=c.id_asset_dc
			  where a.jenis_id=1 and 
			  c.id_asset_dc="sdh1hBr"
			  order by c.nama_dc and a.HOSTNAME asc 
			  ';
		return $this->db->query($sql)->result_array();	
	}
	
	public function getupstest($data){
		$sql='select a.*,c.nama_dc, b.* from asset a	
			  left join asset_jenis b on a.jenis_id=b.jenis_id
			  left join asset_dc c on a.LOCATION_DC=c.id_asset_dc
			  where a.jenis_id=1 ';
		if ($_POST['id_dc']!=null || $data!=null) $sql .= " and c.id_asset_dc='".$_POST['id_dc'].$data."'";
		$sql .=' order by c.nama_dc and a.HOSTNAME asc ';
		return $this->db->query($sql)->result_array();	
	}
	
	public function getdatadc(){
		$sql='select * from asset_dc';
		return $this->db->query($sql)->result_array();	
	}
	
	
	public function gettraffo(){
		$sql='select a.*, b.* from asset a	
			  left join asset_jenis b on a.jenis_id=b.jenis_id
			  where a.jenis_id=4';
		return $this->db->query($sql)->result_array();	
		
		
	}
	
	
	public function insertmonitoringups(){
		$time=time();
		for ($i=1;$i<=$_POST['total'];$i++){
				$sql="insert into daily_report_asset_ups 
					  values(
							 '".$_POST['asset_id_'.$i]."',
							 '".$this->session->userdata('user_id')."',
							 '".$time."',
							 '".$_POST['input_Van_'.$i]."',
							 '".$_POST['input_Vbn_'.$i]."',
							 '".$_POST['input_Vcn_'.$i]."',
							 '".$_POST['input_Ia_'.$i]."',
							 '".$_POST['input_Ib_'.$i]."',
							 '".$_POST['input_Ic_'.$i]."',
							 '".$_POST['input_PF_'.$i]."',
							 '".$_POST['input_KVA_'.$i]."',
							 '".$_POST['input_KW_'.$i]."',
							 '".$_POST['input_freq_'.$i]."',
							 '".$_POST['output_Van_'.$i]."',
							 '".$_POST['output_Vbn_'.$i]."',
							 '".$_POST['output_Vcn_'.$i]."',
							 '".$_POST['output_Ia_'.$i]."',
							 '".$_POST['output_Ib_'.$i]."',
							 '".$_POST['output_Ic_'.$i]."',
							 '".$_POST['output_PF_'.$i]."',
							 '".$_POST['output_KVA_'.$i]."',
							 '".$_POST['output_KW_'.$i]."',
							 '".$_POST['output_freq_'.$i]."',
							 '".$_POST['output_util_'.$i]."',
							 '".$_POST['bypass_Van_'.$i]."',
							 '".$_POST['bypass_Vbn_'.$i]."',
							 '".$_POST['bypass_Vcn_'.$i]."',
							 '".$_POST['bypass_Ia_'.$i]."',
							 '".$_POST['bypass_Ib_'.$i]."',
							 '".$_POST['bypass_Ic_'.$i]."',
							 '".$_POST['bypass_freq_'.$i]."',
							 '".$_POST['battery_Vdc_'.$i]."',
							 '".$_POST['battery_Idc_'.$i]."',
							 '".$_POST['battery_percent_'.$i]."',
							 '".$_POST['envi_temp_'.$i]."',
							 '".$_POST['envi_humidity_'.$i]."',
							 '".$_POST['notes_'.$i]."')";			
			$this->db->query($sql);
		}
		
	}

}