<?php

/**
 * Router Configuration
 */
return array(
    'socialog-admin' => array(
        'type' => 'Literal',
        'priority' => 1000,
        'options' => array(
            'route' => '/admin',
            'defaults' => array(
                'controller' => 'socialogadmin-home',
                'action' => 'index',
            ),
        ),
        'may_terminate' => true,
        'child_routes' => array(

            /**
             * Post Route
             */
            'post' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/post[/:action[/:id]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'socialogadmin-post'
                    ),
                ),
            ),

            /**
             * Pages Route
             */
            'page' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/page[/:action[/:id]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'socialogadmin-page'
                    ),
                ),
            ),

            /**
             * Pages Route
             */
            'user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user[/:action[/:id]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'socialogadmin-user'
                    ),
                ),
            ),
        ),
    ),
);
