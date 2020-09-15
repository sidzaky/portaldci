<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Document extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
		$this->config->set_item('sess_expiration',120);
		$this->load->library('uuid');
		$this->load->module('login');
		$this->login->is_logged_in();
		$this->load->module('activity');
		$this->load->model('activity_m');
		
		
		$this->load->model('document_m');
		$data['breadcrumb'][0] = 'Portal Isd';
		$data['breadcrumb'][1] = 'Document Module';
		$data['headboard'] = 'Document ISD';
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
		
    }
 
    public function index() {
			if (array_key_exists('doc',$this->session->userdata('module_access'))){
				$data['content']='document_list';
				$data["document"] = $this->document_m->select_all();
				$this->load->view("template", $data); 
			}
			else $this->login->noaccess('Document');
	}

	public function add(){
		if($this->input->post()){
			$name = $this->input->post("name");
			$description = $this->input->post("description");
			$kategori = $this->input->post("kategori");
			$path = "";
			
			//configuration upload
			$config["upload_path"] = "uploads/document/documentsharing/";
			$config["allowed_types"] ="*";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);
			
			// upload document if exist
			if($_FILES["document"]["name"] != ""){
				if($this->upload->do_upload("document")){
					$file = $this->upload->data();
					$path = $config['upload_path'].$file["file_name"];	
				}
				else{
					$info = array(
							"text" => $this->upload->display_errors(), 
							"class" => "alert-danger");
					$this->session->set_userdata("info", $info);
					redirect("document/add");
				}
			}

			//	insert to asset document table
			$this->load->model("document_m");
			$this->document_m->insert($name, $description, $path, $kategori);
			redirect("document".$this->session->set_flashdata(array	(	'heading'	  => 'Info',
																		 'message' => 'input document berhasil',
																		 'icon'	=> 'info'
																	    )											
																	),refresh);
		}
		
		$data['content']='document_form';
		$this->load->view("template", $data);
	}

	public function modify($id){
		$this->load->model("document_m");
		if($this->input->post()){
			$name = $this->input->post("name");
			$description = $this->input->post("description");
			$kategori = $this->input->post("kategori");
			$path = $this->input->post("path_old");
			
			//configuration upload
			$config["upload_path"] = "uploads/document/documentsharing/";
			$config["allowed_types"] ="*";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);
			
			// upload document if exist
			if($_FILES["document"]["name"] != ""){
				if($this->upload->do_upload("document")){
					//	remove old document
					if($path != ""){
						unlink("./".$path);
					}

					// upload new document
					$file = $this->upload->data();
					$path = $config['upload_path'].$file["file_name"];	
				}
				else{
					$info = array(
							"text" => $this->upload->display_errors(), 
							"class" => "alert-danger");
					$this->session->set_userdata("info", $info);
					redirect("document/modify/".$id);
				}
			}
			$this->document_m->update($name, $description, $path, $kategori, $id);
			redirect("document".$this->session->set_flashdata(array	(	'heading'	  => 'Info',
																		 'message' => 'Update document berhasil',
																		 'icon'	=> 'info'
																	    )											
																	),refresh);
		}
		$data["document"] = $this->document_m->select_by_id($id);
		$data["content"] = "document_form_modify";
		$this->load->view("template", $data);
	}

	public function drop($id){
		$this->load->model("document_m");
		$this->document_m->delete($id);
		redirect("document".$this->session->set_flashdata(array	(	'heading'	  => 'Info',
																		 'message' => 'Hapus document berhasil',
																		 'icon'	=> 'info'
																	    )											
																	),refresh);
	}
	
}