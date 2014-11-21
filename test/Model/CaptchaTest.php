<?php

use Captcha\Model\Captcha as Captcha;

class CaptchaTest extends PHPUnit_Framework_TestCase {
	function testLeftOperandBe1WhenInputIs1111() {
		$captcha = new Captcha(1,1,1,1);
		$this->assertEquals("1", $captcha->getLeftOperand());
	}

	function testLeftOperandBe9WhenInputIs1911() {
		$captcha = new Captcha(1,9,1,1);
		$this->assertEquals("9", $captcha->getLeftOperand());
	}
	
	function testRightOperandBe1WhenInputIs1111() {
		$captcha = new Captcha(1,1,1,1);
		$this->assertEquals("One", $captcha->getRightOperand());	
	}

	function testRightOperandBe7WhenInputIs1117() {
		$captcha = new Captcha(1,1,1,7);
		$this->assertEquals("Seven", $captcha->getRightOperand());	
	}

	function testOperatorBe1WhenInputIs1111() {
		$captcha = new Captcha(1,1,1,1);
		$this->assertEquals("+", $captcha->getOperator());	
	}

	function testOperatorBe2WhenInputIs1121() {
		$captcha = new Captcha(1,1,2,5);
		$this->assertEquals("*", $captcha->getOperator());	
	}

	function testOperatorBe3WhenInputIs1131() {
		$captcha = new Captcha(1,1,3,5);
		$this->assertEquals("-", $captcha->getOperator());	
	}

	function testPatternBe1WhenInputIs1111() {
		$captcha = new Captcha(1,1,1,1);
		$this->assertEquals("One", $captcha->getRightOperand());
	}

	function testPatternBe2WhenInputIs2111() {
		$captcha = new Captcha(2,1,1,1);
		$this->assertEquals("One", $captcha->getLeftOperand());
	}

	function testCaptchaStringShouldBe1PlusOneWhenInputIs1111()
	{
		$captcha = new Captcha(1,1,1,1);
		$this->assertEquals("1 + One", $captcha->getCaptchaString());
	}










}