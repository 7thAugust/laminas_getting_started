<?php

declare(strict_types=1);

namespace Application;

use Application\Controller\AlbumController;
use Application\Factory\AlbumControllerFactory;
use Application\Controller\CrudController;
use Application\Factory\CrudControllerFactory;
use Application\Factory\AlbumRepositoryFactory;
use Application\Model\AlbumRepositoryInterface;
use Application\Model\PostCommandInterface;
use Application\Factory\PostCommandFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => AlbumController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => 'edit/:id',
                            'constraints' => [
                                'id' => '[1-9][0-9]*',
                            ],
                            'defaults' => [
                                'controller' => CrudController::class,
                                'action' => 'edit',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => 'delete/:id',
                            'constraints' => [
                                'id' => '[1-9][0-9]*',
                            ],
                        'defaults' => [
                            'controller' => CrudController::class,
                            'action' => 'delete',
                        ],
                        ],
                    ],
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => 'add',
                            'defaults' => [
                                'controller' => CrudController::class,
                                'action' => 'add',
                            ],
                        ],
                    ],
                ],
            ],
            'detail' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/details/:id',
                    'constraints' => [
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller' => AlbumController::class,
                        'action' => 'detail',
                    ],
                ],
            ],
        ],
    ],

    'service_manager' => [
      'factories' => [
        AlbumRepositoryInterface::class => AlbumRepositoryFactory::class,
          PostCommandInterface::class => PostCommandFactory::class,
      ],
    ],

    'controllers' => [
        'factories' => [
            AlbumController::class => AlbumControllerFactory::class,
            CrudController::class => CrudControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/album'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
