
<?php 

	foreach ($unit_kerja as $row){
		$echolistunit_kerja.=' <option value="'.$row['unit_kerja'].'">';
	}
	if ($surat[0]['status_SIK']!=null) $disabled="disabled";
	$id_pms_lan		= ($surat[0]['id_pms_lan']!=null ? '  <input type="hidden" id="id_pms_lan" id="id_pms_lan" value="'.$surat[0]['id_pms_lan'].'">' : '' );
	$document_sik 	= ($surat[0]['document_SIK']!=null ? '  <input type="hidden" id="document_SIK_ex"  value="'.$surat[0]['document_SIK'].'">' : '' );
	$status_sik		= ($surat[0]['status_SIK']!=null ? ' <input type="hidden" id="status_SIK" value="'.$surat[0]['status_SIK'].'"> <input type="hidden" id="update_status_SIK" value="'.$surat[0]['update_status_SIK'].'"><input type="hidden" id="user_set_status_SIK" value="'.$surat[0]['user_set_status_SIK'].'">' : '');
	
	echo '<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" id="form" action="" novalidate>';
	echo '<div class="item col-md-4">';
	echo $id_pms_lan;
	echo $document_sik;
	echo $status_sik;
	echo '	<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Nomor Surat Masuk</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input '.$disabled.' type="text" value="'.$surat[0]['nomor_surat_masuk'].'"  id="nomor_surat_masuk" name="nomor_surat_masuk" class="form-control col-md-7 col-xs-12">
				</div>
			</div>
			
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="buy_date">
					Tanggal Surat Masuk
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input '.$disabled.' type="text" value="'.($surat[0]['tanggal_surat_masuk']!='0000-00-00' ? $surat[0]['tanggal_surat_masuk'] : "" ).'" data-provide="datepicker" class="datepicker form-control col-md-4 col-xs-8" id="tanggal_surat_masuk" name="tanggal_surat_masuk" />
				  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
				</div>
			</div>		
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Keterangan Surat Masuk</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <textarea '.$disabled.' id="keterangan_surat_masuk" name="keterangan_surat_masuk" class="form-control col-md-7 col-xs-12">'.$surat[0]['keterangan_surat_masuk'].'</textarea>
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Unit Kerja</i> <span class="required">*</span>
				</label>
				<datalist id="listunit_kerja">
					'.$echolistunit_kerja.'
				</datalist>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input '.$disabled.' type="text" value="'.$surat[0]['unit_kerja'].'" id="unit_kerja" name="unit_kerja" list="listunit_kerja"  class="form-control col-md-7 col-xs-12" placeholder="Divisi/Bagian">
				</div>
			</div>
			</div>
			
			<hr>
				
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Nomor SIK</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input '.$disabled.' type="text" value="'.$surat[0]['nomor_SIK'].'" id="nomor_SIK" name="nomor_SIK" class="form-control col-md-7 col-xs-12" placeholder="Nomor SIK">
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Tanggal SIK</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input  '.$disabled.' type="text" value="'.($surat[0]['tanggal_SIK']!='0000-00-00' ? $surat[0]['tanggal_SIK'] : "" ).'" id="tanggal_SIK" name="tanggal_SIK"  data-provide="datepicker" class="datepicker form-control col-md-4 col-xs-8" >
				  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Kategori SIK</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select  '.$disabled.' class="form-control col-md-7 col-xs-12" id="kategori" name="jenis_tarikan_1">
						<option value="pms_lan" '.($surat[0]['kategori']=='pms_lan' ? 'selected' : '').'>PMS LAN</option>
						<option value="non_pms_lan" '.($surat[0]['kategori']=='non_pms_lan' ? 'selected' : '').'>Non PMS LAN</option>
					</select>
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>SLA</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input  '.$disabled.' type="number" value="'.(isset($surat[0]['SLA']) ? $surat[0]['SLA'] : '7').'" id="SLA" name="SLA" class="form-control col-md-7 col-xs-12" >
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Rekanan SIK</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input  '.$disabled.' type="text" value="'.$surat[0]['rekanan_SIK'].'" id="rekanan_SIK" name="rekanan_SIK" class="form-control col-md-7 col-xs-12" >
				</div>
			</div>
			
		
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>User BAST</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" value="'.$surat[0]['user_BAST'].'" id="user_BAST" name="user_BAST" class="form-control col-md-7 col-xs-12" >
				</div>
			</div>
			
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Vendor BAST</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" value="'.$surat[0]['vendor_BAST'].'" id="vendor_BAST" name="vendor_BAST" class="form-control col-md-7 col-xs-12" >
				</div>
			</div>
			
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Tanggal BAST</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" value="'.($surat[0]['tanggal_BAST']!='0000-00-00' ? $surat[0]['tanggal_BAST'] : "" ).'" id="tanggal_BAST" name="tanggal_BAST"  data-provide="datepicker" class="datepicker form-control col-md-4 col-xs-8" >
				  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
				</div>
			</div>
			
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Nomor Ijin Anggaran</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" value="'.$surat[0]['nomor_ijin_anggaran'].'" id="nomor_ijin_anggaran" name="nomor_ijin_anggaran" class="form-control col-md-7 col-xs-12" >
				</div>
			</div>
			
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Tanggal Ijin Anggaran</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" value="'.($surat[0]['tanggal_ijin_anggaran']!='0000-00-00' ? $surat[0]['tanggal_ijin_anggaran'] : "" ).'" id="tanggal_ijin_anggaran" name="tanggal_ijin_anggaran"  data-provide="datepicker" class="datepicker form-control col-md-4 col-xs-8" >
				  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
				</div>
			</div>
			
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Keterangan Ijin Anggaran</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				   <textarea  id="keterangan_ijin_anggaran" name="keterangan_ijin_anggaran" class="form-control col-md-7 col-xs-12" >'.$surat[0]['keterangan_ijin_anggaran'].'</textarea>
				</div>
			</div>
			
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Nomor SPK</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" value="'.$surat[0]['nomor_SPK'].'" id="nomor_SPK" name="nomor_SPK" class="form-control col-md-7 col-xs-12" >
				</div>
			</div>
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
					<i>Tanggal SPK</i> <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" value="'.($surat[0]['tanggal_SPK']!='0000-00-00' ? $surat[0]['tanggal_SPK'] : "" ).'"  id="tanggal_SPK" name="tanggal_SPK"  data-provide="datepicker" class="datepicker form-control col-md-4 col-xs-8" >
				  <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
				</div>
			</div>
			
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostname">
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <button type="button" class="btn btn-default btn-sm" onclick="input_suratmasuk();" ><i class="fa fa-check"></i>Submit</button>
				</div>		
		</form>';
		echo '<div class="col-md-8">';
		echo '</div>';
						
		?>				
	<script>
	
		$('.datepicker').datepicker({format: 'yyyy-mm-dd'});
	
	
		$('form').on('submit', function(e){
				e.preventDefault();
		});
		
		function formact() {
			 var count=$('#tarikan').children().last().attr('id');
			 count =count.split("_");
			 var newid=parseInt(count[1])+1;
			 $("#tarikan").append('<div id="tarikan_'+newid+'" name="tarikan_'+newid+'" class="formtarikan"><div class="col-md-2 col-sm-2 col-xs-12"><select id="jenis_tarikan_'+newid+'" name="jenis_tarikan_'+newid+'" class="form-control col-md-7 col-xs-12"><option value="Kabel Data">Kabel Data</option><option value="Kabel Power">Kabel Power</option><option value="Power Ekstension">Power Ekstension</option><option value="Patch Cord">Patch Cord</option><option value="PDU">PDU</option><option value="Connector Power">Connector Power</option><option value="Fiber Optic">Fiber Optic</option><option value="CCTV">CCTV</option><option value="Telepon">Telepon</option><option value="Lain lain">Lain lain</option></select></div><div class="col-md-2 col-sm-2 col-xs-12"><input type="number" id="jumlah_tarikan_'+newid+'" name="jumlah_tarikan_'+newid+'" class="form-control col-md-7 col-xs-12" placeholder=""></div><div class="col-md-2 col-sm-2 col-xs-12"><input type="text" id="titik_pertama_tarikan_'+newid+'" name="titik_pertama_tarikan_'+newid+'" class="form-control col-md-7 col-xs-12" placeholder=""></div><div class="col-md-2 col-sm-2 col-xs-12"><input type="text" id="titik_kedua_tarikan_'+newid+'" name="titik_kedua_tarikan_'+newid+'" class="form-control col-md-7 col-xs-12" placeholder=""></div><div class="col-md-3 col-sm-3 col-xs-12"><input type="text" id="keterangan_'+newid+'" name="keterangan_'+newid+'" class="form-control col-md-7 col-xs-12" placeholder=""></div><div class="col-md-1 col-sm-1 col-xs-12"><button onclick="minform('+newid+')" type="button" class="btn btn-default btn-sm"><i class="fa fa-minus"></i></button></div></div>');			
			}
			
		function minform(id) {
				$('#tarikan_'+id).remove();
			}
			
			
		function input_suratmasuk(){	
						var data1 = { 
							'id_pms_lan'  : $('#id_pms_lan').val(),
							'nomor_surat_masuk'  : $('#nomor_surat_masuk').val(),
							'tanggal_surat_masuk' : $('#tanggal_surat_masuk').val(),
							'keterangan_surat_masuk' : $('#keterangan_surat_masuk').val(),
							'unit_kerja' : $('#unit_kerja').val(),
							'nomor_SIK' : $('#nomor_SIK').val(),
							'kategori' : $('#kategori').val(),
							'tanggal_SIK' : $('#tanggal_SIK').val(),
							'SLA' : $('#SLA').val(),
							'rekanan_SIK' : $('#rekanan_SIK').val(),
							'user_BAST' : $('#user_BAST').val(),
							'vendor_BAST' : $('#vendor_BAST').val(),
							'tanggal_BAST' : $('#tanggal_BAST').val(),
							'nomor_ijin_anggaran' : $('#nomor_ijin_anggaran').val(),
							'tanggal_ijin_anggaran' : $('#tanggal_ijin_anggaran').val(),
							'keterangan_ijin_anggaran' : $('#keterangan_ijin_anggaran').val(),
							'nomor_SPK' : $('#nomor_SPK').val(),
							'tanggal_SPK' : $('#tanggal_SPK').val(),
							'document_SIK' : $('#document_SIK_ex').val(),
							'status_SIK' : $('#status_SIK').val(),
							'update_status_SIK' : $('#update_status_SIK').val(),
							'user_set_status_SIK' : $('#user_set_status_SIK').val(),
						};
						var data2={
							'jenis_tarikan' : [],
							'jumlah_tarikan' : [],
							'titik_pertama_tarikan' : [],
							'titik_kedua_tarikan' : [],
							'keterangan' : [],
						}
						
						var count=$('#tarikan').children().last().attr('id');
						count =count.split("_");
						for (var i=1;i<=count[1];i++){
							data2['jenis_tarikan'].push($('#jenis_tarikan_'+i).val());
							data2['jumlah_tarikan'].push($('#jumlah_tarikan_'+i).val());
							data2['titik_pertama_tarikan'].push($('#titik_pertama_tarikan_'+i).val());
							data2['titik_kedua_tarikan'].push($('#titik_kedua_tarikan_'+i).val());
							data2['keterangan'].push($('#keterangan_'+i).val());
						}
						
						var data={
							'surat' : data1,
							'tarikan' : data2
						}
						
					$.ajax({ 
							type:"POST",
						    url: "<?php echo base_url()?>pmslan/input_request_tarikan",
						    data: data,
						    success:function(msg){
							    $('.x_content').html(msg);
								$('.modal').modal('hide');
								alert('Input Sukses');
							}
					});
				
			}			
	</script>