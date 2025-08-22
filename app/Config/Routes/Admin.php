<?php
$routes->group ('admin', ['namespace'=> 'App\Controllers\Admin'], function ($routes) {
    //Routes vers dashboard
    $routes->get('dashboard', 'Admin::dashboard');
});