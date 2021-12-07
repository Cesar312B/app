<?php

namespace App\Form;

use App\Entity\Employed;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Regex;


class EmployedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Cedula',TextType::class,[
            'label'=>'NÚMERO DE IDENTIFICACIÓN',

            'constraints' => [new Regex([
                'pattern'=>'/^[0-9,$]*$/',
                'message' =>"El campo solo debe tener números"
             ])
        ]   
        ])
            ->add('Nombre',TextType::class,[
                'label'=>'NOMBRES',

               'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('Apellido',TextType::class,[
                'label'=>'APELLIDOS',

                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('email',EmailType::class,[
                'label'=>'E-MAIL',

                'required' =>false,
            ])
            ->add('foto',FileType::class,[
                'label' => 'FOTO DE USUARIO (JPG) 500Kb',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

               
                'required' => false,
            

                'constraints' => [
                    new File([
                        'maxSize' => '500k',
                        'mimeTypes' => [
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Porfavor subir una imagen en formato jpg',
                    ])
                ],
           ])

            ->add('Fecha_Ingreso',DateTimeType::class,[
                'label' => 'FECHA DE INGRESO',
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia'
                   
                ]

            ])
            ->add('Contrato',ChoiceType::class,[
                'label' => 'CONTRATO',
                'choices'  => [
                    'Tiempo Completo' => 'Tiempo Completo',
                    'Medio Tiempo' => 'Medio Tiempo',
                  ]
            ])
            ->add('Profesion',TextType::class,[
                'label'=>'PROFESIÓN',

                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                  'ROLE_SECRETARIA' => 'ROLE_SECRETARIA', 
                  'ROLE_PROFESOR' => 'ROLE_PROFESOR',
                ],
            ])
            ->add('is_active')
        ;



             
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employed::class,
        ]);
    }
}
