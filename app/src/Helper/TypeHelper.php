<?php

namespace App\Helper;


use App\Entity\Type;
use Doctrine\Persistence\ManagerRegistry;

class TypeHelper
{
    /**
     * @var array
     */
    private $data;

    /**
     * CategoryHelper constructor.
     */
    public function __construct()
    {
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
            [
                'en' => [
                    'name' => 'Grass',
                    'color' => '#9bcc50',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Plante',
                ],
            ],
            [
                'en' => [
                    'name' => 'Poison',
                    'color' => '#b97fc9',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Poison',
                ],
            ],
            [
                'en' => [
                    'name' => 'Fire',
                    'color' => '#fd7d24',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Feu',
                ],
            ],
            [
                'en' => [
                    'name' => 'Flying',
                    'color' => '#3dc7ef,#bdb9b8',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Vol',
                ],
            ],
            [
                'en' => [
                    'name' => 'Water',
                    'color' => '#4592c4',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Eau',
                ],
            ],
            [
                'en' => [
                    'name' => 'Bug',
                    'color' => '#729f3f',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Insecte',
                ],
            ],
            [
                'en' => [
                    'name' => 'Normal',
                    'color' => '#a4acaf',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Normal',
                ],
            ],
            [
                'en' => [
                    'name' => 'Electric',
                    'color' => '#eed535',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Électrik',
                ],
            ],
            [
                'en' => [
                    'name' => 'Ground',
                    'color' => '#f7de3f,#ab9842',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Sol',
                ],
            ],
            [
                'en' => [
                    'name' => 'Fairy',
                    'color' => '#fdb9e9',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Fée',
                ],
            ],
            [
                'en' => [
                    'name' => 'Fighting',
                    'color' => '#d56723',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Combat',
                ],
            ],
            [
                'en' => [
                    'name' => 'Psychic',
                    'color' => '#f366b9',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Psy',
                ],
            ],
            [
                'en' => [
                    'name' => 'Rock',
                    'color' => '#a38c21',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Roche',
                ],
            ],
            [
                'en' => [
                    'name' => 'Steel',
                    'color' => '#9eb7b8',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Acier',
                ],
            ],
            [
                'en' => [
                    'name' => 'Ice',
                    'color' => '#51c4e7',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Glace',
                ],
            ],
            [
                'en' => [
                    'name' => 'Ghost',
                    'color' => '#7b62a3',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Spectre',
                ],
            ],
            [
                'en' => [
                    'name' => 'Dragon',
                    'color' => '#53a4cf,#f16e57',
                    'bootstrap_color' => 'dark',
                ],
                'fr' => [
                    'name' => 'Dragon',
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

        foreach ($this->data as $data) {

            // Instantiate and set name for english type (assuming it's default locale).
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
}
