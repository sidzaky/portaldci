



<div class="container-fluid">
	<div class="row bg-title">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo  $headboard ?></h4>
			</div>
			<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><?php echo  $breadcrumb[0] ?></li>
					<li class="active"><?php echo $breadcrumb[1] ?></li>
				</ol>
			</div>
	</div>
	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="white-box">
				<h3 class="box-title">
					<button type="button" class="btn btn-success waves-effect waves-light" onclick="form_visitor();" data-toggle="modal" data-target=".first-modal">Register Visitor baru</button>
					<span id="allvisitor" style="float: right;" class="label label-primary" onclick='$("[aria-controls=visitortablelist]").val("id key");'></span>
					<span id="allplusday" style="float: right;" class="label label-danger" onclick='$("[aria-controls=visitortablelist]").val("Selama");'> </span>
				</h3>
				<div id="item-list">
						<div class="x_content">
							<?php $con->viewlist();?>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="first-modal fade modal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
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

<div class="third-modal fade modal" id="third-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Visitor</h4>
			</div>
				<div id="" class="modal-body">
				<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" id="form" action="" novalidate> 
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
							<i>Data Pengunjung</i> <span class="required">*</span>
						</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div id="datacontent">
							</div>
						</div>
					</div>
					<div id="third_blank_content"></div>			
					</form>
			</div>
		</div>
	</div>
</div>


</div>
	
<script>
	var id_visitor_in;
	function form_visitor(i){
			if (i==null){
				var address="<?php echo base_url();?>visitor/input_visitor";
				var data1=null;
			}
			else{ 
				var address="<?php echo base_url();?>visitor/update_visitor";
				var data1= {
							'id_visitor' :  i,
						};
				}
			$.ajax({ type:"POST",
					   url: address,
					   data: data1,
					   success:function(msg){
						   $('#blank_content').html(msg);
							}
			});
		}
	function disvis(i,k){
		if (confirm('yakin menghapus pengunjung '+k+'???')){
			var data1={
								'id_visitor' : i,
								'active'	 : '0',
							};
					$.ajax({ type:"POST",
								   url: "<?php echo base_url();?>visitor/input_visitor",
								   data: data1,
								   success:function(msg){
										$('.x_content').html(msg);
										}
				});	
		}
	}
	
	function form_checkin(i){
			id_visitor_in=i;
			var address="<?php echo base_url();?>visitor/checkin";
			var element="third_blank_content";
			if (sendajax(null,address,element,null,null)) ;
			document.getElementById("datacontent").innerHTML=document.getElementById(i).innerHTML
	}
	
	function getavailablekey(i){
		var data1={
			'warna': i
		}
		var list;
		$.ajax({ type:"POST",
								   url: "<?php echo base_url();?>visitor/getavailablekey",
								   data: data1,
								   success:function(msg){
										var data=JSON.parse(msg);
										for (var i=0;i<data.length;i++){
											list +='<option value="'+data[i]['id_key']+'">'+data[i]['nomer']+'</option>';
										} 
										document.getElementById("form_key_number").innerHTML='<select id="id_key" class="form-control col-md-7 col-xs-12">'+list+'</select>';
									}
				});	
	}
	
	
	function checkin_visitor(){
		var data1={
								'id_visitor' 	: id_visitor_in,
								'id_key'		: $('#id_key').val(),
								'bussiness'	 	: $('#bussiness').val(),
							};
		
		if (data1['id_key']!='' && data1['level_access']!='' && data1['bussiness']!=''){
			
			$("#checkin_button").attr('disabled', 'disabled'); 
			$.ajax({ type:"POST",
							url: "<?php echo base_url();?>visitor/checkin",
							data: data1,
							success:function(msg){
									$('.x_content').html(msg);
									$('.modal').modal('hide');
							}
					});	
		}
		else alert('mohon lengkapi data');
		
	}
	
	function checkout_visitor(i,j,k){
		var data1={
								'id_log_gedung' : i,
								'id_visitor' : j,
								'id_key'	:k
							};
		$.ajax({ type:"POST",
						url: "<?php echo base_url();?>visitor/checkout",
						data: data1,
						success:function(msg){
							$('.x_content').html(msg);
						}
				});	
		
	}
		
		
	</script>
	
