<?php

namespace Employee;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\EmployeeController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'employee' => __DIR__ . '/../view',
        ],
    ],
    'router' => [
        'routes' => [
            'employee' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/employee[/][:action[/][:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\EmployeeController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
];
