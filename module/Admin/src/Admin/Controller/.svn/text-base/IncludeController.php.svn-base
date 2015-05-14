<?php
namespace Admin\Controller;
use Admin\Form\NewsForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use SimpleXMLElement;
use Zend\Json\Exception\RecursionException;
use Zend\Json\Exception\RuntimeException;

class IncludeController extends AbstractActionController
{
	protected $_em;
	protected $_repo;
	protected $_lang;
	protected $_prefix;
	
	protected function getViewHelper($helperName)
	{
		return $this->getServiceLocator()->get('viewhelpermanager')->get($helperName);
	}
	protected function getEntityManager()
	{
		
		$this->_em = $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		
		return $em;
	}
	
	/************** CHANGE STATUS *************/
	public function changestatusAction()
	{
		
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		
		$name = $this->getEvent()->getRouteMatch()->getParam("name");
	
		$Object = $this->getEntityManager()->getRepository("\Entities\St".$name)->findOneById($id);
		
		echo $Object->getStatus();
		if ($Object->getStatus())
			$Object->setStatus('0');
		else
			$Object->setStatus('1');
		$this->_em->persist($Object);
		$this->_em->flush();
		
		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);
		return $viewModel;
	}
	
	/************** CHANGE PRIORITY *************/
	public function changepriorityAction()
	{
		
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		
		$name = $this->getEvent()->getRouteMatch()->getParam("name");
	
		$priority = $this->getEvent()->getRouteMatch()->getParam("priority");
	
		$Object =$this->getEntityManager()->getRepository("\Entities\St".$name)->findOneById($id);
	
		$Object->setPriority($priority);
	
		$this->_em->persist($Object);
		$this->_em->flush();
		
		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);
		return $viewModel;
	
	}
	
	/************** SEARCH ALL FORM FUNCTION *************/
	public function searchformAction()
	{
	    // GET PARAMETER OF LIST FROM BOOTRAP
	    $num_control = $this->getEvent()->getRouteMatch()->getParam("num_control",3);
	    $limitPerPage = $this->getEvent()->getRouteMatch()->getParam("limitPerPage",10);
	    if($limitPerPage !=10)
	    	$list_items['limitPerPage'] = $limitPerPage ;
	    
	    // GET NAME ENTITIES AND OFFSET ( PAGE OF LIST)  
	    $name = $this->getEvent()->getRouteMatch()->getParam("name");
	    $offset = $this->getEvent()->getRouteMatch()->getParam("page",1);
	    
	    // GET POST ITEMS : ARRAY INCLUDE PARAMETER TO SEARCH AND SORT ( DEFINE THIS ARRAY IN THE BOTTOM FUNCTION )
	    $list_items = $this->params()->fromPost("items");
	    if($offset !=1)
	    	$list_items['offset'] = $offset ;
	    // SET SESSION FOR THE NEXT SEARCH OF LIST
	    $sess = new Container('ListForAdmin');
	    $name_list_items = ucwords($name).'_items';
	    $sess->$name_list_items = $list_items;
	    
	    // IF IN POST ITEMS HAVE LIMITPERPAGE WE SET AGAIN LIMITPERPAGE
	    if (isset($list_items['offset']))
	    	$offset = $list_items['offset'];
	    
	    if (isset($list_items['limitPerPage']))
	    	$limitPerPage = $list_items['limitPerPage'];
	    
	    // GET ENTITIES OF THE OBJECT SPEND NAME 
		$respository = "\Entities\St".ucwords($name);
	    $this->_repo = $this->getEntityManager()->getRepository($respository);
		
	    // IF NAME IS SUBJECT ONLY LOAD ANOTHER SUBJECT
	    
	    if($name == 'Subject' )
	    {
	    	$list_items['search_Subject'] = 'other_subject';
	    }
	    
		// GET RESULT BY FUNTION SEARCHALLFORM IN REPOSITORY/COMMONREPOSITORY
		$result = $this->_repo->searchAllForm($name,$list_items,$offset,$limitPerPage);
		
		//GENERA TO ARRAY SO ZEND_JSON CAN ENCODE 
		$object = array();
		$i=0;
		foreach ($result as $obj)
		{
			$object[$i]  = $obj->toArray();
			$object_temp = $object[$i];
			foreach ($object_temp as $key => $value)
			{
			    if ($key=='created' || $key=='updated' || $key=='checkin' || $key=='checkout' )
			    {
			    	$object[$i][$key] = strftime("%d-%m-%y %H:%M",$object[$i][$key]);
			    }
				if(is_object($object_temp[$key]))
				{
				    try
				    {
						$object[$i][$key]=$object_temp[$key]->toArray();
				    }
					catch (\Doctrine\ORM\NoResultException $e)
		    	    {
		    	    	$object[$i][$key]='';
		    	    }
			    	catch (\Exception $e) 
				    {
				    	$object[$i][$key]='';
				    }
				}
			}
			$i++;
		}
		echo json_encode($object);
		
		/*************************************************************************************************
		 *  ARRAY FOR SEARCH AND SORT WHEN WE POST DATA
		 * 
		 *	search_namecolum => text : search + namecolumn
		 *	search_namecolumn1|namecolumn2 => text : search + namecolumn1 + namecolumn2
		 *	searchs_namecolumn|namecolumn join in this entities  => text  : search for table join 
		 *	searchs_namecolumn1|namecolumns2|namecolumn join in this entities  => text 
		 *	sortby => namecolumn_ASC/DESC : sort for name column
		 *	sortbys => namecolumn_ASC/DESC  : sort for name column join table
		 *
		 **************************************************************************************************/
		
		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);
		return $viewModel;
	}
	
	public function paginatorsearchformAction()
	{
	    $num_control = $this->getEvent()->getRouteMatch()->getParam("num_control",3);
	    $limitPerPage = $this->getEvent()->getRouteMatch()->getParam("limitPerPage",10);
	    
	   
	    
	    $name = $this->getEvent()->getRouteMatch()->getParam("name");
	    $offset = $this->getEvent()->getRouteMatch()->getParam("page",1);
	    
	    $list_items = $this->getEvent()->getRouteMatch()->getParam('items','');
	    
	    if (isset($list_items['limitPerPage']))
	    	$limitPerPage = $list_items['limitPerPage'];
	    
	    $respository = "\Entities\St".ucwords($name);
	    $this->_repo = $this->getEntityManager()->getRepository($respository);
	    
	    $count = $this->_repo->searchAllForm($name,$list_items);
	    
	    $paginator_helper = new \Admin\View\Helper\Paginator;
	    $paginator_controls = $paginator_helper->paginatorControls($num_control,$count,$offset,$limitPerPage,'');
	    
	    $jsonpaginator_helper = new \Admin\View\Helper\JsonPaginator;
	    
	    echo $jsonpaginator_helper->jsonPaginator("",$paginator_controls);
	    
	    $viewModel = new ViewModel();
	    $viewModel->setTerminal(true);
	    return $viewModel;
	}
	
	public function deleteAction()
	{
		$this->_helper->layout()->disableLayout();
	
		$name = $this->_getParam('name');
		$id = $this->_getParam('id');
	
		$obj = $this->_em->getRepository(Zend_Registry::get('PrefixOfEntities').ucwords($name))->find($id); 
	
		if($name=='Subject')
		{
			$database = new ST_Database_Delete();
			$database->delete()->subject('another_subject')->subjectid($id)->rundelete();
		}
		
		
		$this->_em->remove($obj);
		$this->_em->flush();
	}

}
?>