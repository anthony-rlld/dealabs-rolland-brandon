<?php

namespace App\Form;

use App\Entity\GoodDeal;
use App\Entity\Group;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoodDealFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,[
                'required' => true,
                'label' => 'Titre :',
                'attr' => array('class'=> 'form-control mb-2')
            ])
            ->add('description', TextType::class,[
                'required' => true,
                'label' => 'Description :',
                'attr' => array('class'=> 'form-control mb-2')
            ])
            ->add('link', TextType::class,[
                'required' => true,
                'label' => 'Lien du deal :',
                'attr' => array('class'=> 'form-control mb-2')
            ])
            ->add('website', TextType::class, [
                'required' => true,
                'label' => 'Nom du site web :',
                'attr' => array('class'=> 'form-control mb-2')
            ])
            ->add('actualPrice', IntegerType::class,[
                'required' => true,
                'label' => 'Prix actuel :',
                'attr' => array('class'=> 'form-control mb-2')
            ])
            ->add('newPrice',IntegerType::class,[
                'required' => true,
                'label' => 'Nouveau prix :',
                'attr' => array('class'=> 'form-control mb-2')
            ])
            ->add('freeDelivery',CheckboxType::class,[
                'required' => false,
                'label' => 'Livraison gratuite :  ',
                'attr' => array('class'=> 'form-check-input mb-2')
            ])
            ->add('groupList',EntityType::class,[
                'class' => Group::class,
                'choice_label' => 'name',
                'label' => 'Groupes :',
                'expanded' => false,
                'multiple' => true,
                'required' => false,
                'attr' => array('class'=> 'form-select mb-2')
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Valider',
                'attr' => array('class'=> 'btn btn-primary')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GoodDeal::class,
        ]);
    }
}