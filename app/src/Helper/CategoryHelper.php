<?php

namespace App\Helper;


use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;

class CategoryHelper
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
     * containing each category in english and french.
     * @return string[][][]
     */
    private function getDataFromArray()
    {
        return [
            [
                'en' => ['name' => 'Seed'],
                'fr' => ['name' => 'Graine'],
            ],
            [
                'en' => ['name' => 'Lizard'],
                'fr' => ['name' => 'Lézard'],
            ],
            [
                'en' => ['name' => 'Flame'],
                'fr' => ['name' => 'Flamme'],
            ],
            [
                'en' => ['name' => 'Tiny Turtle'],
                'fr' => ['name' => 'Minitortue'],
            ],
            [
                'en' => ['name' => 'Turtle'],
                'fr' => ['name' => 'Tortue'],
            ],
            [
                'en' => ['name' => 'Shellfish'],
                'fr' => ['name' => 'Carapace'],
            ],
            [
                'en' => ['name' => 'Worm'],
                'fr' => ['name' => 'Ver'],
            ],
            [
                'en' => ['name' => 'Coccon'],
                'fr' => ['name' => 'Cocon'],
            ],
            [
                'en' => ['name' => 'Butterfly'],
                'fr' => ['name' => 'Papillon'],
            ],
            [
                'en' => ['name' => 'Inspectopic'],
                'fr' => ['name' => 'Graine'],
            ],
            [
                'en' => ['name' => 'Poison Bee'],
                'fr' => ['name' => 'Guêpoison'],
            ],
            [
                'en' => ['name' => 'Tiny Bird'],
                'fr' => ['name' => 'Minoiseau'],
            ],
            [
                'en' => ['name' => 'Bird'],
                'fr' => ['name' => 'Oiseau'],
            ],
            [
                'en' => ['name' => 'Mouse'],
                'fr' => ['name' => 'Souris'],
            ],
            [
                'en' => ['name' => 'Beak'],
                'fr' => ['name' => 'Bec-Oiseau'],
            ],
            [
                'en' => ['name' => 'Snake'],
                'fr' => ['name' => 'Serpent'],
            ],
            [
                'en' => ['name' => 'Cobra'],
                'fr' => ['name' => 'Cobra'],
            ],
            [
                'en' => ['name' => 'Poison Pin'],
                'fr' => ['name' => 'Vénépic'],
            ],
            [
                'en' => ['name' => 'Drill'],
                'fr' => ['name' => 'Perceur'],
            ],
            [
                'en' => ['name' => 'Fairy'],
                'fr' => ['name' => 'Fée'],
            ],
            [
                'en' => ['name' => 'Fox'],
                'fr' => ['name' => 'Renard'],
            ],
            [
                'en' => ['name' => 'Balloon'],
                'fr' => ['name' => 'Bouboule'],
            ],
            [
                'en' => ['name' => 'Bat'],
                'fr' => ['name' => 'Chovsouris'],
            ],
        ];
    }

    /**
     * Create categories.
     * @param ManagerRegistry $doctrine
     * @return array
     */
    public function createCategories(ManagerRegistry $doctrine)
    {
        $categories = [];
        $entityManager = $doctrine->getManager();

        // Load a specific repository to persist multilingual entities.
        $translationRepository = $entityManager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        foreach ($this->data as $data) {

            // Instantiate and set properties for english category (assuming it's default locale).
            $category = new Category();
            $category->setName($data['en']['name']);

            // Provide french translation.
            $translationRepository->translate($category, 'name', 'fr', $data['fr']['name']);

            $entityManager->persist($category);
            $categories[] = $category;
        }

        // Store everything in database.
        $entityManager->flush();

        // Return newly created categories.
        return $categories;
    }
}
