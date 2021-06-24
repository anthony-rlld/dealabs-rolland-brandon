<?php

namespace App\Controller;

use App\Entity\PromotionnalCode;
use App\Events;
use App\Form\PromoCodeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface as EventDispatcher;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PromoCodeFormController extends AbstractController
{

    /**
     * @Route("/promocodes/add",name="app_promocodeform")
     * @param Request $request
     * @param EventDispatcher $eventDispatcher
     * @return Response
     */
    public function addPromoCode(Request $request, EventDispatcher $eventDispatcher): Response
    {
        $promoCode = new PromotionnalCode();

        $form = $this->createForm(PromoCodeFormType::class, $promoCode);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $promoCode = $form->getData();
            $promoCode->setCreationDate(new \DateTime());
            $promoCode->setUser($this->getUser());

            $img = $form->get('image')->getData();
            $newImageName = uniqid().'.'.$img->guessExtension();
            try {
                $img->move(
                    $this->getParameter('images_directory'),
                    $newImageName
                );
            } catch (FileException $e) {

            }
            $promoCode->setImageName($newImageName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promoCode);
            $entityManager->flush();

            $event = new GenericEvent($this->getUser(), ["Manager"=>$entityManager]);
            $eventDispatcher->dispatch( $event, Events::VALIDATED_COBAYE_BADGE);

            return $this->redirectToRoute('home');
        }
        return $this->render('/form/promoCodeForm.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
