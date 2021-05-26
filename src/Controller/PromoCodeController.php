<?php

namespace App\Controller;


use App\Entity\PromotionnalCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromoCodeController extends AbstractController
{
    /**
     * @Route("/promocodes", name="app_promocodes")
     */
    public function index(): Response
    {
        $promoCodeRepo = $this->getDoctrine()->getRepository(PromotionnalCode::class);
        $promoCodes = $promoCodeRepo->findAll();
        return $this->render('listes/promocodes.html.twig', [
            'controller_name' => 'PromoCodeController',
            'promoCodes' => $promoCodes
        ]);
    }
}
