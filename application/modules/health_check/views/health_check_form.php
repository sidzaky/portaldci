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
				<h3 class="box-title">Health Check Genset
				</h3>
				   <p>Mohon masukkan data-data sesuai dengan yang seharusnya. Terima Kasih</p>
				<div class="col-md-9 col-sm-9 col-xs-12">
				
				</div>
				<div id="item-list">
					<div class="x_content">
						<form  class="form-horizontal form-material" method="POST" enctype="multipart/form-data"  id="form" action="<?php echo base_url("health_check/add"); ?>" validate>
								
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
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					Tanggal Tes <span class="required"></span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="date" id="month" name="month"  class="form-control col-md-4 col-xs-8" >
					<span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
				  Jenis Test
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <select name="jenis_test" id="jenis_test" class="form-control col-md-7 col-xs-12">
					<option value="Dengan Beban">Dengan Beban</option>
					<option value="Tanpa Beban">Tanpa Beban</option>
				  </select>
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Oil Level Genset 1</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="oil_g1" id="oil_g1" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div> 
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Solar Stock Genset 1</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="solar_g1" id="solar_g1" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Accu Voltage Genset 1</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="accu_g1" id="accu_g1" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div>
			
		<div class="col-md-12 col-sm-12 col-xs-12">
		  
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Oil Level Genset 2</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="oil_g2" id="oil_g2" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div> 
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Solar Stock Genset 2</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="solar_g2" id="solar_g2" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Accu Voltage Genset 2</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="accu_g2" id="accu_g2" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div>
			
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Oil Level Genset 3</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="oil_g3" id="oil_g3" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div> 
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Solar Stock Genset 3</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="solar_g3" id="solar_g3" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Accu Voltage Genset 3</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="accu_g3" id="accu_g3" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div>
		  
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Oil Level Genset 4</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="oil_g4" id="oil_g4" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div> 
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Solar Stock Genset 4</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="solar_g4" id="solar_g4" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Accu Voltage Genset 4</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="accu_g4" id="accu_g4" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div>
		  		  
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Accu Voltage PKG</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="accu_pkg" id="accu_pkg" class="form-control col-md-7 col-xs-12" required="required">
				</div>
			</div>
		  
			<div class="item form-group">
				<label class="control-label col-sm-3 col-md-3 col-xs-12" for="description">Keterangan</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				<textarea 
					class="form-control resizable_textarea" name="keterangan" 
					id="keterangan" placeholder="type a text description" ></textarea>
				</div>
			</div>
									
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_date">
					Lampiran <span class="required"></span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="file" name="lampiran" id="lampiran"/>
				</div>
			</div>
									
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="reset" class="btn btn-warning">Clear</button>
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
<script src="<?php echo base_url("assets/css/css-index.css"); ?>"></script>