<?php 
namespace Admin\Controller;
use Admin\Form\PagesForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class PageController extends AbstractActionController
{
	public function indexAction()
	{
		return $this->Viewitem()->listitem($this,'Page','updated','DESC');
	}
	
	public function detailAction()
	{
		return $this->Viewitem()->detailitem($this,'Page');
	}
	
}