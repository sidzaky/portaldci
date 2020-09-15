     <?php $alert = $this->session->flashdata('message');?>
            <?php if(!empty($alert))
            echo '<div class="alert alert-danger alert-dismissable">
        <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>'. $alert .'</div>'; ?>
      
	<section id="wrapper" class="login-register" style="background:url(<?php echo base_url()?>assets/img/login-register.jpg)  center/cover no-repeat !important">
		<div class="login-box" id="signup-box" style="  overflow-y:true; width:1000px; position:relative; top:-110px;" >
			<div class="col-lg-12" style=" padding: 25px; background:#fff;">			
				<?php $this->load->view('form_signup_v');?>
			</div>
		</div>
	</section>
	
