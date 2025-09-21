<?php
/**
 * Route Definitions
 */

return [
    '' => ['controller' => 'Home', 'action' => 'index'],
    'login' => ['controller' => 'Auth', 'action' => 'login'],
    'register' => ['controller' => 'Auth', 'action' => 'register'],
    'forgot-password' => ['controller' => 'Auth', 'action' => 'forgotPassword'],
    'logout' => ['controller' => 'Auth', 'action' => 'logout'],

    // User routes
    'dashboard' => ['controller' => 'User', 'action' => 'dashboard'],
    'profile' => ['controller' => 'User', 'action' => 'profile'],
    'profile/update' => ['controller' => 'User', 'action' => 'updateProfile'],
    'change-password' => ['controller' => 'User', 'action' => 'changePassword'],

    // Ticket routes
    'tickets' => ['controller' => 'Ticket', 'action' => 'index']
];