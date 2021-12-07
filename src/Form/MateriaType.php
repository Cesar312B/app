<?php

namespace App\Form;

use App\Entity\Carrera;
use App\Entity\Materia;
use App\Entity\Nivel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MateriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Materia',TextType::class,[
            'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('Nivel',EntityType::class,[
                'class'=>Nivel::class,
                'choice_label'=>'Nivel'
            ])
            ->add('Carrera',EntityType::class,[
                'class'=>Carrera::class,
                'choice_label'=>'Carrera'
            ])
            ->add('Duracion',NumberType::class,[

              'label'=>'Total horas clases'
            ])

           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materia::class,
        ]);
    }
}
