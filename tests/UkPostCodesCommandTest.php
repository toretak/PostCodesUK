<?php

use Command\UkPostCodesCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

require_once  '../vendor/autoload.php';

class UkPostCodesCommandTest extends \PHPUnit_Framework_TestCase
{


	public function testCorrectCities(){

		$application = new Application();
		$application->add(new UkPostCodesCommand());

		$command = $application->find('PostCodes:UK');
		$commandTester = new CommandTester($command);
		$commandTester->execute(array(
			'command'      => $command->getName(),
			'Cities'         => 'London,Cambridge'
		));

		$this->assertRegExp('/Your password hashed:/', $commandTester->getDisplay());

	}

}
