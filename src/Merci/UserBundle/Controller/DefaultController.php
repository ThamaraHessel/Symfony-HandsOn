<?php

namespace Merci\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Merci\UserBundle\Entity\User;
use Merci\UserBundle\Form\UserType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends Controller
{
    public function loginAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('checkout'));
        }

        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'MerciUserBundle:Default:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    public function registerAction()
    {
        $request = $this->getRequest();

        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // automatic login user
            $providerKey = 'secured_area'; // Name of firewall
            $token = new UsernamePasswordToken($user, null, $providerKey, array('AUTO_LOGIN'));
            $this->container->get('security.context')->setToken($token);

            return $this->redirect($this->generateUrl('checkout'));
        }

        return $this->render('MerciUserBundle:Default:register.html.twig',
            array('form' => $form->createView())
        );
    }
}
