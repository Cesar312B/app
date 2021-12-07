<?php

namespace App\Form;

use App\Entity\Notas;
use App\Entity\Periodo;
use App\Entity\Student;
use App\Entity\Materia;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class fullType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nota1')
            ->add('nota2')
            ->add('nota3')
            ->add('nota4')
            ->add('nota5')
            ->add('nota6')
            ->add('nota7')
            ->add('nota8')
            ->add('nota9')
            ->add('nota10')
            ->add('nota11')
            ->add('nota12')
            ->add('nota13')
            ->add('nota14')
            ->add('nota15')
       
        
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notas::class,
        ]);
    }
}
