<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    /**
     * @Route("/{_locale}/category", name="category")
     * @return Response
     */
    public function index()
    {
        // Instantiate entity repository to load all categories.
        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'TypeController',
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/{_locale}/category/{id}", name="category_show")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($id);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for id '.$id
            );
        }

        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * This is just another way to get object from a database,
     * using Symfony's autowiring and dependency injection.
     *
     * @Route("/{_locale}/category/repo/{id}", name="category_show_repo")
     * @param $id
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function showRepo($id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository
            ->find($id);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for id '.$id
            );
        }

        return new Response('Check out this category: '.$category->getName());

        // or render a template
        // in the template, print things with {{ category.name }}
        // return $this->render('category/show.html.twig', ['category' => $category]);
    }

    /**
     * Please don't use this route, it was just a test.
     *
     * @Route("/create/category", name="create_category")
     * @return Response
     */
    public function createCategory(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $category = new Category();
//        $category->setName('Seed');
//        $category->setName('Lizard');
//        $category->setName('Flame');
//        $category->setName('Tiny Turtle');
//        $category->setName('Turtle');
//        $category->setName('Worm');
//        $category->setName('Cocoon');
//        $category->setName('Butterfly');
//        $category->setName('Hairy Bug');
//        $category->setName('Poison Bee');
//        $category->setName('Tiny Bird');
//        $category->setName('Bird');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($category);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('<html><body><p>Saved new category <strong>' . $category->getName() . ' (' . $category->getId() . ')</strong></p></body></html>');

    }
}
