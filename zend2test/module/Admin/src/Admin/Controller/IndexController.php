<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Admin\Form\LoginForm;
use Admin\Form\ChangeForm;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
    //	check login
    	$sessionContainer = new \Zend\Session\Container('login');
    	if(!$sessionContainer->offsetExists('user'))
    	{
    		$this->redirect()->toRoute('index',array('action'=>'auth'));
    	}
    	
    }
    
    public function authAction()
    {
    	
    	$this->getViewHelper('HeadLink')->appendStylesheet('/public/css/admin/auth.css');
    	$message = '';
    	$request = $this->getRequest();
    	
    	if($request->isPost())
    	{
    		$em = $this->getEntityManager();
    		
    		//Check times you log in
    			$logging = $em->getRepository('\Entities\Log')->findOneBy(array('action'=>'login'));
    			$allow = true;
    			
//     			if($logging->getTimes() == 3)
//     			{
//     				$minute = time() - $logging->getUpdated();
//     				if($minute <=  900)
//     				{
//     					$message = 'Xin chờ '.date('i',900-$minute).' phút tiếp tục đăng nhập';
//     				}
//     				else 
//     				{
//     					$allow = true;
//     					$logging->setTimes(0);
//     					$em->flush();
//     				}
//     			}
//     			else
//     			{
//     				$allow = true;
//     			}
    		//--------------
    		
    		$data = $request->getPost();
    		
    		$user = $em->getRepository('\Entities\Manager')->findOneBy(array('username'=>$data->get('username'),'password'=>$data->get('password')));
    		if($allow)
    		{
    			
	    		if($user != null)
	    		{
	    			$sessionContainer = new \Zend\Session\Container('login');
	    			$sessionContainer->user = $data->get('username');
	    			
	    			return $this->redirect()->toRoute('index');
	    		}
	    		else
	    		{
	    			$logging = $em->getRepository('\Entities\Log')->findOneBy(array('action'=>'login'));
	    			
	    			$logging->setUpdated(time());
	    			$logging->setTimes($logging->getTimes()+1);
	    			
	    			$em->flush();
	    			
	    		}
    		}
    	}
    	
    	$form = new LoginForm();
    	
    	return array('form'=>$form, 'message'=>$message);
    }
    public function logoutAction()
    {
    	$sessionContainer = new \Zend\Session\Container('login');
    	$sessionContainer->offsetUnset('user');
    	return $this->redirect()->toRoute('index');
    }
    public function changePasswordAction()
    {
    	$this->getViewHelper('HeadLink')->appendStylesheet('/public/css/admin/auth.css');
    	$this->getViewHelper('HeadScript')->appendFile('/public/js/jquery.validate.js');
    	$this->getViewHelper('HeadScript')->appendFile('/public/js/admin/change_pass.js');
    	
    	//check login
    	$sessionContainer = new \Zend\Session\Container('login');
    	if(!$sessionContainer->offsetExists('user'))
    	{
    		$this->redirect()->toRoute('index',array('action'=>'auth'));
    	}
    	//-------
    	
    	
    	$request = $this->getRequest();
    	if($request->isPost())
    	{
    		$data = $request->getPost();
    		$em = $this->getEntityManager();
    		$user = $em->getRepository('\Entities\Manager')->findOneBy(array('password'=>$data->get('current')));
    		
    		if($user != null)
    		{
    			$user->setPassword($data->get('new'));
    			$em->flush();
    			return $this->redirect()->toRoute('index');
    		}
    	}
    	
    	$form = new ChangeForm();
    	
    	return array('form'=>$form);
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