<?php
namespace Admin;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function onBootstrap($e)
    {
    	$e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
    		$controller = $e->getTarget();
    		$controllerClass = get_class($controller);
    		$moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
    		$config = $e->getApplication()->getServiceManager()->get('config');
    		if (isset($config['module_layouts'][$moduleNamespace])) {
    			$controller->layout($config['module_layouts'][$moduleNamespace]);
    		}
    	}, 100);
    	// Check Auth Login
    	
    	$this->checkauth();
    }
    
    public function checkauth()
    {
    	$sessionContainer = new \Zend\Session\Container('login');
    	if(!$sessionContainer->offsetExists('user'))
    	{
    		
//    		header("Location: /admin/auth");
    	}
    	else
    	{
    		
    	}
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
   
}