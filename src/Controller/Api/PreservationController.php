<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PreservationController extends ApiCoreController
{
    /**
     * @Route("/api/preservation", name="api_preservation")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/PreservationController.php',
        ]);
    }
}
