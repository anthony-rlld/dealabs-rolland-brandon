<?php


namespace App\Form;


use App\Entity\Group;
use App\Entity\PromotionnalCode;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromoCodeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //   $repo = $this->getDoctrine()->getRepository(Category::class);
        //   $categs = $repo->findAll();


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
                'label' => 'Lien du code promo :',
                'attr' => array('class'=> 'form-control mb-2')
            ])
            ->add('reductionType', TextType::class,[
                'required' => false,
                'label' => 'Type de réduction :',
                'attr' => array('class'=> 'form-control mb-2')
            ])
            ->add('code',TextType::class,[
                'required' => true,
                'label' => 'Code :  ',
                'attr' => array('class'=> 'form-control mb-2')
            ])
            ->add('groupsList',EntityType::class,[
                'class' => Group::class,
                'label' => 'Groupes :',
                'expanded' => false,
                'multiple' => true,
                'required' => false,
                'attr' => array('class'=> 'form-select mb-2')
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Créer le form',
                'attr' => array('class'=> 'btn btn-primary')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PromotionnalCode::class,
        ]);
    }
}