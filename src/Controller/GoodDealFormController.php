<?php

namespace App\Controller;

use App\Entity\GoodDeal;
use App\Events;
use App\Form\GoodDealFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface as EventDispatcher;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GoodDealFormController extends AbstractController
{

    /**
     * @Route("/gooddeals/add",name="app_gooddealform")
     * @param Request $request
     * @param EventDispatcher $eventDispatcher
     * @return Response
     */
    public function addGoodDeal(Request $request, EventDispatcher $eventDispatcher): Response
    {
        $goodDeal = new GoodDeal();

        $form = $this->createForm(GoodDealFormType::class, $goodDeal);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $goodDeal = $form->getData();
            $goodDeal->setCreationDate(new \DateTime());
            $goodDeal->setUser($this->getUser());

            $img = $form->get('image')->getData();
            $newImageName = uniqid().'.'.$img->guessExtension();
            try {
                $img->move(
                    $this->getParameter('images_directory'),
                    $newImageName
                );
            } catch (FileException $e) {

            }
            $goodDeal->setImageName($newImageName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($goodDeal);
            $entityManager->flush();

            $event = new GenericEvent($this->getUser(), ["Manager"=>$entityManager]);
            $eventDispatcher->dispatch( $event, Events::VALIDATED_COBAYE_BADGE);

            return $this->redirectToRoute('home');
        }

        return $this->render('form/goodDealForm.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
