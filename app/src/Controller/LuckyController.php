<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    /**
     * @Route(
     *     "/lucky/number/{max}",
     *     name="tuto_lucky_number",
     *     requirements={"max"="\d+"},
     *     methods={"GET"},
     * )
     *
     * @param Request $request
     * @param int $max
     * @return Response
     * @throws \Exception
     */
    public function number(Request $request, int $max = 100)
    {
        $number = random_int(0, $max);
        $locale = $request->getLocale();

        return $this->render('lucky/number.html.twig', [
            'max' => $max,
            'number' => $number,
            'locale' => $locale,
        ]);
    }
}
