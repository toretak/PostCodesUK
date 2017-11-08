<?php

namespace PostCodes;


use BeSimple\SoapClient\SoapClient;
use Exceptions\InvalidResponseException;
use Factory\SoapClientFactory;

class PostCodesUK
{
	/**
	 * @var SoapClient
	 */
	private $soapClient;

	/**
	 * ugly WSDL URL
	 * @TODO config file
	 * @var string
	 */
	private $ukPostCodesSourceWsdl = "http://www.webservicex.net/uklocation.asmx?WSDL";

	/**
	 * UK PostCodes provider
	 * @return
	 */
	public function getSoapClient(): SoapClient
	{
		if ($this->soapClient instanceof SoapClient) {
			return $this->soapClient;
		}
		$this->soapClient = SoapClientFactory::create($this->ukPostCodesSourceWsdl);
		return $this->soapClient;
	}

	/**
	 * @param Location[] $cityName
	 * @return string
	 * @throws \Exceptions\InvalidResponseException
	 */
	public function getPostCodeByCityName(string $cityName)
	{
		$soapClient = $this->getSoapClient();
		$getUKLocationByTownRequest = new GetUKLocationByTown();
		$getUKLocationByTownRequest->setTown($cityName);
		$soapResponse = $soapClient->soapCall('GetUKLocationByTown', [$getUKLocationByTownRequest]);

		$responseObject = $soapResponse->getContentDocument()->getElementsByTagName('GetUKLocationByTownResult')->item(0);
		$this->validateLocationResponse($responseObject);

		$xmlObject = new \SimpleXMLElement($responseObject->lastChild->textContent);
		$dataSet = $xmlObject->xpath('/NewDataSet/Table');
		$locations = [];
		foreach ($dataSet as $locationItem) {
			$locations[] = new Location($locationItem->Town, $locationItem->County, $locationItem->PostCode);
		}
		return $locations;
	}

	/**
	 * @param $responseObject
	 * @throws InvalidResponseException
	 */
	private function validateLocationResponse($responseObject)
	{
		if (empty($responseObject)) {
			throw new InvalidResponseException('Server returns empty response');
		}
		if (empty($responseObject->lastChild)) {
			throw new InvalidResponseException('Server returns weird response');
		}
		if (empty($responseObject->lastChild->textContent)) {
			throw new InvalidResponseException('Server returns something, but I don\'t understand him: \n' . $responseObject->lastChild->textContent);
		}
	}

}