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
//        $pokemon->setNumber(15);
//        $pokemon->setName('Beedrill');
//        $pokemon->setDescription('Beedrill is extremely territorial. No one should ever approach its nest—this is for their own safety. If angered, they will attack in a furious swarm.');
//        $pokemon->setHeight(1000); // millimeters.
//        $pokemon->setWeight(29500); // grams.
//
//        // Relates this pokemon to the category.
//        $category = $categoryRepository->findOneBy(['name' => 'Poison Bee']);
//        $pokemon->setCategory($category);
//
//        // Relates this pokemon to the category.
//        $types = [
//            $typeRepository->findOneBy(['name' => 'Bug']),
//            $typeRepository->findOneBy(['name' => 'Poison']),
//        ];
//        foreach ($types as $type) {
//            $pokemon->addType($type);
//        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pokemon);
        $entityManager->flush();

        return new Response('<html><body><p>Saved new pokemon <strong>' . $pokemon->getName() . ' (' . $pokemon->getNumber() . ')</strong></p></body></html>');
    }
}
