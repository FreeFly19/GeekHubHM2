<?php

require_once __DIR__.'/../vendor/autoload.php';

//Костиль :Р
require_once __DIR__.'/../Provider/VK/VKService.php';
require_once __DIR__.'/../Provider/VK/User.php';
require_once __DIR__.'/../Provider/VK/Post.php';
//КостильEND


$app = new Silex\Application();
$vk = new Provider\VK\VKService(new \VK\VK(null, null));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->get('/group/{id}/posts', function ($id) use ($app,$vk) {
    return json_encode($vk->getGroupPosts($id));
});

$app->run();