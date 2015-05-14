<?php
namespace Admin;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\Mvc\MvcEvent;
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

        $this->initAcl($e);
        $e->getApplication()->getEventManager()->attach('route', array($this, 'checkAcl'));
    }

    public function initAcl(MvcEvent $e) {

        $acl = new \Zend\Permissions\Acl\Acl();
        $roles = include __DIR__ . '/config/module.acl.php';
        $allResources = array();
        foreach ($roles as $role => $resources) {

            $role = new \Zend\Permissions\Acl\Role\GenericRole($role);
            $acl -> addRole($role);

            $allResources = array_merge($resources, $allResources);

            //adding resources
            foreach ($resources as $resource) {
                // Edit 4
                if(!$acl ->hasResource($resource))
                    $acl -> addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));
            }
            //adding restrictions
            foreach ($allResources as $resource) {
                $acl -> allow($role, $resource);
            }
        }
        //testing
        //var_dump($acl->isAllowed('admin','home'));
        //true

        //setting to view
        $e->getViewModel()->acl = $acl;

    }

    public function checkAcl(MvcEvent $e) {
        $route = $e -> getRouteMatch() -> getMatchedRouteName();
        //you set your role

        $sessionContainer = new \Zend\Session\Container('login');

        if(!$sessionContainer->offsetExists('user'))
            $userRole = 'guest';
        else
            $userRole = $sessionContainer->level;

        if (!$e->getViewModel()->acl->isAllowed($userRole, $route)) {

            $url = $e->getRouter()->assemble(array(), array('name' => 'login'));
            $response=$e->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $url);
            $response->setStatusCode(302);
            $response->sendHeaders();
            $stopCallBack = function($event) use ($response){
                $event->stopPropagation();
                return $response;
            };
            $e->getApplication()->getEventManager()->attach(MvcEvent::EVENT_ROUTE, $stopCallBack,-10000);
            return $response;
        }

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
   
}