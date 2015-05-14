<?php

class Admin_MediaController extends Zend_Controller_Action
{
    protected $_em;
    protected $_repo; 
    
    //protected $_layout;
    //protected $_panel;
    //protected $_target;
    
    //protected $_subject;
    //protected $_subjectid;
    //protected $_album;
    //protected $_typefileid;
    //protected $_media;
    
    public function init()
    {
  	   $this->view->headLink()->appendStylesheet("/css/admin/mediamanager.css");  
  	   $this->view->headLink()->appendStylesheet("/css/admin/slideshow.css");
  	   $this->view->headLink()->appendStylesheet("/js/library/upload/jquery.fileupload-ui.css");
  	   $this->view->headLink()->appendStylesheet("/css/admin/validation.css");

  	   $this->view->headScript()->appendFile("/js/admin/mediamanager.js"); 
   	   $this->view->headScript()->appendFile("/js/admin/slideshow.js"); 
  	   $this->view->headScript()->appendFile("/js/library/upload/jquery.fileupload.js"); 
  	   $this->view->headScript()->appendFile("/js/library/upload/jquery.fileupload-ui.js"); 
  	   $this->view->headScript()->appendFile("/js/library/jquery/js/jquery.tmpl.min.js");
  	   $this->view->headScript()->appendFile("/js/admin/validation.js");
  	   
  	   $this->view->headScript()->appendFile("/js/library/mediaplayer/jwplayer.js");
  	   
 	   $this->_em = Zend_Registry::get('doctrine');
 	   
       $this->view->params = new stdClass();
       $this->layout = $this->view->params->layout = $this->getRequest()->getParam("layout", "enable") ;
       $this->panel = $this->view->params->panel = $this->getRequest()->getParam("panel", 1) ;
       $this->target = $this->view->params->target = $this->getRequest()->getParam("target", '');
       
       $this->tinytarget = $this->view->params->tinytarget = $this->getRequest()->getParam("tinytarget", '');
       $this->url = $this->view->params->url = $this->getRequest()->getParam("url", '');
       
       $this->media = $this->view->params->media = $this->getRequest()->getParam("media", '');
       
       $this->subject = $this->view->params->subject = $this->getRequest()->getParam("subject", '');
       $this->subjectid = $this->view->params->subjectid = $this->getRequest()->getParam("subjectid", null);
       $this->album = $this->view->params->album = $this->getRequest()->getParam("album", '');
       $this->typefileid = $this->view->params->typefileid = $this->getRequest()->getParam("typefileid", null);
       
       $this->fileid = $this->view->params->fileid = $this->getRequest()->getParam("fileid", null);
    }

    public function indexAction()
    {
        // action body
    }
    
    public function managerAction()
    {
        //Remove the template if asked        
		$this->_checkLayout();
	
		if($this->layout == "disable")
		{
 		    if($this->tinytarget != "")
		    {
			    echo '<link rel="stylesheet" href="/js/library/jquery/css/ui-lightness/jquery-ui-1.8.16.custom.css" type="text/css" media="screen">';
			    echo '<link rel="stylesheet" href="/css/admin/mediamanager.css" type="text/css" media="screen">';
			    echo '<link rel="stylesheet" href="/js/library/upload/jquery.fileupload-ui.css" type="text/css" media="screen">';
				echo '<link rel="stylesheet" href="/css/admin/main.css" type="text/css" media="screen">';
			    			    			    
			    echo '<script type="text/javascript" src="/js/library/tiny_mce/tiny_mce_popup.js"></script>';
			    
			    echo '<script type="text/javascript" src="/js/library/jquery/js/jquery-1.6.4.js"></script>';
			    echo '<script type="text/javascript" src="/js/library/jquery/js/jquery-ui-1.8.16.custom.min.js"></script>';
			    
			    echo '<script type="text/javascript" src="/js/admin/mediamanager.js"></script>';
			    
			    echo '<script type="text/javascript" src="/js/library/upload/jquery.fileupload.js"></script>';
			    echo '<script type="text/javascript" src="/js/library/upload/jquery.fileupload-ui.js"></script>';
			    echo '<script type="text/javascript" src="/js/library/jquery/js/jquery.tmpl.min.js"></script>';

			    echo '<script type="text/javascript" src="/js/library/mediaplayer/jwplayer.js"></script>';			     
			    
			}
			else 
			{
			    echo '<link rel="stylesheet" href="/js/library/jquery/css/ui-lightness/jquery-ui-1.8.16.custom.css" type="text/css" media="screen">';
			    echo '<link rel="stylesheet" href="/css/admin/mediamanager.css" type="text/css" media="screen">';
			    echo '<link rel="stylesheet" href="/js/library/upload/jquery.fileupload-ui.css" type="text/css" media="screen">';
			    echo '<link rel="stylesheet" href="/css/admin/main.css" type="text/css" media="screen">';
			    echo '<link rel="stylesheet" href="/js/library/colorbox/colorbox.css" type="text/css" media="screen">';
			    
			    echo '<script type="text/javascript" src="/js/library/jquery/js/jquery-1.6.4.js"></script>';
			    echo '<script type="text/javascript" src="/js/library/jquery/js/jquery-ui-1.8.16.custom.min.js"></script>';
			   			     
			    echo '<script type="text/javascript" src="/js/library/colorbox/jquery.colorbox-min.js"></script>';
			     
			    echo '<script type="text/javascript" src="/js/admin/customize-image.js"></script>';
			    echo '<script type="text/javascript" src="/js/admin/mediamanager.js"></script>';
			     
			    echo '<script type="text/javascript" src="/js/library/upload/jquery.fileupload.js"></script>';
			    echo '<script type="text/javascript" src="/js/library/upload/jquery.fileupload-ui.js"></script>';
			    echo '<script type="text/javascript" src="/js/library/jquery/js/jquery.tmpl.min.js"></script>';
			    
			    echo '<script type="text/javascript" src="/js/library/mediaplayer/jwplayer.js"></script>';
// 			    echo '<script type="text/javascript" src="/js/library/jstree/jquery.jstree.js"></script>';
// 			    echo '<script type="text/javascript" src="/js/library/jstree/popup.js"></script>';
// 			    echo '<script type="text/javascript" src="/js/library/jstree/jquery.cookie.js"></script>';
// 			    $this->view->headLink()->setStylesheet("/css/admin/mediamanager.css");
// 			    $this->view->headLink()->setStylesheet("/js/library/upload/jquery.fileupload-ui.css");
			    
// 			    $this->view->headScript()->setFile("/js/admin/mediamanager.js");
// 			    $this->view->headScript()->setFile("/js/library/upload/jquery.fileupload.js");
// 			    $this->view->headScript()->setFile("/js/library/upload/jquery.fileupload-ui.js");
// 			    $this->view->headScript()->setFile("/js/library/jquery/js/jquery.tmpl.min.js");
			    
// 			    $this->view->headScript()->setFile("/js/library/mediaplayer/jwplayer.js");
			    
// 		   		echo $this->view->headLink();
// 		    	echo $this->view->headScript();		    
			}  
			
		}
		
		$typefile = $this->view->typefile = new ST_Form_Element_Select_Typefile('selecttypefile');
		
    }

    public function uploadimageAction()
    {        
        //Remove the template if asked        
		$this->_checkLayout();		
    }
    
    public function browseimageAction()
    {
        //Remove the template if asked
        $this->_checkLayout();

        //Create a select dropdown for the type
        $typefile = $this->view->typefile = new ST_Form_Element_Select_Typefile('selecttypefile');
        
        $this->_repo = $this->_em->getRepository('Entities\StFileImage'); 
        
        if($this->subjectid !=0 && $this->typefileid == '' )
        {
        	$this->view->rows = $this->_repo->findBy(array('subject' => $this->subject, 'subjectid' => $this->subjectid));
        }
        else if($this->subjectid !=0 && $this->typefileid != '' )
        {
        	$this->view->rows = $this->_repo->findBy(array('subject' => $this->subject, 'subjectid' => $this->subjectid, 'typefileid' => $this->typefileid) );
        }
        else
        {
        	$this->view->rows = $this->_repo->findBy(array('status' => 1), array('id' => 'DESC'), 8);
        }                   
    }
        
    public function uploadvideoAction()
    {
    	//Remove the template if asked
    	$this->_checkLayout();
    }
    
    public function browsevideoAction()
    {
    	//Remove the template if asked
    	$this->_checkLayout();
        	
    	$this->_repo = $this->_em->getRepository('Entities\StFileVideo');
    
    	//Create a select dropdown for the type
    	$typefile = $this->view->typefile = new ST_Form_Element_Select_Typefile('selecttypefile');
    	
    	if($this->subjectid !=0 && $this->typefileid == '' )
        {
            $this->view->rows = $this->_repo->findBy(array('state' => 2, 'subjectid' => $this->subjectid), array('created' => 'DESC'));
        }
        else if($this->subjectid !=0 && $this->typefileid != '' )
        {
            $this->view->rows = $this->_repo->findBy(array('state' => 2, 'subjectid' => $this->subjectid, 'typefileid' => $this->typefileid) );
        }
        else
        {
	       	$this->view->rows = $this->_repo->findBy(array('state' => 2), array('created' => 'DESC'), 80);   
        }
    }
    
    public function convertvideoAction()
    {
    	//Remove the template if asked
    	$this->_checkLayout();

    	//Create a select dropdown for the type
    	$typefile = $this->view->typefile = new ST_Form_Element_Select_Typefile('selecttypefile');
    	
    	$this->_repo = $this->_em->getRepository('Entities\StFileVideo');
    
    	$this->view->rows = $this->_repo->findByState(0);
    }
    
    public function uploadAction()
    {
    	$this->_helper->layout()->disableLayout();
    	
    	if($this->media == "image")
    	{
    		$this->_uploadImage();    	    
    	}
    	elseif ($this->media == "video")
    	{
    	    $this->_uploadVideo(); 
    	}    	
    }
          
    public function convertAction()
    {
    
    	ignore_user_abort(true);
    	set_time_limit(0);
    
    	$this->_helper->layout()->disableLayout();
    	 
    	if($this->getRequest()->isPost())
    	{
    		//Get the POST id of the video
    		$fileid = $this->fileid;
    			
    		//Call the repository
    		$video = $this->_em->getRepository('Entities\StFileVideo')->find($fileid);
    			
    		//Check last time if the video is not in conversion
    		if($video->getState() == 0)
    		{
    			//We put the file in conversion state
    			$video->setState(1);
    			$video->setMsg('in conversion');
    			$this->_em->persist($video);
    			$this->_em->flush();
    
    			//Get the fullpath of the video to convert
    			$pathfile = getcwd().'/tmp/'.$video->getName();
    			 
    			// Instanciate ffmpeg_movie to get the dimension of the video
    			if(is_object($movie = new ffmpeg_movie($pathfile) ))
    			{
    				$width = $movie->getFrameWidth();
    				$height = $movie->getFrameHeight();
    				$ratio = $movie->getFrameWidth() / $movie->getFrameHeight();
    			}
    
    			//Create a variable to give the size we want to ffmpeg
    			$size = "";
    
    			//Define the wanted size
    			if ($width>480)
    			{
    				$width = 480;
    				$height=$width/$ratio;
    				$height=ceil($height/10)*10;
    				$size = "-s ".$width."x".$height." ";
    			}
    			elseif ($width!=0 && $height!=0)
    			{
    				$size = "-s ".$width."x".$height." ";
    			}
    			 
    			//We define the path for the orignal video, the video to patch with qt and the final one (for the ffmpeg exec and to delete at the end)
    			$video_origin = $pathfile;
    			$video_qt = getcwd().'/tmp/ST_qt_000'.$video->getId().'.mp4';
    			$video_final = getcwd().'/files/videos/'.$video->getSubject().'/'.$video->getAlbum().'/ST_video_000'.$video->getId().'.mp4';
    			 
    			chmod($video_origin, 0777);
    			 
    			//Define the ffmpeg exec for conversion
    			//$ffmpeg_cli = "ffmpeg -i ".$video_origin." -acodec libfaac -ab 128k -vcodec libx264 -b 700k ".$size." -flags +loop -cmp +chroma -partitions +parti8x8+parti4x4+partp8x8+partp4x4+partb8x8 -flags2 +brdo+dct8x8+wpred+bpyramid+mixed_refs -me_method umh -subq 7 -trellis 1 -refs 6 -bf 16 -directpred 3 -b_strategy 1 -bidir_refine 1 -coder 1 -me_range 16 -g 250 -keyint_min 25 -sc_threshold 40 -i_qfactor 0.71 -rc_eq 'blurCplx^(1-qComp)' -qcomp 0.6 -qmin 10 -qmax 51 -qdiff 4 -y ".$video_qt." 2>&1";
    			$ffmpeg_cli = "ffmpeg -i ".$video_origin." -acodec libfaac -ab 128k -vcodec libx264 -b 700k ".$size." -flags +loop -partitions +parti8x8+parti4x4+partp8x8+partp4x4+partb8x8 -me_method umh -subq 7 -trellis 1 -refs 6 -bf 16 -directpred 3 -b_strategy 1 -bidir_refine 1 -coder 1 -me_range 16 -g 250 -keyint_min 25 -sc_threshold 40 -i_qfactor 0.71 -rc_eq 'blurCplx^(1-qComp)' -qcomp 0.6 -qmin 10 -qmax 51 -qdiff 4 -y ".$video_qt." 2>&1";
    				
    			$output = shell_exec($ffmpeg_cli);
    			echo "<pre>$output</pre>";
    
    			//Give access to the video to put the meta at beginning
	     	    //chmod($video_qt, 0777);
	     	    $output = shell_exec("chmod $video_qt 0777");
	     	    echo "<pre>$output</pre>";
    			 
    			//Create the album and give rights if doesn't exist
    			if(!file_exists(dirname($video_final)))
    			{
    				mkdir (dirname($video_final), 0777);
    				chmod (dirname($video_final), 0755);
    			}
    			 
    			//We pass the metadata to the beginning
    			$output = shell_exec("qt-faststart ".$video_qt." ".$video_final." 2>&1");
    			echo "<pre>$output</pre>";
    
    			//Define a default timing
    			$timing = '00:00:10';
    				
    			//Define the thumbnail name
    			$preview = getcwd().'/files/videos/'.$video->getSubject().'/'.$video->getAlbum().'/ST_video_000'.$video->getId().'.jpg';
    			 
    			//Define the ffmpeg exec for thumbnails
    			$ffmpeg_cli="ffmpeg -i ".$video_final." -y -f mjpeg -vframes 1 -ss " .$timing. " -an ".$preview." 2>&1";
    				
    			//Run the ffmpeg exec
    			$output = shell_exec($ffmpeg_cli);
    			echo "<pre>$output</pre>";
    
    			// If the file is converted and exist, we can delete all the previous versions and save the changes in database
    			if(is_file($video_final))
    			{
    				unlink($video_origin);
    				unlink($video_qt);
    				
    				//We can now update the database
    				$video->setName('ST_video_000'.$video->getId().'.mp4');
    				$video->setPreview('ST_video_000'.$video->getId().'.jpg');
    				$video->setTime($timing);
    				$video->setStatus(1);
    				$video->setState(2);
    				$video->setMsg('converted');
    
    				$this->_em->flush();
    
    				echo 'converted';
    			}
    		}
    	}
    
   	}
   	
   	public function changetypeAction()
   	{
   		$this->_helper->layout()->disableLayout();
   	
   		if($this->getRequest()->isPost())
   		{
   			if($this->media == "image")
   			{
   				$this->_changetypeImage();
   			}
   			elseif ($this->media == "video")
   			{
   				$this->_changetypeVideo();
   			}
   		}
   	}
   	
   	public function deleteAction()
   	{
   		$this->_helper->layout()->disableLayout();
   	
   		if($this->getRequest()->isPost())
   		{
   			if($this->media == "image")
   			{
   				$this->_deleteImage();
   			}
   			elseif ($this->media == "video")
   			{
   				$this->_deleteVideo();
   			}
   		}
   	
   	}
        
    /********************************************************************************
     OTHER FUNCTIONS - MAIN SEARCH FUNCTION
    *********************************************************************************/
    
    public function _checkLayout()
    {
    	if($this->layout == "disable")
    	{
    		$this->_helper->layout->disableLayout();
    	}
    }
    
    public function _uploadImage()
    {
    	    $subject = $this->subject;
    		$subjectid = $this->subjectid;
    	    $album = $this->album;
    	    $typefileid = $this->typefileid;
    	        	        	    
    	    $url = '/files/images/'.$subject.'/'.$album.'/';
    	    $root =  getcwd().$url;
    	    
    	    if(!is_dir($root))
    	    {    	        
    	    	mkdir($root,0777,true);
    	    }

    	    //Add typlefile records
    	    $typefile = $this->_em->getRepository('Entities\StBddTypefile')->findOneById($typefileid);
    	    
    	    $this->_auth = Zend_Auth::getInstance();
    	    if ($this->_auth->hasIdentity())
    	    {    	    	
    	    	$auth = $this->_auth->getStorage()->read() ;
    	    	$userid = $auth->id;    	    	
    	    } else {
    	    	
    	    	$userid = 1;
    	    }
    	    
    	    //Add user records
    	    $user = $this->_em->getRepository('Entities\StUser')->find($userid);
    	   
    	    	
    	    $image = new \Entities\StFileImage;    	   
//     	    $image->setCreated(time());
//     	    $image->setCreatedBy($user);
    	    $image->setStatus(1);    
    	    $image->setTypefileid($typefile);    	    	
    	    $image->setSubject($subject);
    	    $image->setSubjectid($subjectid);
    	    $image->setAlbum($album);
    	    
    	    $this->_em->persist($image);
    	    $this->_em->flush();
    	       	    
    	    
    	    $upload = new Zend_File_Transfer_Adapter_Http();
    	    $upload->setDestination($root);
    	    $extension = strtolower(pathinfo($upload->getFileName(), PATHINFO_EXTENSION));
    	    $name = 'st_image_000'.$image->getId().'.'.$extension;
    	    
    	    $files = $upload->getFileInfo();    	    	
    	    $info = $files['files_0_'];    	    
    	    
    	    $folder = '/files/images/'.$subject.'/'.$album;
    	     
    	    //Recieve the upload
    	    $upload->addFilter(new Zend_Filter_File_Rename(array('target'=>$name,'overwrite'=>true)));
    	    $upload->receive('files_0_');
    	    	
    	    //Reduce the size of the uploaded file
    	    $thumb = PhpThumbFactory::create(getcwd().$folder.'/'.$name);
    	    $thumb->resize(1920, 0);
    	    $thumb->save(getcwd().$folder.'/'.$name);
    	    
    	    //Create the thumb
    	    $thumb = PhpThumbFactory::create(getcwd().$folder.'/'.$name);
    	    $thumb->resize(80, 80);
    	    $file = basename($thumb->getFileName(), '.'.strtolower($thumb->getFormat())).'_80x80.'.strtolower($thumb->getFormat());
    	    $destPath = rtrim(getcwd().$folder.'/thumbs', '/') . '/' . $file;
    	    if (!file_exists($destPath)) {
    	    	$thumb->save($destPath);
    	    }
    	    $urlPath = rtrim($folder.'/thumbs') . '/' . $file;
    	   
    	    $result = new stdClass();
    	    $result->name = $name;
    	    $result->type = $info['type'];    	        	    
    	    $result->thumbnail_url = '/files/images/'.$subject.'/'.$album.'/thumbs/st_image_000'.$image->getId().'_80x80.'.$extension;
    	    $result->size = intval($info['size'],10);
    	    $result->error = "";
    	    $result->delete_type = "delete";
    	       	    
    	    $image->setName($name);
    	    $this->_em->flush();    	    
    	    
    	    echo "[".Zend_Json::encode($result)."]";
    }

    public function _uploadVideo()
    {
    	 
    	$subject = $this->subject;
    	$subjectid = $this->subjectid;
    	$album = $this->album;   
    	$typefileid = $this->typefileid;    	 
    	$url = '/tmp/';
    	$root =  getcwd().$url;
        	
    	//Add typlefile records
    	$typefile = $this->_em->getRepository('Entities\StBddTypefile')->findOneById($typefileid);
    	
    	$this->_auth = Zend_Auth::getInstance();
    	if ($this->_auth->hasIdentity())
    	{
    		$auth = $this->_auth->getStorage()->read() ;
    		$userid = $auth->id;
    	} else {
    			
    		$userid = 1;
    	}
    
    	//Add user records
    	$user = $this->_em->getRepository('Entities\StUser')->findOneById($userid);
    		
    	$video = new \Entities\StFileVideo;
    	$video->setCreated(time());
    	$video->setStatus(0);
    	$video->setCreatedBy($user);
    	$video->setTypefileid($typefile);    	 
    	$video->setSubject($subject);
    	$video->setSubjectid($subjectid);
    	$video->setAlbum($album);    	
    	$video->setState(0);
    	$video->setMsg('to convert');
    		
    	$this->_em->persist($video);
    	$this->_em->flush();
    		
    	$upload = new Zend_File_Transfer_Adapter_Http();
    	$upload->setDestination($root);
    	$extension = strtolower(pathinfo($upload->getFileName(), PATHINFO_EXTENSION));
    
    	$name = 'ST_pre_000'.$video->getId().'.'.$extension;
    		
    	$files = $upload->getFileInfo();
    	$info = $files['files_0_'];
    
    	//echo getcwd().'/files/images/'.$subject.'/'.$album.'/'.$name;
    	//$thumb = PhpThumbFactory::create(getcwd().'/files/images/'.$subject.'/'.$album.'/'.$name);
    	//$thumb->adaptiveResize(50,50)->save(getcwd().'/files/images/'.$subject.'/'.$album.'/thumbs/ST_image_'.$image->getId().'_50x50.'.$extension);
    
    	$result = new stdClass();
    	$result->name = $name;
    	$result->type = $info['type'];
    	$result->thumbnail_url = '/tmp/ST_video_000'.$video->getId().'.jpg';
    	$result->size = intval($info['size'],10);
    	$result->error = "";
    	$result->delete_type = "delete";
    	 
    	$upload->addFilter(new Zend_Filter_File_Rename(array('target'=>$name,'overwrite'=>true)));
    	$upload->receive('files_0_');
    	 
    	$timing = '00:00:03';
    		
    	$ffmpeg_cli="ffmpeg -i ".$root.$name." -y -f mjpeg -vframes 1 -ss " .$timing. " -an ".$root.$result->thumbnail_url;
    		
    	exec($ffmpeg_cli);
    		
    	$video->setName($name);
    	$this->_em->flush();
    		
    	echo "[".Zend_Json::encode($result)."]";
    }
    
    public function _deleteImage()
    {              
     	$fileid = $this->fileid;
     	  
        if ( $fileid != null)
        {
            echo 'ok';
            $image = $this->_em->getRepository('Entities\StFileImage')->findOneById($fileid);
            
        	$database = new ST_Database_Delete();
        
        	$database->delete()->subject($image->getSubject())->subjectid($image->getSubjectid())->album($image->getAlbum())->image($image->getName())->deletebyfile(true)->delete_media();
        
        }	    
    }
         
    
    public function _deleteVideo()
    {
    	$fileid = $this->fileid;
    	$video = $this->_em->getRepository('Entities\StFileVideo')->find($fileid);
    
    	if ( $fileid != null)
    	{
    		if($video->getState() == 0)
    		{
    			$pathfile = getcwd().'/tmp/'.$video->getName();
    			unlink($pathfile);
    			$this->_em->remove($video);
    			$this->_em->flush();
    		}
    		else
    		{
    			$video = $this->_em->getRepository('Entities\StFileVideo')->findOneById($fileid);
    
    			$database = new ST_Database_Delete();
    
    			$database->delete()->subject($video->getSubject())->subjectid($video->getSubjectid())->album($video->getAlbum())->video($video->getName())->deletebyfile(true)->delete_media();
    			 
    		}
    	}
    }
    
    /********************************************************************************
     OTHER FUNCTIONS - CUSTOMIZE IMAGE
    *********************************************************************************/
    
    public function _changetypeImage()
    {
    	$fileid = $this->fileid;
    	$typefileid = $this->typefileid;
    	 
    	$image = $this->_em->getRepository('Entities\StFileImage')->find($fileid);
    	 
    	$typefile = $this->_em->getRepository('Entities\StBddTypefile')->find($typefileid);
    	 
    	$image->setTypefileid($typefile);
    	 
    	$this->_em->flush();
    }
    
    public function _changetypeVideo()
    {
    	$fileid = $this->fileid;
    	$typefileid = $this->typefileid;
    
    	$video = $this->_em->getRepository('Entities\StFileVideo')->find($fileid);
    
    	$typefile = $this->_em->getRepository('Entities\StBddTypefile')->find($typefileid);
    
    	$video->setTypefileid($typefile);
    
    	$this->_em->flush();
    }
   
   /**
     *
     */
    public function loadAction()
    {
    	$image_name 		= $this->_request->getParam('image_name');
    	$image_name 		= str_replace("$","/",$image_name);
    	$_name 	 		= explode("/",$image_name);
    
    	$_file_name = $_name[5];
    	$_album	 = $_name[4];
    	$_subject	 = $_name[3];
    
    	$thumb = PhpThumbFactory::create(APPLICATION_PATH.'/../public/files/images/'.$_subject.'/'.$_album.'/'.$_file_name);
    	//$thumb->show();
    	$imageAsString = $thumb->getImageAsString();
    	$this->view->imageAsString = $imageAsString;
    	$this->_helper->layout->disableLayout();
    
    }
    
    /**
     *
     */
    public function saveAction()
    {
    	$image_name 	= $this->_request->getParam('image_name');                 
        $image_name 	= str_replace("$","/",$image_name);
        $_name 	 		= explode("/",$image_name);
              
        $_file_name = $_name[5];
        $_album		= $_name[4];
        $_subject	= $_name[3];
        
        $_file_name_array = explode('.', $_file_name);
        //$_type_image = $_file_name_array[1];
                                 
        $top    = $this->_request->getParam('top');
        $left   = $this->_request->getParam('left');
        $width  = $this->_request->getparam('width');
        $height = $this->_request->getparam('height');

        $_w_container = $this->_request->getparam('w_container');
        $_h_container = $this->_request->getparam('h_container');
        	
        if($_w_container >= $width)
        	$_w_final = $width;
        else
        	$_w_final = $_w_container;
        	
        if($_h_container >= $height)
        	$_h_final = $height;
        else
        	$_h_final = $_h_container;
        
         $thumb = PhpThumbFactory::create(APPLICATION_PATH.'/../public/files/images/'.$_subject.'/'.$_album.'/'.$_file_name);  
                   
         $thumb->adaptiveResize($width,$height)->crop($left,$top,$_w_final,$_h_final);  
                      
         //$now   = new DateTime;
         //$_file_name_array = explode('.', $_file_name); 
         //$_file_name = substr($_file_name,0,strlen($_file_name)-4);
         //$_file_name .= "_".$now->format( 'd_m_Y_H_i_s_a' ).".".$_type_image;
         $_file_name = $_file_name_array[0]."_".$_w_final."_".$_h_final."_".$top."_".$left."_".$width."_".$height.".".$_file_name_array[1];
                  
         $thumb->save(APPLICATION_PATH.'/../public/files/images/'.$_subject.'/'.$_album.'/thumbs/'.$_file_name, $_file_name_array[1]);        
        
         $imageAsString = $thumb->getImageAsString();
        
         $this->view->imageAsString = $imageAsString;
         $this->view->path='/files/images/'.$_subject.'/'.$_album.'/thumbs/'.$_file_name;
         $this->_helper->layout->disableLayout();
    }
    
    public function addanothersubjectAction()
    {
    	$name = $this->_getParam('name','default');
    
    	//TO REMOVE AFTER FIX
    	$rewrite = new ST_Controller_Action_Helper_Rewrite();
    
    	//EXPORT SUBJECTS IN DB AND JSON
    	$subjects = new ST_Database_Subjects();
    	
    	$object = $subjects->name($name)
    	->subject('other_subject')
    	->subjectid(rand(1, 100))
    	->album($rewrite->getRewrite($name))
    	->status('1')
    	->dispatch();
    	
    	$object->setSubjectid($object->getId());
    	
    	$this->_em->persist($object);
    	$this->_em->flush();
    	
    	$subjects->export();
    	
    }
    
    public function subjectAction()
    {
    	$this->_helper->layout->disableLayout();
    	$name = 'Subject';
    	$this->_repo = $this->_em->getRepository(Zend_Registry::get('PrefixOfEntities').$name);
    		
    	$id = $this->_getParam('id', 0);
    		
    	$num_control = $this->getRequest()->getParam("num_control",Zend_Registry::get('NumberControlOfPage'));
    	$limitPerPage = $this->getRequest()->getParam("limitPerPage",Zend_Registry::get('limitItemsPerPage'));
    	$offset = $this->_request->getParam('page',1);
    		
    	$name_list_items = $name.'_items';
    	$list_items=array('search_Subject'=>'other_subject');
    	$sess = new Zend_Session_Namespace('ListForAdmin');
    	
    	if (isset($sess->$name_list_items))
    	{
    		$list_items = $sess->$name_list_items;
    		$list_items['search_Subject'] = 'other_subject';
    		if (isset($list_items['limitPerPage']))
    			$limitPerPage = $list_items['limitPerPage'];
    	}
    		
    	$result = $this->_repo->searchAllForm($name,$list_items,$offset,$limitPerPage);
    	$counts	 = $this->_repo->searchAllForm($name,$list_items);
    	$paginator_controls = $this->_helper->paginator->paginatorControls($num_control,$counts,$offset,$limitPerPage,'');
    	
    	$this->view->listitems = $list_items;
    	$this->view->paginator = $paginator_controls;
    	$this->view->object = $result;
    	$this->view->prefix = 'MANAGEMENT SUBJECT LIST';
    }
    
    public function slideshowAction()
    {
    	$this->_helper->layout->disableLayout();
    	//Create a select dropdown for the type
    	$name = 'Gallery';
    	$this->_repo = $this->_em->getRepository(Zend_Registry::get('PrefixOfEntities').$name);
    	
    	$id = $this->_getParam('id', 0);
    	
    	$num_control = $this->getRequest()->getParam("num_control",Zend_Registry::get('NumberControlOfPage'));
    	$limitPerPage = $this->getRequest()->getParam("limitPerPage",Zend_Registry::get('limitItemsPerPage'));
    	$offset = $this->_request->getParam('page',1);
    	
    	$name_list_items = $name.'_items';
    	$list_items=array('id'=>'id_ASC');
    	$sess = new Zend_Session_Namespace('ListForSlideShow');
    	 
    	if (isset($sess->$name_list_items))
    	{
    		$list_items = $sess->$name_list_items;
    		if (isset($list_items['limitPerPage']))
    			$limitPerPage = $list_items['limitPerPage'];
    	}
    	
    	$result = $this->_repo->searchAllForm($name,$list_items,$offset,$limitPerPage);
    	$counts	 = $this->_repo->searchAllForm($name,$list_items);
    	$paginator_controls = $this->_helper->paginator->paginatorControls($num_control,$counts,$offset,$limitPerPage,'');
    	 
    	$this->view->listitems = $list_items;
    	$this->view->paginator = $paginator_controls;
    	$this->view->object = $result;
    	$this->view->prefix = 'MANAGEMENT SLIDESHOW LIST';
    }
    public function slideshowdetailAction()
    {
    	
    	
	    $id = $this->_getParam('id', 0);
	    
	    $this->_repo = $this->_em->getRepository('Entities\StGallery');
	    
	    $auth = Zend_Auth::getInstance();
	    $user = $auth->getStorage()->read();
	    $author = $this->_em->getRepository('Entities\StUser')->find($user->id);
	    
    	if($id == 0 )
		{
			$this->view->manager = 'ADD NEW SLIDE SHOW';
		}
		else
		{
			$data = $this->_repo->find($id);
			$this->view->manager = 'EDITOR SLIDE SHOW : ';
			$this->view->data = $data;
			
			$data_detail_gallery = $this->_em->getRepository('Entities\StGalleryDetail')->findBy(array('galleryId'=>$id),array('order'=>'ASC'));
	    	$this->view->data_detail_gallery = $data_detail_gallery;
		}
		
    }
    public function saveslideAction()
    {
    	$this->_helper->layout()->disableLayout();
    	
    	$slideshowid = $this->_getParam('slideshowid',0);
    	$status =  $this->_getParam('status',1);
    	$priority = $this->_getParam('priority',1);
    	$nameslideshow = $this->_getParam('nameslide',0);
    	
    	$auth = Zend_Auth::getInstance();
    	$user = $auth->getStorage()->read();
    	$author = $this->_em->getRepository('Entities\StUser')->find($user->id);
    	
    	if($slideshowid == 0)
    	{
    		
    		
    		$slideshow = new Entities\StGallery;
    		
    		$slideshow->setName($nameslideshow);
    		$slideshow->setCreated(time());
    		$slideshow->setUpdated(time());
    		$slideshow->setCreatedBy($author);
    		$slideshow->setUpdatedBy($author);
    		$slideshow->setStatus($status);
    		$slideshow->setPriority($priority);
    		$this->_em->persist($slideshow);
    	    $this->_em->flush();
    	    $slideshowid = $slideshow->getId();
    	}
    	else
    	{
    		$slideshow = $this->_em->getRepository('Entities\StGallery')->find($slideshowid);
    		
    		$slideshow->setUpdated(time());
    		$slideshow->setStatus($status);
    		$slideshow->setPriority($priority);
    		$slideshow->setName($nameslideshow);
    		
    		$this->_em->persist($slideshow);
    		$this->_em->flush();
    	}
    	 
    	
    	$slideshowdetail = $this->_em->getRepository('Entities\StGalleryDetail')->findBy(array('galleryId'=>$slideshowid));
    	
    	if(count($slideshowdetail)>0)
    	{
    		foreach ($slideshowdetail as $slideshowitem)
    		{
    			$this->_em->remove($slideshowitem);
    			$this->_em->flush();
    		}
    	}
    	
    	$items = $this->_getParam('items','');
    	
    	$i = 1;
    	foreach ($items as $key => $item)
    	{
    		
    		$item_image = new Entities\StGalleryDetail;
    		$item_image->setGalleryId($slideshowid);
    		$item_image->setImage($item);
    		$item_image->setOrder($i);
    		$this->_em->persist($item_image);
    		$this->_em->flush();
    		$i++;
    	}
    	
    	echo $slideshowid;
    }
    
    
    
    public function newmediaAction()
    {
    	$this->_helper->layout->disableLayout();
    }
    
}

