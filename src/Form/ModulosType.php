<?php

namespace App\Form;

use App\Entity\Modulos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModulosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('estado',ChoiceType::class,[
                'placeholder'=>'Cambiar Estado',
                'choices'=>[
                    'Activado'=>'Activado',
                    'Desactivado'=>'Desactivado'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Modulos::class,
        ]);
    }
}
