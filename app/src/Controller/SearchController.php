<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // @todo: use https://packagist.org/packages/elasticsearch/elasticsearch package.
        // some documentation available here: https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/index.html

        return $this->render('search/results.html.twig', [
            'query' => $request->query->get('q'),
        ]);
    }
}
