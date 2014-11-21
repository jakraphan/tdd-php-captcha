<?php

namespace Captcha\Service;
use Captcha\Model\Captcha as Captcha;
use Captcha\Model\Randomizer as Randomizer;

class CaptchaService
{
	function __construct()
	{
		$this->randomizer = new Randomizer();
	}

	function setRandomizer( $randomizer )
	{
		$this->randomizer = $randomizer;
	}

	function getCaptcha()
	{
		$leftOperand = $this->randomizer->getRandomOperand();
		$rightOperand = $this->randomizer->getRandomOperand();
		$operator = $this->randomizer->getRandomOperator();
		$pattern = $this->randomizer->getRandomPattern();
		$captcha = new Captcha( $pattern, $leftOperand, $operator, $rightOperand);
		return $captcha->getCaptchaString();
	}
}