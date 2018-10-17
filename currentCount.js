$(document).ready(function()
{
	venueID = $("#slctVenue").val();;
    
    newColor = '#379683'
	getTodaysCount();
    
    originalCount = -1;

	$("#slctVenue").change(function()
	{
		venueID = $("#slctVenue").val();
		getTodaysCount();
	});

    //get count every second
	function getTodaysCount()
	{
		$.ajax(
		{
			url: "http://headcountlive.com/getCount.php?venueID="+venueID,
			method: "GET",
			dataType: "json",
			success: function(data) 
			{
                //change colour when count changes
                if(data.count > originalCount && originalCount != -1) 
                {
                    newColor = '#FF0000'
                }
                if(data.count < originalCount && originalCount != -1) 
                {
                    newColor = '#00FF00'
                }
                //$('#countPod').css('background-color', newColor);
                $('#countPod').css('background-color', '#6E3667');
				$('#todaysCount').html(data.count);//.css('color', newColor); //.addClass('text-red');
				$('#myVenue').html(data.venueName);//.css('color', newColor); //.addClass('text-green');
				setTimeout(function(){
					getTodaysCount();
				}, 1000);
                
                originalCount = data.count;
                
                newColor = '#379683'
			},
			error: function(data) 
			{
				console.log("Not Today");
			}
		});
	}
    
    
	$.ajax(
	{
		url: "http://headcountlive.com/updatePageViews.php",
		method: "GET",
		dataType: "json",
		success: function(data) 
		{
			$('#pageViews').append(data.totalViews);
		},
		error: function(data) 
		{
			console.log("Error");
		}
	});
});