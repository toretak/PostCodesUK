<?php

namespace Command;


use PostCodes\PostCodesUK;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UkPostCodesCommand extends Command
{

	protected function configure()
	{
		$this->setName("PostCodes:UK")
			->setDescription("Get UK post codes to 2 or 3 cities separated by coma.")
			->addArgument('Cities', InputArgument::REQUIRED, 'cities to look up');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$postCodes = new PostCodesUK();
		$input = $input->getArgument('Cities');

		if (strpos($input, ',') === false) {
			$output->writeln('<error>Give me two or three cities (separated by ",") to search postcodes</error>');
			$output->writeln('quit');
			exit(1);
		}
		$cities = explode(',', $input);

		foreach ($cities as $city) {
			/**
			 * @var $result Location[]
			 */
			$result = $postCodes->getPostCodeByCityName($city);

			$output->writeln('<info>found ' . count($result) . ' result' . (count($result) === 1 ? '' : 's') . ' for "' . $city . '"</info>');
			foreach ($result as $location) {
				$output->writeln($location->__toString());
			}
		}
	}

}