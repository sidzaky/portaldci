
<table id="visitortablelist" class="table  dataTable no-footer" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th><i>No</i></th>
			<th><i>Detail Visitor</i></th>
			<th><i>Last Check</i></th>
			<th><i>Foto</i></th>
			<th><i>Foto Id</i></th>
			<th><i>action</i></th>
		</tr>
	</thead>
	  <tbody>
		<?php
		$i=0;
		$in=0;
		$plusday=0;
		foreach($visitor as $srow){
			$bussiness='';
			$id_key='';
			$lastchekin='';
			
			$datacek=$con->checkin_cek($srow['id_visitor']);
			if ($datacek['status']=='true') {
						$in++;
						$bussiness='<b><span class="label label-success"> '.$datacek[0]['bussiness'].'</span></br></b>';
						$ischeckin=($this->session->userdata('module_access')['vm1']>2 ? '<button class="btn btn-success waves-effect waves-light btn-sm" onclick="checkout_visitor(\''.$datacek[0]['id_log_gedung'].'\',\''.$srow['id_visitor'].'\',\''.$datacek[0]['id_key'].'\');" type="button" ><i class="fa fa-sign-out"></i> Check out</button>' : '' );
						$colortable='style="background-color : #ffff99"';
						$id_key='<span class="label label-danger">Id key:'.$datacek[0]['warna'].'['.$datacek[0]['nomer'].'] ['.$datacek[0]['keterangan'].'] </span>';
						$day=floor(((time()-$datacek[0]['time_in'])/3600)/24);
						$lastchekin=($day != 0 ? '<input type="hidden" id="plusday" value="'.$plusday++.'"><span class="label label-danger"> Checkin selama '.$day.' Hari '.gmdate("H:i", time()-$datacek[0]['time_in']). ' Jam </span> </br>' : '' ).'<span class="label label-warning"> Waktu Check in : '.date('H:i d-M, Y', $datacek[0]['time_in']).'</span></br>';
			}
			else {
					$ischeckin=($this->session->userdata('module_access')['vm1']>2 ? '<button class="btn btn-primary waves-effect waves-light btn-sm checkin" data-toggle="modal" data-target=".third-modal"  onclick="form_checkin(\''.$srow['id_visitor'].'\');" type="button" ><i class="fa fa-sign-in"></i> Check In</button>' : '' );
					$colortable='style="background-color :  rgba(54, 162, 235, 0.3)"';
					$lastchekin=($datacek[0]['time_in'] != '' ? '<span class="label label-success">'.date('H:i d-M, Y', $datacek[0]['time_in']).' s/d '.date('H:i d-M, Y', $datacek[0]['time_out']).'</span>': '<span class="label label-info">Belum Pernah Checkin</span>' );
			}
			$i++;
			
			echo 	'<tr '.$colortable.'> 
						<td>'. $i  .'</td>
						<td id="'.$srow['id_visitor'].'">
							<span class="label label-success">'.$srow["name_visitor"].' ['.($srow["organic"]!=0 ? 'PT. BRI // '  : '' ).$srow["company"].'] </span></br>
							<span class="label label-info"> Id Number :  '.$srow["id_number"] .'</span></br>
							<span class="label label-info"> Nomor Telepon  : '.$srow["phone_number"] .'</span></br>
							<span class="label label-primary"> Alamat  : '.substr($srow["domicile"] ,0,30).'</span></br>
						</td>
						
						<td>'.$bussiness.$lastchekin.$id_key.'</td> 
						<td align="center"><a target="_blank" href="'.base_url().($srow['person_img'] !='' ? $srow['person_img'] : 'assets/img/unknown.jpg').'"> <img class="lazy"  data-original="'.base_url().($srow['person_img'] !='' ? $srow['person_img'] : 'assets/img/unknown.jpg').'"  style="max-width:300px;max-height:150px;"></a></td>
						<td align="center"><a target="_blank" href="'.base_url().($srow['idcard_img'] !='' ? $srow['idcard_img'] : 'assets/img/unknown.jpg').'"> <img class="lazy"  data-original="'.base_url().($srow['idcard_img'] !='' ? $srow['idcard_img'] : 'assets/img/unknown.jpg').'"   style="max-width:200px;max-height:150px;"></a></td>
						<td>	
							'.$ischeckin.'<button class="btn btn-warning waves-effect waves-light btn-sm" data-toggle="modal" data-target=".first-modal" onclick="form_visitor(\''.$srow['id_visitor'].'\')" data-target=".modal" type="button" ><i class="fa fa-pencil"></i>Edit</button>
							'.($this->session->userdata('module_access')['vm1']>=0 ?  '<button class="btn btn-danger waves-effect waves-light btn-sm"  onclick="disvis(\''.$srow['id_visitor'].'\',\''.$srow['name_visitor'].'\')"  type="button" ><i class="fa fa-close"></i>Delete</button>' : '' ).'
						</td>
					</tr>';
			}
		?>
		</tbody>
	</table>	
	
<script>
	$( document ).ready(function() {
		document.getElementById('allvisitor').innerHTML="Jumlah Visitor saat ini : <?php echo $in?>";
		document.getElementById('allplusday').innerHTML="<i class='fa fa-warning'></i> Visitor Checkin Lebih Dari 24 Jam : <?php echo $plusday?>";
	});
	
	$('#visitortablelist').DataTable({
		scrollX : true,
		fixedHeader: {
            header: true,
            footer: true
        },
		drawCallback: function(){
				$("img.lazy").lazyload();
		}
	});
	
	
</script>	