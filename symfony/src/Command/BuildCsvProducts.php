<?php

namespace App\Command;

use App\Service\DataBuilder;
use App\Service\FileBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class BuildCsvProducts extends Command
{
    protected static $defaultName = 'app:build-csv-products';
    protected static $defaultDescription = 'Build CSV file from couch base';
    /**
     * @var FileBuilder
     */
    private FileBuilder $fileBuilder;


    /**
     * BuildCsvCommand constructor.
     * @param FileBuilder $fileBuilder
     */
    public function __construct(FileBuilder $fileBuilder)
    {
        parent::__construct();

        $this->fileBuilder = $fileBuilder;
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
      $this->fileBuilder->createFileCsvFromProducts();


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
