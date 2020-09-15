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

class Instro extends MX_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper(array('url','form','html'));
		
		////load all library and necessary module////
		$this->load->library('session');
		$this->config->set_item('sess_expiration',120);
		$this->load->library('uuid');
		$this->load->module('login');
		$this->login->is_logged_in();
		$this->load->module('activity');
		$this->load->model('activity_m');
		
		$this->load->module('asset');
		$this->load->model('asset_model');
		
		////load all data depedencies on this module////
		$this->load->model('instro_m');
		$data['breadcrumb'][0] = 'Portal Isd';
		$data['breadcrumb'][1] = 'Insident / Trouble Module';
		$data['headboard'] = 'Insident/Trouble Module';
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
    }

	public function index() {
		if (array_key_exists('instro',$this->session->userdata('module_access'))){
			$data["instro"] = $this->instro_m->select_all();
			$data['content'] = 'instro_v';
			$this->load->view('template',$data);
			}
		else $this->login->noaccess('Insident Trouble Management');
	}
	
	
	public function showtable(){
		$data['instro']=$this->instro_m->select_all();
		$data['con'] = $this;
		$this->load->view('instro_table_v',$data);
		
	}
	
	public function input_instro(){
		if($_POST==NULL){
			$this->load->model("asset_model");
			$data["asset"] = $this->asset_model->select_all();
			$this->load->view('instro_form_v', $data);
		} 
		else {
			if ($_POST['id_instro']==null) $this->instro_m->input_instro_m();
			else $this->instro_m->update_instro_m();
			unset($_POST['id_instro']);
			$this->showtable();
		}
	}
	
	
	
	public function get_update_instro(){
		$data['data']= $this->instro_m->select_all();
		$this->load->model("asset_model");
		$data["asset"] = $this->asset_model->select_all();
		$this->load->view('instro_form_v', $data);
	}
	
	
	public function upload_document_instro(){
		$data['document']=$this->fileupload();
		// print_r ($data);
		$data['id_instro']=$_POST['id_instro'];
		$this->instro_m->upload_document_instro_m($data);
		unset ($_POST['id_instro']);
		$this->showtable();
		echo '<script>alert ("upload done")</script>';
	}
	
	public function instroaddasset(){
		$this->instro_m->instroaddasset_m();
		unset ($_POST['id_instro_log']);
		$this->showtable();
		echo '<script>alert ("add asset impact done")</script>';
	}
	
	public function get_document($id){
		return $this->instro_m->get_document_m($id);
	}
	public function get_instroasset($id){
		return $this->instro_m->get_instroasset_m($id);
	}
	
	public function disable_instro_log(){
		$this->instro_m->disable_instro_log_m();
		unset ($_POST['id_instro']);
		$this->showtable();
		echo '<script>alert ("Delete log done")</script>';
	}
	
	public function getasset(){
		$this->load->model("asset_model");
		$data["asset"] = $this->asset_model->select_all();
		$this->load->view('asset_list_select',$data);
	}
	
	public function disablefile(){
		$this->instro_m->disable_document_instro_m();
		// unlink ($_POST['document_SIK']);
		$this->showtable();
		echo '<script>alert ("Delete done")</script>';
	}
	public function deleteassetlog(){
		$this->instro_m->deleteassetlog_m();
		$this->showtable();
		echo '<script>alert ("Delete done")</script>';
	}
	
	
	/////////////////////////////////////////report//////////////////////////////
	
	public function report(){
		if (array_key_exists('instro',$this->session->userdata('module_access'))){
			if ($this->session->userdata('module_access')['instro']>=2){
				$data["content"] = "instro_report_v";
				$data['scriptoptional']="instro_report.js";
				$data['headboard'] = 'Report Insident / Trouble';
				$data['breadcrumb'][0] = 'Portal Isd';
				$data['breadcrumb'][1] = 'Report Insident / Trouble  module';
				$this->load->view("template", $data);
			}
			else $this->login->noaccess('Report Insident/Trouble report');
		}
		else $this->login->noaccess('Report Insident/Trouble report');
	}
	
	
	public function getsummary(){
	
		$data['report_by_asset']['text']='<table class="tile_info">';
		$i=0;
		foreach ($this->instro_m->report_by_asset() as $row){
			$data['report_by_asset']['label'][$i]=$row['label'];
			$data['report_by_asset']['data'][$i]=$row['data'];
			$data['report_by_asset']['backgroundColor'][$i]='rgba('.rand(0, 254).', '.rand(0, 254).', '.rand(0, 254).', 1)';
			$data['report_by_asset']['text'].='
					<tr>
						<td><a href="" class="tr" onclick="dettimetarikan('.$data['report_by_asset']['label'][$i].');">
							<p><i class="fa fa-square "  style="color : '.$data['report_by_asset']['backgroundColor'][$i].';" ></i>
								'.$data['report_by_asset']['label'][$i].'</p>
							</a>
						</td>
						<td width="20px">'.$data['report_by_asset']['data'][$i].'</td>
					</tr>';
			$i++;
		}
		$i=0;
		$data['pending_instro']['text']='<table class="tile_info">';
		foreach ($this->instro_m->report_by_asset(true) as $row){
			$data['pending_instro']['label'][$i]=$row['label'];
			$data['pending_instro']['data'][$i]=floor(((time()-$row['time_start_instro'])/3600)/24);
			$data['pending_instro']['backgroundColor'][$i]='rgba('.rand(0, 254).', '.rand(0, 254).', '.rand(0, 254).', 1)';
			$data['pending_instro']['text'].='<tr>
						<td><a href="" class="tr" onclick="dettimetarikan('.$data['pending_instro']['label'][$i].');">
							<p><i class="fa fa-square "  style="color : '.$data['pending_instro']['backgroundColor'][$i].';" ></i>
								'.$data['pending_instro']['label'][$i].' </p>
							</a>
						</td>
						<td width="20px">'.$data['pending_instro']['data'][$i].' days</td>
					</tr>';
			$i++;
		}
		$i=0;
		$data['solved_time']['text']='<table class="tile_info">';
		$data['solved_time']=$this->instro_m->time_solved_instro();
		for ($i=0;$i<sizeof($data['solved_time']);$i++){
			$data['solved_time'][$i]['backgroundColor']='rgba('.rand(0, 254).', '.rand(0, 254).', '.rand(0, 254).', 1)';
		}
		echo json_encode($data);
	}
	
	
	
	/////////////////////////////////////////////////////////////////////////////
	
	private function fileupload(){
			    $encoded_data = $_POST['document'];
				$binary_data = base64_decode( $encoded_data );
				$typefile=explode('.',$_POST['name']);
				$name=preg_split("/[^a-z\d\.\(\)\-\_]/i",$_POST['name']);
				$binary_data = base64_decode( $encoded_data );
				$url = "uploads/document/instro/".uniqid(rand()).'.'.$typefile[sizeof($typefile)-1];
				$result = file_put_contents( $url, $binary_data);
				if (!$result) die("Could not save image!  Check file permissions.");
				else return array('url' => $url, 'name' => end($name));
		}
	
	
	
}
