<?php

namespace App\Form;

use App\Entity\Carrera;
use App\Entity\Materia;
use App\Entity\Notas;
use App\Entity\Paralelo;
use App\Entity\Periodo;
use App\Repository\MateriaRepository;
use App\Repository\ParaleloRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NotasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Periodo',EntityType::class,[
                'class'=>Periodo::class,
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('p')
                    ->orderBy('p.Fecha', 'DESC');

                },  
                'choice_label'=>'Periodo'
            ])
            ->add('jornada',ChoiceType::class,[
              'placeholder'=>'Seleccione el tipo de jornada',
              'choices'=>[
                'Matutina' => 'Matutina',
                'Vespertina' => 'Vespertina',
                'Nocturna' => 'Nocturna',
               ]
            ])

            ->add('tipo_matricula',ChoiceType::class,[
              'placeholder'=>'Seleccione el tipo de Matricula',
              'choices'=>[
                'Ordinaria' => 'Ordinaria',
                'Extraordinaria' => 'Extraordinaria',
                'Especial' => 'Especial',
               
               ]
            ])
            ->add('Estado',ChoiceType::class,[
              'choices'=>[
               'Nuevo' => 'Nuevo',
               'Segunda Matricula' => 'Segunda Matricula',
               'Tercera Matricula' => 'Tercera Matricula',
              
              ]
           ])

            ->add('carrera',EntityType::class,[
                'class'=>Carrera::class,
                'placeholder'=>'Seleccione una Carrera',
                'choice_label'=>'Carrera',
                'mapped'=> false,
                'required'=> false
            ])
            ->getForm()
            ;

            $builder->get('carrera')->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event){
                    $form = $event->getForm();
                    $this->addMateriaField($form->getParent(), $form->getData());
                });
                

                $builder->addEventListener(
                    FormEvents::PRE_SET_DATA,
                    function (FormEvent $event) {
                      $data = $event->getData();
                     
                      
                      $form = $event->getForm();
                      if (null !== $paralelo = $data->getParalelo()) {
                       
                        $materia = $paralelo->getMateria();
                        $carrera = $materia->getCarrera();
                        
                        $this->addMateriaField($form, $carrera);
                        $this->addParaleloField($form, $materia);
                    
                        $form->get('carrera')->setData($carrera);
                        $form->get('materia')->setData($materia);
                        $qb = $event->getForm()->getConfig()->getOption('query_builder');
                        $qb->orWhere('c =:paralelo')->setParameter('paralelo', $paralelo);
                      
                      } else {
                        $this->addMateriaField($form, null);
                        $this->addParaleloField($form, null);
                        
                      }
                    }
                );
    }

    private function addMateriaField( FormInterface $form, ?Carrera $carrera ){
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'materia',
            EntityType::class,
            null,
            [
              'class'           => Materia::class,
              'placeholder'     => $carrera ? 'Seleccione una Materia' : 'Seleccione una Carrera primero ',
              'query_builder'=> function(MateriaRepository $er){
                return $er->createQueryBuilder('m')
                ->innerJoin('m.nivel','p','p.');
               },
               'group_by' => function (Materia $country) {
                    
                return $country->getNivel()->getNivel();
           
             },
              'choice_label'=> 'Materia',

              'mapped'          => false,
              'required'        => false,
              'auto_initialize' => false,
              'choices'         => $carrera ? $carrera->getMaterias() : []
              
            ]
         );

         $builder->addEventListener(
             FormEvents::POST_SUBMIT,
             function(FormEvent $event){
                $form = $event->getForm();
                $this->addParaleloField($form->getParent(), $form->getData());
            }
            );

        $form->add($builder->getForm());

    }

    private function addParaleloField( FormInterface $form, ?Materia $materia)
    {
      $form->add('paralelo', EntityType::class, [
          'class'       => Paralelo::class,
          'placeholder' => $materia ? 'Seleccione un Paralelo' : 'Seleccione una Materia primero',
          'query_builder'=> function(ParaleloRepository $er){
            return $er->createQueryBuilder('m')
            ->leftJoin('m.grupo','p','p.')
            ;
           },
          'choice_label'=> function (Paralelo $materia) {
            return  $materia->getGrupo()->getNombre(). ' Estado=' . $materia->getEstado();
        },
          'choices'     => $materia ? $materia->getParalelos() : []
        ]);

    }
     

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notas::class,
            'class' => Paralelo::class,
            'query_builder' => function (ParaleloRepository $r) {
                return $r->createQueryBuilder('c')
                ->andWhere($r->expr()->like('c.estado', ':estado'))
                ->setParameter('estado','%Activdo%');
                ;
            },
        ]);
    }
}
