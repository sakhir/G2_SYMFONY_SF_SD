<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('telephone')
            ->add('DateDeNaissance')
            ->add('chambre',EntityType::class, [
                'class' => Chambre::class,
                'choice_label' => function($chambre){
                    return $chambre->getNumero();
                },
            ])
            ->add('bourse', ChoiceType::class, [
                'choices'  => [
                    'Oui' => 'oui',
                    'Non' => 'non',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
