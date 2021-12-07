<?php

namespace App\Form;
use App\Entity\Employed;
use App\Entity\Grupo;
use App\Entity\Paralelo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ParaleloType_edit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('estado',ChoiceType::class,[
            'choices'=>[
             'Activado' => 'Activado',
             'Desactivdo' => 'Desactivdo',
            ]
         ])
            ->add('grupo',EntityType::class,[
                'class'=> Grupo::class,
                'choice_label'=>'Nombre'
            ])    
            ->add('employed',EntityType::class,[
                'label' => 'Profesor',
                'class'=> Employed::class,
                'required' => false,
                'placeholder'     =>'Seleccione un profesor',
                'choice_label'=>function (Employed $materia) {
                    return  $materia->getNombre(). ' ' . $materia->getApellido();
                },
            ]);  
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paralelo::class,
        ]);
    }
}
