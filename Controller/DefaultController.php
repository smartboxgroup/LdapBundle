<?php

namespace IMAG\LdapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function loginAction(Request $request)
    {
        return $this->render('IMAGLdapBundle:Default:login.html.twig', array(
            'last_username' => $request->getSession()->get(Security::LAST_USERNAME),
            'error'         => $this->getAuthenticationError($request),
            'token'         => $this->generateToken(),
        ));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function getAuthenticationError(Request $request)
    {
        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            return $request->attributes->get(Security::AUTHENTICATION_ERROR);
        }

        return $request->getSession()->get(Security::AUTHENTICATION_ERROR);
    }

    protected function generateToken()
    {
        return $this->get('security.csrf.token_manager')->getToken('authenticate');
    }
}
