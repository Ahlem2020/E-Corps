<?php

namespace App\Form;

use App\Entity\Regimes;
use App\Entity\Repas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Gregwar\CaptchaBundle\Type\CaptchaType;
class RepasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('titre',TextType::class, ['attr' =>['placeholder'=>'enter title here']])
            ->add('description',TextareaType::class)
            ->add('imguml',TextType::class)
            ->add('id_regime',EntityType::class, [
                'class'  => Regimes::class,
                'choice_label' => 'titre',

            ])

            ->add('captcha', CaptchaType::class)
            ->add('ajouter',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Repas::class,
        ]);
    }
}
