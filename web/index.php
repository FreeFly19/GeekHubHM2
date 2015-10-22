<?php

require_once __DIR__ . '/../vendor/autoload.php';


$app = new Silex\Application();
$vk = new VKProvider\VKService(new VK\VK(null, null));

$app->register(
    new Silex\Provider\TwigServiceProvider(),
    ['twig.path' => __DIR__ . '/../views']
);

$app->get(
    '/',
    function () use ($app, $vk) {
        return $app['twig']->render('index.html.twig');
    }
);

$app->get(
    '/group/{id}/posts',
    function ($id) use ($app, $vk) {
        return json_encode($vk->getGroupPosts($id));
    }
);

$app->run();