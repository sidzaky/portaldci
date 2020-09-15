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
					echo ($this->session->userdata('module_access')['doc']>=2 ? '<a href="document/add"><button type="button" class="btn btn-success waves-effect waves-light" onclick="input_tarikan();" data-toggle="modal" data-target=".modal-asset"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Document</button></a></h3>' : '' );	
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
				      <th>No</th>
				      <th>Nama Dokumen</th>
				      <th>Kategori</th>
				      <th>Deskripsi</th>
				      <th>Creator</th>
					  <th>Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
					$i=1;
				  	foreach($document as $row){
						?>
							<tr style="cursor:pointer;">
								<td><?php echo $i++; ?></td>
								<td><?php echo $row["NAME"] ?></td>
								<td><?php echo $row["kategori"] ?></td>
								<td>
									<?php
									if(strlen($row["DESCRIPTION"]) >= 50){
										echo substr($row["DESCRIPTION"], 0, 50)." ...";
									}
									else {
										echo $row["DESCRIPTION"];
									}
									?>
								</td>
								<td><?php echo $row["USERNAME"] ?> </br> <p><?php echo date('H:i:s d M, Y' ,$row["time"]) ?></td>
								<!--<td class="text-center">
									
								</td>-->
								<td>
								  <a href="<?php echo base_url($row["PATH"])?>">
									<button class="btn btn-default btn-sm" type="button">
									<span class="fa fa-download"></span> Download </button>
									</a>
								  <a href="<?php echo base_url("document/modify/".$row["ID"])?>" class="btn btn-primary btn-xs">Lihat Detail</a>
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
