<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Participante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comptelogin')
            ->add('idEvent',EntityType::class,[
                'class' => Event::class,
                'choice_label' => 'nomEvent',
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participante::class,
        ]);
    }
}
