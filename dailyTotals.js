$(document).ready(function()
{
	var venueID = 1;
	var maxValue = 0;
	var chartType = 'line';

	populateChart();

	function populateChart()
	{
		$('#imgNoData').hide();
		$('#mycanvas').show();
		
		$.ajax(
		{
			url: "http://headcountlive.com/getDailyTotals.php?venueID="+venueID,
			method: "GET",
			dataType: "json",
			success: function(data) 
			{
				console.log(data);
				maxValue = 0;
				if(data.length>0)
				{
					var specificDay = [];
					var specificHour = [];
		            var myIns = [];
		            var myOuts = [];
		            var counts = [];

					for(var i in data) 
					{
						const MONTHS = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
						const ORDINALS = ["st", "nd", "rd", "th"];

						var date = new Date(data[i].specificDay);
						var dd2 = parseInt(date.getDate());
						var mm2 = date.getMonth();
						var yyyy2 = date.getFullYear();

						switch (dd2)
						{
							case 1: case 21: case 31:
						        dd2 += ORDINALS[0];
						        break;
						    case 2: case 22:
						        dd2 += ORDINALS[1];
						        break;
						    case 3: case 23:
						        dd2 += ORDINALS[2];
						        break;
						    case 4: case 5: case 6: case 7: case 8: case 9: case 10: case 11: case 12: case 13: case 14:
						    case 15: case 16: case 17: case 18: case 19: case 20: case 24: case 25: case 26: case 27: 
						    case 28: case 29: case 30:
						        dd2 += ORDINALS[3];
						        break;
						}

						date = dd2+" "+MONTHS[mm2]+" "+yyyy2;
						date = date.substring(0, 15);

						specificDay.push(date);
						myIns.push(data[i].myIns);
						myOuts.push(data[i].myOuts);
						//to take into account previous hours count
						if(i == 0)
							counts.push(data[i].myIns-data[i].myOuts);
					}

					for(var i in data)
					{
						//to take into account previous hours count
						if(i > 0)
							counts.push((data[i].myIns-data[i].myOuts)+(counts[i-1]));
					}	

					for(var i in data)
					{
						if(myIns[i] >= maxValue)
							maxValue = counts[i];
					}

					//to make top point visible on graph
					//maxValue = counts[counts.length-1];
					if(counts.length == 1)
						chartType = 'bar';
					else
						chartType = 'line';

					for(var i in data) 
					{
						//console.log("specificDay: "+specificDay[i]);
						//console.log("specificHour: "+specificHour[i]);
						console.log("myOuts: "+myOuts[i]);
						console.log("myIns: "+myIns[i]);
						console.log("count: "+counts[i]);
					}

					var chartdata = 
					{
						labels: specificDay,
						//labels: customLabels,
						datasets : 
						[
							{
								label: 'MyIns',
								backgroundColor: 'rgba(0, 255, 0, 0.10)',
								borderColor: 'rgba(0, 200, 0, 0.90)',
								pointBackgroundColor: 'rgba(0, 20, 255, 0.90)',
								pointHoverBorderColor: 'rgba(255, 0, 0, 0.90)',
								data: myIns
							},
						]
					};

					var canvas = $("#mycanvas");
					var context = canvas.get(0).getContext('2d');

					//clears chart so no overlapping occurs: solution found at https://www.youtube.com/watch?v=c61Fs0itRdM
					if(window.bar != undefined)
						window.bar.destroy();

					//draw chart
					window.bar = new Chart(context, 
					{
						type: chartType,
						data: chartdata,
						responsive: true,
						maintainAspectRatio: true,
						showScale: false,
						options: 
						{
							title: 
							{
						      display: true,
						      text: 'Total Count for Each Day'
						    },
						    scales:
						    {
						    	xAxes:
						    	[{
						    		ticks: 
						    		{
						    			autoSkip: false,
						    		}
						    	}],
						    	yAxes:
						    	[{
						    		ticks: 
						    		{
						    			beginAtZero: true,
						    			//so that highest step size is shown
						    			suggestedMax: maxValue = parseInt(maxValue * 1.05)
						    		}
						    	}]
						    },
						    layout:
						    {
						    	padding:
						    	{
						    		top: 5,
						    		bottom: 5,
						    		left: 5,
						    		right: 5
						    	}
						    }
						}
					});
				}//END IF 
				else
				{
					$('#imgNoData').show();
					$('#mycanvas').hide();
				}	

			},//success end

			error: function(data) 
			{
				console.log("Error");
			}
		});
	}//end populateChart()

	$("#slctVenue").change(function()
	{
		venueID = $("#slctVenue").val();
		console.log("index:"+venueID);
		populateChart();
	});
});