<?php

namespace App\Controller;

use App\Entity\Deal;
use App\Entity\GoodDeal;
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
        $repo = $this->getDoctrine()->getRepository(Deal::class);
        $deals = $repo->findAll();

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'deals' => $deals
        ]);
    }
}
