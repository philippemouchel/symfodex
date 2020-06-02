<?php

namespace App\Helper;

use App\Entity\Category;
use App\Entity\Pokemon;
use App\Entity\Type;
use Doctrine\Persistence\ManagerRegistry;
use UnitConverter\UnitConverter;

class PokemonHelper
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var UnitConverter
     */
    private $converter;

    public function __construct()
    {
        $this->data = $this->getDataFromArray();
        $this->converter = UnitConverter::createBuilder()
            ->addSimpleCalculator()
            ->addDefaultRegistry()
            ->build();
    }

    /**
     * Return data property as an array,
     * containing each pokemon in english and french.
     * @return string[][][]
     */
    private function getDataFromArray()
    {
        return [
            [
                'en' => [
                    'number' => 1,
                    'name' => 'Bulbasaur',
                    'description' => 'Bulbasaur can be seen napping in bright sunlight. There is a seed on its back. By soaking up the sun\'s rays, the seed grows progressively larger.',
                    'height' => 700,
                    'weight' => 6900,
                    'type' => ['Grass', 'Poison'],
                    'category' => 'Seed',
                ],
                'fr' => [
                    'name' => 'Bulbizarre',
                    'description' => 'Bulbizarre passe son temps à faire la sieste sous le soleil. Il y a une graine sur son dos. Il absorbe les rayons du soleil pour faire doucement pousser la graine.',
                ],
            ],
        ];
    }

    /**
     * Create pokemons.
     * @param ManagerRegistry $doctrine
     * @return array
     */
    public function createPokemons(ManagerRegistry $doctrine)
    {
        $pokemons = [];
        $entityManager = $doctrine->getManager();
        $typeRepository = $doctrine->getRepository(Type::class);
        $categoryRepository = $doctrine->getRepository(Category::class);

        // Load a specific repository to persist multilingual entities.
        $translationRepository = $entityManager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        foreach ($this->data as $data) {

            // Instantiate and set properties for english pokemon (assuming it's default locale).
            $pokemon = new Pokemon();
            $pokemon->setNumber($data['en']['number']);
            $pokemon->setName($data['en']['name']);
            $pokemon->setDescription($data['en']['description']);
            $pokemon->setHeight($data['en']['height']);
            $pokemon->setWeight($data['en']['weight']);

            // Create relations to type and category entities.
            foreach ($data['en']['type'] as $typeName) {
                if ($type = $typeRepository->findOneBy(['name' => $typeName])) {
                    $pokemon->addType($type);
                    $type->addPokemon($pokemon);
                    $entityManager->persist($type);
                }
            }
            if ($category = $categoryRepository->findOneBy(['name' => $data['en']['category']])) {
                $pokemon->setCategory($category);
            }

            // Provide french translation.
            $translationRepository->translate($pokemon, 'name', 'fr', $data['fr']['name']);
            $translationRepository->translate($pokemon, 'description', 'fr', $data['fr']['description']);

            $entityManager->persist($pokemon);
            $pokemons[] = $pokemon;
        }

        // Store everything in database.
        $entityManager->flush();

        // Return newly created pokemons.
        return $pokemons;
    }

    /**
     * Return formatted height depending on locale.
     *
     * @param string $locale
     * @param Pokemon $pokemon
     * @return string
     */
    public function getHeightByLocale(string $locale, Pokemon $pokemon)
    {
        // Return different format and unit, based on locale.
        switch ($locale) {

            // English: unit is feet
            case 'en':

                // Convert to feet, then convert feet decimal to inches.
                $ftVal = $this->converter->convert($pokemon->getHeight())->from('mm')->to('ft');
                $ft = floor($ftVal);
                $ftDec = $ftVal - $ft;
                $in = round($this->converter->convert($ftDec)->from('ft')->to('in'));

                // If 12 inches after round, simply add one foot.
                if ($in == 12) {
                    $ft++;
                    $in = 0;
                }

                return $ft . '\' ' . sprintf("%'.02d", $in) . '"';

            // French (& fallback): unit is meters
            case 'fr':
            default:
                return $this->converter->convert($pokemon->getHeight())->from('mm')->to('m') . ' m';
        }
    }

    /**
     * Return formatted weight depending on locale.
     *
     * @param string $locale
     * @param Pokemon $pokemon
     * @return string
     */
    public function getWeightByLocale(string $locale, Pokemon $pokemon)
    {
        // Return different format and unit, based on locale.
        switch ($locale) {

            // English: unit is pounds
            case 'en':
                return round($this->converter->convert($pokemon->getWeight())->from('g')->to('lb'), 1) . ' lbs';

            // French (& fallback): unit is kilograms
            case 'fr':
            default:
                return $this->converter->convert($pokemon->getWeight())->from('g')->to('kg') . ' kg';
        }
    }
}
