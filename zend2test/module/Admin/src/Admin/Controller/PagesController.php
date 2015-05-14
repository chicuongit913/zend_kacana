<?php 
namespace Admin\Controller;
use Admin\Form\PagesForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class PagesController extends AbstractActionController
{
	public function indexAction()
	{
		
		//check login
		$sessionContainer = new \Zend\Session\Container('login');
		if(!$sessionContainer->offsetExists('user'))
		{
			$this->redirect()->toRoute('index',array('action'=>'auth'));
		}
		//-------
		
		$this->getViewHelper('HeadLink')->appendStylesheet('/public/css/admin/pages.css');
		$this->getViewHelper('HeadScript')->appendFile('/public/js/tinymce/tiny_mce.js');
		$this->getViewHelper('HeadScript')->appendFile('/public/js/tinymce/tiny_mce_init.js');
		
		$id = $this->params()->fromRoute('id', 0);
		
		if($id == 0)
		{
			$this->redirect()->toRoute('index');
		}
		
		$em = $this->getEntityManager();
		
		$pages = $em->getRepository('\Entities\Pages')->find($id);
		
		$request = $this->getRequest();
		
		if($request->isPost())
		{
			$data = $request->getPost();
			
			$pages->setContent($data->get('content'));
			
			$em->flush();
			
			return $this->redirect()->toRoute('index');
			
		}
		
		$form = new PagesForm();
		$form->get('content')->setValue(stripslashes($pages->getContent()));
		if($id == 1)
		{
			$title = 'Các khoá học';
		}else if($id == 2)
		{
			$title = 'Thông tin bản thân';
		}else if($id == 3)
		{
			$title = 'Liên hệ';
		}
		return array('form'=>$form,"id"=>$id,'title'=>$title);
		
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