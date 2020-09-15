
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo $headboard ?></h4>
		</div>
		<div class="col-lg-7 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><?php echo  $breadcrumb[0] ?></li>
				<li class="active"><?php echo $breadcrumb[1] ?></li>
			</ol>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="white-box">
				<div class="col-md-7 col-sm-7 col-xs-12"> 
					<h3 class="box-title">
						<a href="<?php echo base_url()?>uploads/document/manual_DC.pdf"><button type="button" class="btn btn-info waves-effect waves-light">Need Help??</button></a>
					</h3>
				</div>
				<div class="x_content" id="x_content">
						<table id="dcgateway" class="table  dataTable no-footer" >
								  <thead>
									<tr>
										<th><i>No</i></th>
										<th><i>Detail Visitor</i></th>
										<th><i>Detail Kunjungan</i></th>
										<th><i>Foto pengunjung</i></th>
										<th><i>Foto Kartu Identitas</i></th>
										<th><i>action</i></th>
									</tr>
								  </thead>
								  <tbody>
								  </tbody>
						</table>
				 </div>
			</div>
		</div>
	</div>
</div>

<div class="visitor-modal fade modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Visitor</h4>
			</div>
			<div id="visitor_content" class="modal-body">
			</div>
		</div>
	</div>
</div>

<div class="first-modal fade modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Visitor</h4>
			</div>
			<div id="blank_content" class="modal-body">
				
			</div>
		</div>
	</div>
</div>

<div class="second-modal fade modal" id="second-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Visitor</h4>
			</div>
			<div id="second_blank_content" class="modal-body">
			</div>
		</div>
	</div>
</div>

<div id="contentapproval" style="display:none">
	<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" id="form" action="" novalidate> 
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i>Catatan Approval</i> <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						<textarea id="notes" class="form-control col-md-7 col-xs-12" ></textarea>
						</div>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i>Approval</i> <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<button class="btn btn-success btn-sm" onclick="approval('1')" type="button" >Approve <i class="fa fa-thumbs-up "></i></button>
							<button class="btn btn-danger btn-sm" onclick="approval('0')" type="button" >Nope <i class="fa fa-thumbs-down "></i></button>
						</div>
			</div>
	</form>
</div>
				
<script>
	$(document).ready(function(){
		$('#dcgateway').DataTable({
				"processing": true, 
				"serverSide": true, 
				"lengthChange": true,
				"order": [], 
				"sDom": "lfrti",
				"ajax": {
					"url": "<?php echo base_url();?>visitor/dcgateway_server_side",
					"type": "POST"},
				"columnDefs": [{"targets": [ 0 ],"orderable": false}],
				"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
						var colours = aData[0];
						var col = colours.split(' ');
						if (col.includes('key')){
							$('td', nRow).css("background-color","#ffff99"); 
						}
						else $('td', nRow).css("background-color","rgba(54, 162, 235, 0.3)");
						return nRow;
				}, 
				drawCallback: function(){
					$("img.lazy").lazyload();
				}
		});
	});
	
	var id_visitor_in;
	function checkin_visitor(i){
					var data1={
														'id_schedule_dc' : i,
																							};
								var address="<?php echo base_url();?>visitor/dc_checkin";
									
								$.ajax({ type:"POST",
															url: address,
																					data: data1,
																											success:function(msg){
																																			$('#dcgateway').DataTable().ajax.reload(null, false);
																																										alert('check In Berhasill');
																																									}
												});	
											
									}
	
	function checkout_visitor(i){
		var data1={
								'id_log_dc' : i
							};
		$.ajax({ type:"POST",
						url: "<?php echo base_url();?>visitor/dc_checkout",
						data: data1,
						success:function(msg){
							$('#dcgateway').DataTable().ajax.reload(null, false);
							alert('checkout berhasil');
						}
				});	
		
	}
	
	function form_visitor(i){
			if (i==null){
				var address="<?php echo base_url();?>visitor/input_visitor";
				var data1=null;
			}
			else{ 
				var address="<?php echo base_url();?>visitor/update_visitor";
				var data1= {
							'id_visitor' :  i,
						};
				}
			$.ajax({ type:"POST",
					   url: address,
					   data: data1,
					   success:function(msg){
						   $('#blank_content').html(msg);
						   
							}
			});
		}
</script>
