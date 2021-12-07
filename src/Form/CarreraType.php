<?php

namespace App\Form;

use App\Entity\Carrera;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarreraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Carrera',TextType::class,[
                'label'=>'CARRERA',
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('Area',TextType::class,[
                'label'=>'ÁREA',
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('tipo_carrera',TextType::class,[
                'label'=>'TIPO CARRERA',
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('modalidad_carrera',TextType::class,[
                'label'=>'MODALIDAD CARRERA',
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('titulo_carrera',TextType::class,[
                'label'=>'TÍTULO CARRERA',
                'attr' => ['class' => 'text-uppercase' ], 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carrera::class,
        ]);
    }
}
