<?php
namespace Admin\view\Helper;

use Admin\Form\NewsForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Zend\View\Helper\AbstractHelper;

class Listitem extends AbstractHelper
{
	public function listitem($name,$sortkey,$sortvalue)
	{
		return 'aa';
		$name = ucfirst($name);
			
		$this->_repo = $this->getEntityManager()->getRepository("\Entities\St".$name);
			
		$id = $this->params()->fromRoute('id', 0);
	
		$num_control = $this->params()->fromRoute("num_control","10");
		$limitPerPage = $this->params()->fromRoute("limitPerPage","10");
		$offset = $this->params()->fromRoute('page',1);
	
		$name_list_items = $name.'_items';
		if($sortkey)
			$list_items=array('sortby'=>$sortkey.'_'.$sortvalue); // auto sort updated by DESC
		//		$list_items=array('');
		$sess = new Container('ListForAdmin');
	
		if (isset($sess->$name_list_items))
		{
			$list_items = $sess->$name_list_items;
			if (isset($list_items['limitPerPage']))
				$limitPerPage = $list_items['limitPerPage'];
			if (isset($list_items['offset']))
				$offset = $list_items['offset'];
		}
	
		$result = $this->_repo->searchAllForm($name,$list_items,$offset,$limitPerPage);
		$counts	 = $this->_repo->searchAllForm($name,$list_items);
	
		$paginator_helper = new \Admin\View\Helper\Paginator;
		$paginator_controls = $paginator_helper->paginatorControls($num_control,$counts,$offset,$limitPerPage,'');
	
		$viewModel = new ViewModel(array("listitems"=>$list_items,"paginator"=>$paginator_controls,"object"=>$result));
		$viewModel->setTerminal(true);
		return $viewModel;
	}
}
?>