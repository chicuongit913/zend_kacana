<?php

namespace Repositories;

use Entities\StContent;

use Doctrine\Common\Cache\ArrayCache;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CommonRepository extends EntityRepository
{    
    public function getListPage($params)
    {       
        $queryBuilder = $this->_em->createQueryBuilder();       
        
        $queryBuilder->select('p')
        ->from('Entities\StPage', 'p')
        ->join('p.titletr', 't')       
        ->join('p.desctr', 'd')       
		->where('1 = 1');	
        
        if($params->filters != null){           

            /////////////////////
            
            $query_class = new \ST_Database_FilterExtJS();
            $query_class->params($params)->queryBuilder($queryBuilder)->query_id();
                   
            $query_class->query_title('page');
        }
        
        $sort = 'p.'.$params->sort;
        
        if($params->sort == 'titleTr')
        {
            $sort = 't.contentEn';
        }
        else if($params->sort == 'descTr')
        {
            $sort = 'd.contentEn';            
        }
        
        $queryBuilder ->orderBy($sort , $params->dir);
        
        if($params->start !=  null){
	        $queryBuilder->setFirstResult( $params->start );
	        $queryBuilder->setMaxResults( $params->limit );
        }
        // We take the Query from QueryBuilder
        $query = $queryBuilder->getQuery();        
        $results = $query->getResult();
        
        return $results;
    }
     
    protected $_recordCount;
    protected $_pageCount;

    
    
    
  //  protected $_lang;
    
//    public function __construct()
//    {
//       	//Locale
//        	$locale = new \HAE_Element_Locale();
//      	$lang = $locale->getLocale();
//        	$this->_lang = $lang;
//     }
    
    public function findAllByOrder($entity, $column, $order)
    {
    
    	// Create the Query
    	$queryBuilder = $this->_em->createQueryBuilder()
    	->select('a')
    	->from($entity, 'a')
    	->orderBy('a.'.$column, $order);
    	 
    	// We take the Query from QueryBuilder
    	$query = $queryBuilder->getQuery();
    
    	// We get the result
    	$results = $query->getResult();
    
    	// And finally return it
    	return $results;
    }
    
    public function getAll()
    {
        $q = $this->_em->createQuery("SELECT e FROM $this->_entityClassName e");
        $q->setMaxResults(100);
        return $q->getResult();
    }

    public function getPage($page_num = 0, $per_page = 10)
    {
        $limit = $per_page;
        $offset = $per_page * $page_num;

        $q = $this->_em->createQuery("SELECT e FROM $this->_entityClassName e");
        $q->setMaxResults($limit);
        $q->setFirstResult($offset);
        return $q->getResult();
    }

    public function getPageCount($size)
    {
        if ($this->_pageCount == null) {
            $this->_pageCount = ceil($this->getCount() / $size);
        }
        return $this->_pageCount;
    }

    public function getCount()
    {
        if ($this->_recordCount == null) {
            $q = $this->_em->createQuery("SELECT COUNT(e.id) FROM $this->_entityClassName e");
            $this->_recordCount = $q->getSingleScalarResult();
        }
        return $this->_recordCount;
    }    
    
    public function getListSort($page_num = 0, $per_page = 10)
    {
    	$limit = $per_page;
    	$offset = $per_page * $page_num;
    
    	$q = $this->_em->createQuery("SELECT e FROM $this->_entityClassName e");
    	$q->setMaxResults($limit);
    	$q->setFirstResult($offset);
    	return $q->getResult();
    }
    
    public function deleteById($id)
    {
    	$obj = $this->findOneById($id);
    	$this->_em->remove($obj);
    	$this->_em->flush();
    }
    function getTypeOfsearch($key,$i=0)
    {
    	$key_list = explode('_', $key);
    	if (count($key_list)>1)
    	    return lcfirst($key_list[$i]);
    	else
    	    return lcfirst($key);
    }
/*********** FUNCTION TO SEARCH ALL FORM   ************/
    public function searchAllForm($name,$list_item,$offset=0,$limitPerPage=0)
    {
       
        if($offset>0){
        	$offset = ((int)$offset-1)*((int)$limitPerPage);
        }
        $this->_entityClassName = 'Entities\St'.ucwords($name);
       
        $condition_sort = '';
    	$condition=' WHERE ';
    	$i = 0 ;
    	$tablejoin = 1;
    	$nametablejoin = array();
    	
    	$isWhere = 0;
    	$isOrderby = 0;
    	$isJoin = 0;
    	
    	if ($list_item!=''){
    	foreach ($list_item as $key => $value)
    	{
            $i++;
            
            $type = $this->getTypeOfsearch($key);
            
   	        if ($value != '')
   	        {
   	            if ($type == 'sortby' || $type == 'date')
   	            {
   	                $isOrderby++;
   	                $nameColumn = $this->getTypeOfsearch($value,0);
   	                $typeSort = $this->getTypeOfsearch($value,1);
   	                $condition_sort=" ORDER BY e.".$nameColumn." ".ucfirst($typeSort);
   	            }
   	            else if($type == 'sortbys' || $type == 'dates')
   	            {
   	                $isOrderby++;
   	                $isJoin++;
   	                $nametablejoin[$tablejoin] = $this->getTypeOfsearch($value,1);
   	                
   	                $nameColumn = $this->getTypeOfsearch($value,0);
   	                $typeSort = $this->getTypeOfsearch($value,2);
   	                $condition_sort=" ORDER BY e".$tablejoin.".".$nameColumn." ".ucfirst($typeSort);
   	                $tablejoin++;
   	            }
   	            else if($type == 'search')
   	            {
   	                
	                $condi='';
	                $list_key = $this->getTypeOfsearch($key,1);
	   	            $list_key = explode('|',$list_key );
	   	            if (count($list_key)>1)
	   	            {
	   	                $condi .="( ";
	   	                for($i_list_key=0;$i_list_key<count($list_key)-1;$i_list_key++)
	   	                {
	   	                    $condi .="e.".lcfirst($list_key[$i_list_key])." LIKE '%".$value."%' OR ";
	   	                }
	   	                $condi .="e.".lcfirst($list_key[count($list_key)-1])." LIKE '%".$value."%' )";
	   	                
	   	            }
	   	            else
	   	            {
	   	                if($this->getTypeOfsearch($key,1)=="promotionallid")
	   	                {
	   	                    if($value == 1)
	   	                    	$condi = "e.".$this->getTypeOfsearch($key,1)." <> 0 ";
	   	                    else
	   	                        $condi = "e.".$this->getTypeOfsearch($key,1)." = 0 ";
	   	                }
	   	                else
	   	                {
	   	                	$condi = "e.".$this->getTypeOfsearch($key,1)." LIKE '%".$value."%' ";
	   	                }
	   	            } 
	   	                
	   	            if ($isWhere>0)
	   	                $condition .= "AND ".$condi;
	   	            else
	   	                $condition .= $condi;
	   	            $isWhere++;
	   	            
   	            }
   	            else if($type == 'searchs')
   	            {
   	                $isJoin++;
   	            	$list_key = $this->getTypeOfsearch($key,1);
   	            	$list_key = explode('|',$list_key );
   	            	
   	            	$condi='';
   	            	
   	            	if (count($list_key)>2)
   	            	{
   	            		$condi .="( ";
   	            		for($i_list_key=0;$i_list_key<count($list_key)-2;$i_list_key++)
   	            		{
   	            		$condi .="e".$tablejoin.".".lcfirst($list_key[$i_list_key])." LIKE '%".$value."%' OR ";
   	            		}
   	            		$condi .="e".$tablejoin.".".lcfirst($list_key[count($list_key)-2])." LIKE '%".$value."%' )";
   	            		 
   	            	}
   	            	else
   	            		$condi = "e".$tablejoin.".".$list_key[0]." LIKE '%".$value."%' ";
   	            		if ($isWhere>0)
   	            			$condition .= "AND ".$condi;
   	            		else
   	            			$condition .= $condi;
   	            	
   	            	$nametablejoin[$tablejoin] = $list_key[count($list_key)-1];
   	            	$tablejoin++;
   	            	$isWhere++;
   	            }
   	        }
   	    }
    	}
   	   
   	    $selectable = ' e';
   	    $jointable  = ' ';
   	  
   	    if ($isJoin>0)
   	    { 
   	     
   	        for($i=1;$i<$tablejoin;$i++)
   	        {
   	           
   	            $selectable.=',e'.$i;
   	            $jointable.=' INNER JOIN e.'.lcfirst($nametablejoin[$i]).' e'.$i;
   	        }
   	    	
   	    }
   	    $query = "SELECT".$selectable." FROM $this->_entityClassName e ".$jointable;
   	    
   	    if ($isWhere!=0)
   	        $query .=$condition;
   	    $query .=$condition_sort;
   	    $query = $this->_em->createQuery($query);
   	    
   	    
    	if ($offset == 0 && $limitPerPage == 0 )
    	{
    		try
    		{
    			$result = new Paginator($query, $fetchJoinCollection = true);
    		}
    		catch (\Doctrine\ORM\NoResultException $e)
    		{
    			return null;
    		}
    		catch (\Exception $e)
    		{
    			return null;
    		}
    	}
    	else 
    	{
    	    try
    	    {
    	     //   $paginateQuery = Paginate::getPaginateQuery($query, $offset,$limitPerPage);
    	       	
    	        $query->setFirstResult($offset);
    	        $query->setMaxResults(intval($limitPerPage));
    	       
    	    	$result = $query->getResult();
    	    	
    	    }
    	    catch (\Doctrine\ORM\NoResultException $e)
    	    {
    	    	return null;
    	    }
	    	catch (\Exception $e) 
		    {
		    	return null;
		    }
    	}
    	
    	return $result;
    }
    
    /***********PAGINATOR  ************/
    public function paginatorRecord($offset,$limitPerPage)
    {
    	if($offset>0){
    		$offset = ((int)$offset-1)*((int)$limitPerPage);
    	}
    	$query = $this->_em->createQuery("SELECT e FROM $this->_entityClassName e");
    	$paginateQuery = Paginate::getPaginateQuery($query, $offset, $limitPerPage);
	    $result = $paginateQuery->getResult();
    	return $result;
    }
    public function paginatorCount()
    {
    	$query = $this->_em->createQuery("SELECT e FROM $this->_entityClassName e");
    	$count = Paginate::getTotalQueryResults($query);
    	return $count;
    }
   	
    /*********** SAVE ALL  ************/
    public function saveAll($id=0,$name,$postArray)
    {
        
        $obj = (object) $postArray;
       
        $repository = '\Entities\Hae'.$name;
        $this->_repo = $this->_em->getRepository($repository);
        if ($id==0)
        {
        	$obj = new $repository;
        	
        }
        else
        {
        	$obj = $this->_repo->findOneById($id);
        }
        
        
	    foreach($postArray as $key=>$value)
	    {
	        if ($key !='password' && $key !='created' && $key !='image' && $key !='metatagVi' && $key !='metatagEn' && $key !='metatagJa' && $key !='metatagZh' && $key !='metatagFr' && $key !='keywordVi' && $key !='keywordEn' && $key !='keywordJa' && $key !='keywordZh' && $key !='keywordFr')
	        {	$set = 'set'.ucfirst($key);
	      		$obj->$set($value);
	        }
	        elseif ($key == 'created' )
	        {
	            $set = 'set'.ucfirst($key);
	            $val = explode('/',$value);
	            $obj->$set(mktime(0,0,0,$val[1],$val[0],$val[2]));
	        }
	        elseif ($key == 'password' )
	        {
	        	$set = 'set'.ucfirst($key);
	        	$val =md5($value);
	        	$obj->$set($val);
	        }
	    }
	    if (isset($postArray['metatagEn']))
	    {
	       
	       	$seo = $this->saveSeo($obj->getSeoid(),$postArray,'object');
	        $obj->setSeo($seo);	        
	    }
	   
	    $this->_em->persist($obj);
	    $this->_em->flush();
	    
	  	return $obj;
	    
    }
    /*********** SAVE SEO  ************/
    public function saveSeo($id = 0,$postArray,$type='')
    {
        $obj = (object) $postArray;
        
        $this->_repo = $this->_em->getRepository('Entities\StSeo');
        if ($id==0)
        {
        	$seo = new \Entities\StSeo;
        }
        else
        {
        	$seo = $this->_repo->findOneById($id);
        }
        
        // Set Alias For Seo
        if(isset($obj->title))
        { 
            $seo->setAliasVi($this->rewrite($obj->title));
            $seo->setAliasEn($this->rewrite($obj->title));
//            $seo->setAliasJa($this->rewrite($obj->name));
//            $seo->setAliasZh($this->rewrite($obj->name));
            $seo->setAliasFr($this->rewrite($obj->title));
        }
        else
        {
            $seo->setAliasVi($this->rewrite($obj->titleVi));
            $seo->setAliasEn($this->rewrite($obj->titleEn));
//            $seo->setAliasJa($this->rewrite($obj->titleJa));
//            $seo->setAliasZh($this->rewrite($obj->titleZh));
            $seo->setAliasFr($this->rewrite($obj->titleFr));
        }
        
        // Set Metatag for Seo
        $seo->setMetatagVi($obj->metatagVi);
        $seo->setMetatagEn($obj->metatagEn);
//        $seo->setMetatagJa($obj->metatagJa);
//        $seo->setMetatagZh($obj->metatagZh);
        $seo->setMetatagFr($obj->metatagFr);
        //Set keyword for Seo
        $seo->setKeywordVi($obj->keywordVi);
        $seo->setKeywordEn($obj->keywordEn);
//        $seo->setKeywordJa($obj->keywordJa);
//        $seo->setKeywordZh($obj->keywordZh);
        $seo->setKeywordFr($obj->keywordFr);
         
        $this->_em->persist($seo);
	    $this->_em->flush();
	   
        if($type == "object")
        	return $seo;
        else
        	return $seo->getId();
    }
    
    function rewrite($string=null)
    {
    	// return if empty
    	if(empty($string)) return false;
    
    	// replace spaces by "-"
    	// convert accents to html entities
    	$string=htmlentities(utf8_decode(str_replace(' ', '-', $string)));
    
    	// remove the accent from the letter
    	$string=preg_replace(array('@&([a-zA-Z]){1,2}(acute|grave|circ|tilde|uml|ring|elig|zlig|slash|cedil|strok|lig){1};@', '@&[euro]{1};@'), array('${1}', 'E'), $string);
    
    	// now, everything but alphanumeric and -_ can be removed
    	// aso remove double dashes
    	$string=preg_replace(array('@[^a-zA-Z0-9\-_]@', '@[\-]{2,}@'), array('', '-'), html_entity_decode($string));
    	 
    	// Lowercase everything
    	$string= strtolower($string);
    	 
    	return $string;
    }
    
    function saveObject($arrayOption)
    {	
        $listObject =  array();
        
        $Obj =  (isset($arrayOption['Obj']))?$arrayOption['Obj']:'Null';
        
        $onSaveCreated = (isset($arrayOption['created']))?$arrayOption['created']:'Off';
        $onSaveUpdated = (isset($arrayOption['updated']))?$arrayOption['updated']:'Off';
     
        if(isset($Obj['id']))
            $Object = $this->_em->getRepository($this->_entityClassName)->find($Obj['id']);
    	else
    	    $Object = new $this->_entityClassName;
    	
    	foreach ($this->MainObject($Obj) as $key => $val)
    	{
    	    if($key!='id'||$key!='Id')
    			$vale = $this->saveColumn($Object,$key,$val,$listObject);
    	}
    	
    	foreach ($listObject as $key => $val)
    	{
    	    $this->_em->persist($val);
    	    $this->_em->flush();
    	   
    	    $listname = explode("_",$key);
    	    if(count($listname)==1)
    	    {
    	        $Object->{'set'.$key}($val);
    	    }
    	    elseif (count($listname)==2)
    	    {
    	        $name_obj_temp1 = '\Entities\\'.$this->getitem($listname[1]);
    	    	$obj_temp1 = new $name_obj_temp1;
    	    	$obj_temp1->{'set'.ucfirst($this->getitem($listname[1],1))}($val);
    	    	
    	    	$this->_em->persist($obj_temp1);
    	    	$this->_em->flush();
    	    	
    	    	$Object->{'set'.$listname[0]}($obj_temp1);
    	    }
    	    elseif  (count($listname)==3)
    	    {
    	        $name_obj_temp2 = '\Entities\\'.$this->getitem($listname[2]);
    	        $obj_temp2 = new $name_obj_temp1;
    	        $obj_temp2->{'set'.ucfirst($this->getitem($listname[2],1))}($val);
    	        
    	        $this->_em->persist($obj_temp2);
    	        $this->_em->flush();
    	        
    	        $name_obj_temp1 = '\Entities\\'.$this->getitem($listname[1]);
    	        $obj_temp1 = new $name_obj_temp1;
    	        $obj_temp1->{'set'.ucfirst($this->getitem($listname[1],1))}($obj_temp2);
    	        
    	        $this->_em->persist($obj_temp1);
    	        $this->_em->flush();
    	       
    	        $Object->{'set'.$listname[0]}($obj_temp1);
    	    }
    	    
    	}
    	if($onSaveCreated != 'Off')
    	{
    	    $Object->setCreated(time());
    		$Object->setCreatedBy($onSaveCreated);
    	}
    	
    	if($onSaveUpdated != 'Off')
    	{
    	    $Object->setUpdated(time());
    	    $Object->setUpdatedBy($onSaveUpdated);
    	}
    	
    	$this->_em->persist($Object);
    	$this->_em->flush();
    	
    	return $Object;
    	
    }
    
    function saveColumn(&$Object,$key,$val,&$listObject)
    {
        
        $listname = explode("_",$key);
        if(count($listname)==1)
        {
            $temp_list = explode(":",$listname[0]);
            
            if(count($temp_list)==1)
            {
            	$Object->{'set'.ucfirst($listname[0])}($val);
            }
            else
            {
                $temp_obj = $this->_em->getRepository("Entities\\".$temp_list[0])->find($val);
                $Object->{'set'.ucfirst($temp_list[1])}($temp_obj);
               
            }
        }
        elseif(count($listname)==2)
        {
            if(isset($Obj['id']))
            	$Object->{'get'.ucfirst($listname[0])}()->{'set'.ucfirst($this->getitem($listname[1],1))}($val);
            else
            {
            	if(isset($listObject[$listname[0]]))
            	{
            	    $listObject[$listname[0]]->{'set'.ucfirst($this->getitem($listname[1],1))}($val);
            	}
            	else
            	{
            	    $name_entities = "\Entities\\".$this->getitem($listname[1],0);
            	    $listObject[$listname[0]] = new $name_entities;
            	    $listObject[$listname[0]]->{'set'.ucfirst($this->getitem($listname[1],1))}($val);
            	}
            }
        }
        elseif(count($listname)==3)
        {
            if(isset($Obj['id']))
        		$Object->{'get'.ucfirst($listname[0])}()->{'get'.ucfirst($this->getitem($listname[1],1))}()->{'set'.ucfirst($this->getitem($listname[2],1))}($val);
            else
            {
                if(isset($listObject[$listname[0].'_'.$listname[1]]))
                {
                	$listObject[$listname[0].'_'.$listname[1]]->{'set'.ucfirst($this->getitem($listname[2],1))}($val);
                }
                else
                {
                	$name_entities = "\Entities\\".$this->getitem($listname[2],0);
                	$listObject[$listname[0].'_'.$listname[1]] = new $name_entities;
                	$listObject[$listname[0].'_'.$listname[1]]->{'set'.ucfirst($this->getitem($listname[2],1))}($val);
                }
            }
        }
        elseif(count($listname)==4)
        {
            if(isset($Obj['id']))
        		$Object->{'get'.ucfirst($listname[0])}()->{'get'.ucfirst($this->getitem($listname[1],1))}()->{'get'.ucfirst($this->getitem($listname[2],1))}()->{'set'.ucfirst($this->getitem($listname[3],1))}($val);
            else
            {
                if(isset($listObject[$listname[0].'_'.$listname[1].'_'.$listname[2]]))
                {
                	$listObject[$listname[0].'_'.$listname[1].'_'.$listname[2]]->{'set'.ucfirst($this->getitem($listname[3],1))}($val);
                }
                else
                {
                	$name_entities = "\Entities\\".$this->getitem($listname[3],0);
                	$listObject[$listname[0].'_'.$listname[1].'_'.$listname[2]] = new $name_entities;
                	$listObject[$listname[0].'_'.$listname[1].'_'.$listname[2]]->{'set'.ucfirst($this->getitem($listname[3],1))}($val);
                }
            }
        }
    }
    
    public function getitem($array,$item=0,$separator=":")
    {
    	$listarray = explode($separator,$array);
    	return $listarray[$item];
    }
    
    public function MainObject($Obj)
    {
    	if(isset($Obj['controller']))
    		unset($Obj['controller']);
    	if(isset($Obj['action']))
    		unset($Obj['action']);
    	if (isset($Obj['module']))
    		unset($Obj['module']);
    	return $Obj;
    }
    
    
    
}