<?php

namespace Command;


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
		$hash = new Hash();
		$input = $input->getArgument('Password');

		$result = $hash->hash($input);

		$output->writeln('Your password hashed: ' . $result);

	}

}