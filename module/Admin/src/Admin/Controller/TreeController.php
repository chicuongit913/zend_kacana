<?php
namespace Admin\Controller;
use Admin\Form\NewsForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class TreeController extends AbstractActionController
{
	/**
	 * @var Doctrine\ORM\EntityManager
	 */
    protected $_em; 
    protected $_repo;
    private $session;

	public function newmediaAction()
	{
		
		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);
		return $viewModel;
	}
	
    /********************************************************************************
     WRITE
    *********************************************************************************/
    
    public function indexAction()
    {      
		
        
       	$id_folder = $this->params()->fromQuery('id',0);
        $respones = array();
        
        $folders = $this->getEntityManager()->getRepository("\Entities\StMediafolder")->findAll();
        
        if($id_folder == 0)
        {
        	$dir = './public/files';
        }
        else
        {
        	$folder_item = $this->getEntityManager()->getRepository("\Entities\StMediafolder")->find($id_folder);
        	$dir = './public/files/'.$folder_item->getName();
        }
        
        $folder_array =  array();
        
        foreach ($folders as $folder)
        {
        	$folder_array[$folder->getName()] = $folder->getId();
        }
        
        //read path
		if (is_dir($dir)) {
		    $handle = opendir($dir);
			while (false !== ($entry = readdir($handle))) 
			{
				$datas = array();
				//check file is a folder
				if ($entry != "captcha" && $entry != "documents" && $entry != "." && $entry != ".." && $entry != "resize" && $entry != '.svn' && $entry != 'thumbs' && $entry != 'thumb' && !strpos($entry, ".")) 
				{
				    //read files in child folder
					$datas['data'] = $entry;
					$dirchild = $dir.'/'.$entry;
					$datas['attr']['path'] = $dirchild;
					$datas['attr']['id'] = $folder_array[str_replace("./public/files/", "", $dirchild)]; 
					
					$Patharr = explode('/', $dir);
					
					
					
					if (is_dir($dirchild))
					{
					    $handlechild = opendir($dirchild);
						while(false !== ($entrychild = readdir($handlechild)))					
						{
							if ($entrychild != "." && $entrychild != "resize" && $entrychild != ".." && $entrychild != '.svn' && $entrychild != 'thumbs' && $entrychild != 'thumb' && !strpos($entrychild, "."))
							{								
							    $datas['children'] = array();
								$datas['state'] = "closed";
								break;
							}
						}
						closedir($handlechild);
					}
					
					$respones[] = $datas;		
				}		
			}
		closedir($handle);
		}
		
		echo json_encode($respones);

		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);
		return $viewModel;
    }
    
    public function searchAction()
    {
	   $folders = $this->getEntityManager()->getRepository("\Entities\StMediafolder")->findAll();
       $data = array();
       $data[] = '#0';
       foreach ($folders as $folder){
       	$data[] = '#'.$folder->getId();
       }
       //return all folder id you want to search in
       return $this->getResponse()->setContent(json_encode($data));
    }
    
    public function loadfileAction()
    {
    	$id_folder = $this->params('id',0);
    	
    	$files = $this->getEntityManager()->getRepository("\Entities\StMediafile")->findBy(array('folderid'=>$id_folder));
    	
    	$viewModel = new ViewModel(array('files'=>$files));
    	$viewModel->setTerminal(true);
    	return $viewModel;
    }
    
    public function createfolderAction(){
    	//get param values
    	$parentId = $this->params()->fromPost('parent_id',0);
    	$name = $this->params()->fromPost('name','new_folder');
    	$name = trim($name);
    	
    	//create new folder in folder "files"
    	$parentFolder = $this->getEntityManager()->getRepository("\Entities\StMediafolder")->findOneBy(array('id' => $parentId));
    	$newFolderPath ='./public/files/';
    	if($parentFolder == null){
    		$newFolderPath .= $name;
    	}
    	else{
    		$newFolderPath = $newFolderPath.$parentFolder->getName().'/'.$name;
    	}
    	
    	try {
    		$result = mkdir($newFolderPath);
    		
    		//success
    		if($result == 1){
    			//insert new folder into database
    			$newFolder = new \Entities\StMediafolder;
    			$newFolder->setName(str_replace("./public/files/", "", $newFolderPath));
    			$newFolder->setParent($parentId);
    			$this->getEntityManager()->persist($newFolder);
    			$this->getEntityManager()->flush();
    			
    			//return new folder id
    			return $this->getResponse()->setContent($newFolder->getId());
    		}
    	} 
    	catch (Exception $e) {
    		return $this->getResponse()->setContent(0);
    	}    
    	
    	return $this->getResponse()->setContent(0);    		
    }
    
    public function renamefolderAction(){
    	//get param values
    	$id = $this->params()->fromPost('id',0);
    	
    	$newName = '';
    	
    	$folder = $this->getEntityManager()->getRepository("\Entities\StMediafolder")->findOneBy(array('id' => $id));
    	
    	//cannot find folder
    	if($folder == null)
    	{
    		return $this->getResponse()->setContent(0); 	
    	}
    	
    	try {    		
    		$newName = $this->params()->fromPost('name','');
    		$newName = trim($newName);
    		if(empty($newName)){
    			return $this->getResponse()->setContent(0);
    		}
    		 
    		$newName = $this->renameFolder($folder->getName(),$newName);
    		
    		//rename folder
    		
    		rename("./public/files/".$folder->getName(),"./public/files/".$newName);
    		 
    		//rename folder in database
    		$folder->setName($newName);
    		$this->getEntityManager()->persist($folder);
    		$this->getEntityManager()->flush();
    		
    	} 
    	catch (Exception $e) {
    		return $this->getResponse()->setContent(0);
    	}
    	
    	return $this->getResponse()->setContent(true);
    }
    
    public function removefolderAction(){
    	//get param values
    	$id = $this->params()->fromPost('id',0);

    	$removeFolder = $this->getEntityManager()->getRepository("\Entities\StMediafolder")->findOneById($id);
    	
    	if($removeFolder == null)
    		return $this->getResponse()->setContent(0);    	
    	
    	//get all sub folder entities
    	$idArray = explode(' ',$this->getAllSubFolders($id));
    	$folders = $this->getEntityManager()->getRepository("\Entities\StMediafolder")->findBy(array('id' => $idArray));
    	
    	//use transaction
    	$this->getEntityManager()->getConnection()->beginTransaction();
    	try {     		
    		//check folder dir   	
    		$dir = "./public/files/".$removeFolder->getName();	
    		$this->rrmdir($dir);
    		
    		//delete all entities in sub folders
    		foreach ($folders as $folder)
    		{
    			$this->getEntityManager()->remove($folder);
    		}
    		$this->getEntityManager()->flush();
    		
    		//commit
    		$this->getEntityManager()->getConnection()->commit();
    		return $this->getResponse()->setContent(1);
    	} 
    	catch (Exception $e) {
    		//rollback if error
    		$this->getEntityManager()->getConnection()->rollback();
    		throw $e;
    	}
    	return $this->getResponse()->setContent(0);    		
    } 
    
    //function get folder in path
    protected function getNameFolder($name){
    	$names = explode('/',$name);
    	return end($names);	
    }
    
    //function rename folder in path
    protected function renameFolder($path, $newName){
    	$lastIndex = strripos($path,'/');
    	if($lastIndex <= 0){
    		return $newName;
    	}
    	$path = substr($path,0,$lastIndex+1);
    	return $path.$newName;	
    }
    
    //function get all sub folders
    protected function getAllSubFolders($id){
    	$subFolders = $this->getEntityManager()->getRepository("\Entities\StMediafolder")->findBy(array('parent' => $id));
    	if (count($subFolders) <= 0){
    		return $id;
    	}
    	$result=$id;
    	foreach ($subFolders as $subFolder){
    		$result =  $result . " " .$this->getAllSubFolders($subFolder->getId());
    	}
    	return $result;
    	
    }
    
    /*
     * function remove all folders and files in dir
     * from http://php.net/manual/en/function.rmdir.php
     * */
    
    protected function rrmdir($dir) {
    	if (is_dir($dir)) {
    		$objects = scandir($dir);
    		foreach ($objects as $object) {
    			if ($object != "." && $object != "..") {
    				if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
    			}
    		}
    		reset($objects);
    		rmdir($dir);
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

