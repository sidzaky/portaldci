
<?php 
	echo '
			<form class="form-horizontal form-material form-label-left" method="POST" enctype="multipart/form-data" id="form" action="" novalidate> 
			'.($data[0]['id_instro']!=null ? '  <input type="hidden" id="id_instro"  value="'.$data[0]['id_instro'].'">' : '' ).'
			<input type="hidden" id="time_input"  value="'.($data[0]['time_input']!=null ? $data[0]['time_input'] : time() ).'">
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
									<i>Event Log</i> <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <textarea '.$disabled.' type="text" id="keterangan_instro" class="form-control col-md-7 col-xs-12">'.$data[0]['keterangan_instro'].'</textarea>
								</div>
							</div>
							
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
									<i>Waktu Terjadi</i> <span class="required">*</span>
								</label>
								 <div id="datetimepicker" class="input-append date">
									 <div class="col-md-2 col-sm-2 col-xs-12">
										<input id="time_start_instro" value="'.date('d-m-Y H:i:s' , ($data[0]['time_start_instro']!=null ?$data[0]['time_start_instro'] : "" )).'" class="form-control col-md-7 col-xs-12"  data-format="dd-MM-yyyy hh:mm:ss" type="text"></input>
										 <span class="add-on"><i style="display:none;" data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar"></i></span>
									  </div>
								  </div>
								  <label class="control-label col-md-1 col-sm-1 col-xs-12" for="hostname">
										<i>Hingga</i> <span class="required">*</span>
									</label>
								  
									<div id="datetimepicker1" class="input-append date">
										<div class="col-md-2 col-sm-2 col-xs-12">
											<input id="time_solve_instro" value="'.date('d-m-Y H:i:s' ,($data[0]['time_solve_instro']!=null ? $data[0]['time_solve_instro'] : '')).'" class="form-control col-md-7 col-xs-12"  data-format="dd-MM-yyyy hh:mm:ss" type="text">
											<span class="add-on"><i style="display:none;" data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar"></i></span>
										</div>
									</div>
								<label class="control-label col-md-1 col-sm-1 col-xs-12" for="hostname">
									<button type="button" class="btn btn-info btn-sm" style="position:absolute;" onclick="document.getElementById(\'time_solve_instro\').value=\'\';"><i class="fa fa-refresh"></i>Reset waktu kedua!!</button>
								</label>
							</div>
								
							
							
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
									<i>Penyebab (root cause)</i> 
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <textarea '.$disabled.' type="text"  id="root_instro" class="form-control col-md-7 col-xs-12"> '.$data[0]['root_instro'].'</textarea>
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
									<i>Impact </i> 
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <textarea '.$disabled.' type="text"  id="impact_instro"  class="form-control col-md-7 col-xs-12"> '.$data[0]['impact_instro'].'</textarea>
								</div>
							</div>
							
							
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
									<i>Solution</i> 
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <textarea '.$disabled.' type="text"   id="solution_instro" class="form-control col-md-7 col-xs-12">'.$data[0]['solution_instro'].'</textarea>
								</div>
							</div>
							
							<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									  <button type="button" class="btn btn-success btn-sm" onclick="input_datamasuk();" ><i class="fa fa-check"></i>Submit</button>
									</div>
								</div>		
							</form>';
		?>				
<script>
		$(function() {
			  $("#time_start_instro").click(function(){
					$("#datetimepicker").datetimepicker({
						language: "pt-BR"
						}).datetimepicker("show")
			  });
			  
			   $("#time_solve_instro").click(function(){
					$("#datetimepicker1").datetimepicker({
							sideBySide: true,
						}).datetimepicker("show")
			  });
		});
		
		
		
		function input_datamasuk(){	
			var data1 = { 
				'id_instro'  : $('#id_instro').val(),
				'time_input'  : $('#time_input').val(),
				'time_start_instro'  : $('#time_start_instro').val(),
				'keterangan_instro' : $('#keterangan_instro').val(),
				'impact_instro' : $('#impact_instro').val(),
				'id_asset' : $('#id_asset').val(),
				'root_instro' : $('#root_instro').val(),
				'solution_instro' : $('#solution_instro').val(),
				'time_solve_instro' : $('#time_solve_instro').val(),
				}
			if (data1['time_start_instro']!=''){
				$.ajax({ 
					type:"POST",
					url: "<?php echo base_url()?>instro/input_instro",
					data: data1,
					success:function(msg){
						$('.x_content').html(msg);
						$('.modal').modal('hide');
						alert('Input Sukses');
					}
				});
			}
			else alert ('waktu kejadian tidak boleh kosong');
		}

</script>