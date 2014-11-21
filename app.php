<?php
require_once 'vendor/autoload.php';
use Captcha\Controller\CaptchaController;
use Captcha\Service\CaptchaService;

$app = new Silex\Application();
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app['captcha.service'] = $app->share(function() {
    return new CaptchaService;
});

$app['captcha.controller'] = $app->share(function() use ($app) {
    return new CaptchaController($app['captcha.service']);
});
