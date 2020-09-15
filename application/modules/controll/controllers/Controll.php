<?php
/**
*
*
* 
*
*
**/
?>
 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controll extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
		/////cek session///////
		$this->load->library('session');
		$this->load->module('login');
		$this->login->is_logged_in();
		//////record every activity/////
		$this->load->module('activity');
		$this->load->model('activity_m');
		
		$this->load->model('controll_m');
		$this->load->library('photoupload');
		$this->load->library('encryption');
		
		$data['navbar'] = 'navbar';
		$data['breadcrumb'][0] = 'Portal Isd';
		$data['breadcrumb'][1] = 'Controll Module Page';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
    }
	
	public function z(){
		print_r ($this->session->all_userdata());
		
	}
	// public function zz(){
		// for ($i=1;$i<=100;$i++){
				// if ($i<10) $nomor='00'.$i;
				// if ($i<100) $nomor='0'.$i;
				// else $nomor=$i;
				// $sql="insert into visitor_vehicle_stiker values('','Mobil','','Mobil ".$nomor."')";
				// $this->db->query($sql);
		// }
	// }
	
	
	// public function zz(){
		// $sql="select  hostname, buy_date,  asset_function, brand,  type, c.name, d.jenis_nama, location, serial_number, specification,   ip_address from asset a
				// left join asset_dc b on a.location_dc=b.id_asset_dc
				// left join asset_group c on c.id=a.group_id
				// left join asset_jenis d on d.jenis_id=a.jenis_id
				// where active='Y' ";
				
			// echo '<table><tbody>';
		// foreach ($this->db->query($sql)->result_array() as $row){
			// echo '<tr>	
					// <td>'.$row['hostname'].'</td>
					// <td>'.$row['buy_date'].'</td>
					// <td>'.$row['asset_function'].'</td>
					// <td>'.$row['brand'].'</td>
					// <td>'.$row['type'].'</td>
					// <td>'.$row['name'].'</td>
					// <td>'.$row['jenis_nama'].'</td>
					// <td>'.$row['location'].'</td>
					// <td>'.$row['serial_number'].'</td>
					// <td>'.$row['specification'].'</td>
					// <td>'.$row['ip_address'].'</td>
				// </td>';
				
			
		// }
		// echo '</tbody></table>';
		
	// }
	
	
	
	public function index()
	{	
		if (array_key_exists('controll1',$this->session->userdata('module_access'))){
			
			$data['content'] = 'controll_v';
			$this->load->view('template',$data);
		}
		else $this->login->noaccess('Controll');
	}
	
	public function input_user(){
			if($_POST==NULL){
				$this->load->view('user_form_v');
			} 
			else {
			
				// print_r($_POST);
				if ($_POST['ID']!='') $this->controll_m->update_user_m();
				else $this->controll_m->input_user_m();
				$_POST='';
				$this->getuserlist();
			}
		
	}
	
	public function getuserlist(){
		$data['user']=$this->controll_m->getuserlist_m();
		$this->load->view('user_list_v',$data);
	}
	
	public function getmoduleaccess($id){
		return  $this->controll_m->getmoduleaccess_m($id);
	}
	
	public function getuserdc($id){
		return  $this->controll_m->getuserdc_m($id);
	}
	
	public function getmoduleportal(){
		return  $this->controll_m->getmoduleportal_m();
	}
	
	public function getmoduledc(){
		return  $this->controll_m->getmoduledc_m();
	}
	
	public function addmoduleaccess(){
		$this->controll_m->addmoduleaccess_m();
		$_POST='';
		$this->getuserlist();
		
	}
	
	public function addmoduledc(){
		$this->controll_m->addmoduledc_m();
		$_POST='';
		$this->getuserlist();
		
	}
	
	public function delmoduleaccess(){
		$this->controll_m->delmoduleaccess_m();
		$_POST='';
		$this->getuserlist();
	}
	
	public function telegramnotif($type,$message,$id){  
				$data = array (	
						'typenotif' => $type,
						'id' => $id,
						'message' => $message
						);
				$data = http_build_query($data);
				$context_options = array (
						'http' => array (
							'method' => 'POST',
							'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
										."Content-Length: ".strlen($data). "\r\n",
							'content' => $data
							)
						); 
				// print_r ($context_options);
				$context = stream_context_create($context_options);
				$fp = file_get_contents('http://localhost:5000/notif', false, $context);
				if ($fp!='') return true;
		}
}
	
	
	
	// public function test(){
		// echo '
		// <script src="/newportalisd/assets/js/jquery.min.js"></script>
		// <div class="col-md-6 col-sm-6 col-xs-12">
										// <input type="text" class="form-control col-md-7 col-xs-12" id="url">
									// </div>
		// <div class="col-md-6 col-sm-6 col-xs-12">
				// <button id="checkin_button" type="button" class="btn btn-success btn-sm" onclick="z(this.value);" ><i class="fa fa-check"></i>Submit</button>
				// </div>
		
		// <script>
		// function z(){
			// var data1={
                           // "username" : "admin",
			   // "password" : "M4Potl0ZZCET2I5AsGrt6w=="

                           // };
			
			// $.ajax({ type:"POST",
				 
			         // url: "http://"+document.getElementById("url").value+":8089/gmkservice/ktpreader/services/bacaChip",
				 // data : data1,
				 // success:function(msg){
					// alert (msg);
					// }
				// });	
			// }
		// </script>
		// ';
		
		
	// }
	
	
	// public function sendtest($url){  
				// $data = array (	
						// 'username' => 'admin',
						// 'password' => 'M4Potl0ZZCET2I5AsGrt6w=='
						// );
				
				// $data = http_build_query($data);
				// $context_options = array (
						// 'http' => array (
							// 'method' => 'POST',
							// 'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
										// ."Content-Length: ".strlen($data). "\r\n",
							// 'content' => $data
							// )
						// ); 
				// // print_r ($context_options);
				// $context = stream_context_create($context_options);
				// $fp = file_get_contents('http://'.$url.':8089/gmkservice/ktpreader/services/bacaChip', false, $context);
				// if ($fp!=''){
					// $fp =(json_decode($fp, true));
					// $fp['datafoto']=base64_encode(hex2bin($fp['datafoto']));
				// }
				// else {
					// $fp['errornumber']='-1';
				// }
				// echo json_encode($fp);
		// }
		
	
		// public function send($url){  
				// $data = array (	
						// 'username' => 'admin',
						// 'password' => 'M4Potl0ZZCET2I5AsGrt6w=='
						// );
				
				// $data = http_build_query($data);
				// $context_options = array (
						// 'http' => array (
							// 'method' => 'POST',
							// 'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
										// ."Content-Length: ".strlen($data). "\r\n",
							// 'content' => $data
							// )
						// ); 
				// // print_r ($context_options);
				// $context = stream_context_create($context_options);
				// $fp = file_get_contents('http://192.168.137.5:8089/gmkservice/ktpreader/services/'.$url, false, $context);
				// if ($fp!=''){
					// $fp =(json_decode($fp, true));
					// $fp['datafoto']=base64_encode(hex2bin($fp['datafoto']));
				// }
				// else {
					// $fp['errornumber']='-1';
				// }
				// echo json_encode($fp);
		// }
		
		
