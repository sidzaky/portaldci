
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
									<h3 class="box-title">Insident Report</h>
								    <div class="stats-row">
										<div class="col-xs-3">
											<h5><i class="fa fa-time"></i>Range tanggal</h5>
										</div>
										<div class="col-xs-4">
											<input type="text" onchange="get();"  id="rentangtanggal1" name="rangetanggal"  data-provide="datepicker" value="<?php echo (date('m/d/Y', strtotime("-1 months")))?>" class="form-control">	
										</div>
										<div class="col-xs-4">
											<input type="text" onchange="get();"  id="rentangtanggal2" name="rangetanggal"  data-provide="datepicker"  value="<?php echo date('m/d/Y')?>" class="form-control">
										</div>
									</div>
									
									<div class="col-md-4 col-sm-4 col-xs-12">
										<table>
											<thead>
												<tr>
													<th style="text-align:center"><p>By Asset</p></th>
													<th style="text-align:center"><p>Count</p></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td id="placecanvasreport_by_asset"> 
														<canvas id="report_by_asset" class="chartjs" width="300" height="300" style="display: block; width: 300px; height: 300px;"></canvas>
													</td>
													<td id="textreport_by_asset">
													</td>
												</tr>
											</tbody>
										</table>
										
										<table>
											<thead>
												<tr>
													<th style="text-align:center"><p>pending_instro</p></th>
													<th style="text-align:center"><p>Hari</p></th>
												</tr>
												
											</thead>
											<tbody>
												<tr>
													<td id="placecanvaspending_instro"> 
														<canvas id="pending_instro" class="chartjs" width="300" height="300" style="display: block; width: 300px; height: 300px;"></canvas>
													</td>
													<td id="textpending_instro">
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									
									<div class="col-lg-8 col-sm-8 col-xs-12">
										<h3 class="box-title">Top 10 longest insident solved</h3>
										<div class="col-lg-12">
											<div  id="placecanvassolved_time">  </div>
											</div>
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
	