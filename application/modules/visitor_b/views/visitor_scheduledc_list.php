
<input type="hidden"  id="fromschedulelistdata" value="1">
		<table id="dcvisitor" class="table  dataTable no-footer" >
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
				  	<?php
					$i=0;
					
					
				  	foreach($dcvisitor as $srow){
						
						$colortable='';
						$remaining=ceil((($srow["range_end"]-time())/60/60/24));
						$remaining = ($remaining > '365' ? round($remaining/365,0) .' years' : $remaining. ' days') ;
						
						$datacek=$con->dc_checkin_cek($srow['id_visitor']);
						if ($datacek!=false) {
							$ischeckin='<button class="btn btn-success waves-effect waves-light btn-sm" onclick="checkout_visitor(\''.$datacek[0]['id_log_dc'].'\');" type="button" ><i class="fa fa-sign-out"></i> Check out</button>';
							$colortable='style="background-color : rgba(255, 205, 86, 1)"';
							
						}
						else { 
							
							if ($srow['organic']==1) $ischeckin='<button class="btn btn-warning waves-effect waves-light btn-sm checkin"  onclick="checkin_visitor(\''.$srow['id_schedule_dc'].'\');" type="button" ><i class="fa fa-sign-in"></i> Check In DC</button>';
							else {
									$gedungcek=$con->checkin_cek($srow['id_visitor']);
								if ($gedungcek['status']=='true'){
									$ischeckin='<button class="btn btn-warning waves-effect waves-light btn-sm checkin"  onclick="checkin_visitor(\''.$srow['id_schedule_dc'].'\');" type="button" ><i class="fa fa-sign-in"></i> Check In DC</button>';
								}
								else continue;
							}
							$colortable='style="background-color :  rgba(54, 162, 235, 0.3)"';
						}
						
						$i++;
						echo 	'<tr '.$colortable.'> 
									<td>'.$i.'</td>
									<td style="color:black;" id="'.$srow['id_visitor'].'">
										<b>'.$srow["name_visitor"].'</b></br>
										<b>'.($srow["organic"]!=0 ? 'BRI // '  : '' ).$srow["company"].'</b> </br>
										<b>Id:'.$srow["id_number"] .'</b></br>
										
									</td>
									<td style="color:black;">
										<b>'.$srow['nama_dc'].' // '.$srow["keterangan_area"].'</b> </br>
										Peralatan	&nbsp : '.$srow["tools"].'</br>
										Kebutuhan	&nbsp : '.$srow["purpose"].'</br>
										Catatan	&nbsp : '.$srow["notes"].'</br>
										'.($srow['document']!='' ? '<a href="'.base_url().$srow['document'].'" download><span class="label label-lg label-info"><span>Download Dokumen Pendukung</span></span></a></br>' : '').'
									</td>
									<td align="center"><a target="_blank" href="'.base_url().($srow['person_img'] !='' ? $srow['person_img'] : 'assets/img/unknown.jpg').'"> <img class="lazy"  data-original="'.base_url().($srow['person_img'] !='' ? $srow['person_img'] : 'assets/img/unknown.jpg').'"  style="max-width:300px;max-height:150px;"></a></td>
						<td align="center"><a target="_blank" href="'.base_url().($srow['idcard_img'] !='' ? $srow['idcard_img'] : 'assets/img/unknown.jpg').'"> <img class="lazy"  data-original="'.base_url().($srow['idcard_img'] !='' ? $srow['idcard_img'] : 'assets/img/unknown.jpg').'"   style="max-width:200px;max-height:150px;"></a></td>
									<td>
										
										'.($this->session->userdata('module_access')['vm3']>=4 ? $ischeckin : '') .'</br>
										<button class="btn btn-success waves-effect waves-light btn-sm" data-toggle="modal" data-target=".first-modal" onclick="form_visitor(\''.$srow['id_visitor'].'\')" data-target=".modal" type="button" ><i class="fa fa-pencil"></i>Edit Visitor</button>
										</td>
								</tr>';
						}
						//Exp : '.date ('d M, Y', $srow["range_end"]).' <span class="label label-warning">'.($remaining<0 ? 'expired': $remaining) .' remaining</span></br>
				  	?>
				  </tbody>
				</table>
				
				<script>
				
						$('#dcvisitor').DataTable({
								scrollX : true,
								fixedHeader: {
									header: true,
									footer: true
								},
								drawCallback: function(){
										$("img.lazy").lazyload();
								}
							});
				
					
					
					
					var id_visitor_in;
					function checkin_visitor(i){
						if (confirm('Telah Membaca NDA????')){
							var data1={
													'id_schedule_dc' : i,
												};
							var address="<?php echo base_url();?>visitor/dc_checkin";
							var notif={
									"heading" : "Warning",
									"text" : "Visitor telah masuk, mohon diperhatikan, terimakasih",
									"icon" : "warning"
								};
							var element='x_content';
							sendajax(data1,address,element,notif,null);
							id_visitor_in='';
						}
					}
		
					function checkout_visitor(i){
						var data1={
												'id_log_dc' : i
											};
						$.ajax({ type:"POST",
										url: "<?php echo base_url();?>visitor/dc_checkout",
										data: data1,
										success:function(msg){
											$('.x_content').html(msg);
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