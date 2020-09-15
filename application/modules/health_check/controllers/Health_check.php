<?php 

class Health_check extends MX_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('session');
		$this->config->set_item('sess_expiration',120);
		$this->load->library('uuid');
		$this->load->module('login');
		$this->login->is_logged_in();
		$this->load->module('activity');
		$this->load->model('activity_m');
		
		$this->load->model('Health_check_m');
		$data['breadcrumb'][0] = 'Portal Isd';
		$data['breadcrumb'][1] = 'Health Check';
		$data['headboard'] = 'Health Check Genset';
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
		
    }
	
	public function index() {
		$data['content']='health_check_list';
		$data["health_check"] = $this->Health_check_m->select_all();
		$this->load->view("template", $data); 
	}
	
	public function add(){
		if($this->input->post()){
			echo "ok";
			$month = $this->input->post("month");
			$jenis_test = $this->input->post("jenis_test");
			$oil_g1 = $this->input->post("oil_g1");
			$solar_g1 = $this->input->post("solar_g1");
			$accu_g1 = $this->input->post("accu_g1");
			$oil_g2 = $this->input->post("oil_g2");
			$solar_g2 = $this->input->post("solar_g2");
			$accu_g2 = $this->input->post("accu_g2");
			$oil_g3 = $this->input->post("oil_g3");
			$solar_g3 = $this->input->post("solar_g3");
			$accu_g3 = $this->input->post("accu_g3");
			$oil_g4 = $this->input->post("oil_g4");
			$solar_g4 = $this->input->post("solar_g4");
			$accu_g4 = $this->input->post("accu_g4");
			$accu_pkg = $this->input->post("accu_pkg");
			$keterangan = $this->input->post("keterangan");
			$lampiran = "";
			
			//configuration upload
			$config["upload_path"] = "uploads/health_check/";
			$config["allowed_types"] ="*";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);
			
			// upload dokumen if exist
			if($this->upload->do_upload("lampiran")){
					$file = $this->upload->data();
					$lampiran = $config['upload_path'].$file["file_name"];	
				}
				else{
					$info = array(
							"text" => $this->upload->display_errors(), 
							"class" => "alert-danger");
					$this->session->set_userdata("info", $info);
					redirect("health_check/add");
			}
			

			//	insert 
			$this->load->model("Health_check_m");
			$this->Health_check_m->insert($month, $jenis_test, $oil_g1, $solar_g1, $accu_g1, $oil_g2, $solar_g2, $accu_g2, $oil_g3, $solar_g3, $accu_g3, $oil_g4, $solar_g4, $accu_g4,$accu_pkg,$keterangan, $lampiran);
			redirect("health_check".$this->session->set_flashdata(array	(	'heading'	  => 'Info',
																		 'message' => 'input document berhasil',
																		 'icon'	=> 'info'
																	    )											
																	),refresh);
		}
		
		$data['content']='health_check_form';
		$this->load->view("template", $data);
	}
	
}