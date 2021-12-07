<?php

namespace App\Form;

use App\Entity\Notas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class Parcial3Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('nota11',NumberType::class,[
            'label'=>'Gestión del Aprendizaje 1'  
          ]
          )
         

        ->add('nota12',NumberType::class,[
            'label'=>'Gestión del Aprendizaje 2'  
          ])
         
          
        ->add('nota13',NumberType::class,[
            'label'=>'Gestión del Aprendizaje 3'  
          ])
          

        ->add('nota14',NumberType::class,[
            'label'=>'Gestión del Aprendizaje 4'  
          ])
         

        ->add('nota15',NumberType::class,[
            'label'=>'Gestión del Aprendizaje 5'  
          ])

        

        ->add('nota_supletorio')
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notas::class,
        ]);
    }
}
