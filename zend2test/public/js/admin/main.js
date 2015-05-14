$(function(){
	
	//Sidebar Accordion Menu:
		
		$("#main-nav li ul").hide(); // Hide all sub menus
		$("#main-nav li a.current").parent().find("ul").slideToggle("slow"); // Slide down the current menu item's sub menu
		
		$("#main-nav li a.nav-top-item").click( // When a top menu item is clicked...
			
			function () {
				if(!$(this).hasClass('current'))
				{
					$("#main-nav li a.nav-top-item").each(function(){
						$(this).attr('class', 'nav-top-item');
					});
					
					$("#main-nav li ul li a").each(function(){
					 	$(this).attr('class','');
			 		});
					
					$(this).parent().siblings().find("ul").slideUp("normal"); // Slide up all sub menus except the one clicked
					$(this).next().slideToggle("normal"); // Slide down the clicked sub menu
					$(this).addClass('current');
					
					$(this).next().children('li').eq(0).children('a').addClass('current');
					
					explant_code($(this));
					
					return false;
				}
				else
				 return false;
			}
		);
			
		$("#main-nav li a.no-submenu").click( // When a menu item with no sub menu is clicked...
			function () {
				window.location.href=(this.href); // Just open the link instead of a sub menu
				return false;
			}
		); 

    // Sidebar Accordion Menu Hover Effect:
		
		$("#main-nav li .nav-top-item").hover(
			function () {
				$(this).stop().animate({ paddingRight: "25px" }, 200);
			}, 
			function () {
				$(this).stop().animate({ paddingRight: "15px" });
			}
		);
	
	/********************************************************************************
	TOP NAVIGATION  
	********************************************************************************/
	$(document).ready(function()
	{
		//cache nav
		$("#main_header_navigation ul li ul").each(function() {
		var $picker = $(this);
			$picker.bind('mouseenter',function() {
			    $picker.show();
			}).bind('mouseleave',function() {
			    $picker.hide();
			}).parent().bind('mouseenter',function() {
			    $picker.show();
			}).bind('mouseleave',function() {
			    $picker.hide();
			});
		});
	});
	
	/********************************************************************************
	LANGUAGE INDICATOR 
	********************************************************************************/
	// TODO FIXME: Check the function, does it work normaly ?
	$('.btn_flag').live('click',(function()
	{
		
		//Get the lang
		var str  =  $(this).attr('id').split('_');
		var lang = str[2];

		//Deactivate all the flags
		$("#lang_indicator span").each(function()
		{
			$(this).attr('class','btn_flag');
		});
		
		//Activate the clicked flag		
		$(this).attr('class','btn_flag_active');
		
		
		//Remove the "default" class to the titles, intro and desc		
		$("#titles div[class='zone default'], #intros div[class='zone default'], #descriptions div[class='zone default'] ,#aliases div[class='zone default'] ,#metatags div[class='zone default'] ,#keywords div[class='zone default']").each(function()
		{
			$(this).removeClass('default');
		});
		
		//Add the "default" class to the current language titles, intro and desc
		$("#zone_title_"+ lang + ", #zone_intro_"+ lang + ", #zone_desc_"+ lang + " , #zone_alias_" + lang + " , #zone_metatag_" + lang + " , #zone_keyword_"+ lang).each(function(){
			$(this).addClass('default');
			$(this).show();
		});

		//Hide all the "non default" div for titles, intro and desc 	
		$("#titles div[class='zone'], #intros div[class='zone'], #descriptions div[class='zone'] ,#aliases div[class='zone'] ,#metatags div[class='zone'] ,#keywords div[class='zone']").each(function()
		{			
			$(this).hide();			
		});	
			
		//We don't forget to put class "closed" to the link that expand the blocs (because they all closed when we change language) 	
		$(".multi_language_expand").each(function()
		{			
			$(this).removeClass('opened').addClass('closed');			
		});	
		
	}));	
		
	/********************************************************************************
	EXPAND OR REDUCES MULTI LANGUAGE BLOCS 
	********************************************************************************/
		
	$('.multi_language_expand').live('click',(function()
	{

		//Get the category (titles, intro, desc, etc)
		var str  =  $(this).attr('id').split('_');
		var category = str[2];

		//Check the class of the link (opened or closed)
		if($(this).hasClass('closed'))
		{
			//Switch the opened class to the link	
			$(this).removeClass('closed').addClass('opened');
			
			//Try to display all the titles zones	
			$("#" + category + " div[class='zone']").each(function()
			{
				$(this).show();
			});
			$("#" + category + " div").each(function()
			{
				if($(this).hasClass('zone'))
				{
					if(!$(this).hasClass('default'))
					{
						$(this).show();
					}
				}
				
			});
		}
		else
		{
			//Switch the opened class to the link		
			$(this).removeClass('opened').addClass('closed');
			
			//Try to display all the titles zones	
			$("#" + category + " div").each(function()
			{
				if($(this).hasClass('zone'))
				{
					if(!$(this).hasClass('default'))
					{
						$(this).hide();
					}
				}				
			});
		}
		
	}));
	
	/********************************************************************************
	LEFT NAVIGATION ON ADMIN LAYOUT  
	********************************************************************************/
	// TODO FIXME: Check the function, do we need it ?
	$("span.icon").click(function(){
		if($(this).hasClass("icon-maximum"))
		{
			$("section nav").hide();
			 $("span.icon").removeClass("icon-maximum").addClass("icon-minimum");
			$("section").css("background-image","none");
			$("div.content").animate({
				"margin-left":0
			},250);
			$("span.icon").animate({
				"left":0
			},250);
		}else if($(this).hasClass("icon-minimum"))
		{
			$("div.content").animate({
				"margin-left":151
			},250);
			$("span.icon").removeClass("icon-minimum").addClass("icon-maximum");
			$("span.icon").animate({
				"left":192
			},250);
			$("section").attr("style","");
			$("section nav").show(250);
		}
	});
	
	/********************************************************************************
	EXPAND THE BLOC IN FORM  
	********************************************************************************/
	
	$(".bloc_title").live('click',(function()
	{
		
		if ($(this).attr('class') == "bloc_title expand_open")
		{
			$(this).attr('class','bloc_title expand_close');			
			$(this).next('div').hide("200");
		}
		else
		{
			$(this).attr('class','bloc_title expand_open');			
			$(this).next('div').show("200");
		}		
		
	}));
	
	
	
	
	
	/********************************************************************************
	POPUP PEOPLES APLLY FOR CAREERS 
	********************************************************************************/
//	
//	$('.table_all_form a[name="career_popup"]').colorbox(
//	{
//		width:800,
//		height:500,
//		inline:false
//	});
	
	$('.table_all_form .ask-all-form a').live('click',function(){
		opencolorbox($(this));
		return false;
	});
	
	$('#updatecurrency').click(function(){
		$.ajax({
			url:"/admin/parameter/changecurrency",
			cache:false,
			type:"POST",
			success:function(data)
			{
				searchAll(0);
			},
			error:function(data)
			{
				
			}
		});
	});
	
	/********************************************************************************
	TO VALIDATE THE ENTIRE FORM
	********************************************************************************/

});

function opencolorbox(obj)
{
	obj.colorbox(
	{
		width:800,
		height:500,
		inline:false 
	
	});
}

function explant_code(object)
{
	$('#main-content h2[name="text_management"]').html('Management '+ object.html());
	
	var str_tab_content = '';
	var i = 0;
	object.next().children('li').each(function(){
		if(i==0)
		{
			str_tab_content += '<li><a class="default-tab current" href="'+$(this).children('a').attr('href')+'">'+$(this).children('a').html()+'</a></li>';
			$('#main-content .content-box .content-box-header h3').html($(this).children('a').html());
			reloadpage($(this).children('a').attr('href'));
		}
		else
			str_tab_content += '<li><a class="default-tab" href="'+$(this).children('a').attr('href')+'">'+$(this).children('a').html()+'</a></li>';
		i++;
	});
	
	$('#main-content .content-box .content-box-header .content-box-tabs').html(str_tab_content);
	
}

function reloadpage(href)
{
	var width = parseInt($('#main-content .content-box .content-box-content').css('width').replace('px','')) + 40;
	var width_temp = width;
	
	
	$('#main-content .content-box .content-box-content div[name="layout_content"]').slideUp(1000);
	
	$('#main-content .content-box .content-box-content .cut_paper').slideToggle(1000);
	$.ajax({
			url:href,
			cache:false,
			type:"text",
			success:function(data)
			{
				$('#main-content .content-box .content-box-content .cut_paper').slideUp(1000);
				$('#main-content .content-box .content-box-content div[name="layout_content"]').html(data);
				$('#main-content .content-box .content-box-content div[name="layout_content"]').slideToggle('slow');
			},
			error:function(data)
			{
				
			}
		});

}


$(document).ready(function()
{
	$("#main-nav li ul li").click(function(){
		if(!$(this).children('a').hasClass('current'))
		{
			var href = $(this).children('a').attr('href');
			
			un_current_tab_select(href);
			
			$('#main-content .content-box .content-box-header h3').html($(this).children('a').html());
			 
			reloadpage(href);
			
			return false;
		}
		else
			return false;
		
	});
	
	$('#main-content .content-box .content-box-header .content-box-tabs li').live('click',(function(){
		if(!$(this).children('a').hasClass('current'))
		{
		 	var href = $(this).children('a').attr('href');
		 	
		 	un_current_tab_select(href);
		 	
			$('#main-content .content-box .content-box-header h3').html($(this).children('a').html()); 	
			
			 reloadpage(href);
			
			return false;
		}
		else
			return false;
		
		
	}));
	
	$('.table_all_form tbody tr td a.help-for-button[name="button_edit"]').live('click',(function(){
		var href=$(this).attr('href');
		reloadpage(href);
		
		check = un_current_tab_select(href);
		var no_item = $(this).parent('td').parent('tr').children('td').eq(0).html();
		$('#main-content .content-box .content-box-header h3').html('Edit item '+no_item);
		if(!check)
		{
			var str ='<li name="edit" ><a class="default-tab current" href="'+href+'">Edit item '+no_item+' </a></li>';
			$('#main-content .content-box .content-box-header .content-box-tabs').append(str);
		}
		return false;
	}));
	
	$('#form_button_bar .button').live('click',(function(){
		var object = $(this).parents('div.ajax_content');
		object.find('#form_button_bar').append('<img src="/images/admin/loading.gif">')
		
		object.find('#form textarea').each(function(){
		
			$(this).val(tinyMCE.get($(this).attr('id')).getContent());
			
		});
		
		if(object.find("#image .mani_container_img img").attr("alt") == '')
		{
			object.find("#imagesrc").val($("#image .mani_container_img img").attr("src"));	
		}
		else
		{			
			object.find("#imagesrc").val($("#image .mani_container_img img").attr("alt"));			
		}
		
		if(object.find("#icon_image .mani_container_img img").attr("alt") == '')
		{
			object.find("#icon_imagesrc").val($("#icon_image .mani_container_img img").attr("src"));	
		}
		else
		{			
			object.find("#icon_imagesrc").val($("#icon_image .mani_container_img img").attr("alt"));			
		}
		
		var href = $('#main-content .content-box .content-box-header .content-box-tabs li a.current').attr('href');
		
		$.post(href,object.find('#form').serializeArray(),function(){
	    		
	    		
	    	}).success(function(data){
	    		
	    		var str_time = getcurrenttime(); 
	    		
	    		if(data=="ok")
	    		{
	    			
	    			$("html, body").animate({ scrollTop: 0 }, 600);
	    			var str_alert = created_alert('success',$('#form_button_bar .button').val()+' Success .... !'+str_time)
	    			$('#main-content .content-box .content-box-content div[name="layout_content"]').prepend(str_alert);
	    		}
	    		else
	    		{
	    			$("html, body").animate({ scrollTop: 0 }, 600);
	    			var str_alert = created_alert('error',$('#form_button_bar .button').val()+' ERROR .... !'+str_time);
	    			$('#main-content .content-box .content-box-content div[name="layout_content"]').prepend(str_alert);
	    		}
	    		object.find('#form_button_bar img').remove();
	    		
	    	});
        
        return false; 
	}));
	
	$(".close").live('click',(
		function () {
			$(this).parent().fadeTo(400, 0, function () { // Links with the class "close" will close parent
				$(this).slideUp(400);
			});
			return false;
		}
	));
	
});

function un_current_tab_select(href)
{
	var check = 0;
	$('#main-content .content-box .content-box-header .content-box-tabs li').each(function(){
		
			if(href && $(this).children('a').attr('href') == href )
			{
					$(this).children('a').addClass('current');
					check = 1;
			}
			else
			{
				$(this).children('a').attr('class','default-tab');
			}
	});
	
	$("#main-nav li ul li a").each(function(){
	 	if(href && $(this).attr('href') == href )
		{
			$(this).addClass('current');
			check = 1;
		}
		else
		{
			$(this).attr('class','');
		}
	 });
	 return check;
}
function created_alert(type,string)
{
	var type = (type)?type:'success';
	
	var str = 
	'<div class="notification '+type+'">' +
		'<a class="close" href="#">'+
			'<img alt="close" title="Close this notification" src="/images/admin/cross_grey_small.png">'+
		'</a>'+
		'<div>'+string+'</div>'+
	'</div>';
	
	return str;
}

function getcurrenttime()
{
	var currentTime = new Date();
	var month = currentTime.getMonth() + 1;
	var day = currentTime.getDate();
	var year = currentTime.getFullYear();
	var hours = currentTime.getHours();
	var minutes = currentTime.getMinutes();
	var second	= currentTime.getSeconds();

	return(" ( "+ hours +":"+ minutes +":"+ second +" -- "+ day + "/" + month + "/" + year+" ) ");
}




