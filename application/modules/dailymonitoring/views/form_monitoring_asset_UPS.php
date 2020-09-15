
<form id="orderform"  class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" id="form"  novalidate>
	        <!-- Smart Wizard -->
			
			
			
							
			
				<?php 
					$i=0;
					foreach ($ups as $z){ 
							$i++;
							$li.='
							
							 <li class="tab '.($i==1 ?  'active' : '').'">
										<a href="#step-'.$i.'" data-toggle="tab" aria-expanded="false"> 
										<span class="visible-xs"><i class="fa fa-home">'.$i.'</i></span> 
										<span class="hidden-xs">'.$z['HOSTNAME'].'</span> </a>
                                </li>
							';
						
								
							$total='<input type="hidden" id="total" name="total" value="'.$i.'">';
							$form.='
								 <div class="tab-pane '.($i==1 ?  'active' : '').'" id="step-'.$i.'" >	
										<div class="row">
											<div class="col-md-6">
												<h3><p align="center"></p></h3>
												<h3><p align="center">INPUT '.$z['HOSTNAME'].'</p></h3>
												<input class="form-control upscek" type="hidden" id="asset_id_'.$i.'" name="asset_id_'.$i.'" value="'.$z['ID'].'">
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Van (VAC) </i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
														<input type="number" step="0.0001" id="input_Van_'.$i.'" name="input_Van_'.$i.'"  class="form-control upscek col-md-7 col-xs-12" required>
													</div>
												</div> 
											  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Vbn (VAC)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="input_Vbn_'.$i.'" name="input_Vbn_'.$i.'" class="form-control upscek col-md-7 col-xs-12" required>
													</div>
												  </div> 
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Vcn (VAC)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="input_Vcn_'.$i.'" name="input_Vcn_'.$i.'" class="form-control upscek col-md-7 col-xs-12" required>
													</div>
												  </div>   
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Ia (A)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="input_Ia_'.$i.'" name="input_Ia_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div>  
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Ib (A)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="input_Ib_'.$i.'" name="input_Ib_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div> 
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Ic (A)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="input_Ic_'.$i.'" name="input_Ic_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div>   
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>PF</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="input_PF_'.$i.'" name="input_PF_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div> 
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>KVA</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="input_KVA_'.$i.'" name="input_KVA_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div>  
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>KW</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="input_KW_'.$i.'" name="input_KW_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div> 
												  
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Freq (HZ)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="input_freq_'.$i.'" name="input_freq_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div> 
												
												<h3><p align="center">BYPASS '.$z['HOSTNAME'].'</p></h3>
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Van (VAC)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="bypass_Van_'.$i.'" name="bypass_Van_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div> 
												  
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Vbn (VAC)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="bypass_Vbn_'.$i.'" name="bypass_Vbn_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div> 
												  
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Vcn (VAC)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="bypass_Vcn_'.$i.'" name="bypass_Vcn_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div>   
												  
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Ia (A)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="bypass_Ia_'.$i.'" name="bypass_Ia_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div>  
												  
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Ib (A)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="bypass_Ib_'.$i.'" name="bypass_Ib_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div> 
												  
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Ic (A)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="bypass_Ic_'.$i.'" name="bypass_Ic_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div>
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Freq (HZ)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="bypass_freq_'.$i.'" name="bypass_freq_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div>   
											</div> 
											
											<div class="col-md-6">
												<h3><p align="center">OUTPUT '.$z['HOSTNAME'].'</p></h3>
													
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Van (VAC)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_Van_'.$i.'" name="output_Van_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div> 
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Vbn (VAC)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_Vbn_'.$i.'" name="output_Vbn_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div> 
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Vcn (VAC)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_Vcn_'.$i.'" name="output_Vcn_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div>   
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Ia (A)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_Ia_'.$i.'" name="output_Ia_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div>  
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Ib (A)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_Ib_'.$i.'" name="output_Ib_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div> 
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Ic (A)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_Ic_'.$i.'" name="output_Ic_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div>

												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>PF</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_PF_'.$i.'" name="output_PF_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div> 
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>KVA</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_KVA_'.$i.'" name="output_KVA_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div>  
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>KW</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_KW_'.$i.'" name="output_KW_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div> 
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Freq (HZ)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_freq_'.$i.'" name="output_freq_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div>   
												  
												  <div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Utilisasion (%)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="output_util_'.$i.'" name="output_util_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												  </div> 
												  
												  <h3><p align="center">BATTERY '.$z['HOSTNAME'].'</p></h3>	
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Vdc</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="battery_Vdc_'.$i.'" name="battery_Vdc_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div> 
												
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Idc</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="battery_Idc_'.$i.'" name="battery_Idc_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div> 
												
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>% Battery</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="battery_percent_'.$i.'" name="battery_percent_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div> 
											
													<h3><p align="center">ENVIRONMENT</p></h3>
													
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Temp (C)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="envi_temp_'.$i.'" name="envi_temp_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div> 
												
												<div class="item form-group">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
														<i>Humidity (%)</i> <span class="required">*</span>
													</label>
													<div class="col-md-6 col-sm-6 col-xs-12">
													  <input type="number" step="0.0001" id="envi_humidity_'.$i.'" name="envi_humidity_'.$i.'" class="form-control upscek col-md-7 col-xs-12"  required>
													</div>
												</div> 
											</div>
											<div class="col-md-12">
												<h3><p align="center">Notes '.$z['HOSTNAME'].'</p></h3>
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
													</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													  <textarea type="text" id="notes_'.$i.'" name="notes_'.$i.'" class="form-control upscek col-md-7 col-xs-12"></textarea>
												</div>
											</div>	
										</div> 
									</div>
									';
						}
					?>
				
				<ul class="nav nav-tabs tabs customtab">
                               <?php echo $li?>
							    <li class="tab">
										<button type="button"  onclick="checkform();" class="btn btn-success waves-effect waves-light" >Submit</button>
										<input type="submit" id="submit" value="submit" style="display:none" class="btn btn-success waves-effect waves-light" >
                                </li>
                            </ul>
					<div class="tab-content">	
						<?php echo $form.$total?>
					</div>
				
				
		</form>
	<script>
		function checkform() {
			var inputs = document.getElementsByClassName('upscek');
			var z=0;
			for (var i = 0; i < inputs.length; i++) {
					if(inputs[i].value == ""){
						z++;	
					}
					
			}
			if (z!=0) alert ('tolong lengkapi form');
			else {
				document.getElementById('submit').click();
			}
			
			
		}
	
	
	</script>