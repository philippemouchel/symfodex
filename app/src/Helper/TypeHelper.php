<?php

namespace App\Helper;


use App\Entity\Type;
use Doctrine\Persistence\ManagerRegistry;
use PokePHP\PokeApi;

class TypeHelper
{
    /**
     * PokeAPI V2 connector.
     * @var PokeApi
     */
    private $papi;

    /**
     * @var array
     */
    private $data;

    /**
     * CategoryHelper constructor.
     */
    public function __construct()
    {
        $this->papi = new PokeApi();
        $this->data = $this->getDataFromArray();
    }

    /**
     * Return data property as an array,
     * containing each type in english and french.
     * @return string[][][]
     */
    private function getDataFromArray()
    {
        return [
            'grass' => [
                'en' => [
                    'name' => 'Grass',
                    'color' => '#9bcc50',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Plante',
                ],
            ],
            'poison' => [
                'en' => [
                    'name' => 'Poison',
                    'color' => '#b97fc9',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Poison',
                ],
            ],
            'fire' => [
                'en' => [
                    'name' => 'Fire',
                    'color' => '#fd7d24',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Feu',
                ],
            ],
            'flying' => [
                'en' => [
                    'name' => 'Flying',
                    'color' => '#3dc7ef,#bdb9b8',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Vol',
                ],
            ],
            'water' => [
                'en' => [
                    'name' => 'Water',
                    'color' => '#4592c4',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Eau',
                ],
            ],
            'bug' => [
                'en' => [
                    'name' => 'Bug',
                    'color' => '#729f3f',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Insecte',
                ],
            ],
            'normal' => [
                'en' => [
                    'name' => 'Normal',
                    'color' => '#a4acaf',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Normal',
                ],
            ],
            'electric' => [
                'en' => [
                    'name' => 'Electric',
                    'color' => '#eed535',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Électrik',
                ],
            ],
            'ground' => [
                'en' => [
                    'name' => 'Ground',
                    'color' => '#f7de3f,#ab9842',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Sol',
                ],
            ],
            'fairy' => [
                'en' => [
                    'name' => 'Fairy',
                    'color' => '#fdb9e9',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Fée',
                ],
            ],
            'fighting' => [
                'en' => [
                    'name' => 'Fighting',
                    'color' => '#d56723',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Combat',
                ],
            ],
            'psychic' => [
                'en' => [
                    'name' => 'Psychic',
                    'color' => '#f366b9',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Psy',
                ],
            ],
            'rock' => [
                'en' => [
                    'name' => 'Rock',
                    'color' => '#a38c21',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Roche',
                ],
            ],
            'steel' => [
                'en' => [
                    'name' => 'Steel',
                    'color' => '#9eb7b8',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Acier',
                ],
            ],
            'ice' => [
                'en' => [
                    'name' => 'Ice',
                    'color' => '#51c4e7',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Glace',
                ],
            ],
            'ghost' => [
                'en' => [
                    'name' => 'Ghost',
                    'color' => '#7b62a3',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Spectre',
                ],
            ],
            'dragon' => [
                'en' => [
                    'name' => 'Dragon',
                    'color' => '#53a4cf,#f16e57',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Dragon',
                ],
            ],
            'dark' => [
                'en' => [
                    'name' => 'Dark',
                    'color' => '#707070',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Ténèbres',
                ],
            ],
            'unknown' => [
                'en' => [
                    'name' => '???',
                    'color' => '#000000',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => '???',
                ],
            ],
            'shadow' => [
                'en' => [
                    'name' => 'Shadow',
                    'color' => '#222222',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Obscur',
                ],
            ],
        ];
    }

    /**
     * Create types.
     * @param ManagerRegistry $doctrine
     * @return array
     */
    public function createTypes(ManagerRegistry $doctrine)
    {
        $types = [];
        $entityManager = $doctrine->getManager();

        // Load a specific repository to persist multilingual entities.
        $translationRepository = $entityManager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        foreach ($this->data as $machineName => $data) {

            // Instantiate and set properties for english type (assuming it's default locale).
            $type = new Type();
            $type->setName($data['en']['name']);
            $type->setColor($data['en']['color']);
            $type->setBootstrapColor($data['en']['bootstrap_color']);

            // Provide french translation.
            $translationRepository->translate($type, 'name', 'fr', $data['fr']['name']);

            $entityManager->persist($type);
            $types[] = $type;
        }

        // Store everything in database.
        $entityManager->flush();

        // Return newly created types.
        return $types;
    }

    /**
     * Create types from PokeAPI V2.
     * @param ManagerRegistry $doctrine
     * @param null|int $limit
     * @param null|int $offset
     * @return array
     */
    public function createTypesFromPAPI(ManagerRegistry $doctrine, $limit = null, $offset = null)
    {
        $types = [];
        $entityManager = $doctrine->getManager();
        $translationRepository = $entityManager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        $papiTypes = json_decode($this->papi->resourceList('type', $limit, $offset));
        foreach ($papiTypes->results as $result) {
            $papiType = json_decode($this->papi->pokemonType($result->name));

            // Look for names translation.
            if (isset($papiType->names)) {

                // Look for english and french name with a look cause API does not return
                // translated names array always the same.
                $tmpType = [];
                foreach ($papiType->names as $item) {
                    if ($item->language->name == 'en') {
                        $tmpType['en'] = $item->name;
                    }
                    if ($item->language->name == 'fr') {
                        $tmpType['fr'] = $item->name;
                    }
                }

                // Instantiate and set properties for english type (assuming it's default locale).
                $type = new Type();
                $type->setName($tmpType['en']);

                // Use hard-coded data to get colors as they are not provided by PokeAPI V2.
                $type->setColor($this->data[$papiType->name]['en']['color']);
                $type->setBootstrapColor($this->data[$papiType->name]['en']['bootstrap_color']);

                // Provide french translation.
                $translationRepository->translate($type, 'name', 'fr', $tmpType['fr']);

                $entityManager->persist($type);
                $types[] = $type;
            }
        }

        // Store everything in database.
        $entityManager->flush();

        // Return newly created types.
        return $types;
    }
}
