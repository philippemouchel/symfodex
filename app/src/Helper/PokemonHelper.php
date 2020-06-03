<?php

namespace App\Helper;

use App\Entity\Category;
use App\Entity\Pokemon;
use App\Entity\Type;
use Doctrine\Persistence\ManagerRegistry;
use PokePHP\PokeApi;
use UnitConverter\UnitConverter;

class PokemonHelper
{
    /**
     * PokeAPI V2 connector.
     * @var PokeApi
     */
    private $papi;

    /**
     * @var UnitConverter
     */
    private $converter;

    /**
     * @var array
     */
    private $data;

    public function __construct()
    {
        $this->papi = new PokeApi();
        $this->converter = UnitConverter::createBuilder()
            ->addSimpleCalculator()
            ->addDefaultRegistry()
            ->build();

        $this->data = $this->getDataFromArray();
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
            [
                'en' => [
                    'number' => 2,
                    'name' => 'Ivysaur',
                    'description' => 'There is a bud on this Pokémon\'s back. To support its weight, Ivysaur\'s legs and trunk grow thick and strong. If it starts spending more time lying in the sunlight, it\'s a sign that the bud will bloom into a large flower soon.',
                    'height' => 1000,
                    'weight' => 13000,
                    'type' => ['Grass', 'Poison'],
                    'category' => 'Seed',
                ],
                'fr' => [
                    'name' => 'Herbizarre',
                    'description' => 'Un bourgeon a poussé sur le dos de ce Pokémon. Pour en supporter le poids, Herbizarre a dû se muscler les pattes. Lorsqu\'il commence à se prélasser au soleil, ça signifie que son bourgeon va éclore, donnant naissance à une fleur.',
                ],
            ],
            [
                'en' => [
                    'number' => 3,
                    'name' => 'Venusaur',
                    'description' => 'There is a large flower on Venusaur\'s back. The flower is said to take on vivid colors if it gets plenty of nutrition and sunlight. The flower\'s aroma soothes the emotions of people.',
                    'height' => 2000,
                    'weight' => 100000,
                    'type' => ['Grass', 'Poison'],
                    'category' => 'Seed',
                ],
                'fr' => [
                    'name' => 'Florizarre',
                    'description' => 'Une belle fleur se trouve sur le dos de Florizarre. Elle prend une couleur vive lorsqu\'elle est bien nourrie et bien ensoleillée. Le parfum de cette fleur peut apaiser les gens.',
                ],
            ],
            [
                'en' => [
                    'number' => 4,
                    'name' => 'Charmander',
                    'description' => 'The flame that burns at the tip of its tail is an indication of its emotions. The flame wavers when Charmander is enjoying itself. If the Pokémon becomes enraged, the flame burns fiercely.',
                    'height' => 600,
                    'weight' => 8500,
                    'type' => ['Fire'],
                    'category' => 'Lizard',
                ],
                'fr' => [
                    'name' => 'Salamèche',
                    'description' => 'La flamme qui brûle au bout de sa queue indique l\'humeur de ce Pokémon. Elle vacille lorsque Salamèche est content. En revanche, lorsqu\'il s\'énerve, la flamme prend de l\'importance et brûle plus ardemment.',
                ],
            ],
            [
                'en' => [
                    'number' => 5,
                    'name' => 'Charmeleon',
                    'description' => 'Charmeleon mercilessly destroys its foes using its sharp claws. If it encounters a strong foe, it turns aggressive. In this excited state, the flame at the tip of its tail flares with a bluish white color.',
                    'height' => 1100,
                    'weight' => 19000,
                    'type' => ['Fire'],
                    'category' => 'Flame',
                ],
                'fr' => [
                    'name' => 'Reptincel',
                    'description' => 'Reptincel lacère ses ennemis sans pitié grâce à ses griffes acérées. S\'il rencontre un ennemi puissant, il devient agressif et la flamme au bout de sa queue s\'embrase et prend une couleur bleu clair.',
                ],
            ],
            [
                'en' => [
                    'number' => 6,
                    'name' => 'Charizard',
                    'description' => 'Charizard flies around the sky in search of powerful opponents. It breathes fire of such great heat that it melts anything. However, it never turns its fiery breath on any opponent weaker than itself.',
                    'height' => 1700,
                    'weight' => 90500,
                    'type' => ['Fire', 'Flying'],
                    'category' => 'Flame',
                ],
                'fr' => [
                    'name' => 'Dracaufeu',
                    'description' => 'Dracaufeu parcourt les cieux pour trouver des adversaires à sa mesure. Il crache de puissantes flammes capables de faire fondre n\'importe quoi. Mais il ne dirige jamais son souffle destructeur vers un ennemi plus faible.',
                ],
            ],
            [
                'en' => [
                    'number' => 7,
                    'name' => 'Squirtle',
                    'description' => 'Squirtle\'s shell is not merely used for protection. The shell\'s rounded shape and the grooves on its surface help minimize resistance in water, enabling this Pokémon to swim at high speeds.',
                    'height' => 500,
                    'weight' => 9000,
                    'type' => ['Water'],
                    'category' => 'Tiny Turtle',
                ],
                'fr' => [
                    'name' => 'Carapuce',
                    'description' => 'La carapace de Carapuce ne sert pas qu\'à le protéger. La forme ronde de sa carapace et ses rainures lui permettent d\'améliorer son hydrodynamisme. Ce Pokémon nage extrêmement vite.',
                ],
            ],
            [
                'en' => [
                    'number' => 8,
                    'name' => 'Wartortle',
                    'description' => 'Its tail is large and covered with a rich, thick fur. The tail becomes increasingly deeper in color as Wartortle ages. The scratches on its shell are evidence of this Pokémon\'s toughness as a battler.',
                    'height' => 1000,
                    'weight' => 22500,
                    'type' => ['Water'],
                    'category' => 'Turtle',
                ],
                'fr' => [
                    'name' => 'Carabaffe',
                    'description' => 'Carabaffe a une large queue recouverte d\'une épaisse fourrure. Elle devient de plus en plus foncée avec l\'âge. Les éraflures sur la carapace de ce Pokémon témoignent de son expérience au combat.',
                ],
            ],
            [
                'en' => [
                    'number' => 9,
                    'name' => 'Blastoise',
                    'description' => 'Blastoise has water spouts that protrude from its shell. The water spouts are very accurate. They can shoot bullets of water with enough accuracy to strike empty cans from a distance of over 160 feet.',
                    'height' => 1600,
                    'weight' => 85500,
                    'type' => ['Water'],
                    'category' => 'Shellfish',
                ],
                'fr' => [
                    'name' => 'Tortank',
                    'description' => 'Tortank dispose de canons à eau émergeant de sa carapace. Ils sont très précis et peuvent envoyer des balles d\'eau capables de faire mouche sur une cible située à plus de 50 m.',
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
     * Create pokemons from PokeAPI V2.
     * @param ManagerRegistry $doctrine
     * @param null|int $limit
     * @param null|int $offset
     * @return array
     */
    public function createPokemonsFromPAPI(ManagerRegistry $doctrine, $limit = null, $offset = null)
    {
        $pokemons = [];
        $entityManager = $doctrine->getManager();
        $typeRepository = $doctrine->getRepository(Type::class);
        $translationRepository = $entityManager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        $papiPokemons = json_decode($this->papi->resourceList('pokemon', $limit, $offset));
        foreach ($papiPokemons->results as $result) {
            $papiPokemon = json_decode($this->papi->pokemon($result->name));
            $papiPokemonSpec = json_decode($this->papi->pokemonSpecies($result->name));

            // Check for valid data.
            if (isset($papiPokemon->height) &&
                isset($papiPokemon->weight) &&
                isset($papiPokemon->types) &&
                isset($papiPokemonSpec->names) &&
                isset($papiPokemonSpec->flavor_text_entries)) {
                $tmpPokemon = [];

                // Look for english and french name using a loop cause API does not return
                // translated names array always the same.
                foreach ($papiPokemonSpec->names as $item) {
                    if ($item->language->name == 'en') {
                        $tmpPokemon['en']['name'] = $item->name;
                    }
                    if ($item->language->name == 'fr') {
                        $tmpPokemon['fr']['name'] = $item->name;
                    }
                }

                // Look for english and french description using a loop cause API does not return
                // translated descriptions array always the same.
                foreach ($papiPokemonSpec->flavor_text_entries as $item) {
                    if ($item->version->name == 'omega-ruby' && $item->language->name == 'en') {
                        $tmpPokemon['en']['description'] = $item->flavor_text;
                    }
                    if ($item->version->name == 'omega-ruby' && $item->language->name == 'fr') {
                        $tmpPokemon['fr']['description'] = $item->flavor_text;
                    }
                }

                // Instantiate and set properties for english pokemon (assuming it's default locale).
                $pokemon = new Pokemon();
                $pokemon->setNumber($papiPokemonSpec->id);
                $pokemon->setName($tmpPokemon['en']['name']);
                $pokemon->setDescription($tmpPokemon['en']['description']);
                $pokemon->setHeight($papiPokemon->height * 100); // to get millimeters
                $pokemon->setWeight($papiPokemon->weight * 100); // to get grams

                // Create relations to type and category entities.
                foreach ($papiPokemon->types as $item) {
                    if ($type = $typeRepository->findOneBy(['name' => $item->type->name])) {
                        $pokemon->addType($type);
                        $type->addPokemon($pokemon);
                        $entityManager->persist($type);
                    }
                }

                // Provide french translation.
                $translationRepository->translate($pokemon, 'name', 'fr', $tmpPokemon['fr']['name']);
                $translationRepository->translate($pokemon, 'description', 'fr', $tmpPokemon['fr']['description']);

                $entityManager->persist($pokemon);
                $pokemons[] = $pokemon;
            }
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
