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

class Dashboard extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
		// $this->config->set_item('sess_expiration',120);
		$this->load->library('session');
		$this->load->module('login');
		$data['notification']=$this->login->is_logged_in();
		$this->load->library('photoupload');
		
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['con']=$this;
		$this->load->vars($data);
    }

	public function index()
	{	
		
		$data['content'] = 'dashboard_v';
		$data['headboard'] = 'Guardian Of The Data Center';
		$data['breadcrumb'][0] = 'Portal Isd';
		$data['breadcrumb'][1] = '';
		
		
		$this->load->module('visitor');
		$this->load->model('visitor_m');
		$_POST['statusapproval']='all';
		$data['dc_approved']=$this->visitor_m->getdc();
		
		
		$this->load->module('pmslan');
		$this->load->model('pmslan_m');
		$_POST['date2']=date("m/d/y", time());
		$_POST['date1']=("01/01/".date("y"));
		$data['pms_lan']=$this->pmslan_m->summary();
		$data['instro']=$this->db->query('select * from instro_log ');
		$this->load->view('template',$data);
	}
	
	public function getstatuspac(){
		echo stream_get_contents(fopen('http://10.101.10.102/getdatapac.php', "rb")); 
		
	}
	
	
	
}
