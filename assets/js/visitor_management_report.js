function get(){
		var data1={
				'date1' : $('#rentangtanggal1').val(),
				'date2' : $('#rentangtanggal2').val()
			};
			$.ajax({ type:"POST",
						   url: "visitor/getsummary",
						   data: data1,
						   success:function(msg){
								var result=JSON.parse(msg);
								showsummary(result);
						   }
			});
	}

function gettable(i){
	var data1={
				'date1' : $('#rentangtanggal1').val(),
				'date2' : $('#rentangtanggal2').val()
			};
			$.ajax({ type:"POST",
						   url: "visitor/gettable/"+i,
						   data: data1,
						   success:function(msg){
								$('#summarycontent').html(msg);
						   }
			});
	
	
}
	
function showsummary(data){
	var totalvisitor=0;
	var totalcheckingedung=0;
	var totalcheckindc=0;
	for (var i=0;i<data.length;i++){
			totalvisitor=totalvisitor + parseInt(data[i]['newvisitor']);
			totalcheckingedung=totalcheckingedung + parseInt(data[i]['checkin_gedung']);
			totalcheckindc=totalcheckindc + parseInt(data[i]['checkin_dc']);
	}
	document.getElementById('totalvisitor').innerHTML=totalvisitor;
	document.getElementById('ratagedung').innerHTML=(totalcheckingedung/parseInt(i)).toFixed(0);
	document.getElementById('ratadc').innerHTML=(totalcheckindc/parseInt(i)).toFixed(0);
	document.getElementById('totaldc').innerHTML=(totalcheckindc).toFixed(0);
	
	$('#morris-area-chart').remove();
	$('#placecanvas').append('<div id="morris-area-chart" style="position: relative;"></div>');
	Morris.Area({
				element: 'morris-area-chart',
				data: data,
				xkey: 'date',
				ykeys: ['newvisitor', 'checkin_gedung', 'checkin_dc'],
				labels: ['newvisitor', 'checkin_gedung', 'checkin_dc'],
				pointSize: 3,
				fillOpacity: 0,
				pointStrokeColors:['#00bfc7', '#fdc006', '#2c5ca9'],
				behaveLikeLine: true,
				gridLineColor: '#e0e0e0',
				lineWidth: 1,
				hideHover: 'auto',
				lineColors: ['#00bfc7', '#fdc006', '#2c5ca9'],
				resize: true
		});
}
	
	