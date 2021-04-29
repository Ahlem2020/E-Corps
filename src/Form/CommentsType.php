<?php

namespace App\Form;

use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,[
                'label'=>"Votre Email",
                'attr'=>[
                    'class' => 'form-control',

                ]
            ])
            ->add('nickname',TextType::class,[
                'label'=>"Votre Pseudo",
                'attr'=>[
                    'class' => 'form-control',

                ]
            ])
            ->add('content',CKEditorType::class,[
                'label'=>"Votre Email",
                'attr'=>[
                    'class' => 'form-control',

                ]
            ])
            ->add('rgpd',CheckboxType::class)
            ->add('parentid',HiddenType::class,[
                'mapped'=> false

            ])
            ->add("Envoyer",SubmitType::class,[
                'attr'=>[
                    'class' =>"btn btn-form",

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
