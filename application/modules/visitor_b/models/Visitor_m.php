<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor_m extends CI_Model {
	
	protected $daytable="from ( select curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as Date
											from (select 0 as a union all select 1 union all select 2 union all select 3 union all 										select 4 union all select 5 union all select 6 union all select 7 union all select 8 										union all select 9) as a
											cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all 													select 4 union all select 5 union all select 6 union all select 7 union all 												 select 8 union all select 9) as b
											cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all 													select 4 union all select 5 union all select 6 union all select 7 union all 												 select 8 union all select 9) as c
								) a ";
	
	public function __construct()
   {
      parent::__construct();
   }
   
	public function get() {
		$sql = "SELECT * from visitor_list where active='1'";
		if ($_POST['id_visitor']!=''){
			$sql .= "  and id_visitor='".$_POST['id_visitor']."'";
		}
		if ($this->session->userdata('module_access')['vm1']<2){
			$sql .= " and user_input='".$this->session->userdata('user_id')."' ";
		}
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	
	public function getVisitorAll(){
		$sql = "SELECT * from visitor_list where active='1'";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function listcompany(){
		$sql = "select DISTINCT(company) from visitor_list where active=1 order by company asc";
		return $this->db->query($sql)->result_array();
	}
	
	public function input_visitor_m(){
		if ($this->cekIdcard_number($_POST['id_number'])==true){
			$time=time();
			$_POST['id_visitor']=substr($this->uuid->v4(),(rand(2, 4)*(-1)))."vis".substr($this->uuid->v4(),(rand(4, 5)*(-1)));
			$_POST['user_input']=$this->session->userdata('user_id');
			$_POST['name_visitor']=strtoupper($_POST['name_visitor']);
			$_POST['company']=strtoupper($_POST['company']);
			$_POST['timeinput']=$time;
			$_POST['latestupdate']=$time;
			$_POST['active']='1';
			$this->db->insert('visitor_list', $_POST);
			$message= json_encode($_POST);
			$this->activity_m->writelog('visitor','input visitor  {'.$message.'}');
			return true;
		}
		else return false;
	}
	
	public function cekIdcard_number($idcek){
		$sql="select id_number from visitor_list where id_number='".$idcek."' and active='1'";
		$query = $this->db->query($sql);
			if($query->num_rows()>0){ 
				return false;
				}
			else{ 
				return true; 
			}
	}
	
	
	public function cekIdcard_number_byupdate($idcek,$idvisitor){
		$sqlcek="select id_visitor from visitor_list where id_number='".$idcek."' and active='1'";
		$datacek=$this->db->query($sqlcek)->result_array();
		
		if(sizeof($datacek)>0){ 
				if ($datacek[0]['id_visitor']==$idvisitor){
						return true;
					}
				else return false;
				}
			else{ 
				return true; 
			}
		
		
	}
	public function update_visitor_m(){
		$message= json_encode ($this->get());
		if ($this->cekIdcard_number_byupdate($_POST['id_number'],$_POST['id_visitor'])==true ){
			if  (isset($_POST['active'])){
					if ($this->db->query('select * from visitor_log_gedung where id_visitor="'.$_POST['id_visitor'].'"  and time_out=""')->num_rows()!=0){
						echo '<script>alert ("visitor masih check in, pastikan sudah checkout terlebih dahulu")</script>';
					}
					else {
						$this->db->query("update visitor_list set active='0',latestupdate='".time()."',userlastupdate='".$this->session->userdata('user_id')."' where id_visitor='".$_POST['id_visitor']."'");
						$this->activity_m->writelog('visitor','set non active visitor where id_visitor is '.$_POST['id_visitor']);
						echo '<script>alert ("visitor berhasil dihapus")</script>';
					}
			}
			else {
				$sql="update visitor_list set ";
				$length=sizeof($_POST);
				$i=2;
				foreach ($_POST as $key => $value){
					if ($value!='' && $key!='id_visitor'){
						$sql .= ($i>!$length && $i!=2 ? " , " : "" ).$key ."='" .($key=='password' ? MD5($value) : $value) ."'";
						$i++;  
					}
				}
				$sql .= ", warning_msg='', latestupdate='".time()."', userlastupdate='".$this->session->userdata('user_id')."' where id_visitor='".$_POST['id_visitor']."'";
				$this->db->query($sql);	
				$message .= '  to   '.json_encode ($this->get());
				$this->activity_m->writelog('visitor','update data visitor '.$message);
				echo '<script>
						alert ("update data visitor sukses");
						$(".modal").modal("hide");
					</script>';
			}
		}
		else echo '<script>alert ("data nomer identitas telah ada, Mohon jangan menambahkan data dengan memaksakan menambah spesial character lainnya agar tidak ada duplikasi data")</script>';
	} 	 
	
	public function checkin_m(){
		if (sizeof($this->visitor_m->checkin_cek_m($_POST['id_visitor']))==0){
			$_POST['id_log_gedung']=substr($this->uuid->v4(),(rand(2, 4)*(-1)))."in".substr($this->uuid->v4(),(rand(4, 5)*(-1)));
			$_POST['time_in']=time();
			$_POST['user_input']=$this->session->userdata('user_id');
			$this->db->insert('visitor_log_gedung', $_POST);
			$sql="update visitor_key set available=0 where id_key='".$_POST['id_key']."'";
			$this->db->query($sql);
			$this->activity_m->writelog('visitor','visitor checkin id_visitor='.$_POST['id_visitor'].' and id_log_gedung='.$_POST['id_log_gedung'].' and id_key'.$_POST['id_key']);
		}
		else echo '<script>alert("sudah checkin sebelumnya")</script>';
	}
	
	public function getlistkey(){
		$sql="select distinct(akses), warna, keterangan from visitor_key group by warna order by id_key asc";
		return $this->db->query($sql)->result_array();	
	}
	
	public function getlistaccess_m(){
		$sql="select distinct(akses), warna, keterangan from visitor_key where id_site_dc='".$_POST['id_site_dc']."' group by akses order by id_key asc";
		return $this->db->query($sql)->result_array();	
	}
	
	public function getavailablekey_m(){
		$sql="select * from visitor_key where warna='".$_POST['warna']."' and available=1 and id_key!=''";
		return $this->db->query($sql)->result_array();	
	}
	
	public function getlistkey_by_akses(){
		$sql="select distinct(akses),warna, keterangan from visitor_key group by akses order by akses asc";
		return $this->db->query($sql)->result_array();	
	}
	
	public function getavailablekey_by_akses_m(){
		$sql="select * from visitor_key where akses='".$_POST['akses']."' and available=1 and id_key!='' order by keterangan desc, nomer asc";
		// $sql="select * from visitor_key where warna='orange' and nomer between '250' and '551' and available=1 and id_key!='' order by keterangan Asc, nomer asc";
		return $this->db->query($sql)->result_array();	
	}
	
	public function checkdatabyname_m(){
		$sql="select name_visitor, company, id_number, domicile from visitor_list where active=1 and name_visitor like '%".$_POST['name_visitor']."%' limit 5";
		return $this->db->query($sql)->result_array();	
	}
	
	public function getdcloc_m($dc=null){
		$sql="select * from asset_dc";
		if ($dc!=null) $sql.=" where id_asset_dc='".$dc."'";
		return $this->db->query($sql)->result_array();	
	}
	
	public function getdcarea_m(){
		$sql="select * from asset_dc_area where id_asset_dc='".$_POST['id_asset_dc']."'";
		return $this->db->query($sql)->result_array();	
	}
	
	public function checkin_cek_m($id){
		$sql="select a.*, b.warna, b.keterangan, b.nomer from visitor_log_gedung a
			 left join visitor_key b on a.id_key=b.id_key
			 where a.id_visitor='".$id."' and a.time_in<>'' and time_out=''";
		return $this->db->query($sql)->result_array();
	}
	
	public function last_checkin_m($id){
			$sql="select a.*, b.warna, b.keterangan, b.nomer from visitor_log_gedung a
				 left join visitor_key b on a.id_key=b.id_key
				 where a.id_visitor='".$id."' 
				 order by time_in desc
				 limit 1"; 
			return $this->db->query($sql)->result_array();
	}
	
	public function checkout_m(){
		$sql="update visitor_log_gedung set time_out='".time()."', user_input_out='".$this->session->userdata('user_id')."' where id_log_gedung='".$_POST['id_log_gedung']."'";
		$this->db->query($sql);
		$sql="update visitor_key set available=1 where id_key='".$_POST['id_key']."'";
		$this->db->query($sql);
		$this->activity_m->writelog('visitor','visitor checkout id_log_gedung='.$_POST['id_log_gedung']);
	}
	
	/////////////////////////////////////Data Center////////////////////////////
	
	////// module request masuk DC/////
	public function getdc($date,$approval,$id) {
		$sql = "SELECT a.*,b.*, c.USERNAME, e.nama_dc, f.keterangan_area, c.BAGIAN, d.USERNAME as user_approval from visitor_schedule_dc a
				inner join visitor_list b on a.id_visitor=b.id_visitor
				left join user c on a.user_input=c.ID
				left join user d on a.user_approval=d.ID
				left join asset_dc e on e.id_asset_dc=a.dc
				left join asset_dc_area f on f.id_asset_dc_area=a.access
				Where b.active !=0 ";
		if ($this->session->userdata('module_access')['vm2']==4) $sql.=" and a.user_input='".$this->session->userdata('user_id')."'";
		$sql .= ($_POST['statusapproval']!='all' ? " and approval='".$_POST['statusapproval']."' and range_end>=UNIX_TIMESTAMP(CURDATE())" : " ");
		if ($date!=null) $sql .= "  and  range_start<'".$date."' and range_end>='".$date."'";
		if ($id !=null) $sql .= " and id_schedule_dc='".$id."'";
		$sql.=" order by time_input desc";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	///////////////////////////////////////////////////////
	
	
	
	public function getdcapproved($date){
		$sql = "SELECT a.*,b.*, d.nama_dc, e.keterangan_area,  c.USERNAME from visitor_schedule_dc a
						inner join visitor_list b on a.id_visitor=b.id_visitor
						left join user c on a.user_input=c.ID
						left join asset_dc d on d.id_asset_dc=a.dc
						left join asset_dc_area e on e.id_asset_dc_area=a.access
				Where 	b.active !=0 and 
						approval='1' and  
						range_start<=UNIX_TIMESTAMP(CURDATE()) and 
						range_end>=UNIX_TIMESTAMP(CURDATE())
				order by a.time_input desc
				";
		return  $this->db->query($sql)->result_array();
	}
	public function dc_checkin_cek_all_m(){
		$sql="	SELECT 	a.*,b.*,  c.USERNAME from visitor_schedule_dc a
				inner join visitor_list b on a.id_visitor=b.id_visitor
				left join user c on a.user_input=c.ID
				left join visitor_log_dc d on d.id_schedule_dc=a.id_schedule_dc
				Where b.active !=0 and approval='1' 
				and d.time_in!='' and d.time_out=''
				and range_end<UNIX_TIMESTAMP(CURDATE())";
		return $this->db->query($sql)->result_array();
	}
	 
	
	
	public function input_scheduledc_m(){
			$z['user_input']=$this->session->userdata('user_id');
			$z['range_start']=strtotime($_POST['range_start']);
			$z['range_end']=strtotime($_POST['range_end']);
			$z['document']=$_POST['document'];
			$z['purpose']=$_POST['purpose'];
			$z['dc']=$_POST['dc'];
			$z['access']=$_POST['access'];
			$name_dc=$this->getdcloc_m($z['dc']);
			$area_dc=$this->db->query("select keterangan_area from asset_dc_area where id_asset_dc_area='".$z['access']."'")->result_array();
			$z['time_input']=time();
			$j=0;
			for ($i=0;$i<count($_POST['visitor']);$i++){
				$z['tools']=$_POST['tools'][$i];
				$z['id_visitor']=$_POST['visitor'][$i];
				$z['id_schedule_dc']=substr($this->uuid->v4(),(rand(2, 5)*(-1))).substr($this->uuid->v4(),(rand(2, 4)*(-1)));
				if ($this->cek_input_scheduledc_m($z['id_visitor'])==true){ ////////membandingkan kalo request sebelumnya udah ada dan masih valid  atou masih berlaku jadi nggk request 2 kali
					$this->db->insert('visitor_schedule_dc', $z);
					$message= json_encode($z);
					$this->activity_m->writelog('visitor','request schedule dc {'.$message.'}');
					$message=$this->db->query("select * from visitor_list where id_visitor='".$z['id_visitor']."'")->result_array();
					$telegramnotif .="\n[".$z['id_schedule_dc']."]=>[".$message[0]['name_visitor']."][".$message[0]['company']."]\n[".$name_dc[0]['nama_dc']." // ".$area_dc[0]['keterangan_area']."]\n[".date('d-M, Y', $z['range_start'])." until ".date('d-M, Y', $z['range_end'])."]\n[".$z['purpose']."]\n[request by ".$this->session->userdata('nama_user')."]\n";
				}
			}
			if ($telegramnotif!='') $this->controll->telegramnotif('group', "DC request is coming tjoy \n\n".$telegramnotif."\n/approve ['id schedule'] [yes||no] [notes] to give permission for this people, but you know the risk, dont you?",'1');
	}
	
	public function cek_input_scheduledc_m($id){
		$sql="select * from visitor_schedule_dc 
			  where id_visitor='".$id."'
			  and range_start<=UNIX_TIMESTAMP(CURDATE()) 
			  and range_end>=UNIX_TIMESTAMP(CURDATE())
			  and (approval=1 or approval='')";
		if ($this->db->query($sql)->num_rows()==0) return true;
		else return false;
	}
	
	
	public function approval_m(){
		$sql="update visitor_schedule_dc 
				set notes='".$_POST['notes']."', 
				approval='".$_POST['approval']."', 
				user_approval='".$this->session->userdata('user_id')."',
				time_approval='".time()."'
				where id_schedule_dc='".$_POST['id_schedule_dc']."'";
		$result = $this->db->query($sql);
		$message= json_encode($_POST);
		$this->activity_m->writelog('visitor','approval result to request schedule dc {'.$message.'}');
	}
	
	public function dc_checkin_m(){
		$_POST['id_log_dc']=substr($this->uuid->v4(),(rand(2, 4)*(-1)))."in".substr($this->uuid->v4(),(rand(4, 5)*(-1)));
		$_POST['time_in']=time();
		$_POST['user_input']=$this->session->userdata('user_id');
		$_POST['nda']='1';
		$this->db->insert('visitor_log_dc', $_POST);
		$this->activity_m->writelog('visitor','visitor checkin on Data Center id_log_dc='.$_POST['id_log_dc'].'');
	}
	
	public function dc_checkin_cek_m($id){
		$sql="select a.id_visitor, b.* from visitor_schedule_dc a
			  left join visitor_log_dc b on b.id_schedule_dc=a.id_schedule_dc
			  where a.id_visitor='".$id."' and b.time_in!='' and b.time_out=''";
		return $this->db->query($sql)->result_array();
	}
	
	
	public function dc_checkout_m(){
		$sql="update visitor_log_dc set time_out='".time()."', user_input_out='".$this->session->userdata('user_id')."' where id_log_dc='".$_POST['id_log_dc']."'";
		$this->db->query($sql);
		$this->activity_m->writelog('visitor','visitor checkout from Data Center id_log_dc='.$_POST['id_log_dc']);
	}
	
	/////////////////////////////////reporttt/////////////////
		public function getnewvisitorbyday($sumary){
			if ($sumary==true) {
					$sql="select a.Date, count(b.timeinput) as newvisitor ";
					$endsql=" group by a.date";
				}
			else { 
				$sql="select a.Date, b.id_number, b.domicile, b.id_visitor, b.name_visitor, b.timeinput, c.USERNAME, b.organic, c.BAGIAN, b.company "; 
				$endsql="";
				if ($this->session->userdata('module_access')['vm1']<=2){
					$where .= " and b.user_input='".$this->session->userdata('user_id')."' ";
					}
				}	 
			$sql.=  $this->daytable."
					left join visitor_list b on a.date=DATE_FORMAT(FROM_UNIXTIME(b.timeinput), '%Y-%m-%e')
					left join user c on b.user_input=c.ID
					where a.Date between '".date("Y-m-d" , (strtotime($_POST['date1'])))."' and  '".date("Y-m-d" , (strtotime($_POST['date2'])))."' 
					".$where." ".$endsql."
					order by a.date desc
				";
			
			return $this->db->query($sql)->result_array();
		}
		
		public function getcheckinvisitorbyday($sumary){
			if ($sumary==true) {
					$sql="select a.Date, count(b.time_in) as checkin_gedung ";
					$endsql="group by a.date";
				}
			else { 
				$sql="select a.Date, f.id_key, f.nomer, f.keterangan, f.akses, f.warna, b.id_log_gedung, b.time_in, b.time_out, c.name_visitor as name,c.organic ,c.company , b.bussiness, d.USERNAME as user_in, e.USERNAME as user_out "; 
				$endsql="";
				if ($this->session->userdata('module_access')['vm1']<=2){
						$where .= " and c.user_input='".$this->session->userdata('user_id')."' ";
					}		
				}	 
			
			$sql.=  $this->daytable."
					left join visitor_log_gedung b on a.date=DATE_FORMAT(FROM_UNIXTIME(b.time_in), '%Y-%m-%e')
					left join visitor_list c on b.id_visitor=c.id_visitor
					left join user d on b.user_input=d.ID
					left join user e on b.user_input_out=e.ID
					left join visitor_key f on f.id_key=b.id_key 
					
					where a.Date between '".date("Y-m-d" , (strtotime($_POST['date1'])))."' and  '".date("Y-m-d" , (strtotime($_POST['date2'])+86359))."' 
					".$where." ".$endsql."
					order by a.date desc
				";
			
			
			
			return $this->db->query($sql)->result_array();
		}
		
		public function getcheckindcbyday($sumary){
			if ($sumary==true) {
					$sql="select a.Date, count(d.time_in) as checkin_dc ";
					$endsql="group by a.date";
				}
			else { 
				$sql="select a.Date, e.purpose, d.id_log_dc, d.time_in, d.time_out, g.USERNAME as user_in, h.USERNAME as user_out, f.name_visitor as name, f.organic, f.company "; 
				$endsql="";
				if ($this->session->userdata('module_access')['vm3']<=4){
					$where .= " and e.user_input='".$this->session->userdata('user_id')."' ";
					}	
				}
			
			
			
			$sql.=  $this->daytable."
					left join visitor_log_dc d on a.date=DATE_FORMAT(FROM_UNIXTIME(d.time_in), '%Y-%m-%e') 
					left join visitor_schedule_dc e on d.id_schedule_dc=e.id_schedule_dc
					left join visitor_list f on f.id_visitor=e.id_visitor
					left join user g on d.user_input=g.ID
					left join user h on d.user_input_out=h.ID
					where a.Date between '".date("Y-m-d" , (strtotime($_POST['date1'])))."' and  '".date("Y-m-d" , (strtotime($_POST['date2'])))."' 
					".$where."  ".$endsql." 
					order by a.date desc
				";
			return $this->db->query($sql)->result_array();
		}
		
		
		public function getallcheckin(){
			$sql="	select a.Date,  b.time_in as checkin_gedung, c.name_visitor, d.time_in as checkin_dc, f.name_visitor ".$this->daytable."
					left join visitor_log_gedung b on a.date=DATE_FORMAT(FROM_UNIXTIME(b.time_in), '%Y-%m-%e') 
					left join visitor_list c on b.id_visitor=c.id_visitor 
					left join visitor_log_dc d on a.date=DATE_FORMAT(FROM_UNIXTIME(d.time_in), '%Y-%m-%e') 
					left join visitor_schedule_dc e on d.id_schedule_dc=e.id_schedule_dc
					left join visitor_list f on f.id_visitor=e.id_visitor
					where a.Date between '".date("Y-m-d" , (strtotime($_POST['date1'])))."' and  '".date("Y-m-d" , (strtotime($_POST['date2'])))."'
					order by a.date desc	
					";
			return $this->db->query($sql)->result_array();
			
			
		}
		
	/////////////////////////////////////////////////////////////// server side and its production now///////
	
	
	public function get_total_inside(){
		$sql="select count(a.id_visitor) from visitor_log_gedung a 
			  left join visitor_list b on a.id_visitor=b.id_visitor
		where a.time_in<>'' and a.time_out='' and b.active='1'";
		return $this->db->query($sql)->result_array();
	}
	
	public function get_total_inside_more_day(){
		$sql="select count(a.id_visitor) from visitor_log_gedung a
				left join visitor_list b on a.id_visitor=b.id_visitor
			where (UNIX_TIMESTAMP(NOW())-a.time_in)>86400 and a.time_in<>'' and a.time_out='' and b.active=1";
		return $this->db->query($sql)->result_array();
	}
	
	var $column_order = array(null, 'name_visitor','timeinput'); //field yang ada di table user
    var $column_search = array('concat(c.warna,c.nomer)','name_visitor','id_number','company','phone_number','b.statuscek'); //field yang diizin untuk pencarian 
    var $order = array('timeinput' => 'asc'); // default order 
 
    function get_datatables()
    {
        $i=0;
		$sql="	select  DISTINCT(a.id_visitor), c.*, a.*, b.statuscek, b.id_log_gedung, b.id_log_gedung, b.bussiness, b.time_in, d.username as user_in, b.time_out from visitor_list a
				left join  (select DISTINCT(id_visitor), IF(time_out = '' AND time_in<>'', IF((UNIX_TIMESTAMP(NOW())-time_in)>86400, ' selama ', ' idkey ' ) , 'nope') as statuscek, id_log_gedung, id_site_dc, bussiness, time_out, user_input, id_key, time_in from visitor_log_gedung GROUP BY id_visitor order by id_visitor desc ) b on a.id_visitor=b.id_visitor
				left join visitor_key c on b.id_key=c.id_key
				left join user d on b.user_input=d.id 
				where a.active='1' ";
				
		if ($this->session->userdata('module_access')['vm1']<2){
			$sql .= " and a.user_input='".$this->session->userdata('user_id')."' ";
		}
			foreach ($this->column_search as $item) // looping awal
			{
				if($_POST['search']['value']!="") // jika datatable mengirimkan pencarian dengan metode POST
					{	
						if($i===0) // looping awal
						{	
							$sql .= 'and ('.$item.' LIKE "%'.$_POST['search']['value'].'%" ESCAPE "!" ';
						}
						else
						{
							$sql .= ' OR '.$item.' LIKE "%'.$_POST['search']['value'].'%" ESCAPE "!" ';
						}
						if(count($this->column_search) - 1 == $i) 
							$sql .= " ) ";
					}
				$i++;
			}
			///////////////////////////////////////// filter by site data center
			
			$sql .=" group by a.id_visitor ";
			/////////////////////////////////////////
			$sql .= " order by b.time_in desc";
				
			// $sql .= "  LIMIT ".($_POST['start']!=0 ? $_POST['start'].', ' : '' )." ". ($_POST['length']!=0 ? $_POST['length'] : '10' );
			// echo $sql;
		
        return $sql;
    }
	
	public function get_datafield(){
		$sql  = $this->get_datatables();
		if($_POST['search']['value']!="" && stripos($_POST['search']['value'],"selama")===FALSE && stripos($_POST['search']['value'],"idkey")===FALSE) {
			$sql .=" limit 100 ";
		}
		else {
			$sql .= "  LIMIT ".($_POST['start']!=0 ? $_POST['start'].', ' : '' )." ". ($_POST['length']!=0 ? $_POST['length'] : '100' );
		}
		return $this->db->query($sql);
		
	}
	
 
    public function count_all()
    {	
		$sql  = $this->get_datatables();
        return  $this->db->query($sql)->num_rows();
    }
	
	
	public function warningmessage_m(){
		$this->db->query('update visitor_list set warning_msg="'.$_POST['warning_msg'].'" where id_visitor="'.$_POST['id_visitor'].'"');
	}
	
	public function get_visitor_vehicle($id){
		return $this->db->query("select * from visitor_vehicle_stiker where id_visitor='".$id."'")->result_array();
	}
	
	public function get_stiker_available(){
		return $this->db->query("select * from visitor_vehicle_stiker where id_visitor=''")->result_array();
		
	}
	
	public function input_visitor_stiker(){
		$sql="update visitor_vehicle_stiker 
					set id_visitor='".$_POST['id_visitor']."', 
					nopol='".$_POST['nopol']."', 
					stnk='".$_POST['stnk']."'
					where nomor_stiker='".$_POST['nomor_stiker']."'";
		$this->db->query($sql);
	}
	
	public function del_visitor_stiker_m(){
		$sql="update visitor_vehicle_stiker set 
					id_visitor='',
					nopol='',
					stnk=''
				where nomor_stiker='".$_POST['nomor_stiker']."'";
		$this->db->query($sql);
	}
	
	 // function get_datatables_test()
    // {	
		// $this->db->save_queries = TRUE;
        // $query = $this->db->query($this->zzzzz());
        // return $query->result_array();
    // }
	
	// public function zzzzz(){
		// $i=0;
		// $sql="select DISTINCT(a.id_visitor), c.*, a.*, b.time_in, b.time_out from visitor_list a
				// left join visitor_log_gedung b on a.id_visitor=b.id_visitor
				// left join visitor_key c on b.id_key=c.id_key
				// where a.active='1' ";
			// foreach ($this->column_search as $item) // looping awal
			// {
				// if($_POST['search']['value']!="") // jika datatable mengirimkan pencarian dengan metode POST
					// {
						// if($i===0) // looping awal
						// {	
							// $sql .= 'and ('.$item.' LIKE "%'.$_POST['search']['value'].'%" ESCAPE "!" ';
						// }
						// else
						// {
							// $sql .= ' OR '.$item.' LIKE "%'.$_POST['search']['value'].'%" ESCAPE "!" ';
						// }
						// if(count($this->column_search) - 1 == $i) 
							// $sql .= " )";
					// }
				// $i++;
			// }
			// $sql .=" group by a.id_visitor ";
			 // if(isset($_POST['order'])) 
				// {
					// $sql .= " order by ".$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'];
				// } 
			// else {
					// $sql .= " order by a.timeinput asc ";
				// }
				
			// $sql .= "  LIMIT ".($_POST['start']!=0 ? $_POST['start'].', ' : '' )." ". $_POST['length'];
			// return $sql;
		// }
		
	
	// private function _get_datatables_query_test()
    // {
        // $this->db->from('visitor_list');
        // $i = 0;
		
		// $where = " active='1'";
		// if ($this->session->userdata('module_access')['vm1']<2){
			// $where .= " and user_input='".$this->session->userdata('user_id')."'";
		// }
		// $this->db->where($where);
		
        // foreach ($this->column_search as $item) // looping awal
        // {
            // if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            // {
                // if($i===0) // looping awal
                // {	$this->db->group_start(); 
                    // $this->db->like($item, $_POST['search']['value']);
                // }
                // else
                // {
                    // $this->db->or_like($item, $_POST['search']['value']);
                // }
                // if(count($this->column_search) - 1 == $i) 
                    // $this->db->group_end(); 
            // }
            // $i++;
        // }
        // if(isset($_POST['order'])) 
        // {
            // $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        // } 
        // else if(isset($this->order))
        // {
            // $order = $this->order;
            // $this->db->order_by(key($order), $order[key($order)]);
        // }
    // }
	
	//////////////////query the often people/////////////////////////////////////
	// select DISTINCT(a.id_schedule_dc), d.name_visitor, d.company, count(b.id_log_dc) from visitor_log_dc a
	// left join (select id_schedule_dc, id_log_dc from visitor_log_dc) b on a.id_schedule_dc=b.id_schedule_dc
	// left join visitor_schedule_dc c on a.id_schedule_dc=c.id_schedule_dc
	// left join visitor_list d on c.id_visitor=d.id_visitor
	// GROUP BY d.id_visitor
	// order by d.name_visitor asc
	//////////////////////////////////////////////////////////////////////////////
	
	
}
