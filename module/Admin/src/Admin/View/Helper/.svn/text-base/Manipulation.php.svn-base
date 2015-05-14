<?php 
 
namespace Admin\view\Helper;

use Zend\View\Helper\AbstractHelper;

class Manipulation extends AbstractHelper
{  
    private $_id;
    private $_image;
    private $_width;
    private $_height;
    private $_module;
    private $_controller;
    
    public function manipulation()
    {
    	$this->_defaultValues();
    
    	return $this;
    }
    
    private function _defaultValues()
    {
    	$this->id(rand());
    	$this->image("/images/default/no-image.png");
    	$this->width(472);
    	$this->height(250); 
    	$this->module("admin");
    	$this->controller("media"); 
    }
           
    public function id($id)
    {
    	$this->id = $id;
    	return $this; 
    }
    
    public function image($image)
    {
    	$this->image = $image;
    	return $this;
    }
    
    public function width($width)
    {
    	$this->width = $width;
    	return $this;
    }
    
    public function height($height)
    {
    	$this->height = $height;
    	return $this;
    }
    
    public function module($module)
    {
    	$this->module = $module;
    	return $this;
    }
    
    public function controller($controller)
    {  
    	$this->controller = $controller;
    	return $this;
    }
    
    public function getImage()
    {
    	if($this->image == "")
    	{
    	    $this->image(    
    	    	$this->view->thumb(getcwd().'/images/default/no-image.png', $this->width, 0, getcwd().'/images/default/thumbs', '/images/default/thumbs')
    	    );
    	}
    	 
    	return $this->image;
    }
    
    public function render() 
    {        
        $html = '';
        
        $html .= '<div id="bloc_'.$this->id.'" class="manipulation_bloc_image" style="width: '.$this->width.'px;" module="'.$this->module.'" controller="'.$this->controller.'">'."\n";

        $html .= '	<div class="mani_container_img" style="width: '.$this->width.'px; height: '.$this->height.'px;">'."\n";
        $html .= '		<div class="mani_drag_img">'."\n";
        $html .= '			<img alt="" src="'.$this->getImage().'" class="required" />'."\n";
        $html .= '		</div>'."\n";
        $html .= '	</div>'."\n";
        
        $html .= '	<div class="mani_ajax_loader" style="width: '.$this->width.'px; height: '.$this->height.'px;"></div>'."\n";
        
        $html .= '  <div class="mani_controls">'."\n";
        
        $html .= '		<span>'."\n";
        $html .= '			<a href="#" class="mani_button mani_change_image icon_menu">Change Media...</a>'."\n";
        $html .= '		</span>'."\n";
        
        $html .= '		<div class="mani_submit_cover">'."\n";
        $html .= '			<ul>'."\n";
        $html .= '				<li><a href="#" class="mani_choose_video icon_menu">Choose from Videos...</a></li>'."\n";
        $html .= '				<li><a href="#" class="mani_choose_photo icon_menu">Choose from Photos...</a></li>'."\n";
        $html .= '				<li><a href="#" class="mani_upload_photo icon_menu">Upload Media...</a></li>'."\n";
        $html .= '				<li><a href="#" class="mani_reposition   icon_menu disable">Reposition...</a></li>'."\n";
        $html .= '			</ul>'."\n";
        $html .= '		</div>'."\n";
        
        $html .= '	</div>'."\n";
                
        $html .= '	<div class="mani_confirm">'."\n";
        $html .= '		<ul>'."\n";
        $html .= '			<li><a href="#" class="mani_button mani_cancel icon_menu">Cancel...</a></li>'."\n";
        $html .= '			<li><a href="#" class="mani_button mani_save_change icon_menu">Save Changes...</a></li>'."\n";
        $html .= '		</ul>'."\n";
        $html .= '	</div>'."\n";
        
        $html .= '	<div class="mani_slider_panel">'."\n";
        $html .= '		<div class="mani_slider"></div>'."\n";   			
        $html .= '	</div>'."\n";
        
        $html .= '</div>'."\n";
                   
        return $html;
    }   
             
}

?>

