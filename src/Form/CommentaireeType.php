<?php

namespace App\Form;

use App\Entity\Commentairee;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment')
            ->add('iduser',EntityType::class,[
                'class' => Event::class,
                "label"=>"User Type",
                'choice_value'=>NULL

            ])

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
            'data_class' => Commentairee::class,
        ]);
    }
}

