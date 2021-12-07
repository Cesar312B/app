<?php

namespace App\Form;

use App\Entity\Student;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;



 /**
  * @param FormBuilderInterface $builder
  * @param array $options
 */
class StudenteditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('tipo_identificacion',ChoiceType::class,[
            'required' => false,
            'placeholder'=>'TIPO DE DOCUMENTO DE IDENTIFICACIÓN',
            'choices'=>[
             'Cedula' => 'Cedula',
             'Pasaporte' => 'Pasaporte',
             
            ]
        ])

        ->add('Cedula',TextType::class,[
            'label'=>'Numero de Identificacion'
        ])

       
        ->add('Nombre',TextType::class,[
           
            'attr' => ['class' => 'text-uppercase' ], 
        ])
        ->add('Apellido',TextType::class,[
           
            'attr' => ['class' => 'text-uppercase' ], 
        ])
      
        ->add('sexo',ChoiceType::class,[
            'required' => false,
            'placeholder'=>'SELECCIONE SEXO',
            'choices'=>[
             'Masculino' => 'Masculino',
             'Femenino' => 'Femenino',
            ]
        ])
        ->add('correo',EmailType::class,[
            
            'required' => false,
        ])
        ->add('n_convencional',NumberType::class,[
          
            'required' => false,
        ])
        ->add('direccion',TextType::class,[
            
            'required' => false,
            'attr' => ['class' => 'text-uppercase' ], 
        ])  
        ->add('codigo_postal',TextType::class,[
            
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('contacto',TextType::class,[
               
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('parentesco',TextType::class,[
               
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('n_contacto',NumberType::class,[
                
                'required' => false,
            ])
            ->add('etnia',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'SELECCIONE ETNIA',
                'choices'=>[
                 'Indígena' => 'Indígena',
                 'Afroecuatoriano' => 'Afroecuatoriano',
                 'Mulato' => 'Mulato',
                 'Montuvio' => 'Montuvio',
                 'Mestizo' => 'Mestizo',
                 'Blanco' => 'Blanco',

                ]
            ])
            ->add('descripcion',TextType::class,[
                
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('idioma_ancestral',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'HABLA UN IDIOMA ANCESTRAL',
                'choices'=>[
                 'Sí' => 'Sí',
                 'No' => 'No',
                ]
            ])
            ->add('idioma_descripcion',TextType::class,[
               
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('tipo_sangre',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'TIPO DE SANGRE',
                'choices'=>[
                 'A+' => 'A+',
                 'A-' => 'A-',
                 'B+' => 'B+',
                 'B-' => 'B-',
                 'AB+' => 'AB+',
                 'AB-' => 'AB-',
                 'O+' => 'O+',
                 'O-' => 'O-',
                ]
            ])
            ->add('categoria_mogratoria',ChoiceType::class,[
            
                'required' => false,
                'placeholder'=>'CATEGORÍA MIGRATORIA',
                'choices'=>[
                 'Ciudadano' => 'Ciudadano',
                 'Residente permanente' => 'Residente permanente',
                 'Residente transitorio o no residente' => 'Residente transitorio o no residente',
                 'Residente temporal ' => 'Residente temporal ',
                 'Refugiado ' => 'Refugiado ',
                ]
            ])
            ->add('Pais_ridencia',TextType::class,[
                
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('provincia_recidencia',TextType::class,[
              
                'required' => false,
                
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('estado_civil',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'ESTADO CIVIL',
                'choices'=>[
                 'Soltero' => 'Soltero',
                 'Casado' => 'Casado',
                 'Viudo' => 'Viudo',
                 'Divorciado' => 'Divorciado',
                 'Unión libre' => 'Unión libre',
                ]
            ])
            ->add('discapacidad',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'TIENE DISCAPACIDAD',
                'choices'=>[
                 'Sí' => 'Sí',
                 'No' => 'No',
                ]
            ])
            ->add('n_conadis',TextType::class,[
                'label'=>'NÚMERO CONADIS',
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('porcentaje_discapacidad',NumberType::class,[
                'label'=>'PORCENTAJE DISCAPACIDAD',
                'required' => false,
            ])
            ->add('tipo_discapacidad',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'TIPO DISCAPACIDAD',
                'choices'=>[
                 'Auditiva' => 'Auditiva',
                 'Intelectual' => 'Intelectual',
                 'Física' =>'Física',
                 'Mental' =>'Mental',
                 'Visual' => 'Visual',
                 'Ninguna' =>'Ninguna',
                ]
            ])
            ->add('tipo_colegio',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'TIPO DE COLEGIO',
                'choices'=>[
                 'Fiscal' => 'Fiscal',
                 'Fiscomisional' => 'Fiscomisional',
                 'Particula' =>'Particula',
                 'Municipal' =>'Municipal',
                 'Extranjero' => 'Extranjero',
                ]
            ])
            ->add('tipo_bachillerato',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'TIPO DE BACHILLERATO',
                'choices'=>[
                 'Técnico' => 'Técnico',
                 'Técnico productivo' => 'Técnico productivo',
                 'BGU' =>'BGU',
                ]
            ])
            ->add('titulo_superior',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'POSEE TÍTULO DE EDUCACIÓN SUPERIOR',
                'choices'=>[
                 'Sí' => 'Sí',
                 'No' => 'No',
                ]
            ])
            ->add('titulo_especifico',TextType::class,[
                
                'required' => false,
                'attr' => ['class' => 'text-uppercase' ], 
            ])
            ->add('motivo_ingresos',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'MOTIVO DE INGRESOS ECONÓMICOS',
                'choices'=>[
                 'Sostener sus estudios' => 'Sostener sus estudios',
                 'Para mantener a su familia' => 'Para mantener a su familia',
                 'Gastos personales' =>'Gastos personales',
                 'Ninguno' =>'Ninguno',
                ]
            ])
            ->add('formacion_padre',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'FORMACIÓN DEL PADRE',
                'choices'=>[
                 'Centro de alfabetización' => 'Centro de alfabetización',
                 'Secundaria' => 'Secundaria',
                 'Postgrado' =>'Postgrado',
                 'Jardín de infantes' =>'Jardín de infantes',
                 'Educación media' =>'Educación media',
                 'Primaria' =>'Primaria',
                 'Superior no universitario' =>'Superior no universitario',
                 'Educación básica' =>'Educación básica',
                 'Superior universitario' =>'Superior universitario',
                ]
            ])
            ->add('formacion_madre',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'FORMACIÓN DE LA MADRE',
                'choices'=>[
                 'Centro de alfabetización' => 'Centro de alfabetización',
                 'Secundaria' => 'Secundaria',
                 'Postgrado' =>'Postgrado',
                 'Jardín de infantes' =>'Jardín de infantes',
                 'Educación media' =>'Educación media',
                 'Primaria' =>'Primaria',
                 'Superior no universitario' =>'Superior no universitario',
                 'Educación básica' =>'Educación básica',
                 'Superior universitario' =>'Superior universitario',
                ]

            ])
            ->add('n_miembrosfamilia',NumberType::class,[
                
                'required' => false,
            ])
            ->add('bono_humano',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'¿USTED O ALGÚN FAMILIAR RECIBE EL BONO DE DESARROLLO HUMANO?',
                'choices'=>[
                 'Sí' => 'Sí',
                 'No' => 'No',
                ]
            ])
            ->add('ingresos_hogar',NumberType::class,[
                'label'=>'Ingresos hogar',
                'required' => false,
            ])
            ->add('repetdo_materia',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'¿HA REPETIDO UNA MATERIA?',
                'choices'=>[
                 'Si' => 'Si',
                 'No' => 'No',
                ]
            ])
            ->add('perdida_gratuidad',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'¿HA PERDIDO LA GRATUIDAD DE MATRÍCULA?',
                'choices'=>[
                 'Si' => 'Si',
                 'No' => 'No',
                ]
            ])
            ->add('practicas_preprofesionales',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'¿HA REALIZADO PRÁCTICAS REPROFESIONALES?',
                'choices'=>[
                 'Sí' => 'Sí',
                 'No' => 'No',
                ]
            ])
            ->add('n_horapracticas')
            ->add('tipo_institucion_practicas',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'TIPO DE INSTITUCIÓN',
                'choices'=>[
                 'Pública ' => 'Pública',
                 'Privada' => 'Privada',
                 'ONG' => 'ONG',
                 'Ninguno' => 'Ninguno',
                ]

            ])
            ->add('sector_ecomomico_practicas',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'¿INDIQUE EL SECTOR ECONÓMICO EN EL QUE REALIZA PRÁCTICAS PREPROFESIONALES ?',
                'choices'=>[
                    '1.Agricultura,ganadería,silvicultura y pesca' => '1.Agricultura,ganadería,silvicultura y pesca',
                    '2.Explotación de minas y canteras' => '2.Explotación de minas y canteras',
                    '3.Industrias manufactureras' => '3.Industrias manufactureras',
                    '4.Suministro de electricidad,gas,vapor y aire acondicionado' => '4.Suministro de electricidad,gas,vapor y aire acondicionado',
                    '5.Distribución de agua,alcantarillado,gestión de desechos y actividades de saneamiento' => '5.Distribución de agua,alcantarillado,gestión de desechos y actividades de saneamiento',
                    '6.Construcción' => '6.Construcción',
                    '7.Comercio al por mayor y al por menor rearación de vehículos automotores y motocicletas' => '7.Comercio al por mayor y al por menor rearación de vehículos automotores y motocicletas',
                    '8.Trasporte y almacenamiento' => '9.Trasporte y almacenamiento',
                    '9.Actividades de alojamiento y de servicio de comidas' => '10.Actividades de alojamiento y de servicio de comidas',
                    '10.Información y comunicación bienes y servicios para uso propio' => '11.Información y comunicación bienes y servicios para uso propio',
                    '11.Actividades financieras y de seguros' => '12.Actividades financieras y de seguros',
                    '12.Actividades inmobiliarias' => '13.Actividades inmobiliarias',
                    '13.Actividades profesionales,científicas y técnicas' => '14.Actividades profesionales,científicas y técnicas',
                    '14.Actividades de servicios administrativos y de apoyo' => '15.Actividades de servicios administrativos y de apoyo',
                    '15.Administración pública y defensa; planes de seguridad social de afiliación obligatoria' => '16.Administración pública y defensa; planes de seguridad social de afiliación obligatoria',
                    '16.Enseñanza' => '17.Enseñanza',
                    '17.Actividades de atención de la salud humana y de asistencia' => '18.Actividades de atención de la salud humana y de asistencia',
                    '18.Artes,entretenimiento y recreación' => '19.Artes,entretenimiento y recreación',
                    '19.Otras actividades de servicio' => '20.Otras actividades de servicio',
                    '20.Actividades de los hogares como productoresde bienes y servicios para uso propio' => '21.Actividades de los hogares como productoresde bienes y servicios para uso propio',
                    '21.Ninguna' => '22.Ninguna',
                   ]
            ])
            ->add('practica_instituto',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'¿HA PARTICIPADO EN ALGÚN PROYECTO DE VINCULACIÓN CON LA SOCIEDAD EN EL INSTITUTO?',
                'choices'=>[
                 'Sí' => 'Sí',
                 'No' => 'No',
                ]
            ])
            ->add('alcance_proyecto_vinculacion',ChoiceType::class,[

                'required' => false,
                'placeholder'=>' ¿CUÁL ES EL ALCANCE DEL PROYECTO DE VINCULACIÓN CON LA SOCIEDAD?',
                'choices'=>[
                 'Nacional' => 'Nacional',
                 'Provincial' => 'Provincial',
                'Cantonal' => 'Cantonal',
                'Parroquial' => 'Parroquial',
                'Ninguna' => 'Ninguna'
                ]
            ])
            ->add('estdo_laboral',ChoiceType::class,[
                'label'=>'Estado laboral',
                'required' => false,
                'placeholder'=>'ESTADO LABORAL',
                'choices'=>[
                 'Si' => 'Solamente al estudio',
                 'No' => 'Trabaja y estudia',
                ]
            ])
            ->add('sector_economico_laboral',ChoiceType::class,[
                'required' => false,
                'placeholder'=>'¿INDIQUE CUÁL ES EL SECTOR ECONÓMICO DE LA EMPRESA?',
                'choices'=>[
                    '1.Agricultura,ganadería,silvicultura y pesca' => '1.Agricultura,ganadería,silvicultura y pesca',
                    '2.Explotación de minas y canteras' => '2.Explotación de minas y canteras',
                    '3.Industrias manufactureras' => '3.Industrias manufactureras',
                    '4.Suministro de electricidad,gas,vapor y aire acondicionado' => '4.Suministro de electricidad,gas,vapor y aire acondicionado',
                    '5.Distribución de agua,alcantarillado,gestión de desechos y actividades de saneamiento' => '5.Distribución de agua,alcantarillado,gestión de desechos y actividades de saneamiento',
                    '6.Construcción' => '6.Construcción',
                    '7.Comercio al por mayor y al por menor rearación de vehículos automotores y motocicletas' => '7.Comercio al por mayor y al por menor rearación de vehículos automotores y motocicletas',
                    '8.Trasporte y almacenamiento' => '9.Trasporte y almacenamiento',
                    '9.Actividades de alojamiento y de servicio de comidas' => '10.Actividades de alojamiento y de servicio de comidas',
                    '10.Información y comunicación bienes y servicios para uso propio' => '11.Información y comunicación bienes y servicios para uso propio',
                    '11.Actividades financieras y de seguros' => '12.Actividades financieras y de seguros',
                    '12.Actividades inmobiliarias' => '13.Actividades inmobiliarias',
                    '13.Actividades profesionales,científicas y técnicas' => '14.Actividades profesionales,científicas y técnicas',
                    '14.Actividades de servicios administrativos y de apoyo' => '15.Actividades de servicios administrativos y de apoyo',
                    '15.Administración pública y defensa; planes de seguridad social de afiliación obligatoria' => '16.Administración pública y defensa; planes de seguridad social de afiliación obligatoria',
                    '16.Enseñanza' => '17.Enseñanza',
                    '17.Actividades de atención de la salud humana y de asistencia' => '18.Actividades de atención de la salud humana y de asistencia',
                    '18.Artes,entretenimiento y recreación' => '19.Artes,entretenimiento y recreación',
                    '19.Otras actividades de servicio' => '20.Otras actividades de servicio',
                    '20.Actividades de los hogares como productoresde bienes y servicios para uso propio' => '21.Actividades de los hogares como productoresde bienes y servicios para uso propio',
                    '21.Ninguna' => '22.Ninguna',
                   ]
            ])
    
       
        
            ->add('fecha_nacimiento',BirthdayType::class,[
                'label'=>'FECHA NACIMIENTO',
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
                ]
            ])
           
            ->add('Pais',ChoiceType::class,[
                'placeholder'=>'PAÍS DE NACIMIENTO',
                'choices'=>[
                   
                    'Ecuador'=>'Ecuador',
                    'Extranjero'=>'Extranjero'
                ]
            ])
            ->add('Provincia',ChoiceType::class,[
                'placeholder'=>'SELECCIONE UNA PROVINCIA',
                'choices'=>[
                    'Provincias' => [
                    'Esmeraldas'=>'Esmeraldas',
                    'Manabí'=>'Manabí',
                    'Los Ríos'=>'Los Ríos',
                    'Santa Elena'=>'Santa Elena',
                    'Guayas'=>'Guayas',
                    'Santo Domingo Tsáchilas'=> 'Santo Domingo Tsáchilas',
                    'El Oro'=>'El Oro',
                    'Azuay'=>'Azuay',
                    'Bolívar'=>'Bolívar',
                    'Cañar'=>'Cañar',
                    'Carchi'=>'Carchi',
                    'Cotopaxi'=>'Cotopaxi',
                    'Chimborazo'=>'Chimborazo',
                    'Imbabura'=>'Imbabura',
                    'Loja'=>'Loja',
                    'Pichincha'=>'Pichincha',
                    'Tungurahua'=>'Tungurahua',
                    'Morona Santiago'=>'Morona Santiago',
                    'Napo'=>'Napo',
                    'Orellana'=>'Orellana',
                    'Pastaza'=>'Pastaza',
                    'Sucumbíos'=>'Sucumbíos',
                    'Zamora Chinchipe'=>'Zamora Chinchipe',
                    'Galápagos'=>'Galápagos'
                    ],
                    'Otros' => [
                        'Extranjero' => 'Extranjero'
                    ],

                ]
            ])
            ->add('Telefono',TextType::class,[
                'label'=>'TELEFONO',
                'constraints' => [new Regex([
                    'pattern'=>'/^[0-9,$]*$/',
                    'message' =>"El camapo solo debe tener numeros"
                 ])
            ] ])
            ->add('Financiamiento',ChoiceType::class,[
                'placeholder'=>'TIPO DE FINANCIAMIENTO',
                'choices'=>[
                    'Estatal' => 'Estatal',
                    'Fiscomisional' => 'Fiscomisional',
                    
                   ]
            ])
            ->add('Fecha_Ingreso',DateTimeType::class,[
                'label'=>'FECHA INGRESO',
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia'
                   
                ],

            ])
            ->add('is_active',CheckboxType::class,[
                'required' => false,
                'label'=>'Activar/Desactivar'
            ])
            ->getForm();    
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
