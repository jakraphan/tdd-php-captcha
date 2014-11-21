<?php

use Captcha\Service\CaptchaService as CaptchaService;

class CaptchaServiceTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->captchaService = new CaptchaService();
	}

	public function testGetCaptchaStringShouldBe2PlusTwo()
	{
		$stubRandomizer = $this->getMock('Captcha\Model\Randomizer');
		$stubRandomizer
			->expects($this->once())
			->method('getRandomPattern')
            ->willReturn(1);
        $stubRandomizer
        	->expects($this->exactly(2))
			->method('getRandomOperand')
            ->willReturn(2);
        $stubRandomizer
        	->expects($this->once())
			->method('getRandomOperator')
            ->willReturn(1);
		$this->captchaService->setRandomizer( $stubRandomizer );
		
		$captcha = $this->captchaService->getCaptcha();
		
		$this->assertEquals("2 + Two" , $captcha);
	}

	public function testGetCaptchaStringWithoutSetRandomizerShouldNotBeNull()
	{
		$captcha = $this->captchaService->getCaptcha();
		
		$this->assertNotNull($captcha);
	}
}