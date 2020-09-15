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
				<h3 class="box-title">Form Inventory
				</h3>
				   <p>Mohon masukkan data-data sesuai dengan yang seharusnya. Terima Kasih</p>
				<div class="col-md-9 col-sm-9 col-xs-12">
				
				</div>
				<div id="item-list">
					<div class="x_content">
						<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" id="form" action="<?php echo base_url("inventory/modify/".$inventory["id"]); ?>" validate>

						
							  <!-- elements in form tag -->
							 
								<?php
								if(isset($info)){ 
								?>
									<div class="alert <?php echo $info["class"]; ?>"><?php echo $info["text"]; ?></div>
								<?php
								}
								?>
							<div class="row">
								<div class="col-md-12">
								    <div class="item form-group">
										<label class="hidden" for="name">ID</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input type="hidden" name="id" id="id" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $inventory["id"]; ?>">
										</div>
									</div> 
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jenis Perangkat</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input type="text" name="jenis" id="jenis" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $inventory["jenis"]; ?>">
										</div>
									</div> 
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tipe Perangkat</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input type="text" name="tipe" id="tipe" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $inventory["tipe"]; ?>">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Serial Number</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input type="text" name="sn" id="sn" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $inventory["sn"]; ?>">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
											Tanggal Masuk <span class="required"></span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input type="date" id="tgl_masuk" name="tgl_masuk"  class="form-control col-md-4 col-xs-8" value="<?php echo $inventory["tgl_masuk"]; ?>">
										  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pemilik</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input type="text" name="pemilik" id="pemilik" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $inventory["pemilik"]; ?>">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Koordinat Perangkat</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input type="text" name="koordinat" id="koordinat" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $inventory["koordinat"]; ?>">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nomor Unit (dalam rak)</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input type="text" name="no_unit" id="no_unit" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $inventory["no_unit"]; ?>">
										</div>
									</div>
									 <div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_date">
										  Lampiran <span class="required"></span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <span>
											<input type="file" name="lampiran" id="lampiran"/>
											<input type="hidden" name="lampiran_old" id="lampiran_old" value="<?php echo $inventory["lampiran"]?>" />
										  </span>
										  <span>
											<a href="<?php echo base_url($inventory["lampiran"])?>" class="btn btn-xs btn-default" target="_blank">
											  <i class="fa fa-photo"></i> Lihat Lampiran
											</a>  
										  </span>
										</div>
									</div>
									
									<div class="ln_solid"></div>
									  <div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
										  <button type="submit" class="btn btn-success">Submit</button>
										  <button type="reset" class="btn btn-warning">Clear</button>
										  <button type="button" onclick="if (confirm('yakin???')){window.location.replace('<?php echo base_url("inventory/drop/".$inventory["id"])?>');}" class="btn_drop btn btn-danger" dat="">Hapus Data</button>
										</div>
									</div>
								  <!-- elements in form tag -->
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- validator -->
<script src="<?php echo base_url("vendors/validator/validator.js"); ?>"></script>
<!-- Autosize -->
<script src="<?php echo base_url("vendors/autosize/dist/autosize.min.js"); ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url("vendors/moment/min/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.js"); ?>"></script>