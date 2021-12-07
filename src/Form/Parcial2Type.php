<?php

namespace App\Form;

use App\Entity\Notas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class Parcial2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              ->add('nota6',NumberType::class,[
                'label'=>'Gestión del Aprendizaje 1'  
              ])
              
              ->add('nota7',NumberType::class,[
                'label'=>'Gestión del Aprendizaje 2' 
              ])
              
              ->add('nota8',NumberType::class,[
                'label'=>'Gestión del Aprendizaje 3' 
              ])
              
              ->add('nota9',NumberType::class,[
                'label'=>'Gestión del Aprendizaje 4' 
              ])
              
              ->add('nota10',NumberType::class,[
                'label'=>'Gestión del Aprendizaje 5' 
              ])
             
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notas::class,
        ]);
    }
}
