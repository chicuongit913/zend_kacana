<?php 
namespace Admin\Form;

use Zend\Form\Form;

class NewsForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('news');
		$this->setAttribute('method','post');
		$this->add(array(
				'name'=>'id',
				'attributes'=>array('type'=>'hidden')				
				));
		$this->add(array(
				'name'=>'title',
				'attributes'=>array('type'=>'text','class'=>'required')
				));
		$this->add(array(
				'name'=>'content',
				'attributes'=>array('type'=>'textarea','class'=>'required')
				));
		$this->add(array(
				'name'=>'created',
				'attributes'=>array('type'=>'hidden')
				));
		
	}
}