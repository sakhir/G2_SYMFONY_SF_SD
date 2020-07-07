<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('tel')
            ->add('DateDeNaissance')
<<<<<<< HEAD
=======

>>>>>>> 92a49d6438dfd68375d9a9b1cf53e1f332ede4ba
            ->add('bourse', ChoiceType::class, [
                'choices'  => [
                    'Oui' => 'oui',
                    'Non' => 'non',
                ],
<<<<<<< HEAD
            ]);

            $formModifier = function (FormInterface $form= null, Etudiant $bourse = null) {
    
                $form->add('chambre', EntityType::class, [
                    'class' => Chambre::class,
                    'choice_label' => function($numero){
                        return $numero->getNumero();
                    }
                ]);
            };
    
            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) use ($formModifier) {
                    // this would be your entity, i.e. bourseMeetup
                    $data = $event->getData();
    
                    $formModifier($event->getForm(), $data->getBourse());
                }
            );
    
            $builder->get('bourse')->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) use ($formModifier) {
                    // It's important here to fetch $event->getForm()->getData(), as
                    // $event->getData() will get you the client data (that is, the ID)
                    $bourse = $event->getForm()->getData();
                    dump($bourse);
                    // since we've added the listener to the child, we'll have to pass on
                    // the parent to the callback functions!
                    $formModifier($event->getForm()->getParent(), $bourse);
                }
            );
=======
            ])
            ->add('chambre',EntityType::class, [
                'class' => Chambre::class,
                'choice_label' => function($chambre){
                    return $chambre->getNumero();
                },
            ])
        ;
>>>>>>> 92a49d6438dfd68375d9a9b1cf53e1f332ede4ba
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
