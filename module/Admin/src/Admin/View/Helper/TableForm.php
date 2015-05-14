<?php 
namespace Admin\view\Helper;

use Zend\View\Helper\AbstractHelper;

class TableForm extends AbstractHelper
{

    protected $_obj;
    protected $_listitems;
    
    protected $_columns = array();
    protected $_columnsType = array();
    protected $_columnsId = array();
    protected $_columnsName = array();
    protected $_columnsClass = array();
    protected $_columnsDateType = array();
    
    protected $_columnsbyname = array();
    
    protected $_promotion = array();
    protected $_tourtypeid = array();
    protected $_default = array();
    protected $_status = array();
    protected $_ask = array();
    protected $_priority = array();
    protected $_userCareer = array();
    
    protected $_actionStatus;
    protected $_actionEdit;
    protected $_actionDelete;
    protected $_actionSendEmail;
    protected $_actionAdd;
    
    protected $_prefix = '';
    
    protected $_attributes;
	
    public $_numberColumn;
    
	public function tableForm($obj,$listitems)
    {
        $this->_obj = $obj;
        $this->_listitems = $listitems;
        $this->_numberColumn = 0;
    	return $this;
    }
	
    public function setRows($obj,$key,$NameOfGet=0)
    {
    	$getFuntion = 'get'.$key;
    	$getFuntionGet = 'get'.$NameOfGet;
    	$numberRows=0;
    	
    	if($NameOfGet)
    	{
    		
    	    $keys_list = explode(':', $NameOfGet);
    	    $keys = $NameOfGet;
    	    
    	} 
    	else
    	{
    		
    	    $keys_list = explode(':', $key);
    	    $keys = $key;
    	}
    	
    	if (count($keys_list) > 1)
    	{
    	    $keys = $keys_list[1];
    	    $list = explode('|', $keys);
    	    if (count($list)==1)
    	    {
    	        $getFuntion = 'get'.$keys;
    	        if ($NameOfGet!='0')
    	        {
    	            $getFuntion = 'get'.$key;
    	            $getFuntionGet = 'get'.$keys;
    	        }
    	        
    	    }
    	}
//    	echo $keys;die;
    	$list = explode('|', $keys);
    	$objArray = array();
    	if(count($obj)>0)
    	{
    	foreach ($obj as $object)
    	{
    	    $string = "";
    	    if (count($list)>1)
    		{
    		    if ($NameOfGet)
    		    {
    		      
    		        foreach ($list as $keys)
    		        {
    		        	$getFuntionGet = 'get'.$keys;
    		        	if ($object->$getFuntion()->$getFuntionGet())
    		        		$string .=$object->$getFuntion()->$getFuntionGet().' ';
    		        	else
    		        	    $string .=' ';
    		        }
    		    }
    		    else
    		    {
    		        foreach ($list as $keys)
    		        {
    		        	$getFuntion = 'get'.$keys;
    		        
    		        	$string .=$object->$getFuntion().' ';
    		        }
    		    }
    		}
	    	else 
	    	{
	    	    
	    	  	if($NameOfGet)
	    	  	{
	    	  	  
	    	  	    try 
	    	  	    {
	    	  	 		$string =  $object->$getFuntion()->$getFuntionGet();
	    	  	 	}
	    	  	 	catch (\Doctrine\ORM\NoResultException $e)
	    	  	 	{
	    	  	 	    $sring = '';
	    	  	 	}
	    	  	 	catch (\Exception $e)
	    	  	 	{
	    	  	 		$sring = '';
	    	  	 	}
	    	  	 	    
	    		}
	    	  	else 
	    	  	{
	    	  		try
	    	  	    {
	    	  	    	$string = $object->$getFuntion();
	    	  	    }
	    	  	    catch (\Doctrine\ORM\NoResultException $e)
	    	  	    {
	    	  	    	$sring = '';
	    	  	    }
	    	  	    catch (\Exception $e)
	    	  	    {
	    	  	    	$sring = '';
	    	  	    }
	    	  	}
	    	  
	    	  	
	    	//   	$string = ($NameOfGet=='0')? $object->$getFuntion():  $object->$getFuntion()->$getFuntionGet();
	    	}
	    	
	    	$objArray[$numberRows] = $string;
    	  	$numberRows++;
    	}
    	}
    	return $objArray;
    }
    
    /******************************************************************
     * SET COLUMNS OF TABLE BY NAME WITH PROPERTIES IS SEARCH OR SORT *
     ******************************************************************/
    public function setColumnSearchByName($NameColumn,$NameOfGet=0)
    {
       
        if($NameOfGet)
        {
    		$type = 'searchs';
        }else
            $type = 'search' ;
    	$this->_columnsbyname[$this->_numberColumn] = array();
    	$this->_columnsbyname[$this->_numberColumn] = $this->setRows($this->_obj, $NameColumn,$NameOfGet);
    	$this->setColumns($NameColumn, $type,$NameOfGet);
    	return $this;
    }
    
    public function setColumnSortByName($NameColumn,$NameOfGet=0)
    {
        if($NameOfGet)
        {
        	$type = 'sortbys';
        }else
        	$type = 'sortby' ;
    	$this->_columnsbyname[$this->_numberColumn] = array();
    	$this->_columnsbyname[$this->_numberColumn] = $this->setRows($this->_obj, $NameColumn,$NameOfGet);
    	$this->setColumns($NameColumn, $type,$NameOfGet);
    	return $this;
    }
    
    public function setColumnByName($NameColumn,$NameOfGet=0)
    {
        if($NameOfGet)
        {
        	$type = 'normals';
        }else
        	$type = 'normal' ;
        $this->_columnsbyname[$this->_numberColumn] = array();
        $this->_columnsbyname[$this->_numberColumn] = $this->setRows($this->_obj, $NameColumn,$NameOfGet);
        $this->setColumns($NameColumn, $type,$NameOfGet);
        return $this;
    }
    
    public function setColumnDateByName($NameColumn,$NameOfGet=0)
    {
        if($NameOfGet)
        {
        	$type = 'dates';
        }else
        	$type = 'date' ;
    	$this->_columnsbyname[$this->_numberColumn] = array();
    	$this->_columnsbyname[$this->_numberColumn] = $this->setRows($this->_obj, $NameColumn,$NameOfGet);
    	$this->_columnsDateType[$this->_numberColumn] = 'date';
    	$this->setColumns($NameColumn, $type,$NameOfGet);
    	return $this;
    }
    public function setColumnDateTimeByName($NameColumn,$NameOfGet=0)
    {
    	if($NameOfGet)
    	{
    		$type = 'dates';
    	}else
    		$type = 'date' ;
    
    	$this->_columnsbyname[$this->_numberColumn] = array();
    	$this->_columnsbyname[$this->_numberColumn] = $this->setRows($this->_obj, $NameColumn,$NameOfGet);
    	$this->_columnsDateType[$this->_numberColumn] = 'datetime';
    	$this->setColumns($NameColumn, $type,$NameOfGet);
    	return $this;
    }
    /******************************************************************
     * SET SPECIAL  COLUMNS OF TABLE                                  *
     ******************************************************************/
    public function setHome()
    {
    	$this->_home = $this->setRows($this->_obj, 'Home');
    	$this->setColumns('Home', 'normal',0);
    	return $this;
    }
   	
    public function setUserCareer()
    {
    	$k=0;
    	$this->setColumns('UserCareer', 'normal',0);
    	 
    	foreach ($this->_obj as $Object)
    	{
    		$this->_userCareer[$k]=$Object->getUserCareer();
    		$k++;
    	}
    	return $this;
    }
    
    public function setDefault()
    {
        $this->_default = $this->setRows($this->_obj, 'Default');
        $this->setColumns('Default', 'default',0);
        return $this;
    }
    
    public function setStatus($actionStatus)
    {
        $this->_actionStatus = $actionStatus;
        $this->_status = $this->setRows($this->_obj, 'Status');
        $this->setColumns('Status', 'status',0);
        return $this;
    }
    
    public function setAsk()
    {
    	$this->_ask = $this->setRows($this->_obj, 'Ask');
    	$this->setColumns('Ask', 'ask',0);
    	return $this;
    }
    
    public function setTourtype()
    {
    	$this->_tourtypeid = $this->setRows($this->_obj, 'Tourtypeid');
    	$this->setColumns('Tour Type:Tourtypeid', 'tourtypeid',0);
    	return $this;
    }
    
    public function setPromotion()
    {
    	$this->_promotion = $this->setRows($this->_obj, 'Promotionallid');
    	$this->setColumns('Promotion:Promotionallid', 'promotionallid',0);
    	return $this;
    }
    
    public function setPriority()
    {
    	$this->_priority = $this->setRows($this->_obj, 'Priority');
    	$this->setColumns('Priority', 'priority',0);
    	return $this;
    }
    
    public function setActionEdit($action)
    {
        $this->setColumns('action','action',0);
        $this->_actionEdit = $action;
        return $this;
    }
    public function setActionDelete($action)
    {
    	$this->_actionDelete = $action;
    	return $this;
    }
    public function setActionSendEmail($action)
    {
    	$this->_actionSendEmail = $action;
    	return $this;
    }
    public function setActionAdd($action)
    {
    	$this->_actionAdd = $action;
    	return $this;
    }
    /******************************************************************
     * SET NAME'S COLUMNS AND PROPERTIES COLUMNS OF TABLE             *
     ******************************************************************/
 	public function setColumns($NameColumn, $type,$NameOfGet)
    {
        $this->_columns[$this->_numberColumn] = $this->getColumn($NameColumn,$type, $NameOfGet);
        $this->_columnsId[$this->_numberColumn] = $this->getColumnId($NameColumn,$type, $NameOfGet);
        $this->_columnsName[$this->_numberColumn] = $this->getColumnName($NameColumn,$type, $NameOfGet);
        $this->_columnsClass[$this->_numberColumn] = $this->getColumnClass($NameColumn,$type, $NameOfGet);
        $this->_columnsType[$this->_numberColumn] = $type;
        $this->_numberColumn = $this->_numberColumn + 1;
    }
    
    function getColumn($NameColumn,$type,$NameOfGet=0)
    {
    	if($NameOfGet)
    	{
    	    $Column = $NameOfGet;
    	}
    	else
    	    $Column =$NameColumn;
    	// when COLUMN CHANGE NAME => GET NAME CHANGE	
    	$NameColumn_List = explode(':',$Column);
    	if (count($NameColumn_List) > 1)
    	    return $NameColumn_List[0];
    	
    	// when COLUMN NOT CHANGE NAME => GET NAME IS NAME OF FIST COLUMN
    	
    	$NameColumn_List = explode('|',$Column);
    	if (count($NameColumn_List) > 1 && !$NameOfGet)
    		return $NameColumn_List[0];
    	
    	// WHEN COLUMN ONLY ONE COLUMN 
    	
    	return $NameColumn;
    }
    function getColumnName($NameColumn,$type,$NameOfGet=0)
    {
        $ColumnName = $NameColumn;
        if($NameOfGet)
        {
        	$ColumnName = $NameOfGet;
        }
        
        $NameColumn_List = explode(':',$ColumnName);
        
        if (count($NameColumn_List) > 1)
        	$ColumnName =  $NameColumn_List[1];
		
        if($type=='searchs'||$type=='sortbys'|| $type=='normals' || $type=='dates' )
            $ColumnName = $ColumnName.'|'.$NameColumn;
        return $ColumnName;
    }
    function getColumnId($NameColumn,$type,$NameOfGet=0)
    {
        $ColumnName = $this->getColumnName($NameColumn,$type,$NameOfGet);
        if($type=='sortby'||$type=='sortbys' )
        {
            
            $ColumnName_list = explode('|',$ColumnName);
            if (count($ColumnName_list)>1)
            {
                if($NameOfGet)
                {
            		return $ColumnName_list[0].'_'.$NameColumn;
                }
                else
                    return $ColumnName_list[0];
            }
        }
        return str_replace('|','_',$ColumnName);
    }
    function getColumnClass($NameColumn,$type,$NameOfGet=0)
    {
        if($type=='sortby'||$type=='sortbys' || $type=='date' || $type=='dates')
            return ' column_sort';
        else
            return '';
    }
    
    /******************************************************************
     * SET Attributes OF TABLE             *
    ******************************************************************/
    public function setPrefix($prefix)
    {
    	$this->_prefix = $prefix;
    	return $this;
    }
    
    public function getPrefix($prefix = '')
    {
    	$prefix ='<div class="topline"><h1>'.$this->_prefix.'</h1></div>';
    	return $prefix;
    }
    
    public function setAttributes(array $attribs)
    {
        $this->_attributes = $attribs;
        return $this;
    }
    /******************************************************************
     * SET Attributes OF TABLE             							  *
     ******************************************************************/
    public function toString()
    {
       $xhtml =$this->getPrefix();

        $xhtml .= '<table ';
        if (count($this->_attributes)) {
            foreach ($this->_attributes as $key=>$value) {
                $xhtml .= $key.'="'.$value.'" ';
            }
        }
        $xhtml .= '>';

    if (count($this->_columns)) {
            $xhtml .= '<thead>';
            
            $xhtml .= '<tr>';
            $bIsFirst = true;
            for ($icol=0;$icol<$this->_numberColumn;$icol++) {
                if(isset($this->_columnsType[$icol]) && $this->_columnsType[$icol]!='action')
                {  
                   $temp_str='';
                   $temp_sort=0;
                   if ($this->_columnsType[$icol]=='sortby' || $this->_columnsType[$icol]=='sortbys' || $this->_columnsType[$icol]=='date' || $this->_columnsType[$icol]=='dates'  )
                   {
                       
                       	if(isset($this->_listitems[$this->_columnsType[$icol]]))     
                       	{
                       		if ($this->_listitems[$this->_columnsType[$icol]] == lcfirst($this->_columnsId[$icol]).'_DESC' || $this->_listitems[$this->_columnsType[$icol]] == ucfirst($this->_columnsId[$icol]).'_DESC')
                       		{
                       		    $temp_str = '<span class="column_sort_DESC">';
                       		    $temp_sort='DESC';
                       		}
                       		if ($this->_listitems[$this->_columnsType[$icol]] == lcfirst($this->_columnsId[$icol]).'_ASC' || $this->_listitems[$this->_columnsType[$icol]] == ucfirst($this->_columnsId[$icol]).'_DESC')
                       		{
                       			$temp_str = '<span class="column_sort_ASC">';
                       			$temp_sort='ASC';
                       		}
                       	}
                       	else
                       	    $temp_str = '<span class="">';
                   }
                   $typedate = (isset($this->_columnsDateType[$icol]))?'typedate="'.$this->_columnsDateType[$icol].'"':'';
                   $xhtml .= '<td type="'.$this->_columnsType[$icol].'" '.$typedate.' name="'.$this->_columnsName[$icol].'" sort="'.$temp_sort.'" id="'.$this->_columnsId[$icol].'" class="first_column'.$this->_columnsClass[$icol].'">'.$this->_columns[$icol].$temp_str.'</span></td>';
                }
            }
            $xhtml .= '<td id="action_edit_delete" style="text-align: center;font-weight: bold;"  name="'.$this->_actionEdit.'_'.$this->_actionDelete.'_'.$this->_actionSendEmail.'" class="first_column">';
            	
            if($this->_actionAdd)
            {
            	$xhtml .='<a href="'.$this->_actionAdd.'">Add_New</a>';
            }
            
            $xhtml .='</td>';
            $xhtml .= '</tr>';
            $xhtml .= '<tr>';
            for ($icol=0;$icol<$this->_numberColumn;$icol++) 
            {
                
            		if (isset($this->_columnsType[$icol]) && ($this->_columnsType[$icol]=='search' || $this->_columnsType[$icol]=='searchs'))
	                {
	                   	$value_of_input_search = '';
	                    if(isset($this->_listitems[$this->_columnsType[$icol].'_'.$this->_columnsName[$icol]]))
	                        $value_of_input_search = $this->_listitems[$this->_columnsType[$icol].'_'.$this->_columnsName[$icol]];
	            		$xhtml .= '<td><input class="search_form_table" type="text" id="input_'.$this->_columnsId[$icol].'" value="'.$value_of_input_search.'" /></td>';
	            	}
	            	else if (isset($this->_columnsType[$icol]) && $this->_columnsType[$icol]=='promotionallid')
	            	{
	            		$search_promotionallid = -1;
	            		if (isset($this->_listitems['search_promotionallid']))
	            			$search_promotionallid=$this->_listitems['search_promotionallid'];
	            	
	            		$xhtml .='<td><select name="search_'.$this->_columnsId[$icol].'_'.$this->_actionStatus.'" id="promotionallid_search" >';
	            		$xhtml .='<option value="0" > ALL </option>';
	            		$xhtml .='<option value="1" '.$this->checkselected($search_promotionallid,1).' > Promotion </option>';
	            		$xhtml .='<option value="2" '.$this->checkselected($search_promotionallid,2).' > Normal </option>';
	            		$xhtml .='</select>';
	            		$xhtml .='</td>';
	            	}
	            	else if (isset($this->_columnsType[$icol]) && $this->_columnsType[$icol]=='tourtypeid')
	            	{
	            		$search_tourtypeid = 0;
	            		if (isset($this->_listitems['search_tourtypeid']))
	            			$search_tourtypeid=$this->_listitems['search_tourtypeid'];
	            		 
	            		$xhtml .='<td><select name="search_'.$this->_columnsId[$icol].'_'.$this->_actionStatus.'" id="tourtypeid_search" >';
	            		$xhtml .='<option value="0" > ALL </option>';
	            		$xhtml .='<option value="1" '.$this->checkselected($search_tourtypeid,1).' > Short Tour </option>';
	            		$xhtml .='<option value="2" '.$this->checkselected($search_tourtypeid,2).' > Package Tour </option>';
	            		$xhtml .='<option value="3" '.$this->checkselected($search_tourtypeid,3).' > Honey Moon </option>';
	            		$xhtml .='</select>';
	            		$xhtml .='</td>';
	            	}
            		else if ( isset($this->_columnsType[$icol]) && $this->_columnsType[$icol]=='status')
	                {
	                    $search_status = 3;
	                    if (isset($this->_listitems['search_status']))
	                        $search_status=$this->_listitems['search_status'];
	                    
	                    $xhtml .='<td><select name="search_'.$this->_columnsId[$icol].'_'.$this->_actionStatus.'" id="status_search" >';
	                    $xhtml .='<option value="3" > ALL </option>';
	                    $xhtml .='<option value="1" '.$this->checkselected($search_status,1).'  > ON </option>';
	                    $xhtml .='<option value="0" '.$this->checkselected($search_status,0).' > OFF </option>';
	                    $xhtml .='</select>';
	                    $xhtml .='</td>';
	                }
	                else if ( isset($this->_columnsType[$icol]) && $this->_columnsType[$icol]=='ask')
	                {
	                	$search_ask = 3;
	                	if (isset($this->_listitems['search_ask']))
	                		$search_ask=$this->_listitems['search_ask'];
	                	 
	                	$xhtml .='<td><select name="search_'.$this->_columnsId[$icol].'_'.$this->_actionStatus.'" id="ask_search" >';
	                	$xhtml .='<option value="3" > ALL </option>';
	                	$xhtml .='<option value="1" '.$this->checkselected($search_ask,1).'  > ASK </option>';
	                	$xhtml .='<option value="0" '.$this->checkselected($search_ask,0).' > OK </option>';
	                	$xhtml .='</select>';
	                	$xhtml .='</td>';
	                }
            		else if ( isset($this->_columnsType[$icol]) && $this->_columnsType[$icol]=='priority')
	                {
	                    $search_priority = 0;
	                    if (isset($this->_listitems['search_priority']))
	                    	$search_priority=$this->_listitems['search_priority'];
	                    
	                    $xhtml .='<td><select name="search_'.$this->_columnsId[$icol].'_'.$this->_actionStatus.'" id="priority_search" >';
	                    $xhtml .='<option value="0" > ALL </option>';
	                    $xhtml .='<option value="1" '.$this->checkselected($search_priority,1).' > Low </option>';
	                    $xhtml .='<option value="2" '.$this->checkselected($search_priority,2).' > Medium </option>';
	                    $xhtml .='<option value="3" '.$this->checkselected($search_priority,3).' > High </option>';
	                    $xhtml .='<option value="4" '.$this->checkselected($search_priority,4).' > Top </option>';
	                    $xhtml .='</select>';
	                    $xhtml .='</td>';
	                }
	                else if (isset($this->_columnsType[$icol]) && $this->_columnsType[$icol]=='action')
	                {
	                    $xhtml .='';
	                }
	                else
	                	$xhtml .= '<td></td>';
            }
            $xhtml .='<td style="text-align: center;" ><img style="cursor: pointer;" id="refresh_search_form"  src="/images/admin/refresh.png" >';
            $xhtml .='</td>';
            $xhtml .= '</tr>';
            $xhtml .= '</thead>';
        }

        $xhtml .= '<tbody>';
		
        if (count($this->_columnsbyname) > 0 && isset($this->_columnsbyname[0])) {
           
            for ($j = 0; $j < count($this->_columnsbyname[0]);$j++)
            {
	            $xhtml .='<tr>';
				for ($i = 0 ; $i < count($this->_columnsbyname) ;$i++)
				{	
				    if ($this->_columnsType[$i]=='date' || $this->_columnsType[$i]=='dates' )
                	{
                	    if ($this->_columnsDateType[$i] == 'date')
                	    	$xhtml .='<td>'.@date(" d-m-Y",$this->_columnsbyname[$i][$j]).'</td>';
                	    elseif ($this->_columnsDateType[$i] == 'datetime')
                	    	$xhtml .='<td>'.@date(" d-m-Y H:i",$this->_columnsbyname[$i][$j]).'</td>';
                	}
				 	else
				 	{
				 	    if(strlen ($this->_columnsbyname[$i][$j]) > 15 )
				 	        $xhtml .='<td title="'.strip_tags($this->_columnsbyname[$i][$j]).'" >'.substr(strip_tags($this->_columnsbyname[$i][$j]),0,15).'...'.'</td>';
				 	    else
				 	        $xhtml .='<td>'.strip_tags($this->_columnsbyname[$i][$j]).'</td>';
				 	   	
				 	}
				}
				if (isset($this->_columnsbyname[1][$j]))
					$xhtml .=$this->UserCareer($j,$this->_columnsbyname[1][$j]);
				
				if (count($this->_promotion) > 0)
				{
					$temp_image_promotion = '';
					if($this->_promotion[$j] == 0)
						$temp_image_promotion = '<img src="/images/admin/promotion.png">';
					else
						$temp_image_promotion = '<img src="/images/admin/promotion_active.png">';
					$xhtml .='<td style="text-align: center;"  >'.$temp_image_promotion.'</td>';
				}
				
				if (count($this->_tourtypeid) > 0)
				{
				    $tourtypename = '';
				    if($this->_tourtypeid[$j] == 1)
				    	$tourtypename = 'Short Tour';
				    else if ($this->_tourtypeid[$j] == 2)
				        $tourtypename = 'Package Tour';
				    else
				        $tourtypename = 'Honey Moon';
					$xhtml .='<td>'.$tourtypename.'</td>';
				}
				
				if (count($this->_default) > 0)
				{
					$classStatus = ($this->_default[$j] == 1)?'status-on':'status-off' ;
					$xhtml .='<td><div class="default-all-form" style="float:left;" ><span class="'.$classStatus.'" id="default_'.$this->_actionStatus.'_'.$this->_columnsbyname[0][$j].'" ></span></div></td>';
				}
				
				
				
            	if (count($this->_status) > 0)
				{
				    $classStatus = ($this->_status[$j] == 1)?'status-on':'status-off' ;
				    $xhtml .='<td><div class="status-all-form" style="float:left;" ><span class="'.$classStatus.'" id="status_'.$this->_actionStatus.'_'.$this->_columnsbyname[0][$j].'" ></span></div></td>';     
				}
				
				if (count($this->_ask) > 0)
				{
				
					$classAsk = ($this->_ask[$j] == 1)?'ask-on':'ask-off' ;
					$xhtml .='<td><div class="ask-all-form" style="float:left;" ><a href="/admin/user/ask/name/'.$this->_actionStatus.'/id/'.$this->_columnsbyname[0][$j].'" class="'.$classAsk.'" id="ask_'.$this->_actionStatus.'_'.$this->_columnsbyname[0][$j].'" ></a></div></td>';
				}
				    
				if (count($this->_priority)>0)
				{       
				    $xhtml .='<td><select disabled="disabled" name="priority" id="priority_'.$this->_actionStatus.'_'.$this->_columnsbyname[0][$j].'" >';
				    $xhtml .='<option value="1"'.$this->checkselected($this->_priority[$j],'1' ).'> Low </option>';
				    $xhtml .='<option value="2"'.$this->checkselected($this->_priority[$j],'2' ).'> Medium </option>';
				    $xhtml .='<option value="3"'.$this->checkselected($this->_priority[$j],'3' ).'> High </option>';
				    $xhtml .='<option value="4"'.$this->checkselected($this->_priority[$j],'4' ).'> Top </option>';
				    $xhtml .='</select>';
				    $xhtml .='<a class="help-for-button" name="enable_priority" id="enable_priority_'.$this->_actionStatus.'_'.$this->_columnsbyname[0][$j].'" >';
				    $xhtml .=	'<span id="icon_edit_priority_'.$this->_columnsbyname[0][$j].'" class="icon-button-all-form icon-edit-all-form" > Edit Priority</span>';
				    $xhtml .=	'<span class="bullet" style="width: 60px;" >Edit Priority</span>';
				    $xhtml .=	'<span class="icon-button-all-form ui-icon-triangle-1-s queue" ></span>';
				    $xhtml .='</a>';
				    $xhtml .='</td>';
				}
				$xhtml .='<td>';    
            	if ($this->_actionEdit)
				{
				    $xhtml .='<a name="button_edit" class="help-for-button" href="'.$this->_actionEdit.'/id/'.$this->_columnsbyname[0][$j].'">';
				    $xhtml .='<span class="icon-button-all-form icon-edit-all-form" > Edit </span>
				    <span class="bullet" style="width: 24px;" >Edit</span>
				    <span class="icon-button-all-form ui-icon-triangle-1-s queue" ></span></a>';
				}
				    
				if ($this->_actionDelete)
				{
				 	$xhtml .='<a name="button_delete" class="help-for-button" data-link="'.$this->_actionDelete.'/id/'.$this->_columnsbyname[0][$j].'">';
				  	$xhtml .='<span class="icon-button-all-form icon-delete-all-form" > Delete </span>
				   	<span class="bullet" style="width: 34px;" >Delete</span>
				   	<span class="icon-button-all-form ui-icon-triangle-1-s queue" ></span></a>';
				}
				if ($this->_actionSendEmail)
				{
				    $classEmail = ($this->_status[$j] == 1)?'emailed':'email' ;
				    $alertEmail = ($this->_status[$j] == 1)?'Sent':'Send Email' ;
					$xhtml .='<a class="help-for-button" name="'.$this->_columnsbyname[0][$j].'" data-link="'.$this->_actionSendEmail.'/id/'.$this->_columnsbyname[0][$j].'">';
					$xhtml .='<span class="icon-button-all-form icon-'.$classEmail.'-all-form" >'.$alertEmail.'</span>
					<span class="bullet" style="width: 55px;" >'.$alertEmail.'</span>
					<span class="icon-button-all-form ui-icon-triangle-1-s queue" ></span></a>';
				}
				    
				$xhtml .='</td>';
				$xhtml .='</tr>';
			}
	   	}
        else {
            $xhtml .= '<tr><td class="first_column" colspan="'.count($this->_columns).'">'.$this->_emptyRowContent.'</td></tr>';
        }

        $xhtml .= '</tbody>';
        $itemsperpage = 10;
        if (isset($this->_listitems['limitPerPage']))
            $itemsperpage=$this->_listitems['limitPerPage'];
        
        $xhtml .= '</table>
        				<div id="page_control"><div id="items_page_control">
        					<span class="bg_page_control">Items Page</span>
        					<select class="select_page_control" >
        						<option '.$this->checkselected($itemsperpage, 10).' value="10" > 10 Items</option>
        						<option '.$this->checkselected($itemsperpage, 20).' value="20" > 20 Items</option>
        						<option '.$this->checkselected($itemsperpage, 50).' value="50" > 50 Items</option>
        						<option '.$this->checkselected($itemsperpage, 100).' value="100" > 100 Items</option>
        					</select>
        				</div>
        
        ';

        return $xhtml;
    }
    private  function UserCareer($j,$NameCareer)
    {
    	$xhtml ='';
    	$i=0;
    	if (count($this->_userCareer)>0)
    	{
    		if(count($this->_userCareer[$j])>0){
    			$xhtml .='<td><a name="career_popup" href="/admin/aboutus/usercareer/id/'.$this->_columnsbyname[0][$j].'" class="help">'
    						.'<span> <image src="/images/admin/user_career_red.png" /> </span>
			    			<span class="bullet" style="width: 44px;" >Any One</span>
			    			<span class="icon-button-all-form ui-icon-triangle-1-s queue" ></span></a>'
    					.'</td>';
    		}
    		else
    		{
    			$xhtml .='<td><a class="help">';
    			$xhtml .='<span ><image src="/images/admin/user_career_black.png" /></span>
    			<span class="bullet" style="width: 44px;" >No One</span>
    			<span class="icon-button ui-icon-triangle-1-s queue" ></span></a></td>';
    		}
    	}
    	return $xhtml;
    }
	private  function checkselected($priority,$i)
	{
		if ($priority == $i)
		    return 'selected="selected"';
		else
		    return '';
	}

}
?>