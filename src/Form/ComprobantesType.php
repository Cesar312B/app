<?php

namespace App\Form;

use App\Entity\Comprobantes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ComprobantesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('archivo',FileType::class,[
                'label' => 'Archivo(PDF) 300 KB',
    
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
    
                // make it optional so you don't have to re-upload the PDF file
                // everytime you edit the Product details
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '300k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Porfavor subir un archivo en formato PDF',
                    ])
                ],


            ])
            ->add('fecha',BirthdayType::class,[
                'data' => new \DateTime(),
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia'
                   
                ]
            ])
  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comprobantes::class,
        ]);
    }
}
