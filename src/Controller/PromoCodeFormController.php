<?php

namespace App\Controller;

use App\Entity\PromotionnalCode;
use App\Form\PromoCodeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PromoCodeFormController extends AbstractController
{

    /**
     * @Route("/promocodes/add",name="app_promocodeform")
     * @param Request $request
     * @return Response
     */
    public function addPromoCode(Request $request): Response
    {
        $promoCode = new PromotionnalCode();

        $form = $this->createForm(PromoCodeFormType::class, $promoCode);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $promoCode = $form->getData();

            //  $promoCodeRepo = $this->getDoctrine()->getRepository(GoodDeal::class);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promoCode);
            $entityManager->flush();

            return $this->redirectToRoute('home');

        }
        return $this->render('/form/promoCodeForm.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
