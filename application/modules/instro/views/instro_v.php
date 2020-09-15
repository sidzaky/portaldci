



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
				<h3 class="box-title">Data list 
				<?php 
					echo ($this->session->userdata('module_access')['instro']>=2 ? ' <button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="input_instro();" data-toggle="modal" data-target=".modal-asset"  ><span class="btn-label"><i class="fa fa-plus"></i></span>Input Insiden/Trouble</button>' : '' );	
				?>
				</h3>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="hidden" required="required" name="visitor" id="visitor" /> 
				</div>
				<div id="item-list">
						<div class="x_content">
							<?php $this->load->view('instro_table_v',$data)?>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
 


<div class="modal fade modal-asset" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Report</h4>
			</div>
			<div class="modal-body" id="form_input">
					</div>	
				
			</div>
		</div>
	</div>

<script>
		
		
		var activeinstro;
		
		
		function input_instro(i){
						if (i==null){
							var address="<?php echo base_url();?>instro/input_instro";
							var data1=null;
						}
						else{ 
							var address="<?php echo base_url();?>instro/get_update_instro";
							var data1= {
										'id_instro' :  i,
									};
							}
							$.ajax({ type:"POST",
									   url: address,
									   data: data1,
									   success:function(msg){
										   $('#form_input').html(msg);
											}
									});
					}
		function disfile(i,k){
					if (confirm('yakin menghapus file '+k+'???')){
						var data1={
									'id_file_instro_log' : i,
								};
						$.ajax({ type:"POST",
									   url: "<?php echo base_url();?>instro/disablefile",
									   data: data1,
									   success:function(msg){
											$('.x_content').html(msg);
											}
								});		
					}
				}
				
				
		function disasset(i,k){
					if (confirm('yakin unsert asset impact '+k+'???')){
						var data1={
									'id_instro_log_asset' : i,
								};
						$.ajax({ type:"POST",
									   url: "<?php echo base_url();?>instro/deleteassetlog",
									   data: data1,
									   success:function(msg){
											$('.x_content').html(msg);
											}
								});		
					}
				}
		function listasset(i){
			activeinstro=i;
			$.ajax({ type:"POST",
				   url: "<?php echo base_url();?>instro/getasset",
				   success:function(msg){
						$('#form_input').html(msg);
						}
				});	
			
		}
		
		function asset_select(i){
			var data1={
				'id_asset' : i,
				'id_instro_log' : activeinstro
			}
			$.ajax({ type:"POST",
				   url: "<?php echo base_url();?>instro/instroaddasset",
				   data: data1,
				   success:function(msg){
						$('.x_content').html(msg);
						}
				});	
		}
		
		function dislog(i){
			if (confirm('yakin???')){
				var data1={
							'id_instro' : i,
						};
				$.ajax({ type:"POST",
							   url: "<?php echo base_url();?>instro/disable_instro_log",
							   data: data1,
							   success:function(msg){
									$('.x_content').html(msg);
									}
						});		
			}
		}

		function uploadfile(i){
			var z;
			var files = document.getElementById("trigger_"+i).files;
			var file = files[0];
			if (files && file) {
				var reader = new FileReader();
				reader.onload = function(readerEvt) {
					var binaryString = readerEvt.target.result;
					var data1={
						'document' : btoa(binaryString),
						'id_instro' : i,
						'name' : $('#trigger_'+i).val()
					};
					$.ajax({ type:"POST",
						   url: "<?php echo base_url();?>instro/upload_document_instro",
						   data: data1,
						   success:function(msg){
								$('.x_content').html(msg);
								}
					});		
				};
				reader.readAsBinaryString(file);
			}
		}
	 
		function buttonup(i){
				var fileinput = document.getElementById("trigger_"+i);
				iddokumentSIK=i;
				fileinput.click();
		}
		
		$(".table").DataTable();	
	</script>
	
