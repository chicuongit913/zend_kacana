<?php
return array(
    // All navigation-related configuration is collected in the 'navigation' key
    'navigation' => array(
        // The DefaultNavigationFactory we configured in (1) uses 'default' as the sitemap key
        'default' => array(
            // And finally, here is where we define our page hierarchy
            'account' => array(
                'label' => 'Account',
                'route' => '',
                'pages' => array(
                    'home' => array(
                        'label' => 'Dashboard',
                        'route' => '',
                    ),
                    'login' => array(
                        'label' => 'Sign In',
                        'route' => '',
                    ),
                    'logout' => array(
                        'label' => 'Sign Out',
                        'route' => '',
                    ),
                    'register' => array(
                        'label' => 'Register',
                        'route' => '',
                    ),
                ),
            ),
        ),
    ),
);
