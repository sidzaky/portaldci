
	<table id="example2" class="table table-striped">
											<thead>
												  <tr>
													<th>No</th>
													<th>Order</th>
													<th>Product</th>
													<th>Target Product/Sup or Ret</th>
													<th>Lokasi Pemasaran</th>
													<th>Order</th>
													<th>Deadline</th>
													<th>Status</th>
												  </tr>
											</thead>
									<tbody>
									<?php 
										$i=1;
										foreach ($order as $row){
											$status='';
											if ($row->status==0) $status='<div class="label label-table label-warning">Mencari Sales</div>';
											elseif ($row->status==1) $status='<div class="label label-table label-primary">'.$row->so_nama.'</div>';
											elseif ($row->status==2) $status='<div class="label label-table label-danger">Order Gagal/Cancel</div>';
											else  $status='<div class="label label-table label-success">Order selesai</div>';
											
											echo '<tr>
														<td>'.$i.'</td>
														<td><div class="label label-table label-info" > <i class="fa  '.($row->order_type == 'Suplier' ? 'fa-shopping-cart' : 'fa  fa-dropbox').'"></i>'.$row->order_type.'</div></td>
														<td>'.$row->retailer_product.$row->suplier_product.'</td>
														<td>'.($row->jumlah_product_sup!=0 ? $row->jumlah_product_sup : '' ).$row->jumlah_order_retailer.'/'.$row->jumlah_ret_sup.'</td>
														<td>'.$row->nama_kota.'</td>
														<td>'.date("d M-Y", $row->order_date).'</td>
														<td>'.date("d M-Y", strtotime($row->deadline)).'</td>
														<td>'.$status.'</td>
													
														</tr>	
														';
											$i++;
										}
									?>
									</tbody>
	</table>