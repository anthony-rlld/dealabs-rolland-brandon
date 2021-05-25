<?php

namespace App\Form;

use App\Entity\GoodDeal;
use App\Entity\Group;
use Doctrine\DBAL\Types\ArrayType;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\DateType;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoodDealFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //   $repo = $this->getDoctrine()->getRepository(Category::class);
        //   $categs = $repo->findAll();


        $builder
            ->add('title', TextType::class,[
                'required' => true,
            ])
            ->add('description', TextType::class,[
                'required' => true,
            ])
            ->add('link', TextType::class,[
                'required' => true,
            ])
            ->add('actualPrice', IntegerType::class,[
                'required' => true,
            ])
            ->add('newPrice',IntegerType::class,[
                'required' => true,
            ])
            ->add('freeDelivery',BooleanType::class,[
                'required' => true,
            ])
            ->add('groupsList',ArrayType::class,[
                'class' => Group::class,
                'choice_label' => 'Groupes :',
                'expanded' => false,
                'multiple' => true,
                'required' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Créer le deal']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GoodDeal::class,
        ]);
    }
}