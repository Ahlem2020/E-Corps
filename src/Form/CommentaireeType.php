<?php

namespace App\Form;

use App\Entity\Commentairee;
use App\Entity\Compte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CommentaireeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message')
            ->add('idEvent',EntityType::class,[
                'class' => Event::class,
                'choice_label' => 'nomEvent',
                'mapped' => false,
                'required' => false
            ])
            ->add('comptelogin',EntityType::class,[
                'class' => Compte::class,
                'choice_label' => 'comptelogin',
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentairee::class,
        ]);
    }
}
