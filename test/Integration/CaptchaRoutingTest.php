<?php

use Silex\WebTestCase;

class CaptchaRoutingTest extends WebTestCase
{
	function createApplication()
	{
		require __DIR__ . '/../../routing.php';
		return $app;
	}

	function testInitialRequest()
	{
		$client = $this->createClient();
    	$crawler = $client->request('GET', '/');

    	$this->assertTrue($client->getResponse()->isOk());
	}

	function testGetApiCaptchaShouldBeOk()
	{
		$client = $this->createClient();
    	$crawler = $client->request('GET', '/api/captcha');

    	$this->assertTrue($client->getResponse()->isOk());
	}

	function testGetCaptchaShouldBeCaptchaString()
	{
		$client = $this->createClient();
    	$crawler = $client->request('GET', '/api/captcha');
    	$regex = "/^([1-9]|(One|Two|Three|Four|Five|Six|Seven|Eight|Nine)) [+\-*] ([1-9]|(One|Two|Three|Four|Five|Six|Seven|Eight|Nine))$/";
    	$this->assertRegExp($regex, $client->getResponse()->getContent());
	}

}