<?php

namespace App\Controller;

use App\Entity\Deal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailDealController extends AbstractController
{
    /**
     * @Route("/deals/detail/{id}", name="detaildeal")
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function index(Request $request, string $id): Response
    {
        $deal =  $this->getDoctrine()->getRepository(Deal::class)->find($id);

        return $this->render('detail/detailDealPage.html.twig', [
            'controller_name' => 'DetailDealController',
            'deal' => $deal
        ]);
    }
}
