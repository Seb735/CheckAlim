<?php

namespace App\Controller\Api;

use App\Entity\FamilyFood;
use App\Repository\FamilyFoodRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FamilyFoodController
 * @package App\Controller\Api
 *
 * @Route("api/food-family", name="api_familyFood_")
 */
class FamilyFoodController extends ApiCoreController
{
    /**
     * @Route("", name="get_all", methods="GET")
     */
    public function getAllFamilyFood(FamilyFoodRepository $familyFoodRepo): Response
    {
        $familyFoodList = $familyFoodRepo->findAll();

        return $this->json(
            $familyFoodList,
            Response::HTTP_OK,
            [],
            ['groups' => 'get_all_familyfood']
        );
    }

    /**
     * @Route("/{id<\d+>}", name="get_one", methods="GET")
     */
    public function getOnefamilyfood(FamilyFood $familyFood = null): Response
    {
        if ($familyFood === null) {
            return $this->json(['message' => 'Famille d\'aliment introuvable'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(
            $familyFood,
            Response::HTTP_OK,
            [],
            ['groups' => 'get_one_familyfood']
        );
    }
}
