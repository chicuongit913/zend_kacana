<?php

namespace Admin\view\Helper;

use Zend\View\Helper\AbstractHelper;

class JsonPaginator extends AbstractHelper
{
    
	public function jsonPaginator($link,$data) {

	    $paginator = "";	    
    	////////////////////////////////////////////////////////////////////////////////////////////////
    	/**
    	 * Previous Page
    	 */
	    
	    $paginator .=  "<span class='bg_paging_controls'>Page: ".$data->current_page ." of ". $data->num_page."</span>";
	    
	    if($data->previous)
	    {	    
    		$paginator .= "<a href='' name='1'>&lt;&lt;</a>";
    		$paginator .= "<a href='' name='$data->previous'); return false;\">&lt;</a>";
	    	 
    	}else{    		 	  
    		 $paginator .= "<span class='disable'>&lt;&lt;</span> <span class='disable'>&lt;</span>";    		 	   
    	}
    	////////////////////////////////////////////////////////////////////////////////////////////////
    	/**
    	 * 
    	 */
    	if($data->pages_in_range){
    		foreach ($data->pages_in_range as $page) {
    			if($data->current_page!= $page){
    				
    				$paginator .= "<a class='more_page' name='$page' href=''>$page</a>";
    					 		
    			}else{    					 	    
    				
    			    $paginator .= "<span class='active_current_page'>".$page."</span>";
    			} 
    		}
    	}
    	////////////////////////////////////////////////////////////////////////////////////////////////    	
		/**
		 * Next Page
		 */
    	if($data->next)
    	{    		
    		$paginator .= "<a href='' name ='$data->next'>&gt;</a>";
    		$paginator .= "<a href='' name ='$data->num_page' >&gt;&gt;</a>";
    				  	   
    	}else{
    				  	   
    		$paginator .= "<span class='disable'>&gt;</span> <span class='disable'>&gt;&gt;</span>";    				  	   
    	}

    	/**
    	 * 
    	 */
    	 
    	
    	////////////////////////////////////////////////////////////////////////////////////////////////    
    		
    	$paginator .= "";
    	    	
        return $paginator;
		
	}

}
