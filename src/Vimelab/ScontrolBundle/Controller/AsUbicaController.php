<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vimelab\ScontrolBundle\Entity\Gbpais;
use Vimelab\ScontrolBundle\Entity\Gbdepa;
use Vimelab\ScontrolBundle\Entity\Gbciud;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

class AsUbicaController extends Controller
{
	public function indexAction()
	{
		if(Tool::isGrant($this))
        {
			$em = $this->getDoctrine()->getEntityManager();
			$paises = $em->getRepository('ScontrolBundle:Gbpais')->findBy(array(), array('nombre' => 'ASC'));		
			return $this->render('ScontrolBundle:AsUbica:index.html.twig', array('paises' => $paises));
		}
		else
			return $this->render('ScontrolBundle::alertas.html.twig');
	}
}