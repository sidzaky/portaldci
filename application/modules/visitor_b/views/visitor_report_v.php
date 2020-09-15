
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
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-xs-3">
						
						</div>
						
					</div>
				</div>
				
						<div class="x_content">
							<div class="row" >
								<div class="white-box">
									<h3 class="box-title">Visitor Report</h>
								    <div class="stats-row">
											<div class="stat-item">
												<h6><i class="fa fa-time"></i>Range tanggal</h6>
													<input type="text" onchange="get();"  id="rentangtanggal1" name="rangetanggal"  data-provide="datepicker" value="<?php echo (date('m/d/Y', strtotime("-1 months")))?>" class="form-control">	
											</div>
											<div class="stat-item">
													<input type="text" onchange="get();"  id="rentangtanggal2" name="rangetanggal"  data-provide="datepicker"  value="<?php echo date('m/d/Y')?>" class="form-control">
											</div>
											<div  class="stat-item">
												<h6>New Visitor</h6>
												<b id="totalvisitor"></b></div>
											<div class="stat-item">
												<h6>Avg Checkin Gedung/Day</h6>
												<b id="ratagedung"></b></div>
											<div class="stat-item">
												<h6>Avg Checkin DC/Day</h6>
												<b id="ratadc"></b>
												</div>
											<div class="stat-item">
												<h6>Total Checkin DC</h6>
												<b id="totaldc"></b>
											</div>
									</div>
									<ul class="list-inline text-right">
										<li>
											<a href="#" id="sampleApp" onclick="gettable('getnewvisitorbyday');"><h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>New Visitor</h5></a>
										</li>
										<li>
											<a href="#" id="sampleApp" onclick="gettable('getcheckinvisitorbyday');"><h5><i class="fa fa-circle m-r-5" style="color: #fdc006;"></i>Checkin Gedung</h5></a>
										</li>
										<li>
											<a href="#" id="sampleApp" onclick="gettable('getcheckindcbyday');"><h5><i class="fa fa-circle m-r-5" style="color: #2c5ca9;"></i>Checkin DC</h5></a>
										</li>
									</ul>
									<div id="placecanvas">
										<div id="morris-area-chart" style="position: relative;"></div>
									</div>
								</div>
								<div class="row">
							<div id="summarycontent" class="col-md-12"></div>
						</div>
					</div>
				
			</div>
		</div>
	</div>
</div>
	

<div class="modal modalother fade " tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form PMS Lan</h4>
			</div>
					<div id="blank_content" class="modal-body">
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
	
	
	function get(){
		alert ($('#rentangtanggal1').val());
		var data1={
				'date1' : $('#rentangtanggal1').val(),
				'date2' : $('#rentangtanggal2').val()
			};
			$.ajax({ type:"POST",
						   url: "visitor/getsummary",
						   data: data1,
						   success:function(msg){
							   console.log(msg);
						   }
			});
	}
	</script>