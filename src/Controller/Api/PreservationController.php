<?php

namespace App\Controller\Api;

use App\Entity\Preservation;
use App\Repository\PreservationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PreservationController
 * @package App\Controller\Api
 *
 * @Route("api/preservation", name="api_preservation_")
 */
class PreservationController extends ApiCoreController
{
    /**
     * @Route("", name="get_all", methods="GET")
     */
    public function getAll(PreservationRepository $preservationRepo): Response
    {
        $preservationList = $preservationRepo->findAll();

        return $this->json(
            $preservationList,
            Response::HTTP_OK,
            [],
            ['groups' => 'get_all_preservation']
        );
    }

    /**
     * @Route("/{id<\d+>}", name="get_one", methods="GET")
     */
    public function getOne(Preservation $preservation = null): Response
    {
        if ($preservation === null) {
            return $this->json(['message' => 'Moyen de conservation introuvable'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(
            $preservation,
            Response::HTTP_OK,
            [],
            ['groups' => 'get_one_preservation']
        );
    }
}
