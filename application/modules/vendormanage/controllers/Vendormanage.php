<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vendormanage extends MX_Controller
{
	var $data;
	var $dataparent;
    public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library('uuid','form_validation');
		$this->load->module('login');
		$this->load->module('controll');
		$data['notification']=$this->login->is_logged_in();
		$this->load->library('photoupload');
		
		$this->load->module('activity');
		$this->load->model('activity_m');
		//////importan things////
		$this->load->model('M_data_vendor','fdb');
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
		
		if (!array_key_exists('vendor',$this->session->userdata('module_access'))){			
			$this->login->noaccess('Vendor Management`');
		}
    }
	
	
	
	
    public function index()
    {
		$this->lists();
    }

    public function action($func = '', $id = 0)
    {
       
            $trimfunc = trim($func);
            if (!empty($trimfunc)) {
                if (!empty($id)) {
                    $this->$func($id);
                } else if (empty($id)) {
                    $this->$func();
                }
            } 
    }

    public function lists()
    {	
		$data['headboard'] = 'Vendor Management';
		$data['breadcrumb'][0] = 'Portal Isd';
		$data['breadcrumb'][1] = 'Vendor Management System';
        $data['content'] = 'data_vendor_list';
        $data['vendor']  = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add($re=null)
    {
        if ($this->input->post()) {
            $post = $this->input->post();
            $post['vendor_begindate'] = date("Y-m-d", strtotime($post['vendor_begindate']));
            $post['vendor_enddate']   = date("Y-m-d", strtotime($post['vendor_enddate']));
            $post['status']           = "baru";

            $spknew = str_replace("/", "_", $post['spk_nmr']);

            $fileName = $post['vendor_begindate']."-".$spknew."-".uniqid();
            $config['upload_path'] = 'uploads/spk/'; //buat folder dengan nama uploads di root folder
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 99999999999999;
             
            $this->load->library('upload');
            $this->upload->initialize($config);
             
            if(! $this->upload->do_upload('vendor_dokumen') ){
				$error = array('error' => $this->upload->display_errors());
				$data = array('upload_data' => $this->upload->data('vendor_dokumen'));
				echo var_dump($error);exit;
			}
			else{
				$data = array('upload_data' => $this->upload->data('vendor_dokumen'));
				if($data){
					$post['vendor_dokumen'] = 'uploads/spk/'. $fileName.".pdf";
					if ($this->fdb->cek_unique_update($post['spk_nmr'], $key->vendor_id)>0){
							echo '<script>alert("nomor SPK sudah ada, coba isi yang benar");window.location="'.base_url().'vendormanage";</script>';
						}
					else {
							$data['vendor_id'] = $this->fdb->add($post);
							redirect('vendormanage');
						}
					}
				
			}
        }
        
		else {
			$data['title']   = 'Data Vendor';
			$data['active']  = 'data vendor';
			$this->fitur     = 'Tambah';
			$data['content'] = 'data_vendor_form';
			if ($re!=null)  $data['re']= $this->fdb->get_row($re);
			$data['plugins'] = array('daterangepicker');
			$data['vendor_nama']=$this->fdb->get_vendor_nama_m();
			$this->load->view('template', $data);
		}
    }

    protected function edit($vendor_id = '')
    {
        if ($this->input->post()) {
			if ($this->input->post('status')!='diperpanjang'){
				$post      = $this->input->post();
				$vendor_id = $post['vendor_id'];
				$post['vendor_begindate'] = date("Y-m-d", strtotime($post['vendor_begindate']));
				$post['vendor_enddate']   = date("Y-m-d", strtotime($post['vendor_enddate']));
				if(isset($post['yesno'])){
						$spknew = str_replace("/", "_", $post['spk_nmr']);
						$fileName = $post['vendor_begindate']."-".$spknew."-".uniqid();
						$config['upload_path'] = 'uploads/spk/'; //buat folder dengan nama uploads di root folder
						$config['file_name'] = $fileName;
						$config['allowed_types'] = 'pdf';
						$config['max_size'] = 99999999999999;
						$this->load->library('upload');
						$this->upload->initialize($config);
						 
						if(! $this->upload->do_upload('vendor_dokumen') ){
							$error = array('error' => $this->upload->display_errors());
							$data = array('upload_data' => $this->upload->data('vendor_dokumen'));
							echo var_dump($error);exit;
						}
						else{
							$data = array('upload_data' => $this->upload->data('vendor_dokumen'));
						}
					}
				else{
					unset($post['vendor_dokumen']);
					unset($post['yesno']);
				}
				$cekspk =$this->fdb->get_row($vendor_id);
				
				if($cekspk[0]['spk_nmr'] == $post['spk_nmr']){
					$this->fdb->update($vendor_id,$post);
					echo '<script> alert ("Ubah SPK vendor  '.$post['vendor_nama'].' dengan projek '.$post['nama_projek'].' Sukses.");window.location="'.base_url().'vendormanage";</script>';
				}
				else {
						if ($this->fdb->cek_no_spk_from_update($post['spk_nmr'])>0){
							 echo '<script> alert ("Tambah kontrak Gagal. nomor `{'.$post['spk_nmr'].'}` telah diambil.");window.location="'.base_url().'vendormanage";</script>';	
							}
						else {
							$data['vendor_id'] = $this->fdb->update($vendor_id,$post);
							redirect('vendormanage');
						}
					}
			}
			else $this->add();
        }
		else {
			$data['headboard'] = 'Vendor Management';
			$data['breadcrumb'][0] = 'Portal Isd';
			$data['breadcrumb'][1] = 'Vendor Management System';
			$data['content'] = 'data_vendor_form';
			$this->fitur     = 'Ubah';
			$data['vendor_nama']=$this->fdb->get_vendor_nama_m();
			
			$data['vendor_detail']= $this->fdb->get_row($vendor_id)[0];
			if ($data['vendor_detail']['vendor_parent']!=null) {
				$this->parentcheck($data['vendor_detail']['vendor_parent']);
				$data['parent']	 = $this->dataparent;
			}
			$this->load->view('template', $data);
		}
    }

    protected function view($vendor_id = '')
    {
		$data['headboard'] = 'Vendor Management';
		$data['breadcrumb'][0] = 'Portal Isd';
		$data['breadcrumb'][1] = 'Vendor Management System \ Data View';
        $this->fitur           = 'Lihat';
        $data['vendor_detail'] = $this->fdb->get_row($vendor_id)[0];
        $data['content'] = 'data_vendor_form';
		if ($data['vendor_detail']['vendor_parent']!=null) {
			$this->parentcheck($data['vendor_detail']['vendor_parent']);
			$data['parent']	 = $this->dataparent;
		}
		$data['parent']	 = $this->dataparent;
        $data['plugins'] = array('popconfirm');
        $this->load->view('template', $data);
    }

    protected function delete($vendor_id = 0)
    {
        $vendor = $this->fdb->get_row($vendor_id);
        $result = $this->fdb->delete($vendor_id);
        if ($result) {
           
            echo '<script> alert ("Hapus Vendor  '.$vendor->spk_nmr.' Sukses."</script>';
        } else {
            echo '<script> alert (""Hapus  Vendor  '.$vendor->spk_nmr.' Gagal.")</script>';
        }
        redirect('vendormanage');
    }

    public function get_allprojek(){
        $kode=$this->input->post('kode',TRUE);
        $query=$this->fdb->get_projek($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_projek;
        echo json_encode($json_array);      
    }

    public function get_allvendor(){
        $kode=$this->input->post('kode',TRUE);
        $query=$this->fdb->get_vendor($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->vendor_nama;
        echo json_encode($json_array);      
    }


    public function upload_file()
    {
        $data['title']   = 'Data Vendor';
        $data['active']  = 'data vendor';
        $this->fitur     = 'Upload';
        $data['content'] = 'data_vendor_form_upload';
        $data['plugins'] = array('');

        $this->load->view('template', $data);
    }

    public function upload(){
        $fileName = date("Y-m-d")."-".$_FILES['file']['name'];
         
        $config['upload_path'] = './uploads/'; //buat folder dengan nama uploads di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'csv|xls';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') ){
           writelog('error', "upload gagal");
            flash_err("upload gagal. file harus CSV"); 
            redirect($this->cname.'/upload_file');
        }
        
       
        
             
        $media = $this->upload->data('file');

        
        $inputFileName = './uploads/'.$fileName;
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "spk_nmr"=> (string)$rowData[0][0],
                    "vendor_nama"=> (string)$rowData[0][1],
                    "vendor_begindate"=> (string)$rowData[0][2],
                    "vendor_enddate"=> (string)$rowData[0][3],
                    "vendor_tugas"=> (string)$rowData[0][4],
                    "status"=> (string)$rowData[0][5],
                    "nilai_kontrak"=> (string)$rowData[0][6]
                );

               
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->fdb->add($data);
                delete_files($media['file_path']);
                if ($insert) {
                    writelog('success', "upload Sukses.");
                    flash_succ("upload Sukses.");
                } else {
                    writelog('error', "Upload Gagal.");
                    flash_err("Upload Gagal.");
                }
                     
            }
        writelog('succes', "upload sukses");
        flash_succ("upload sukses"); 
        redirect($this->cname);
    }
	public function parentcheck($id, $dataresult=null){
		$result=$this->fdb->getparent_m($id);
		$this->dataparent[]=$result[0];
		if ($result[0]['vendor_parent'] != '') {
			$this->parentcheck($result[0]['vendor_parent'], $dataresult);
		}	
	}
	
	
}
