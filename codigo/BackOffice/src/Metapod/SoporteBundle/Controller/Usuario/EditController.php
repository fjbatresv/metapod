<?php

namespace Metapod\SoporteBundle\Controller\Usuario;

use Admingenerated\MetapodSoporteBundle\BaseUsuarioController\EditController as BaseEditController;
use Metapod\SoporteBundle\Model\Usuario;
use Metapod\SoporteBundle\Model\UsuarioQuery;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

/**
 * EditController
 */
class EditController extends BaseEditController {

    public function indexAction($pk) {
        $Usuario = $this->getObject($pk);

        if (!$Usuario) {
            throw new NotFoundHttpException("The Metapod\SoporteBundle\Model\Usuario with Id $pk can't be found");
        }

        $this->preBindRequest($Usuario);
        $form = $this->createForm($this->getEditType(), null, $this->getFormOptions($Usuario));
        if (!$form->getData()) {
            $form['nombre']->setData($Usuario->getNombre());
            $form['apellido']->setData($Usuario->getApellido());
            $form['username']->setData($Usuario->getUsername());
            $form['direccion']->setData($Usuario->getDireccion());
            $form['email']->setData($Usuario->getEmail());
            $form['EstadoUsuario']->setData($Usuario->getEstadoUsuario());
            if($Usuario->getFechaNacimiento()){
             $form['fecha_nacimiento']->setData($Usuario->getFechaNacimiento()->format('Y-m-d'));   
            }
        }
        return $this->render('MetapodSoporteBundle:UsuarioEdit:index.html.twig', $this->getAdditionalRenderParameters($Usuario) + array(
                    "Usuario" => $Usuario,
                    "form" => $form->createView(),
        ));
    }

    public function updateAction($pk) {
        $Usuario = $this->getObject($pk);



        if (!$Usuario) {
            throw new NotFoundHttpException("The Metapod\SoporteBundle\Model\Usuario with Id $pk can't be found");
        }

        $this->preBindRequest($Usuario);
        $form = $this->createForm($this->getEditType(), null, $this->getFormOptions($Usuario));
        $form->bind($this->get('request'));
        $valores = $form->getData();
        $validar = UsuarioQuery::create()
                ->filterByUsername($valores['username'])
                ->where('id != ' . $Usuario->getId())
                ->findOne();
        if ($validar) {
            $this->get('session')->getFlashBag()->add('notificaciones', array(
                    'mostrar' => true,
                    'mensaje' => 'Ya existe un usuario con este nombre.',
                    'titulo' => 'Usuario existente',
                    'estado' => 'error'
                ));
            return $this->render('MetapodSoporteBundle:UsuarioEdit:index.html.twig', $this->getAdditionalRenderParameters($Usuario) + array(
                    "Usuario" => $Usuario,
                    "form" => $form->createView(),
        ));
        }
        if ($form->isValid()) {
            try {

                $this->preSave($form, $Usuario);
                $this->saveObject($Usuario);
                $this->postSave($form, $Usuario);

                $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans("action.object.edit.success", array(), 'Admingenerator'));

                if ($this->get('request')->request->has('save-and-add'))
                    return new RedirectResponse($this->generateUrl("Metapod_SoporteBundle_Usuario_new"));
                if ($this->get('request')->request->has('save-and-list'))
                    return new RedirectResponse($this->generateUrl("Metapod_SoporteBundle_Usuario_list"));
                else
                    return new RedirectResponse($this->generateUrl("Metapod_SoporteBundle_Usuario_edit", array('pk' => $pk)));
            } catch (\Exception $e) {
                $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans("action.object.edit.error", array(), 'Admingenerator'));
                $this->onException($e, $form, $Usuario);
            }
        } else {
            $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans("action.object.edit.error", array(), 'Admingenerator'));
        }

        return $this->render('MetapodSoporteBundle:UsuarioEdit:index.html.twig', $this->getAdditionalRenderParameters($Usuario) + array(
                    "Usuario" => $Usuario,
                    "form" => $form->createView(),
        ));
    }

    public function preSave(Form $form, Usuario $Usuario) {
        $valores = $form->getData();
        $Usuario->setFechaNacimiento(strtotime($valores['fecha_nacimiento']));
        $Usuario->setNombre($valores['nombre']);
        $Usuario->setApellido($valores['apellido']);
        $Usuario->setUsername($valores['username']);
        $Usuario->setEmail($valores['email']);
        $Usuario->setEstadoUsuarioId($valores['EstadoUsuario']->getId());
        $Usuario->setDireccion($valores['direccion']);
    }

}
