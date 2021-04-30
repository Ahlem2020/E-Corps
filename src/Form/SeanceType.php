<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Seance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreseance',null, array('label' => false))
            ->add('descseance',null, array('label' => false))
            ->add('dateseance',null, array('label' => false))
            ->add('idcoach',null, array('label' => false))
            ->add('idroutine',null, array('label' => false))
            ->add('groupe', EntityType::class, [
                'class' => Groupe::class,
                'choice_label' => "nomclass",
                'placeholder' => "Choisir une classe",
                'multiple' => false,
                'mapped' => false,
                'required' => false,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
        ]);
    }
}
