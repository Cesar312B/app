<?php

namespace App\Form;

use App\Entity\Notas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Parcial1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nota1',NumberType::class,[
              'label'=>'Gestión del Aprendizaje 1'  
            ]
            )
            ->add('nota2',NumberType::class,[
                'label'=>'Gestión del Aprendizaje 2'  
              ]
              )
      
            ->add('nota3',NumberType::class,[
                'label'=>'Gestión del Aprendizaje 3'  
              ])
           
            ->add('nota4',NumberType::class,[
                'label'=>'Gestión del Aprendizaje 4'  
              ])
            
            ->add('nota5',NumberType::class,[
                'label'=>'Gestión del Aprendizaje 5'  
              ])
          


            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notas::class,
        ]);
    }
}
