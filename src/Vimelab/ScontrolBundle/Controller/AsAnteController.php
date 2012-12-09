<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

use Vimelab\ScontrolBundle\Entity\Mdpaci;

class AsAnteController extends Controller
{
	public function indexAction()
	{
		if(Tool::isGrant($this))
		{	
			return $this->render('ScontrolBundle:AsAnte:index.html.twig', array());
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
					$res[] = array($caso->getId(), $caso->getIdentificacion(), $caso->getFullName(), $caso->getGbSucu()->__toString(),
					$caso->getSexo(), $caso->getGbptra()->getId(), $caso->getGbptra()->getNombre(), $caso->getNacimiento()->format('Y-m-d'));
				
				return new Response(Tool::toJail($res));
			}
			else
				return $this->redirect($this->generateUrl('as_ante'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
}
