<?php

namespace App\Form;

use App\Entity\Produit;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomProduit')
            ->add('Description', CKEditorType::class, [
                'config'=> [
                    'uiColor' => "#e2e2e2",
                    'toolbar' => 'full',
                    'required' => true

                ]
            ])
            ->add('Prix', NumberType::class,[
                'invalid_message' => 'veuillez saisir un prix convenable'
            ])
            ->add('Quantite')
            ->add('Image',FileType::class, [
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                //modification
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez ajouter une IMAGE',
                    ])
                ],])
            ->add('Categories')
            ->add('Reports')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            'csrf_protection' => false,
        ]);
    }
}
