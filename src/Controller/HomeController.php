<?php

namespace App\Controller;

use App\Entity\Deal;
use App\Entity\GoodDeal;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/search", name="app_dealsfilter")
     * @param Request $request
     * @return Response
     */
    public function dealsBySearch(Request $request): Response
    {
        $data = $request->query->get('recherche');

        $deals = $this->getDoctrine()->getRepository(Deal::class)->findBySearch($data);

        return $this->render('home/search.html.twig', [
            'controller_name' => 'HomeController',
            'deals' => $deals
        ]);
    }
}
