<?php 




?>


<table id="example"  class="table dataTable table-bordered" cellspacing="0" width="100%">
				  <thead>
				    <tr>
						<th><i>No</i></th>
						<th><i>Event Log</i></th>
						<th><i>Date Input</i></th>
						<th><i>Dokumen</i></th>
						<th><i>Action</i></th>  
				    </tr>
				  </thead>
					  <tbody>
					  <?php 
					  $i=0;
						foreach ($instro as $row){
							$i++;
							$document='';
							$assetlog='';
						
							foreach ($con->get_document($row["id_instro"]) as $zrow){
								$document .= '
								<span class="label label-lg label-info">&nbsp;
										<a class="white" target="_blank" href="'.base_url().$zrow->file_instro_log.'">
											<i class="fa fa-file"></i>
											<span>'.$zrow->name_view.'</span>
										</a>
										<a href="#" onclick="disfile(\''.$zrow->id_file_instro_log.'\',\''.$zrow->name_view.'\');" title="Removing tag">
											<i class="fa fa-close red"></i>
										</a>
								</span>
								
								';	
							}
							foreach ($con->get_instroasset($row["id_instro"]) as $drow){
								$assetlog.='<span class="label label-lg label-primary">&nbsp;<span>'.$drow->HOSTNAME.'&nbsp;&nbsp; &nbsp;&nbsp;</span><a href="#" onclick="disasset(\''.$drow->id_instro_log_asset.'\',\''.$drow->HOSTNAME.'\');" title="Removing tag"><i class="fa fa-close red"></i></a></span>&nbsp';	
							}
 
							echo '<tr '.($row['time_solve_instro']== '' ?'style="background-color : rgba(255, 205, 86, 1);"' : '').'>
									<td>'.$i.'</td>
									<td>
									
										<b>Nama Insident : '.$row['keterangan_instro'].' </br></br></b>
										Incident Time Start : '.date('H:i:s d-M, Y ', $row['time_start_instro']).' </br>
										Incident End Time 	: '.($row['time_solve_instro']!= '' ? '<span class="label label-lg label-info"> Done at '. date('H:i:s d-M, Y ', $row['time_solve_instro']).'</span>' : '<span class="label label-danger">still progress</span>').' </br></br>
										
										Impact	: '.$row['impact_instro'].' </br>
										
										Asset Impact 	: '.$assetlog.'
										<button class="btn btn-success btn-sm" data-toggle="modal" data-target=".modal-asset"type="button"  onclick="listasset(\''.$row['id_instro'].'\');"><i class="fa fa-plus"></i></button> </br></br>
										
										root Cause 	: '.$row['root_instro'].' </br></br>
										
										Action 		: '.($row['solution_instro']!=null ? $row['solution_instro'] : '' ) .' </br></br>
										
										Responsible engineer : ISD </br>
										
										Bagian 		: ISD </br>
									</td>
									<td>
										'. date('H:i:s d-M, Y ', $row['time_input']).'
									</td>
									<td>'.$document.'
										<button class="btn btn-success btn-sm" type="button" '.$disabled.' onclick="buttonup(\''.$row['id_instro'].'\');"><span class="btn-label"><i class="fa fa-upload"></i></span>Upload Dokument/Foto </button>
										<input  onchange="uploadfile(\''.$row['id_instro'].'\');" type="file" name="trigger_'.$row['id_instro'].'" id="trigger_'.$row['id_instro'].'" style="display:none"> 
										<input type="hidden" id="decodefile_'.$row['id_instro'].'" name="decodefile_'.$row['id_instro'].'" value="">
									</td>
									<td>
										<button class="btn btn-warning btn-sm" data-toggle="modal" onclick="input_instro(\''.$row['id_instro'].'\')" data-target=".modal" type="button" ><span class="btn-label"><i class="fa fa-pencil"></i></span></i>Edit</button>
										<button class="btn btn-danger btn-sm"  onclick="dislog(\''.$row['id_instro'].'\')"  type="button" ><span class="btn-label"><i class="fa fa-close"></i></span>Delete</button>
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