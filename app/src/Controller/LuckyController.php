<?php

// src/Controller/LuckyController.php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class LuckyController {

    /**
     * @Route("/lucky/number")
     *
     * @return Response
     * @throws \Exception
     */
    public function number() {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}
