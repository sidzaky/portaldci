
	




<table id="example2" class="table dataTable no-footer" cellspacing="0" >
		<thead>
			<tr>
				<th>No</th>
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
				$button='<button class="btn btn-warning waves-effect waves-light btn-sm" onclick="cancel(\''.$srow['id_schedule_dc'].'\');" type="button" >Cancel? <i class="fa fa-deviantart"></i></button>';
				$colortable='';
				if ($srow['approval']=='1'){
					$status='<span class="label label-success">Granted</span>';
					$colortable='style="background-color :  rgba(54, 162, 235, 0.3)"';
					if ($this->session->userdata('module_access')['vm2']>=5){
						$button='<button class="btn btn-warning  waves-effect waves-light btn-sm" data-toggle="modal" data-target=".first-modal" onclick="approval();id_schedule_dc=\''.$srow['id_schedule_dc'].'\'" data-target=".modal" type="button" >Edit Approval? <i class="fa fa-deviantart"></i></button>';
					}
				}
				elseif ($srow['approval']=='0'){
					$status='<span class="label label-danger">Denied</span>';
					$colortable='';
					$button='';
				}
				
				else {
					$status='<span class="label label-warning">Waiting Aprroval</span>';
					$colortable='style="background-color : rgba(255, 205, 86, 1)"';
					if ($this->session->userdata('module_access')['vm2']>=5){
						$button='<button class="btn btn-warning waves-effect waves-light btn-sm" data-toggle="modal" data-target=".first-modal" onclick="approval();id_schedule_dc=\''.$srow['id_schedule_dc'].'\'" data-target=".modal" type="button" >Approval? <i class="fa fa-deviantart"></i></button>';
					}
				}
					$remaining=ceil((($srow["range_end"]-time())/60/60/24));
					$remaining = ($remaining > '365' ? round($remaining/365,0) .' years' : $remaining. ' days').' remaining' ;
					if ($remaining<0) { 
						$remaining = '<span class="label label-danger">expired</span>';
						$button='<button class="btn btn-info waves-effect waves-light btn-sm">nothing to do <i class="fa fa-child"></i></button>';
						$colortable='';
						}
					else {
						$remaining = '<span class="label label-info">'.$remaining.'</span>';
					}
					
					
					
					$i++;
					echo 	'<tr '.$colortable.'> 
								<td>'.$i.'</td>
								<td id="'.$srow['id_visitor'].'">
									<b><span class="label label-primary">'.$srow["name_visitor"].'</span></b></br>
									<span class="label label-primary">'.($srow["organic"]!=0 ? 'PT. BRI / '  : '' ).$srow["company"].'</span></br>
									<span class="label label-primary"> Id  : '.$srow["id_number"] .'</span></br>
									<span class="label label-success"> By  :'.$srow["USERNAME"] .' / '.$srow["BAGIAN"] .'</span></br>
									'.$status.'
								</td>
								<td>Mulai :'.date ('d M, Y', $srow["range_start"]).'</br>
									Selesai	: '.date ('d M, Y', $srow["range_end"]).'</br>'.$remaining.'</br>
									<span class="label label-warning"><b>'.$srow['nama_dc'].' // '.$srow["keterangan_area"].'</b></span> </br>
									'.$srow["purpose"].'</br>
									Barang : '.$srow["tools"].'</br>
									
									'.($srow["notes"]!='' ? 'Alasan		&nbsp : '.$srow["notes"] :'').'
									'.($srow['document']!='' ? '<a href="'.base_url().$srow['document'].'" download><span class="label label-lg label-info"><span>Download Dokumen Pendukung</span></span></a></br>' : '').'
								</td>
								<td align="center"><a target="_blank" href="'.base_url().($srow['person_img'] !='' ? $srow['person_img'] : 'assets/img/unknown.jpg').'"> <img src="'.base_url().($srow['person_img'] !='' ? $srow['person_img'].'_t' : 'assets/img/unknown.jpg').'" style="max-width:300px;max-height:150px;"></a></td>
								<td align="center"><a target="_blank" href="'.base_url().($srow['idcard_img'] !='' ? $srow['idcard_img'] : 'assets/img/unknown.jpg').'"> <img src="'.base_url().($srow['idcard_img'] !='' ? $srow['idcard_img'].'_t' : 'assets/img/unknown.jpg').'" style="max-width:200px;max-height:150px;"></a></td>
								<td>'.$button.'</td>
							</tr>';
				}
			?>
		</tbody>
	</table>
	
				
				<script>
					$( document ).ready(function() {
						$("#example2").DataTable();
					});
					function statusapproval(i){
						var data1={
							'statusapproval' : i.value
						}
						$.ajax({ 		
								type:"POST",
								url: "<?php echo base_url();?>visitor/reqscheduledc_list",
								data: data1,
								success:function(msg){
										$('.x_content').html(msg);
										$("#example2").DataTable();
										
									}
								});	
					}
					
				</script>