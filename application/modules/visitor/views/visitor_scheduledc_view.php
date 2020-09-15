
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
<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="white-box">
				<div class="col-md-7 col-sm-7 col-xs-12"> 
					<h3 class="box-title">
					<a href="<?php echo base_url()?>uploads/document/manual_DC.pdf"><button type="button" class="btn btn-info waves-effect waves-light">Need Help??</button></a>
					</h3>
					
				</div>
			<?php if ($this->uri->segment(3)=='reqscheduledc_list') {
					echo ($this->session->userdata('module_access')['vm2']>3 ? '	
								<div class="col-md-3 col-sm-3 col-xs-12">
									<select class="form-control col-md-2 col-xs-12" onchange="statusapproval(this);"><option value="">Waiting List</option><option value="all">All Request</option><option value="1">Granted</option><option value="0">Denied</option></select>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<button type="button" class="btn btn-success waves-effect waves-light"" onclick="request();"  data-toggle="modal" data-target=".visitor-modal"  >Request Visitor DC </button> 
								</div>
								': '') ;
						}
					?>
			
				<div class="x_content" id="x_content">
					<?php $con->$func();?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="visitor-modal fade modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Visitor</h4>
			</div>
			<div id="visitor_content" class="modal-body">
			</div>
		</div>
	</div>
</div>

<div class="first-modal fade modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Visitor</h4>
			</div>
			<div id="blank_content" class="modal-body">
				
			</div>
		</div>
	</div>
</div>

<div class="second-modal fade modal" id="second-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Visitor</h4>
			</div>
			<div id="second_blank_content" class="modal-body">
			</div>
		</div>
	</div>
</div>

<div id="contentapproval" style="display:none">
	<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" id="form" action="" novalidate> 
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i>Catatan Approval</i> <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						<textarea id="notes" class="form-control col-md-7 col-xs-12" ></textarea>
						</div>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i>Approval</i> <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<button class="btn btn-success btn-sm" onclick="approval('1')" type="button" >Approve <i class="fa fa-thumbs-up "></i></button>
							<button class="btn btn-danger btn-sm" onclick="approval('0')" type="button" >Nope <i class="fa fa-thumbs-down "></i></button>
						</div>
			</div>
	</form>
</div>
	
	
<script>
	var id_schedule_dc;
	$(document).ready(function() {		
			$("#tablevis").DataTable()
		});
	
	
	$(function() {
			  $("#range_start").click(function(){
					$("#datetimepicker").datetimepicker({
						format:'DD/MM/YYYY',
						language: "pt-BR"
						}).datetimepicker("show")	
			  });
			  
			   $("#range_end").click(function(){
					$("#datetimepicker1").datetimepicker({
						format:'DD/MM/YYYY',
						language: "pt-BR"
						}).datetimepicker("show")
			  });
		});
	
	function approval(i){
		if (i==null){
			document.getElementById('blank_content').innerHTML=document.getElementById("contentapproval").innerHTML;
			
		}
		else {
			var data1={
						'id_schedule_dc' : id_schedule_dc,
						'notes' : $("#notes").val(),
						'approval' : i,
				};
			$.ajax({ 		
					type:"POST",
					url: "<?php echo base_url();?>visitor/approval",
					data: data1,
					success:function(msg){
							$('.x_content').html(msg);
							alert('oke');
							$('.modal').modal('hide');
						}
					});	
		}
		
	}
	
	function cancel(i){
		var data1={'id_schedule_dc' : i};
		$.ajax({ 		
					type:"POST",
					url: "<?php echo base_url();?>visitor/dccancel",
					data: data1,
					success:function(msg){
							$('.x_content').html(msg);
							alert('oke');
							$('.modal').modal('hide');
						}
					});	
		
	}
		
	function request_test(){
				var address ="<?php echo base_url();?>visitor/dcrequest_test";
				var element = "visitor_content";
				sendajax('',address,element,null,null);
				$('.visitor-modal').modal('show');
	}

	
	function request(){
				var address ="<?php echo base_url();?>visitor/dcrequest";
				var element = "visitor_content";
				sendajax('',address,element,null,null);
		}
</script>
	
