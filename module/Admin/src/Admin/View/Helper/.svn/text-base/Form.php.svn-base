<?php
namespace Admin\view\Helper;

use Zend\View\Helper\AbstractHelper;

class Form extends AbstractHelper
{
    protected $_form;
    
    public function form($form = null)
    {
        $this->_form = $form;
        return $this;
    }
    
    public function beginform()
    {
    	$xhtml = '<form id="form" method="post" enctype="multipart/form-data"><div name="content_form" >';    	
    	
    	echo $xhtml;
    }
        
    public function endForm()
    {
    	$xhtml = '</form>';    	
    	
    	echo $xhtml;
    }
    
    public function buttonForm($data)
    {
    	$name = 'Add New';
    	if($data)
    	{
    		$name = 'Update';
    	}
    	
    	$xhtml=
	    	'<div id="form_button_bar" class="detail-infomation-button" >
	    		<input type="submit" id="submitform" class="button" value="'.$name.'" />
	    	</div></div></form>';
    	
    	echo $xhtml;
    }
    
    public function buttonAjaxForm()
    {
    	$xhtml=
    	'<div id="form_button_bar" class="detail-infomation-button" >
    	<input type="button" class="button submit_ajax" value="Save" />
    	</div>';
    	 
    	echo $xhtml;
    }
    
}
?>