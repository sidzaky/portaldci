
		
		<div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
				<i>Access Gedung</i> <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				 <select id="id_site_dc" onchange="getaccesssite(this.value);" class="form-control col-md-7 col-xs-12">
					<?php 
						foreach ($this->session->userdata('dc_access') as $row){
							echo '<option value="'.$row['id_asset_dc'].'">'.$row['nama_dc'].'</option>';	
						}
					?>
				 </select>
			</div>
		</div>
		
		<div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
				<i>Access Ke Lantai </i> <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				 <select id="level_access" onchange="getavailablekey(this.value);" class="form-control col-md-7 col-xs-12">
					<?php 
						foreach ($listkey as $row){
							if ($row['akses']!='DC' && $row['akses']!='host'){
								echo '<option value="'.$row['akses'].'">'.$row['akses'].'</option>';	
							}
						}
					?>
				 </select>
			</div>
		</div>
		<div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
				<i>Nomor Key yang tersedia</i> <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12" id="form_key_number">
				 <select id="id_key" class="form-control col-md-7 col-xs-12">
				 </select>
			</div>
		</div>
		<div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
				<i>Keperluan</i> <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<textarea class="form-control col-md-7 col-xs-12" id="bussiness"></textarea> 
			</div>
		</div>
		
		
		<div class="item form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
				<i></i>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<button id="checkin_button" type="button" class="btn btn-success btn-sm" onclick="checkin_visitor();" ><i class="fa fa-check"></i>Submit</button>
			</div>
		</div>
								
	<script>
		$(document).ready(function(){
				getaccesssite($('#id_site_dc').val(),true);
			});
		
		function getaccesssite(i,j){
			var data1={
				'id_site_dc': i
			}
			document.getElementById("level_access").innerHTML=""; 
			$("#checkin_button").attr('disabled', 'disabled');
			var list;
			$.ajax({ type:"POST",
						   url: "<?php echo base_url();?>visitor/getlistaccess",
						   data: data1,
						   success:function(msg){
								var data=JSON.parse(msg);
								var z;
								for (z=0;z<data.length;z++){
									if (data[z]['akses']!='DC' && data[z]['akses']!='host'){
										list +='<option value="'+data[z]['akses']+'">'+data[z]['akses']+'</option>';
									}
								} 
								document.getElementById("level_access").innerHTML='<select id="level_access" onchange="getavailablekey(this.value);" class="form-control col-md-7 col-xs-12">'+list+'</select>';
								$("#checkin_button").prop("disabled", false);
								getavailablekey($('#level_access').val());
							}
							
					});	
		
			
		}
		
		function getavailablekey(i){
			var data1={
				'akses': i
			}
			document.getElementById("form_key_number").innerHTML=""; 
			$("#checkin_button").attr('disabled', 'disabled');
			var list;
			$.ajax({ type:"POST",
									   url: "<?php echo base_url();?>visitor/getavailablekey",
									   data: data1,
									   success:function(msg){
											var data=JSON.parse(msg);
											var z;
											for (z=0;z<data.length;z++){
												list +='<option value="'+data[z]['id_key']+'">'+data[z]['nomer']+' ['+data[z]['warna']+' '+data[z]['keterangan']+']</option>';
											} 
											document.getElementById("form_key_number").innerHTML='<select id="id_key" class="form-control col-md-7 col-xs-12">'+list+'</select>';
											$("#checkin_button").prop("disabled", false);
										}
					});	
			}
	
	</script>