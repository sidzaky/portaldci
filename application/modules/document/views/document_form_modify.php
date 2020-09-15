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
				<h3 class="box-title">Form Document
				</h3>
				   <p>Mohon masukkan data-data sesuai dengan yang seharusnya. Terima Kasih</p>
				<div class="col-md-9 col-sm-9 col-xs-12">
				
				</div>
				<div id="item-list">
					<div class="x_content">
					  <form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" id="form" action="<?php echo base_url("document/modify/".$document["ID"]); ?>" novalidate>
						
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
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Dokumen</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input 
											type="text" name="name" id="name" class="form-control col-md-7 col-xs-12" 
											required="required" value="<?php echo $document["NAME"]; ?>">
										</div>
									  </div>
									  <div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kategori Dokumen</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input 
											type="text" name="kategori" id="kategori" class="form-control col-md-7 col-xs-12" 
											required="required" value="<?php echo $document["kategori"]; ?>">
										</div>
									  </div>
									  <div class="item form-group">
										<label class="control-label col-sm-3 col-md-3 col-xs-12" for="description">Deskripsi</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <textarea 
											class="form-control resizable_textarea" name="description" 
											id="description" placeholder="type a text description" required="required"><?php echo $document["DESCRIPTION"]?></textarea>
										</div>
									  </div>
									  <div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="event_date">
										  Dokumen Pendukung <span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <span>
											<input type="file" name="document" id="document"/>
											<input type="hidden" name="path_old" id="path_old" value="<?php echo $document["PATH"]?>" />
										  </span>
										  <span>
											<a href="<?php echo base_url($document["PATH"])?>" class="btn btn-xs btn-default" target="_blank">
											  <i class="fa fa-photo"></i> Lihat
											</a>  
										  </span>
										</div>
									  </div>
									  <div class="ln_solid"></div>
									  <div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
										  <button type="submit" class="btn btn-success">Submit</button>
										  <button type="reset" class="btn btn-warning">Clear</button>
										  <button type="button" onclick="if (confirm('yakin???')){window.location.replace('<?php echo base_url("document/drop/".$document["ID"])?>');}" class="btn_drop btn btn-danger" dat="">Hapus Data</button>
										</div>
									  </div>
								</div>
							</div>
					  <!-- elements in form tag -->
					  </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

