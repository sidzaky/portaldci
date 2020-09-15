



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
							<h5><i class="fa fa-time"></i>Range tanggal</h5>
						</div>
						<div class="col-xs-4">
							<input type="text" onchange="get();"  id="rentangtanggal1" name="rangetanggal"  data-provide="datepicker" value="<?php echo (date('m')-1).'/'.date('d/Y')?>" class="form-control">
						</div>
						<div class="col-xs-4">
							<input type="text" onchange="get();"  id="rentangtanggal2" name="rangetanggal"  data-provide="datepicker"  value="<?php echo date('m/d/Y')?>" class="form-control">
						</div>
					</div>
				</div>
				
						<div class="x_content">
							<div class="row" >
								<div class="col-md-3 col-sm-3 col-xs-12">
										 <table>
											<thead>
												<tr>
													<th style="text-align:center"><p>PMS LAN Summary</p></th>
													<th style="text-align:center"><p>Value</p></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td id="placecanvasmyChart"> 
														<canvas id="myChart" class="chartjs" width="250" height="250" style="display: block; width: 250px; height: 250px;"></canvas>
														</td>
													<td>
														<table class="tile_info">
														 <tr>
															<td> <a href="" class="tr" onclick="detsummary();"><p><i class="fa fa-square red"></i>Progress </p></a></td>
															<td width="20px"><p id="On_progress"></p> </td>
														
														  </tr>
														  
														  <tr>
															<td> <a href="" class="tr" onclick="detsummary('Done');"><p><i class="fa fa-square blue"></i>Done </p></a></td>
															<td><p id="Done"></p>  </td>
														  </tr>
														  <tr>
															<td> <a href="" class="tr" onclick="detsummary('Cancel');"><p><i class="fa fa-square" style="color : rgb(255, 206, 86);"></i>Cancel</p></a></td>
															<td ><p id="Cancel"></p> </td>
														  </tr>
														  <tr>
															<td> <a href="" class="tr"><p><i class="fa fa-square" style="color : rgb(255, 0, 0);"></i>SLA</p></a></td>
															<td ><p id="sla"></p> </td>
														  </tr>
															<td><p>Total</p></td>
															<td id="Total"></td>
															<td></td>
														  </tr>
														</table>
													 </td>
												</tr>
											</tbody>
										  </table>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12">
									 <table>
											<thead>
												<tr>
													<th style="text-align:center"><p>On Progress (till today)</p></th>
													<th style="text-align:center"><p>Value</p></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td id="placecanvasprogresschart"> 
														<canvas id="progresschart" class="chartjs" width="250" height="250" style="display: block; width: 250px; height: 250px;"></canvas>
														</td>
													<td> 
														<table class="tile_info">
														  <tr>
															<td><a href="" class="tr" onclick="detsummary('<=2','true');"><p><i class="fa fa-square " style="color : rgb(100, 206, 86);" ></i>kurang dari 2 hari  </p></a></td>
															<td width="20px"><p id="On_progress"></p> </td>
														
														  </tr>
														  <tr>
															<td><a href="" class="tr" onclick="detsummary('Between 3 and 5','true');"><p><i class="fa fa-square blue"></i>3 - 5 hari </p></a></td>
															<td><p id="Done"></p>  </td>
														  </tr>
														  <tr>
															<td><a href="" class="tr" onclick="detsummary('Between 6 and 7','true');"><p><i class="fa fa-square " style="color : rgb(255, 206, 86);"></i>6 - 7 hari</p></a></td>
															<td ><p id="Cancel"></p> </td>
														  </tr>
															<td><a href="" class="tr" onclick="detsummary('>7','true');"><p><i class="fa fa-square red" ></i>lebih dari 7 hari </p></a></td>
															<td ><p id="Cancel"></p> </td>
														  </tr>
														</table>
													 </td>
												</tr>
											</tbody>
										</table>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12">
									 <table>
											<thead>
												<tr>
													<th style="text-align:center"><p>Jumlah Tarikan</p></th>
													<th style="text-align:center"><p>Value</p></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td id="placecanvastarikanchart"> 
														<canvas id="tarikanchart" class="chartjs" width="250" height="250" style="display: block; width: 250px; height: 250px;"></canvas>
														</td>
													
													<td>
														<div id="tablejumlahtarikan"></div>											
													 </td>
												</tr>
											</tbody>
										</table>
								</div>	
								<div class="col-md-3 col-sm-3 col-xs-12">
									 <table>
											<thead>
												<tr>
													<th style="text-align:center"><p>Lama Pekerjaan Tarikan</p></th>
													<th style="text-align:center"><p>Hari</p></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td id="placecanvasthedayschart"> 
														<canvas id="thedayschart" class="chartjs" width="250" height="250" style="display: block; width: 250px; height: 250px;"></canvas>
														</td>
													<td> 
														<div id="tablelamatarikan"></div>		
													 </td>
												</tr>
											</tbody>
										</table>
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
<div class="modal fade modal-asset" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form PMS Lan</h4>
			</div>
			<div class="modal-body" id="form_pms_lan">
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