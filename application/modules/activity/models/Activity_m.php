<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity_m extends CI_Model 
{

	function writelog($module,$log){
		$id_log=substr($this->uuid->v4(),-5)."s".substr($this->uuid->v4(),-5);
		$sql="insert into activity_log 
					 values('".$id_log."',
							'".($this->session->userdata('user_id') != null ? $this->session->userdata('user_id') : $id )."',
							'".$log."',
							'".$module."',
							'".time()."')";
		$this->db->query($sql);
		return true;
	}
	
function getlog(){
	$sql="select a.*, b.USERNAME from activity_log a 
		  left join user b on a.id_user_input=b.ID
		  order by time desc limit 10000
		  ";
	return $this->db->query($sql)->result_array();
}
	
}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */