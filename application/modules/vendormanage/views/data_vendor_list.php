
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
					
					</h3>
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<a href="<?php echo base_url()?>vendormanage/add" > 
									<button type="button" class="btn btn-success waves-effect waves-light">
									<i class="fa fa-plus"></i> Upload Data Vendor</button>
								</a>
							</div>
						</div>
					</div>
					<div id="item-list">
						<div class="x_content" >
             
                <table id="example"  class="table dataTable no-footer" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Detail</th>
                            <th>SPK</th>
                            <th>Tanggal Kontrak</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                 
                        <?php
                        $start = 0;
						
                        foreach ($vendor as $vendor) {
							
                        ?>
                        <tr>
                            <td><?php echo ++$start?></td>
                            <td><?php echo $vendor->nama_projek?></br>
							<span class="label label-lg label-primary">&nbsp;<span><?php echo $vendor->vendor_nama?></span></span></td>
                            <td><?php echo $vendor->spk_nmr?></br>
								<a target="_blank" href="<?php echo $vendor->vendor_dokumen?>"><button class="btn btn-info btn-sm" type="button" ><span class="btn-label"><i class="fa fa-download"></i></span> Download Dokumen</button></a>
								</td>
                            <td><a class="green">Mulai: <?php echo date('d M, y', strtotime($vendor->vendor_begindate))?></a></br>
								<a class="red">Berakhir: <?php echo date('d M, y', strtotime($vendor->vendor_enddate))?></a></br>
								<?php 
								
									$expired=(time()-(strtotime($vendor->vendor_begindate)));
									if   		($expired>2592000) echo '<button class="btn btn-success btn-sm" type="button" ><span class="btn-label"><i class="fa fa-check"></i></span>Active</button>';
									else if   	($expired<=2592000) echo '<button class="btn btn-warning btn-sm" type="button" ><span class="btn-label"><i class="fa fa-warning"></i></span>Almost Die</button>';
									else if     ($expired<=0) echo '<button class="btn btn-danger btn-sm" type="button" ><span class="btn-label"><i class="fa fa-check"></i></span>Die</button>';
									
									?>
								<a title='perpanjang' href=" <?php echo base_url('vendormanage/action/add/' . $vendor->vendor_id);?>" >
                                    <button class="btn btn-success btn-sm" type="button"><span class="btn-label"><i class='fa fa-refresh'></i></span>Renew</button>
                                </a>	
							</td>
                            <td style="text-align:center" width="160px">
                                <a title='Lihat' href=" <?php echo base_url('vendormanage/action/view/' . $vendor->vendor_id);?>" >
                                    <button class="btn btn-info btn-sm"><i class='fa fa-folder'></i>View</button>
                                </a>
															
								<a title='Edit' href=" <?php echo base_url('vendormanage/action/edit/' . $vendor->vendor_id);?>" >
                                    <button class="btn btn-warning btn-sm"> <i class='fa fa-edit'></i>Edit</button>
                                </a>
                                <a title='Delete' href=" <?php echo base_url('vendormanage/action/delete/' . $vendor->vendor_id);?>">
                                     <button class="btn btn-danger btn-sm"><i class='fa fa-trash'></i>Hapus</button>
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
        </div>
</div>

