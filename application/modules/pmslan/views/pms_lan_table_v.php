<table id="example" class="table dataTable " cellspacing="0" width="100%">
				  <thead>
					<tr>
						<th rowspan="2"><i>No</i></th>
						<th rowspan="2"><i>Pengirim</i></th>
						<th rowspan="2"><i>Keterangan</i></th>
						<th colspan="2" style="text-align:center"><i>Surat Masuk</i></th>
						<th colspan="3" style="text-align:center"><i>SIK</i></th>
						<th rowspan="2"><i>Action</i></th>
						<th style="display:none;" rowspan="2"><i>Detail</i></th>
					</tr>
				    <tr>
						<th><i>Nomor</i></th>
						<th><i>Tanggal</i></th>
						<th><i>Nomor</i></th>
						<th><i>SLA</i></th>
						<th><i>Status</i></th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
					$i=0;
					
				  	foreach($pms_lan as $srow){
						$limit=strtotime($srow["tanggal_SIK"])+($srow["SLA"]*86400);
						$today=strtotime(date("d-m-Y"));
						$cekselisih=round(($limit-$today)/86400);
						$selisih=($cekselisih < 0 ? "Terlambat ".($cekselisih*-1)." hari" : $cekselisih." Hari Lagi");
						$selisihdone=($srow["status_SIK"]!="" ? round((($limit - $srow["update_status_SIK"])/86400)) : "");
						$i++;
						$disabled="";
						$tarikan=$con->get_tarikan($srow["id_pms_lan"]);
						$echotarikan='';$rowspan=1;
						foreach ($tarikan as $row){
							$rowspan++;
							$echotarikan.='<tr><td>'.$row->jenis_pms_lan.'</td><td>'.$row->jumlah_pms_lan.'</td><td>'.$row->titik_pertama.'</td><td>'.$row->titik_kedua.'</td><td>'.$row->keterangan.'</td></tr>';
						}
						
						///status pekerjaan oleh BKS///
						if ($srow["status_SIK"]!=null){
							if ($srow["status_SIK"]=='Done'){
								$colortable= 'style="background-color : rgba(54, 162, 235, 0.3);"';
								$statusbycase = ($this->session->userdata('module_access')['pmslan']>=2 && $srow['status_by_case']=="" ? '<button class="btn btn-danger btn-sm" onclick="update_by_case(\''.$srow['id_pms_lan'].'\')" type="button">Done with case?</button>' : "" );
								$status = ($selisihdone > 0 ? "" : '<button class="btn btn-danger btn-sm" type="button">Terlambat '.$selisihdone*(-1)." hari</button><br>" ).$srow["status_SIK"]." at ".date("H:i:s d-M-Y  ", $srow["update_status_SIK"]) ."by ".$srow["USERNAME"].($srow['status_by_case']!=""? "</br> Done by case" : "");
								$disabled="disabled";
							}
							else if ($srow["status_SIK"]=='Cancel') {
								$colortable='style="background-color : rgba(236, 254, 253, 1);"';
								$status = 'Cancel by '.$srow['USERNAME'];	
							}
							else if ($srow["status_SIK"]=='other') {
								$colortable='style="background-color : rgba(255, 205, 86, 1);"';
								$status = 'patched but Not Done Yet ';	
							}
						}
						else {
							$colortable='style="background-color : rgba(255, 205, 86, 1);"';
							$status = 'Not Done Yet</br>' .($this->session->userdata('module_access')['pmslan']>=2  ? '<button class="btn btn-info btn-sm" onclick="status(\''.$srow['id_pms_lan'].'\',\'Done\')" type="button">Done<i class="fa fa-question"></i></button><button class="btn btn-danger btn-sm" onclick="status(\''.$srow['id_pms_lan'].'\',\'Cancel\')" type="button">Cancel<i class="fa fa-question"></i></button>' : '<button class="btn btn-info btn-sm" onclick="status(\''.$srow['id_pms_lan'].'\',\'Done\')" type="button">Set Done<i class="fa fa-question"></i></button>')  ;
						}
						
						echo '<tr '.$colortable.'> 
								<td>'.$i.' </td>
								<td>'.$srow["unit_kerja"].'</td>
								<td>'.$srow["keterangan_surat_masuk"] .'</td>
								<td>'.$srow["nomor_surat_masuk"].'</br>
									'.($srow["document_surat_masuk"]!=null ? '<a target="_blank" href="'.base_url().$srow["document_surat_masuk"].'"><button class="btn btn-info btn-sm" type="button" ><span class="btn-label"><i class="fa fa-download"></i></span> Surat Masuk</button></a>' : '').'
									'.($this->session->userdata('module_access')['pmslan']>=2  ?  '<button '.$disabled.' class="btn btn-primary btn-sm" type="button"  onclick="buttonup(\''.$srow['id_pms_lan'].'\',\'surat_masuk\');"><span class="btn-label"><i class="fa fa-upload"></i></span>Upload/Update Req</button>
									<input  onchange="uploaddokument(\''.$srow['id_pms_lan'].'\',\'surat_masuk\');" type="file" name="trigger_surat_masuk'.$srow['id_pms_lan'].'" id="trigger_surat_masuk'.$srow['id_pms_lan'].'" style="display:none"> 
									<input type="hidden" id="decodeSIK_'.$srow['id_pms_lan'].'" name="decodeSIK_'.$srow['id_pms_lan'].'" value="">' : '').'
								</td>
								<td>'.date("d M, Y", strtotime($srow["tanggal_surat_masuk"])).'</td>
								<td>
									'.($srow["nomor_SIK"]!=null ? $srow["nomor_SIK"] : '').'</br>
									'.($srow["document_SIK"]!=null ? '<a target="_blank" href="'.base_url().$srow["document_SIK"].'"><button class="btn btn-info btn-sm" type="button" ><span class="btn-label"><i class="fa fa-download"></i></span>SIK/WO</button></a>' : '').'
									'.($this->session->userdata('module_access')['pmslan']>=2  ?  '<button '.$disabled.' class="btn btn-primary btn-sm" type="button"  onclick="buttonup(\''.$srow['id_pms_lan'].'\',\'SIK\');"><span class="btn-label"><i class="fa fa-upload"></i></span>Upload/Update WO</button>
									<input  onchange="uploaddokument(\''.$srow['id_pms_lan'].'\',\'SIK\');" type="file" name="trigger_SIK'.$srow['id_pms_lan'].'" id="trigger_SIK'.$srow['id_pms_lan'].'" style="display:none"> 
									<input type="hidden" id="decodeSIK_'.$srow['id_pms_lan'].'" name="decodeSIK_'.$srow['id_pms_lan'].'" value="">' : '').'
									</td>
								<td><button class="btn btn-info btn-sm" type="button">'.$srow["SLA"].' Hari dari '.($srow["tanggal_SIK"]!='0000-00-00' ? date("d M, Y", strtotime($srow["tanggal_SIK"])) : '-').'</button>
									'.($srow['status_SIK']=="" ? '<button class="btn btn-'.($cekselisih<0 ? 'danger' : 'success').' btn-sm" > '.$selisih.'</button>' : "").'
								</td>
								<td>'.$status.'</td>
								<td>
									<button class="btn btn-info btn-sm" data-toggle="modal" onclick="pmslandetail(\''.$srow['id_pms_lan'].'\')" data-target=".modalother" type="button" ><span class="btn-label"><i class="fa fa-search"></i></span>Info</button>
									'.$statusbycase.($this->session->userdata('module_access')['pmslan']>=2  ?  '<button  class="btn btn-warning btn-sm" data-toggle="modal" onclick="input_tarikan(\''.$srow['id_pms_lan'].'\')" data-target=".modal-asset" type="button" ><span class="btn-label"><i class="fa fa-edit"></i></span>Edit</button><button class="btn btn-danger btn-sm" '.$disabled.'  onclick="pmslandel(\''.$srow['id_pms_lan'].'\')" type="button" ><span class="btn-label"><i class="fa fa-close"></i></span>Delete</button>' : '').'
								</td>
								<td style="display:none" id="pms_detail_'.$srow['id_pms_lan'].'">
									<table  class="table table-hover table-striped table-bordered"  >
												<thead>
													<tr>
														<th rowspan="2">Item</th>
														<th colspan="5">Detail</th>
													</tr>
													<tr>
														<th>Jenis Tarikan</th>
														<th>Jumlah Tarikan</th>
														<th>Titik/Koordinat Pertama</th>
														<th>Titik/Koordinat Kedua</th>
														<th>Keterangan</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td rowspan="'.$rowspan.'">Tarikan</td>
													</tr>
													'.$echotarikan.'
													<tr>
														<td>User BRI</td> 
														<td colspan="5">'.($srow["user_BAST"]!=null ? $srow["user_BAST"] :'-').'</td>
													</tr>
													<tr>
														<td>Vendor BAST</td>
														<td colspan="5"> '.($srow["vendor_BAST"]!=null ? $srow["vendor_BAST"] :'-').'</td>
													</tr>
													<tr>
														<td>Tanggal Bast</td>
														<td colspan="5"> '.($srow["tanggal_BAST"]!='0000-00-00' ? $srow["tanggal_BAST"] :'-').'</td>
													</tr>
													
													<tr>
														<td>Surat ijin prinsip</td>
														<td colspan="5">'.($srow["nomor_ijin_anggaran"]!=null ? $srow["nomor_ijin_anggaran"] :'-').'</td>
													</tr>
													<tr>
														<td>Tanggal ijin Anggaran</td>
														<td colspan="5">'.($srow["tanggal_ijin_anggaran"]!='0000-00-00' ? $srow["tanggal_ijin_anggaran"] :'-').'</td>
													</tr>
													<tr>
														<td>Keterangan Ijin Anggaran</td>
														<td colspan="5">'.($srow["keterangan_ijin_anggaran"]!=null ? $srow["keterangan_ijin_anggaran"] :'-').'</td>
													</tr>
													<tr>
														<td>Nomor SPK</td>
														<td colspan="5" >'.($srow["nomor_SPK"]!=null ? $srow["nomor_SPK"] :'').'</td>
													</tr>
													<tr>
														<td>Tanggal SPK</td>
														<td colspan="5">'.($srow["tanggal_SPK"]!='0000-00-00' ? $srow["tanggal_SPK"] :'-').'</td>
													</tr>
												</tbody>
											</table>
							</td>
								
							</tr>';
						}
				  	?>
				  </tbody>
				</table>
				
				<script>
				var iddokument;
				
				function status(i,j){
					if (confirm('Yakin Pak, coba dicek dulu kali aja ada yang lupa???')){
						var data1={
									'id_pms_lan' : i,
									'status_SIK' : j
								};
						$.ajax({ type:"POST",
									   url: "<?php echo base_url();?>pmslan/update_status_SIK",
									   data: data1,
									   success:function(msg){
											$('.x_content').html(msg);
											}
								});		
					}
				}
				
				function uploaddokument(i,j=""){
					var z;
					var files = document.getElementById("trigger_"+j+i).files;
					var file = files[0];
					if (files && file) {
						var reader = new FileReader();
						reader.onload = function(readerEvt) {
							var binaryString = readerEvt.target.result;
							var data1={
								'type' : j,
								'document' : btoa(binaryString),
								'id_pms_lan' : i,
								'name' : $('#trigger_'+j+i).val()
							};
							$.ajax({ type:"POST",
								   url: "<?php echo base_url();?>pmslan/upload_document",
								   data: data1,
								   success:function(msg){
										$('.x_content').html(msg);
										}
							});		
						};
						reader.readAsBinaryString(file);
					}
				}
				
				function buttonup(i,j=""){
						var fileinput = document.getElementById("trigger_"+j+i);
						iddokument=i;
						fileinput.click();
				}
				
				$(document).ready(function() {
					$("#example").DataTable()	
				});
				
				function pmslandetail(i){
					document.getElementById('blank_content').innerHTML = document.getElementById('pms_detail_'+i).innerHTML;
				}
				
				function update_by_case(i){
					if (confirm('Yakin Pak, coba dicek dulu kali aja ada yang lupa???')){
						var data1={
									'id_pms_lan' : i,
								};
						$.ajax({ type:"POST",
									   url: "<?php echo base_url();?>pmslan/update_by_case",
									   data: data1,
									   success:function(msg){
											$('.x_content').html(msg);
											}
								});		
					}
				}
				
				function input_tarikan(i){
						if (i==null){
							var address="<?php echo base_url();?>pmslan/input_request_tarikan";
							var data1=null;
						}
						else{ 
							var address="<?php echo base_url();?>pmslan/get_update_request_tarikan";
							var data1= {
										'id_pms_lan' :  i,
									};
							}
							$.ajax({ type:"POST",
									   url: address,
									   data: data1,
									   success:function(msg){
										   $('#form_pms_lan').html(msg);
										  
											}
									});
					}
				
				</script>