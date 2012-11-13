<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

use Vimelab\ScontrolBundle\Entity\Gbpers;

class AsMasterController extends Controller
{
	public function indexAction()
	{
		if(Tool::isGrant($this))
		{
			$secu = $this->get('security.context');
			$ussys = $secu->getToken()->getUser();
			
			$em = $this->getDoctrine()->getEntityManager();
			$entity = $em->getRepository('ScontrolBundle:Gbpers')->getForUser($ussys);
				
			return $this->render('ScontrolBundle:AsMaster:index.html.twig', array('GbPers' => $entity));
		}
		else
			return $this->render('ScontrolBundle::alertas.html.twig');
	}
	
}
