<?php

namespace Sweepo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sweepo\UserBundle\Entity\User;
use Sweepo\UserBundle\Form\UserType;

class BackendController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('SweepoUserBundle:Backend:login.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    /**
     * @Route("/create-account", name="signin")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(new UserType($this->get('translator')), $user);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();
                $user->encodePassword($this->get('security.encoder_factory'));
                $em->persist($user);
                $em->flush();

                // Login
                $authToken = new UsernamePasswordToken($user, null, 'secured_area', array('ROLE_USER'));
                $this->get('security.context')->setToken($authToken);

                // Flash message
                $this->get('session')->getFlashBag()->add('success', 'create');

                return $this->redirect($this->generateUrl('index'));
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }
}