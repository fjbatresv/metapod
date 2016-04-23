<?php

namespace Metapod\SoporteBundle\Controller\Usuario;

use Admingenerated\MetapodSoporteBundle\BaseUsuarioController\NewController as BaseNewController;
use Exception;
use Metapod\SoporteBundle\Model\Usuario;
use Metapod\SoporteBundle\Model\UsuarioQuery;
use Swift_Message;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * NewController
 */
class NewController extends BaseNewController {

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

    public function createAction() {


        $Usuario = $this->getNewObject();

        $this->preBindRequest($Usuario);
        $form = $this->createForm($this->getNewType(), null, $this->getFormOptions($Usuario));
        $form->bind($this->get('request'));
        $valores = $form->getData();
        $validar = UsuarioQuery::create()
                ->filterByUsername($valores['username'])
                ->findOne();
        if ($validar) {
            $this->get('session')->getFlashBag()->add('notificaciones', array(
                'mostrar' => true,
                'mensaje' => 'Ya existe un usuario con este nombre.',
                'titulo' => 'Usuario existente',
                'estado' => 'error'
            ));
            return $this->render('MetapodSoporteBundle:UsuarioNew:index.html.twig', $this->getAdditionalRenderParameters($Usuario) + array(
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
                    return new RedirectResponse($this->generateUrl("Metapod_SoporteBundle_Usuario_edit", array('pk' => $Usuario->getId())));
            } catch (Exception $e) {
                $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans("action.object.edit.error", array(), 'Admingenerator'));
                $this->onException($e, $form, $Usuario);
            }
        } else {
            $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans("action.object.edit.error", array(), 'Admingenerator'));
        }

        return $this->render('MetapodSoporteBundle:UsuarioNew:index.html.twig', $this->getAdditionalRenderParameters($Usuario) + array(
                    "Usuario" => $Usuario,
                    "form" => $form->createView(),
        ));
    }

    protected function saveObject(Usuario $Usuario) {
        $clave = uniqid();
        $Usuario->setPassword(hash('sha1', $clave));
        $Usuario->save();
        $texto = '<html>
                    <head><title>Bienvenido a CuponesSpike</title></head>
                        <body>
                        <p>Bienvenido a CuponesSpike, sus datos para acceder al mismo son:</p>
                            </br>
                            <p>Nombre de usuario: <b> "' . $Usuario->getUsername() . '"</b>. </p></br>
                            <p>Clave: <b>"' . $clave . '"</b>.</p>
                                </body>
                                </html>';
        $message = Swift_Message::newInstance()
                ->setSubject('Bienvenido a CuponesSpike')
                ->setFrom($this->container->getParameter('mailer_user'))
                ->setContentType("text/html")
                ->setTo($Usuario->getEmail())
                ->setBody($texto, 'text/html');
        $this->get('mailer')->send($message);
    }

}
