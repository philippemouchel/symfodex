<?php

namespace App\Controller;

use App\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="type")
     * @return Response
     */
    public function index()
    {
        return $this->render('type/index.html.twig', [
            'controller_name' => 'TypeController',
        ]);
    }

    /**
     * @Route("/type/{id}", name="type_show")
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
     * @route("/type/convert/{id}", name="type_show_convert"))
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
        $type->setName('Water');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($type);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('<html><body><p>Saved new type <strong>' . $type->getName() . ' (' . $type->getId() . ')</strong></p></body></html>');

    }
}
