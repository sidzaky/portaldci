<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_m extends CI_Model 
{
		
		public function order_active_list(){
			$sql="select a.id_order, a.order_type, a.id_product, 
						 a.order_date, a.deadline, a.jumlah_ret_sup,
						 a.jumlah_product_sup, a.jumlah_order_retailer, a.status, 
						 b.nama_product as retailer_product, 
						 c.nama_product as suplier_product,
						 d.so_nama, 
						 e.nama_kota
					from gs_order a
					left join gs_product_ret b on a.id_product=b.id_product
					left join gs_product_sup c on a.id_product=c.id_product
					left join gs_salesofficer d on a.id_so=d.id_so_nik
					left join gs_kota e on a.id_region=e.id_kota ";
			$sql.=" where a.id_user='".$this->session->userdata("user_id")."'";
			return $this->db->query($sql)->result();
		}
    
	


}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */