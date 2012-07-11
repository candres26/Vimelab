<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vimelab\ScontrolBundle\Entity\Gbcarg;
use Vimelab\ScontrolBundle\Entity\Gbpers;
use Vimelab\ScontrolBundle\Entity\Gbusua;
use Vimelab\ScontrolBundle\Entity\Gbvars;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

class AsSecuController extends Controller
{
	public function indexAction()
	{
		if(Tool::isGrant($this))
        {
			$em = $this->getDoctrine()->getEntityManager();
			$cargos = $em->getRepository('ScontrolBundle:Gbcarg')->findBy(array(), array('nombre' => 'ASC'));
			
			return $this->render('ScontrolBundle:AsSecu:index.html.twig', array('cargos' => $cargos));
		}
		else
			return $this->render('ScontrolBundle::alertas.html.twig');
	}
	
	public function getCargoAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$cargos = $em->getRepository('ScontrolBundle:Gbcarg')->findBy(array(), array('nombre' => 'ASC'));
				
				$parr = array();
				foreach($cargos as $caso)
					$parr[] = $caso->getId().'=>'.$caso->getNombre();
				
				$parr = join('|:|', $parr);
				$parr = $parr == '' ? '%' : $parr;
				
				return new Response($parr);
			}
			else
				return $this->redirect($this->generateUrl('as_secu'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function getPersAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$pers = $em->getRepository('ScontrolBundle:Gbpers')->getForCargo($request->request->get('selCarg'));
				
				$parr = array();
				foreach($pers as $caso)
					$parr[] = $caso->getId().'=>'.$caso->getFullName();
				
				$parr = join('|:|', $parr);
				$parr = $parr == '' ? '%' : $parr;
				
				return new Response($parr);
			}
			else
				return $this->redirect($this->generateUrl('as_secu'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function getUsuaAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$usua = $em->getRepository('ScontrolBundle:Gbusua')->getForPersonal($request->request->get('selPers'));
				
				$parr = array();
				foreach($usua as $caso)
					$parr[] = $caso->getId().'=>'.$caso->getNombre();
				
				$parr = join('|:|', $parr);
				$parr = $parr == '' ? '%' : $parr;
				
				return new Response($parr);
			}
			else
				return $this->redirect($this->generateUrl('as_secu'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function addCargoAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				try
				{
					$entity = new Gbcarg();
					$entity->setNombre($request->request->get('cargName'));
					$em->persist($entity);
					$em->flush();
					
					return new Response('!');
				}
				catch(\Exception $e)
				{
					return new Response('#');
				}
			}
			else
				return $this->redirect($this->generateUrl('as_secu'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function addUsuaAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				try
				{
					$pers = $pais = $em->getRepository('ScontrolBundle:Gbpers')->findOneById($request->request->get('selPers'));	
						
					$entity = new Gbusua();
					$entity->setGbpers($pers);
					$entity->setNombre($request->request->get('usuaName'));
					
					$factory = $this->get('security.encoder_factory');
					$encoder = $factory->getEncoder($entity);
					$pass = $encoder->encodePassword($request->request->get('usuaPass'), $entity->getSalt());
					$entity->setClave($pass);
					
					$em->persist($entity);
					$em->flush();
					
					return new Response('!');
				}
				catch(\Exception $e)
				{
					return new Response('#');
				}
			}
			else
				return $this->redirect($this->generateUrl('as_secu'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
}