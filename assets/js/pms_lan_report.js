		function detsummary(i,j){
				var data1={	
								'type'  : j,
								'where' : i,
								'date1' : $('#rentangtanggal1').val(),
								'date2' : $('#rentangtanggal2').val()
							};
				$.ajax({ type:"POST",
							   url: "pmslan/detsummary",
							   data: data1,
							   success:function(msg){
									$('#summarycontent').html(msg);
									}
					});	
			
		}
			
		function dettarikan(i){
				var data1={	
								'where' : i,
								'date1' : $('#rentangtanggal1').val(),
								'date2' : $('#rentangtanggal2').val()
							};
				$.ajax({ type:"POST",
							   url: "pmslan/dettarikan",
							   data: data1,
							   success:function(msg){
									$('#summarycontent').html(msg);
									}
					});	
			
		}
		
		function dettimetarikan(i){
				var data1={	
								'where' : i,
								'date1' : $('#rentangtanggal1').val(),
								'date2' : $('#rentangtanggal2').val()
							};
				$.ajax({ type:"POST",
							   url: "pmslan/dettimetarikan",
							   data: data1,
							   success:function(msg){
									$('#summarycontent').html(msg);
									}
					});	
			
		}
			
			 
		var datagraph;
	
		function showsummary(datagraph,i){
			
			$('#'+i).remove();
			$('#placecanvas'+i).append('<canvas id="'+i+'"  width="150" height="150" style="display: block; width:150px; height: 150px;"></canvas>');
			var ctx = document.getElementById(i).getContext('2d');
			
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
		function get(){
			var data1={
				'date1' : $('#rentangtanggal1').val(),
				'date2' : $('#rentangtanggal2').val()
			};
			$.ajax({ type:"POST",
						   url: "pmslan/getsummary",
						   data: data1,
						   success:function(msg){
							  
								var result=JSON.parse(msg);
								document.getElementById('On_progress').innerHTML=result[0]['On_progress']+'  ('+((result[0]['On_progress']/result[0]['Total'])*100).toFixed(0)+'%)';
								document.getElementById('Done').innerHTML=result[0]['Done']+'  ('+((result[0]['Done']/result[0]['Total'])*100).toFixed(0)+'%)';
								document.getElementById('Cancel').innerHTML=result[0]['Cancel']+'  ('+((result[0]['Cancel']/result[0]['Total'])*100).toFixed(0)+'%)';
								document.getElementById('Total').innerHTML=result[0]['Total'];
								document.getElementById('sla').innerHTML=result[0]['sla'];
								for (var i=0;i<5;i++){
									if (i==0){ 
										var label=["On Progress", "Done", "Cancel" ];
										var dataresult=[result[i]['On_progress'], result[i]['Done'],  result[i]['Cancel']];
										var Colorresult = ['rgba(255, 99, 132,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86,1)',];
										var chartid="myChart";
									}
									else if (i==1) {
										var label=["x < 2", "x>2 || x<=5 ", "x>5 || x<=7 ", "x>7 " ];
										var dataresult=[result[i]['a'], result[i]['b'],  result[i]['c'], result[i]['d']];
										var Colorresult= ['rgba(100, 206, 86,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86,1)','rgba(255, 99, 132,1)'];
										var chartid="progresschart";
									}
									else if (i==2) {
										var label=result[i]['labels'];
										var dataresult=result[i]['data'];
										var Colorresult= result[i]['colors'];
										var chartid="tarikanchart";
										document.getElementById('tablejumlahtarikan').innerHTML=result[i]['text'];
									}
									else if (i==3){
										var label=result[i]['labels'];
										var dataresult=result[i]['data'];
										var Colorresult= result[i]['colors'];
										var chartid="thedayschart";
										document.getElementById('tablelamatarikan').innerHTML=result[i]['text'];
										
									}
									
									datagraph={
										labels: label,
										datasets: [{
											label: '# of Votes',
											data: dataresult,
											backgroundColor: Colorresult,
										}]
									} 
									
									showsummary(datagraph,chartid);
									
									$('a.tr').click(function(e){
										e.preventDefault();
									});
								}
							}
				});	
			}
			