<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vimelab\ScontrolBundle\Entity\Gbptra;
use Vimelab\ScontrolBundle\Entity\Mdprot;
use Vimelab\ScontrolBundle\Entity\Mdques;
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
				return new Response($this->listPuestos($request));
			}
			else
				return $this->redirect($this->generateUrl('as_protocolo'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function newPuestoAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$empr = $em->getRepository('ScontrolBundle:Gbempr')->findOneById($request->request->get('asEmpr'));
				$entity  = new Gbptra();
				$entity->setGbempr($empr);
				$entity->setNombre($request->request->get('newTraName'));
				$em->persist($entity);
				$em->flush();
				
				return new Response('!'.$this->listPuestos($request));
			}
			else
				return $this->redirect($this->generateUrl('as_protocolo'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function newProtocoloAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$entity  = new Mdprot();
				$entity->setCodigo($request->request->get('newProCode'));
				$entity->setNombre($request->request->get('newProName'));
				$em->persist($entity);
				$em->flush();
				
				return new Response('!'.$this->listProtocolos($request));
			}
			else
				return $this->redirect($this->generateUrl('as_protocolo'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function getQuesAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$ques = $em->getRepository('ScontrolBundle:Mdques')->getForProtocolo($request->request->get('asProt'));
				
				$parr = array();
				foreach($ques as $caso)
					$parr[] = $caso->getId().'=>'.$caso->getPregunta();
				
				$parr = join('|:|', $parr);
				$parr = $parr == '' ? '%' : $parr;
							
				return new Response($parr);
			}
			else
				return $this->redirect($this->generateUrl('as_protocolo'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function delQuesAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				try
				{	
					$em = $this->getDoctrine()->getEntityManager();
					$entity = $em->getRepository('ScontrolBundle:Mdques')->find($request->request->get('id'));
					$em->remove($entity);
					$em->flush();
					
					return new Response("!");
				}
				catch (\Exception $e)
				{
					return new Response("%");
				}
			}
			else
				return $this->redirect($this->generateUrl('as_protocolo'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function addQuesAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$prot = $em->getRepository('ScontrolBundle:Mdprot')->findOneById($request->request->get('asProt'));
				$entity  = new Mdques();
				$entity->setMdprot($prot);
				$entity->setPregunta($request->request->get('protQues'));
				$em->persist($entity);
				$em->flush();
				
				return new Response('!!');
			}
			else
				return $this->redirect($this->generateUrl('as_protocolo'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	private function listPuestos($request)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$puestos = $em->getRepository('ScontrolBundle:Gbptra')->getForEmpresa($request->request->get('asEmpr'));
		
		$parr = array();
		foreach($puestos as $caso)
			$parr[] = $caso->getId().'=>'.$caso->getNombre();
		
		$parr = join('|:|', $parr);
		$parr = $parr == '' ? '%' : $parr;
		
		return $parr;
	}
	
	private function listProtocolos($request)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$protocolos = $em->getRepository('ScontrolBundle:Mdprot')->listAll();
		
		$parr = array();
		foreach($protocolos as $caso)
			$parr[] = $caso->getId().'=>'.$caso->getNombre();
		
		$parr = join('|:|', $parr);
		$parr = $parr == '' ? '%' : $parr;
		
		return $parr;
	}
}