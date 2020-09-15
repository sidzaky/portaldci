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

class Login extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
		$this->load->library('session');
		$this->load->library('uuid');
		$this->load->model('login_m');
		$this->load->library('photoupload');
    }

	public function index()
	{	
		if ($this->session->userdata('logged_in')!=1){
				$data['content'] = 'login_v';
				$data['navbar'] = null;
				$data['sidebar'] = null;
				$data['footer'] = null;
				$this->load->view('template', $data); 
			}
		else redirect ('dashboard',refresh);	
	}
	
	public function b(){
		$sql="select * from visitor_log_dc where time_out=''";
		$data=$this->db->query($sql)->result_array();
		print_r ($data);
		
		
	}
	
	
	function validate()
    {
		$email 		= $this->input->post('email');
        $password   = md5($this->input->post('password'));
        $results = $this->login_m->login($email, $password);
        if($results != null)
        {	
			foreach ($results as $result){
				$sessions   = array(
								'user_id'    	=> $result->ID,
								'nama_user'    	=> $result->USERNAME,
								'photo'			=> $result->photo,
								'logged_in'  	=> TRUE,
								'dc_access' 	=> $this->definedcaccess($result->ID),
								'module_access' => $this->definemodule($result->ID)
							);
				$this->session->set_userdata( $sessions);
			}; 
			
			redirect ('dashboard'.$this->session->set_flashdata(array	('heading'	  => 'Hello dude',
																		 'message' => 'Welcome Back '.$this->session->userdata('nama_user'),
																		 'icon'	=> 'info'
																		)											
																	),refresh);
        }
        else
        {	
            redirect('login/index'.$this->session->set_flashdata(array	('heading'	  => 'Warning',
																		 'message' => 'Username/password salah',
																		 'icon'	=> 'error'
																	    )											
																	), refresh);												
        }     
    }
	
	public function authByserver(){
		if ($_SERVER['REMOTE_ADDR']=="172.18.65.19") echo preg_replace( "/\r|\n/", "","http://172.18.133.55/newportalisd/login/speciallogin/".substr($this->uuid->v4(),(rand(2, 4)*(-1)))."PMSreq".substr($this->uuid->v4(),(rand(4, 6)*(-1))));
		else echo 'false';
	}
	
	public function speciallogin($i){
		if ($i!=''){
			$data=($_GET);
			$sessions   = array(
							'user_id'    	=> $data['user_pn'],
							'nama_user'    	=> $data['user_nama'],
							'photo'			=> '',
							'logged_in'  	=> TRUE,
							'module_access' => $this->definemoduleSpeciallogin(),
							'loginauth'		=> 'speciallogin' 
			);
			$this->session->set_userdata($sessions);
			echo true;
		}
		else {
			redirect('login/index'.$this->session->set_flashdata(array	('heading'	  => 'Warning',
																		 'message' => 'Username/password salah',
																		 'icon'	=> 'error'
																	    )											
																	), refresh);
			
		}
		 
	}
	
	
	public function definemoduleSpeciallogin(){
		foreach ($this->login_m->getallpermissionForspeciallogin() as $row){
				$data[$row['id_module']]='1';
		}
		return $data;
	}
	public function definedcaccess($id){
			$z=0;
			foreach ($this->login_m->getdcpermission($id) as $row){
				$data[$z] = array (
					         'id_asset_dc' 	=> $row['id_asset_dc'],
							 'nama_dc' 		=> $row['nama_dc']
							 );
				$z++;
			}
			return $data;
	}
	public function definemodule($id){
			foreach ($this->login_m->getallpermission($id) as $row){
				$data[$row['module']]=$row['access'];
			}
			return $data;
	}

	
	function is_logged_in(){
			$logged_in=$this->session->userdata('logged_in');
			if(!isset($logged_in)  || $logged_in != true)
			{	
				$link = base_url().'login';
				echo '<script>window.location.href = "'.base_url().'";</script>';    
				die();      
			}
	}
	
	function updateuser(){
		$this->load->module('activity');
		$this->load->model('activity_m');
		if ($this->login_m->updateuser_m()){
			$this->session->set_flashdata(array	(	'heading'	  	=> 'Info',
													'message' 		=> 'you just update your profile',
													'icon'			=> 'info'
												)
										);										
			if ($_POST['USERNAME']!='') {
					$this->session->set_userdata(array('nama_user' => $_POST['USERNAME']));
					}
			echo '<script>window.location.href = "'.base_url().'profile";</script>';
		}
	}
	
	
	public function noaccess($data){
		redirect ('dashboard'.$this->session->set_flashdata(array	('heading'	=> 'Warning',
																	 'message' 	=> 'You have No access to '.$data.' module',
																	 'icon'		=> 'error'
																	    )											
																	),refresh);
	}
	
	public function checkpmslan(){
		echo json_encode($this->login_m->checkpmslan_m(), true);
	}
	
	function logout()
	{
        $items = array('user_id','email','logged_in');
		$this->session->unset_userdata($items);
		$this->session->sess_destroy();
        redirect('');
	}
	
}
