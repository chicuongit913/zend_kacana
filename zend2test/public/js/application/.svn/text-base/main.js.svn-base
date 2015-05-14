$(document).ready(function(){
	var fixed = 0;
	var lis = $('ul.menu li');
	
	lis.css('left',screen.width+'px');
	
	if(screen.width == 1280)
	{
		lis.css('width','164px');
		fixed = -86;
	}
	else if(screen.width == 1440)
	{
		lis.css('width','324px');
		fixed = 74;
	}
	else if(screen.width == 1920)
	{
		lis.css('width','804px');
		fixed = 554;
	}
	else if(screen.width == 1024)
	{
		alert('Độ phân giải không đủ để hiển thị website. Có thể xảy ra lỗi !!!!');
	}
	
	$('ul.menu li').hover(
		function(){
			var padding = $(this).css('padding-right'); 
			var padding = parseInt(padding.substr(0,padding.length-2));
			$(this).opacity(70);
		},
		function()
		{
			
			var padding = $(this).css('padding-right'); 
			var padding = parseInt(padding.substr(0,padding.length-2));
			$(this).opacity(100);
		}
	);
	
	$('ul.menu li').click(function(){
		
		var current_li = $(this);
		
		$('div.content div.item').each(function(index, obj){
			
			$(this).hide();
			
			if($(this).hasClass('selected'))
			{
				$(this).removeClass('selected');
				
				if($(this).hasClass('gioithieu'))
				{
					$('ul.menu li.gioithieu').css('padding-right','0');
				}
				else if($(this).hasClass('tintuc'))
				{
					$('ul.menu li.tintuc').css('padding-right','100px');
				}
				else if($(this).hasClass('khoahoc'))
				{
					$('ul.menu li.khoahoc').css('padding-right','50px');
				}
				else if($(this).hasClass('lienhe'))
				{
					$('ul.menu li.lienhe').css('padding-right','70px');
				}
			}
			
		});
		
		var current = $('div.content div.'+current_li.attr('class'));
		
		current.addClass('selected');

		current.tween({
			   left:{
			      start: screen.width,
			      stop: 390 + fixed,
			      time: 0,
			      units: 'px',
			      duration: 0.5,
			      effect:'easeInOut'
			   }
			});
		//----------------
		 var val=0;
		   
		   if(current_li.hasClass('gioithieu'))
		   {
			   val = 0;
		   }
		   else if(current_li.hasClass('tintuc'))
		   {
			   val = 100;
		   }
		   else if(current_li.hasClass('khoahoc'))
		   {
			   val = 50;
		   }
		   else if(current_li.hasClass('lienhe'))
		   {
			   val = 70;
		   }
		   
		     $(current_li).tween({
		    	 paddingRight:{
				      start: val,
				      stop: 130,
				      time: 0,
				      units: 'px',
				      duration: 1,
				      effect:'easeInOut'
				   },
		     }).play();

		//----------------
		
		current.show();
		//current.opacity(90);
		
	});
});