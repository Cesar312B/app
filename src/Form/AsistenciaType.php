<?php

namespace App\Form;

use App\Entity\Asistencia;
use App\Entity\Periodo;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class AsistenciaType extends AbstractType
{
  

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('Asistencia')
            ->add('periodo',EntityType::class,[
                'class'=> Periodo::class,
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('p')
                    ->orderBy('p.Fecha', 'DESC');

                },
                'choice_label'=>'Periodo'
            ])
             ->add('Fecha',DateTimeType::class,[

                'data' => new \DateTime(),
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia'
                   
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Asistencia::class,
        ]);
    }
}
