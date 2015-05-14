
$(document).ready(function()
{
	var check_flag_mouse = false;
	
	var object_popup = $('#main-content .content-box .content-box-header .content-box-tabs li') ;
	
	object_popup.onDraggable(
	{
		revert: true,
		start: function() {
					
				},
				
		drag: function() {
					
				},
				
		stop: function(e) {
			
					var href = $(this).children('a').attr('href') ;
					var name = $(this).children('a').html();
					var left = e.pageX;
					var top  = e.pageY;
					
					create_popup(top,left,href,name);
					
				}
					
	});
	$('#list_popup .popup').onDraggable(
	{
		handle: ".tab_popup a", 
		revert: false,
		start: function() {
					
				},
				
		drag: function() {
					
				},
				
		stop: function(e) {
					
				}
					
	});
	
	
	$('#list_popup .tab_control_popup a.tab_control_expand').on('click',(function(){
		var object_content = $(this).parent('div').parent('div').children('.conten_popup');
		
		if(!object_content.html())
		{
			object_content.html('<center><img style="width:50px" src="/images/admin/loading.gif" /></center>')
			object_content.slideToggle();
			
			var href = $(this).parent('div').parent('div').children('.tab_popup').children('a').attr('href');
			
			$.ajax({
				url:href,
				cache:false,
//				type:"text",
				success:function(data)
				{
					object_content.html(data);
					object_content.slideDown(500);
				},
				error:function(data)
				{
					
				}
			});
		}
		else
		{
			object_content.slideToggle();
		}
	}));
	
	$('#list_popup .tab_control_popup a.tab_control_close').on('click',(function(){
		$(this).parent('div').parent('div').fadeOut(1000,function(){
			$(this).remove();
		});
	}));
	
});

function create_popup(top,left,href,name)
{
	var check = true;
	var id_popup = 'popup_' + getidpopup();
	var str_popup = 
			'<div class="popup ajax_content" id="'+id_popup+'" style="top:'+top+'px;left:'+left+'px"  >'+
				'<div class="tab_popup" >'+
					'<a onclick="return false;" href="'+href+'"> '+name+' </a>'+
				'</div>'+
				
				'<div class="tab_control_popup" >'+
					'<a class="tab_control_expand" ></a>' +
					'<a class="tab_control_close" ></a>'+
				'</div>'+
				
				'<div class="conten_popup" >' +
				
				'</div>'+
			'</div>';
			
	$('#list_popup .popup').each(function(){
	
		if($(this).children('.tab_popup').children('a').attr('href') == href )
		{
			$(this).animate({
				top:top,
				left:left
			},600);
			check = false;
		}
		
	});
	
	
	
	if(check)
	{
		$('#list_popup').prepend(str_popup);
		$('#'+id_popup).fadeIn(1000);
	}
}

function getidpopup()
{
	var currentTime = new Date();
	var month = currentTime.getMonth() + 1;
	var day = currentTime.getDate();
	var year = currentTime.getFullYear();
	var hours = currentTime.getHours();
	var minutes = currentTime.getMinutes();
	var second	= currentTime.getSeconds();

	return(hours +"_"+ minutes +"_"+ second);
}

(function ($) {
   $.fn.onDraggable = function (opts) {
      this.on("mouseover", function() {
         if (!$(this).data("init")) {
            $(this).data("init", true).draggable(opts);
         }
      });
      return $();
   };
}(jQuery));