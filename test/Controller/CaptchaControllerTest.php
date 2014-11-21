<?php

use Captcha\Controller\CaptchaController;

class CaptchaControllerTest extends PHPUnit_Framework_TestCase
{
	function testGetCaptcha()
	{
		$stubCaptchaService = $this->getMock('Captcha\Service\CaptchaService');
		$stubCaptchaService
			->expects($this->once())
			->method('getCaptcha')
            ->willReturn('1 + One');

		$captchaController = new CaptchaController($stubCaptchaService);
		$captcha = $captchaController->getCaptcha();

		$this->assertEquals('1 + One', $captcha);
	}
}