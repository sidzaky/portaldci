     
	 
	 
 <section id="wrapper" class="login-register" style="background:url(<?php echo base_url()?>assets/img/login-register<?php echo rand(0,4)?>.jpg) center center/cover no-repeat !important">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" method="post" action="<?php echo base_url()?>/login/validate">
        <h3 class="box-title m-b-20" style="text-align:center;">New Portal ISD Sign In</h3>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" name="email" required="" placeholder="Username" type="text">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" name="password" required="" placeholder="Password" type="password">
          </div>
        </div>
		  <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p> Mau Cek Request Tarikan??? <a href="#" data-toggle="modal" data-target=".modal-asset" class="text-primary m-l-5"><b>Klik Sini Aja</b></a></p>
          </div> 
		  <div class="col-sm-12 text-center">
            <p> Mau Cek Request Tarikan??? <a href="#" data-toggle="modal" data-target=".modal-asset" class="text-primary m-l-5"><b>Klik Sini Aja</b></a></p>
          </div> 
		  <div class="col-sm-12 text-center">
            <p> Mau Cek Request Tarikan??? <a href="#" data-toggle="modal" data-target=".modal-asset" class="text-primary m-l-5"><b>Klik Sini Aja</b></a></p>
          </div>
        </div>
		
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
            
            </div>
            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"></a> </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
          </div>
        </div>
      
      </form>
      <form class="form-horizontal" id="recoverform" action="index.html">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" required="" placeholder="Email" type="text">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>


<div class="modal fade modal-asset" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Cari Tarikan Kamu Disini</h4>
			</div>
			<div class="modal-body" id="form_pms_lan">
					 
					 <div class="row">
					    <div class="form-group">
						  <div class="col-xs-12">
							<input class="form-control" id="nodin" placeholder="coba search by kebutuhan, nomor surat atau yang lainnya, ntar juga keluar hasilnya" type="text">
						  </div>
						</div>
					</div>
					<div class="row">
						<div id="resultnodin">
						</div>
					</div>
				</div>	
		</div>
	</div>
</div>


<script>
	$(document).ready(function(){
			//////check pmslan by apa ajah/////
			$('#nodin').on('keyup', function() {
					 if (this.value.length > 1) {
						 var data1={
							 'data':$('#nodin').val(),
						 }
						 $.ajax({ 
									type:"POST",
									url: "<?php echo base_url()?>login/checkpmslan",
									data: data1,
									success:function(msg){
										var result=JSON.parse(msg);
										var data='';
										if (result.length>0){
											data ='mungkin ini kali ya?? </br><table class="table  dataTable no-footer"><thead><th>No</th><th>Nodin</th><th>Nomor WO (Labelnya)</th><th>kebutuhan</th><th>tanggal suratnya</th><th>yang minta</th></thead>';
											for (var i=0;i<result.length;i++){
												data +="<tr><td>"+(i+1)+"</td><td>"+(result[i]['nomor_surat_masuk'])+(result[i]['status_SIK']=='Done' ? " <span class=\"label label-success\"><i class=\"fa fa-check\"></i> sudaah donk</span>": "<span class=\"label label-danger\"><i class=\"fa fa-close\"></i>sabar masih ditarik</span>")+"</td><td>"+(result[i]['nomor_SIK'])+"</td><td>"+(result[i]['keterangan_surat_masuk'])+"</td><td>"+(result[i]['tanggal_surat_masuk'])+"</td><td>"+(result[i]['unit_kerja'])+"</td></tr>";
											}
											data +="</table></br>";
										}
										document.getElementById('resultnodin').innerHTML=data;
									}
							});
					 }
					  else document.getElementById('resultnodin').innerHTML='';
			});
	});

</script>

