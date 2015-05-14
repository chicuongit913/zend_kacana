<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$em = $this->getEntityManager();

    	$gioithieu = $em->getRepository('\Entities\Pages')->find(2);
    	$khoahoc = $em->getRepository('\Entities\Pages')->find(1);
    	$lienhe = $em->getRepository('\Entities\Pages')->find(3);
    	
    	return array('gioithieu'=>stripslashes($gioithieu->getContent()), 'khoahoc'=>stripslashes($khoahoc->getContent()), 'lienhe'=>stripslashes($lienhe->getContent()));
    }
    
    protected function getEntityManager()
    {
    	$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    
    	return $em;
    }
}
