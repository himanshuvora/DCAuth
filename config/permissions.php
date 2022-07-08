<?php

use CakeDC\Auth\Rbac\Rules\Owner;

return [
    'CakeDC/Auth.permissions' => [
        [
            'role' => '*',
            'controller' => 'Users',
            'action' => ['login', 'logout', 'register'],
            'bypassAuth' => true
        ],
        [
            'role' => 'admin',
            'controller' => '*',
            'action' => '*',
        ],
        [
            'role' => 'user',
            'controller' => ['Posts'],
            'action' => ['add', 'view', 'index'],
        ],
        [
            'role' => 'user',
            'controller' => ['Posts'],
            'action' => ['edit', 'delete'],
            'allowed' => new Owner()
        ]
    ]
];
