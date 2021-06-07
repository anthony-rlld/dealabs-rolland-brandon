<?php

namespace App\Controller;

use App\Entity\Deal;
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
        $plusHot = $repo->findLesPlusHot(100);
        $aLaUne = $repo->findALaUne();

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'plusHot' => $plusHot,
            'aLaUne' => $aLaUne
        ]);
    }
}
