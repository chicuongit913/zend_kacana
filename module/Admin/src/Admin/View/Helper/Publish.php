<?php
/**
 *
 * @author Jean-Baptiste
 * @version 
 */

namespace Admin\view\Helper;

use Zend\View\Helper\AbstractHelper;

class Publish extends AbstractHelper
{
    private $_created; 
    private $_updated;  
    private $_priority;  
    private $_status;
    
    private $_data;
        
    public function publish($data = 0)
    {
        $this->_data = $data;
        return $this;
    }
    
    public function created($time = 'on',$by = 'on') 
    {
    	if($this->_data)
    	{
    		$this->_created = 	
    			'<span class="created">'.
    				(($time=='off')?'':('<span class="createdtime" >'.gmdate( "d/m/y - H:i:s", $this->_data->getCreated()).'</span>')).
    				(($by=='off')?'':(' <span class="createdby" >'.$this->_data->getCreatedby()->getDisplayname().'</span>')).
    			 '</span>';
    	}
    	else
    	{
    		$this->_created = '';
    	}
    		return $this;
    }
    
    public function updated($time = 'on',$by = 'on') 
    {
    	if($this->_data)
    	{
    		$this->_updated =
    		'<span class="updated">'.
    			(($time=='off')?'':('<span class="updatedtime" >'.gmdate( "d/m/y - H:i:s", $this->_data->getUpdated()).'</span>')).
    			(($by=='off')?'':(' <span class="updatedby" >'.$this->_data->getUpdatedby()->getDisplayname().'</span>')).
    		'</span>';
    	}
    	else
    	{
    		$this->_updated = '';
    	}
    	return $this;
    }
              
    public function priority() 
    {
    	$priority_value = 1;
    	if($this->_data)
    	{
    		$priority_value = $this->_data->getPriority();
    	}
    	
    	$this->_priority = '<span class="priority">
    	
    		<select class="priorityselect" id="priority" name="priority">
	    		<option '.$this->check_priority($priority_value,1).' label="Low" value="1">Low</option>
	    		<option '.$this->check_priority($priority_value,2).' label="Medium" value="2">Medium</option>
	    		<option '.$this->check_priority($priority_value,3).' label="High" value="3">High</option>
	    		<option '.$this->check_priority($priority_value,4).' label="Top" value="4">Top</option>
	    	</select>
    	
    	</span>';
 
    	return $this;
    }

    function check_priority($check , $value)
    {
    	return ($check == $value)?'selected="selected"':'';
    }
    
    public function status() 
    {
    	$status_value = 0;
    	if($this->_data)
    	{
    		$status_value = $this->_data->getStatus();
    	}
    	$this->_status = '<span class="status">
				    			<div class="status-all-form" style="display: inline-block;">
				    				<span class="status-off"></span>
				    			</div>
    							<div style="display:none;" ><input id="status" type="text" value="'.$status_value.'" name="status"></div>
    					</span>';
    	
    	$this->_status .= '<script type="text/javascript">
    		$("#bloc_publish .status .status-all-form").click(function()
    		{
	    		if($("#bloc_publish .status .status-all-form span").attr("class")=="status-off")
	    		{
	    			$("#bloc_publish .status .status-all-form span").attr("class","status-on");
	    			$("#bloc_publish .status #status").val("1");
	    	
		    	}else
		    	{
		    		$("#bloc_publish .status .status-all-form span").attr("class","status-off");
		    		$("#bloc_publish .status #status").val("0");
		    	}
	    	});
	    	
	    	if($("#bloc_publish .status  #status").val()=="1")
	    	{
	    		
	    		$("#bloc_publish .status .status-all-form span").attr("class","status-on");
	    	}
    	
    		</script>';
    	return $this;
    }

    /********************************************************************************
     DISPLAY FUNCTIONS
    *********************************************************************************/
   
    public function toString() 
    {       
	   $html = '<div id="bloc_publish">
	       			'.$this->_created.
	       			  $this->_updated.
	       			  $this->_priority.
	       			  $this->_status.'   				
	    		</div>   
	   			</div>';
	          
       echo $html;
    }
    
}
