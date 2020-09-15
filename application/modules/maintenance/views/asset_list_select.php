
        <table id="datatable" class="table table-hover table-striped table-bordered" cellspacing="0">
				  <thead>
				    <tr>
				      <th><i>Nama</i></th>
				      <th><i>Tipe</i></th>
				    
				      <th>Lokasi</th>
				      <th>S/N</th>
				      <th>Kapasitas Per ITEM</th>
              <th>Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  	foreach($asset as $row){
						?>
							<tr class="<?php echo $row["ACTIVE"]=="N" ? "red":""; ?>" style="cursor:pointer;">
								<td><?php echo $row["HOSTNAME"] ?></td>
								<td><?php echo $row["BRAND"].' / '.$row["TYPE"] ?></td>
								<td><?php echo $row["LOCATION"] .' / '.$row["nama_dc"] ?></td>
								<td><?php echo $row["SERIAL_NUMBER"] ?></td>
								<td><?php echo $row["OPERATING_SYSTEM"] ?></td>
                <td>
                  <button type="button" class="btn btn-primary btn-xs" onclick="document.getElementById('ASSET_ID').value='<?php echo $row["ID"];?>';document.getElementById('ASSET_ID_view').value='<?php echo $row["HOSTNAME"];?>';">Pilih</button>
                </td>
							</tr>
						<?php
				  	}
				  	?>
				  </tbody>
				</table>
     <script>
	 $(document).ready(function() {
					$("#datatable").DataTable();	
			});
	 
	 
	 </script>