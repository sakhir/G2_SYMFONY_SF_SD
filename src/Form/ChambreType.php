<?php

namespace App\Form;

use App\Entity\Chambre;
use App\Entity\Batiment;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Double' => 'double',
                    'Individuel' => 'individuel',
                ],
            ])
            ->add('numeroBatiment',EntityType::class, [
                'class' => Batiment::class,
                'choice_label' => function($numeroBatiment){
                    return $numeroBatiment->getNumero();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
