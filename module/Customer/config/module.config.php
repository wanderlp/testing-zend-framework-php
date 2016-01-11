<?php

return array(
    // Controllers
    'controllers' => array(
        'invokables' => array(
            'Customer\Controller\Customer' => 'Customer\Controller\CustomerController'
        )
    ),
    
    // Routes
    'router' => array(
        'routes' => array(
            'customer' => array(
                'type'    => 'segment',
                'options' => array(
                    'route' => '/customer[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Customer\Controller\Customer',
                        'action'     => 'index'
                    )
                )
            )
        )
    ),
    
    // Views
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view'
        )
    )
);