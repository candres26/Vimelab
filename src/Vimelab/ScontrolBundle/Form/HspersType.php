<?php

namespace Vimelab\ScontrolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class HspersType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd'))
            ->add('evento', 'choice', array('choices' => array('S' => 'Si', 'N' => 'No'), 'expanded' => 'true', 'label' => 'Accidentes en el último año'))
            ->add('operaciones', 'textarea', array('label' => 'Operaciones habituales'))
            ->add('productos', 'textarea', array('label' => 'Productos que manipula'))
            ->add('riesgos', 'textarea', array('label' => 'Riesgos a los que se expone'))
            ->add('texposicion', 'textarea', array('label' => 'Tiempo de exposición'))
            ->add('proteccion', 'textarea', array('label' => 'Protección adoptada'))
            ->add('ventilacion', 'textarea', array('label' => 'Ventilación ambiental'))
            ->add('temperatura', 'textarea', array('label' => 'Temperatura ambiental'))
            ->add('horario')
            ->add('turno')
            ->add('rotacion', 'textarea', array('label' => 'Rotación'))
            ->add('visitas', 'textarea', array('label' => 'No. Visítas al médico'))
            ->add('bajas', 'textarea', array('label' => 'No. días de baja laboral'))
            ->add('medicamentos', 'textarea', array('label' => 'Medicamentos en uso'))
            ->add('fumador', 'choice', array('choices' => array('S' => 'Si', 'N' => 'No'), 'expanded' => 'true'))
            ->add('detfumador', 'textarea', array('label' => 'Detalles fumador'))
            ->add('bebedor', 'choice', array('choices' => array('S' => 'Si', 'N' => 'No'), 'expanded' => 'true'))
            ->add('detbebedor', 'textarea', array('label' => 'Detalles bebedor'))
            ->add('efpulmon', 'textarea', array('label' => 'Enfermedades pulmón'))
            ->add('efcorazon', 'textarea', array('label' => 'Enfermedades corazón'))
            ->add('efasma', 'textarea', array('label' => 'Enfermedades asma'))
            ->add('efbronquios', 'textarea', array('label' => 'Enfermedades bronquios'))
            ->add('efcirculacion', 'textarea', array('label' => 'Enfermedades circulación'))
            ->add('efhigado', 'textarea', array('label' => 'Enfermedades hígado'))
            ->add('efgastritis', 'textarea', array('label' => 'Enfermedades gastritis'))
            ->add('efulcera', 'textarea', array('label' => 'Enfermedades úlcera'))
            ->add('efvesicula', 'textarea', array('label' => 'Cólicos de vesícula'))
            ->add('efriñon', 'textarea', array('label' => 'Cólicos de riñon'))
            ->add('efurinario', 'textarea', array('label' => 'Infecciones urinarias'))
            ->add('efartrosis', 'textarea', array('label' => 'Artrosis'))
            ->add('eflumbago', 'textarea', array('label' => 'Lumbagos'))
            ->add('efotros', 'textarea', array('label' => 'Otros'))
            ->add('alergias')
            ->add('prazucar', 'textarea', array('label' => 'Azúcar/glucosa en sangre'))
            ->add('prcolesterol', 'textarea', array('label' => 'Colesterol'))
            ->add('prurico', 'textarea', array('label' => 'Ácido úrico'))
            ->add('prhepatitis', 'textarea', array('label' => 'Hepatitis'))
            ->add('prtransaminasas', 'textarea', array('label' => 'Transaminasas altas'))
            ->add('prhipertension', 'textarea', array('label' => 'Tensión alta'))
            ->add('prhipotension', 'textarea', array('label' => 'Tensión baja'))
            ->add('prsoplos', 'textarea', array('label' => 'Soplos'))
            ->add('prarritmias', 'textarea', array('label' => 'Arritmias'))
            ->add('prhernias', 'textarea', array('label' => 'Hernias'))
            ->add('prdepresion', 'textarea', array('label' => 'Síntomas de depresión'))
            ->add('cbintestinal', 'textarea', array('label' => 'Cambios intestinales'))
            ->add('cborina', 'textarea', array('label' => 'Cambios en la orina'))
            ->add('cbpiel', 'textarea', array('label' => 'Cambios en la piel'))
            ->add('cbpeso', 'textarea', array('label' => 'Cambios de peso'))
            ->add('tetano', 'choice', array('choices' => array('S' => 'Si', 'N' => 'No'), 'expanded' => 'true', 'label' => 'Vacuna tetano'))
            ->add('tetanofecha', 'date', array('widget' => 'single_text', 'format' => 'y-MM-dd', 'label' => 'Fecha vacuna'))
            ->add('tetanodosis', 'textarea', array('label' => 'Dosis vacuna'))
            ->add('observaciones')
            ->add('mdpaci', 'entity', array('class' => 'ScontrolBundle:Mdpaci', 'label' => 'Paciente'))
        ;
    }

    public function getName()
    {
        return 'vimelab_scontrolbundle_hsperstype';
    }
}
