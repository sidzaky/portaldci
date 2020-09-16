<table id="example2" class="table table-striped">
			<thead>
				  <tr>
					<th>No</th>
					<th>Nama</th>
					<th>DC Access</th>
					<th>User Type</th>
					<th>Aksess Module</th>
					<th>Action</th>
				  </tr>
			</thead>
		<tbody>
		
			<?php 
				$i=0;
				foreach ($user as $row){
					$permission='';
					$userdc="";
					$buttondc="";
					$action="";
					
					foreach ($con->getuserdc($row['ID']) as $trow){
						if ($this->session->userdata('module_access')['controll1']>=4){
							if ($this->session->userdata('user_id')!=$row['ID']){
								$buttondc	= '<a href="#" onclick="deluserdc(\''.$row['ID'].'\',\''.$trow['id_asset_dc'].'\')" title="Removing tag"><i class="fa fa-close" style="color:red;"></i></a>';
								$action 	= '<button class="btn btn-danger waves-effect waves-light btn-sm"  onclick="disuser(\''.$row['ID'].'\',\''.$row['USERNAME'].'\');" type="button" ><i class="fa fa-close"></i> Disable Akun</button>';
							}
						}
						$userdc.='<span class="tag label label-info">'.$trow['nama_dc'].$buttondc.'</span></br>';
					}
					
					foreach ($con->getmoduleaccess($row['ID']) as $srow){
						////god level///
						if ($this->session->userdata('module_access')['controll1']>=5){
							$permission .='<span class="tag label label-info"> '.$srow['module'].'['.$srow['access'].'] <a href="#" onclick="delmoduleaccess(\''.$row['ID'].'\',\''.$srow['module'].'\')" title="Removing tag"><i class="fa fa-close" style="color:red;"></i></a></span> &nbsp ';
						}
						
						///entry level///
						elseif ($this->session->userdata('module_access')['controll1']==4){
								if ($srow['module']!='controll1'){
									$permission .= '<span class="tag label label-info"> '.$srow['module'].'['.$srow['access'].']'; 
									$permission .= '<a href="#" onclick="delmoduleaccess(\''.$row['ID'].'\',\''.$srow['module'].'\')" title="Removing tag">';
									$permission .= '<i class="fa fa-close" style="color:red;"></i> </a> </span> &nbsp';
								}
						}
						
						///peasant level///
						else {
							if ($this->session->userdata('user_id')==$row['ID']){
								$permission .='<span class="tag label label-info"> '.$srow['module'].'['.$srow['access'].']</span> &nbsp ';
							}
						}
					}
					
					
					if ($this->session->userdata('module_access')['controll1']>=4){
						$permission .='<button class="btn btn-warning btn-circle waves-effect waves-light btn-sm" onclick="id_addmoduser=\''.$row['ID'].'\';" data-toggle="modal" data-target=".first-modal" type="button" ><i class="fa fa-plus"></i></button>';
						$userdc		.='<button class="btn btn-warning btn-circle waves-effect waves-light btn-sm" onclick="id_addmoduser=\''.$row['ID'].'\';" data-toggle="modal" data-target=".second-modal" type="button" ><i class="fa fa-plus"></i></button>';
						
					} 
					$button='';
					$i++;
						echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$row['USERNAME'].'</td>';
						echo '<td>'.$userdc.'</td>';
						echo '<td>'.$row['USER_TYPE'].'</br><span class="label label-primary">'.$row["BAGIAN"].'</span></br><span class="label label-success">'.$row["permission"].'</span></td>';
						echo '<td><div class="tags-default">';
                        echo '<div class="bootstrap-tagsinput">'.$permission.'</div></div></td>';
						echo '<td>'.$action.'</td>';
						echo '</td>';
						echo '</tr>';
					
				}
			?>
			</tbody>
		</table>
		<script>
			$(document).ready(function() {$("#example2").DataTable()});
			
			function disuser(i="",j=""){
				if (i!=""){
					if (confirm("apakah yakin menghapus user "+j)){
						var address="<?php echo base_url();?>login/disuser";
						var data1={
							'ID' 		: i,
						};
						var element='userlist';
						var notif={
								"heading" : "Warning",
								"text" : "Hapus User "+j+" berhasil",
								"icon" : "Warning"
							};
						sendajax(data1,address,element,notif,null);
					}
				}
			}
		</script>