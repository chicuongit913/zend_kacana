<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Doctrine\ORM\EntityManager;
use Admin\Form\LoginForm;
use Admin\Form\ChangeForm;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
//    	$sessionContainer = new Container('login');

    	$name = 'Param';
    	
    	$this->_repo = $this->getEntityManager()->getRepository("\Entities\St".$name);
    	
    	$id = $this->params()->fromRoute('id', 0);
    	$layout = $this->params()->fromRoute('layout', 0);
    	
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
    		if (isset($list_items['offset']))
    			$offset = $list_items['offset'];
    	}
    		
    	$result = $this->_repo->searchAllForm($name,$list_items,$offset,$limitPerPage);
    	$counts	 = $this->_repo->searchAllForm($name,$list_items);
    	$paginator_helper = new \Admin\View\Helper\Paginator;
    	
    	$paginator_controls = $paginator_helper->paginatorControls($num_control,$counts,$offset,$limitPerPage,'');
    	
	   	if($layout === 'disable')
	   	{
	   		$viewModel = new ViewModel(array("listitems"=>$list_items,"paginator"=>$paginator_controls,"object"=>$result));
	   		$viewModel->setTerminal(true);
	   		return $viewModel;
	   	}
    	 else
    	 {
    	 	return array("listitems"=>$list_items,"paginator"=>$paginator_controls,"object"=>$result);
    	 }
    }
    
    public function detailAction()
    {
    	// GET ID IF ACTION IS EDIT
    	$id = $this->params()->fromRoute('id', 0);
    	$name = 'Param';
    	$this->_repo = $this->getEntityManager()->getRepository("\Entities\St".$name);
    	
    	// 		$auth = Zend_Auth::getInstance();
    	// 		$user = $auth->getStorage()->read();
    	$author =  $this->getEntityManager()->getRepository('Entities\StUser')->find(1);
    	
    	if($id == 0 )
    	{
    		if($this->getRequest()->isPost())
    		{
    			$Object = $this->_repo->saveObject(array('Obj'=>$this->params()->fromPost()));
    			echo '1';die;
    		}
    	
    		$viewModel = new ViewModel(array("manager"=>'ADD NEW PARAM'));
    		$viewModel->setTerminal(true);
    		return $viewModel;
    	
    	}
    	else
    	{
    		if($this->getRequest()->isPost())
    		{
    			$post_array = $this->params()->fromPost();
    			$post_array['id'] = $id;
    			$Object = $this->_repo->saveObject(array('Obj'=>$post_array));
    			echo '1';die;
    		}
    	
    		$data = $this->_repo->find($id);
    			
    		$viewModel = new ViewModel(array("manager"=>'EDITOR PARAM','data'=>$data));
    		$viewModel->setTerminal(true);
    		return $viewModel;
    	}
    	
    }
    
    public function authAction()
    {
    	$em = $this->getEntityManager();
    	
    	$sessionAdmin = new Container('param');
    	$param = $em->getRepository('\Entities\StParam')->find(13);
    	$prefix = $sessionAdmin->prefix = $param->getValue();
    	
    	$this->getViewHelper('HeadLink')->appendStylesheet('/public/css/admin/auth.css');
    	$message = '';
    	$request = $this->getRequest();
    	
    	if($request->isPost())
    	{
    		$data = $request->getPost();
    		$user = $em->getRepository($prefix.'User')->findOneBy(array('username'=>$data->get('username'),'pass'=>md5($data->get('password'))));
    		
    		if($user != null)
    		{
    			
    			$param = $em->getRepository($prefix.'Param')->find(5);
    			$sessionAdmin->language = explode(",",$param->getValue());
    			
    			$sessionContainer = new Container('login');
    			$sessionContainer->userName = $user->getDisplayname();
    			$sessionContainer->level = $user->getLevel();
                $sessionContainer->user = $user;
    			
    			return $this->redirect()->toUrl('/admin/index');
    		}
    		else
    		{
    			
    			$viewModel = new ViewModel(array('error'=>"Not correct User OR Password </br>UserName: admin - Pass: admin"));
    			$viewModel->setTerminal(true);
    			return $viewModel;
    		}
    	}
    
    	$viewModel = new ViewModel(array('error'=>"UserName: admin - Pass: admin"));
    	$viewModel->setTerminal(true);
    	return $viewModel;
    }
    public function logoutAction()
    {
    	$sessionContainer = new Container('login');
    	$sessionContainer->offsetUnset('user');
    	return $this->redirect()->toUrl('/admin/index');
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