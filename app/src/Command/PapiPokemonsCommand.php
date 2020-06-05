<?php

namespace App\Command;

use App\Helper\PokemonHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PapiPokemonsCommand extends Command
{
    protected static $defaultName = 'app:papi-pokemons';

    /**
     * Number of pokemons to be imported in one batch.
     */
    const PER_BATCH_LIMIT = 20;

    /**
     * @var PokemonHelper
     */
    private $pokemonHelper;

    public function __construct(PokemonHelper $pokemonHelper)
    {
        $this->pokemonHelper = $pokemonHelper;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Import pokemons from PokeAPI V2')
            ->setHelp('This command will make a call to PokeAPI V2 pokemons list (pokemon & pokemon-species), to create Pokemons entities in database.')
            ->addArgument('offset', InputArgument::REQUIRED, 'First Pokemon to import.')
            ->addArgument('limit', InputArgument::REQUIRED, 'Number of Pokemon to import.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Importing pokemons from PokeAPI V2');

        // Calculate batches.
        // @todo, use offset to be able to import 2nd gen pokemons only.
        $offset = $input->getArgument('offset');
        $limit = $input->getArgument('limit');
        $batchNumber = floor($limit / self::PER_BATCH_LIMIT);

        // Use helper method to import pokemons per batches.
        $pokemons = [];
        for ($i=0; $i<$batchNumber; $i++) {
            $offsetBatch = $offset + ($i*self::PER_BATCH_LIMIT);
            $io->writeln([
                'Importing ' . self::PER_BATCH_LIMIT . ' pokemons from ' . sprintf("%'.03d\n", $offsetBatch+1),
                '==============================',
            ]);
            $pokemons = array_merge($pokemons, $this->pokemonHelper->createPokemonsFromPAPI(self::PER_BATCH_LIMIT, $offsetBatch));
        }

        // Last batch is off loop to complete import process, if necessary only.
        if ($lastBatchLimit = $limit % self::PER_BATCH_LIMIT) {
            $offsetLastBatch = $offset + ($batchNumber*self::PER_BATCH_LIMIT);
            $io->writeln([
                'Importing ' . $lastBatchLimit . ' pokemons from ' . sprintf("%'.03d\n", $offsetLastBatch+1),
                '==============================',
            ]);
            $pokemons = array_merge($pokemons, $this->pokemonHelper->createPokemonsFromPAPI($lastBatchLimit, $offsetLastBatch));
        }

        // Confirm message.
        $firstPkmn = $pokemons[0];
        $lastPkmn = end($pokemons);
        $io->success(count($pokemons) . ' pokemons successfully imported from PokeAPI V2, from ' . $firstPkmn . ' to ' . $lastPkmn . '!');
        return 0;
    }
}
