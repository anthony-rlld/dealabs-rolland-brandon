<?php

namespace App\Controller;

use App\Entity\Deal;
use App\Entity\GoodDeal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GoodDealController extends AbstractController
{
    /**
     * @Route("/gooddeals", name="app_gooddeals")
     */
    public function index(): Response
    {
        $goodDealRepo = $this->getDoctrine()->getRepository(GoodDeal::class);
        $goodDeals = $goodDealRepo->findAll();
        return $this->render('listes/gooddeals.html.twig', [
            'controller_name' => 'GoodDealController',
            'goodDeals' => $goodDeals
        ]);
    }
}
