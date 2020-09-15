<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Cam extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->module('login');
        $this->login->is_logged_in();
    }
 
    public function index($set)
    {
		$data['element']=$set;
		$this->load->view('cam_v',$data);
		
    }
	
	
	// public function comp(){
		// $sql="select person_img, idcard_img from visitor_list
			  // where person_img!='' or idcard_img!=''";
		
		// $data=$this->db->query($sql)->result_array();
		// $i=0;
		// foreach ($data as $row){
				// $img = imagecreatefromjpeg($row['person_img']);  
				// imagejpeg($img,$row['person_img'].'_t',10);
				// $img = imagecreatefromjpeg($row['idcard_img']);  
				// imagejpeg($img,$row['idcard_img'].'_t',10);
				// echo $i;
				// $i++;
		// }
	// }
}