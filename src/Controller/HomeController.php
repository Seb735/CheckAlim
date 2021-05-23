<?php

namespace App\Controller;

use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        if ($this->getUser()){
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('home/index.html.twig');
    }
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(FoodRepository $foodRepo): Response
    {
        $currentUser = $this->getUser();
        $lastFiveFoodCreated = $foodRepo->getFiveForOneUserInOrderCreated($currentUser);
        return $this->render('home/dashboard.html.twig',[
            'lastFiveFoodCreated' => $lastFiveFoodCreated,
        ]);
    }
}
