<?php

/**
 * @author dzaky hidayat
 * @copyright 2017
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maintenancenonme_m extends CI_Model 
{
	
	public function select_all() {
                $sql = "SELECT A.* , B.HOSTNAME FROM asset_maintenance A 
						left join asset_maintenance_list c on A.ID = c.id_asset_maintenance
						left JOIN asset B ON B.ID = c.id_asset 	
						where A.ME=0 ";
				if ($_POST['ID']!=''){
					$sql .= " and A.ID='".$_POST['ID']."'";
				}
				$sql .= " GROUP BY A.ID order by TIME_INPUT desc"; 
                $result = $this->db->query($sql);
                return $result->result_array();
        }

        public function input_maintenance_m(){
				$_POST['TIME_INPUT']=time();
				$_POST['USER_ID']=$this->session->userdata('user_id');
				$_POST['EVENT_DATE']=strtotime($_POST['EVENT_DATE']);
				$_POST['ME']=0;
                $this->db->insert('asset_maintenance',$_POST);
				$this->activity_m->writelog('Maintenance',"new maintenance Non M/E input");
				return true;
        }

        public function update_maintenance_m(){
                $sql = "UPDATE ASSET_MAINTENANCE SET
									ASSET_ID = '".$_POST['ASSET_ID']."',  
									EVENT_DATE =  '".strtotime($_POST['EVENT_DATE'])."',
									DESCRIPTION =  '".$_POST['DESCRIPTION']."'
                        WHERE ID =  '".$_POST['ID']."'";
                $this->db->query($sql);
				$this->activity_m->writelog('Maintenance',"update maintenance data with id".$_POST['ID']);
				return true;
        }

        public function delete($id){
                $sql = "DELETE FROM ASSET_MAINTENANCE WHERE ID = ?";
                $this->db->query($sql, array($id));
        }

        public function select_by_asset_id($asset_id){
                $sql = "SELECT ID, ASSET_ID, EVENT_DATE, DESCRIPTION, DOCUMENT_PATH FROM ASSET_MAINTENANCE WHERE ASSET_ID = ?";
                $result = $this->db->query($sql, array($asset_id));
                return $result->result_array();
        }

        public function select_by_id($id){
                $sql = "SELECT ID, ASSET_ID, EVENT_DATE, DESCRIPTION, DOCUMENT_PATH FROM ASSET_MAINTENANCE WHERE ID = ?";
                $result = $this->db->query($sql, array($id));
                return $result->row_array();
        }
		
		  public function get_asset_non_me(){
                $sql = "select * from asset where GROUP_ID=6 ";
                $result = $this->db->query($sql);
                return $result->row_array();
        }
		
		public function getmaintenanceasset_file($id){
				$sql="select * from asset_maintenance_file where id_asset_maintenance='".$id."'";
				return  $this->db->query($sql)->result_array();
		}	
		
		public function getmaintenanceasset_list($id){
				$sql="select a.*,b.HOSTNAME from asset_maintenance_list a 
					  left join asset b on a.id_asset=b.ID
					  where a.id_asset_maintenance='".$id."'";
				return  $this->db->query($sql)->result_array();
		}
		
		public function maintenance_delasset_m(){
			$sql="delete from asset_maintenance_list where id_asset_maintenance_list='".$_POST['id_asset_maintenance_list']."'";
			return $this->db->query($sql);
		}	
		
		public function maintenance_addasset_m(){
			$_POST['id_asset_maintenance_list']=substr($this->uuid->v4(),(rand(1, 3)*(-1)))."Inas".substr($this->uuid->v4(),(rand(2, 4)*(-1)));
			$this->db->insert('asset_maintenance_list', $_POST);
		}

		public function upload_document_maintenance_m($data){
			$id_document=substr($this->uuid->v4(),(rand(1, 3)*(-1)))."fi".substr($this->uuid->v4(),(rand(2, 4)*(-1)));
			$sql="insert into asset_maintenance_file values ('".$id_document."',
															 '".$data['id_asset_maintenance']."',
															 '".$data['document']['name']."',
															 '".$data['document']['url']."',
															 'Y'
													  )";
			$this->db->query($sql);
			$this->activity_m->writelog('Maintenance',"new document data with id maintenance".$_POST['ID']);
		}
		
		public function delfile_m($data){
			$this->db->delete('asset_maintenance_file', ($data !=null ? $data : $_POST));
			$this->activity_m->writelog('Maintenance',"delete document data with id maintenance".$_POST['ID']);
			return true;
		}
		
		public function delmaintenance_m(){
			$this->db->delete('asset_maintenance',$_POST);
			$this->activity_m->writelog('Maintenance',"delete maintenance with id maintenance".$_POST['ID']);
			return true;
		}
        public function input_maintenance_asset_report_m(){
                $sql="select b.jenis_nama from asset a
                                left join  asset_jenis b on a.jenis_id=b.jenis_id
                                where a.ID='".$_POST['asset_id']."'
                                ";
                $data=$this->db->query($sql)->result();
                $_POST['time']=time();
                $_POST['user_id']=$this->session->userdata('user')['id'];
                $this->db->insert('maintenance_report_asset_'.$data[0]->jenis_nama, $_POST);
        }

		
	

    //protected $collection_name = 'user';

}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */
