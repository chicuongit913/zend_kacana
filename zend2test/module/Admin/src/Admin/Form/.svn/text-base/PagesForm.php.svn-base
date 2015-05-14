<?php
namespace Admin\Form;

use Zend\Form\Form;

class PagesForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('pages');
		$this->setAttribute('method','post');
		
		$this->add(array(
				'name'=>'content',
				'attributes'=>array('type'=>'textarea','class'=>'mceAll')
		));
	}
}
