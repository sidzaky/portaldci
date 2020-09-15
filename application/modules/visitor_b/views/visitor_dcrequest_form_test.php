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
								<div class="form-group m-b-40">
										<input type="text" id="purpose" required="" class="form-control">
										<span class="highlight"></span> <span class="bar"></span>
										<label for="purpose">Keperluan</label>
								</div>
								<div class="form-group m-b-40">
										<div id="datetimepicker1" class="date form_date">
												<input type="text" id="document_results" class="form-control" required="">
												<input class="formedit" type="file" name="documentex" id="documentex" style="display:none;"> 
												<input type="hidden" name="document" id="document" value="">
												<label for="Dokumen pendukung">Dokumen Pendukung</label>
											    <button type="button" class="btn btn-info btn-sm  t-0" onclick="getdocument();" ><i class="fa fa-cloud-upload"></i></button>	
												<button type="button" class="btn btn-success btn-sm" onclick="addtesting();" style="float:right;" ><i class="fa fa-check"></i>Submit</button>	
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
											<th><i>Bawaan</i></th>
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
										<th><i>Act</i></th>
										<th><i>Detail Visitor</i></th>
										
									</tr>
								</thead>
								<tbody>
									<?php
									$i=0;
									foreach($visitor as $srow){
										$i++;
										
										echo 	'<tr> 
													<td>
														<button class="btn btn-info waves-effect waves-light btn-sm" onclick="movetable(\''.$srow['id_visitor'].'\',\''.$srow["name_visitor"].'\',\''.$srow["company"].'\')" type="button" ><i class="fa fa-plus"></i></button>
													</td>
													<td id="'.$srow['id_visitor'].'">
														<b>Nama &nbsp &nbsp &nbsp &nbsp &nbsp : '.$srow["name_visitor"].'</b></br>
														Perusahaan  : '.($srow["organic"]!=0 ? 'PT. Bank Rakyat Indonesia </br> Bagian &nbsp : '  : '' ).$srow["company"].' </br>
														Nomor  identitas  : '.$srow["id_number"] .'
													</td>
													
												</tr>';
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<script>
						$("#tablevis").DataTable({"pageLength": 5,"bInfo" : false});
						var newRowContent;
						function movetable(i,j,k){
							newRowContent='<tr id="'+i+'"><td><button class="btn btn-danger waves-effect waves-light btn-sm" onclick="dellist(\''+i+'\')"> <i class="fa fa-close"></i></button></td><td><b><input type="hidden" name="id_visitor" value="'+i+'"> '+j+'</b></br>'+k+'</td><td><input  type="text"  name="tools" class="form-control"></td></tr>';
							$("#tableslist tbody").append(newRowContent);
						}
						
						function dellist(i){
							$("#"+i).remove();
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
						
						
						function addtesting(){
							var data1={
											'visitor' : $('#tableslist input[name="id_visitor"]').map(function(){return $(this).val();}).get(),
											'range_start' : $("#range_start").val(),
											'range_end' : $("#range_end").val(),
											'purpose' : $("#purpose").val(),
											'document' : $("#document").val(),
											'document_name' : $("#document_results").val(),
											'tools' : $('#tableslist input[name="tools"]').map(function(){return $(this).val();}).get(),
										};
							if (data1['range_start']!='' && data1['range_end']!='' && data1['purpose']!=''){
								$.ajax({ 		
									type:"POST",
									url: "<?php echo base_url();?>visitor/dcrequest_test",
									data: data1,
									success:function(msg){
											$('.x_content').html(msg);
										}
									});	
							}
							else alert ('tolong lengkapi data');	
						}
				</script>