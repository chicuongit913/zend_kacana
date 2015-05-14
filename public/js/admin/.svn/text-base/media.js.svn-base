$(document).ready(function()
{
	$("#media_folder").jstree({
			        "json_data" : {
			        	"data" : 
						{ 
							"data" : "Cuong-Media", 
							"state" : "closed",
							"attr" :
							{
								"path" : "./files/public",
								"id" : "0"
							}
						},
			            "ajax" : {
			                "url" : "/admin/tree/index",
			                "data" : function (n) {
			                    return { 
									"id" : n.attr("id")
						        };
			                }
			            }
			        },
			        "search" : {
			        	"case_insensitive" : true,
						"ajax" : {
							"url" : "/admin/tree/search",
							"data" : function (str) {
								return {  
									"search_str" : str 
								}; 
							}
						}
					},
			        "plugins" : [ "themes", "json_data", "ui" ,"crrm","dnd","search","types","contextmenu" ]
    })
    .bind("select_node.jstree", function (event, data) {
	    loadfile(data.rslt.obj.attr('id'));
	})
	
	//create new folder
	.bind("create.jstree", function (e, data) {
		$.post(
			"/admin/tree/createfolder", 
			{ 				
				"parent_id" : parseInt(data.rslt.parent.attr("id")), 
				"name" : data.rslt.name,
			}, 
			function (result) {
				if(result > 0) {
					$(data.rslt.obj).attr("id",result);
				}
				else {
					$.jstree.rollback(data.rlbk);
				}
			}
		);		
	})
	
	//rename folder
	.bind("rename.jstree", function (e, data) {
		$.post(
			"/admin/tree/renamefolder",
			{ 
				"id" : parseInt(data.rslt.obj.attr("id")),
				"name" : data.rslt.new_name,
			}, 
			function (r) {
				if(!r) {
					$.jstree.rollback(data.rlbk);
				}
			}
		);
	})
	
	//remove folder
	.bind("remove.jstree", function (e, data) {
		data.rslt.obj.each(function () {
			$.ajax({
				async : false,
				type: 'POST',
				url: "/admin/tree/removefolder",
				data : { 
					"id" : parseInt(this.id)
				}, 
				success : function (r) {
					if(r <= 0) {
						data.inst.refresh();
					}
				}
			});
		});
	});
	
	// create popup for detail file item 
	
	$('.main_media #media_file .file_item .media_file_thumb_item').live('mouseenter mouseleave', function(event) {
		  if (event.type == 'mouseenter') {
			  
			  $(this).find('div.control_file_item').animate({
				  bottom: 23
				  }, 200, function() {
				  // Animation complete.
				  });
			  
			  
			  } else {
				  $(this).find('div.control_file_item').animate({
					  bottom: 1
					  }, 200, function(){});
				  $(this).parent().find('div.detail_file_item').hide('300');
			  }
	});
	
	$('.main_media #media_file .file_item .media_file_thumb_item .control_file_item .info_control_file').live('click',(function(){
		$(this).parent().parent().parent().find('div.detail_file_item').show('300');
	}));
	
	

/*
 *  Code for the menu buttons
 */
	$(".control_media input").click(function () {
		switch(this.id) {
			case "add_default":
			case "create_folder":
				$("#media_folder").jstree("create", null, "last", { "attr" : { "rel" : this.id.toString().replace("add_", "") } });
				break;
			case "create_folder":
				$("#media_folder").jstree("create", null, "last", { "attr" : { "rel" : this.id.toString().replace("add_", "") } });
				break;
			case "search":
				$("#media_folder").jstree("search", document.getElementById("text").value);
				break;
			case "text": break;
			default:
				$("#media_folder").jstree(this.id);
				break;
		}
	});	
});

function loadfile(id_folder)
{
	
	$('.main_media #media_file').html('<center><img class="loading_file" src="/images/admin/loading.gif"></center>');
	
	$.ajax({
		url:"/admin/tree/loadfile/id/"+id_folder,
		cache:false,
		type:"POST",
		success:function(data)
		{
			if(parseInt(data) == 0 )
				$('.main_media #media_file').html("<div class='media_no_file' >Don't have any file in this folder</div>");
			else
				$('.main_media #media_file').html(data);
		},
		error:function(data)
		{
			
		}
	});
}


