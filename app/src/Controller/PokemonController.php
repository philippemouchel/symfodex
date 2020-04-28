<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Category;
use App\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use UnitConverter\UnitConverter;

class PokemonController extends AbstractController
{
    /**
     * @Route("/pokemon", name="pokemon")
     */
    public function index()
    {
        // Instantiate entity repository to load all pokemons.
        $pokemonRepository = $this->getDoctrine()->getRepository(Pokemon::class);
        $pokemons = $pokemonRepository->findAll();

        return $this->render('pokemon/index.html.twig', [
            'controller_name' => 'PokemonController',
            'pokemons' => $pokemons,
        ]);
    }

    /**
     * @Route("/pokemon/{id}", name="pokemon_show")
     * @param Pokemon $pokemon
     * @return Response
     */
    public function show(Pokemon $pokemon)
    {
        // Convert some properties.
        $converter = UnitConverter::createBuilder()
            ->addSimpleCalculator()
            ->addDefaultRegistry()
            ->build();

        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
            'height' => $converter->convert($pokemon->getHeight())->from('mm')->to('m'),
            'weight' => $converter->convert($pokemon->getWeight())->from('g')->to('kg'),
        ]);
    }

    /**
     * @Route("/create/pokemon", name="create_pokemon")
     * @return Response
     */
    public function createPokemon()
    {
        // Instantiate entity repositories.
        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $typeRepository = $this->getDoctrine()->getRepository(Type::class);

        // Init new Pokemon object.
        $pokemon = new Pokemon();
        $pokemon->setNumber(18);
        $pokemon->setName('Pidgeot');
        $pokemon->setDescription('This Pokémon has a dazzling plumage of beautifully glossy feathers. Many Trainers are captivated by the striking beauty of the feathers on its head, compelling them to choose Pidgeot as their Pokémon.');
        $pokemon->setHeight(1500); // millimeters.
        $pokemon->setWeight(39500); // grams.

        // Relates this pokemon to the category.
        $category = $categoryRepository->findOneBy(['name' => 'Bird']);
        $pokemon->setCategory($category);

        // Relates this pokemon to the category.
        $types = [
            $typeRepository->findOneBy(['name' => 'Normal']),
            $typeRepository->findOneBy(['name' => 'Flying']),
        ];
        foreach ($types as $type) {
            $pokemon->addType($type);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pokemon);
        $entityManager->flush();

        return new Response('<html><body><p>Saved new pokemon <strong>' . $pokemon->getName() . ' (' . $pokemon->getNumber() . ')</strong></p></body></html>');
    }
}
