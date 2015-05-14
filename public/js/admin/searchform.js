
	/********************************************************************************
	* TO SEARCH AND FILLTER IN ALL FORM 
	*******************************************************************************/

// define PARAMETER

$(document).ready(function()
{
	
	/********************************************************************************
	EVENT DELETE BUTTON 
	********************************************************************************/
	$('.icon-delete-all-form').on( 'click',function(){
		var object = $(this).parents('div.ajax_content');
		obj = $(this).closest('a.help-for-button');
		object.find('#paging_controls').after('<center id="temp_image" ><img src="/images/dev/ajax-loader.gif"></center>');
		if(obj.data('events')== null)
		{
			obj.click(function(){
				
				obj1 = confirm("Do you want to remove ?");
				if(!obj1)
				{
					return false;
				}
				
				$.ajax({
					url:obj.attr("data-link"),
					cache:false,
					type:"POST",
					success:function(data)
					{
							object.find('#temp_image').remove();
							current_page = object.find('#paging_controls span.active_current_page').html();
							
							if(current_page == null) current_page = 1;
							
							if(object.find('table.table_all_form tbody tr').length > 1)
							{
								searchAll(current_page,object);
							}
							else
							{
								current_page = parseInt(current_page)-1;
								
								searchAll(current_page+'',object);
							}
					},
					error:function(data)
					{
						
					}
				});

				return false;
			});
		}
		
		obj.trigger('click');
		
		return false;
	});
	
	
	/********************************************************************************
	TO CHANGE STATUS ALL FORM
	********************************************************************************/
	
	$('.table_all_form .status-all-form').on('click',(function(){
		
		var object = $(this).children("span");
		var list = object.attr('id');
		list = list.split("_");
		var tmp = $("<img>");
		tmp.attr("src","/images/admin/loader.gif");
		$(this).append(tmp);
		$.ajax({
			url:"/admin/include/changestatus/name/"+list[1]+"/id/"+list[2],
			cache:false,
			type:"POST",
			dataType:"text",
			success:function(data)
			{
				if(data == 1 )
					object.attr('class','status-off');
				else
					object.attr('class','status-on');
				tmp.remove();
			},
			error:function(data)
			{
				
			}
		});
	}));
	
	/********************************************************************************
	TO CHANGE PRIORITY ALL FORM
	********************************************************************************/
	$(".help-for-button[name='enable_priority']").on('click',(function(){
		var id = $(this).attr('id');
		id = id.split("_");
		
		var object_priority = $(this).prev();
		var object_bullet = $(this).children('span.bullet');
		
		if (object_priority.attr('disabled'))
		{
			object_priority.removeAttr('disabled');
			object_bullet.prev().attr('class','icon-button-all-form icon-check-all-form');
			object_bullet.html('OK');
		}
		else
		{
			object_priority.attr('disabled','disabled');
			object_bullet.prev().attr('class','icon-button-all-form icon-edit-all-form');
			object_bullet.html('Edit Priority');
		}
	}));
	
	$('td select[name="priority"]').on('change',(function(){
		var object = $(this);
		var id = $(this).attr('id');
		id = id.split("_");
		var tmp = $("<img>");
		tmp.attr("src","/images/admin/loader.gif");
		object.next('a').hide();	
		object.after(tmp);
		$.ajax({
			url:"/admin/include/changepriority/name/"+id[1]+"/id/"+id[2]+"/priority/"+ object.val(),
			cache:false,
			type:"POST",
			dataType:"text",
			success:function(data)
			{
				tmp.remove();
				object.next('a').show();
				object.attr('disabled',"disabled");
				
				var object_bullet = object.next('a').children('span.bullet');
				
				object_bullet.prev().attr('class','icon-button-all-form icon-edit-all-form');
				object_bullet.html('Edit Priority');
			},
			error:function(data)
			{
				
			}
		});
	}));
	/********************************************************************************
	 REFRESH SEARCH FORM 
	********************************************************************************/
	$('#refresh_search_form').on('click',(function(){
		
		var object = $(this).parents('div.ajax_content');
		
		object.find('.first_column[type="sortby"],.first_column[type="sortbys"],.first_column[type="date"],.first_column[type="dates"]').each(function(){
			$(this).attr('sort','0');
			$(this).children('span').attr('class','');
		});
		
		object.find('.table_all_form thead tr td input').each(function(){
			$(this).val('');
		});
		
		object.find('#status_search').val(3);
		
		object.find('#priority_search').val(0);
		searchAll(0,object);
		
	}));
	/********************************************************************************
	ITEMS BY PAGE 
	********************************************************************************/
	$('#items_page_control select').on('change',(function(){
		var object = $(this).parents('div.ajax_content');
		searchAll(0,object);
	}));
	var call;

	$('.search_form_table').on('keyup',(function(){
		var object = $(this).parents('div.ajax_content');
		clearTimeout(call);
		call= setTimeout(function(){searchAll(0,object);},1000);
	}));
	
	$('.first_column[type="sortby"],.first_column[type="sortbys"],.first_column[type="date"],.first_column[type="dates"]').on('click',(function(){
		
		var key = $(this).attr('sort');
		var object = $(this).parents('div.ajax_content');
		object.find('.first_column[type="sortby"],.first_column[type="sortbys"],.first_column[type="date"],.first_column[type="dates"]').each(function(){
			$(this).attr('sort','0');
			$(this).children('span').attr('class','');
		});
		
		if(key == "ASC" || key == "0" )
		{
			 $(this).attr('sort','DESC');
			 $(this).children('span').attr('class','column_sort_DESC');
		}
		else
		{
			$(this).attr('sort','ASC');
			$(this).children('span').attr('class','column_sort_ASC');
		}
			
		searchAll(0,object);
	}));
	
	$('#priority_search,#status_search').on('change',(function(){
		var object = $(this).parents('div.ajax_content');
		searchAll(0,object);
	}));
	
	$('#paging_controls a').on('click',(function(){
		var object = $(this).parents('div.ajax_content');
		searchAll($(this).attr('name'),object);
		return false;
	}));
	
});

function getItems(main_object)
{
	var object = main_object;
	console.log(object.attr('class'));
//	
	var list_items = new Array();
	
	if(object.find('#status_search').val()==0 || object.find('#status_search').val()==1 )
	{
		list_items['search_status'] =object.find('#status_search').val();
	}

	if(object.find('#priority_search').val()!=0)
	{
		list_items['search_priority'] =object.find('#priority_search').val();
	}
	
	if (object.find('#items_page_control select').val()!=10)
	{
		list_items['limitPerPage'] =object.find('#items_page_control select').val();
	}
	
	object.find('.first_column').each(function(){
		if ($(this).attr('type')=="sortby" || $(this).attr('type')=="sortbys" || $(this).attr('type')=="date"|| $(this).attr('type')=="dates" )
		{
			if ($(this).attr('sort')!='0')
			{
				list_items[$(this).attr('type')] =$(this).attr('id')+'_'+$(this).attr('sort');
			}
		}
		if ($(this).attr('type')=="search" || $(this).attr('type')=="searchs")
		{
			
			var id = 'input_'+$(this).attr('id');
			
			list_items[$(this).attr('type')+'_'+$(this).attr('name')] = object.find('#'+id).val();
			
		}
	});
	var items = new Object();
	for(i in list_items)
    {
		items[i] = list_items[i];
    }
	return items;
}
function searchAll(page,object)
{
//	console.log(object.attr('class'));
	var item;
	item = getItems(object);
	var name = object.find('#status_search').attr("name");
	nameOf = name.split("_");
	var name_entities = nameOf[2];
	PaginatorsearchAll(page,object);
    var postData = { items : item };
	
	
		object.find('#paging_controls').after('<center id="temp_image" ><img src="/images/admin/preloader.gif"></center>');
		object.find('.table_all_form tbody').fadeOut(1000);
		object.find('.table_all_form thead input').each(function(){
			$(this).attr('disabled', 'disabled');
		});
		if(page==0 || page=='0')
		{
			var url_ajax = "/admin/include/searchform/name/"+name_entities;
			
		}
		else
		{
			url_ajax = "/admin/include/searchform/name/"+name_entities+"/page/"+page;
			
		}
			
		$.ajax({
			url:url_ajax,
			cache:false,
			type:'POST',
			data:postData,
			dataType:"json",
			success:function(data)
			{
				var content = parseContentForTable(data, nameOf[2],object);
				object.find('.table_all_form tbody').html(content);
				object.find('.table_all_form tbody').fadeIn(1000);
				object.find('.table_all_form thead input').each(function(){
					$(this).removeAttr('disabled');
				});
				object.find('#temp_image').remove();
			},
			error:function(data)
			{
				
			}
		});
}

function PaginatorsearchAll(page,object)
{
	
	var name = object.find('#status_search').attr("name");
	nameOf = name.split("_");
	var name_entities = nameOf[2];
	var item;
	item = getItems(object);
    var postData = { items : item };
	
	if(page==0 || page=='0')
	{
		var url_ajax = "/admin/include/paginatorsearchform/name/"+name_entities;
	}
	else
		url_ajax = "/admin/include/paginatorsearchform/name/"+name_entities+"/page/"+page;
	$.ajax({
		url:url_ajax,
		cache:false,
		type:'POST',
		data:postData,
		dataType:"text",
		success:function(data)
		{
			object.find('#paging_controls').html(data);
		},
		error:function(data)
		{
			
		}
	});
		
}

function capitaliseFirstLetter(string)
{
	if(string)
	{
		return string[0].toLowerCase() + string.slice(1);
	}
	else 
		return '';
    
}

function parseToArray(data)
{
	var obj = new Array();
	$.each(eval(data), function (key, val) {
        obj[key] = val;
    });
	return obj;
}
function getNameColumn(object){
	var column_list = new Array();
	var i=0;
	object.find('.table_all_form .first_column').each(function(){
		column_list[i] = $(this).attr('id');
		i++;
	});
	return column_list;
}
function parseContentForTable(data,nameEntities,object)
{
	var column_list = getNameColumn(object);
	var i=0;
	var j=0;
	
	var html ='';
	for (i = 0 ; i < data.length ; i++) 
	{
		var obj = parseToArray(data[i]);
		html +='<tr>';
		for (j=0;j<column_list.length - 1;j++)// last column is edit/delete so we must column_list.length - 1
		{// Can IF and create some  Special COLUMNS in here.example : STATUS,PRIORITY,.....
			var column = capitaliseFirstLetter(object.find('#'+column_list[j]).attr('name'));
			
			var type = object.find('#'+column_list[j]).attr('type');
			if(column=='default')
			{
				html +=createColumnDefault(obj,nameEntities);
			}
			else if(type=='promotionallid')
			{
				html +=createColumnPromotionallid(obj,nameEntities);
			}
			else if(type=='tourtypeid')
			{
				html +=createColumnTuortypeid(obj,nameEntities);
			}
			else if(column=='status')
			{
				html +=createColumnStatus(obj,nameEntities);
			}
			else if(column=='ask')
			{
				html +=createColumnAsk(obj,nameEntities);
			}
			else if(column=='priority')
			{
				html +=createColumnPriority(obj,nameEntities);
			}
			else if(column=='home')
			{
				html +=createColumnHome(obj,nameEntities);
			}
			/************************************
			 *  else if ()  some column special *
			 ************************************/
			else
			{
				var list_column = column.split('|');
				var txt=' ';
				if (list_column.length > 1)
				{
					if (type == 'normals' || type == 'sortbys' || type == 'searchs')
					{
						if (obj[capitaliseFirstLetter(list_column[list_column.length-1])])
						{
							obj_temp = parseToArray(obj[capitaliseFirstLetter(list_column[list_column.length-1])]);
							
							for(var i_column=0;i_column<list_column.length-1;i_column++)
							{
								txt += obj_temp[capitaliseFirstLetter(list_column[i_column])] + ' ';
							}
							if (txt.length > 20 )
								html+='<td>'+txt.substr(0,15) + '...</td>';
							else
								html+='<td>'+txt+ '</td>';
						}
						else
							html+='<td>'+' '+ '</td>';
						
					}
					else
					{
						for(var i_column=0;i_column<list_column.length;i_column++)
						{
							txt += obj[capitaliseFirstLetter(list_column[i_column])] + ' ';
						}
						if (txt.length > 20 )
							html+='<td title="'+txt+'" >'+txt.substr(0,15) + '...</td>';
						else
							html+='<td>'+txt+ '</td>';
					}
					
					
				}
				else 
				{
					if ( $('#'+column).attr('type') == 'date' )
					{
						var list_date_time_for_date = obj[column].split(' ');
						if ( $('#'+column).attr('typedate') == 'date' )
						{
							
							html+='<td>'+list_date_time_for_date[0]+ '</td>';
						}
						else if( $('#'+column).attr('typedate') == 'datetime' )
						{
							
							html+='<td>'+list_date_time_for_date[0]+' '+list_date_time_for_date[1]+'</td>';
						}
						
					}
					else
					{
						
						var txt =' '+obj[column];
						if (txt.length > 20 )
							html+='<td title="'+txt+'" >'+(obj[column]).substr(0,15) + '...</td>';
						else
							html+='<td>'+obj[column]+ '</td>';
					}
				}
				
				
			}
		}
		
		html+=createActionEditDelete(obj,nameEntities);
		html+='</tr>';
	}
	return html;
}
function createColumnHome(obj,nameEntities)
{
	var classHome='';
	if (obj['home']==1)
		classHome = 'like';
	else
		classHome = 'unlike';
	
    var html='<td><div class="home-for-button" style="float:left;" ><span class="'+classHome+'" id="home_'+nameEntities+'_'+obj['id']+'" ></span></div></td>';
	return html;
}
function createColumnDefault(obj,nameEntities)
{
	var classDefault='';
	if (obj['default']==1)
		classDefault = 'status-on';
	else
		classDefault = 'status-off';
	
    var html='<td><div class="default-all-form" style="float:left;" ><span class="'+classDefault+'" id="default_'+nameEntities+'_'+obj['id']+'" ></span></div></td>';
	return html;
}
function createColumnStatus(obj,nameEntities)
{
	var classStatus='';
	if (obj['status']==1)
		classStatus = 'status-on';
	else
		classStatus = 'status-off';
	
    var html='<td><div class="status-all-form" style="float:left;" ><span class="'+classStatus+'" id="status_'+nameEntities+'_'+obj['id']+'" ></span></div></td>';
	return html;
}
function createColumnAsk(obj,nameEntities)
{
	var classAsk='';
	if (obj['ask']==1)
		classAsk = 'ask-on';
	else
		classAsk = 'ask-off';
	
    var html='<td><div class="ask-all-form" style="float:left;" ><a href="/admin/user/ask/name/'+nameEntities+'/id/'+obj['id']+'" class="'+classAsk+'" id="ask_'+nameEntities+'_'+obj['id']+'" ></a></div></td>';
	return html;
}
function createColumnPromotionallid(obj,nameEntities)
{
	var name ='';
	if(obj['promotionallid']==0)
		name = '<img src="/images/admin/promotion.png">';
	else
		name = '<img src="/images/admin/promotion_active.png">';
	return '<td style="text-align: center;" >'+name+'</td>';
}
function createColumnTuortypeid(obj,nameEntities)
{
	var name ='';
	if(obj['tourtypeid']==1)
		name = 'Short Tour';
	else if(obj['tourtypeid']==2)
		name = 'Package Tour';
	else if(obj['tourtypeid']==3)
		name = 'Honey Moon';
	
	return '<td>'+name+'</td>';
}
function createColumnPriority(obj,nameEntities)
{
	var html ='<td><select disabled="disabled" name="priority" id="priority_'+nameEntities+'_'+obj['id']+'" >';
	html +='<option value="1"'+checkselected(obj['priority'],'1' )+'> Low </option>';
	html +='<option value="2"'+checkselected(obj['priority'],'2' )+'> Medium </option>';
	html +='<option value="3"'+checkselected(obj['priority'],'3' )+'> High </option>';
	html +='<option value="4"'+checkselected(obj['priority'],'4' )+'> Top </option>';
	html +='</select>';
	html +='<a class="help-for-button" name="enable_priority" id="enable_priority_'+nameEntities+'_'+obj['id']+'" >';
	html +=	'<span id="icon_edit_priority_'+obj['id']+'" class="icon-button-all-form icon-edit-all-form" > Edit Priority</span>';
	html +=	'<span class="bullet" style="width: 60px;" >Edit Priority</span>';
	html +=	'<span class="icon-button-all-form ui-icon-triangle-1-s queue" ></span>';
	html +='</a>';
	html +='</td>';
	return html;
}
function createActionEditDelete(obj,nameEntities)
{
	
	var action = $('#action_edit_delete').attr('name');
	var actions = action.split('_');
	var html ='<td>';
	if (actions[0]!='') // have action Edit 
	{
		html += '<a name="button_edit" class="help-for-button" href="'+actions[0]+'/id/'+obj['id']+'">';
		html +='<span class="icon-button-all-form icon-edit-all-form" > Edit </span><span class="bullet" style="width: 24px;" >Edit</span><span class="icon-button-all-form ui-icon-triangle-1-s queue" ></span></a>';
	}
	if (actions[1]!='') // have action delete 
	{
		html+='<a name="button_delete" class="help-for-button" data-link="'+actions[1]+'/name/'+nameEntities+'/id/'+obj['id']+'">';
		html+='<span class="icon-button-all-form icon-delete-all-form" > Delete </span><span class="bullet" style="width: 34px;" >Delete</span><span class="icon-button-all-form ui-icon-triangle-1-s queue" ></span></a>';
	}
	if (actions[2]!='') // have action Send Mail 
	{
		var classemail='';
		var temp_alert='';
		if (obj['status']==1)
		{
			classemail = 'emailed';
			temp_alert = 'Sent';
		}
			
		else
		{
			classemail = 'email';
			temp_alert = 'Send Email';
			
		}
			
		html+='<a class="help-for-button" name="'+obj['id']+'" data-link="'+actions[2]+'/id/'+obj['id']+'">';
		html+='<span class="icon-button-all-form icon-'+classemail+'-all-form" > Send Email </span><span class="bullet" style="width: 55px;" >'+temp_alert+'</span><span class="icon-button-all-form ui-icon-triangle-1-s queue" ></span></a>';
	}
	html+='</td>';
	return html;
}
function checkselected(i,j)
{
	if (i == j )
		return 'selected="selected"';
	else 
		return '';
}



