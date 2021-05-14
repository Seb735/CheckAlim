<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FamilyFoodController extends ApiCoreController
{
    /**
     * @Route("/api/family-food", name="api_family_food")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/FamilyFoodController.php',
        ]);
    }
}
