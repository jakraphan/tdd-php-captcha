<?php

namespace Captcha\Controller;
use Captcha\Service\CaptchaService;

class CaptchaController
{
	function __construct($captchaService)
	{
		$this->service = $captchaService;
	}

	function getCaptcha()
	{
		$captcha = $this->service->getCaptcha();
		
		return $captcha;
	}
}