<div class="row">
					
					<div class="row">
						<div class="col-md-4">
							<form class="floating-labels ">
								</br>
									<div class="form-group has-warning m-b-40">
										<div id="datetimepicker" class="date form_date">
												<input id="range_start" data-provide="datepicker" required="" class="form-control date" type="text"></input>
												<label for="range_start">Tanggal Mulai</label>
										</div>
									</div>
									<div class="form-group has-warning m-b-40">
										<div id="datetimepicker1" class="date form_date">
												<input id="range_end" data-provide="datepicker" required="" class="form-control date" type="text"></input>
												<label for="range_end">Tanggal Berakhir</label>
										</div>
									</div>
							</form>
						</div>
						
						<div class="col-lg-8">
							<form class="floating-labels ">
								</br>
								<div class="col-md-8">
									<div class="form-group m-b-40">
											<input type="text" id="purpose" required="" class="form-control">
											<span class="highlight"></span> <span class="bar"></span>
											<label for="purpose">Keperluan</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group m-b-40">
										
											<select class="form-control p-0" id="datacenter" required="" onchange="getdcarea(this);">
												<option></option>
												<?php foreach ($asset_dc as $row){
													echo '<option value="'.$row['id_asset_dc'].'">'.$row['nama_dc'].'</option>';
												}?>
											</select>
											<span class="highlight"></span> <span class="bar"></span>
											<label for="purpose">pilih DC</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group m-b-40">
											<select class="form-control p-0" id="access" required="">
												<option></option>
											</select>
											<span class="highlight"></span> <span class="bar"></span>
											<label for="purpose">Access</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group m-b-40">
											<div id="datetimepicker1" class="date form_date">
													<input type="text" id="document_results" class="form-control" required="">
													<input class="formedit" type="file" name="documentex" id="documentex" style="display:none;"> 
													<input type="hidden" name="document" id="document" value="">
													<label for="Dokumen pendukung">Dokumen (optional)</label>
													<button type="button" class="btn btn-info btn-sm  t-0" onclick="getdocument();" ><i class="fa fa-upload"></i></button>	
													<button type="button" class="btn btn-success btn-sm" onclick="adddc();" style="float:right;" ><i class="fa fa-check"></i>Submit</button>	
											</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					
					<hr size="30"> 
					<div class="row">
						<div class="col-lg-7">
							<label for="tools">Daftar Pengunjung</label>
							</br>
							<table id="tableslist" class="table table-striped no-footer" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><i>Act</i></th>
											<th><i>Detail Visitor</i></th>
											<th><i>Barang yang dibawa</i></th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
						</div>
						
						<div class="col-lg-5">	
							<table id="tablevis" class="table table-striped no-footer" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><i>No</i></th>
										<th><i>Act</i></th>
										<th><i>Detail Visitor</i></th>
										
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<script>
						$("#tablevis").DataTable({
								"processing": true, 
								"serverSide": true, 
								"paging" : false,
								"ordering" : false,
								"info" : false,
								"sDom": "lfrti",
								"ajax": {
									"url": "<?php echo base_url();?>visitor/dcform",
									"type": "POST"},
								"columnDefs": [{"targets": [ 0 ],"orderable": false}],
							});
						var newRowContent;
						function movetable(i,j,k){
							newRowContent='<tr id="'+i+'"><td><button class="btn btn-danger waves-effect waves-light btn-sm" onclick="dellist(\''+i+'\')"> <i class="fa fa-close"></i></button></td><td><b><input type="hidden" name="id_visitor" value="'+i+'"> '+j+'</b></br>'+k+'</td><td><input  type="text"  name="tools" class="form-control"></td></tr>';
							$("#tableslist tbody").append(newRowContent);
						}
						
						function dellist(i){
							$("#"+i).remove();
						}
						
						function getdcarea(i=''){
							
							if (i!=''){
								var data1={
									'id_asset_dc': i.value
								}
								$.ajax({ 		
										type:"POST",
										url: "<?php echo base_url();?>visitor/getdcarea",
										data: data1,
										success:function(msg){
												var result=JSON.parse(msg);
												var list='';
												for (i=0;i<result.length;i++){
													list +='<option value="'+result[i].id_asset_dc_area+'">'+result[i].keterangan_area+'</option>'
												}
												$('#access').html(list);
											}
										});	
								
							}
							else $('#access').html('<option></option>');
						}
						
						
						function getdocument() 
							{
								var fileinput = document.getElementById('documentex');
								fileinput.click();
							}
										
						var handleFileSelect = function(evt) {
								var files = evt.target.files;
								var file = files[0];
								if (files && file) {
									var reader = new FileReader();
									reader.onload = function(readerEvt) {
										var binaryString = readerEvt.target.result;
										document.getElementById('document').value=btoa(binaryString);
										document.getElementById('document_results').value=file.name; 
									};
									reader.readAsBinaryString(file);
								}
							};		
						document.getElementById("documentex").addEventListener('change', handleFileSelect, false);	
						
						
						function adddc(){
							var data1={
											'visitor' : $('#tableslist input[name="id_visitor"]').map(function(){return $(this).val();}).get(),
											'range_start' : $("#range_start").val(),
											'range_end' : $("#range_end").val(),
											'purpose' : $("#purpose").val(),
											'access' : $("#access").val(),
											'dc' : $("#datacenter").val(),
											'document' : $("#document").val(),
											'document_name' : $("#document_results").val(),
											'tools' : $('#tableslist input[name="tools"]').map(function(){return $(this).val();}).get(),
										};
							var diffDays =(new Date($("#range_end").val()).valueOf())-(new Date($("#range_start").val()).valueOf());
						
							if ((diffDays/1000)<<?php echo ($this->session->userdata('module_access')['vm1']>5 ? '9999999' : '2592000') ?>){
								if (data1['range_start']!='' && data1['access']!=null && data1['access']!=''  && data1['range_end']!='' && data1['purpose']!='' && data1['visitor'].length!=0){
									$.ajax({ 		
										type:"POST",
										url: "<?php echo base_url();?>visitor/dcrequest",
										data: data1,
										success:function(msg){
												 $('#dcrequest').DataTable().ajax.reload(null, false);
												 $('#dcresponse').DataTable().ajax.reload(null, false);
												alert('done, silahkan tunggu Approval');
												$('.visitor-modal').modal('hide');
											}
										});	
								}
								else alert ('tolong lengkapi data');
							}
							else alert('rentang waktu tidak boleh lebih dari 30 hari');
						}
				</script>