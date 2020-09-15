 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ws extends MX_Controller {
	
	
	public function __construct() {
        parent::__construct();
    }
	
	
	public function ceknik(){
		if ($_POST!=null){
			
			$sql = "SELECT a.*,b.*,  c.USERNAME from visitor_schedule_dc a
				inner join visitor_list b on a.id_visitor=b.id_visitor
				left join user c on a.user_input=c.ID
				Where b.active !=0 and approval='1' and   
				b.id_number='".$_POST['nik']."' and 
				range_start<=UNIX_TIMESTAMP(CURDATE()) and 
				range_end>=UNIX_TIMESTAMP(CURDATE())";
			if($this->db->query($sql)->num_rows()==1){
				echo 'true';
				}
			else echo 'false';
		}
		else echo 'false';
	}
	
	public function zz(){
		print_r ($_POST);
		$sql="insert into zz values('".strtotime(date("d M,Y").$_POST."')";
		$this->db->query($sql);
		echo "zzz";
	}
	
	
	
}