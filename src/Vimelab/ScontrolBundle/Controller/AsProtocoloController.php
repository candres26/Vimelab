<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

class AsProtocoloController extends Controller
{
	public function indexAction()
	{
		if(Tool::isGrant($this))
        {	
			$em = $this->getDoctrine()->getEntityManager();
			$empresas = $em->getRepository('ScontrolBundle:Gbempr')->findBy(array(), array('nombre' => 'ASC'));
			$protocolos = $em->getRepository('ScontrolBundle:Mdprot')->findBy(array(), array('nombre' => 'ASC'));
			return $this->render("ScontrolBundle:AsProtocolo:index.html.twig", array('empresas' => $empresas, "protocolos" => $protocolos));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function getPuestoAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$puestos = $em->getRepository('ScontrolBundle:Gbptra')->getForEmpresa($request->request->get('asEmpr'));
				
				$parr = array();
				foreach($puestos as $caso)
					$parr[] = $caso->getId().'=>'.$caso->getNombre();
				
				$parr = join('|:|', $parr);	
				return new Response($parr);
			}
			else
				return $this->redirect($this->generateUrl('as_protocolo'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
}