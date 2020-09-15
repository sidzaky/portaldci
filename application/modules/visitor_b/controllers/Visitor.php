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
			$this->reqscheduledc_list();
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
	
	
	public function dc_checkin(){
		$this->visitor_m->dc_checkin_m();
		$_POST='';
		$this->scheduledc_list();
	}
	
	public function dc_checkout(){
		$this->visitor_m->dc_checkout_m();
		$_POST='';
		$this->scheduledc_list();
	}
	
	public function dc_checkin_cek($id){
		$datacek=$this->visitor_m->dc_checkin_cek_m($id);
		if (sizeof($datacek)>0) return $datacek;
		else return false;
			
	}
	/////////////////////////////////////end DC/////////////////////////////
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
	
	///////////////////////////////////server side////////////////////////
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
	
	public function get_data_checkin(){
		$data=array(
				"allvisitor" =>  $this->visitor_m->get_total_inside()[0]['count(a.id_visitor)'],
				"allplusday" =>  $this->visitor_m->get_total_inside_more_day()[0]['count(a.id_visitor)'],
		);
		
		echo json_encode($data);
	}
	
	function get_data_user()
    {
        $list = $this->visitor_m->get_datafield();
        $data = array();
        $no = $_POST['start'];
        foreach ($list->result_array() as $field) {
			
			$bussiness='';
			$id_key='';
			$lastchekin='';
			//get stiker parkir//
			
			$echoparkir='';
			foreach ($this->visitor_m->get_visitor_vehicle($field['id_visitor']) as $parkir){
				$echoparkir.='<span class="label label-info"><a target="_blank" style="color:#fff;" href="'.base_url().$parkir['stnk'].'">'.$parkir['nopol'].'['.$parkir['tipe_vehicle'].']['.$parkir['nomor_stiker'].']</a> <a href="#" onclick="del_stiker(\''.$parkir['nomor_stiker'].'\')" title="Removing tag"><i class="fa fa-close" style="color:red;"></i></a></span>';
			}
			
			if ($field['statuscek']!='nope' && $field['statuscek']!='') {
						// $zz++;
						$in++;
						$bussiness='<b><span class="label label-success"> '.$field['bussiness'].'</span></br></b>';
						$ischeckin=($this->session->userdata('module_access')['vm1']>3 ? '<button class="btn btn-success waves-effect waves-light btn-sm" onclick="checkout_visitor(\''.$field['id_log_gedung'].'\',\''.$field['id_visitor'].'\',\''.$field['id_key'].'\');" type="button" ><i class="fa fa-sign-out"></i> Check out</button>' : '' );
						$colortable='style="background-color : #ffff99"';
						$id_key='<span class="label label-danger">Id key :'.$field['warna'].'['.$field['nomer'].'] ['.$field['keterangan'].'] by '.$field['user_in'].' </span>';
						$day=floor(((time()-$field['time_in'])/3600)/24);
						$lastchekin=($day != 0 ? '<input type="hidden" id="plusday" value="'.$plusday++.'"><span class="label label-danger"> Checkin selama '.$day.' Hari '.gmdate("H:i", time()-$field['time_in']). ' Jam </span> </br>' : '' ).'<span class="label label-warning"> Waktu Check in : '.date('H:i d-M, Y', $field['time_in']).'</span></br>';
			}
			else {
					if ($_POST['search']['value']!=""){
						$ischeckin=($this->session->userdata('module_access')['vm1']>3 ? '<button class="btn btn-primary waves-effect waves-light btn-sm checkin" onclick="form_checkin(\''.$field['id_visitor'].'\',\''.$field['warning_msg'].'\');" type="button" ><i class="fa fa-sign-in"></i> Check In</button>' : '' );
						$colortable='style="background-color :  rgba(54, 162, 235, 0.3)"';
						$lastchekin=($field['time_in'] != '' ? '<span class="label label-success">'.date('H:i d-M, Y', $field['time_in']).' s/d '.date('H:i d-M, Y', $field['time_out']).'</span>': '<span class="label label-info">Belum Pernah Checkin</span>' );
					}
					else continue;
			}
			
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<div id="'.$field['id_visitor'].'"><span class="label label-primary">'.$field["name_visitor"].'</span> </br> <span class="label label-primary"> ['.($field["organic"]!=0 ? 'PT. BRI // '  : '' ).$field["company"].'] </span></br>
					 <span class="label label-info"> Id : '.$field["id_number"] .'</span></br>
					 <span class="label label-info"> Telepon  : '.$field["phone_number"] .'</span></br>
					 <span class="label label-primary"> Alamat  : '.substr($field["domicile"] ,0,20).'</span></br>'.$echoparkir.'</div>';
            $row[] = $bussiness.$lastchekin.$id_key;
            $row[] = '<a target="_blank" href="'.base_url().($field['person_img']!='' ? $field['person_img']: 'assets/img/unknown.jpg').'"><img class="lazy"  data-original='.base_url().($field['person_img']!='' ? $field['person_img'] : 'assets/img/unknown.jpg').' style="max-width:200px;max-height:150px;"></a>';
            $row[] = '<a target="_blank" href="'.base_url().($field['idcard_img']!='' ? $field['idcard_img']: 'assets/img/unknown.jpg').'"><img class="lazy"  data-original='.base_url().($field['idcard_img']!='' ? $field['idcard_img'] : 'assets/img/unknown.jpg').' style="max-width:200px;max-height:150px;"></a>';
            $row[] = $ischeckin.'<button class="btn btn-warning waves-effect waves-light btn-sm" data-toggle="modal" data-target=".first-modal" onclick="form_visitor(\''.$field['id_visitor'].'\')" data-target=".modal" type="button" ><i class="fa fa-pencil"></i>Edit</button>
					'.($this->session->userdata('module_access')['vm1']>=0 ?  '<button class="btn btn-danger waves-effect waves-light btn-sm"  onclick="disvis(\''.$field['id_visitor'].'\',\''.$field['name_visitor'].'\')"  type="button" ><i class="fa fa-close"></i>Delete</button>' : '' ).
					 ($this->session->userdata('module_access')['vm1']>5 ?  '<button class="btn btn-info waves-effect waves-light btn-sm"  onclick="setmessage(\''.$field['id_visitor'].'\');"  type="button" ><i class="fa fa-message"></i>force update</button>' : '' ).
					 ($this->session->userdata('module_access')['vm1']>4 ?  '<button class="btn btn-info waves-effect waves-light btn-sm"  onclick="stiker(\''.$field['id_visitor'].'\');"  type="button" ><i class="fa fa-message"></i>stiker Parkir</button>' : '' );
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
	
	
	///////////////////////////////////////////////////////////////////////
	
	function get_data_user_for_dc()
    {
        $list = $this->visitor_m->get_datafield();
        $data = array();
        $no = $_POST['start'];
        foreach ($list->result_array() as $field) {
			
			
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<div id="'.$field['id_visitor'].'"><span class="label label-primary">'.$field["name_visitor"].'</span> </br> <span class="label label-primary"> ['.($field["organic"]!=0 ? 'PT. BRI // '  : '' ).$field["company"].'] </span></br>
					 <span class="label label-info"> Id : '.$field["id_number"] .'</span></br>
					 <span class="label label-info"> Telepon  : '.$field["phone_number"] .'</span></br>
					 <span class="label label-primary"> Alamat  : '.substr($field["domicile"] ,0,20).'</span></br></div>';
            $row[] = $bussiness.$lastchekin.$id_key;
            $row[] = '<a target="_blank" href="'.base_url().($field['person_img']!='' ? $field['person_img']: 'assets/img/unknown.jpg').'"><img class="lazy"  data-original='.base_url().($field['person_img']!='' ? $field['person_img'] : 'assets/img/unknown.jpg').' style="max-width:200px;max-height:150px;"></a>';
            $row[] = '<a target="_blank" href="'.base_url().($field['idcard_img']!='' ? $field['idcard_img']: 'assets/img/unknown.jpg').'"><img class="lazy"  data-original='.base_url().($field['idcard_img']!='' ? $field['idcard_img'] : 'assets/img/unknown.jpg').' style="max-width:200px;max-height:150px;"></a>';
            $row[] = $ischeckin.'<button class="btn btn-warning waves-effect waves-light btn-sm" data-toggle="modal" data-target=".first-modal" onclick="form_visitor(\''.$field['id_visitor'].'\')" data-target=".modal" type="button" ><i class="fa fa-pencil"></i>Edit</button>
					'.($this->session->userdata('module_access')['vm1']>=0 ?  '<button class="btn btn-danger waves-effect waves-light btn-sm"  onclick="disvis(\''.$field['id_visitor'].'\',\''.$field['name_visitor'].'\')"  type="button" ><i class="fa fa-close"></i>Delete</button>' : '' ).
					 ($this->session->userdata('module_access')['vm1']>5 ?  '<button class="btn btn-info waves-effect waves-light btn-sm"  onclick="setmessage(\''.$field['id_visitor'].'\')"  type="button" ><i class="fa fa-message"></i>force update</button>' : '' ).
					 ($this->session->userdata('module_access')['vm1']>4 ?  '<button class="btn btn-info waves-effect waves-light btn-sm"  onclick="setmessage(\''.$field['id_visitor'].'\')"  type="button" ><i class="fa fa-message"></i>force update</button>' : '' );
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
	
	
	public function serversidetest(){ 
		 $this->db->from('visitor_list');
         print_r ($this->db->count_all_results());
		 
		 $list = $this->visitor_m->get_datatables();
		 print_r ($list->num_rows());
		
	}
	
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
		
	private function dcreqdocument($file){
			    $encoded_data = $file;
				$binary_data = base64_decode($encoded_data);
				$typefile=explode('.',$_POST['document_name']);
				$url = "uploads/visitor/dcreq/".uniqid(rand()).'.'.$typefile[sizeof($typefile)-1];
				$result = file_put_contents( $url, $binary_data);
				if (!$result) die("Could not save image!  Check file permissions.");
				else return $url;
		}
		
		
	
		
	// public function addvisitorkey(){
		// for ($i=371;$i<=550;$i++){
			// $sql="update visitor_key set keterangan='Lantai 8 (Akses Rekanan) ' where nomer='".$i."' and warna='orange'";
			// $this->db->query($sql);
		// }
		
	// }
}
