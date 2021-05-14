<?php

namespace App\Controller\Api;

use App\Repository\FoodRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends ApiCoreController
{
    /**
     * @Route("/api/food", name="api_food_get_all")
     */
    public function list(FoodRepository $foodRepository): Response
    {
        $foodList = $foodRepository->findAll();

        return $this->json(
            $foodList,
            Response::HTTP_OK,
            [],
            []
        );
    }
}
