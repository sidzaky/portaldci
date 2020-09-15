




<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo $headboard ?></h4>
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
				<h3 class="box-title">Select Data center :  
						<?php 
							$i=0;
							foreach ($dc as $z){
								$select .= '<option value="'.$z['id_asset_dc'].'">'.$z['nama_dc'].'</option>';
								$i++;
							}
							?>	
							<select id="dc_select" class="" onchange="showform(this.value);">
							<option>----SELECT----</option>
								<?php echo $select;?>
				</select>
				</h3>
				
				
				<div id="item-list">

						<div class="x_content">
						
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

	
	
	<script>

		function showform(i){
			var data1 = { 	
							'id_dc' :  i,
						};
			$.ajax({ type:"POST",
					   url: "<?php echo base_url();?>dailymonitoring/showformups",
					   data: data1,
					   success:function(msg){
							$('.x_content').html(msg);
							init_SmartWizard();
							init_validator();
							init_compose();
							
					}
				});		
		}
	</script>