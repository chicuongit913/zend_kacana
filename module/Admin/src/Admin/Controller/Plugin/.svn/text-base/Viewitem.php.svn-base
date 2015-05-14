<?php
namespace Admin\Controller\Plugin;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Zend\View\Helper\AbstractHelper;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Viewitem extends AbstractPlugin
{
	public function listitem($_this,$name,$sortkey,$sortvalue)
	{
		
		$name = ucfirst($name);
		$this->_repo = $this->getEntityManager($_this)->getRepository("\Entities\St".$name);
		
		$num_control = $_this->params()->fromRoute("num_control","10");
		$limitPerPage = $_this->params()->fromRoute("limitPerPage","10");
		$offset = $_this->params()->fromRoute('page',1);
	
		$name_list_items = $name.'_items';
		if($sortkey)
			$list_items=array('sortby'=>ucfirst($sortkey).'_'.strtoupper($sortvalue)); // auto sort updated by DESC
		
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
	
	public function detailitem($_this,$name,$autosave)
	{
	
		// GET ID IF ACTION IS EDIT
		$id = $_this->params()->fromRoute('id', 0);
		$name = ucfirst($name);
		$this->_repo = $this->getEntityManager($_this)->getRepository("\Entities\St".$name);
	
		// 		$auth = Zend_Auth::getInstance();
		// 		$user = $auth->getStorage()->read();
		$author =  $this->getEntityManager($_this)->getRepository('Entities\StUser')->find(1);
	
		if($id == 0 )
		{
			if($_this->getRequest()->isPost())
			{
				if($autosave != 'auto_save_off')
				{
					$Object = $this->_repo->saveObject(array('Obj'=>$_this->params()->fromPost(),'created'=>$author,'updated'=>$author));
					echo '1';die;
				}
			}
	
			$viewModel = new ViewModel(array("manager"=>'ADD NEW NEWS'));
			$viewModel->setTerminal(true);
			return $viewModel;
	
		}
		else
		{
			if($_this->getRequest()->isPost())
			{
				if($autosave != 'auto_save_off')
				{
					$post_array = $_this->params()->fromPost();
					$post_array['id'] = $id;
					$Object = $this->_repo->saveObject(array('Obj'=>$post_array,'updated'=>$author));
					echo '1';die;
				}
			}
	
			$data = $this->_repo->find($id);
				
			$viewModel = new ViewModel(array("manager"=>'EDITOR NEWS','data'=>$data));
			$viewModel->setTerminal(true);
			return $viewModel;
		}
	
	
	
	}
	
	protected function getEntityManager($_this)
	{
		$em = $_this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
	
		return $em;
	}
}
?>