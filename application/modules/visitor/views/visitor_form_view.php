
<?php
	foreach ($listcompany as $row){
		$echolistcompany.=' <option value="'.$row['company'].'">';
	}
		echo '
			'.($this->session->userdata('module_access')['vm1']>2 ? '
					<button id="buttonktp" type="button" class="btn btn-success waves-effect waves-light " onclick="getbyktp();">Scan E-KTP</button>
					<div id="loaderktp"></div>
				':'').'
			<div id="showyoumean"></div>
			<div class="row" id="form_visitor">
				<div class="col-md-6" >
					<form class="form-horizontal form-material form-label-left" method="POST" enctype="multipart/form-data" id="form" action="" novalidate> 
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i>Nama pengunjung</i> <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							'.($visitor[0]['id_visitor']!='' ? '<input type="hidden" value="'.$visitor[0]['id_visitor'].'"  id="id_visitor">': '').'
						  <input '.$disabled.' type="text" value="'.$visitor[0]['name_visitor'].'"  id="name_visitor"  class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i>Nomor Telepon</i> <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						  <input '.$disabled.' type="text" value="'.$visitor[0]['phone_number'].'"  id="phone_number"  class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i>Alamat Sekarang</i> <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						  <input '.$disabled.' type="text" value="'.$visitor[0]['domicile'].'"  id="domicile"  class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i>Apakah Dari BRI?</i> 
						</label>
						<div class="col-md-1 col-sm-1 col-xs-12">
						  <input '.$disabled.' type="checkbox" value="1"  id="organic" name="organic" class="form-control col-md-7 col-xs-12" '.($visitor[0]['organic']==1 ? 'checked' : '').'>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							Centang jika merubapakan bagian dari BRI
						</div>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i id="labperus">Nama Perusahaan</i> <span class="required">*</span>
						</label>
						<datalist id="dataperusahaan">
							 '.$echolistcompany.'
						</datalist>
						<div class="col-md-6 col-sm-6 col-xs-12">
						  <input '.$disabled.' type="text" value="'.$visitor[0]['company'].'"  id="company" list="dataperusahaan" class="form-control col-md-7 col-xs-12">
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							Jika Nama Perusahaan Telah ada, mohon Menggunakan data tersebut agar tidak ada data yang tidak valid
						</div>
					</div>
					
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i>Nomor kartu identitas</i> <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						  <input '.$disabled.' type="text" value="'.$visitor[0]['id_number'].'"  id="id_number"  class="form-control col-md-7 col-xs-12">
						</div>
					</div>
						
					</form>
				</div>
				<div class="col-md-6">
					<form class="form-horizontal form-material form-label-left" method="POST" enctype="multipart/form-data" id="form" action="" novalidate> 
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
								<i>Foto Kartu Identitas</i> <span class="required">*</span>
							</label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<button type="button" class="btn btn-info btn-sm" onclick="getfoto(\'idcard_img\');" ><i class="fa fa-cloud-upload"></i></i></button>
							   <button type="button" class="btn btn-primary btn-sm" onclick="callwebcam(\'idcard_img\');" ><i class="fa fa-camera-retro"></i></i></button>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div id="idcard_img_results">'.($visitor[0]['idcard_img']!='' ? '<img src="'.base_url().$visitor[0]['idcard_img'].'" style="max-width:300px;max-height:150px;">' : '').'</div>
								<input type="hidden" name="idcard_img" id="idcard_img" value="">
							</div>
						</div>
						
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
								<i>Foto pengunjung</i> <span class="required">*</span>
							</label>
							<div class="col-md-2 col-sm-2 col-xs-12">
							   <button type="button" class="btn btn-info btn-sm" onclick="getfoto(\'person_img\');" ><i class="fa fa-cloud-upload"></i></i></button>
							   <button type="button" class="btn btn-primary btn-sm" onclick="callwebcam(\'person_img\');" ><i class="fa fa-camera-retro"></i></i></button>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12"> 
								<div id="person_img_results">'.($visitor[0]['person_img']!='' ? '<img src="'.base_url().$visitor[0]['person_img'].'" style="max-width:300px;max-height:150px;">' : '').'</div>
								<input type="hidden" name="person_img" id="person_img" value="">
							</div>
						</div>
						<input class="formedit" type="file" name="foto" id="foto" style="display:none;"> 
							<div id="fromschedulelist"></div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <button type="button" class="btn btn-success btn-sm" id="button_submit" onclick="input_visitor();" ><i class="fa fa-check"></i>Submit</button>
								</div>
							</div>	
						</div>	
					</form>
				</div>
			</div>
			';			
		?>				
	<script>
		var elementup='';
		var labelper=document.getElementById('labperus');
		
		
		
		function getfoto(i) 
			{
				var fileinput = document.getElementById('foto');
				elementup=i;
				fileinput.click();
			}
		
		$(document).ready(function(){
			//////check by name visitor/////
			$('#name_visitor').on('keyup', function() {
					 if (this.value.length > 1) {
						 var data1={
							 'name_visitor':$('#name_visitor').val(),
						 }
						 content=$.ajax({ 
									type:"POST",
									url: "<?php echo base_url()?>visitor/checkdatabyname",
									data: data1,
									success:function(msg){
										var data ='';
										
										var result=JSON.parse(msg);
										if (result.length>0){
											data ='apakah orang ini yang anda maksut? </br><table class="table  dataTable no-footer">';
											for (var i=0;i<result.length;i++){
												data +="<tr><td>"+(i+1)+"</td><td>"+(result[i]['name_visitor'])+"</td><td>"+(result[i]['company'])+"</td><td>"+(result[i]['domicile'].substring(0,15))+"****</td></tr>";
											}
											data +="</table></br>Jika benar, mohon jangan menambahkan data lagi dikarenakan data sudah ada";
										}
										document.getElementById('showyoumean').innerHTML=data;
									}
							});
					 }
					 else document.getElementById('showyoumean').innerHTML='';
					
					
				});
				
			if (document.getElementById('organic').checked==true){
				labelper.innerHTML='Bagian';
			}
			
			$('#organic').change(function(){
					if(this.checked) {
						labelper.innerHTML='Bagian';
					}     
					else {
						labelper.innerHTML='Nama Perusahaan';	
					}
			});
		});
		
		function getbyktp(){
			$("#buttonktp").attr('disabled', 'disabled'); 
			document.getElementById('loaderktp').innerHTML='<img src="<?php echo base_url()?>assets/img/loader.gif">';
			
			var address="<?php echo base_url();?>controll/send/bacaChip";
			var element="form_visitor";
			$.ajax({ 
							type:"POST",
						    url: address,
						    success:function(msg){ 
								msg=JSON.parse(msg);
								if (msg.errornumber==0){
									$("#name_visitor").attr('disabled', 'disabled'); 
									$("#domicile").attr('disabled', 'disabled'); 
									$("#id_number").attr('disabled', 'disabled'); 
									document.getElementById('name_visitor').value=msg['nama'];
									document.getElementById('domicile').value=msg.alamat+' '+msg.kelurahan+' '+msg.kecamatan+' '+msg.kabupaten+' '+msg.provinsi;
									document.getElementById('id_number').value=msg.nik;
								}
								else if (msg.errornumber=='-1'){
									$("#buttonktp").prop("disabled", false);
									alert ('perangkat tidak nyambung, mohon cek perangkat');
								}
								else {
									$("#buttonktp").prop("disabled", false);
									alert ('scan e-ktp gagal, coba lagi aja, mungkin jarinya problem');
								}
								document.getElementById('loaderktp').innerHTML='';
							}
					});
		}
		
		
		
		function callwebcam(i){
				$('#second-modal').modal('show'); 
				$.ajax({ 
							type:"POST",
						    url: "<?php echo base_url()?>cam/index/"+i,
						    success:function(msg){
							    $('#second_blank_content').html(msg);
							}
					});
		}
		
		
		var handleFileSelect = function(evt) {
				var files = evt.target.files;
				var file = files[0];
				if (files && file) {
					var reader = new FileReader();
					reader.onload = function(readerEvt) {
						var binaryString = readerEvt.target.result;
						document.getElementById(elementup).value=btoa(binaryString);
						document.getElementById(elementup+'_results').innerHTML='<img src="data:image/jpeg;base64,'+btoa(binaryString)+'" style="widht:100px;height:100px"/>' 
					};
					reader.readAsBinaryString(file);
					$('#modal').modal('hide');
				}
			};		
		document.getElementById("foto").addEventListener('change', handleFileSelect, false);	
		
		function input_visitor(i){
					var data1 = { 
						'id_visitor':$('#id_visitor').val(),
						'name_visitor':$('#name_visitor').val(),
						'organic': (document.getElementById('organic').checked==true ? '1' : '0' ),
						'company':$('#company').val(),
						'id_number':$('#id_number').val(),
						'idcard_img':$('#idcard_img').val(),
						'phone_number':$('#phone_number').val(),
						'domicile':$('#domicile').val(),
						'person_img':$('#person_img').val(),
					};
					
					if (data1['name_visitor']!='' && data1['domicile']!='' && data1['phone_number']!='' &&  data1['company']!='' &&  data1['id_number']!=''){
						$("#button_submit").attr('disabled', 'disabled'); 
						$.ajax({ 
								type:"POST",
								url: "<?php echo base_url()?>visitor/input_visitor",
								data: data1,
								success:function(msg){
									if ($('#fromschedulelistdata').val()=='1'){
										 location.reload();
									}
									else {
										$('.x_content').html(msg);
									}
								}
						});
					}
					else alert ('mohon lengkapi data');
				
			}
		
		
	</script>