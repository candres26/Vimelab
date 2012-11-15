<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

use Vimelab\ScontrolBundle\Entity\Gbpers;
use Vimelab\ScontrolBundle\Entity\Mdpaci;

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
	
	public function getPacienteAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
        		$repo = $em->getRepository('ScontrolBundle:Mdpaci');
        		$entities = $repo->getFor($request->request->get("param"));	
				
				$res = array();
				foreach($entities as $caso)
					$res[] = $caso->getId()."=>".$caso->getIdentificacion()."=>".$caso->getFullName()."=>".$caso->getGbSucu()->getNombre()."=>".$caso->getSexo();
				
				return new Response(join("|-|", $res));
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
}
