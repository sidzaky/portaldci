function sendajax(data1,address,element=null,notif,tipe){
			if (element!=null) loading(element);
				$.ajax({ 
					   type:"POST",
					   url: address,
					   data: data1,
					   dataType:tipe, 
					   success:function(msg){
						   if (element!=null) $('#'+element).html(msg);
						   if (notif!=null){
								 $.toast({
										heading: notif['heading'],
										text: notif['text'],
										position: 'top-right',
										loaderBg: '#ff6849',
										icon: notif['icon'],
										hideAfter: 3500,
										stack: 6
									})
								}
							return true;
							}
						});
			}
			
function loading(i){		
		document.getElementById(i).innerHTML='<img src="assets/img/loader.gif" style="display:block;margin:auto;overflow:hidden;max-width:500px;">';   
	}
