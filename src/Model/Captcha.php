<?php

namespace Captcha\Model;

class Captcha {
	const NUM_AND_STR_PATTERN = 1;
	const STR_AND_NUM_PATTERN = 2;

	var $numstr =  array(
		'Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'
	);

	var $arr_operator = array(
		1 => '+',
		2 => '*',
		3 => '-'
	);

	private function num2str($num) {
		return $this->numstr[$num];
	}

	public function __construct($pattern, $leftOperand, $operator, $rightOperand) {
		$this->leftOperand = $leftOperand;
		$this->rightOperand = $rightOperand;
		$this->operator = $operator;
		$this->pattern = $pattern;
	}

	public function getLeftOperand() {
		if ($this->pattern == self::STR_AND_NUM_PATTERN) {
			return $this->num2str($this->leftOperand);
		}
		return $this->leftOperand;
	}

	public function getRightOperand() {
		if ($this->pattern == self::NUM_AND_STR_PATTERN) {
			return $this->num2str($this->rightOperand);
		}
		return $this->rightOperand;
	}

	public function getOperator(){
		return $this->arr_operator[ $this->operator ];
	}

	public function getCaptchaString()
	{
		return $this->getLeftOperand() . ' ' . $this->getOperator() . ' ' . $this->getRightOperand();
	}
}