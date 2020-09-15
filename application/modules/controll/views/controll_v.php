  
  

  
            <div class="container-fluid" id="profilev">
			<!-- ---------------  profilee  -------------------- -->
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Controll Module</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><?php echo  $breadcrumb[0] ?></li>
                            <li class="active"><?php echo $breadcrumb[1] ?></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    
			<!-- ---------------  Activity  -------------------- -->	
					<div class="col-md-12 col-xs-12">
                        <div class="white-box">
                            <ul class="nav nav-tabs tabs customtab">
                               
                                <li class="tab">
                                    <a href="#home" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Log user</span> </a>
                                </li>
                                <li class="tab active">
                                    <a href="#profile" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">List User</span> </a>
                                </li>
                                <li class="tab">
                                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Module Menu</span> </a>
                                </li>
								 <li class="tab">
									<button type="button" class="btn btn-success waves-effect waves-light" onclick="form_user();" data-toggle="modal" data-target=".second-modal">Tambah user</button>
								</li>
                            </ul>
                           
			
						   <div class="tab-content">
                                <div class="tab-pane" id="home">
                                    <div class="useractivity">
									<table id="example" class="table table-striped">
											<thead>
												  <tr>
													<th>No</th>
													<th>Nama</th>
													<th>activity</th>
													<th>time</th>
												  </tr>
											</thead>
											<tbody>
												<?php  
													$i=1;
													if ($this->session->userdata('module_access')['controll1']>=5){														
														foreach ($con->activity_m->getlog() as $datalog){
															echo '	<tr>
																		<td>'.$i++.'</td>
																		<td>'.$datalog['USERNAME'].'</td>
																		<td><textarea rows="4" cols="50" class="form-controll" disabled>'.$datalog['activity'].'</textarea></td>
																		<td>'.date('H:i:s dM-Y', $datalog['time']).'</td>
																	</tr>';
															
															} 
														}
													else echo 'you have no access to here';
													
													?>
											
											</tbody>
										</table>
									</div>	
                                </div>
								<!-- ---------------  USER LIST  -------------------- -->	
                                <div class="tab-pane active" id="profile">
                                    <div class="row">
										<div id="userlist">
											<?php  $con->getuserlist();?>
										</div>
									</div>
                                </div>
								
								<!-- ---------------  other  -------------------- -->	
                                <div class="tab-pane" id="settings">
                                   
                                </div>
						   </div>
                        </div>
                    </div>
                </div>
            </div>
			
<div class="second-modal fade modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form User</h4>
			</div>
			<div id="second-blank_content" class="modal-body">
				<form class="form-horizontal form-material" id="loginform" action="#">
						<h3 class="box-title m-b-20"></h3>
							<div class="form-group ">
							<label class="col-md-6">Pilih Data Center</label>
							  <div class="col-xs-12">
								<select id="id_asset_dc" class="form-control" onchange="fdetailmodule(this.options[this.selectedIndex].getAttribute('detailtag'));">
									<option> -----pilih-----</option>
									<?php 
										foreach ($con->getmoduledc() as $row){
											if($row['id_module']=='controll1') {
												echo ($this->session->userdata('module_access')['controll1']>=17 ? '<option value="'.$row['id_module'].'" detailtag="'.$row['detail'].'"> '.$row['module_name'].'</option>' : '');
											}
											else {
												echo '<option value="'.$row['id_asset_dc'].'" detailtag="'.$row['alamat_dc'].'"> '.$row['nama_dc'].'</option>';
											}
										}
									?>
									</select>
							  </div>
							</div>
							<div class="form-group ">
							<label class="col-md-6"></label>
								  <div class="col-xs-12">
									 <button type="button" class="btn btn-success btn-sm" onclick="addmoduledc();" ><i class="fa fa-check"></i>Submit</button>
								</div>
							</div>
					</div>
			</div>
		</div>
	</div>
</div>			
			
	<div class="first-modal fade modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
					</button>
					<h4 class="modal-title" id="myModalLabel2">Form </h4>
				</div>
				<div id="blank_content" class="modal-body">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
						<form class="form-horizontal form-material" id="loginform" action="#">
							<h3 class="box-title m-b-20"></h3>
								<div class="form-group ">
								<label class="col-md-6">Pilih Module</label>
								  <div class="col-xs-12">
									<select id="id_module" class="form-control" onchange="fdetailmodule(this.options[this.selectedIndex].getAttribute('detailtag'));">
										<option> -----pilih-----</option>
										<?php 
											foreach ($con->getmoduleportal() as $row){
												if($row['id_module']=='controll1') {
													echo ($this->session->userdata('module_access')['controll1']>=17 ? '<option value="'.$row['id_module'].'" detailtag="'.$row['detail'].'"> '.$row['module_name'].'</option>' : '');
												}
												else {
													echo '<option value="'.$row['id_module'].'" detailtag="'.$row['detail'].'"> '.$row['module_name'].'</option>';
												}
											}
										?>
										</select>
								  </div>
								</div>
								<div class="form-group ">
								<label class="col-md-6">Access</label>
									  <div class="col-xs-12">
										<input type="number" class="form-control" id="access">
									</div>
								</div>
								<div class="form-group ">
								<label class="col-md-6"></label>
									  <div class="col-xs-12">
										 <button type="button" class="btn btn-success btn-sm" onclick="addmodulaccess();" ><i class="fa fa-check"></i>Submit</button>
									</div>
								</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12>">
							
							<form class="form-horizontal form-material" id="loginform" action="#">
							<h3 class="box-title m-b-20"></h3>
								<div class="form-group ">
								<label class="col-md-12">Detail Module<label>
									<div class="col-xs-12">
									</div>
								</div>
								<div class="form-group ">
									<div class="col-xs-12">
										<div id="detailmodule">
											
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
							
							
				</div>
			</div>
		</div>
	</div>


<script>
			
			$('form').on('submit', function(e){
				e.preventDefault();
			});
			
			
			function fdetailmodule(i){
				document.getElementById('detailmodule').innerHTML=i;				
			}
			
			function form_user(i){
						if (i==null){
							var address="<?php echo base_url();?>controll/input_user";
							var data1=null;
						}
						else{ 
							var address="<?php echo base_url();?>controll/update_user";
							var data1= {
										'id_instro' :  i,
									};
							}
						var element='second-blank_content';
						sendajax(data1,address,element,null,null);
					}
					
			function input_user(){	
				var data1 = { 
									'ID' :  $('#ID').val(),
									'USERNAME' :  $('#USERNAME').val(),
									'PASSWORD' :  $('#PASSWORD').val(),
									'USER_TYPE' :  $('#USER_TYPE').val(),
									'BAGIAN' :  $('#BAGIAN').val(),
								};
					var address="<?php echo base_url();?>controll/input_user";
					var element="userlist";
					var notif={
								"heading" : "Info",
								"text" : "input user baru berhasil",
								"icon" : "Success"
							};
					if (data1['USERNAME']!='' && data1['PASSWORD']!='' && data1['USER_TYPE']!='' && data1['BAGIAN']!=''){
							sendajax(data1,address,element,notif,null);
					}
					else alert('mohon lengkapi data');
			}
			
			
			
			var id_addmoduser;
			
			function addmoduledc(){
				if (confirm('Yakin gan??')){
					var data1={
													'id_user' : id_addmoduser,
													'id_asset_dc' : document.getElementById('id_asset_dc').value,
												};
					var address="<?php echo base_url();?>controll/addmoduledc";
					var element="userlist";
					var notif={
								"heading" : "Success",
								"text" : "Tambah DC Access Berhasil",
								"icon" : "info"
							};
					if (data1['id_user']!='' && data1['id_dc']!=''){
						sendajax(data1,address,element,notif,null);
						$('.modal').modal('hide');
					}
					else alert('mohon lengkapi data');
				}
				
				
				
			}
			
			
			function addmodulaccess(){
				if (confirm('Yakin gan??')){
					var data1={
													'id_user' : id_addmoduser,
													'module' : document.getElementById('id_module').value,
													'access' : document.getElementById('access').value,
												};
					var address="<?php echo base_url();?>controll/addmoduleaccess";
					var element="userlist";
					var notif={
								"heading" : "Success",
								"text" : "Tambah Module Access Berhasil",
								"icon" : "info"
							};
					if (data1['id_user']!='' && data1['module']!='' && data1['access']!=''){
						sendajax(data1,address,element,notif,null);
						$('.modal').modal('hide');
					}
					else alert('mohon lengkapi data');
				}
				
			}
			
			function delmoduleaccess(i,j){
				if (confirm('Yakin gan??')){
					var data1={
													'id_user' : i,
													'module' : j,
												};
					var address="<?php echo base_url();?>controll/delmoduleaccess";
					var element="userlist";
					var notif={
								"heading" : "Success",
								"text" : "Hapus Module Access Berhasil",
								"icon" : "info"
							};
							
					sendajax(data1,address,element,notif,null);
				}
			}
			
			function updateuser(){
					var data1 = { 	'id' :  $('#iduser').val(),
									'u_nama' :  $('#nama').val(),
									'u_alamat' :  $('#alamat').val(),
									'u_nik' :  $('#nik').val(),
									'u_perusahaan' :  $('#perusahaan').val(),
									'u_detperusahaan' :  $('#det_perusahaan').val(),
									'u_kota' :  $('#kota').val(),
									'u_phone' :  $('#phone').val(),
									'password' :  $('#password').val(),
									
								};
					var element='profilev';
					var address="<?php echo base_url();?>login/updateuser";
					sendajax(data1,address,element,null,null);
			}
			</script>
          
       