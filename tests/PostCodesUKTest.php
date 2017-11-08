<?php

use PostCodes\PostCodesUK;

class PostCodesUKTest extends PHPUnit_Framework_TestCase
{
	private static $CORRECT_PATH = 'http://www.webservicex.net/uklocation.asmx?WSDL';
	private static $INVALID_PATH = 'http://www.nosuchserverexist.tld/doesnotexist.endpoint';


	public function testGetCityLocations()
	{
		$postCodesUK = new PostCodesUK();
		$postCodesUK->setUkPostCodesSourceWsdl(self::$CORRECT_PATH);
		$array = $postCodesUK->getPostCodeByCityName('London');
		$this->assertInternalType('array', $array);
		$this->assertInstanceOf(\PostCodes\Location::class, $array[0]);
	}

	public function testInvalidPath()
	{
		$this->expectException(\Exceptions\InvalidResponseException::class);
		$postCodesUK = new PostCodesUK();
		$postCodesUK->setUkPostCodesSourceWsdl(self::$INVALID_PATH);
		$postCodesUK->getPostCodeByCityName('London');
	}

}
