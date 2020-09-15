<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dailymonitoring extends MX_Controller {

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
		$this->load->model("asset_model");
		
		////load all data depedencies on this module////
		$this->load->model('dailymonitoring_m');
		
		$data['headboard'] = 'Monitoring Manual Perangkat M/E';
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
    }
 
  	public function showdata(){
		$asset=explode(";",$_POST['asset']);
		$theday=strtotime($_POST['date']);
		$thedayafter=$theday+86400;
		
		$sql="select m.*, u.USERNAME from daily_report_asset_".strtolower($asset[1])." m
			  left join user u on u.id=m.user_id
			  where asset_id='".$asset[0]."' and 
					time between '".$theday."' and '".$thedayafter."'";		
		if ($this->db->query($sql)->result()){
			$data['ups']=$this->db->query($sql)->result();
			$this->load->view('view_maintenance_asset_'.$asset[1], $data);
		}
		else echo "error or no data";
	}
	
	public function index() {
			$this->load->model("asset_model");
			$data['breadcrumb'][0] = 'Portal Isd';
			$data['breadcrumb'][1] = 'Monitoring Manual ';
			$data['content']='daily_list';
			$data['asset'] = $this->dailymonitoring_m->getupstest();
			$this->load->view("template", $data);
	}
	
	
	public function ups() {
		if (array_key_exists('dm',$this->session->userdata('module_access'))){	
			$data['breadcrumb'][0] = 'Portal Isd';
			$data['breadcrumb'][1] = 'Monitoring Manual ';
			if ($_POST!=null){
				$data["ups"] = $this->dailymonitoring_m->insertmonitoringups();
				echo '<scrip>alert("input monitoring ups sukses")</script>';
				redirect ('dashboard'.$this->session->set_flashdata(array('heading'	  => 'Input Monitoring UPS ',
																		 'message' => 'Input Monitoring UPS telah berhasil ',
																		 'icon'	=> 'success'
																		)											
																	),refresh);
			}
			else {
				$data["dc"] = $this->dailymonitoring_m->getdatadc(); 
				$data['content']='form_monitoring_template';
				$this->load->view("template", $data);
			}
		}
		else $this->login->noaccess('Dailymonitoring');
	}
	
	public function showformups(){
			$data["ups"] = $this->dailymonitoring_m->getupstest(); 
			$this->load->view("form_monitoring_asset_UPS", $data);
	}
	
	public function trafo() {
			
			if ($_POST!=null){
				$this->data["ups"] = $this->dailymonitoring_m->insertmonitoringups();
				echo '<scrip>alert("input monitoring ups sukses")</script>';
				redirect ('dashboard'.$this->session->set_flashdata(array('heading'	  => 'Input monitoring Trafo 	',
																		 'message' => 'Input Monitoring Trafo telah berhasil',
																		 'icon'	=> 'success'
																		)											
																	),refresh);
				
			}
			else {
				$this->data["ups"] = $this->dailymonitoring_m->gettraffo(); 
				$this->template_data["content"] = $this->load->view("form_monitoring_asset_trafo", $this->data, TRUE);
				$this->load->view("template", $this->template_data);
				
			}
	}
	
	public function setform(){
		$data=array (
				'asset_id' => $_POST['asset_id'],
				'nama_perangkat' => $_POST['nama_perangkat'],
			);
		$this->load->view("form_maintenance_asset_".$_POST["jenis_form"],$data);
	}
	
	
	
}