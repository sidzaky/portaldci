
<?php 
	echo '
			<form class="form-horizontal form-material form-label-left" method="POST" enctype="multipart/form-data" id="form" action="" novalidate> 
			'.($data[0]['ID']!=null ? '  <input type="hidden" id="ID"  value="'.$data[0]['ID'].'">' : '' ).'
			<input type="hidden" id="TIME_INPUT"  value="'.($data[0]['TIME_INPUT']!=null ? $data[0]['time_input'] : time() ).'">
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
									<i>Event Maintenance</i> <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <textarea '.$disabled.' type="text" id="DESCRIPTION" class="form-control col-md-7 col-xs-12">'.$data[0]['DESCRIPTION'].'</textarea>
								</div>
							</div>
							
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
									<i>Waktu Maintenance</i> <span class="required">*</span>
								</label>
								 <div id="datetimepicker" class="input-append date">
									 <div class="col-md-6 col-sm-6 col-xs-12">
										<input id="EVENT_DATE" value="'.date('d-m-Y' , ($data[0]['EVENT_DATE']!=null ?$data[0]['EVENT_DATE'] : "" )).'" class="form-control col-md-7 col-xs-12"  data-format="dd-MM-yyyy" type="text"></input>
										 <span class="add-on"><i style="display:none;" data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar"></i></span>
									  </div>
								  </div>
							</div>	
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
									<i>Asset Maintenance</i> <span class="required">*</span>
								</label>
								
									 <div class="col-md-6 col-sm-6 col-xs-12">
										<input id="ASSET_ID" value="'.$data[0]['ASSET_ID'].'" class="form-control col-md-7 col-xs-12"  type="hidden"></input>
										<input id="ASSET_ID_view" value="'.$data[0]['HOSTNAME'].'" class="form-control col-md-7 col-xs-12"  type="text" disabled></input>
										<span class="add-on"><i style="display:none;" data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar"></i></span>
									  </div>
							
							</div>	
							
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
								</label>
							
									 <div class="col-md-6 col-sm-6 col-xs-12">
										 <button type="button" class="btn btn-success btn-xs" onclick="input_datamasuk();">Submit</button>
									  </div>
								 
							</div>	
							</form>
							
							';
				
		?>				
<script>

		
		$(function() {
			  $("#EVENT_DATE").click(function(){
					$("#datetimepicker").datetimepicker({
						language: "pt-BR"
						}).datetimepicker("show")
			  });
		});
		
		
		
		function input_datamasuk(){	
			var data1 = { 
				'ID'  : $('#ID').val(),
				'EVENT_DATE'  : $('#EVENT_DATE').val(),
				'TIME_INPUT'  : $('#TIME_INPUT').val(),
				'DESCRIPTION' : $('#DESCRIPTION').val(),
				'ASSET_ID'	: $('#ASSET_ID').val()
				}
			if (data1['EVENT_DATE']!='' && data1['DESCRIPTION']!=''){
				$.ajax({ 
					type:"POST",
					url: "<?php echo base_url()?>maintenance/input_maintenance",
					data: data1,
					success:function(msg){
						$('.x_content').html(msg);
						$('.modal').modal('hide');
						alert('Input Sukses');
					}
				});
			}
			else alert ('Tolong Lengkapi Form');
		}

</script>