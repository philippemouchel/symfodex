<?php

namespace App\Controller;

use App\Entity\Type;
use App\Helper\TypeHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class TypeController extends AbstractController
{
    /**
     * @var TypeHelper
     */
    private $typeHelper;

    /**
     * TypeController constructor.
     * @param TypeHelper $typeHelper
     */
    public function __construct(TypeHelper $typeHelper)
    {
        $this->typeHelper = $typeHelper;
    }

    /**
     * @Route("/{_locale}/type", name="type")
     * @return Response
     */
    public function index()
    {
        // Instantiate entity repository to load all types.
        $typeRepository = $this->getDoctrine()->getRepository(Type::class);
        $types = $typeRepository->findAll();

        return $this->render('type/index.html.twig', [
            'controller_name' => 'TypeController',
            'types' => $types,
        ]);
    }

    /**
     * @Route("/{_locale}/type/{id}", name="type_show")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $type = $this->getDoctrine()
            ->getRepository(Type::class)
            ->find($id);

        if (!$type) {
            throw $this->createNotFoundException(
                'No type found for id '.$id
            );
        }

        return $this->render('type/show.html.twig', [
            'type' => $type,
        ]);
    }

    /**
     * This is another way to get object from a database,
     * using ParamConverter to fetch object automatically from params.
     *
     * @route("/{_locale}/type/convert/{id}", name="type_show_convert"))
     * @param Type $type
     * @return Response
     */
    public function showParamConverter(Type $type)
    {
        return new Response('Check out this type: '.$type->getName());

        // or render a template
        // in the template, print things with {{ type.name }}
        // return $this->render('type/show.html.twig', ['type' => $type]);
    }

    /**
     * Please don't use this route, it was just a test.
     *
     * @Route("/create/type", name="create_type")
     * @return Response
     */
    public function createType(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $type = new Type();
//        $type->setName('Grass');
//        $type->setName('Poison');
//        $type->setName('Fire');
//        $type->setName('Flying');
//        $type->setName('Water');
//        $type->setName('Bug');
//        $type->setName('Normal');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($type);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('<html><body><p>Saved new type <strong>' . $type->getName() . ' (' . $type->getId() . ')</strong></p></body></html>');
    }

    /**
     * Another test route, to translate all types.
     *
     * @Route("/{_locale}/translate/types", name="translate_types")
     * @return Response
     */
    public function translateTypes()
    {
        // Load the type repository & manager.
        $typeRepository = $this->getDoctrine()->getRepository(Type::class);
        $entityManager = $this->getDoctrine()->getManager();
        $types = $typeRepository->findAll();

        $names = [
            'fr' => [
                1 => 'Plante',
                2 => 'Poison',
                3 => 'Feu',
                4 => 'Vol',
                5 => 'Eau',
                6 => 'Insecte',
                7 => 'Normal',
                8 => 'Électrik',
                9 => 'Sol',
                10 => 'Fée',
            ]
        ];

        foreach ($names as $language => $values) {
            foreach ($types as $type) {
                // Define new value for title
                $type->setName($values[$type->getId()]);

                // Define locale.
                $type->setTranslatableLocale($language); // change locale

                // Persist entity.
                $entityManager->persist($type);
            }
        }

        // Store everything in database.
        $entityManager->flush();

        return new Response('<html><body><p>Types translated!</p></body></html>');
    }

    /**
     * Another test route to create types based on TypeHelper data.
     *
     * @Route("/create/types", name="create_types")
     * @return Response
     */
    public function createTypes()
    {
        $types = $this->typeHelper->createTypes($this->getDoctrine());
        return new Response('<html><body><p>' . count($types) . ' types created!</p></body></html>');
    }
}
