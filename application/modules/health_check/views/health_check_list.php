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
					echo ($this->session->userdata('module_access')['doc']>=2 ? '<a href="health_check/add"><button type="button" class="btn btn-success waves-effect waves-light" onclick="input_tarikan();" data-toggle="modal" data-target=".modal-asset"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah List</button></a></h3>' : '' );	
				?>
				</h3>
				<div class="col-md-9 col-sm-9 col-xs-12">
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
				<table id="example" class="table table-striped" cellspacing="0" width="100%">
				  <thead>
				    <tr>
				      <th rowspan="2" class="align-middle">No</th>
				      <th rowspan="2" class="text-center">Tanggal Test</th>
				      <th rowspan="2" class="text-center">Jenis Test Genset</th>
				      <th colspan="3" class="text-center">Genset 1</th>
					  <th colspan="3" class="text-center">Genset 2</th>
					  <th colspan="3" class="text-center">Genset 3</th>
					  <th colspan="3" class="text-center">Genset 4</th>
					  <th rowspan="2" class="align-middle">PKG</th>
					  <th rowspan="2">Keterangan</th>
					  <th rowspan="2">Aksi</th>
				    </tr>
					
					<tr style="cursor:pointer;">
						<td class="text-center">Oil Level</td>
						<td class="text-center">Solar Stock</td>
						<td class="text-center">Accu Voltage</td>
						<td class="text-center">Oil Level</td>
						<td class="text-center">Solar Stock</td>
						<td class="text-center">Accu Voltage</td>
						<td class="text-center">Oil Level</td>
						<td class="text-center">Solar Stock</td>
						<td class="text-center">Accu Voltage</td>
						<td class="text-center">Oil Level</td>
						<td class="text-center">Solar Stock</td>
						<td class="text-center">Accu Voltage</td>

					</tr>
				  </thead>
				  <tbody>
				  	<?php
					$i=1;
				  	foreach($health_check as $row){
						?>
							<tr style="cursor:pointer;">
								<td><?php echo $i++; ?></td>
								<td><?php echo $row["month"] ?></td>
								<td><?php echo $row["jenis_test"] ?></td>
								<td><?php echo $row["oil_g1"] ?></td>
								<td><?php echo $row["solar_g1"] ?></td>
								<td><?php echo $row["accu_g1"] ?></td>
								<td><?php echo $row["oil_g2"] ?></td>
								<td><?php echo $row["solar_g2"] ?></td>
								<td><?php echo $row["accu_g2"] ?></td>
								<td><?php echo $row["oil_g3"] ?></td>
								<td><?php echo $row["solar_g3"] ?></td>
								<td><?php echo $row["accu_g3"] ?></td>
								<td><?php echo $row["oil_g4"] ?></td>
								<td><?php echo $row["solar_g4"] ?></td>
								<td><?php echo $row["accu_g4"] ?></td>
								<td><?php echo $row["accu_pkg"] ?></td>
								<td><?php echo $row["keterangan"] ?></td>
								<td>
								  <a href="<?php echo base_url($row["lampiran"])?>">
									<button class="btn btn-default btn-sm" type="button">
									<span class="fa fa-download"></span> Download </button>
									</a>
								  <a href="<?php echo base_url("health_check/modify/".$row["id"])?>" class="btn btn-primary btn-xs">Lihat Detail</a>
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
	</div>
</div>
<!-- iCheck -->
