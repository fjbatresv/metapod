<?php

namespace Metapod\SoporteBundle\Controller;

use Metapod\SoporteBundle\Form\Type\Usuario\PerfilUsuarioType;
use Metapod\SoporteBundle\Form\Type\Usuario\UsuarioPerfilType;
use Metapod\SoporteBundle\Model\PerfilQuery;
use Metapod\SoporteBundle\Model\UsuarioPerfil;
use Metapod\SoporteBundle\Model\UsuarioPerfilQuery;
use Metapod\SoporteBundle\Model\UsuarioQuery;
use Propel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of UsuarioController
 *
 * @author javier
 */
class UsuarioController extends Controller {

    public function perfilAction(Request $request) {
        $Usuario = UsuarioQuery::create()
                ->findOneById($this->getUser()->getId());
        $form = $this->createForm(new PerfilUsuarioType());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $valores = $form->getData();
            $Usuario->setFechaNacimiento(strtotime($valores['fecha_nacimiento']));
            $Usuario->setNombre($valores['nombre']);
            $Usuario->setApellido($valores['apellido']);
            $Usuario->setEmail($valores['email']);
            $Usuario->setDireccion($valores['direccion']);
            if ($valores['clave']) {
                if ((ereg_replace("[^0-9]", "", $valores['clave']) && ereg_replace("[0-9]", "", $valores['clave']))) {
                    $Usuario->setPassword(hash('sha1', $valores['clave']));
                }
            }
            if ($valores['avatar']) {
                if ($Usuario->getAvatar() && file_exists($Usuario->getAvatar())) {
                    unlink($Usuario->getAvatar());
                }
                $ext = end((explode(".", $valores['avatar']->getClientOriginalName())));
                $nombre = $valores['avatar']->getClientOriginalName();
                $archivo = hash('sha1', $nombre . date('Y-m-d_H:i:s') . uniqid()) . '.' . $ext;
                $valores['avatar']->move('usuarios/avatares/'
                        , $archivo);
                $Usuario->setAvatar('usuarios/avatares/' . $archivo);
            }
            $Usuario->save();
            $this->get('session')->getFlashBag()->add('notificaciones', array(
                'mostrar' => true,
                'mensaje' => 'Tu perfil se ha actulizado exitosamente',
                'titulo' => 'Perfil modificado',
                'estado' => 'success'
            ));
        }
        if (!$form->getData()) {
            $form['nombre']->setData($Usuario->getNombre());
            $form['apellido']->setData($Usuario->getApellido());
            $form['direccion']->setData($Usuario->getDireccion());
            $form['email']->setData($Usuario->getEmail());
            if ($Usuario->getFechaNacimiento()) {
                $form['fecha_nacimiento']->setData($Usuario->getFechaNacimiento()->format('Y-m-d'));
            }
        }
        return $this->render('MetapodSoporteBundle:Usuario:perfil.html.twig', array(
            'form' => $form->createView(),
            'usuario' => $Usuario
        ));
    }

    public function editarPerfilAction(Request $request) {
        $usuarioActual = $request->get('pk');
        $error = '';
        $perfiles = array();
        $perfil = UsuarioQuery::create()
                ->filterById($this->getUser()->getId())
                ->useUsuarioPerfilQuery()
                ->usePerfilQuery()
                ->filterById(1)
                ->endUse()
                ->endUse()
                ->findOne();
        $usuario = UsuarioQuery::create()
                ->filterById($request->get('pk'))
                ->findOne();
        $usuarioPerfilesTmp = UsuarioPerfilQuery::create()
                ->filterByUsuarioId($usuarioActual);
        if ($perfil) {
            $usuarioPerfiles = $usuarioPerfilesTmp->find();
        } else {
            $usuarioPerfilesTmp->where('perfil_id !=1');
            $usuarioPerfiles = $usuarioPerfilesTmp->find();
        }
        $perfilesdb = PerfilQuery::create();
        if ($perfil) {
            $perfildb = $perfilesdb->find();
        } else {
            $perfilesdb->where('id != 1');
            $perfildb = $perfilesdb->find();
        }
        $form = $this->createForm(new UsuarioPerfilType($perfil));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $perfiles = $form['Perfiles']->getData();
            if (sizeof($perfiles) > 0) {
                $con = Propel::getConnection();
                $con->beginTransaction();
                UsuarioPerfilQuery::create()
                        ->filterByUsuarioId($request->get('pk'))
                        ->find()->delete();
                foreach ($perfiles as $perfil) {
                    $perfilNuevo = new UsuarioPerfil();
                    $perfilNuevo->setUsuarioId($request->get('pk'));
                    $perfilNuevo->setPerfilId($perfil->getId());
                    $perfilNuevo->save();
                }
                $con->commit();
                $this->get('session')->getFlashBag()->add('notificaciones', array(
                    'mostrar' => true,
                    'mensaje' => 'Los cambios en los perfilesdel usuario se han realizado exitosamente.',
                    'titulo' => 'Perfiles modificados',
                    'estado' => 'success'
                ));
                return new RedirectResponse($this->generateUrl('Metapod_SoporteBundle_Usuario_list'));
            } else {
                $error = 'Debes seleccionar minimo una de las opciones.';
            }
        }
        if (!$form->getData()) {
            $perfiles = PerfilQuery::create()
                    ->useUsuarioPerfilQuery()
                    ->filterByUsuarioId($request->get('pk'))
                    ->endUse()
                    ->find();
            $form['Perfiles']->setData($perfiles);
        }
        return $this->render('MetapodSoporteBundle:Usuario:UsuarioPerfiles.html.twig', array(
                    'form' => $form->createView(),
                    'nombre' => $usuario->getUserName(),
                    'error' => $error, 'pk' => $request->get('pk')
        ));
    }

}
