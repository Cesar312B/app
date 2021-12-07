<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category',ChoiceType::class,[
                'choices' => [
                    'foo' => 'foo',
                    'bar' => 'bar'
                ]
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $e) {
                $data= $e->getData();
                $form= $e->getForm();
                $cat= isset($data['category'])?$data['category']:null;
               
                if ($cat == 'bar') {
                    $form->add('template',TextType::class,[
                        'label'=>'label1',
                        'constraints' => [
                            new NotBlank([
                                'message' => 'Please enter your email',
                            ]),
                        ],
                    ]);
                }elseif($cat =='foo'){
                     $form->add('template',TextType::class,[
                         'label'=>'label2',
                         'constraints' => [
                            new NotBlank([
                                'message' => 'Please enter your email',
                            ]),
                        ],
                     ]);
                }
            })   
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
