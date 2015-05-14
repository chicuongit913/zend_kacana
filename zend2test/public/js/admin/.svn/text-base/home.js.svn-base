$(function() {
	
        $( "#checkin" ).datepicker({
            changeMonth: true,
            numberOfMonths: 1,
            minDate:"+0d",
            dateFormat:"dd-mm-yy",
            onSelect: function( selectedDate ) {
                $( "#checkout" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        
        $( "#checkout" ).datepicker({
            defaultDate: "+3d",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat:"dd-mm-yy",
            onSelect: function( selectedDate ) {
                $( "#checkin" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
        
});

$(document).ready(function()
{
	$('#button_search_result').click(function(){
		$('#result_search_booking').html('<center><img src ="/images/dev/ajax-loader.gif"></center>');
		var from 		= $('#checkin').val();
		var to   		= $('#checkout').val();
		
		$.ajax({
			url:"/admin/index/checkroom/from/"+from+"/to/"+to,
			cache:false,
			type:"POST",
			dataType:"text",
			success:function(data)
			{
				$('#result_search_booking').html(data);
			},
			error:function(data)
			{
				
			}
		});
	});
});