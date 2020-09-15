<?php 




?>


<table id="example"  class="table table-striped dataTable no-footer" cellspacing="0" width="100%">
				  <thead>
				    <tr>
						<th><i>No</i></th>
						<th><i>Event Maintenance</i></th>
						<th><i>Nama asset</i></th>
						<th><i>Document Pendukung</i></th>
						<th><i>Action</i></th>  
				    </tr>
				  </thead>
					  <tbody>
					  <?php 
					  $i=0;
						foreach ($maintenance as $row){
							$i++;
							$file="";
							$assetlist="";
							foreach ($con->maintenance_m->getmaintenanceasset_file($row['ID']) as $srow){
									$file.='<span class="label label-lg label-info">&nbsp;
										<a class="white" target="_blank" href="'.base_url().$srow['path_file'].'">
											<i class="fa fa-file"></i>
											<span>'.$srow['name_view'].'</span>
										</a>
										<a href="#" onclick="delfile(\''.$srow['id_asset_maintenance_document'].'\',\''.$srow['name_view'].'\',\''.$srow['path_file'].'\');" title="Removing tag">
											<i class="fa fa-close red"></i>
										</a>
								</span></br>';
							}
							
							foreach ($con->maintenance_m->getmaintenanceasset_list($row['ID']) as $drow){
								$assetlist.='<span class="label label-lg label-primary">&nbsp;<span>'.$drow['HOSTNAME'].'&nbsp;&nbsp; &nbsp;&nbsp;</span><a href="#" onclick="disasset(\''.$drow['id_asset_maintenance_list'].'\',\''.$drow['HOSTNAME'].'\');" title="Removing tag"><i class="fa fa-close red"></i></a></span>&nbsp</br>';	
							}
							$file.='';
							echo '<tr>
									<td>'.$i.'</td>
									<td><span class="label label-lg label-success">'.date('d-M, Y' , $row['EVENT_DATE']).'</span></br>
										'.$row['DESCRIPTION'].'
										</td>
									<td>'.$assetlist.'<button class="btn btn-success btn-sm" data-toggle="modal" data-target=".modal-list-asset" type="button"  onclick="activemaintenance=\''.$row['ID'].'\';"><i class="fa fa-plus"></i></button> </br></br></td>
									<td>'.$file.'
										'.($this->session->userdata('module_access')['maintenance']>=2 ? '<button class="btn btn-success btn-sm" type="button" '.$disabled.' onclick="buttonup(\''.$row['ID'].'\');"><span class="btn-label"><i class="fa fa-upload"></i></span>Upload Dokument/Foto </button>' : '').'
										<input  onchange="uploadfile(\''.$row['ID'].'\');" type="file" name="trigger_'.$row['ID'].'" id="trigger_'.$row['ID'].'" style="display:none"> 
										<input type="hidden" id="decodefile_'.$row['ID'].'" name="decodefile_'.$row['ID'].'" value="">
									</td>
									<td>
									'.($this->session->userdata('module_access')['maintenance']>=2 ? '<button class="btn btn-warning btn-sm" data-toggle="modal" onclick="input_maintenance(\''.$row['ID'].'\')" data-target=".modal" type="button" ><span class="btn-label"><i class="fa fa-pencil"></i></span></i>Edit</button>
										<button class="btn btn-danger btn-sm"  onclick="delmaintenance(\''.$row['ID'].'\',\''.$row['DESCRIPTION'].'\')"  type="button" ><span class="btn-label"><i class="fa fa-close"></i></span>Delete</button>' : '').'
									</td>
								  </tr>';
							
						}
					  ?>		
					</tbody>
				</table>
				
			<script>
			$(document).ready(function() {
					$("#example").DataTable();	
			});
				 	
			</script>