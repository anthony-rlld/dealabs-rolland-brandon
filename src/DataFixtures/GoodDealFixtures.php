<?php


namespace App\DataFixtures;


use App\Entity\GoodDeal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GoodDealFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return array(
            GroupFixtures::class,
        );
    }

    public function load(ObjectManager $manager)
    {
        $goodDeal = new GoodDeal();
        $goodDeal->setTitle("Ps5");
        $goodDeal->setActualPrice(500);
        $goodDeal->setCreationDate(new \DateTime());
        $goodDeal->setDegree(0);
        $goodDeal->setDescription("Nouvelle génération de console");
        $goodDeal->setFreeDelivery(true);
        $goodDeal->setLink("http://example.com");
        $goodDeal->setNewPrice(300);
        $goodDeal->setWebsite("Amazon");
        $goodDeal->addGroupList($this->getReference(GroupFixtures::HIGH_TECH_GROUP_REF));

        $manager->persist($goodDeal);
        $manager->flush();
    }
}