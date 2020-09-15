
<?php $i=0;
						foreach ($ups as $row){
							$time.='<th style="text-align:right">'.date('H:i', $row->time).'</th>';
							$userinput.='<td style="text-align:right">'.$row->USERNAME.'</td>';
							$input_Van.='<td style="text-align:right">'.$row->input_Van.'</td>';
							$input_Vbn.='<td style="text-align:right">'.$row->input_Vbn.'</td>';
							$input_Vcn.='<td style="text-align:right">'.$row->input_Vcn.'</td>';
							$input_Ia.='<td style="text-align:right">'.$row->input_Ia.'</td>';
							$input_Ib.='<td style="text-align:right">'.$row->input_Ib.'</td>';
							$input_Ic.='<td style="text-align:right">'.$row->input_Ic.'</td>';
							$input_PF.='<td style="text-align:right">'.$row->input_PF.'</td>';
							$input_KVA.='<td style="text-align:right">'.$row->input_KVA.'</td>';
							$input_KW.='<td style="text-align:right">'.$row->input_KW.'</td>';
							$input_freq.='<td style="text-align:right">'.$row->input_freq.'</td>';
							
							$output_Van.='<td style="text-align:right">'.$row->output_Van.'</td>';
							$output_Vbn.='<td style="text-align:right">'.$row->output_Vbn.'</td>';
							$output_Vcn.='<td style="text-align:right">'.$row->output_Vcn.'</td>';
							$output_Ia.='<td style="text-align:right">'.$row->output_Ia.'</td>';
							$output_Ib.='<td style="text-align:right">'.$row->output_Ib.'</td>';
							$output_Ic.='<td style="text-align:right">'.$row->output_Ic.'</td>';
							$output_PF.='<td style="text-align:right">'.$row->output_PF.'</td>';
							$output_KVA.='<td style="text-align:right">'.$row->output_KVA.'</td>';
							$output_KW.='<td style="text-align:right">'.$row->output_KW.'</td>';
							$output_freq.='<td style="text-align:right">'.$row->output_freq.'</td>';
							
							$bypass_Van.='<td style="text-align:right">'.$row->bypass_Van.'</td>';
							$bypass_Vbn.='<td style="text-align:right">'.$row->bypass_Vbn.'</td>';
							$bypass_Vcn.='<td style="text-align:right">'.$row->bypass_Vcn.'</td>';
							$bypass_Ia.='<td style="text-align:right">'.$row->bypass_Ia.'</td>';
							$bypass_Ib.='<td style="text-align:right">'.$row->bypass_Ib.'</td>';
							$bypass_Ic.='<td style="text-align:right">'.$row->bypass_Ic.'</td>';
							$bypass_freq.='<td style="text-align:right">'.$row->bypass_freq.'</td>';
							
							$battery_Vdc.='<td style="text-align:right">'.$row->battery_Vdc.'</td>';
							$battery_Idc.='<td style="text-align:right">'.$row->battery_Idc.'</td>';
							$battery_percent.='<td style="text-align:right">'.$row->battery_percent.'</td>';
							
							$envi_temp.='<td style="text-align:right">'.$row->envi_temp.'</td>';
							$envi_humidity.='<td style="text-align:right">'.$row->envi_humidity.'</td>';
							
							$notes.='<td style="text-align:right">'.$row->notes.'</td>';
							
							$i++;
						}
						?>
		<div class="x_content">
				  <table id="table_report" class="table table-hover table-striped table-bordered" cellspacing="0">
					<thead>
						<tr>
							<th rowspan="2">
								parameter
							</th>
							<th colspan="<?php echo $i?>" style="text-align:center"> Time
							</th>
						</tr>
						<tr>
							<?php echo $time;?>
						</tr>
					</thead>
					
					<tbody>
						<?php 
							echo "	
									<tr><td>user input</td>".$userinput."</tr>
								
									<tr><td>Input Van</td>".$input_Van."</tr>
									<tr><td>Input Vbn</td>".$input_Vbn."</tr>
									<tr><td>Input Vcn</td>".$input_Vcn."</tr>
									<tr><td>Input Ia</td>".$input_Ia."</tr>
									<tr><td>Input Ib</td>".$input_Ib."</tr>
									<tr><td>Input Ic</td>".$input_Ic."</tr>
									<tr><td>Input PF</td>".$input_PF."</tr>
									<tr><td>Input KVA</td>".$input_KVA."</tr>
									<tr><td>Input KW</td>".$input_KW."</tr>
									<tr><td>Input freq</td>".$input_freq."</tr>
									
								
									<tr><td>output Van</td>".$output_Van."</tr>
									<tr><td>output Vbn</td>".$output_Vbn."</tr>
									<tr><td>output Vcn</td>".$output_Vcn."</tr>
									<tr><td>output Ia</td>".$output_Ia."</tr>
									<tr><td>output Ib</td>".$output_Ib."</tr>
									<tr><td>output Ic</td>".$output_Ic."</tr>
									<tr><td>output PF</td>".$output_PF."</tr>
									<tr><td>output KVA</td>".$output_KVA."</tr>
									<tr><td>output KW</td>".$output_KW."</tr>
									<tr><td>output freq</td>".$output_freq."</tr>
									
									
									<tr><td>bypass Van</td>".$bypass_Van."</tr>
									<tr><td>bypass Vbn</td>".$bypass_Vbn."</tr>
									<tr><td>bypass Vcn</td>".$bypass_Vcn."</tr>
									<tr><td>bypass Ia</td>".$bypass_Ia."</tr>
									<tr><td>bypass Ib</td>".$bypass_Ib."</tr>
									<tr><td>bypass Ic</td>".$bypass_Ic."</tr>
									<tr><td>bypass freq</td>".$bypass_freq."</tr>
									
									
									<tr><td>Battery Vdc</td>".$battery_Vdc."</tr>
									<tr><td>Battery Idc</td>".$battery_Idc."</tr>
									<tr><td>Battery Percent</td>".$battery_percent."</tr>
									
									
									<tr><td>Environment Temp</td>".$envi_temp."</tr>
									<tr><td>Environment Humidity</td>".$envi_humidity."</tr>
									
									<tr><td>Notes</td>".$notes."</tr>
							";
						?>
					</tbody>
				  </table>
			  </div>
			  
			  
		<script>
			$(document).ready(function() {
					$("#table_report").DataTable({
						paging: false,
						ordering : false,
						"scrollX": true,
						"scrollY":        "600px",
						"scrollCollapse": true,
						dom: 'Bfrtip',
						buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
					});	
				});
		</script>