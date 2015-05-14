<?php 
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
	Zend\View\Model\ViewModel;



class NewsController extends AbstractActionController
{
	public function indexAction()
	{
		return $this->Viewitem()->listitem($this,'News','updated','DESC');
	}
	
	public function detailAction()
	{
		return $this->Viewitem()->detailitem($this,'News');
	}
}
