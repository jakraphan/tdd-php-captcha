<?php

namespace Captcha\Model;

class Randomizer
{	
	function getRandomPattern()
	{
		return rand( 1, 2 );
	}

	function getRandomOperand()
	{
		return rand( 1, 9 );
	}

	function getRandomOperator()
	{
		return rand( 1, 3 );
	}
}