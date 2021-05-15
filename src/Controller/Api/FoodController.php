<?php

namespace App\Controller\Api;

use App\Entity\Food;
use App\Repository\FamilyFoodRepository;
use App\Repository\FoodRepository;
use App\Repository\PreservationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class FoodController
 * @package App\Controller\Api
 *
 * @Route("/api/food", name="api_food_")
 */
class FoodController extends ApiCoreController
{
    /**
     * @Route("", name="get_all", methods="GET")
     */
    public function getAllFoodForOneUser(FoodRepository $foodRepository): Response
    {
        //TODO Faire la connection et mettre ensuite les aliments de l'utilisateur seul
        //$currentUser = $this->getUser();
        //$foodList = $foodRepository->getAllForOneUser($currentUser);

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
        if ($food === null) {
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
     * @Route("", name="post", methods="POST")
     */
    public function postFood(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        //!!! TEMPORAIRE !!!
        UserRepository $userRepo,
        PreservationRepository $preservationRepo,
        FamilyFoodRepository $familyFoodRepo
        //!!! ========== !!!
    ): Response
    {
        // TODO A mettre en place une fois la connexion d'un utilisateur mis en place
        // $currentUser = $this->getUser();

        //! Seulement temporaire, le temps d'avoir des utilisateurs actives
        $currentUser = $userRepo->find(1);

        //! A enlever une fois les données récupérées du front
        $preservation = $preservationRepo->find(mt_rand(1, 4));
        $family = $familyFoodRepo->find(mt_rand(1, 7));
        //! ==================================================

        $jsonContent = $request->getContent();

        $food = $serializer->deserialize($jsonContent, Food::class, 'json');

        $error = $validator->validate($food);

        if (count($error) > 0) {
            return $this->json(['error' => $this->generateErrors($error)], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $food->setUser($currentUser);

        $food->setPreservation($preservation);
        $food->setFamilyfood($family);

        $em->persist($food);
        $em->flush();

        return $this->json(
            $food,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl('api_food_get_one', ['id' => $food->getId()])
            ],
            ['groups' => 'get_one_food']
        );
    }

    /**
     * @Route("/{id<\d+>}", name="patch_put", methods={"PATCH","PUT"})
     */
    public function patchFood(
        Food $food = null,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        Request $request,
        ValidatorInterface $validator
    ): Response {
        if ($food === null) {
            // On retourne un message JSON + un statut 404
            return $this->json(['error' => 'Aliment introuvable.'], Response::HTTP_NOT_FOUND);
        }

        $serializer->deserialize(
            $request->getContent(),
            Food::class,
            'json',
            // On a cet argument en plus qui indique au serializer quelle entité existante modifier
            [AbstractNormalizer::OBJECT_TO_POPULATE => $food]
        );

        $errors = $validator->validate($food);

        if (count($errors) > 0) {
            return $this->json($this->generateErrors($errors), Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        $em->flush();

        return $this->json(['message' => 'Aliment modifié.'], Response::HTTP_OK);
    }

    /**
     * @Route("/{id<\d+>}", name="delete", methods="DELETE")
     */
    public function deleteFood(Food $food = null, EntityManagerInterface $entityManager): Response
    {
        // if the story is not found, answer with message json and status code 404
        if ($food === null) {
            return $this->json(['message' => 'Aliment introuvable.'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($food);
        $entityManager->flush();

        return $this->json(['message' => 'Aliment supprimée.'], Response::HTTP_OK);
    }
}
