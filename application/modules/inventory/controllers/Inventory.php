<?php 

class Inventory extends MX_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('session');
		$this->config->set_item('sess_expiration',120);
		$this->load->library('uuid');
		$this->load->module('login');
		$this->login->is_logged_in();
		$this->load->module('activity');
		$this->load->model('activity_m');
		
		$this->load->model('inventory_m');
		$data['breadcrumb'][0] = 'Portal Isd';
		$data['breadcrumb'][1] = 'Inventory Module';
		$data['headboard'] = 'IT Asset DC';
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
		
    }
	
	public function index() {
		$data['content']='inventory_list';
		$data["inventory"] = $this->inventory_m->select_all();
		$this->load->view("template", $data); 
	}
	
	public function add(){
		if($this->input->post()){
			$jenis = $this->input->post("jenis");
			$tipe = $this->input->post("tipe");
			$sn = $this->input->post("sn");
			$tgl_masuk = $this->input->post("tgl_masuk");
			$pemilik = $this->input->post("pemilik");
			$koordinat = $this->input->post("koordinat");
			$no_unit = $this->input->post("no_unit");
			$lampiran = "";
			
			//configuration upload
			$config["upload_path"] = "uploads/inventory/";
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
					redirect("inventory/add");
			}
			

			//	insert to asset document table
			$this->load->model("inventory_m");
			$this->inventory_m->insert($jenis, $tipe, $sn, $tgl_masuk, $pemilik, $koordinat, $no_unit, $lampiran);
			redirect("inventory".$this->session->set_flashdata(array	(	'heading'	  => 'Info',
																		 'message' => 'input document berhasil',
																		 'icon'	=> 'info'
																	    )											
																	),refresh);
		}
		
		$data['content']='inventory_form';
		$this->load->view("template", $data);
	}
	
	public function modify($id){
		$this->load->model("inventory_m");
		if (isset($_POST)){
			if($this->input->post()){
				$jenis = $this->input->post("jenis");
				$tipe = $this->input->post("tipe");
				$sn = $this->input->post("sn");
				$tgl_masuk = $this->input->post("tgl_masuk");
				$pemilik = $this->input->post("pemilik");
				$koordinat = $this->input->post("koordinat");
				$no_unit = $this->input->post("no_unit");
				$lampiran = $this->input->post("lampiran_old");
				
				if ($lampiran!=''){
					$config["upload_path"] = "uploads/inventory/";
					$config["allowed_types"] ="*";
					$this->load->library("upload", $config);
					$this->upload->initialize($config);
					
					// upload document if exist
					if($this->upload->do_upload("lampiran")){
							//	remove old document
							if($lampiran != ""){
								unlink("./".$lampiran);
							}

					// upload new document
							$file = $this->upload->data();
							$lampiran = $config['upload_path'].$file["file_name"];	
					}
					else{
							
							$info = array(
									"text" => $this->upload->display_errors(), 
									"class" => "alert-danger");
							$this->session->set_userdata("info", $info);
							
					}
				}
				
			$this->inventory_m->update($jenis, $tipe, $sn, $tgl_masuk, $pemilik, $koordinat, $no_unit, $lampiran, $id);
			
			redirect("inventory".$this->session->set_flashdata(array	(	'heading'	  => 'Info',
																		'message' => 'Update document berhasil',
																		'icon'	=> 'info'
																	)											
															  ),refresh);
			
			}
		}
		$data["inventory"] = $this->inventory_m->select_by_id($id);
		$data["content"] = "inventory_form_modify";
		$this->load->view("template", $data);
	}
	
	public function drop($id){
		$this->load->model("inventory_m");
		$this->inventory_m->delete($id);
		redirect("inventory".$this->session->set_flashdata(array	(	'heading'	  => 'Info',
																		 'message' => 'Hapus document berhasil',
																		 'icon'	=> 'info'
																	    )											
																	),refresh);
	}
}
	
	
	
