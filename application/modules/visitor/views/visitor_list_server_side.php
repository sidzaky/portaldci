  
		<table id="table" class="table dataTable no-footer" cellspacing="0" width="100%">
			<thead>
			   <tr>
					<th><i>No</i></th>
					<th><i>Detail Visitor</i></th>
					<th><i>Last Check</i></th>
					<th><i>Foto</i></th>
					<th><i>Foto Id</i></th>
					<th><i>Action</i></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
  </div>
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#table').DataTable({ 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "ajax": {
                "url": "<?php echo base_url();?>visitor/get_data_user",
                "type": "POST"},
            "columnDefs": [{"targets": [ 0 ],
							"orderable": false}],
			
			"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
				var colours = aData[2];
				var col = colours.split(' ');
				if (col.includes('key')){
					$('td', nRow).css("background-color","#ffff99"); 
				}
				else $('td', nRow).css("background-color","rgba(54, 162, 235, 0.3)");
				return nRow;
			}, 
			scrollX : true,
			drawCallback: function(){
				$("img.lazy").lazyload();
			}
        });
		get_data_checkin();
	});
 
</script>
