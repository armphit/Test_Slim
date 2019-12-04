<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require './vendor/autoload.php';

$app = new \Slim\App;

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST');
});

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write(json_encode("love fuck ghost"));
    return $response;
});

$app->post('/login', \App\Controller\Member::class . ":login");

$app->group('/admin', function ($app) {
    $app->get('/ongetgroupchange', \App\Controller\Admin::class . ":ongetgroupchange");
    $app->get('/ongetmajor', \App\Controller\Admin::class . ":ongetmajor");
    $app->get('/ondeletegroup/{delete_group}', \App\Controller\Admin::class . ":ondeletegroup");
    $app->get('/ongetgroup_teacher', \App\Controller\Admin::class . ":ongetgroup_teacher");
    $app->get('/ongetgroup_notNULL', \App\Controller\Admin::class . ":ongetgroup_notNULL");

});

$app->run();
