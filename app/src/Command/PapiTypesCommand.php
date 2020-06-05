<?php

namespace App\Command;

use App\Helper\TypeHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PapiTypesCommand extends Command
{
    protected static $defaultName = 'app:papi-types';

    /**
     * @var TypeHelper
     */
    private $typeHelper;

    public function __construct(TypeHelper $typeHelper)
    {
        $this->typeHelper = $typeHelper;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Import types from PokeAPI V2')
            ->setHelp('This command will make a call to PokeAPI V2 types list, to create Types entities in database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Importing types from PokeAPI V2');

        // Use helper method to import types.
        $types = $this->typeHelper->createTypesFromPAPI();

        // Confirm message.
        $io->success(count($types) . ' types successfully imported from PokeAPI V2!');

        return 0;
    }
}
