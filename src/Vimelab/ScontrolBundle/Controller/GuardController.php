<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Login controller.
 *
 * @Route("/login")
 */
class GuardController extends Controller
{
    public function loginAction()
    {  
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        else
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);

        return $this->render
                    (
                        'ScontrolBundle:Login:login.html.twig',
                        array
                        (
                            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                            'error'         => $error
                        )
                    );
    }
}

