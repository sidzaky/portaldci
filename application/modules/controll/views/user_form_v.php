
					<form class="form-horizontal form-material" id="loginform" action="#">
							<div class="form-group">
								<label>Username</label>
							  <div class="col-xs-12">
								<input class="form-control" name="USERNAME" id="USERNAME" type="text" required="" placeholder="Name">
							  </div>
							</div>
							<div class="form-group ">
								<label>Password</label>
							  <div class="col-xs-12">
									<input class="form-control" name="PASSWORD" id="PASSWORD" type="tel" required="" placeholder="PASSWORD">
							  </div>
							</div>
							<div class="form-group ">
							  <div class="col-xs-12">
								<label>User Type</label>
								<select class="form-control" id="USER_TYPE">
									<option VALUE="ORGANIC">ORGANIC</option>
									<option VALUE="VENDOR">VENDOR 	</option>
								</select>
							  </div>
							</div>
							<div class="form-group ">
								<label>Bagian</label>
								<div class="col-xs-12">
										<input class="form-control" name="BAGIAN" id="BAGIAN" type="tel" required="" placeholder="BAGIAN">
								</div>
							</div>
							<div class="form-group ">
								<div class="col-xs-12">
										<button class="btn btn-success waves-effect waves-light btn-sm" onclick="input_user();" type="button" ><i class="fa fa-check"></i>Sumbit</button>
								</div>
							</div>
						</form>
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