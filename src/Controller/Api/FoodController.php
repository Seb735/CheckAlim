<?php

namespace App\Controller\Api;

use App\Entity\Food;
use App\Repository\FoodRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FoodController
 * @package App\Controller\Api
 *
 * @Route("/api/food", name="api_food_")
 */
class FoodController extends ApiCoreController
{
    /**
     * @Route("/", name="get_all", methods="GET")
     */
    public function getAllFoodForOneUser(FoodRepository $foodRepository): Response
    {
        //TODO Faire la connection et mettre ensuite les aliments de l'utilisateur seul
        //$user = $this->getUser();
        //$foodList = $foodRepository->getAllForOneUser($user);

        $foodList = $foodRepository->findAll();

        return $this->json(
            $foodList,
            Response::HTTP_OK,
            [],
            ['groups' => 'get_all_food']
        );
    }

    /**
     * @Route("/{id<\d+>}", name="get_one", methods="GET")
     */
    public function getOneFood(Food $food = null): Response
    {
        if($food === null)
        {
            return $this->json(['message' => 'Aliment introuvable'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(
            $food,
            Response::HTTP_OK,
            [],
            ['groups' => 'get_one_food']
        );
    }

    /**
     * @Route("/", name="post", methods="POST")
     */
    public function postFood()
    {

    }

    /**
     * @Route("/{id<\d+>}", name="patch", methods="PATCH")
     */
    public function patchFood()
    {

    }

    /**
     * @Route("/{id<\d+>}", name="delete", methods="DELETE")
     */
    public function deleteFood()
    {

    }
}
