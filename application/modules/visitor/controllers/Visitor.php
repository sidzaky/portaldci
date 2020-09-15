<?php
/**
*
* author
* @si.dzaky
* info : visitor Management module
* 
**/
?>
 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visitor extends MX_Controller {
	
	var $data;
	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
		$this->load->library('uuid');
		$this->load->module('login');
		$this->load->module('controll');
		$data['notification']=$this->login->is_logged_in();
		$this->load->library('photoupload');
		$this->load->model('visitor_m');
		$this->load->module('activity');
		$this->load->model('activity_m');
		//////importan things////
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
		//////importan things////
    }
	
	
	/////////////////////////////////////gedung///////////////////////////////////
	
	public function index(){
			$data['content'] = 'visitor_view';
			$data['headboard'] = 'Data Register Visitor dan Checkin Gedung';
			$data['breadcrumb'][0] = 'Portal Isd';
			$data['breadcrumb'][1] = 'Visitor Management System';
			$this->load->view('template',$data);
	}
	
	public function viewlist(){
		if (array_key_exists('vm1',$this->session->userdata('module_access'))){			
			$data["visitor"] = $this->visitor_m->get();
			$this->load->view('visitor_list', $data);
		}
		else $this->login->noaccess('Visitor Management`');
	}
	
	public function input_visitor(){
		if($_POST==NULL){
				$data['listcompany']=$this->visitor_m->listcompany();
				$this->load->view('visitor_form_view',$data);
			} 
			else {
				if ($_POST['idcard_img']!=null) $_POST['idcard_img']=$this->fileupload($_POST['idcard_img']);
				if ($_POST['person_img']!=null) $_POST['person_img']=$this->fileupload($_POST['person_img']);
				
				if ($_POST['id_visitor']!='') $this->visitor_m->update_visitor_m();
				else {
					if ($this->visitor_m->input_visitor_m()==false) echo '<script>alert("Data Visitor sudah ada berdasarkan nomor identitasnya")</script>';
					else echo '<script>alert("Data Visitor Berhasil ditambahkan")</script>';
				}
				$_POST='';
				$this->viewlist();
			}
	}
	
	public function update_visitor(){
		$data["visitor"] = $this->visitor_m->get();
		$data['listcompany']=$this->visitor_m->listcompany();
		$this->load->view('visitor_form_view',$data);
	}
	
	
	public function checkin(){
		if ($_POST!=null){
			if ($this->visitor_m->checkin_m()==true){
					$_POST='';
					echo "
						<script>
							$('.modal').modal('hide');
							get_data_checkin();
						</script>
					";
					$this->viewlist();
					
			}
			else {
				echo "
						<script>
							alert('maaf, tolong ulangi lagi checkinnya');
						</script>
					";
			}
		}
		else {
			$data['listkey']=$this->visitor_m->getlistkey();
			$this->load->view('visitor_checkin_form',$data);
		}
	}
	
	public function getlistaccess(){
		$data=$this->visitor_m->getlistaccess_m();
		echo json_encode($data);
		
	}
	
	public function getavailablekey(){
		$data=$this->visitor_m->getavailablekey_by_akses_m();
		echo json_encode($data);
	}
	
	public function checkout(){
		if ($this->dc_checkin_cek($_POST['id_visitor'])==false) {
			$this->visitor_m->checkout_m();
			echo ('<script>alert("Checkout Berhasil");</script>');
		}
		else echo ('<script>alert("Visitor ini masih berada di dalam DC");</script>');
		$_POST='';
		$this->viewlist();
	}
	
	public function checkin_cek($id){
			$datacek=$this->visitor_m->last_checkin_m($id);
			if ($datacek[0]['time_in']!='' and $datacek[0]['time_out']=='') {
				$datacek['status']='true';
				return $datacek;
				}
			elseif  ($datacek[0]['time_in']!='' and $datacek[0]['time_out']!=''){
				$datacek['status']='false';
				return $datacek;
			}
	}
	
	public function checkdatabyname(){
		echo json_encode($this->visitor_m->checkdatabyname_m());
	}
	
	
	/////////////////////////////////////end gedung/////////////////////////////
	
	
	
	/////////////////////////////////////DC ///////////////////////////////////
	public function dc($getdata){
			
			$data["headboard"]='Visitor schedule on Data Center';
			$data['content'] = 'visitor_scheduledc_view';
			$data['breadcrumb'][0] = 'Portal Isd';
			$data['breadcrumb'][1] = 'Visitor DC Management System';
			$data['func']=$getdata;
			$this->load->view('template',$data);
	}
	
	
	
	public function reqscheduledc_list(){
		if (array_key_exists('vm2',$this->session->userdata('module_access'))){
			$this->data["dcvisitor"] = $this->visitor_m->getdc();
			$this->load->view('visitor_reqscheduledc_list', $this->data);
		}
		else $this->login->noaccess('Visitor DC Management`');	
	}
	
	public function dcrequest(){
		if ($_POST==null){
			$data['visitor']=$this->visitor_m->getVisitorAll();
			$data['asset_dc']=$this->visitor_m->getdcloc_m();
			$this->load->view('visitor_dcrequest_form', $data);
		}
		else {
			if ($_POST['document']!=null) $_POST['document']=$this->dcreqdocument($_POST['document']);
			$this->visitor_m->input_scheduledc_m();
			$_POST='';
		}
	}
	
	public function getdcarea(){
		echo json_encode($this->visitor_m->getdcarea_m());
	}
	
	public function dccancel(){
		$_POST['notes']="canceled by user";
		$_POST['approval']='0';
		$this->approval();
	}
	
	public function approval(){
		$this->visitor_m->approval_m();
		$_POST='';
		$this->reqscheduledc_list();
	}
	
	public function scheduledc_list(){
		if (array_key_exists('vm3',$this->session->userdata('module_access'))){
			$data["dcvisitor"] = $this->visitor_m->getdcapproved(strtotime(date('dmy')));
				$z=$this->visitor_m->dc_checkin_cek_all_m();
				for ($i=0;$i<sizeof($z);$i++){
						array_unshift ($data["dcvisitor"],$z[$i]);
					}
			$this->load->view('visitor_scheduledc_list', $data);
		}
		else $this->login->noaccess('Schedule on Visitor DC');
	}
	
	
	
	/////////////////////////////////////end DC/////////////////////////////
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////// visitor management view  server side //////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	
	function visitor_view_server_side(){
		if (array_key_exists('vm1',$this->session->userdata('module_access'))){
			$data['content'] = 'visitor_view_server_side';
			$data['headboard'] = 'Data Register Visitor dan Checkin Gedung';
			$data['breadcrumb'][0] = 'Portal Isd';
			$data['breadcrumb'][1] = 'Visitor Management System';
			$this->load->view('template',$data);
		}
		else $this->login->noaccess('NOPE NOPE NOPE NOPE');
	}
	
	
	function get_data_user()  
    {
        $list = $this->visitor_m->get_datafield();
        $data = array();
        $no = $_POST['start'];
        foreach ($list->result_array() as $field) {
			
			$bussiness='';
			$id_key="";
			$lastchekin='';
			$nda="";
			//get stiker parkir//
			
			$echoparkir='';
			foreach ($this->visitor_m->get_visitor_vehicle($field['id_visitor']) as $parkir){
				$echoparkir.='<span class="label label-info"><a target="_blank" style="color:#fff;" href="'.base_url().$parkir['stnk'].'">'.$parkir['nopol'].'['.$parkir['tipe_vehicle'].']['.$parkir['nomor_stiker'].']</a> <a href="#" onclick="del_stiker(\''.$parkir['nomor_stiker'].'\')" title="Removing tag"><i class="fa fa-close" style="color:red;"></i></a></span>';
			}
			
			if ($field['id_log_gedung']!='') {
						$in++;
						$bussiness			='<b><span class="label label-success"> '.$field['bussiness'].'</span></br></b>';
						$ischeckin			=($this->session->userdata('module_access')['vm1']>3 ? '<button class="btn btn-success waves-effect waves-light btn-sm" onclick="checkout_visitor(\''.$field['id_log_gedung'].'\',\''.$field['id_visitor'].'\',\''.$field['id_key'].'\');" type="button" ><i class="fa fa-sign-out"></i> Check out</button>' : '' );
						$id_key				='<span class="label label-danger">Id key :'.$field['warna'].'['.$field['nomer'].'] ['.$field['keterangan'].'] by '.$field['user_in'].' </span>';
						$day				=floor(((time()-$field['time_in'])/3600)/24);
						$lastchekin			=($day != 0 ? '<input type="hidden" id="plusday" value="'.$plusday++.'"><span class="label label-danger"> Checkin selama '.$day.' Hari '.gmdate("H:i", time()-$field['time_in']). ' Jam </span> </br>' : '' ).'<span class="label label-warning"> Waktu Check in : '.date('H:i d-M, Y', $field['time_in']).'</span></br>';
			}
			else {
					if ($_POST['search']['value']!=""){
						$ischeckin		=($this->session->userdata('module_access')['vm1']>3 ? '<button class="btn btn-primary waves-effect waves-light btn-sm checkin" onclick="form_checkin(\''.$field['id_visitor'].'\',\''.$field['warning_msg'].'\');" type="button" ><i class="fa fa-sign-in"></i> Check In</button>' : '' );
						$lastchekin		='<span class="label label-info">'.$field['last_log_checkin'].'</span>';
					}
					else continue;
			}
			
			
			$detailvisitor  = "";
			$detailvisitor .= '<div id="'.$field['id_visitor'].'">';
			$detailvisitor .= '<span class="label label-primary">'.$field["name_visitor"].'</span> </br> ';
			$detailvisitor .= '<span class="label label-primary"> ['.($field["organic"]!=0 ? 'PT. BRI // '  : '' ).$field["company"].'] </span></br>';
			$detailvisitor .= '<span class="label label-info"> Id : '.$field["id_number"] .'</span></br>';
			$detailvisitor .= '<span class="label label-info"> Telepon  : '.$field["phone_number"] .'</span></br>';
			$detailvisitor .= '<span class="label label-primary"> Alamat  : '.substr($field["domicile"] ,0,20).'</span></br>';
			$detailvisitor .= ($field['document_nda_visitor']!="" ? '<span class="label label-success"><a target="_blank" style="color:#fff;" href="'.base_url().$field['document_nda_visitor'].'""> NDA </a> <i class="fa fa-check" style="color:white;"></i></span></br>' : "" );						
			$detailvisitor .= $echoparkir;		
			$detailvisitor .= '</div>';					  
			
			$buttonaction="";
			$buttonaction .= $ischeckin;
			#edit button
			$buttonaction .= '<button class="btn btn-warning waves-effect waves-light btn-sm" data-toggle="modal" data-target=".first-modal" onclick="form_visitor(\''.$field['id_visitor'].'\')" data-target=".modal" type="button" ><i class="fa fa-pencil"></i>Edit</button>';
			#disable visitor
			$buttonaction .= ($this->session->userdata('module_access')['vm1']>=0 && $id_key == ""  ?  '<button class="btn btn-danger waves-effect waves-light btn-sm"  onclick="disvis(\''.$field['id_visitor'].'\',\''.$field['name_visitor'].'\')"  type="button" ><i class="fa fa-close"></i>Delete</button>' : '' );
			#setmessage visitor
			$buttonaction .= ($this->session->userdata('module_access')['vm1']>5 ?  '<button class="btn btn-info waves-effect waves-light btn-sm"  onclick="setmessage(\''.$field['id_visitor'].'\');"  type="button" ><i class="fa fa-message"></i>force update</button>' : '' );
			#setstiker visitor
			$buttonaction .= ($this->session->userdata('module_access')['vm1']>4 ?  '<button class="btn btn-info waves-effect waves-light btn-sm"  onclick="stiker(\''.$field['id_visitor'].'\');"  type="button" ><i class="fa fa-message"></i>stiker Parkir</button>' : '' );
			#setnda
			$buttonaction .= '<button class="btn btn-purple waves-effect waves-light btn-sm"  data-toggle="modal" data-target=".nda-modal" onclick="checknumbernda(\''.$field['id_visitor'].'\');" type="button" ><i class="fa fa-upload"></i>NDA DC</button>';
			
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $detailvisitor;
            $row[] = $bussiness.$lastchekin.$id_key;
            $row[] = '<a target="_blank" href="'.base_url().($field['person_img']!='' ? $field['person_img']: 'assets/img/unknown.jpg').'"><img class="lazy"  data-original='.base_url().($field['person_img']!='' ? $field['person_img'] : 'assets/img/unknown.jpg').' style="max-width:200px;max-height:150px;"></a>';
            $row[] = '<a target="_blank" href="'.base_url().($field['idcard_img']!='' ? $field['idcard_img']: 'assets/img/unknown.jpg').'"><img class="lazy"  data-original='.base_url().($field['idcard_img']!='' ? $field['idcard_img'] : 'assets/img/unknown.jpg').' style="max-width:200px;max-height:150px;"></a>';
            $row[] = $buttonaction;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $list->num_rows(),
            "recordsFiltered" => $this->visitor_m->count_all(),
            "data" => $data,
        );
        echo json_encode($output);
    }
		
	public function get_data_checkin(){
		$data=array(
				"allvisitor" =>  $this->visitor_m->get_total_inside()[0]['count(a.id_visitor)'],
				"allplusday" =>  $this->visitor_m->get_total_inside_more_day()[0]['count(a.id_visitor)'],
		);
		echo json_encode($data);
	}
	
	function visitor_list_server_side(){
		$this->load->view('visitor_list_server_side');
	}
	
	public function checkin_server_side(){
		if ($_POST['id_visitor']!=null){
			$this->visitor_m->checkin_m();
			$_POST='';
			$this->visitor_list_server_side();
		}
		else {
			$data['listkey']=$this->visitor_m->getlistkey_by_akses();
			$this->load->view('visitor_checkin_form',$data);
		}
	}
	
	
	public function checkout_server_side(){
		if ($this->dc_checkin_cek($_POST['id_visitor'])==false) {
			$this->visitor_m->checkout_m();
			echo ('<script>alert("Checkout Berhasil");</script>');
		}
		else echo ('<script>alert("Visitor ini masih berada di dalam DC");</script>');
		
		$_POST='';
		$this->visitor_list_server_side();
	}
	
	
	
	public function input_visitor_server_side(){
		if($_POST==NULL){
				$data['listcompany']=$this->visitor_m->listcompany();
				$this->load->view('visitor_form_view_server_side',$data);
			} 
			else {
				if ($_POST['idcard_img']!=null) $_POST['idcard_img']=$this->fileupload($_POST['idcard_img']);
				if ($_POST['person_img']!=null) $_POST['person_img']=$this->fileupload($_POST['person_img']);
				
				if ($_POST['id_visitor']!='') $this->visitor_m->update_visitor_m();
				else {
					if ($this->visitor_m->input_visitor_m()==false) echo '<script>
						alert("Data Visitor sudah ada berdasarkan nomor identitasnya")
						</script>';
					else echo '<script>
						alert("Data Visitor Berhasil ditambahkan")
						$(".modal").modal("hide");
					</script>';
				}
				$_POST=''; 
				$this->visitor_list_server_side();
			}
	}
	
	public function update_visitor_server_side(){
		$data["visitor"] = $this->visitor_m->get();
		$data['listcompany']=$this->visitor_m->listcompany();
		$this->load->view('visitor_form_view_server_side',$data);
	}
	
	public function visitor_number_nda_check(){
		// $this->deletefile();
		$sql="select document_nda_visitor_nomor from visitor_list order by document_nda_visitor_nomor desc limit 1";
		$data=$this->db->query($sql)->result_array();
		echo json_encode($data);
		
	}
	
	public function visitor_upload_nda(){
		
		$data['document_nda_visitor']=$this->documentuploaddecode();
		$data['document_nda_visitor_nomor']=$_POST['document_nda_visitor_nomor'];
		$data['document_nda_visitor_userinput']=$this->session->userdata('user_id');
		$data['document_nda_visitor_timeinput']=time();
		$this->visitor_m->visitor_upload_nda_m($data);
		
	}
	
	public function upload_document(){
		// $this->deletefile();
		$data['document']=$this->documentuploaddecode();
		$data['id_visitor']=$_POST['id_visitor'];
		$data['type']=$_POST['type'];
		$this->visitor_m->upload_document_m($data);
		
	}
	
	public function deletefile(){
		$file=$this->pmslan_m->select_all();
		unlink ($file[0]['document']);
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////// visitor management view end/////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////// scheedule DC view  server side /////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	function dc_schedule_server_side(){
			if (array_key_exists('vm2',$this->session->userdata('module_access'))){
				$data["headboard"]='Visitor schedule on Data Center';
				$data['content'] = 'visitor_scheduledc_view_server_side';
				$data['breadcrumb'][0] = 'Portal Isd';
				$data['breadcrumb'][1] = 'Visitor DC Management System';
				$data['func']=$getdata;
				$this->load->view('template',$data);
			}
			else $this->login->noaccess('NOPE NOPE NOPE NOPE');
	}
	
	function dcrequest_server_side(){
		
		$list = $this->visitor_m->dcrequest_m();
	
        $data = array();
        $no = $_POST['start'];
        foreach ($list->result_array() as $srow) {
			$button="";
			
			if ($this->session->userdata('module_access')['vm2']>=5){
						$button='<button class="btn btn-warning waves-effect waves-light btn-sm" data-toggle="modal" data-target=".first-modal" onclick="approval();id_schedule_dc=\''.$srow['id_schedule_dc'].'\'" data-target=".modal" type="button" >Approval? <i class="fa fa-deviantart"></i></button>';
			}
			$ndawarn='<button class="btn btn-danger waves-effect waves-light btn-sm"   type="button" >NDA belum dibuat!<i class="fa fa-warning"></i></button>
													<input  onchange="uploaddokument(\''.$srow['id_visitor'].'\',\'nda_visitor\');" type="file" name="trigger_nda_visitor'.$srow['id_visitor'].'" id="trigger_nda_visitor'.$srow['id_visitor'].'" style="display:none"> 
													<input type="hidden" id="decodedocument_'.$srow['id_visitor'].'" name="decodedocument_'.$srow['id_visitor'].'" value="">';
			
			if ($srow['organic']==0){
					if ($srow['document_nda_visitor']==""){
							if (time()<1591662600) $button=$button.$ndawarn;
							else $button=$ndawarn;
						}
					}
			
			
			
			
			
			$no++;
            $row = array();
            $row[]  = $no;
            $row[]  = '<a target="_blank" href="'.base_url().($srow['person_img'] !='' ? $srow['person_img'] : 'assets/img/unknown.jpg').'"> <img src="'.base_url().($srow['person_img'] !='' ? $srow['person_img'].'' : 'assets/img/unknown.jpg').'" style="max-width:300px;max-height:150px;"></a>';
            $row[]  = ' <style></style>
								<table class="no-footer table-striped">
									 <tbody>
										<tr>
											<td>Nama</td>
											<td> : </td>
											<td>'.$srow["name_visitor"].' <span class="label label-primary">'.($srow["organic"]!=0 ? 'PT. BRI / '  : '' ).$srow["company"].'</span></td>
										</tr>
										<tr>
											<td>Rentang</td>
											<td> : </td>
											<td>'.date ('d M, Y', $srow["range_start"]).' - '.date ('d M, Y', $srow["range_end"]).'</td>
										</tr>
										<tr>
											<td>Akses</td>
											<td> : </td>
											<td><span class="label label-warning"><b>'.$srow['nama_dc'].' // '.$srow["keterangan_area"].'</b></span></td>
										</tr>
										<tr>
											<td>Kebutuhan</td>
											<td> : </td>
											<td>'.$srow["purpose"].'</td>
										</tr>
										<tr>
											<td>Barang</td>
											<td> : </td>
											<td> '.$srow["tools"].'</td>
										</tr>
										<tr>
											<td>Dokumen</td>
											<td> : </td>
											<td>'.($srow['document']!='' ? '<a href="'.base_url().$srow['document'].'" download><span class="label label-lg label-info"><span>Download Dokumen Pendukung</span></span></a></br>' : '').'</td>
										</tr>
									</tbody>
							</table>';
            $row[]  = 	$button;
			$data[] = 	$row;
		}
		
		$output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $list->num_rows(),
            "recordsFiltered" => $this->visitor_m->dcrequest_m_count_all(),
            "data" => $data,
        );
        echo json_encode($output);
	}
	
	
	
	function dcresponse_server_side(){
			$list = $this->visitor_m->dcresponse_server_side_m();
	
			$data = array();
			$no = $_POST['start'];
			
		   foreach ($list->result_array() as $srow) {
					$button;
					$remaining=ceil((($srow["range_end"]-time())/60/60/24));
					$remaining = ($remaining > '365' ? round($remaining/365,0) .' years' : $remaining. ' days').' remaining' ;
					if ($remaining<0) { 
							$button='<span class="label label-danger">expired</span></br><button class="btn btn-info waves-effect waves-light btn-sm">nothing to do <i class="fa fa-child"></i></button>';
						}
					else {
							if ($srow['approval']=='1') { 
								$button='<span class="label label-success">Granted</span></br><button class="btn btn-warning waves-effect waves-light btn-sm" onclick="cancel(\''.$srow['id_schedule_dc'].'\');" type="button" >Cancel? <i class="fa fa-deviantart"></i></button>';
							}
							if ($srow['approval']=='0') {
								$button='<span class="label label-danger">Denied</span>';
							}
					}
		
			
			$no++;
            $row = array();
            $row[]  = $no;
            $row[]  = '<a target="_blank" href="'.base_url().($srow['person_img'] !='' ? $srow['person_img'] : 'assets/img/unknown.jpg').'"> <img src="'.base_url().($srow['person_img'] !='' ? $srow['person_img'].'' : 'assets/img/unknown.jpg').'" style="max-width:300px;max-height:150px;"></a>';
            $row[]  = ' <style></style>
								<table class="no-footer table-striped">
									 <tbody>
										<tr>
											<td>Nama</td>
											<td> : </td>
											<td>'.$srow["name_visitor"].' <span class="label label-primary">'.($srow["organic"]!=0 ? 'PT. BRI / '  : '' ).$srow["company"].'</span></td>
										</tr>
										<tr>
											<td>Rentang</td>
											<td> : </td>
											<td>'.date ('d M, Y', $srow["range_start"]).' - '.date ('d M, Y', $srow["range_end"]).'</td>
										</tr>
										<tr>
											<td>Akses</td>
											<td> : </td>
											<td><span class="label label-warning"><b>'.$srow['nama_dc'].' // '.$srow["keterangan_area"].'</b></span></td>
										</tr>
										<tr>
											<td>Kebutuhan</td>
											<td> : </td>
											<td>'.$srow["purpose"].'</td>
										</tr>
										<tr>
											<td>Barang</td>
											<td> : </td>
											<td> '.$srow["tools"].'</td>
										</tr>
										<tr>
											<td>Dokumen</td>
											<td> : </td>
											<td>'.($srow['document']!='' ? '<a href="'.base_url().$srow['document'].'" download><span class="label label-lg label-info"><span>Download Dokumen Pendukung</span></span></a></br>' : '').'</td>
										</tr>
									</tbody>
							</table>';
            $row[]  = 	$button.$status;
			$data[] = 	$row;
		}
		
		$output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $list->num_rows(),
            "recordsFiltered" => $this->visitor_m->dcrequest_m_count_all(),
            "data" => $data,
        );
        echo json_encode($output);	
	}
	
	
	function dcform(){
		
		$list = $this->visitor_m->dcform_m();
	
        $data = array();
		$ndawarn="alert('NDA belum dibuat, agar segera membuat dokument NDA sebelum 9 Juni 2020 pukul 07:30 WIB');";
		$no = $_POST['start'];
		foreach ($list->result_array() as $srow) {
			
			$buttonadd='<button class="btn btn-info waves-effect waves-light btn-sm" onclick="movetable(\''.$srow['id_visitor'].'\',\''.preg_replace('/[^A-Za-z0-9\-]/', ' ', $srow["name_visitor"]).'\',\''.$srow["company"].'\')" type="button" ><i class="fa fa-plus"></i></button>';
			
			if ($srow['organic']==0){
				if ($srow['document_nda_visitor']==""){
						if (time()<1591662600) {
							$buttonadd='<button class="btn btn-warning waves-effect waves-light btn-sm" onclick="'.$ndawarn.'movetable(\''.$srow['id_visitor'].'\',\''.preg_replace('/[^A-Za-z0-9\-]/', ' ', $srow["name_visitor"]).'\',\''.$srow["company"].'\')" type="button" ><i class="fa fa-warning"></i></button>';
						}
						else {
							$buttonadd='<button class="btn btn-danger waves-effect waves-light btn-sm" onclick="alert(\'Dokument NDA belum ada, harap mengisi terlebih dahulu\')" type="button" ><i class="fa fa-close"></i></button>';
						}
					}
			}
			
			
		
			$no++;
            $row = array();
            $row[]  = $no;
            $row[]  = $buttonadd;
            $row[]  = '<b>'.$srow["name_visitor"].'</b></br>'.($srow["organic"]!=0 ? 'PT. Bank Rakyat Indonesia </br> ' : '' ).$srow["company"].' </br> Nomor  identitas  : '.$srow["id_number"];
			$data[] = 	$row;
		}
		
		$output = array(
            "draw" => $_POST['draw'],
            "data" => $data,
        );
        echo json_encode($output);
		
		
		
		
		
	}
	
	
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////// scheedule DC  view end///////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////// DC CheckIn checkout menu/////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function dcgateway(){
			if (array_key_exists('vm3',$this->session->userdata('module_access'))){
				$data["headboard"]='Visitor Data Center Gateway';
				$data['content'] = 'visitor_dcgateway_v';
				$data['breadcrumb'][0] = 'Portal Isd';
				$data['breadcrumb'][1] = 'Visitor DC Management System';
				$data['func']=$getdata;
				$this->load->view('template',$data);
			}
			else $this->login->noaccess('NOPE NOPE NOPE NOPE');
	}
	
	
	function dcgateway_server_side()
    {
        $list = $this->visitor_m->dcgateway_server_side_m();
        $data = array();
        $no = $_POST['start'];
        foreach ($list->result_array() as $srow) {
			$ischeckin='<button class="btn btn-warning waves-effect waves-light btn-sm checkin"  onclick="checkin_visitor(\''.$srow['id_schedule_dc'].'\');" type="button" ><i class="fa fa-sign-in"></i> Check In DC</button>';
			$colortable='';
			$remaining=ceil((($srow["range_end"]-time())/60/60/24));
			$remaining = ($remaining > '365' ? round($remaining/365,0) .' years' : $remaining. ' days') ;
			
			if ($srow['time_in']!="") {
				$ischeckin='<button class="btn btn-success waves-effect waves-light btn-sm" onclick="checkout_visitor(\''.$srow['id_log_dc'].'\');" type="button" ><i class="fa fa-sign-out"></i> Check out</button>';
			}
			else { 
				if ($srow['organic']==0) {
						$gedungcek=$this->checkin_cek($srow['id_visitor']);
						if ($gedungcek['status']=='true'){
								if ($srow['document_nda_visitor']==""){
									if (time()<1591662600) {
										$ischeckin='<button class="btn btn-warning waves-effect waves-light btn-sm checkin"  onclick="alert(\'NDA BELUM DIISI, HARAP BERITAHUKAN KEPADA PENGUNJUNG UNTUK SEGERA MENGISI NDA SEBELUM 8 Juni 2020 PUKUL 07:30 WIB\');checkin_visitor(\''.$srow['id_schedule_dc'].'\');" type="button" ><i class="fa fa-sign-in"></i> Check In DC</button>';
									}
									else $ischeckin='<button class="btn btn-danger waves-effect waves-light btn-sm checkin"  onclick="alert(\'NDA BELUM DIISI, DILARANG MASUK!!!\');" type="button" ><i class="fa fa-close"></i> NDA BELUM DIISI, DILARANG MASUK</button>';
							}
					}
					else $ischeckin='<button class="btn btn-danger waves-effect waves-light btn-sm checkin"  onclick="alert(\'BELUM CHECKIN GEDUNG!!!!!\');" type="button" ><i class="fa fa-close"></i> BELUM CHECKIN GEDUNG!!!!!</button>';
				}
			}
			
            $no++;
            $row = array();
            $row[] = $no.($srow['time_in']!="" ? '<b style="color:transparent;"> key </b>' : '');
            $row[] = '<b>'.$srow["name_visitor"].'</b></br>
						  <b>'.($srow["organic"]==1 ? 'BRI // '  : '' ).$srow["company"].'</b> </br>
						  <b>Id:'.$srow["id_number"] .'</b></br>';
            $row[] = '<b>'.$srow['nama_dc'].' // '.$srow["keterangan_area"].'</b> </br>
										Peralatan	&nbsp : '.$srow["tools"].'</br>
										Kebutuhan	&nbsp : '.$srow["purpose"].'</br>
										Catatan	&nbsp : '.$srow["notes"].'</br>
										'.($srow['document']!='' ? '<a href="'.base_url().$srow['document'].'" download><span class="label label-lg label-info"><span>Download Dokumen Pendukung</span></span></a></br>' : '');
            $row[] = '<a target="_blank" href="'.base_url().($srow['person_img']!='' ? $srow['person_img']: 'assets/img/unknown.jpg').'"><img class="lazy"  data-original='.base_url().($srow['person_img']!='' ? $srow['person_img'] : 'assets/img/unknown.jpg').' style="max-width:200px;max-height:150px;"></a>';
            $row[] = '<a target="_blank" href="'.base_url().($srow['idcard_img']!='' ? $srow['idcard_img']: 'assets/img/unknown.jpg').'"><img class="lazy"  data-original='.base_url().($srow['idcard_img']!='' ? $srow['idcard_img'] : 'assets/img/unknown.jpg').' style="max-width:200px;max-height:150px;"></a>';
            $row[] = ($this->session->userdata('module_access')['vm3']>=4 ? $ischeckin : '') .'</br>
						<button class="btn btn-success waves-effect waves-light btn-sm" data-toggle="modal" data-target=".first-modal" onclick="form_visitor(\''.$srow['id_visitor'].'\')" data-target=".modal" type="button" ><i class="fa fa-pencil"></i>Edit Visitor</button>';
            $data[] = $row;
        }
  
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $list->num_rows(),
            "recordsFiltered" => $this->visitor_m->count_all(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	
	
	public function dc_checkin(){
		$this->visitor_m->dc_checkin_m();
		$_POST='';
	}
	
	public function dc_checkout(){
		$this->visitor_m->dc_checkout_m();
		$_POST='';
	}
	
	public function dc_checkin_cek($id){
		$datacek=$this->visitor_m->dc_checkin_cek_m($id);
		if (sizeof($datacek)>0) return $datacek;
		else return false;
			
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////// DC CheckIn checkout end //////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	
	
	
	
	///////////////////module stiker////////////////
	
	
	public function get_list_stiker(){
		if ($_POST['nomor_stiker']!=null){
			$_POST['stnk']=$this->fileupload($_POST['stnk']);
			$this->visitor_m->input_visitor_stiker();
			$_POST=''; 
			$this->visitor_list_server_side();
		}
		else {
			$data['stiker']=$this->visitor_m->get_stiker_available();
			$this->load->view('visitor_form_stiker',$data);
		}
	}
	
	public function del_visitor_stiker(){
		
		$this->visitor_m->del_visitor_stiker_m();
		$_POST=''; 
		$this->visitor_list_server_side();
		
	}
	
	///////////////////////////////////////////////////

	
	public function warningmessage(){
		$this->visitor_m->warningmessage_m();
	}

		
	
	//////////////////////////////////REPORT!!!!/////////////////////////////
	
	public function report(){
		if (array_key_exists('vm1',$this->session->userdata('module_access'))){
				$data['scriptoptional']="visitor_management_report.js";
				$data["content"] = "visitor_report_v";
				$this->load->view("template", $data);
		}
		else $this->login->noaccess('Report Visitor Management');
	}
	
	public function getsummary(){
		$data['newvisitor']=$this->visitor_m->getnewvisitorbyday(true);
		$data['countgedung']=$this->visitor_m->getcheckinvisitorbyday(true);
		$data['countdc']=$this->visitor_m->getcheckindcbyday(true);
		for ($i=0;$i<count($data['newvisitor']);$i++){
				$result[$i]['date']=$data['newvisitor'][$i]['Date'];
				$result[$i]['newvisitor']=$data['newvisitor'][$i]['newvisitor'];
				$result[$i]['checkin_gedung']=$data['countgedung'][$i]['checkin_gedung'];
				$result[$i]['checkin_dc']=$data['countdc'][$i]['checkin_dc'];
		}
		echo json_encode($result);
	}
	
	public function gettable($url){
		$data=$this->visitor_m->$url();
		$i=1;
		switch ($url){
			case ('getnewvisitorbyday'):
				$view = '
							<table id="zz"  class="table dataTable table-bordered" cellspacing="0" width="100%">
											  <thead>
												<tr>
													<th><i>No</i></th>
													<th><i>Time signup</i></th>
													<th><i>Nama</i></th>
													<th><i>Id Card</i></th>
													<th><i>Alamat </i></th>
													<th><i>Company</i></th>  
													<th><i>user input</i></th>
												</tr>
											  </thead>
												  <tbody>';
				
				foreach ($data as $row){
					if ($row['id_visitor']!=''){
						$view .='<tr>
										<td>'.$i.'</td>
										<td>'.date('d-M, Y H:i:s', $row['timeinput']).'</td>
										<td>'.$row['name_visitor'].'</td>
										<td>'.$row['id_number'].'</td>
										<td>'.$row['domicile'].'</td>
										<td>'.($row['organic']==true ? 'BRI/' : '' ).$row['company'].'</td>
										<td>'.$row['USERNAME'].'('.$row['BAGIAN'].')</td>
								</tr>
								';
						$i++;
					}
				}
				break;
			case ('getcheckinvisitorbyday'):
				$view = '
							<table id="zz"  class="table dataTable table-bordered" cellspacing="0" width="100%">
											  <thead>
												<tr>
													<th><i>no</i></th>
													<th><i>Nama</i></th>
													<th><i>Perusahaan</i></th>
													<th><i>Time In</i></th>
													<th><i>user Checkin</i></th>
													<th><i>Time Out</i></th>
													<th><i>user Checkout</i></th>
													<th><i>Lantai</i></th>
													<th><i>Keperluan</i></th>
													
												</tr>
											  </thead>
												  <tbody>';
				foreach ($data as $row){
					if ($row['id_log_gedung']!=''){
						$view .='<tr>
										<td>'.$i.'</td>
										<td>'.$row['name'].'</br></td>
										<td><span class="label label-lg label-success">'.($row['organic']==true ? 'BRI/' : '' ).$row['company'].'</span></td>
										<td>'.date('d-M, Y H:i:s', $row['time_in']).'</td>
										<td></br><span class="label label-lg label-primary">'.$row['user_in'].'</span></td>
										<td>'.date('d-M, Y H:i:s', $row['time_out']).'</td>
										<td></br><span class="label label-lg label-info">'.$row['user_out'].'</span></td>
										<td>['.$row['akses'].']['.$row['keterangan'].']['.$row['warna'].']['.$row['nomer'].'];</br></td>
										<td>'.$row['bussiness'].'</br></td>
								</tr>
								';
						$i++;
					}
				}
				
				break;
			case ('getcheckindcbyday'):
				$view = '
							<table id="zz"  class="table dataTable table-bordered" cellspacing="0" width="100%">
											  <thead>
												<tr>
													<th><i>No</i></th>
													<th><i>Nama</i></th>
													<th><i>Perusahaan</i></th>
													<th><i>Time In</i></th>
													<th><i>User CheckIn</i></th>
													<th><i>Time Out</i></th>
													<th><i>user CheckOut</i></th>
													<th><i>Keperluan</i></th>
													
												</tr>
											  </thead>
												  <tbody>';
				
				foreach ($data as $row){
					if ($row['id_log_dc']!=''){
						$view .='<tr>
										<td>'.$i.'</td>
										<td>'.$row['name'].'</br>'.$row['id_visitor'].'</td>
										<td><span class="label label-lg label-success">'.($row['organic']==true ? 'BRI/' : '' ).$row['company'].'</span></td>
										<td>'.date('d-M, Y H:i:s', $row['time_in']).'</td>
										<td><span class="label label-lg label-primary">'.$row['user_in'].'</span></td>
										<td>'.date('d-M, Y H:i:s', $row['time_out']).'</td>
										<td><span class="label label-lg label-info">'.$row['user_out'].'</span></td>
										<td>'.$row['purpose'].'</td>
								</tr>
								';
						$i++;
					}
				}
				
				break;	
		}
		
		$view.='</tbody>
							</table>
								
								<script>
								$(document).ready(function(){
										$("#zz").DataTable({
											dom: \'Bfrtip\',
											buttons: [
												\'copy\', \'csv\', \'excel\', \'pdf\', \'print\'
											],
											"pageLength": -1
										});	
								});		
								</script>
							';
		echo $view;
		
	}
	
	//////////////////////////////////end OF Report///////////////////////////////
	
		
	private function fileupload($file){
			    $encoded_data = $file;
				$binary_data = base64_decode($encoded_data);
				$url = "uploads/visitor/".uniqid(rand()).'.jpg';
				$result = file_put_contents( $url, $binary_data);
				// create thumnail
				$img = imagecreatefromjpeg($url);  
				imagejpeg($img,$url.'_t',5);
				//
				if (!$result) die("Could not save image!  Check file permissions.");
				else return $url;
	}
	
	private function documentuploaddecode(){
			    $encoded_data = $_POST['document'];
				$binary_data = base64_decode( $encoded_data );
				$typefile=explode('.',$_POST['name']);
				$binary_data = base64_decode( $encoded_data );
				$url = "uploads/visitor/".uniqid(rand()).'.'.$typefile[sizeof($typefile)-1];
				$result = file_put_contents( $url, $binary_data);
				if (!$result) die("Could not save file!  Check file permissions.");
				else return $url;
	}
		
	private function dcreqdocument($file){
			    $encoded_data = $file;
				$binary_data = base64_decode($encoded_data);
				$typefile=explode('.',$_POST['document_name']);
				$url = "uploads/visitor/dcreq/".uniqid(rand()).'.'.$typefile[sizeof($typefile)-1];
				$result = file_put_contents( $url, $binary_data);
				if (!$result) die("Could not save image!  Check file permissions.");
				else return $url;
		}
	
}
