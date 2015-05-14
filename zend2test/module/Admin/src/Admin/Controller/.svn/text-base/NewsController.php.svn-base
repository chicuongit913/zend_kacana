<?php 
namespace Admin\Controller;
use Admin\Form\NewsForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;





class NewsController extends AbstractActionController
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
		
		$this->getViewHelper('HeadLink')->appendStylesheet('/public/css/admin/news.css');
// 		$result = new ViewModel();
// 		$result->setTerminal(true);
// 		return $result;
		$this->em = $this->getEntityManager();
		
		$data = $this->em->getRepository('\Entities\News')->findAll();
		
		return array('data'=>$data);
	}
	public function addAction()
	{
		
		//check login
		$sessionContainer = new \Zend\Session\Container('login');
		if(!$sessionContainer->offsetExists('user'))
		{
			$this->redirect()->toRoute('index',array('action'=>'auth'));
		}
		//-------
		
		$this->getViewHelper('HeadLink')->appendStylesheet('/public/css/admin/news.css');
		$this->getViewHelper('HeadScript')->appendFile('/public/js/jquery.validate.js');
		$this->getViewHelper('HeadScript')->appendFile('/public/js/admin/news.js');
		
		$form = new NewsForm();
		$form->setAttribute('id','newsform');
		
		$request = $this->getRequest();
		if($request->isPost())
		{
			$data = $request->getPost();
			
			$em = $this->getEntityManager();
			
			$news = new \Entities\News();
			$news->setTitle($data->get('title'));
			$news->setContent($data->get('content'));
			$news->setCreated(time());
			
			$em->persist($news);
			$em->flush();
			
			return $this->redirect()->toRoute('news');
		}
		
		return array('form'=>$form);
		
	}
	
	public function editAction()
	{
		
		//check login
		$sessionContainer = new \Zend\Session\Container('login');
		if(!$sessionContainer->offsetExists('user'))
		{
			$this->redirect()->toRoute('index',array('action'=>'auth'));
		}
		//-------
		
		$this->getViewHelper('HeadLink')->appendStylesheet('/public/css/admin/news.css');
		$this->getViewHelper('HeadScript')->appendFile('/public/js/jquery.validate.js');
		$this->getViewHelper('HeadScript')->appendFile('/public/js/admin/news.js');
		
		
		$id = $this->params()->fromRoute('id', 0);
		
		if($id == 0)
		{
			$this->redirect()->toRoute('news');
		}
		
		$em = $this->getEntityManager();
		$news = $em->getRepository('\Entities\News')->find($id);
		
		$request = $this->getRequest();
		if($request->isPost())
		{
			$data = $request->getPost();
			
			$news->setId($id);
			$news->setTitle($data->get('title'));
			$news->setContent($data->get('content'));
			$news->setCreated(time());
			
			$em->flush();
				
			return $this->redirect()->toRoute('news');
		}
		
		$form = new NewsForm();
		$form->setAttribute('id','newsform');
		
		$form->get('id')->setValue($news->getId());
		$form->get('title')->setValue($news->getTitle());
		$form->get('content')->setValue($news->getContent());
		
		return array('form'=>$form,'id'=>$id);
		
	}
	public function deleteAction()
	{
		
		//check login
		$sessionContainer = new \Zend\Session\Container('login');
		if(!$sessionContainer->offsetExists('user'))
		{
			$this->redirect()->toRoute('index',array('action'=>'auth'));
		}
		//-------
		
		$id = $this->params()->fromRoute('id', 0);
		
		if($id == 0)
		{
			$this->redirect()->toRoute('news');
		}
		
		$em = $this->getEntityManager();
		$news = $em->getRepository('\Entities\News')->find($id);
		
		$em->remove($news);
		$em->flush();
		
		return $this->redirect()->toRoute('news');
		
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
