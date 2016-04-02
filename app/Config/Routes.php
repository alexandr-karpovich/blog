<?php

/**
 * Routes
 */


return [
    '/' => [
        'controller' => \Controller\DefaultController::class,
        'action' => 'indexAction'
    ],
    '/post/list' => [
        'controller' => \Controller\PostController::class,
        'action' => 'listAction'
    ],
    '/post/view' => [
        'controller' => \Controller\PostController::class,
        'action' => 'viewAction',
    ],
    '/post/edit' => [
        'controller' => \Controller\PostController::class,
        'action' => 'editAction'
    ],
    '/post/delete' => [
        'controller' => \Controller\PostController::class,
        'action' => 'deleteAction'
    ],
    '/post/create' => [
        'controller' => \Controller\PostController::class,
        'action' => 'createAction'
    ],
];


