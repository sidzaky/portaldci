



<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo $headboard ?></h4>
		</div>
	</div>
	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="white-box">
				<h3 class="box-title">Data list 
				<?php 
					echo ($this->session->userdata('module_access')['pmslan']>=2 ? '<button type="button" class="btn btn-success waves-effect waves-light" onclick="input_tarikan();" data-toggle="modal" data-target=".modal-asset"><span class="btn-label"><i class="fa fa-plus"></i></span>Input tarikan baru</button></h3>' : '' );	
				?>
				</h3>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="hidden" required="required" name="visitor" id="visitor" /> 
				</div>
				<div id="item-list">
						<div class="x_content">
							<?php $this->load->view('pms_lan_table_v',$data)?>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modalother" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form PMS Lan</h4>
			</div>
			<div id="blank_content" class="modal-body">
			</div>
		</div>
	</div>
</div>
	

<div class="modal fade modal-asset" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form PMS Lan</h4>
			</div>
			<div class="modal-body" id="form_pms_lan">
					</div>
			</div>
		</div>
	</div>
</div>
<script>
		
		
		function pmslandel(i){
				if (confirm('Ciyus???')){
					if (i!=''){
						var data1= {
									'id_pms_lan' :  i,
								};
						
						$.ajax({ type:"POST",
								   url: "<?php echo base_url();?>pmslan/delete",
								   data: data1,
								   success:function(msg){
										$('.x_content').html(msg);
										alert ('delete sukses');
										}
								});
					}
				}
		}
		
		
		// $("#pmslan_table").DataTable({"order": [[ 7, "desc" ]]});	
	</script>
	
