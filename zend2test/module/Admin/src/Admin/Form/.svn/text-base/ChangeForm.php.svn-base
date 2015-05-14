<?php
namespace Admin\Form;

use Zend\Form\Form;

class ChangeForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('changepassword');
		$this->setAttribute('method','post');
		
		$this->add(array(
				'name'=>'current',
				'attributes'=>array('type'=>'password','class'=>'required')
		));
		$this->add(array(
				'name'=>'new',
				'attributes'=>array('type'=>'password','class'=>'required','id'=>'new')
		));
		$this->add(array(
				'name'=>'confirm',
				'attributes'=>array('type'=>'password','class'=>'required','id'=>'confirm')
		));
		
	}
}