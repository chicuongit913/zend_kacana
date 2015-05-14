<?php
namespace Admin;
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
        	'Admin\Controller\News' => 'Admin\Controller\NewsController',
        	'Admin\Controller\Pages' => 'Admin\Controller\PagesController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'index' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        	'news' =>array(
        			'type' => 'segment',
        			'options'=> array(
        					'route'    => '/admin/news[/:action][/:id]',
        					'constraints' => array(
        							'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        							'id' => '[0-9]*'
        					),
        				'defaults' => array(
	                        'controller' => 'Admin\Controller\News',
	                        'action'     => 'index',
                    	),
        			)
        	),
        	'pages' =>array(
        			'type' => 'segment',
        			'options'=> array(
        					'route'    => '/admin/pages[/:action][/:id]',
        					'constraints' => array(
        							'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        							'id' => '[0-9]*'
        					),
        					'defaults' => array(
        							'controller' => 'Admin\Controller\Pages',
        							'action'     => 'index',
        					),
        			)
        	)
        ),
    ),
    'view_manager' => array(
    		'display_not_found_reason' => true,
    		'display_exceptions'       => true,
    		'doctype'                  => 'HTML5',
    		'not_found_template'       => 'error/404',
    		'exception_template'       => 'error/index',
    		'template_map' => array(
    				'layout/admin'           => __DIR__ . '/../view/layout/layout.phtml',
    				'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
    				'error/404'               => __DIR__ . '/../view/error/404.phtml',
    				'error/index'             => __DIR__ . '/../view/error/index.phtml',
    		),
	        'template_path_stack' => array(
	            'admin' => __DIR__ . '/../view',
	        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
	'service_manager' => array(
			'factories' => array(
					'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
			),
	)		
);