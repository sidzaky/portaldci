<?php
/**
*
* author
* @si.dzaky
* info : all about user were here
*
**/
?>
 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maintenance extends MX_Controller {

	public function __construct() {
        parent::__construct();
       
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
		$this->load->model('maintenance_m');
		$data['breadcrumb'][0] = 'Portal Isd';
		$data['breadcrumb'][1] = 'Maintenance Module';
		$data['headboard'] = 'Data Maintenance Asset ';
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
    }

	public function index(){
		if (array_key_exists('maintenance',$this->session->userdata('module_access'))){
			$this->load->model("asset_model");
			$data['con'] = $this;
			$data['content'] = 'maintenance_v';
			$this->load->view('template',$data);
		}
	}
	
	public function showtable(){
		$data['maintenance']=$this->maintenance_m->select_all();
		$data['con'] = $this;
		$this->load->view('maintenance_table_v',$data);
	}
	
	public function input_maintenance(){
		if($_POST==NULL){
			
			$this->load->view('maintenance_form_v', $data);
		} 
		else {
			if ($_POST['ID']==null) $this->maintenance_m->input_maintenance_m();
			else $this->maintenance_m->update_maintenance_m();
			unset($_POST['ID']);
			$this->showtable();
		}
	}
	
	public function delmaintenance(){
		foreach ($this->get_document($_POST['ID']) as $row){
				unlink($row['path_file']);
				$this->maintenance_m->delfile_m($row);
		}
		$this->maintenance_m->delmaintenance_m();
		unset ($_POST['ID']);
		$this->showtable();
		echo '<script>alert ("Delete maintenance done")</script>';
	}
	
	public function get_update_maintenance(){
		$this->load->model("asset_model");
		$data["asset"] = $this->asset_model->select_all();
		$data['data']= $this->maintenance_m->select_all();
		$this->load->view('maintenance_form_v', $data);
	}
	
	public function get_document($id){
		return $this->maintenance_m->getmaintenanceasset_file($id);
	}
	
	public function delfile(){
		$this->maintenance_m->delfile_m();
		unlink($_POST['path_file']);
		unset ($_POST['id_asset_maintenance_document']);
		$this->showtable();
		echo '<script>alert ("Delete log done")</script>';
	}
	
	public function maintenance_addasset(){
		print_r ($_POST);
		$this->maintenance_m->maintenance_addasset_m();
		unset ($_POST['id_asset_maintenance']);
		$this->showtable();
		echo '<script>alert ("add asset maintenance done")</script>';
	}
	
	public function maintenance_delasset(){
		$this->maintenance_m->maintenance_delasset_m();
		$this->showtable();
		echo '<script>alert ("Delete done")</script>';
	}
	
	public function upload_document_maintenance(){
		$data['document']=$this->fileupload();
		$data['id_asset_maintenance']=$_POST['ID'];
		$this->maintenance_m->upload_document_maintenance_m($data);
		unset ($_POST['ID']);
		$this->showtable();
		echo '<script>alert ("upload done")</script>';
	}
	
	
	private function fileupload(){
			    $encoded_data = $_POST['document'];
				$binary_data = base64_decode( $encoded_data );
				$typefile=explode('.',$_POST['name']);
				$name=preg_split("/[^a-z\d\.\(\)\-\_]/i",$_POST['name']);
				$binary_data = base64_decode( $encoded_data );
				$url = "uploads/maintenance/".uniqid(rand()).'.'.$typefile[sizeof($typefile)-1];
				$result = file_put_contents( $url, $binary_data);
				if (!$result) die("Could not save image!  Check file permissions.");
				else return array('url' => $url, 'name' => end($name));
		}
}
