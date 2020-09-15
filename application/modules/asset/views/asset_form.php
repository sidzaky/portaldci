

<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo $headboard ?></h4>
		</div>
	</div>
	
	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="white-box">
				<h3 class="box-title">Form Modify</h3>
				
				<div id="item-list">
					
					<div class="x_content">
	      <form
	      	class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data"
	      	id="form" action="<?php echo base_url("asset/add"); ?>" novalidate>

	        <!-- Smart Wizard -->
	        <p>Mohon masukkan data-data sesuai dengan yang seharusnya. Terima Kasih</p>
	        <?php
	        if(isset($info)){
        	?>
        		<div class="alert <?php echo $info["class"]; ?>"><?php echo $info["text"]; ?></div>
	        <?php
	        }
	        ?>
	        <div id="wizard" class="form_wizard wizard_horizontal">
	          <div id="step-1">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
                	<i>Nama</i> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="hostname" name="hostname" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand">
                	<i>Brand</i> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="brand" name="brand" class="form-control col-md-7 col-xs-12"  required>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand">
                	Tipe <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="type" name="type" class="form-control col-md-7 col-xs-12"  required>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ip_address">
                	<i>Owner</i> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="ip_address" name="ip_address" class="form-control col-md-7 col-xs-12"  required/>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ip_address">
                  <i>Tahun Pembuatan</i> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="port_asset" name="port_asset" class="form-control col-md-7 col-xs-12" />
                  <span class="fa fa-plug form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
             
			  <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">
                	Lokasi (Data Center / Posisi) <span class="required">*</span>
                </label>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<select class="form-control col-md-7 col-xs-12" id="location_dc" name="location_dc" required>
						<option>-------PILIH--------</option>
						<?php 
						foreach ($dc_location as $row){
							echo '<option value="'.$row['id_asset_dc'].'"> '.$row['nama_dc'].'</option>';
						}
						?>
						
					</select>
                 
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="text" id="location" name="location" required="required" class="form-control col-md-7 col-xs-12"  required>
                </div>
              </div>
			  
			  
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="operating_system">
                	Kapasitas Per Item <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="operating_system" name="operating_system"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="serial_number">
                	<i>Serial Number</i> <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input
                  	type="text" id="serial_number" name="serial_number" class="form-control col-md-7 col-xs-12" data-inputmask="'mask' : '****-****-****-****-****-***'"
                	/>
                	<span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="group_id">
                	<i>Group</i> <span class="required">*</span>
              	</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="group_id"  id="group_id" class="form-control col-md-3 col-xs-12" required="required">
                  	<?php
                  	foreach($asset_group as $row) {
                  	?>
                  		<option value="<?php echo $row["ID"]; ?>"><?php echo $row["NAME"]; ?></option>
                  	<?php
                  	}
                  	?>
                  </select>
                </div>
              </div>
			  
			 
			  <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="group_id">
                	<i>Jenis Asset</i> <span class="required">*</span>
              	</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="jenis_id" id="jenis_id" class="form-control col-md-3 col-xs-12" required="required">
                  	<option>--Select---</option>
					
                  	<?PHP 
						$sql="select a.*, b.NAME as group_name from asset_jenis a 
							  left join asset_group b on a.group_id=b.id
						";
						
						foreach ($this->db->query($sql)->result() as $row){
								echo '<option hidden name="'.$row->group_name.'" value="'.$row->jenis_id.'">'.$row->jenis_nama.'</option>';
						}
						
					?>
					
                  </select>
                </div>
              </div>
			   <script>
			   $('#group_id').change(function(){
				    var i=document.getElementById('group_id');
				    var ji=document.getElementById('jenis_id');
					ji.value='';
				    var get=ji.options;
					for (var z=0; z<get.length; z++){
						if (get[z].getAttribute('name')==i.options[i.selectedIndex].text) {
							get[z].removeAttribute('hidden');
						}
						else {
							get[z].setAttribute('hidden','hidden');
						}
					}
				});
				
			  </script>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active">
                	Aktif <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label>
                    <input type="checkbox" name="active" id="active" class="js-switch" checked/>
                  </label>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">
                	Foto <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" name="photo">
                </div>
              </div>
              <hr/>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="buy_price">
                	Harga Beli <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="buy_price" name="buy_price" class="form-control col-md-7 col-xs-12"/>
                	<span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="buy_date">
                	Tanggal Beli
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input
                  	type="text" class="form-control col-md-4 col-xs-8"
                  	id="buy_date" name="buy_date" placeholder="Buy Date"/>
                  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expired_maintenance_date">
                	Tanggal <i>Maintenance</i> Berakhir
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input
                  	type="text" class="form-control col-md-4 col-xs-8"
                  	id="expired_maintenance_date" name="expired_maintenance_date" placeholder="Expired Maintenance Date" />
                  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expired_maintenance_date">
                  <i>End of Support Date</i>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input
                    type="text" class="form-control col-md-4 col-xs-8"
                    id="end_of_support_date" name="end_of_support_date" placeholder="End Of Support Date" />
                  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_of_sale_date">
                	<i>End of Sale Date</i>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input
                  	type="text" class="form-control col-md-4 col-xs-8"
                  	id="end_of_sale_date" name="end_of_sale_date" placeholder="EoS Date"/>
                  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_of_life_date">
                	<i>End of Life Date</i>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input
                  	type="text" class="form-control col-md-4 col-xs-8"
                  	id="end_of_life_date" name="end_of_life_date" placeholder="EoL Date"/>
                  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
            </div>
	          <div id="step-2">
	            
              
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ha_mode">
                	<i>Jumlah</i>
                </label>             
				<div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="ha_mode" name="ha_mode"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="asset_function">
                	Fungsi Aset
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                	<textarea
                		class="resizable_textarea form-control" placeholder="Function Description"
                		name="asset_function" id="asset_function"></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="spesification">
                	Keterangan Tambahan                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                	<textarea
                		class="resizable_textarea form-control" placeholder="spesification Description"
                		name="specification" id="specification"></textarea>
                </div>
              </div>
	          </div>
	          <div id="step-3">
	          	
	          	
	          </div>
	          <div id="step-4">
	          	<div class="row">
	          		<div class="
	          			col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1
	          			col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">

          				<table id="table_document" class="table table-bordered">
			          		<thead>
			          			<tr>
			          				<th>Nama Dokumen</th>
			          				<th>Dokumen</th>
			          				<th>Deskripsi</th>
			          				<th class="text-center">Aksi</th>
			          			</tr>
			          		</thead>
			          		<tbody></tbody>
			          	</table>
          			</div>
	          	</div>
	          	<div class="row">
	          		<div class="col-xs-12 text-center">
	          			<input type="button" value="Add Document" id="add_document" class="btn btn-info btn-xs"/>
						<input type="Submit" value="Submit"  class="btn btn-success btn-xs"/>
	          		</div>
	          	</div>
	          </div>
	        </div>
	        <!-- End SmartWizard Content -->

	      <!-- End Smart Wizard -->
	      </form>
      </div>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="modal_snmp" class="modal fade modal-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Pemberitahuan</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
