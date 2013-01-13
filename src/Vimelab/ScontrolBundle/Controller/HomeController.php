<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
	public function indexAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$al = $em->getRepository('ScontrolBundle:Ctcont')->getAlertas();
		$ah = $em->getRepository('ScontrolBundle:Mdhist')->getAlertas();

		return $this->render('ScontrolBundle:Home:home.html.twig', array('alertas' => $al, 'historias' => $ah));
	}
}

