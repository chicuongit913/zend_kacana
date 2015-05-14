<?php
namespace Admin;
return array(
    'controllers' => array(
        'invokables' => array(
            'index' => 'Admin\Controller\IndexController',
        	'news' => 'Admin\Controller\NewsController',
        	'page' => 'Admin\Controller\PageController',
        	'auth' => 'Admin\Controller\AuthController',
       		'include' => 'Admin\Controller\IncludeController',
        	'tree'	  => 'Admin\Controller\TreeController',
        	'user'	=>	'Admin\Controller\UserController'
        ),
    ),
	'router' => array(
			'routes' => array(
					'admin' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/admin[/:controller[/[:action]]]',
									'constraints' => array(
											'module'=>'Admin',
											'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
									),
									'defaults' => array(
											'controller' => 'index',
											'action'     => 'index',
									),
							),
							'may_terminate' => true,
							'child_routes' => array(
									'wildcard' => array(
											'type' => 'wildcard',
											'options' => array(
													'key_value_delimiter' => '/',
													'param_delimiter' => '/',
											),
											'may_terminate' => true,
									),
							),
					),
                    'login' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/admin/login',
                            'defaults' => array(
                                'module'=>'Admin',
                                'controller' => 'index',
                                'action' => 'auth',
                            ),
                        ),
                        'may_terminate' => true,
                    ),
			),
	),
    'view_manager' => array(
    		'display_not_found_reason' => true,
    		'display_exceptions'       => true,
    		'doctype'                  => 'HTML5',
    		'not_found_template'       => 'error/404',
    		'exception_template'       => 'error/index',
    		'template_map' => array(
    				'layout/admin'          => __DIR__ . '/../view/layout/layout.phtml',
    				'admin/index/index' 	=> __DIR__ . '/../view/admin/index/index.phtml',
    				'error/404'             => __DIR__ . '/../view/error/404.phtml',
    				'error/index'           => __DIR__ . '/../view/error/index.phtml',
    		),
	        'template_path_stack' => array(
	            'admin' => __DIR__ . '/../view',
	        ),
    ),
	'view_helpers' => array(
			'invokables'=> array(
					'paginator_helper' => 'Admin\View\Helper\Paginator',
					'jsonpaginator_helper' => 'Admin\View\Helper\JsonPaginator',
					'form_helper' => 'Admin\View\Helper\Form',
					'tableform_helper' => 'Admin\View\Helper\TableForm',
					'seo_helper' => 'Admin\View\Helper\Seo',
					'publish_helper' => 'Admin\View\Helper\Publish',
					'group_helper' => 'Admin\View\Helper\Group',
					'manipulation_helper' => 'Admin\View\Helper\Manipulation'
			)
	),
	'controller_plugins' => array(
			'invokables' => array(
					'Viewitem' => 'Admin\Controller\Plugin\Viewitem'
			)
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