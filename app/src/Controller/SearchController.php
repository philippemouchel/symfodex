<?php


namespace App\Controller;


use App\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @param RepositoryManagerInterface $finder
     * @return Response
     */
    public function index(Request $request, RepositoryManagerInterface $finder)
    {
        // Get search query from GET parameters, and process a request to ES finder.
        $searchQuery = $request->query->get('q');
        $searchResults = $finder->getRepository(Pokemon::class)->find($searchQuery);

        return $this->render('search/results.html.twig', [
            'query' => $searchQuery,
            'results' => $searchResults,
        ]);
    }
}
