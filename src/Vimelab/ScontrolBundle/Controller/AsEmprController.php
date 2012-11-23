<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vimelab\ScontrolBundle\Entity\Gbcarg;
use Vimelab\ScontrolBundle\Entity\Gbpers;
use Vimelab\ScontrolBundle\Entity\Gbusua;
use Vimelab\ScontrolBundle\Entity\Gbvars;
use Vimelab\ScontrolBundle\Entity\Gbacls;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

class AsEmprController extends Controller
{
	public function indexAction()
	{
		if(Tool::isGrant($this))
        {
			$em = $this->getDoctrine()->getEntityManager();
			$tm = $em->getRepository('ScontrolBundle:Gbcnae')->findBy(array(), array('actEcon' => 'ASC'));
			
			$ac = array();
			foreach ($tm as $cs) 
			{
				if($cs->getActEcon() != 'NULL')
					$ac[] = $cs;	
			}
				
			return $this->render('ScontrolBundle:AsEmpr:index.html.twig', array('actividades' => $ac));
		}
		else
			return $this->render('ScontrolBundle::alertas.html.twig');
	}
	
}
