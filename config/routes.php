<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;


/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 */
/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

// Route static method
Router::connect('/second-route', [
    'controller' => 'First', 
    'action' => 'secondRoute',
]);


// PREFIX Routing

Router::prefix('Admin', function(RouteBuilder $builder){

    $builder->connect('/logout', ['controller' => 'Admin', 'action' => 'logout']);
    $builder->connect('/add', ['controller' => 'Admin', 'action' => 'add']);
    $builder->connect('/all', ['controller' => 'Admin', 'action' => 'all']);
    $builder->connect('/edit/*', ['controller' => 'Admin', 'action' => 'edit']);
    $builder->connect('/delete/*', ['controller' => 'Admin', 'action' => 'delete']);

    $builder->connect('/', ['controller' => 'Admin', 'action' => 'index']);

    $builder->connect('/categories', ['controller' => 'Categories', 'action' => 'index']);
    $builder->connect('/categories/:action/*', ['controller' => 'Categories']);

    $builder->connect('/articles', ['controller' => 'Articles', 'action' => 'index']);
    $builder->connect('/articles/:action/*', ['controller' => 'Articles']);

    $builder->connect('/tags', ['controller' => 'Tags', 'action' => 'index']);
    $builder->connect('/tags/:action/*', ['controller' => 'Tags']);

    $builder->connect('/branches', ['controller' => 'Branches', 'action' => 'index']);
    $builder->connect('/branches/:action/*', ['controller' => 'Branches']);


    $builder->connect('/articles_tags', ['controller' => 'ArticlesTags', 'action' => 'index']);
    $builder->connect('/articles_tags/:action/*', ['controller' => 'ArticlesTags']);

    $builder->connect('/rubrics', ['controller' => 'Rubrics', 'action' => 'index']);
    $builder->connect('/rubrics/:action/*', ['controller' => 'Rubrics']);

    $builder->connect('/authors', ['controller' => 'Authors', 'action' => 'index']);
    $builder->connect('/authors/:action/*', ['controller' => 'Authors']);

    $builder->connect('/employees', ['controller' => 'Employees', 'action' => 'index']);
    $builder->connect('/employees/:action/*', ['controller' => 'Employees']);

    $builder->connect('/blocks', ['controller' => 'Blocks', 'action' => 'index']);
    $builder->connect('/blocks/:action/*', ['controller' => 'Blocks']);

    $builder->connect('/documents', ['controller' => 'Documents', 'action' => 'index']);
    $builder->connect('/documents/:action/*', ['controller' => 'Documents']);





    $builder->connect('/pages', ['controller' => 'Pages', 'action' => 'index']);
    $builder->connect('/pages/:action/*', ['controller' => 'Pages']);

    $builder->connect('/comps', ['controller' => 'Comps', 'action' => 'index']);
    $builder->connect('/comps/:action/*', ['controller' => 'Comps']);

    $builder->connect('/requests', ['controller' => 'Requests', 'action' => 'index']);
    $builder->connect('/requests/:action/*', ['controller' => 'Requests']);

    $builder->fallbacks();
});

// Router::prefix('Users', function(RouteBuilder $builder){
//     $builder->connect('/login', ['controller' => 'Users', 'action' => 'login']);
//     $builder->connect('/registration', ['controller' => 'Users', 'action' => 'registration']);
//     $builder->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
//     // $builder->connect('/:action', ['controller' => 'Users']);

//     $builder->fallbacks();
// });


$routes->scope('/{lang}', function (RouteBuilder $builder) {

    $builder->connect('/', ['controller' => 'Pages', 'action' => 'home'])
        ->setPass(['lang'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/about', ['controller' => 'Pages', 'action' => 'about'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/rules', ['controller' => 'Pages', 'action' => 'rules'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);


    $builder->connect('/cooperation', ['controller' => 'Pages', 'action' => 'cooperation'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);


    $builder->connect('/search', ['controller' => 'Articles', 'action' => 'search'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
$builder->connect('/redactor/*', ['controller' => 'Articles', 'action' => 'redactor'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/articles', ['controller' => 'Articles', 'action' => 'index'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/article/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);



    $builder->connect('/news', ['controller' => 'Articles', 'action' => 'index', 'news'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/news/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/reviews', ['controller' => 'Articles', 'action' => 'index', 'reviews'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/review/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/opinions', ['controller' => 'Articles', 'action' => 'index', 'opinions'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/opinion/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);


    $builder->connect('/feedbacks', ['controller' => 'Articles', 'action' => 'index', 'feedbacks'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/feedback/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);


    $builder->connect('/requests/:action', ['controller' => 'Requests'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);


    $builder->fallbacks();
});

$routes->scope('/', function (RouteBuilder $builder) {

    $builder->connect('/', ['controller' => 'Pages', 'action' => 'home']);
    $builder->connect('/about', ['controller' => 'Pages', 'action' => 'about']);
    $builder->connect('/rules', ['controller' => 'Pages', 'action' => 'rules']);
    $builder->connect('/cooperation', ['controller' => 'Pages', 'action' => 'cooperation']);

    $builder->connect('/contact', ['controller' => 'Pages', 'action' => 'contact']);


    $builder->connect('/search', ['controller' => 'Articles', 'action' => 'search']);
$builder->connect('/redactor/*', ['controller' => 'Articles', 'action' => 'redactor']);
    $builder->connect('/articles', ['controller' => 'Articles', 'action' => 'index']);
    $builder->connect('/article/*', ['controller' => 'Articles', 'action' => 'view']);

         $builder->connect('/get/article/*', ['controller' => 'Articles', 'action' => 'loadingview'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);;
        
    $builder->connect('/news-capital', ['controller' => 'Articles', 'action' => 'index', 'news-capital']);
    $builder->connect('/news-capital/*', ['controller' => 'Articles', 'action' => 'view']);
    
    $builder->connect('/politika', ['controller' => 'Articles', 'action' => 'index', 'politika']);
    $builder->connect('/politika/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/news-kz', ['controller' => 'Articles', 'action' => 'index', 'news-kz']);
    $builder->connect('/news-kz/*', ['controller' => 'Articles', 'action' => 'view']);


    $builder->connect('/society', ['controller' => 'Articles', 'action' => 'index', 'society']);
    $builder->connect('/society/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/ekonomika', ['controller' => 'Articles', 'action' => 'index', 'ekonomika']);
    $builder->connect('/ekonomika/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/sport', ['controller' => 'Articles', 'action' => 'index', 'sport']);
    $builder->connect('/sport/*', ['controller' => 'Articles', 'action' => 'view']);


     $builder->connect('/poleznoe', ['controller' => 'Articles', 'action' => 'index', 'poleznoe']);
    $builder->connect('/poleznoe/*', ['controller' => 'Articles', 'action' => 'view']);


     $builder->connect('/mnenie', ['controller' => 'Articles', 'action' => 'index', 'mnenie']);
    $builder->connect('/mnenie/*', ['controller' => 'Articles', 'action' => 'view']);


    $builder->connect('/poslanie', ['controller' => 'Articles', 'action' => 'index', 'poslanie']);
    $builder->connect('/poslanie/*', ['controller' => 'Articles', 'action' => 'view']);


    $builder->connect('/raznoe', ['controller' => 'Articles', 'action' => 'index', 'raznoe']);
    $builder->connect('/raznoe/*', ['controller' => 'Articles', 'action' => 'view']);


    $builder->connect('/kul-tura', ['controller' => 'Articles', 'action' => 'index', 'kul-tura']);
    $builder->connect('/kul-tura/*', ['controller' => 'Articles', 'action' => 'view']);


    $builder->connect('/geroi-stolicy', ['controller' => 'Articles', 'action' => 'index', 'geroi-stolicy']);
    $builder->connect('/geroi-stolicy/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/requests/:action', ['controller' => 'Requests']);

    $builder->fallbacks();
});


/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *     
 *     // Parse specified extensions from URLs
 *     // $builder->setExtensions(['json', 'xml']);
 *     
 *     // Connect API actions here.
 * });
 * ```
 */
