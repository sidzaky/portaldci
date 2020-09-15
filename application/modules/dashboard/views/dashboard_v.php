<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo $headboard ?></h4>
		</div>
		<div class="col-lg-7 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><?php echo  $breadcrumb[0] ?></li>
				<li class="active"><?php echo $breadcrumb[1] ?></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-sm-12 col-xs-12">
                        <h4>Kondisi M/E GTI Jaman Now!!</h4>
						<div class="collapse m-t-15" id="pgr1" aria-expanded="true"> <pre class="line-numbers language-javascript m-t-0"><code><b>Use below code &amp; put in column</b><br>
                  </code></pre> </div>
                        <div class="row">
						   <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Power So Far</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="fa fa-bolt"></i></li>
                                        <li class="text-right"><span class="counter">100%</span></li>
                                    </ul>
                                </div>
                            </div>
                         
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Crack GTI</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="linea-icon linea-basic fa-fw fa fa-asterisk"></i></li>
                                        <li class="text-right"><span class="counter" id="statuspac">100%</span></li>
										<script>
											// window.onload = function () {
												// $.ajax({ type:"POST",
														// url: "dashboard/getstatuspac",
														// success:function(msg){
																// document.getElementById("statuspac").innerHTML = msg+"%"; 
														// }
												// });	
											// }
										</script>
                                    </ul>
                                </div>
                            </div>
                         
						    <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">PMS LAN Done Rate</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="linea-icon linea-basic fa-fw fa fa-plug"></i></li>
                                        <li class="text-right"><span class="counter"><?php echo round((($pms_lan[0]['Done']/$pms_lan[0]['Total'])*100),1);?>%</span></li>
                                    </ul>
                                </div>
                            </div>
							
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Insident/Trouble So Far</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="fa fa-ambulance"></i></li>
                                        <li class="text-right"><span class="counter">16</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-md-6 col-lg-6 col-sm-12">
					<h4>Last 5 Approved DC Requested</h4>
                        <div class="white-box">
							<div class="table-responsive">
                                    <table class="table">
										<thead>
											<tr>
												<th>Name</th>
												<th>Kebutuhan</th>
												<th>Status</th>
												<th>Noted</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$i=0;
											foreach ($dc_approved as $row){	
												if ($i<6){
													echo '<tr>
														<td>'.$row['name_visitor'].'</td>
														<td>'.$row['purpose'].'</td>
														<td>'.($row['approval']==1 ? 'Approved' : 'denied').'('.$row['user_approval'].')'.'</td>
														<td>'.$row['notes'].'</td>
														</tr>';
													$i++;
												}
												else break;
												}
											?>
										</tbody>
									</table>
                        </div>
                    </div>
    </div>
</div>