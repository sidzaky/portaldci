<?php
/**
*
*
* @autor 
* @dzaky Hidayat
*
**/
?>
 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pmslan extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
		
		////load all library and necessary module////
		$this->load->library('session');
		$this->config->set_item('sess_expiration',120);
		$this->load->library('uuid');
		$this->load->module('controll');
		$this->load->module('login');
		$this->login->is_logged_in();
		$this->load->module('activity');
		$this->load->model('activity_m');
		
		////load all data depedencies on this module////
		$this->load->model('pmslan_m');
		$data['breadcrumb'][0] = 'Portal Isd';
		$data['breadcrumb'][1] = 'Report PMS LAN ';
		$data['headboard'] = 'Module Report PMS LAN';
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
    }

	public function index() {
		if (array_key_exists('pmslan',$this->session->userdata('module_access'))){
				$data["pms_lan"] = $this->pmslan_m->select_all();
				$data['content'] = 'pms_lan_list_v';
				$data['headboard'] = 'pms lan list v';
				$this->load->view('template',$data);
			}
		else $this->login->noaccess('PMS Lan Management');
	}
	
	////////////////////////////////FORM INPUT DATA/////////////////////////////
	public function input_request_tarikan(){
			if($_POST==NULL){
				$data['unit_kerja']=$this->pmslan_m->get_unitkerja();
				$this->load->view('pms_lan_form_surat_masuk_v', $data);
			} 
			else {
				if ($_POST['surat']['id_pms_lan']==null) $this->pmslan_m->input_request_tarikan_m();
				else $this->pmslan_m->update_request_tarikan_m();
					$data['pms_lan']=$this->pmslan_m->select_all();
					
					$data['con'] = $this;
					$this->load->view('pms_lan_table_v',$data);
			}
	}
	////////////////////////////// GET ALL DATA///////////////////////////////
	public function get_tarikan($id){
		return $this->pmslan_m->get_tarikan_m($id);
	}
	
	///////////////////////// GET DATA FOR UPDATE IF YOU WANT/////////////////////
	public function get_update_request_tarikan(){
		$data['surat']=json_decode(json_encode($this->pmslan_m->select_all()),true);
		$data['tarikan']=$this->pmslan_m->get_tarikan_m($_POST['id_pms_lan']);
		$this->load->view('pms_lan_form_surat_masuk_v',$data);
	}
	
	////////////////////////// THEN YOU INPUT DATA UPDATE HERE/////////////////////////////
	public function update_status_SIK(){
		$this->pmslan_m->update_status_SIK_m();
		$data['pms_lan']=$this->pmslan_m->select_all();
		echo '<script>alert ("Status '.$data['pms_lan'][0]["keterangan_surat_masuk"].' Telah '.$_POST['status_SIK'].'")</script>';
		unset ($_POST['id_pms_lan']);
		$data['pms_lan']=$this->pmslan_m->select_all();
		$data['con'] = $this;
		$this->load->view('pms_lan_table_v',$data);
	}
	public function update_by_case(){
		$this->pmslan_m->update_by_case_m();
		unset ($_POST['id_pms_lan']);
		$data['pms_lan']=$this->pmslan_m->select_all();
		$data['con'] = $this;
		$this->load->view('pms_lan_table_v',$data);
	}
	
	////////////////////////// DELETE DATA////////////////////////////////
	public function delete(){
		$this->pmslan_m->update_request_tarikan_m('justdel');
		unset ($_POST['id_pms_lan']);
		$data['pms_lan']=$this->pmslan_m->select_all();
		$data['con'] = $this;
		$this->load->view('pms_lan_table_v',$data);
	}
	
	///////////////////////// UPLOAD DOCUMENT//////////////////////
	public function upload_document(){
		
		$this->deletefile();
		$data['document']=$this->fileupload();
		$data['id_pms_lan']=$_POST['id_pms_lan'];
		$this->pmslan_m->upload_document_m($data);
		unset ($_POST['id_pms_lan']);
		$z['pms_lan']=$this->pmslan_m->select_all();
		$z['con'] = $this;
		$this->load->view('pms_lan_table_v',$z);
		echo '<script>alert ("upload done")</script>';
	}
		///////////////////////// DELETE DOCUMENT//////////////////////
	public function deletefile(){
		$file=$this->pmslan_m->select_all();
		unlink ($file[0]['document']);
	}
	
	
	
	
	
	/////////////////////////////////////report summary////////////////////////////////////////
	
	public function report(){
		if (array_key_exists('pmslan',$this->session->userdata('module_access'))){
			if ($this->session->userdata('module_access')['pmslan']>=2){
				$data['scriptoptional']="pms_lan_report.js";
				$data["content"] = "pms_lan_report_v";
				$this->load->view("template", $data);
			}
			else $this->login->noaccess('PMS Lan Report');
		}
		else $this->login->noaccess('PMS Lan Report');
	}
	/////////////////////////////////////GET report summary////////////////////////////////////////
	public function getsummary(){
		$data=$this->pmslan_m->summary();
		$f=0;
		$t=0;
		$u=0;
		foreach ($this->pmslan_m->SLA() as $srow){
				$f++;
				$t=$t+5;
				$limit=strtotime($srow["tanggal_SIK"])+($srow["SLA"]*86400);
				$selisihdone= round(($limit - $srow["update_status_SIK"])/86400);
				if ($selisihdone<0) {
					$selisihdone=$selisihdone*-1;
					if ($selisihdone<=(86400)*(3))		$u=$u+4;
					elseif ($selisihdone<=(86400)*(5)) 	$u=$u+3;
					elseif ($selisihdone<=(86400)*(7)) 	$u=$u+2;
					else $u=$u+1;
				}	
				else $u=$u+5;
		}
		$data[0]['sla']='['.$f.']('.$u.'/'.$t.')'.round((($u/$t))*100).'%';
		$data[1]['a']=0;
		$data[1]['b']=0;
		$data[1]['c']=0;
		$data[1]['d']=0;
		
		foreach ($this->pmslan_m->progress_summary() as $row){
			$progress=round((time()-strtotime($row['tanggal_surat_masuk']))/(60*60*24),0);
			if ($progress<=2) $data[1]['a']++;
			elseif ($progress>3 && $progress<=5) $data[1]['b']++;
			elseif ($progress>5 && $progress<=7) $data[1]['c']++;
			elseif ($progress>7) $data[1]['d']++;
		}
		
		$data[2]["text"]='<table class="tile_info">';
		$i=0;
		foreach ($this->pmslan_m->tarikan_summary() as $row){
			$data[2]['labels'][]=$row->jenis_pms_lan;
			$data[2]['data'][]=$row->jumlah_pms_lan;
			$data[2]['colors'][]='rgba('.rand(0, 254).', '.rand(0, 254).', '.rand(0, 254).', 1)';
			$data[2]["text"].= '<tr>
									<td><a href="" class="tr" onclick="dettarikan(\''.$row->jenis_pms_lan.'\');"><p><i class="fa fa-square " style="color : '.$data[2]['colors'][$i].';" ></i> '.$row->jenis_pms_lan.' </p></a></td>
									<td width="20px">'.$row->jumlah_pms_lan.'</td>
								</tr>';
			$i++;
		}
		$data[2]["text"] .='</table>';
		$i=-1;
		
		foreach($this->pmslan_m->tarikan_done_time()->result() as $row){
			if ($data[3]['labels'][$i]!=$row->day){
				$i++;
				$data[3]['labels'][$i]=$row->day;
			}
			$data[3]['data'][$i]=$data[3]['data'][$i]+1;
			$data[3]['colors'][$i]='rgba('.rand(0, 254).', '.rand(0, 254).', '.rand(0, 254).', 1)';
			
		}
		
		$data[3]["text"]='<table class="tile_info">';
		for ($i=0;$i<sizeof($data[3][labels]);$i++){
			$data[3]["text"].= 
					'<tr>
						<td><a href="" class="tr" onclick="dettimetarikan('.$data[3]['labels'][$i].');">
							<p><i class="fa fa-square "  style="color : '.$data[3]['colors'][$i].';" ></i>'.$data[3]['labels'][$i].' hari </p>
							</a>
						</td>
						<td width="20px">'.$data[3]['data'][$i].'</td>
					</tr>';
		}
		$data[3]["text"] .='</table>';
		
		echo json_encode(($data));
	}
	///////////////////////////////////// DETAIL report summary////////////////////////////////////////
	public function detsummary(){
		if ($_POST['type']!=null) $data['pms_lan']=$this->pmslan_m->progress_summary(true);
		else $data['pms_lan']=$this->pmslan_m->detsummary_m();
		$data['con'] = $this;
		$this->load->view('pms_lan_table_v',$data);
	}
	
	public function dettimetarikan(){
		$data['pms_lan']=$this->pmslan_m->tarikan_done_time()->result_array();
		$data['con'] = $this;
		$this->load->view('pms_lan_table_v',$data);
	}
	
	
	/////////////////////////////////////DETAIL TARIKAN////////////////////////////////////////
	public function dettarikan(){
		echo '<table id="pmslan_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
				  <thead>
					<tr>
						<th rowspan="2"><i>No</i></th>
						<th rowspan="2"><i>Pengirim</i></th>
						<th rowspan="2"><i>Keterangan</i></th>
						<th colspan="2" style="text-align:center"><i>SIK</i></th>
						<th rowspan="2"><i>Jenis Tarikan</i></th>
						<th rowspan="2"><i>Jumlah Tarikan</i></th>
						<th rowspan="2"><i>Koordinat pertama</i></th>
						<th rowspan="2"><i>Koordinat kedua</i></th>
					</tr> 
				    <tr>
						<th><i>Nomor</i></th>
						<th><i>Tanggal</i></th>
				    </tr>
				  </thead>
				  <tbody>';
				  $i=0;
		foreach ($this->pmslan_m->dettarikan_m() as $row){
				$i++;
				echo '<tr>
						<td>'.$i.'</td>
						<td>'.$row->unit_kerja.'</td>
						<td>'.$row->keterangan_surat_masuk.'</td>
						<td>'.$row->nomor_SIK.'</td>
						<td>'.$row->tanggal_SIK.'</td>
						<td>'.$row->jenis_pms_lan.'</td>
						<td>'.$row->jumlah_pms_lan.'</td>
						<td>'.$row->titik_pertama.'</td>
						<td>'.$row->titik_kedua.'</td>
				</tr>';
		}
		echo '</tbody>
			</table>
			<script>$(document).ready(function(){$("#pmslan_table").DataTable({
											dom: \'Bfrtip\',
											buttons: [
												\'copy\', \'csv\', \'excel\', \'pdf\', \'print\'
											],
											"pageLength": -1
										});	
								});		
								</script>
			';
	}
	
	
	/////////////////////////////////////report summary////////////////////////////////////////
	
	
	private function fileupload(){
			    $encoded_data = $_POST['document'];
				$binary_data = base64_decode( $encoded_data );
				$typefile=explode('.',$_POST['name']);
				$binary_data = base64_decode( $encoded_data );
				$url = "uploads/document/PMSdocument/".uniqid(rand()).'.'.$typefile[sizeof($typefile)-1];
				$result = file_put_contents( $url, $binary_data);
				if (!$result) die("Could not save image!  Check file permissions.");
				else return $url;
	}
	
	
	public function tester(){
		$data=$this->pmslan_m->get_tarikan_m();
		$f=0;
		$t=0;
		$u=0;
		foreach ($this->pmslan_m->SLA() as $srow){
				$f++;
				$t=$t+5;
				$limit=strtotime($srow["tanggal_SIK"])+($srow["SLA"]*86400);
				$selisihdone= round(($limit - $srow["update_status_SIK"])/86400);
				if ($selisihdone<0) {
					$selisihdone=$selisihdone*-1;
					if ($selisihdone<=(86400)*(3))		$u=$u+4;
					elseif ($selisihdone<=(86400)*(5)) 	$u=$u+3;
					elseif ($selisihdone<=(86400)*(7)) 	$u=$u+2;
					else $u=$u+1;
				}	
				else $u=$u+5;
		}
		$data[0]['sla']='['.$f.']('.$u.'/'.$t.')'.round((($u/$t))*100).'%';
		$data[1]['a']=0;
		$data[1]['b']=0;
		$data[1]['c']=0;
		$data[1]['d']=0;
		
		foreach ($this->pmslan_m->progress_summary() as $row){
			$progress=round((time()-strtotime($row['tanggal_surat_masuk']))/(60*60*24),0);
			if ($progress<=2) $data[1]['a']++;
			elseif ($progress>3 && $progress<=5) $data[1]['b']++;
			elseif ($progress>5 && $progress<=7) $data[1]['c']++;
			elseif ($progress>7) $data[1]['d']++;
		}
		
		print_r ($data);
		
		
		
		
	}
}
