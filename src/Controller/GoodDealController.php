<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GoodDealController extends AbstractController
{
    /**
     * @Route("/gooddeal", name="godddeal")
     */
    public function index(): Response
    {
        return $this->render('deal/goodDeal.html.twig', [
            'controller_name' => 'GoodDealController',
        ]);
    }
}
