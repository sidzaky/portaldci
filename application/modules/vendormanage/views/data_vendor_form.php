<script type="text/javascript">

function yesnoCheck(box) {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';

}
</script>

<div class="container-fluid">
	<div class="row bg-title">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo  $headboard ?></h4>
			</div>
			<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><?php echo  $breadcrumb[0] ?></li>
					<li class="active"><?php echo $breadcrumb[1] ?></li>
				</ol>
			</div>
	</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="white-box">
				<h3 class="box-title">
					Form Vendor Management
				</h3>
				<div id="item-list">
				<form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <?php 
					foreach ($vendor_nama as $row){
							$list_nama_vendor.=' <option value="'.$row['vendor_nama'].'">';
					}
					if ($this->fitur == 'Lihat') { ?>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >SPK Nomor
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo $vendor_detail['spk_nmr']; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Nama Projek
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo $vendor_detail['nama_projek']; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Nama Vendor
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo $vendor_detail['vendor_nama']; ?><p>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Tanggal Mulai
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo $vendor_detail['vendor_begindate']; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Tanggal Berakhir
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <p>: <?php echo $vendor_detail['vendor_enddate']; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Status
                            </label>
                            <div class="col-md-1 col-sm-6 col-xs-12">
                                <p>: <?php if($vendor_detail->status == 'selesai'){?>
                                <i class='btn btn-circle btn-xs bg-red'>selesai</i>
                                <?php } 
								else{ ?>
									<i class='btn btn-circle btn-xs bg-green'><?php echo $vendor_detail['status'];?></i>
                                <?php } ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12" >Vendor Dokumen</label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <p>:  <a title='Dokumen' href="<?php echo base_url().$vendor_detail['vendor_dokumen']?>" class='btn btn-circle btn-sm sbold bg-blue' target="_blank">
                                    <i class='fa fa-file'> </i> Lihat Dokumen
                                </a><p>
                            </div>
                        </div>
                        
                        <?php
                    } 
					else {
						
                        ?>
                        <?php if ($this->fitur == 'Ubah') { ?>
                            <input type="hidden" name="vendor_id" value="<?php echo $vendor_detail['vendor_id']; ?>">
                        <?php } ?>
						
						<?php 
							
							if (isset($re)){
								echo '
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" >Perpajangan Dari SPK Nomor<span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input  type="text" name="justV" class="form-control col-md-7 col-xs-12" value="'.$re[0]['spk_nmr'].'" disabled>
											<input  type="hidden" name="vendor_parent" required="required" class="form-control col-md-7 col-xs-12" value="'.$re[0]['vendor_id'].'">
										</div>
									</div>
								';
							}
						?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >SPK Nomor<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  type="text" name="spk_nmr" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $vendor_detail['spk_nmr']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Projek <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="namaprojek" type="text" name="nama_projek" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $vendor_detail['nama_projek']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Vendor <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
								<datalist id="list_nama_vendor">
									<?php echo $list_nama_vendor?>
								</datalist>
                                <input type="text" name="vendor_nama"  list="list_nama_vendor" required="required" id="namavendor" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $vendor_detail['vendor_nama']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal Kontrak <span class="required">*</span>
                            </label>
                            <?php 
                            if($this->fitur == 'Ubah'){
                            $newdate1 = date("m/d/Y", strtotime($vendor_detail['vendor_begindate']));
                            $newdate2 = date("m/d/Y", strtotime($vendor_detail['vendor_enddate']));
                        }
                            ?>
                               <div class="control-group">
										<div class="controls">
											<div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
												
												<input type="text" name="vendor_begindate"  data-provide="datepicker" class="datepicker form-control col-md-4 col-xs-8"  class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Kontrak" value="<?php if ($this->fitur == 'Ubah') echo $newdate1; ?>">
												<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
												
											</div>
										</div>
                                 </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal Berakhir <span class="required">*</span>
                            </label>
                          
                               <div class="control-group">
										<div class="controls">
											<div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
												<input type="text" name="vendor_enddate"  data-provide="datepicker" class="datepicker form-control col-md-4 col-xs-8"  class="form-control has-feedback-left" id="single_cal2" placeholder="Tanggal Berakhir" value="<?php if ($this->fitur == 'Ubah') echo $newdate2; ?>">
												<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
										   
											</div>
										</div>
                                 </div>
                            
                        </div>
                        <?php  
                        if($this->fitur == 'Ubah'){
                            ?>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" onclick="yesnoCheck('ifYes')" id="yesCheck" name="yesno"  /> Update file dokumen
                            </div>
                        </div>
                        <div class="form-group" id="ifYes" style="display:none;">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dokumen SPK <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="vendor_dokumen"  class="form-control col-md-7 col-xs-12" ?>
                            </div>
                        </div>
                         <?php
                        }
						else{
                        ?>    
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dokumen SPK <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="vendor_dokumen" required="required" class="form-control col-md-7 col-xs-12" ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php  
                        if($this->fitur == 'Ubah'){
                            ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="status">       
                                        <option value="baru">Baru</option>
                                        <option value="selesai">Tidak Diperpanjang</option>
                                </select>
                            </div>
                        </div>

                        <?php
                        }
                        ?>                 

                    <?php }
                    ?>
                    <div class="ln_solid">
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                            <a class="btn btn-sm bg-blue" href="#"  onclick="history.go(-1);" ><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php if ($this->fitur == 'Lihat') { ?>
                                <a href="<?php echo base_url('newportalisd/action/edit/' . $vendor_detail->vendor_id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                            <?php } ?>
                            <?php if ($this->fitur == 'Tambah' || $this->fitur == 'Ubah') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            <?php } ?>

                        </div>
                    </div>

                </form>
				<h3 class="box-title" align="center">
					Kontrak Vendor sebelumnya
				</h3>
			
				<table  class="table dataTable no-footer" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="30px">SPK</th>
                            <th>Detail</th>
                            <th>Tanggal Kontrak</th>
                            <th>Status</th>
                            <th>Dokumen SPK</th>
                            <th width="140px">Action</th>
                        </tr>
                    </thead>
					<tbody>
                        <?php
                        $start = 0;
                        foreach ($parent as $vendor) {
						
                        ?>
                        <tr>
                            <td><?php echo ++$start?></td>
                            <td><?php echo $vendor['spk_nmr']?></td>
                            <td><?php echo $vendor['nama_projek']?></br>
							<span class="label label-lg label-primary">&nbsp;<span><?php echo $vendor['vendor_nama']?></span></span></td>
                            <td><a class="green">Mulai: <?php echo $vendor['vendor_begindate']?></a>
                                </br><a class="red">Berakhir: <?php echo $vendor['vendor_enddate']?></a></td>
								
                            <td><?php if($vendor['status'] == 'kadaluarsa'){?>
                                 <button class="btn btn-danger btn-sm" type="button" ><span class="btn-label"><i class="fa fa-close"></i>kadaluarsa</button>
                                <?php } else{ ?>
									   <button class="btn btn-success btn-sm" type="button" ><i class="fa fa-check"></i><?php echo $vendor['status'];?></button>
                                <?php } ?>
                            </td>
                            <td> <a title='Dokumen' href="<?php echo $vendor['vendor_dokumen']?>" target="_blank">
                                   <button class="btn btn-info btn-sm" type="button" ><span class="btn-label"><i class="fa fa-download"></i></span> Download Dokumen</button>
                                </a></td>

                            
                            <td style="text-align:center" width="140px">
                                <a title='Lihat' href=" <?php echo base_url('vendormanage/action/view/' .$vendor['vendor_id']);?>" >
                                    <button class="btn btn-info btn-sm"><i class='fa fa-folder'></i>View</button>
                                </a>
                              
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