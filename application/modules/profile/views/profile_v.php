  
  

  
            <div class="container-fluid" id="profilev">
			<!-- ---------------  profilee  -------------------- -->
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile page</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="http://wrappixel.com/templates/pixeladmin/" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Buy Now</a>
                        <ol class="breadcrumb">
                            <li>Dashboard</li>
                            <li class="active">Profile page</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <img alt="user" src="profile_files/img1_002.jpg" width="100%">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?php echo base_url().($this->session->userdata('photo')!='' ? $this->session->userdata('photo') :  'assets/img/unknown.jpg' ) ?>" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?php echo $profile['USERNAME']?></h4>
                                        <h5 class="text-white"><?php echo $this->session->userdata('email'); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                            </div>
                        </div>
                    </div>
                    
			<!-- ---------------  Task  -------------------- -->		
					<div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <ul class="nav nav-tabs tabs customtab">
                                <li class="tab active">
                                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Edit Profile</span> </a>
                                </li>
                            </ul>
                           
			<!-- ---------------  Activity  -------------------- -->	
						   <div class="tab-content ">	
								<div class="tab-pane active" id="settings">
                                    <form id="form" onSubmit="return false;" action="#" class="form-horizontal form-material" >
                                        <div class="form-group">
                                            <label class="col-md-12">Password (kosongkan form jika tidak ingin mengganti)</label>
                                            <div class="col-md-12">
												<input type="hidden" id="id" value="<?php echo $profile['ID']?>"  >
                                                <input  id="PASSWORD" placeholder="(kosongkan form jika tidak ingin mengganti)" class="form-control form-control-line" type="password">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="col-md-12">re-Password</label>
                                            <div class="col-md-12">
                                                <input id="REPASSWORD"  class="form-control form-control-line" type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button  onclick="updateuser();" class="btn btn-success"  type="submit" >Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
			<script>
			
			$('form').on('submit', function(e){
				e.preventDefault();
			});
			
			function passcek(z){
	
				var pass = $('#password').val();
				if (pass!=z){
					$('#formsubmit').prop('disabled', true);
				}
				else $('#formsubmit').removeAttr("disabled");
			}
			
			
			function updateuser(){
					var data1 = { 	'ID' :  $('#ID').val(),
									'USERNAME' :  $('#USERNAME').val(),
									'PASSWORD' :  $('#PASSWORD').val(),
								};
					var element='profilev';
					var address="<?php echo base_url();?>login/updateuser";
					sendajax(data1,address,element,null,null);
			}
			</script>
          
       