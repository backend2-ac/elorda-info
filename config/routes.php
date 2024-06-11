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
    $builder->connect('/profile', ['controller' => 'Authors', 'action' => 'profile']);
    $builder->connect('/all', ['controller' => 'Admin', 'action' => 'all']);
    $builder->connect('/edit/*', ['controller' => 'Admin', 'action' => 'edit']);
    $builder->connect('/delete/*', ['controller' => 'Admin', 'action' => 'delete']);
    $builder->connect('/clear-cache', ['controller' => 'Admin', 'action' => 'clearAllCache']);


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


    $builder->connect('/authors', ['controller' => 'Authors', 'action' => 'index']);
    $builder->connect('/authors/:action/*', ['controller' => 'Authors']);

    $builder->connect('/employees', ['controller' => 'Employees', 'action' => 'index']);
    $builder->connect('/employees/:action/*', ['controller' => 'Employees']);


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


$routes->scope('/{lang}', function (RouteBuilder $builder) {

    $builder->connect('/', ['controller' => 'Pages', 'action' => 'home'])
        ->setPass(['lang'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/contact', ['controller' => 'Pages', 'action' => 'contact'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/about', ['controller' => 'Pages', 'action' => 'about'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/rules', ['controller' => 'Pages', 'action' => 'rules'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/anticor', ['controller' => 'Pages', 'action' => 'anticor'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/doc-content', ['controller' => 'Pages', 'action' => 'docContent'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/cooperation', ['controller' => 'Pages', 'action' => 'cooperation'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/update-cache', ['controller' => 'Articles', 'action' => 'updateCache'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/search', ['controller' => 'Articles', 'action' => 'search'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/writer/*', ['controller' => 'Articles', 'action' => 'writer'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/tag/*', ['controller' => 'Articles', 'action' => 'tag'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/articles', ['controller' => 'Articles', 'action' => 'index'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/article/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

//    $builder->connect('/*', ['controller' => 'Articles', 'action' => 'index'])
//        ->setPatterns(['lang' => 'ru|kz|en'])
//        ->setPersist(['lang']);
//
//    $builder->connect('/*/*', ['controller' => 'Articles', 'action' => 'view'])
//        ->setPatterns(['lang' => 'ru|kz|en'])
//        ->setPersist(['lang']);

    $builder->connect('/latest-news', ['controller' => 'Articles', 'action' => 'index', 'latest-news'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/novosti-stolicy-ru', ['controller' => 'Articles', 'action' => 'index', 'novosti-stolicy-ru'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/novosti-stolicy-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/politika-ru', ['controller' => 'Articles', 'action' => 'index', 'politika-ru']);
    $builder->connect('/politika-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/sotsium-ru', ['controller' => 'Articles', 'action' => 'index', 'sotsium-ru']);
    $builder->connect('/sotsium-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/ekonomika-ru', ['controller' => 'Articles', 'action' => 'index', 'ekonomika-ru']);
    $builder->connect('/ekonomika-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/sport-ru', ['controller' => 'Articles', 'action' => 'index', 'sport-ru']);
    $builder->connect('/sport-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/kultura-ru', ['controller' => 'Articles', 'action' => 'index', 'kultura-ru']);
    $builder->connect('/kultura-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/raznoe-ru', ['controller' => 'Articles', 'action' => 'index', 'raznoe-ru']);
    $builder->connect('/raznoe-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/mnenie-ru', ['controller' => 'Articles', 'action' => 'index', 'mnenie-ru']);
    $builder->connect('/mnenie-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/naznacheniya-ru', ['controller' => 'Articles', 'action' => 'index', 'naznacheniya-ru']);
    $builder->connect('/naznacheniya-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/geroi-stolicy-ru', ['controller' => 'Articles', 'action' => 'index', 'geroi-stolicy-ru']);
    $builder->connect('/geroi-stolicy-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/zdoroviye', ['controller' => 'Articles', 'action' => 'index', 'zdoroviye']);
    $builder->connect('/zdoroviye/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/show-biznes-ru', ['controller' => 'Articles', 'action' => 'index', 'show-biznes-ru']);
    $builder->connect('/show-biznes-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/sobytiye', ['controller' => 'Articles', 'action' => 'index', 'sobytiye']);
    $builder->connect('/sobytiye/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/mir', ['controller' => 'Articles', 'action' => 'index', 'mir']);
    $builder->connect('/mir/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/obrazovaniye', ['controller' => 'Articles', 'action' => 'index', 'obrazovaniye']);
    $builder->connect('/obrazovaniye/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/lichnost', ['controller' => 'Articles', 'action' => 'index', 'lichnost']);
    $builder->connect('/lichnost/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/interview-ru', ['controller' => 'Articles', 'action' => 'index', 'interview-ru']);
    $builder->connect('/interview-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/obchestvo', ['controller' => 'Articles', 'action' => 'index', 'obchestvo']);
    $builder->connect('/obchestvo/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/pravitelstvo', ['controller' => 'Articles', 'action' => 'index', 'pravitelstvo']);
    $builder->connect('/pravitelstvo/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/prezident-ru', ['controller' => 'Articles', 'action' => 'index', 'prezident-ru']);
    $builder->connect('/prezident-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/akorda-ru', ['controller' => 'Articles', 'action' => 'index', 'akorda-ru']);
    $builder->connect('/akorda-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/zasedaniye', ['controller' => 'Articles', 'action' => 'index', 'zasedaniye']);
    $builder->connect('/zasedaniye/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/senat-ru', ['controller' => 'Articles', 'action' => 'index', 'senat-ru']);
    $builder->connect('/senat-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/sluzhba-komplaens-ru', ['controller' => 'Articles', 'action' => 'index', 'sluzhba-komplaens-ru']);
    $builder->connect('/sluzhba-komplaens-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/poslanie-ru', ['controller' => 'Articles', 'action' => 'index', 'poslanie-ru']);
    $builder->connect('/poslanie-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/kodeks-etiki', ['controller' => 'Articles', 'action' => 'index', 'kodeks-etiki']);
    $builder->connect('/kodeks-etiki/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/parlament-ru', ['controller' => 'Articles', 'action' => 'index', 'parlament-ru']);
    $builder->connect('/parlament-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/video-ru', ['controller' => 'Articles', 'action' => 'index', 'video-ru']);
    $builder->connect('/video-ru/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/sluzhu-strane', ['controller' => 'Articles', 'action' => 'index', 'sluzhu-strane']);
    $builder->connect('/sluzhu-strane/*', ['controller' => 'Articles', 'action' => 'view'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);
    $builder->connect('/{category}/{slug}', ['controller' => 'Articles', 'action' => 'view'])
        ->setPass(['slug'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/*', ['controller' => 'Articles', 'action' => 'tag'])
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
    $builder->connect('/anticor', ['controller' => 'Pages', 'action' => 'anticor']);
    $builder->connect('/doc-content', ['controller' => 'Pages', 'action' => 'docContent']);

    $builder->connect('/update-cache', ['controller' => 'Articles', 'action' => 'updateCache']);
    $builder->connect('/search', ['controller' => 'Articles', 'action' => 'search']);
    $builder->connect('/tag/*', ['controller' => 'Articles', 'action' => 'tag']);
    $builder->connect('/writer/*', ['controller' => 'Articles', 'action' => 'writer']);
    $builder->connect('/articles', ['controller' => 'Articles', 'action' => 'index']);
    $builder->connect('/article/*', ['controller' => 'Articles', 'action' => 'view']);

         $builder->connect('/get/article/*', ['controller' => 'Articles', 'action' => 'loadingview'])
        ->setPatterns(['lang' => 'ru|kz|en'])
        ->setPersist(['lang']);

    $builder->connect('/latest-news', ['controller' => 'Articles', 'action' => 'index', 'latest-news']);
    $builder->connect('/elorda-janalyktary', ['controller' => 'Articles', 'action' => 'index', 'elorda-janalyktary']);
    $builder->connect('/elorda-janalyktary/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/sayasat', ['controller' => 'Articles', 'action' => 'index', 'sayasat']);
    $builder->connect('/sayasat/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/bilim', ['controller' => 'Articles', 'action' => 'index', 'bilim']);
    $builder->connect('/bilim/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/aleumet', ['controller' => 'Articles', 'action' => 'index', 'aleumet']);
    $builder->connect('/aleumet/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/ekonomika', ['controller' => 'Articles', 'action' => 'index', 'ekonomika']);
    $builder->connect('/ekonomika/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/sport', ['controller' => 'Articles', 'action' => 'index', 'sport']);
    $builder->connect('/sport/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/madeniet', ['controller' => 'Articles', 'action' => 'index', 'madeniet']);
    $builder->connect('/madeniet/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/ar-turli', ['controller' => 'Articles', 'action' => 'index', 'ar-turli']);
    $builder->connect('/ar-turli/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/kozkaras', ['controller' => 'Articles', 'action' => 'index', 'kozkaras']);
    $builder->connect('/kozkaras/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/tagaiyndau', ['controller' => 'Articles', 'action' => 'index', 'tagaiyndau']);
    $builder->connect('/tagaiyndau/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/elorda-erzhyrektery', ['controller' => 'Articles', 'action' => 'index', 'elorda-erzhyrektery']);
    $builder->connect('/elorda-erzhyrektery/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/astana-25', ['controller' => 'Articles', 'action' => 'index', 'astana-25']);
    $builder->connect('/astana-25/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/showbiz', ['controller' => 'Articles', 'action' => 'index', 'showbiz']);
    $builder->connect('/showbiz/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/densaulyk', ['controller' => 'Articles', 'action' => 'index', 'densaulyk']);
    $builder->connect('/densaulyk/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/alem', ['controller' => 'Articles', 'action' => 'index', 'alem']);
    $builder->connect('/alem/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/parlament', ['controller' => 'Articles', 'action' => 'index', 'parlament']);
    $builder->connect('/parlament/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/senat', ['controller' => 'Articles', 'action' => 'index', 'senat']);
    $builder->connect('/senat/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/mazhilis', ['controller' => 'Articles', 'action' => 'index', 'mazhilis']);
    $builder->connect('/mazhilis/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/akorda', ['controller' => 'Articles', 'action' => 'index', 'akorda']);
    $builder->connect('/akorda/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/prezident', ['controller' => 'Articles', 'action' => 'index', 'prezident']);
    $builder->connect('/prezident/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/ukimet', ['controller' => 'Articles', 'action' => 'index', 'ukimet']);
    $builder->connect('/ukimet/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/kogam', ['controller' => 'Articles', 'action' => 'index', 'kogam']);
    $builder->connect('/kogam/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/sukhbat', ['controller' => 'Articles', 'action' => 'index', 'sukhbat']);
    $builder->connect('/sukhbat/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/tulga', ['controller' => 'Articles', 'action' => 'index', 'tulga']);
    $builder->connect('/tulga/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/adep-kodeksi', ['controller' => 'Articles', 'action' => 'index', 'adep-kodeksi']);
    $builder->connect('/adep-kodeksi/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/sluzhba-komplaens-kz', ['controller' => 'Articles', 'action' => 'index', 'sluzhba-komplaens-kz']);
    $builder->connect('/sluzhba-komplaens-kz/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/joldau', ['controller' => 'Articles', 'action' => 'index', 'joldau']);
    $builder->connect('/joldau/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/video', ['controller' => 'Articles', 'action' => 'index', 'video']);
    $builder->connect('/video/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/okiga', ['controller' => 'Articles', 'action' => 'index', 'okiga']);
    $builder->connect('/okiga/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/elorda-yzdikteri', ['controller' => 'Articles', 'action' => 'index', 'elorda-yzdikteri']);
    $builder->connect('/elorda-yzdikteri/*', ['controller' => 'Articles', 'action' => 'view']);

    $builder->connect('/elge-kyzmet', ['controller' => 'Articles', 'action' => 'index', 'elge-kyzmet']);
    $builder->connect('/elge-kyzmet/*', ['controller' => 'Articles', 'action' => 'view']);
    $builder->connect('/*', ['controller' => 'Articles', 'action' => 'tag']);

//    $builder->connect('/:slug', ['controller' => 'Articles', 'action' => 'index'])
//        ->setPass(['slug']);
//
//    $builder->connect('/:slug/*', ['controller' => 'Articles', 'action' => 'view'])
//        ->setPass(['slug']);

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
