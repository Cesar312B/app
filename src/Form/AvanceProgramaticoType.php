<?php

namespace App\Form;

use App\Entity\AvanceProgramatico;
use App\Entity\Periodo;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvanceProgramaticoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('Detalle')
            ->add('Tema')
             ->add('Avance')
            ->add('Fecha',DateTimeType::class,[
              
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day'
                   
                ]  
            ])
            ->add('periodo', EntityType::class,[
                'class'=>Periodo::class,
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('p')
                    ->orderBy('p.Fecha', 'DESC');

                },  
                'choice_label'=>'Periodo'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AvanceProgramatico::class,
        ]);
    }
}
