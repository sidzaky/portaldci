
		
		<div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
				<i>Stiker Parkir Tersisa</i> <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				 <select id="nomor_stiker" class="form-control col-md-7 col-xs-12">
					<?php 
						foreach ($stiker as $row){
							echo '<option value="'.$row['nomor_stiker'].'">'.$row['nomor_stiker'].'</option>';	
						}
					?>
				 </select>
			</div>
		</div>
		
		<div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
				<i>Nopol</i> <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" class="form-control col-md-7 col-xs-12" id="nopol">
			</div>
		</div>
		
		<div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
				<i>Foto STNK</i> <span class="required">*</span>
			</label>
			<div class="col-md-2 col-sm-2 col-xs-12">
				<button type="button" class="btn btn-info btn-sm" onclick="getfoto('stnk');" ><i class="fa fa-cloud-upload"></i></i></button>
			   <button type="button" class="btn btn-primary btn-sm" onclick="callwebcam('stnk');" ><i class="fa fa-camera-retro"></i></i></button>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div id="stnk_results"></div>
				<input type="hidden" name="stnk" id="stnk" value="">
			</div>
		</div>
		<input class="formedit" type="file" name="foto" id="foto" style="display:none;"> 
		
		<div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
				<i></i>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<button  type="button" class="btn btn-success btn-sm" onclick="stiker('<?php echo $_POST['id_visitor']?>',true);" ><i class="fa fa-check"></i>Submit</button>
			</div>
		</div>
								
	<script>
		var elementup='';
		var labelper=document.getElementById('labperus');
		function getfoto(i) 
			{
				var fileinput = document.getElementById('foto');
				elementup=i;
				fileinput.click();
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
	</script>