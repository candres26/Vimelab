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
}
