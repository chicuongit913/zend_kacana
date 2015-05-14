<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Doctrine\ORM\EntityManager;
use Admin\Form\LoginForm;
use Admin\Form\ChangeForm;

class UserController extends AbstractActionController
{
	public function indexAction()
	{
		$sessionContainer = new \Zend\Session\Container('login');
        if(!$sessionContainer->offsetExists('user'))
        {
        	$this->redirect()->toUrl('/admin/index/auth');
        }
        
    	$name = 'User';
    	 
    	$this->_repo = $this->getEntityManager()->getRepository("\Entities\St".$name);
    	 
    	$id = $this->params()->fromRoute('id', 0);
    
    	$num_control = $this->params()->fromRoute("num_control","10");
    	$limitPerPage = $this->params()->fromRoute("limitPerPage","10");
    	$offset = $this->params()->fromRoute('page',1);
    
    	$name_list_items = $name.'_items';
    	//     	$list_items=array('date'=>'updated_DESC');
    	$list_items=array('');
    	$sess = new Container('ListForAdmin');
    	 
    	if (isset($sess->$name_list_items))
    	{
    		$list_items = $sess->$name_list_items;
    		if (isset($list_items['limitPerPage']))
    			$limitPerPage = $list_items['limitPerPage'];
    	}
    
    	$result = $this->_repo->searchAllForm($name,$list_items,$offset,$limitPerPage);
    	$counts	 = $this->_repo->searchAllForm($name,$list_items);
    	//    	print_r($result);
    	 
    	 
    	$paginator_helper = new \Admin\View\Helper\Paginator;
    	 
    	$paginator_controls = $paginator_helper->paginatorControls($num_control,$counts,$offset,$limitPerPage,'');
    	 $viewModel = new ViewModel(array("listitems"=>$list_items,"paginator"=>$paginator_controls,"object"=>$result));
    	 $viewModel->setTerminal(true);
    	 return $viewModel;
	}
	
	public function detailAction()
	{
	    $sessionContainer = new \Zend\Session\Container('login');
	    if(!$sessionContainer->offsetExists('user'))
	    {
	    	$this->redirect()->toUrl('/admin/index/auth');
	    }
	    
	    // GET ID IF ACTION IS EDIT
	    $id = $this->params()->fromRoute('id', 0);
	    $name = 'User';
	    $this->_repo = $this->getEntityManager()->getRepository("\Entities\St".$name);
	    
	    if($id == 0 )
	    {
	    	if($this->getRequest()->isPost())
	    	{
	    	    $post_array = $this->params()->fromPost();
	    	    $post_array['pass'] = md5($post_array['pass']); 
	    	    
	    		$Object = $this->_repo->saveObject(array('Obj'=>$post_array));
	    		
	    		echo '1';die;
	    	}
	    
	    	$viewModel = new ViewModel(array("manager"=>'ADD NEW USER'));
	    	$viewModel->setTerminal(true);
	    	return $viewModel;
	    
	    }
	    else
	    {
	        $sess = new Container('ListForAdmin');
	        
	    	if($this->getRequest()->isPost())
	    	{
	    		$post_array = $this->params()->fromPost();
	    		$post_array['id'] = $id;
	    		
	    		if($post_array['pass'] != $sess->old_pass )
	    		{
	    			$post_array['pass'] = md5($post_array['pass']);
	    		}
	    		
	    		$Object = $this->_repo->saveObject(array('Obj'=>$post_array));
	    		echo '1';die;
	    	}
	    
	    	$data = $this->_repo->find($id);
	    	
	    	$sess->old_pass = $data->getPass();
	    	
	    	$viewModel = new ViewModel(array("manager"=>'VIEW USER OF '.$data->getDisplayname(),'data'=>$data));
	    	$viewModel->setTerminal(true);
	    	return $viewModel;
	    }
	}
	
	protected function getViewHelper($helperName)
	{
		return $this->getServiceLocator()->get('viewhelpermanager')->get($helperName);
	}
	protected function getEntityManager()
	{
		$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
	
		return $em;
	}
	
}
?>