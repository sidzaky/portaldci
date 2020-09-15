
	
	function get(){
		var data1={
				'date1' : $('#rentangtanggal1').val(),
				'date2' : $('#rentangtanggal2').val()
			};
			$.ajax({ type:"POST",
						   url: "instro/getsummary",
						   data: data1,
						   success:function(msg){
								var result=JSON.parse(msg);
								datagraph={
										labels: result['report_by_asset']['label'],
										datasets: [{
													label:'# of Votes',
													data: result['report_by_asset']['data'],
													backgroundColor: result['report_by_asset']['backgroundColor'],
												}],
									} 				 
								showsummary(datagraph,'report_by_asset',result['report_by_asset']['text']);
								
								datagraph={
										labels: result['pending_instro']['label'],
										datasets: [{
													label:'# of Votes',
													data: result['pending_instro']['data'],
													backgroundColor: result['pending_instro']['backgroundColor'],
												}],
									} 				 
								// showsummary(datagraph,'pending_instro',result['pending_instro']['text']);		 
								
								areachart(result['solved_time'],'solved_time',result['solved_time']['text'])
						   }
				});
	}
	
	function areachart(datagraph,i,text){
		
		$('#'+i).remove();
		$('#placecanvas'+i).append('<div id="'+i+'" style="position: relative;"></div>');
		Morris.Bar({
					element: i,
					data: 	datagraph,
					xkey: 'label',
					ykeys: ['time_problem'],
					labels: ['hours'],
					resize: false,
					padding: 60,
					xLabelAngle: 45,
					hideHover: 'auto'
			});
		
	}
	
	function showsummary(datagraph,i,text){
			
			$('#'+i).remove();
			$('#placecanvas'+i).append('<canvas id="'+i+'"  width="150" height="150" style="display: block; width:150px; height: 150px;"></canvas>');
			var ctx = document.getElementById(i).getContext('2d');
			document.getElementById('text'+i).innerHTML=text;
			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: datagraph,
				options: {
						responsive: true,
						legend: {
							display : false
						},
						title: {
							display: false,
							text: 'Pms Lan Summary'
						},
						animation: {
							animateScale: true,
							animateRotate: true
						}
					}
			});
			
		}
	