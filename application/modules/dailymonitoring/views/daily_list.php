



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
				<h3 class="box-title">
					<div class="col-md-6 col-sm-6 col-xs-12">
					  <select id="asset_select" class="form-control col-md-4 col-xs-8" 	 onchange="showdata();">
						<option>----SELECT----</option>
						<?php 
							foreach ($asset as $z){
							$i++;
							echo '<option value="'.$z['ID'].';'.$z['jenis_nama'].'">'.$z['HOSTNAME'].' ('.$z['nama_dc'].')</option>';
						}?>
					  </select>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<label class="control-label col-md-6 col-sm-6 col-xs-6" >
							Tanggal Monitoring
						</label>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<input type="text" id="datadate" data-provide="datepicker" class="datepicker form-control col-md-4 col-xs-8" class="form-control col-md-4 col-xs-8" onchange="showdata();" placeholder="Date Report"/>
						  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
						</div>
					</div>
				 </h3>
				<div id="item-list">
						<div class="x_content">
							<div id="showdatacontent">
		  
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	function showdata(i){
		//alert ($('#asset_select').val());
		var data1 = { 	
							'asset' :  $('#asset_select').val(),
							'date' :  $('#datadate').val(),
						};
		if (data1['asset']!='' && data1['date']!=''){
			$.ajax({ type:"POST",
						   url: "<?php echo base_url()?>dailymonitoring/showdata",
						   data: data1,
						   success:function(msg){
							   $('#showdatacontent').html(msg)
								}
							});
		}
	}

</script>