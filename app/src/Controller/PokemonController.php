<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Category;
use App\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

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
        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
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
        $pokemon->setNumber(9);
        $pokemon->setName('Blastoise');
        $pokemon->setDescription('Blastoise has water spouts that protrude from its shell. The water spouts are very accurate. They can shoot bullets of water with enough accuracy to strike empty cans from a distance of over 160 feet.');
        $pokemon->setHeight(1600); // millimeters.
        $pokemon->setWeight(85500); // grams.

        // Relates this pokemon to the category.
        $category = $categoryRepository->findOneBy(['name' => 'Shellfish']);
        $pokemon->setCategory($category);

        // Relates this pokemon to the category.
        $types = [
            $typeRepository->findOneBy(['name' => 'Water']),
//            $typeRepository->findOneBy(['name' => 'Flying']),
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
