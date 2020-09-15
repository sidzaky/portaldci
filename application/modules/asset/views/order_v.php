            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Retailler List</h4>
                    </div>
                </div>
				<div class="col-md-12">
					
                        <div class="white-box">
							<label>
                            <h3 class="box-title m-b-0" style="float:left;">Daftar Order Aktif</h3>
							</label>
							<div id="item-list">
								<?php 
									$this->load->view('list_order_v',$data);
									?>
							</div>
				</div>
            </div>
     
	 
	 <!-- modal-->
	 
	 
	 <div class="modal fade bs-example-modal-lg in" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabeltitle">Form Items</h4>
					</div>
					<div class="modal-body">
						<div id="content-modal">
					
						</div>
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			</div>
	</div>
	
	<script>
	
	var formid;
	function item(i){
		document.getElementById("myLargeModalLabeltitle").innerHTML="Form Items";
		formid=1;
		if (i==null){
			var address="<?php echo base_url();?>product_ret/item_form";
			var data1=null;
		}
		else{ 
			var address="<?php echo base_url();?>product_ret/item_reorder";
			var data1= {
						'id_product_det' :  i,
					};
			}
		var element = "content-modal" 	;
		sendajax(data1,address,element,null,null);
	}
	
	
	function detailproduct(i){
		var data1= {
						'id_product_det' :  i,
					};
		var address ="<?php echo base_url();?>product_ret/item_det";
		var element = "content-modal";
		sendajax(data1,address,element,null,null);
	}
	
	
	</script>
	
	
       