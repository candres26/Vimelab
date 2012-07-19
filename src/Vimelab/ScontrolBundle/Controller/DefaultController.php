<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	public function getUserAction()
	{
		$secu = $this->get('security.context');
		$ussys = $secu->getToken()->getUser();
		
		return new Response($ussys);
	}
	
	public function setKeyAction()
	{
		$request = $this->getRequest();
    	if($request->isXmlHttpRequest())
		{
			try
			{
				$oldPass = $request->request->get('keyPass0');
				$newPass = $request->request->get('keyPass1');
					
				$em = $this->getDoctrine()->getEntityManager();
				$secu = $this->get('security.context');
				$factory = $this->get('security.encoder_factory');
				
				$ussys = $secu->getToken()->getUser();
				$user = $em->getRepository('ScontrolBundle:Gbusua')->findOneBy(array('nombre' => $ussys));
				
				$encoder = $factory->getEncoder($user);
				$oldPass = $encoder->encodePassword($oldPass, $user->getSalt());
				$newPass = $encoder->encodePassword($newPass, $user->getSalt());
				
				if($user->getClave() == $oldPass)
				{
					$user->setClave($newPass);	
					$em->persist($user);
					$em->flush();
					return new Response("Cambio De Clave Exitoso!");
				}
				else
					return new Response("Clave Actual Incorrecta, Imposible Cambiar Clave!");
			}
			catch(\Exception $e)
			{
				return new Response("Imposible Cambiar Clave!");
			}
		}
		else
			return $this->redirect($this->generateUrl('home'));
	}
}
