<?php

namespace Metapod\SoporteBundle\Form\Type\Usuario;

use Metapod\SoporteBundle\Model\PerfilQuery;
use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UsuarioPerfilType extends BaseAbstractType {

    private $perfil;
    protected $options = array(
        'name' => 'ediatPerfilesUsuario',
    );

    public function __construct($profile) {
        $this->perfil = $profile;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $perfilestmp = PerfilQuery::create();
        if ($this->perfil) {
            $perfiles = $perfilestmp->find();
        } else {
            $perfilestmp->where('id != 1');
            $perfiles = $perfilestmp->find();
        }
        $builder->add('Perfiles', 'model', array(
            'class' => 'Metapod\SoporteBundle\Model\Perfil',
            'property' => 'nombre',
            'attr' => array('class' => 'select2 select2-hidden-accessible', 'multiple' => '', 'style' => 'width: 100%;'),
            'multiple' => 'true',
        ));
    }

}
