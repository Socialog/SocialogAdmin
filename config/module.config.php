<?php

return array(

    'socialog-admin' => array(
        'text-mode' => 'markdown',
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
            'socialogadmin-user' => 'SocialogAdmin\Controller\UserController',
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
