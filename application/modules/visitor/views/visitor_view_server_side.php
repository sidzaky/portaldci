



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
					<span id="allvisitor" style="float: right;" class="label label-primary" onclick='$("[type=search]").val("idkey");'></span>
					<span id="allplusday" style="float: right;" class="label label-danger" onclick='$("[type=search]").val("selama");'> </span>
				</h3>
				<div id="item-list">
						<div class="x_content"> 
							<?php $con->visitor_list_server_side();?>
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

<div class="nda-modal fade modal" id="third-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog" aria-hidden="true">
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
								<i>Nomor NDA</i> <span class="required">*</span>
							</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
										<input type="text" id="document_nda_visitor_nomor" required="" class="form-control">
										<span class="highlight"></span> <span class="bar"></span>
							</div>
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
								<i>Dokumen NDA</i> <span class="required">*</span>
							</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" id="document_results" class="form-control" onclick="getdocumentnda();" required="">
									<label for="Dokumen pendukung">Dokumen (Harus disii)</label>
									<input class="formedit" type="file" name="documentnda" id="documentnda" style="display:none;"> 
									<input type="hidden" name="document_nda_visitor" id="document_nda_visitor" value="">
									<button type="button" class="btn btn-info btn-sm  t-0" onclick="getdocumentnda();" ><i class="fa fa-upload"></i></button>	
									<button type="button" class="btn btn-success btn-sm" onclick="uploadnda();" style="float:right;" ><i class="fa fa-check"></i>Submit</button>	
							</div>
						
					</div>
					<div id="third_blank_content"></div>			
					</form>
			</div>
		</div>
	</div>
</div>

<div class="f-modal fade modal" id="modalwarningmessage" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Form Visitor</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="item form-group">
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
								<i>Set Warning Message</i> <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <input type="hidden" id="idwarningmessage" value="">
							  <input type="text" id="inputwarningmessage" value="" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
								<button type="button" class="btn btn-success btn-sm" onclick="setmessage('','true');"><i class="fa fa-check"></i>Submit</button>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


</div>
	
<script>
	var id_visitor_in;
	var id_visitor_nda;
	
	function get_data_checkin(){
		$.ajax({ type:"POST",
							url: "<?php echo base_url();?>visitor/get_data_checkin",
							success:function(msg){
									var data=JSON.parse(msg)
									document.getElementById('allvisitor').innerHTML="Jumlah Visitor saat ini : "+data.allvisitor;
									document.getElementById('allplusday').innerHTML="<i class='fa fa-warning'></i> Visitor Checkin Lebih Dari 24 Jam : "+data.allplusday;
							}
					});	
	}
	
	function form_visitor(i){
			if (i==null){
				var address="<?php echo base_url();?>visitor/input_visitor_server_side";
				var data1=null;
			}
			else{ 
				var address="<?php echo base_url();?>visitor/update_visitor_server_side";
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
								   url: "<?php echo base_url();?>visitor/input_visitor_server_side",
								   data: data1,
								   success:function(msg){
										$('#table').DataTable().ajax.reload(null, false);
										 get_data_checkin();
										}
				});	
		}
	}
	
	function form_checkin(i,j=''){
	
		if (j==''){
			$('.third-modal').modal('show');
			id_visitor_in=i;
			var address="<?php echo base_url();?>visitor/checkin_server_side";
			var element="third_blank_content";
			if (sendajax(null,address,element,null,null)) ;
			document.getElementById("datacontent").innerHTML=document.getElementById(i).innerHTML
		}
		else {
			alert(j);
		}
	}
	
	
	function checkin_visitor(){
		var data1={
								'id_visitor' 	: id_visitor_in,
								'id_site_dc'	: $('#id_site_dc').val(),
								'id_key'		: $('#id_key').val(),
								'bussiness'	 	: $('#bussiness').val(),
							};
		
		if (data1['id_key']!='' && data1['id_key']!=null && data1['id_key']!='undefined' && data1['level_access']!='' && data1['bussiness']!=''){
			
			$("#checkin_button").attr('disabled', 'disabled'); 
			$.ajax({ type:"POST",
							url: "<?php echo base_url();?>visitor/checkin_server_side",
							data: data1,
							success:function(msg){
									$('#table').DataTable().ajax.reload(null, false);
									$('.modal').modal('hide');
									 get_data_checkin();
							}
					});	
		}
		else alert('mohon lengkapi data atou error, mohon diulang');
	}
	
	
	function buttonup(i,j=""){
						var fileinput = document.getElementById("trigger_"+j+i);
						iddokument=i;
						fileinput.click();
	}
	
	function uploaddokument(i,j=""){
				var z;
				var files = document.getElementById("trigger_"+j+i).files;
				var file = files[0];
				if (files && file) {
					var reader = new FileReader();
					reader.onload = function(readerEvt) {
						var binaryString = readerEvt.target.result;
						var data1={
							'type' : j,
							'document' : btoa(binaryString),
							'id_visitor' : i,
							'name' : $('#trigger_'+j+i).val()
						};
						$.ajax({ type:"POST",
							   url: "<?php echo base_url();?>visitor/upload_document",
							   data: data1,
							   success:function(msg){
									$('#table').DataTable().ajax.reload(null, false);
								}
						});		
					};
					reader.readAsBinaryString(file);
				}
			}
	
	
	 $(document).ready(function() {
		 get_data_checkin();
	 })
	
	function checkout_visitor(i,j,k){
		var data1={
								'id_log_gedung' : i,
								'id_visitor' : j,
								'id_key'	:k
							};
		$.ajax({ type:"POST",
						url: "<?php echo base_url();?>visitor/checkout_server_side",
						data: data1,
						success:function(msg){
							$('#table').DataTable().ajax.reload(null, false);
							 get_data_checkin();
						}
				});	
	}
		
	function setmessage(i,j=''){
		if (j!=''){
			var data1={
								'id_visitor' : $('#idwarningmessage').val(),
								'warning_msg' : $('#inputwarningmessage').val()
							};
			$.ajax({ type:"POST",
							url: "<?php echo base_url();?>visitor/warningmessage",
							data: data1,
							success:function(msg){
								$('#modalwarningmessage').modal('hide');
							}
					});	
		}
		else {
			$('#modalwarningmessage').modal('show');
			$('#idwarningmessage').val(i);
		}
	}
	
	function stiker(i,j=''){	
		if (j!=''){
			var data1={
								'id_visitor' :i,
								'nopol' :$('#nopol').val(), 
								'stnk' :$('#stnk').val(),
								'nomor_stiker' :$('#nomor_stiker').val(),
							};
			$.ajax({ type:"POST",
							url: "<?php echo base_url();?>visitor/get_list_stiker",
							data: data1,
							success:function(msg){
								$('#table').DataTable().ajax.reload(null, false);
								$('#third-modal').modal('hide');
							}
					});	
		}
		
		else {
			var data1={
								'id_visitor' :i,
							};
			$.ajax({ type:"POST",
							url: "<?php echo base_url();?>visitor/get_list_stiker",
							data: data1,
							success:function(msg){
								$('#table').DataTable().ajax.reload(null, false);
								$('#third-modal').modal('show');
							}
			});	
		}
	}
	
	function del_stiker(i){
			if (confirm('Yakin Hapus data stiker visitor ini Pak???')){
						var data1={
									'nomor_stiker' : i,
								};
						$.ajax({ type:"POST",
									   url: "<?php echo base_url();?>visitor/del_visitor_stiker",
									   data: data1,
									   success:function(msg){
											$('#table').DataTable().ajax.reload(null, false);
											}
								});		
					}
	}
		
		
		
	function getdocumentnda() {
		
			document.getElementById('document_results').value="";
			document.getElementById('document_nda_visitor').value="";
			var fileinput = document.getElementById('documentnda');
			fileinput.click();
	}
					
	var handleFileSelectnda = function(evt) {
			var files = evt.target.files;
			var file = files[0];
			if (files && file) {
				var reader = new FileReader();
				reader.onload = function(readerEvt) {
					var binaryString = readerEvt.target.result;
					document.getElementById('document_nda_visitor').value=btoa(binaryString);
					document.getElementById('document_results').value=file.name; 
				};
				reader.readAsBinaryString(file);
			}
		};		
	document.getElementById("documentnda").addEventListener('change', handleFileSelectnda, false);	
	
	function checknumbernda(i){
		document.getElementById('document_results').value="";
		document.getElementById('document_nda_visitor').value="";
		var numnda="";
		$.ajax({ type:"POST",
					   url: './visitor/visitor_number_nda_check',
					   success:function(msg){
							msg=JSON.parse(msg);
							if (msg[0].document_nda_visitor_nomor==null) numnda=1;
							else {
								var zz=msg[0].document_nda_visitor_nomor.split('/');
								numnda=Number((zz[0]))+1;
							}
							var d = new Date();
							var n = d.getMonth();
							var y = d.getFullYear();
							document.getElementById('document_nda_visitor_nomor').value=numnda+"/NDA/DCI/"+n+"/"+y;
							id_visitor_nda=i;
					}
		});
	}
	
	function uploadnda(){
		var data1={
			'id_visitor' 								: id_visitor_nda,
			'document'								: $('#document_nda_visitor').val(),
			'name'										: $('#document_results').val(),
			'document_nda_visitor_nomor'	: $('#document_nda_visitor_nomor').val(),
		};
		var address="./visitor/visitor_upload_nda";
		sendajax(data1,address,null,null,null);
		$('#table').DataTable().ajax.reload(null, false);
		$('.nda-modal').modal('hide');
	}
	</script>
	
