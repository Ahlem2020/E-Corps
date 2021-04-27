<?php

namespace App\Form;

use App\Entity\Categorieevent;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\ChoiceList\ChoiceList;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEvent', null, array('label' => false))

            ->add('descriptionEvent',null, array('label' => false))
            ->add('isactive',ChoiceType::class,[
                'choices'=>[
                    'Active'=>0,
                    'Desactiver'=>1

                ],
                "label"=>"Status"

            ])
            ->add('dateDebEvent', null, array('label' => false))
            ->add('dateFinEvent', null, array('label' => false))


            ->add('categoriee',EntityType::class,[
                'class' => Categorieevent::class,
                'choice_label' =>function(Categorieevent $category){
                return $category->getCategoriee(). '  '.$category->getNamecat();
                },
                'mapped' => false,
                'required' => false
            ])
            ->add('imageevent', FileType::class, [
                'label' => 'Image (JPG/PNG file)',

            ])


            ->add('nbr_Participant', null, array('label' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
