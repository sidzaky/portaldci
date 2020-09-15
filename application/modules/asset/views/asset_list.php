<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo $headboard ?></h4>
		</div>
	</div>
	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="white-box">
				<div class="col-md-9 col-sm-9 col-xs-12">
				<a href="<?php echo base_url()?>asset/add"><button type="button" class="btn btn-success waves-effect waves-light"><span class="btn-label"><i class="fa fa-plus"></i></span>Input Asset baru</button></a>
				</div>
				<div id="item-list">
						<div class="x_content">
								<?php
							if(isset($info)){
							?>
								<div class="alert <?php echo $info["class"]; ?>"><?php echo $info["text"]; ?></div>
							<?php
							}
							?>
							<table id="example2" class="table table-striped no-footer" cellspacing="0" width="100%">
								<thead>
									<tr>  
										<th><i>Nama</i></th>
										<th><i>Tipe</i></th>
										<th><i>Group</i></th>
										<th><i>Jenis</i></th>
										<th><i>Brand</i></th>
										<th><i>Owner</i></th>
										<th>Lokasi</th>
										<th>Serial Number</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php
								foreach($asset as $row){
									?>
										<tr class="<?php echo $row["ACTIVE"]=="N" ? "red":""; ?>" style="cursor:pointer;"
											data-url="<?php echo base_url("asset/detail/".$row["ID"])?>">
											<td><?php echo $row["HOSTNAME"] . ( $row["ACTIVE"]=="Y" ? "": " <span class=\"label label-danger\"><i class=\"fa fa-close\"></i>Non ACTIVE</span>" ) ?></td>
											<td><?php echo $row["TYPE"] ?></td>
											<td><?php echo $row["GROUP"]?></td>
											<td><?php echo $row["jenis_nama"] ?></td>
											<td><?php echo $row["BRAND"] ?></td>
											<td><?php echo $row["IP_ADDRESS"] ?></td>
											<td><?php echo $row["LOCATION"].' / '.$row["nama_dc"] ?></td>
											<td><?php echo $row["SERIAL_NUMBER"] ?></td>
											<td>
												<a href="<?php echo base_url("asset/detail/".$row["ID"])?>" class="btn btn-primary btn-xs">Lihat Detail</a>
											</td>
										</tr>
									<?php
								}
								?>
								</tbody>
							</table>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
		
	<script src="<?php echo base_url()?>assets/js/morris.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/datatables/buttons.flash.min.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/datatables/jszip.min.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/datatables/0.1.36/pdfmake.min.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/datatables/0.1.36/vfs_fonts.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/datatables/buttons.print.min.js"></script>
<script>
	$('#example2').DataTable({dom: 'Bfrtip',buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],});

</script>