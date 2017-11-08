<?php

namespace Factory;

use BeSimple\SoapClient\SoapClient;
use BeSimple\SoapClient\SoapClientBuilder;
use BeSimple\SoapClient\SoapClientOptionsBuilder;
use BeSimple\SoapCommon\SoapOptionsBuilder;

class SoapClientFactory
{

	/**
	 * @param string $path
	 * @return SoapClient
	 */
	public static function create(string $path): SoapClient
	{
		$soapClientBuilder = new SoapClientBuilder();
		$soapClient = $soapClientBuilder->build(
			SoapClientOptionsBuilder::createWithDefaults(),
			SoapOptionsBuilder::createWithDefaults($path)
		);
		return $soapClient;
	}

}