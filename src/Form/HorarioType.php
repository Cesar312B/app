<?php

namespace App\Form;

use App\Entity\Horario;
use App\Entity\Materia;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Dia',ChoiceType::class,[
               'choices'=>[
                'Lunes' => 'Lunes',
                'Martes' => 'Martes',
                'Miercoles' => 'Miercoles',
                'Jueves' => 'Jueves',
                'Viernes' => 'Viernes',
                'Sabado' => 'Sabado',
                'Domingo' => 'Domingo',
               ]



            ])
            ->add('Hora_inicio')
            ->add('Hora_salida')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Horario::class,
        ]);
    }
}
