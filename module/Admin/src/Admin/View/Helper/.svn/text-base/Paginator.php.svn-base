<?php

namespace Admin\view\Helper;

use Zend\View\Helper\AbstractHelper;

class Paginator extends AbstractHelper
{
    
    public $next;
    public $previous;
    public $pages_in_range;
    public $num_page;
    public $counts;
    public $current_page;
    public $type;
    
    public $pluginLoader;
    /**
     * Constructor: initialize plugin loader
     *
     * @return void
     */
    
	public function paginator($data) 
	{
		$paginator = "<div id='paging_controls' >";
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
		
		$paginator .= "</div></div>";
		
		return $paginator;
	}
    
    public function __construct ()
    {
//    	$this->pluginLoader = new Zend_Loader_PluginLoader();
    }
    /**
     * 
     * @param  $property
     * @param  $value
     */
    function __set($property, $value)    
    {    
    	$this->$property = $value;    
    }
	/**
	 * 
	 * @param  $property
	 */
    function __get($property)   
    {    
    	if (isset($this->$property))    
    	{    
    		return $this->$property;    
    	}
    }
    /**
     * 
     * @param  $num_control
     * @param  $counts
     * @param  $offset
     * @param  $limit
     * @param  $type
     */
    public function paginatorControls($num_control,$counts,$offset,$limit,$type='')
    {
        $this->current_page = $offset;
        $this->counts = count($counts);
        $this->type = $type;
        $this->num_page = ceil($this->counts/$limit);
        
        if($this->num_page< $num_control)
        {
        	$num_control = $this->num_page;
        }
        
        /**
         * Next Page
         */
        if($offset < $this->num_page)
        {
        	$this->next = $offset + 1;
        }
        /**
         * Previous Page
         */
        if($offset>0)
        {
        	$this->previous = $offset - 1;        	
        }
        
        /**
         *  Pages In Ranges
         */
        if($offset <= ceil($num_control/2))
        {
        	$this->pages_in_range = range( 1 , $num_control ,1 );        	 
        }
        if(($offset > ceil($num_control/2)) && ($offset+5 <= $this->num_page))
        {
        	$this->pages_in_range = range($offset - ceil($num_control/2) + 1 , $offset + 5 ,1 );        	
        }
        if($offset + 5 > $this->num_page)
        {
        	$this->pages_in_range = range($this->num_page - $num_control + 1 , $this->num_page ,1 );        	
        }
        
        return $this;
    }

}

?>