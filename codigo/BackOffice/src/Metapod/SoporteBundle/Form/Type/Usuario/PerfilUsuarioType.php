<?php

namespace Metapod\SoporteBundle\Form\Type\Usuario;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PerfilUsuarioType extends BaseAbstractType {

    protected $options = array(
        'name' => 'usuarioPerfil'
    );

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombre', 'text', array(
            'label' => 'Nombre',
            'constraints' => array(
                new NotBlank(array(
                    'message' => 'Valor obligatorio'
                        ))
            ),
        ));
        $builder->add('apellido', 'text', array(
            'label' => 'Apellido',
            'constraints' => array(
                new NotBlank(array(
                    'message' => 'Valor obligatorio'
                        ))
            ),
        ));
        $builder->add('direccion', 'text', array(
            'label' => 'Apellido',  
        ));
        $builder->add('email', 'email', array(
            'label' => 'Correo electrónico',
            'constraints' => array(
                new NotBlank(array(
                    'message' => 'Valor obligatorio'
                        ))
            ),
        ));
        $builder->add('fecha_nacimiento', 'text', array(
            'label' => 'Fecha de nacimiento',
            'attr' => array(
                'class' => 'datepicker'
            )
        ));
        $builder->add('avatar', 'file', array(
            'label' => 'Avatar',
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Imagen de perfil...'
            ),
        ));
        $builder->add('clave', 'repeated', array(
            'type' => 'password',
            'invalid_message' => 'Las claves no coinciden',
            'options' => array('attr' => array('class' => 'password-field')),
            'required' => true,
            'first_options' => array('attr' => array('class' => 'form-control'), "constraints" => array(new Length(array('min' => 6, 'minMessage' => 'Se necesita por lo menos 6 caracteres'))), 'label' => 'Clave'),
            'second_options' => array('attr' => array('class' => 'form-control'), "constraints" => array(new Length(array('min' => 6, 'minMessage' => 'Se necesita por lo menos 6 caracteres'))), 'label' => 'Repetir Clave'),));
    }

}
