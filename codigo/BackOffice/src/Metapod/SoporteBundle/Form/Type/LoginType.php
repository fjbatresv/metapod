<?php

namespace Metapod\SoporteBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginType extends BaseAbstractType {

    protected $options = array(
        'name' => 'login'
    );

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('usuario', 'text', array(
            'constraints' => array(new NotBlank(array(
                'message' => 'Valor obligatorio'
            ))),
            'label' => ' ',
            'attr' => array(
                'class' => 'form-control placeholder-no-fix',
                'autocomplete' => 'off',
                'placeholder' => 'Usuario'
            )
        ));
        $builder->add('pass', 'password', array(
            'label' => ' ',
            'constraints' => array(new NotBlank(array(
                'message' => 'Valor obligatorio'
            ))),
            'attr' => array(
                'class' => 'form-control placeholder-no-fix',
                'autocomplete' => 'off',
                'placeholder' => 'Clave'
            )
        ));
    }

}
