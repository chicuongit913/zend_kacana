<?php
namespace Admin\view\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;

class Group extends AbstractHelper
{
	protected $_data;
	protected $_grouplist;
	protected $_contentgroup;
	protected $_numbergroup = 0;
	
	public function group($option)
	{
	     
		// OPTIONS OF GROUP 
		$data = (isset($option['data']))?$option['data']:"";
		$id = (isset($option['id']))?$option['id']:"";
		$name = (isset($option['name']))?$option['name']:"";
		$class = (isset($option['class']))?$option['class']:"bloc_in_form";
		$type_group = (isset($option['type_group']))?$option['type_group']:"expand_open";
		
		$this->_data = $data;
		
		$this->_contentgroup =
		
		'<div id="bloc_infomation" class="bloc_in_form">
			<span class="bloc_title expand_open"> '.$name.' </span>';
		return $this;
	}
	
	public function input($option)
	{
		$sessionAdmin = new Container('param');
		$list_lang = $sessionAdmin->language;
		
		// OPTIONS OF INPUT 
		$name_field = (isset($option['name_field']))?$option['name_field']:"";
		$name = (isset($option['name']))?$option['name']:"";
		$multilang = (isset($option['multilang']))?$option['multilang']:"Off";
		$type = (isset($option['type']))?$option['type']:"text";
		$id = (isset($option['id']))?$option['id']:"";
		$value = (isset($option['value']))?$option['value']:"";
		$required = (isset($option['required']))?$option['required']:"";
		
	
		$this->_contentgroup .=
		'<div class="form-item">
		<div class="top">
		<a id="multi_expand_field'.$id.'" class="multi_language_expand closed '.$multilang.'"> </a>
		<span class="label">'.$name_field.'</span>
		</div>
		<div id="field'.$id.'" class="field-wrapper">';

		if($multilang == "On")
		{
		    $check=0;
			foreach ($list_lang as $val)
			{	
			    
			    $value = $this->getvalue($name.'_StContent:'.strtolower($val));
			    
			    if($type=="date" && $value!='')
			    {
			        $value = strftime("%d-%m-%Y",$value);
			    }
			    
			    if($check==0)
			    {
			        $this->_contentgroup .=
			        '<div id="zone_'.$id.'_'.$val.'" class="zone default">
			        <input name="'.$name.'_StContent:'.$val.'" id="'.$id.''.$val.'" class="field-text input-'.$type.'-'.$val.' '.$required.'" type="'.$type.'" minlength="6" value="'.$value.'">
			        </div>';
			    }
			    else
			    {
			        $this->_contentgroup .=
			        '<div id="zone_'.$id.'_'.$val.'" class="zone" style="display:none;">
			        	<input name="'.$name.'_StContent:'.$val.'" id="'.$id.''.$val.'" class="field-text input-'.$type.'-'.$val.' '.$required.'" type="'.$type.'" minlength="6" value="'.$value.'">
			        </div>';
			    }
				$check++;
			}
		}
		else if($multilang == "Off")
		{
		    $value = $this->getvalue($name);
		    if($type=="date" && $value!='')
		    {
		    	$value = strftime("%d-%m-%Y",$value);
		    }
		    
			$this->_contentgroup .=
			'<div id="zone_'.$id.'" class="zone default">
				<input name="'.$name.'" id="'.$id.'" class="field-text '.$type.' '.$required.'" type="'.$type.'" minlength="6" value="'.$value.'">
			</div>';
		}
		
		$this->_contentgroup .=
			'</div>
				</div>';
		
		return $this;
	}
	
	public function textarea($option)
	{
		$sessionAdmin = new Container('param');
		$list_lang = $sessionAdmin->language;
		
		$name_field = (isset($option['name_field']))?$option['name_field']:"";
		$multilang = (isset($option['multilang']))?$option['multilang']:"Off";
		$id = (isset($option['id']))?$option['id']:"";
		$name = (isset($option['name']))?$option['name']:"";
		$value = (isset($option['value']))?$option['value']:"";
		$required = (isset($option['required']))?$option['required']:"";
		$mce = (isset($option['mce']))?$option['mce']:"MceOff";
		
		$this->_contentgroup .=
		'<div class="form-item">
			<div class="top">
				<a id="multi_expand_'.$id.'" class="multi_language_expand closed '.$multilang.'"> </a>
				<span class="label">'.$name_field.'</span>
			</div>
			<div id="'.$id.'" class="field-wrapper">';
		
		if($multilang == "On")
		{
		    $check=0;
			foreach ($list_lang as $val)
			{
				$special_id = time();
			    $value = $this->getvalue($name.strtolower($val));
			    if($check==0)
			    {
					$this->_contentgroup .=
					'<div id="zone_'.$id.'_'.$val.'" class="zone default textarea text_'.$val.'">
						<textarea name="'.$name.''.$val.'" id="textarea_'.$id.'_'.$val.'_'.$special_id.'" class="mcetext field-text '.$required.' '.$mce.'" >'.$value.'</textarea>
					</div>';
			    }
			    else
			    {
			    	
			        $this->_contentgroup .=
			        '<div id="zone_'.$id.'_'.$val.'" class="zone textarea_text_'.$val.'" style="display:none;">
			        	<textarea name="'.$name.''.$val.'" id="textarea_'.$id.'_'.$val.'_'.$special_id.'" class="mcetext field-text '.$required.' '.$mce.'" >'.$value.'</textarea>
			        </div>';
			    }
			    if($mce=="MceOn")
			    {
				    $this->_contentgroup .='
				  
				    	<script type="text/javascript">
						$(document).ready(function()
						{
							tinyMCE.execCommand( "mceAddControl", false,"textarea_'.$id.'_'.$val.'_'.$special_id.'");
							
							
						});
						</script>
				    
				    ';
			    }
			    
			    
			    
			    $check++;
			}
		}
		else if($multilang == "Off")
		{
			$special_id = time();
			
		    $value = $this->getvalue($name);
		    
			$this->_contentgroup .=
			'<div id="zone_'.$id.'" class="zone default textarea">
				<textarea name="'.$name.'" id="textarea_'.$id.'_'.$special_id.'" class="mcetext field-text '.$required.' '.$mce.'" >'.$value.'</textarea>
			</div>';
			
			if($mce=="MceOn")
			{
				$this->_contentgroup .='
			
				<script type="text/javascript">
				$(document).ready(function()
				{
				tinyMCE.execCommand( "mceAddControl", false,"textarea_'.$id.'_'.$special_id.'");
					
			});
			</script>
			
			';
			}
		}
		
		$this->_contentgroup .=
			'</div>
				</div>';
			
		return $this;
	}
	
	public function dropdown($option)
	{
	    $name_field = (isset($option['name_field']))?$option['name_field']:"";
	    $name_entities = (isset($option['name_entities']))?$option['name_entities']:"";
	    $id = (isset($option['id']))?$option['id']:"";
	    $name = (isset($option['name']))?$option['name']:"";
	    $value = (isset($option['value']))?$option['value']:"id";
	    $key = (isset($option['key']))?$option['key']:"ContentEn";
	    $get = (isset($option['get']))?$option['get']:"all";
	    $use_array = (isset($option['use_array']))?$option['use_array']:"Off";
	    
	    $temp_name = explode(':', $name);
	    
	   	
	    $this->_contentgroup .= '<div class="form-item">
	    <div class="top">
	    <span class="label">' . $name_field . '</span>
	    </div>
	    <div id="' . $id . '" class="field-wrapper">
	    <div id="zone_' . $id . '" class="zone default">
	    <select class="required" name="' . $name . '">
	    <option value="0">please choose</option>';
	    if ($use_array == "Off" )
	    {
	    	$getselect = $this->getvalue($temp_name[1]."_".$name_entities.":".$value);
	    	
		    $doctrine=Zend_Registry::get('doctrine');
		    $temp = $doctrine->getRepository('Entities\\'.$name_entities);
		    if($get == "all")
		    {
		        $List_Object = $temp->findAll();
		    }
		    elseif(is_array($get))
		    {
		        $List_Object = $temp->findBy(array('id'=>$get));
		    }
		    
		    foreach ($List_Object as $Obj)
		    {
		        
		        $listname = explode("_",$key);
		        
		        if(count($listname)==1)
		        {
		        	$temp_key =  $Obj->{"get".$key}();
		        }
		        else if(count($listname)==2)
		        {
		            $temp_key =  $Obj->{"get".$listname[0]}()->{"get".$listname[1]}();
		        }
		        else if(count($listname)==3)
		        {
		        	$temp_key =  $Obj->{"get".$listname[0]}()->{"get".$listname[1]}()->{"get".$listname[2]}();
		        }
		        
		        if($getselect == $Obj->{"get".$value}() )
		            $this->_contentgroup .='<option selected="selected" value="'.$Obj->{"get".$value}().'">'.$temp_key.'</option>';
		        else
		        	$this->_contentgroup .='<option value="'.$Obj->{"get".$value}().'">'.$temp_key.'</option>';
		    }
	    }
	    else
	    {
	        $getselect = $this->getvalue("level");
	        foreach ($get as $val => $key)
	        {
	        	$this->_contentgroup .='<option '.$this->checkselected($getselect,$val).' value="'.$val.'">'.$val.'</option>';
	        }
	    }
	    $this->_contentgroup .='</select></div></div></div>';
	    
	    return $this;
	}
	function multiselect($option)
	{
		$name_field = (isset($option['name_field']))?$option['name_field']:"";
		$entities = (isset($option['entities']))?$option['entities']:"";
		$id = (isset($option['id']))?$option['id']:"";
		$name = (isset($option['name']))?$option['name']:"";
		$value = (isset($option['value']))?$option['value']:"id";
		$key = (isset($option['key']))?$option['key']:"ContentEn";
		$get = (isset($option['get']))?$option['get']:"all";
		$use_array = (isset($option['use_array']))?$option['use_array']:"Off";
		
		$this->_contentgroup .= '<div class="form-item">
		<div class="top">
		<span class="label">' . $name_field . '</span>
		</div>
		<div id="' . $name . '" class="field-wrapper">
		<div id="zone_' . $name . '" class="zone default">';
		
		if ($use_array == "Off" )
		{
			$getselect = explode("_",$this->getvalue($name));
		
			$doctrine=Zend_Registry::get('doctrine');
			$temp = $doctrine->getRepository('Entities\\'.$entities);
			if($get == "all")
			{
				$List_Object = $temp->findAll();
			}
			elseif(is_array($get))
			{
				$List_Object = $temp->findBy(array('id'=>$get));
			}
		
			foreach ($List_Object as $Obj)
			{
		
				$listname = explode("_",$key);
		
				if(count($listname)==1)
				{
					$temp_key =  $Obj->{"get".$key}();
				}
				else if(count($listname)==2)
				{
					$temp_key =  $Obj->{"get".$listname[0]}()->{"get".$listname[1]}();
				}
				else if(count($listname)==3)
				{
					$temp_key =  $Obj->{"get".$listname[0]}()->{"get".$listname[1]}()->{"get".$listname[2]}();
				}
				
				if (strlen($temp_key)>30)
					$temp_key = substr($temp_key,0,40).'...';
				
				if(in_array($Obj->{"get".$value}(),$getselect))
					$this->_contentgroup .='<input type="checkbox" checked value="'.$Obj->{"get".$value}().'"/><label class="lbl_multi_checkbock" >'.$temp_key.'</label>';
				else
					$this->_contentgroup .='<input type="checkbox" value="'.$Obj->{"get".$value}().'"/><label class="lbl_multi_checkbock" >'.$temp_key.'</label>';
			}
		}
		else
		{
			$getselect = $this->getvalue("level");
			foreach ($get as $val => $key)
			{
				$this->_contentgroup .='<input '.$this->checkselected($getselect,$val).' value="'.$val.'">'.$val.'</option>';
			}
		}
		$this->_contentgroup .='</div>
		
		<input name="'.$name.'" type="hidden" id="check_choose_'.$name.'" value="'.$this->getvalue($name).'" />
		
		</div></div>
		
		
		<script type="text/javascript">
		$(document).ready(function()
		{
			
			$("#'.$name.' #zone_'.$name.' input").live("click",(function(){
			var multiselect = "";
				$("#'.$name.' #zone_'.$name.' input").each(function(){
					if($(this).is(":checked"))
					{
						multiselect +=$(this).val()+"_";
					}
				});
				
				$("#check_choose_'.$name.'").val(multiselect);
			}));
		});
		</script>
		
		
		
		';
		return $this;
	}
	public function image($option,$defaul_image='')
	{
	    $name_field = (isset($option['name_field']))?$option['name_field']:"Image";
	    $height = (isset($option['height']))?$option['height']:"400";
	    $width = (isset($option['width']))?$option['width']:"400";
	    $name = (isset($option['name']))?$option['name']:"image";
	    $id   =	(isset($option['id']))?$option['id']:"image";
	    if($defaul_image == 'none')
	    {
	    	$image ='';
	    }
	    elseif ($defaul_image == '')
	    {
	    	$image = $this->getvalue($name);
	    }
	    elseif ($defaul_image != '')
	    {
	    	$image = $defaul_image;
	    }
	    
		$this->_contentgroup .=
		'<div class="form-item">
			<div class="top">
				<span class="label">'.$name_field.'</span>
			</div>
			<div id="'.$id.'" class="field-wrapper image" style="height: '.$height.'px; width:'.$width.'px;">'.
		 
				$this->view->manipulation()->id(rand())->image($image)->width($width)->height($height)->render().
	
			'</div>
			
			<input id="'.$id.'src" type="hidden" name="'.$name.'" value=""/>
		</div>
		<script type="text/javascript">
		$(document).ready(function()
		{
			$("#'.$id.' .manipulation_bloc_image").manipulation();
		});
		</script>
		
		';
	
		return $this;
	}
	
	public function endgroup()
	{
		$this->_contentgroup .=
			'</div>';
		
		$this->_grouplist[$this->_numbergroup] = $this->_contentgroup;
		
		$this->_numbergroup++;
		return $this;
		
	}
	
	public function toString()
	{
		$result = "";
		foreach ($this->_grouplist as $val)
		{
			$result .=$val;
			array_shift($this->_grouplist);
		}
		
		echo $result;
	}
	
	public function getvalue($name)
	{
	    if($this->_data!="")
	    {
	    	$temp = '$this->_data';
	    	$listname = explode("_",$name);
	    	if(count($listname)==1)
	    	{
	    		$value = $this->_data->{'get'.ucfirst($listname[0])}();
	    	}
	    	elseif(count($listname)==2)
	    	{
	    	    $value = $this->_data->{'get'.ucfirst($listname[0])}()->{'get'.ucfirst($this->getitem($listname[1],1))}();
	    	}
	    	elseif(count($listname)==3)
	    	{
	    	    $value = $this->_data->{'get'.ucfirst($listname[0])}()->{'get'.ucfirst($this->getitem($listname[1],1))}()->{'get'.ucfirst($this->getitem($listname[2],1))}();
	    	}
	    	elseif(count($listname)==4)
	    	{
	    	     $value = $this->_data->{'get'.ucfirst($listname[0])}()->{'get'.ucfirst($this->getitem($listname[1],1))}()->{'get'.ucfirst($this->getitem($listname[2],1))}()->{'get'.ucfirst($this->getitem($listname[3],1))}();
	    	}
	    }
	    else
	    	$value ='';
	    
	    return $value;
	}
	
	public function getitem($array,$item=0,$separator=":")
	{
	    $listarray = explode($separator,$array);
	    return $listarray[$item];
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