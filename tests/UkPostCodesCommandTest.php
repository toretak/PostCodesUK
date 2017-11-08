<?php

use Command\UkPostCodesCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

require_once __DIR__ . '/../vendor/autoload.php';

class UkPostCodesCommandTest extends \PHPUnit_Framework_TestCase
{

	public function testCorrectCities()
	{

		$application = new Application();
		$application->add(new UkPostCodesCommand());

		$command = $application->find('PostCodes:UK');
		$commandTester = new CommandTester($command);
		$commandTester->execute(array(
			'command' => $command->getName(),
			'Cities' => 'London,Cambridge'
		));

		$this->assertRegExp('/results for \"Cambridge\"/', $commandTester->getDisplay());
		$this->assertRegExp('/results for \"London\"/', $commandTester->getDisplay());

	}

	public function testInvalidCountOfCities()
	{

		$application = new Application();
		$application->add(new UkPostCodesCommand());

		$command = $application->find('PostCodes:UK');
		$commandTester = new CommandTester($command);
		$commandTester->execute(array(
			'command' => $command->getName(),
			'Cities' => 'London'
		));

		$this->assertEquals(1, $commandTester->getStatusCode());

	}

}
