<?php

namespace PostCodes;


class Location
{

	/**
	 * @var string
	 */
	private $town;

	/**
	 * @var string
	 */
	private $country;

	/**
	 * @var string
	 */
	private $postcode;

	/**
	 * Location constructor.
	 * @param string $town
	 * @param string $country
	 * @param string $postcode
	 */
	public function __construct($town, $country, $postcode)
	{
		$this->town = $town;
		$this->country = $country;
		$this->postcode = $postcode;
	}

	/**
	 * @return string
	 */
	public function getTown(): string
	{
		return $this->town;
	}

	/**
	 * @return string
	 */
	public function getCountry(): string
	{
		return $this->country;
	}

	/**
	 * @return string
	 */
	public function getPostcode(): string
	{
		return $this->postcode;
	}

	public function __toString(): string
	{
		return 'City: ' . $this->town . ' in country ' . $this->country . ' has a postcode: ' . $this->postcode;
	}

}