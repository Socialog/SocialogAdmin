<?php

return array(

    /**
     * Service Manager
     */
    'service_manager' => array(
        'factories' => array(
            'socialog-admin-navigation' => 'SocialogAdmin\Service\NavigationFactory'
        ),
    ),

    /**
     * Router Configuration
     */
    'router' => array(
        'routes' => include __DIR__ . '/routes.config.php',
    ),
    /**
     * Controller Configuration
     */
    'controllers' => array(
        'invokables' => array(
            'socialogadmin-home' => 'SocialogAdmin\Controller\AdminController',
            'socialogadmin-post' => 'SocialogAdmin\Controller\PostController',
            'socialogadmin-page' => 'SocialogAdmin\Controller\PageController',
        ),
    ),
    /**
     * ViewManager Configuration
     */
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    /**
     * Admin Navigation
     */
    'navigation' => array(
        'socialog-admin' => array(
            'home' => array(
                'label' => 'Home',
                'route' => 'socialog-admin',
            ),
            'posts' => array(
                'label' => 'Posts',
                'route' => 'socialog-admin/post',
            ),
            'pages' => array(
                'label' => 'Pages',
                'route' => 'socialog-admin/page',
            ),
        ),
    ),
);
