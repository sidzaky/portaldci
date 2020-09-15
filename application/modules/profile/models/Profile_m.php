<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_m extends CI_Model 
{

	function getprofile(){
		$sql="select * from user a
			  where ID='".$this->session->userdata('user_id')."'";
		return $this->db->query($sql)->result();
		
		
	}
	
}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */