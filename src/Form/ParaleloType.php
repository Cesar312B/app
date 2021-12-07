<?php

namespace App\Form;

use App\Entity\Carrera;
use App\Entity\Grupo;
use App\Entity\Materia;
use App\Entity\Paralelo;
use App\Entity\Periodo;
use App\Repository\MateriaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ParaleloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('estado',ChoiceType::class,[
            'choices'=>[
             'Activado' => 'Activado',
             'Desactivado' => 'Desactivado',
            ]
         ])
            ->add('grupo',EntityType::class,[
                'class'=> Grupo::class,
                'choice_label'=>'Nombre'
            ])
            ->add('Carrera',EntityType::class,[
                'class'=>Carrera::class,
                'choice_label' => 'Carrera',
                
                'placeholder'=>'Seleccione una Carrera',
                'mapped'=> false
            
            ]);

            
        $builder->get('Carrera')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event){
               $form = $event->getForm();
               $form->getParent()->add('Materia',EntityType::class,[
             'class'=>Materia::class,
             'query_builder'=> function(MateriaRepository $er){
              return $er->createQueryBuilder('m')
              ->innerJoin('m.nivel','p','p.')
              ->orderBy('p.Nivel','ASC');
             },
             'group_by' => function (Materia $country) {
                    
                return $country->getNivel()->getNivel();
           
             },
             'choice_label'=>'Materia', 
             'placeholder'=>'Seleccione una Materia',
             'choices'=> $form->getData()->getMaterias()
               ]);

            });


            $builder->addEventListener(
                FormEvents::POST_SET_DATA,
                function(FormEvent $event){
                    $form= $event->getForm();
                    $data=$event->getData();
                    $materia= $data->getmateria();
                    if($materia){
                        $form->get('Carrera')->setData($materia->getCarrera());
                        $form->add('Materia',EntityType::class,[
                            'class'=>Materia::class, 
                            'placeholder'=>'Seleccione una Materia',
                            'choices'=>$materia->getCarrera()->getMaterias()

                        ]);

                    }else{
                        $form->add('Materia',EntityType::class,[
                            'class'=>Materia::class,
                            'placeholder'=>'Seleccione una Materia',
                            'choices'=>[]


                        ]);
                    }
                }

            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paralelo::class,
        ]);
    }
}
