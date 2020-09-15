<div class="col-md-4" >
					<form class="form-horizontal form-material" id="loginform" action="#">
						<h3 class="box-title m-b-20">Sign Up</h3>
							<div class="form-group ">
							  <div class="col-xs-12">
								<input class="form-control" name="nama" id="nama" type="text" required="" placeholder="Name">
							  </div>
							</div>
							
							<div class="form-group ">
							  <div class="col-xs-12">
									<input class="form-control" name="phone" id="phone" type="tel" required="" placeholder="Phone Number">
							  </div>
							</div>
							<div class="form-group ">
							  <div class="col-xs-12">
								<input class="form-control" name="email" id="email" type="text" required="" placeholder="Email">
							  </div>
							</div>
							
							<div class="form-group ">
							  <div class="col-xs-12">
								
								<select class="form-control" id="kota">
										<?php $con->region->echokota();?>
									</select>
							  </div>
							</div>
						</form>
					</div>
					
				<div class="col-md-4">
					<h3 class="box-title m-b-20" style="color:#fff;">Sign Up</h3>
					<form class="form-horizontal form-material" id="loginform" action="#">
						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" name="password" id="password" type="password" required="" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
								<div class="col-xs-12">
									<input class="form-control" id="repassword" id="repassword" type="password" required onchange="passcek(this.value);" placeholder="Confirm Password">		
								</div>
						</div>
						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" name="nik" id="nik" type="text" required="" placeholder="Nomor Kartu Identitas">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<input class="form-control"  name="perusahaan" id="perusahaan" type="text" required="" placeholder="Nama Perusahaan">
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-4" >	
					<h3 class="box-title m-b-20" style="color:#fff;">Sign Up</h3>
					<form class="form-horizontal form-material" id="loginform" action="#">
						<div class="row" style="margin:0 auto;">
							<div class="col-md-8">
								<div id="resultssign"><img src="<?php echo base_url();?>assets/img/unknown.jpg" style="high:200px; width:245px;"></div>
							</div>
							<div class="col-md-2">
								<button type="button" class="formedit btn btn-primary" onclick="getfotosign();" class="btn btn-flat btn-success"><i class="fa fa-upload" aria-hidden="true"></i></button> 
							</div>
							<input class="formedit" type="file" name="fotosign" id="fotosign" style="display:none;"> 
							<input type="hidden" name="photosign" id="photosign" value="">
						</div>
					</form>
				</div>
					
				<div class="col-md-6" >
					 <form class="form-horizontal form-material" onsubmit="return false;">
							<div class="form-group">
										  <div class="col-xs-12">
											<textarea class="form-control" id="alamat" name="alamat" type="text" placeholder="Alamat"></textarea>
										 </div>
							</div>
						</form>
				</div>
				<div class="col-md-6" >
					<form class="form-horizontal form-material" onsubmit="return false;">
						<div class="form-group">
							<div class="col-xs-12">
								<textarea class="form-control" id="det_perusahaan" name="det_perusahaan" type="text" placeholder="Detail Perusahaan"></textarea>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-12">
					<form class="form-horizontal form-material" onsubmit="return false;">
						<div class="form-group">
							<div class="col-md-12">
								<div class="checkbox checkbox-primary p-t-0">
									<input id="checkbox-signup" type="checkbox">
									<label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
								</div>
							</div>
						</div>
						<div class="form-group text-center m-t-20">
							<div class="col-xs-12">
								<button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" name="formsubmit" id="formsubmit" type="submit" onClick="signup();" disabled >Sign Up</button>
							</div>
						</div>
						<div class="form-group m-b-0">
							<div class="col-sm-12 text-center">
								<p>Already have an account? <a href="<?php echo base_url()?>login" class="text-primary m-l-5"><b>Sign In</b></a></p>
							</div>
						</div>
					</form>
					<div id="signup-box">
					</div>
				</div>
				
				<script>	
					var topost;
					function getfotosign() 
							{
								var fileinput = document.getElementById("fotosign");
								fileinput.click();
							}
					var handleFileSelect = function(evt) {
									var files = evt.target.files;
									var file = files[0];
									if (files && file) {
										var reader = new FileReader();
										reader.onload = function(readerEvt) {
											var binaryString = readerEvt.target.result;
											document.getElementById("photosign").value=btoa(binaryString); 
											document.getElementById('resultssign').innerHTML='<img src="data:image/jpeg;base64,'+btoa(binaryString)+'" style="width:246px;max-height:247px;"/>' 
										};
										reader.readAsBinaryString(file);
									}
						};
					document.getElementById("fotosign").addEventListener('change', handleFileSelect, false);
					
					function cekkota(i){
						// alert(i.value);
						var data1={
							'id_provinsi' : i.value
						};
						var address="<?php echo base_url();?>region/echokota";
						var element="kota";
						sendajax(data1,address,element,null,null);
					};
					
					function passcek(z){
					
						var pass = $('#password').val();
						if (pass!=z){
							$('#formsubmit').prop('disabled', true);
						}
						else $('#formsubmit').removeAttr("disabled");
					}
					
					function signup(){
						var data1 = { 
										'nama' :  $('#nama').val(),
										'alamat' :  $('#alamat').val(),
										'nik' :  $('#nik').val(),
										'perusahaan' :  $('#perusahaan').val(),
										'detperusahaan' :  $('#det_perusahaan').val(),
										'photosign' :   $('#photosign').val(),
										'kota' :  $('#kota').val(),
										'phone' :  $('#phone').val(),
										'email' :  $('#email').val(),
										'password' :  $('#password').val(),
									};
						var address="<?php echo base_url();?>login/signup";
						var element="signup-box";
						if (data1['nama']!='' && data1['nik']!='' && data1['alamat']!='' && data1['perusahaan']!='' && data1['email']!='' && data1['password']!=''){
								if (topost!='') data1['product']=topost;
								sendajax(data1,address,element,null,null);
						}
						else alert('mohon lengkapi data');
					}
				</script>