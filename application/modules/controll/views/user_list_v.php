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
					foreach ($con->getuserdc($row['ID']) as $trow){
						if ($this->session->userdata('module_access')['controll1']>=4){
							$buttondc='<a href="#" onclick="deluserdc(\''.$row['ID'].'\',\''.$trow['id_asset_dc'].'\')" title="Removing tag"><i class="fa fa-close" style="color:red;"></i></a>';
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
									$permission .='<span class="tag label label-info"> '.$srow['module'].'['.$srow['access'].'] 
													<a href="#" onclick="delmoduleaccess(\''.$row['ID'].'\',\''.$srow['module'].'\')" title="Removing tag">
														<i class="fa fa-close" style="color:red;"></i>
													</a>
												</span> &nbsp';
								}
						}
						
						///peasant level///
						else {
							if ($this->session->userdata('user_id')==$row['ID']){
								$permission.='<span class="tag label label-info"> '.$srow['module'].'['.$srow['access'].']</span> &nbsp ';
							}
						}
					}
					
					
					if ($this->session->userdata('module_access')['controll1']>=4){
						$permission .='<button class="btn btn-warning btn-circle waves-effect waves-light btn-sm" onclick="id_addmoduser=\''.$row['ID'].'\';" data-toggle="modal" data-target=".first-modal" type="button" ><i class="fa fa-plus"></i></button>';
						$userdc.='<button class="btn btn-warning btn-circle waves-effect waves-light btn-sm" onclick="id_addmoduser=\''.$row['ID'].'\';" data-toggle="modal" data-target=".second-modal" type="button" ><i class="fa fa-plus"></i></button>';
						
					} 
					$button='';
					$i++;
						echo '<tr>
								<td>'.$i.'</td>
								<td>'.$row['USERNAME'].'</td>
								<td>'.$userdc.'</td>
								<td>'.$row['USER_TYPE'].'</br><span class="label label-primary">'.$row["BAGIAN"].'</span></br><span class="label label-success">'.$row["permission"].'</span></td>
								<td><div class="tags-default">
                                <div class="bootstrap-tagsinput">'.$permission.'</div></div></td>
								<td>
									'.($this->session->userdata('module_access')['controll1']>=17 ? '<button class="btn btn-success waves-effect waves-light btn-sm"  type="button" ><i class="fa fa-edit"></i> Edit User</button>' : '').'
									'.($this->session->userdata('user_id')==$row['ID'] ? '<button class="btn btn-info waves-effect waves-light btn-sm"  type="button" ><i class="fa fa-edit"></i> Ganti Password</button>' : '').'
									</td>
							   </tr>
							';
					
				}
			?>
			</tbody>
		</table>
		<script>
			$(document).ready(function() {
						$("#example2").DataTable()
					});
		
		</script>