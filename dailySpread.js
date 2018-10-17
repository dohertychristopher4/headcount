$(document).ready(function()
{
	var venueID = 1;
	var selectedDate = new Date($("#slctDay").val());
	var chartType = 'line';
	var dd = selectedDate.getDate();
	var mm = selectedDate.getMonth()+1;
	var yyyy = selectedDate.getFullYear();

	if(dd < 10)
		dd = '0' +dd;

	if(mm < 10)
		mm = '0' +mm;

	selectedDate = yyyy+"-"+mm+"-"+dd;
	console.log(selectedDate);

	function populateChart()
	{
		$('#imgNoData').hide();
		$('#mycanvas').show();
		var maxValue = 0;

		$.ajax(
		{
			url: "http://headcountlive.com/getHourlySummary.php?venueID="+venueID+"&selectedDate="+selectedDate,
			method: "GET",
			dataType: "json",
			success: function(data) 
			{
				console.log(data);
				if(data.length>0)
				{
					var specificHour = [];
		            var myIns = [];
		            var customLabels = [];

					for(var i in data) 
					{
						myIns.push(data[i].myIns);
						specificHour.push(data[i].specificHour);
					}

					for(var i in data) 
					{
						if(myIns[i] >= maxValue)
							maxValue = myIns[i];
					}

					for(var i in data) 
					{
						if(specificHour[i] >= 12)
						{
							customStr = specificHour[i] - 12;

							if(customStr == 0)
							{
								customStr = parseInt(customStr) + 12;
							}

							customStr = customStr + "p.m.";
						}

						else
						{
							customStr = specificHour[i];

							if(customStr == 0)
							{
								customStr = parseInt(customStr) + 12;
							}
							customStr = customStr + "a.m.";
						}
						customLabels[i] = customStr;
					}
					
					if(myIns.length == 1)
						chartType = 'bar';
					else
						chartType = 'line';

					for(var i in data) 
					{
						console.log("myIns: "+myIns[i]);
					}

					var chartdata = 
					{
						labels: customLabels,
						//labels: customLabels,
						datasets : 
						[
							{
								label: 'Ins',
								backgroundColor: 'rgba(0, 255, 100, 0.40)',
								borderColor: 'rgba(0, 200, 0, 0.70)',
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
						options: 
						{
							title: 
							{
						      display: true,
						      text: 'Daily Count per Hour'
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
						    			//only working sometimes
						    			suggestedMax: maxValue = parseInt(maxValue * 1.20)
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
	populateChart();



	$("#slctVenue").change(function()
	{
		venueID = $("#slctVenue").val();
		console.log("index:"+venueID);
		populateChart();
	});

	$("#slctDay").change(function()
	{
		selectedDate = $("#slctDay").val();
		$("#calendar").val(selectedDate);
		populateChart();
	});



	$("#calendar").change(function()
	{
		selectedDate = $("#calendar").val();
		$("#slctDay").val(selectedDate);
		populateChart();
	});



	$("#btnPrev").click(function()
	{

		selectedDate = new Date($("#calendar").val());
		dd = selectedDate.getDate()-1;
		mm = selectedDate.getMonth()+1;
		yyyy = selectedDate.getFullYear();

		if(dd < 10)
			dd = '0' +dd;

		if(mm < 10)
			mm = '0' +mm;

		selectedDate = yyyy+"-"+mm+"-"+dd;
		$("#calendar").val(selectedDate);
		$("#slctDay").val(selectedDate);
		populateChart();
	});



	$("#btnNext").click(function()
	{
		selectedDate = new Date($("#calendar").val());
		dd = selectedDate.getDate()+1;
		mm = selectedDate.getMonth()+1;
		yyyy = selectedDate.getFullYear();



		if(dd < 10)
			dd = '0' +dd;

		if(mm < 10)
			mm = '0' +mm;

		selectedDate = yyyy+"-"+mm+"-"+dd;

		$("#calendar").val(selectedDate);

		$("#slctDay").val(selectedDate);
		populateChart();
	});

});