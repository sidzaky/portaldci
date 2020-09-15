
<div class="container-fluid">
	<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo  $headboard ?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><?php echo  $breadcrumb[0] ?></li>
                            <li class="active"><?php echo $breadcrumb[1] ?></li>
                        </ol>
                    </div>
                </div>
	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="white-box">
				<h3 class="box-title">Data list 
				<?php 
					echo ($this->session->userdata('module_access')['maintenance']>=2 ? ' <button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="input_maintenance();" data-toggle="modal" data-target=".modal-asset"  ><span class="btn-label"><i class="fa fa-plus"></i></span>Input Maintenance Baru</button>' : '' );	
				?>
				</h3>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="hidden" required="required" name="visitor" id="visitor" /> 
				</div>
				<div id="item-list">
						<div class="x_content">
							<?php $con->showtable()?>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
 


<div class="modal fade modal-asset" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Report</h4>
			</div>
			<div class="modal-body" id="form_input">
					</div>	
				
			</div>
		</div>
	</div>
	
<div class="modal fade modal-list-asset" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Report</h4>
			</div>
				<div class="modal-body" id="form_list_asset">
							<table id="datatable" class="table table-hover table-striped table-bordered" cellspacing="0">
								  <thead>
									<tr>
									  <th><i>Nama</i></th>
									  <th><i>Tipe</i></th>
									
									  <th>Lokasi</th>
									  <th>S/N</th>
									  <th>Kapasitas Per ITEM</th>
							  <th>Aksi</th>
									</tr>
								  </thead>
								  <tbody>
									<?php
									
									foreach($con->asset_model->select_all() as $row){
										if ($row['GROUP_ID']==6){
										?>
											<tr class="<?php echo $row["ACTIVE"]=="N" ? "red":""; ?>" style="cursor:pointer;">
												<td><?php echo $row["HOSTNAME"] ?></td>
												<td><?php echo $row["BRAND"].' / '.$row["TYPE"] ?></td>
												<td><?php echo $row["LOCATION"] .' / '.$row["nama_dc"] ?></td>
												<td><?php echo $row["SERIAL_NUMBER"] ?></td>
												<td><?php echo $row["OPERATING_SYSTEM"] ?></td>
								<td>
								  <button type="button" class="btn btn-primary btn-xs" onclick="asset_select('<?php echo $row["ID"];?>')" data-id="">Pilih</button>
								</td>
											</tr>
										<?php
											}
										}
									?>
								  </tbody>
								</table>
					 <script>
					 $(document).ready(function() {
									$("#datatable").DataTable();	
							});
					 
					 
					 </script>
				</div>		
			</div>
		</div>
	</div>

<script>
		
		var activemaintenance;
		
		
		function asset_select(i){
			var data1={
				'id_asset' : i,
				'id_asset_maintenance' : activemaintenance
			}
			$.ajax({ type:"POST",
				   url: "<?php echo base_url();?>maintenancenonme/maintenance_addasset",
				   data: data1,
				   success:function(msg){
						$('.x_content').html(msg);
						}
				});	
		}
		
		function disasset(i,k){
					if (confirm('yakin menghapus '+k+' dalam daftar list maintenance????')){
						var data1={
									'id_asset_maintenance_list' : i,
								};
						$.ajax({ type:"POST",
									   url: "<?php echo base_url();?>maintenancenonme/maintenance_delasset",
									   data: data1,
									   success:function(msg){
											$('.x_content').html(msg);
											}
								});		
					}
		}
		
		function input_maintenance(i){
						if (i==null){
							var address="<?php echo base_url();?>maintenancenonme/input_maintenance";
							var data1=null;
						}
						else{ 
							var address="<?php echo base_url();?>maintenancenonme/get_update_maintenance";
							var data1= {
										'ID' :  i,
									};
							}
							$.ajax({ type:"POST",
									   url: address,
									   data: data1,
									   success:function(msg){
										   $('#form_input').html(msg);
											}
									});
					}
					
		function delfile(i,k,l){
					if (confirm('yakin menghapus file '+k+'???')){
						var data1={
									'id_asset_maintenance_document' : i,
									'path_file' : l
								};
						$.ajax({ type:"POST",
									   url: "<?php echo base_url();?>maintenancenonme/delfile",
									   data: data1,
									   success:function(msg){
											$('.x_content').html(msg);
											}
								});		
					}
				}
		
		
				
		function delmaintenance(i,k){
					if (confirm('yakin menghapus '+k+'???')){
						var data1={
									'ID' : i,
								};
						$.ajax({ type:"POST",
									   url: "<?php echo base_url();?>maintenancenonme/delmaintenance",
									   data: data1,
									   success:function(msg){
											$('.x_content').html(msg);
											}
								});		
					}
				}
		

		function uploadfile(i){
			var z;
			var files = document.getElementById("trigger_"+i).files;
			var file = files[0];
			if (files && file) {
				var reader = new FileReader();
				reader.onload = function(readerEvt) {
					var binaryString = readerEvt.target.result;
					var data1={
						'document' : btoa(binaryString),
						'ID' : i,
						'name' : $('#trigger_'+i).val()
					};
					$.ajax({ type:"POST",
						   url: "<?php echo base_url();?>maintenancenonme/upload_document_maintenance",
						   data: data1,
						   success:function(msg){
								$('.x_content').html(msg);
								}
					});		
				};
				reader.readAsBinaryString(file);
			}
		}
	 
		function buttonup(i){
				var fileinput = document.getElementById("trigger_"+i);
				iddokumentSIK=i;
				fileinput.click();
		}
		
		$(".table").DataTable();	
	</script>
	
