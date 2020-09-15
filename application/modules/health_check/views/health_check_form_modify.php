<!-- bootstrap-daterangepicker -->
<link href="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.css"); ?>" rel="stylesheet">

<div class="page-title">
  <div class="title_left">
    <h3>Health Check | Modify</h3>
  </div>
</div>
<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
	      <form 
	      	class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" 
			id="form" action="<?php echo base_url("health_check/modify/".$health_check["id"]); ?>" novalidate>
	        
          <!-- elements in form tag -->
	        <p>Mohon masukkan data-data sesuai dengan yang seharusnya. Terima Kasih</p>
	        <?php
	        if(isset($info)){ 
        	?>
        		<div class="alert <?php echo $info["class"]; ?>"><?php echo $info["text"]; ?></div>
	        <?php
	        }
	        ?>
          
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reminder_date">
              Tanggal Test <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input
                type="text" class="form-control col-md-7 col-xs-12"
                id="reminder_date" name="month" placeholder="Tanggal Test" required="required" 
				value="<?php echo $health_check["month"]; ?>">
              <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
		  
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
              Jenis Test
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="jenis_test" id="status" class="form-control col-md-7 col-xs-12" value="<?php echo $health_check["jenis_test"]; ?>">
                <option value="Dengan Beban" <?php echo $health_check["jenis_test"] == "Dengan Beban" ? "selected":""; ?>>
				Dengan Beban
				</option>
                <option value="Tanpa Beban" <?php echo $health_check["jenis_test"] == "Tanpa Beban" ? "selected":""; ?>>
				Tanpa Beban
				</option>
              </select>
            </div>
          </div>
		  
		  <div class="ln_solid"></div>
		  
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Oil Level Genset 1</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="oil_g1" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["oil_g1"]; ?>">
            </div>
          </div> 
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Solar Stock Genset 1</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="solar_g1" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["solar_g1"]; ?>">
            </div>
          </div>
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Accu Voltage Genset 1</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="accu_g1" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["accu_g1"]; ?>">
            </div>
          </div>
		  
		  <div class="ln_solid"></div>
		  
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Oil Level Genset 2</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="oil_g2" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["oil_g2"]; ?>">
            </div>
          </div> 
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Solar Stock Genset 2</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="solar_g2" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["solar_g2"]; ?>">
            </div>
          </div>
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Accu Voltage Genset 2</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="accu_g2" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["accu_g2"]; ?>">
            </div>
          </div>
		  
		  <div class="ln_solid"></div>
		  
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Oil Level Genset 3</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="oil_g3" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["oil_g3"]; ?>">
            </div>
          </div> 
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Solar Stock Genset 3</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="solar_g3" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["solar_g3"]; ?>">
            </div>
          </div>
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Accu Voltage Genset 3</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="accu_g3" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["accu_g3"]; ?>">
            </div>
          </div>
		  
		  <div class="ln_solid"></div>
		  
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Oil Level Genset 4</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="oil_g4" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["oil_g4"]; ?>">
            </div>
          </div> 
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Solar Stock Genset 4</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="solar_g4" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["solar_g4"]; ?>">
            </div>
          </div>
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Accu Voltage Genset 4</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"name="accu_g4" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["accu_g4"]; ?>">
            </div>
          </div>
		  
		  <div class="ln_solid"></div>
		  		  
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Accu Voltage PKG</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="accu_pkg" id="name" class="form-control col-md-7 col-xs-12" required="required"
			  value="<?php echo $health_check["accu_pkg"]; ?>">
            </div>
          </div>
		  
		  <div class="ln_solid"></div>
		  
          <div class="item form-group">
            <label class="control-label col-sm-3 col-md-3 col-xs-12" for="description">Keterangan</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea 
                class="form-control resizable_textarea" name="keterangan" 
                id="description" placeholder="type a text description"> 
				<?php echo $health_check["keterangan"]; ?></textarea>
            </div>
          </div>
		  
		  

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
              <button type="submit" class="btn btn-success">Submit</button>
              <button type="reset" class="btn btn-warning">Clear</button>
              <button 
                type="button" class="btn_drop btn btn-danger" data-toggle="modal" 
                data-target=".modal-confirmation" data-url="<?php echo base_url("health_check/drop/".$health_check["id"])?>">
                Hapus Data
              </button>
            </div>
          </div>
          <!-- elements in form tag -->
	      </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade modal-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        Apakah anda yakin menghapus data health check?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <a href="" class="btn btn-danger">Ya, Saya Yakin</a>
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