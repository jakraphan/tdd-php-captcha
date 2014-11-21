<?php

require 'app.php';

$app->get('/api/captcha', "captcha.controller:getCaptcha");

$app->get('/', function() {
	return 'Hello World!';
});

$app->run();