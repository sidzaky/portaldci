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

class Activity extends MX_Controller {

	public function __construct() {
        parent::__construct();
			
		$this->load->model('Activity_m');	
    }
}
