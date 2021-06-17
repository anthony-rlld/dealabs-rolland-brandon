<?php

namespace App\Controller;

use App\Entity\Deal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function index(): Response
    {
        $maxDegree = $this->GetMaxDegree();
        $moyDegree = $this->GetMoyenneDegree();
        $percentHot = $this->GetPercentHot();
        return $this->render('user/statistiques.html.twig', [
            'controller_name' => 'UserController',
            'maxDegree' => $maxDegree,
            'moyDegree' => $moyDegree,
            'percentHot' => $percentHot
        ]);
    }

    /**
     * @Route("/user/deals", name="app_user_deals")
     */
    public function dealsByUser(): Response
    {
        return $this->render('user/deals.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @return int|mixed
     */
    private function GetMaxDegree(): int
    {
        $res = $this->getDoctrine()->getRepository(Deal::class)
            ->findMaxDegreeByUser($this->getUser()->getId());

        return isset($res[0]['maxDegree']) ? $res[0]['maxDegree'] : 0;
    }

    /**
     * @return int|mixed
     */
    private function GetMoyenneDegree(): int
    {
        $res = $this->getDoctrine()->getRepository(Deal::class)
            ->findMoyenneDegreeByUser($this->getUser()->getId());

        return isset($res[0]['moyDegree']) ? $res[0]['moyDegree'] : 0;
    }

    /**
     * @return int|mixed
     */
    private function GetPercentHot(): int
    {
        $res = $this->getDoctrine()->getRepository(Deal::class)
            ->findHowManyHotByUser($this->getUser()->getId(), 100);
        $nbDeal = $this->getUser()->getDeals()->count();

        return $res[0]['nbHot'] > 0 ? ($res[0]['nbHot']/$nbDeal)*100 : 0;
    }
}
