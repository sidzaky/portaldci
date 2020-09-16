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

class Profile extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
		$this->config->set_item('sess_expiration',120);
		///////cek session///////
		$this->load->library('session');
		$this->load->module('login');
		$this->login->is_logged_in();
		//////record every activity/////
		$this->load->module('activity');
		$this->load->model('activity_m');
		
		
		
		$this->load->model('profile_m');
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
		$this->load->library('photoupload');
    }

	public function index()
	{	
		$data['profile']=json_decode(json_encode($this->profile_m->getprofile()),true)[0];
		$data['content'] = 'profile_v';
		$this->load->view('template',$data);
	}
	
	
	
}
