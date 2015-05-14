
$(document).ready(function()
{
	
	$('#main_control .button_main_control').live('click',(function(){
		
		var name_control = $(this).attr('name');
		
		if(name_control == 'media')
		{
			
		}
		
		if(name_control == 'message')
		{
			alert('comming soon');
		}
		
		if(name_control == 'layout')
		{
			if($(this).children('.control_on_off').attr('data-status')=="on")
			{
				$(this).children('.control_on_off').attr('data-status','off');
				$(this).children('.control_on_off').animate({
					'background-position': -54
				}, 500, function() {
					$('#main-content').fadeOut(500);
					$('#footer').fadeOut(500);
				});
			}
			else
			{
				$(this).children('.control_on_off').attr('data-status','on');
				$(this).children('.control_on_off').animate({
					'background-position': 0
				}, 500, function() {
					$('#main-content').fadeIn(500);
					$('#footer').fadeIn(500);
				});
			}
		}
		
		if(name_control == 'menu')
		{
			if($(this).children('.control_on_off').attr('data-status')=="on")
			{
				$(this).children('.control_on_off').attr('data-status','off');
				$(this).children('.control_on_off').animate({
					'background-position': -54
				}, 500, function() {
					$('#body-wrapper').fadeOut(500);
				});
			}
			else
			{
				$(this).children('.control_on_off').attr('data-status','on');
				$(this).children('.control_on_off').animate({
					'background-position': 0
				}, 500, function() {
					$('#body-wrapper').fadeIn(500);
				});
			}
		}
		
		if(name_control == 'popup')
		{
			if($(this).children('.control_on_off').attr('data-status')=="on")
			{
				$(this).children('.control_on_off').attr('data-status','off');
				$(this).children('.control_on_off').animate({
					'background-position': -54
				}, 500, function() {
					$('#list_popup').fadeOut(500);
				});
			}
			else
			{
				$(this).children('.control_on_off').attr('data-status','on');
				$(this).children('.control_on_off').animate({
					'background-position': 0
				}, 500, function() {
					$('#list_popup').fadeIn(500);
				});
			}
		}
		
	}));
	
});
	