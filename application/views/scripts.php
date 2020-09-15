	

	
	
	
	<script src="<?php echo base_url()?>assets/js/jquery_003.js"></script>
	<script src="<?php echo base_url()?>assets/js/jquery_004.js"></script>
	<script src="<?php echo base_url()?>assets/js/jquery_005.js"></script>
	<script src="<?php echo base_url()?>assets/js/jquery_006.js"></script>
	<script src="<?php echo base_url()?>assets/js/jquery_007.js"></script>
	
	
	<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
	
	<script src="<?php echo base_url()?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>
    
	<script src="<?php echo base_url()?>assets/js/sidebar-nav.js"></script>
	<script src="<?php echo base_url()?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url()?>assets/js/custom.js"></script>


	
	
	
	
	<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	
    <script src="<?php echo base_url()?>assets/js/waves.js"></script>
    <script src="<?php echo base_url()?>assets/js/raphael-min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
   
    <script src="<?php echo base_url()?>assets/js/send.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/Chart.js/dist/Chart.min.js"></script>
	
	<?php echo ($scriptoptional!='' ? '<script src="'.base_url().'assets/js/'.$scriptoptional.'"></script>' : '');?>
	
	
	<script type="text/javascript">	
		$(window).load(function() {
				$(".loader").fadeOut("slow");
			});
		
		
		$("#example").DataTable();
		$("#listhistory").DataTable({
			"ordering": false,
			"info":     false,
		});
	
		$( document ).ready(function() {
						$('.dataTables_filter').addClass('pull-right');
				});
				
	
    </script>
	
	<?php
		$alert=$this->session->flashdata();
				if(!empty($alert))
						echo '
							  <script>
								$(document).ready(function() {
									$.toast({
										heading: "'.$alert['heading'].'",
										text: "'.$alert['message'].'",
										position: "top-right",
										loaderBg: "#ff6849",
										icon: "'.$alert['icon'].'",
										hideAfter: 5000,
										stack: 6
									})
								});
				  </script>';
	?>
   
   
   
   