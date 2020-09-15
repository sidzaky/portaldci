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

class Report extends MX_Controller {

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
		
		////load all data depedencies on this module////
		$this->load->model('report_m');
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
    }

	public function index()
	{	
		$data['content'] = '';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['order'] = $this->order_m->order_active_list();
		$data['con']= $this;
		$this->load->view('template',$data);
	}
	
	
	
}
