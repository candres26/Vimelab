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
	
	public function getPaisesAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$paises = $em->getRepository('ScontrolBundle:Gbpais')->findBy(array(), array('nombre' => 'ASC'));
				
				$parr = array();
				foreach($paises as $caso)
					$parr[] = $caso->getId().'=>'.$caso->getNombre();
				
				$parr = join('|:|', $parr);
				$parr = $parr == '' ? '%' : $parr;
				
				return new Response($parr);
			}
			else
				return $this->redirect($this->generateUrl('as_ubica'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function getProvsAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$depa = $em->getRepository('ScontrolBundle:Gbdepa')->getForPais($request->request->get('asPais'));
				
				$parr = array();
				foreach($depa as $caso)
					$parr[] = $caso->getId().'=>'.$caso->getNombre();
				
				$parr = join('|:|', $parr);
				$parr = $parr == '' ? '%' : $parr;
				
				return new Response($parr);
			}
			else
				return $this->redirect($this->generateUrl('as_ubica'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function getCiudsAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$ciuds = $em->getRepository('ScontrolBundle:Gbciud')->getForDepa($request->request->get('asProv'));
				
				$parr = array();
				foreach($ciuds as $caso)
				{
					$tmp = $caso->getId();
					$tmp = $tmp.'=>'.strtoupper($caso->getGbdepa()->getGbpais()->getCodigo().'-'.$caso->getGbdepa()->getCodigo().'-'.$caso->getCodigo());
					$tmp = $tmp.'=>'.$caso->getGbdepa()->getGbPais()->getNombre();
					$tmp = $tmp.'=>'.$caso->getGbdepa()->getNombre();
					$tmp = $tmp.'=>'.$caso->getNombre();
					$parr[] = $tmp;
				}
				$parr = join('|:|', $parr);
				$parr = $parr == '' ? '%' : $parr;
				
				return new Response($parr);
			}
			else
				return $this->redirect($this->generateUrl('as_ubica'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function addPaisAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				try
				{
					$entity = new Gbpais();
					$entity->setCodigo($request->request->get('paisCode'));
					$entity->setNombre($request->request->get('paisName'));
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
				return $this->redirect($this->generateUrl('as_ubica'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function addProvAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				try
				{
					$pais = $em->getRepository('ScontrolBundle:Gbpais')->findOneById($request->request->get('asPais'));	
						
					$entity = new Gbdepa();
					$entity->setGbpais($pais);
					$entity->setCodigo($request->request->get('provCode'));
					$entity->setNombre($request->request->get('provName'));
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
				return $this->redirect($this->generateUrl('as_ubica'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function addCiudAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				try
				{
					$depa = $em->getRepository('ScontrolBundle:Gbdepa')->findOneById($request->request->get('asProv'));	
						
					$entity = new Gbciud();
					$entity->setGbdepa($depa);
					$entity->setCodigo($request->request->get('asCode'));
					$entity->setNombre($request->request->get('asName'));
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
				return $this->redirect($this->generateUrl('as_ubica'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function delCiudAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				try
				{	
					$em = $this->getDoctrine()->getEntityManager();
					$entity = $em->getRepository('ScontrolBundle:Gbciud')->find($request->request->get('id'));
					$em->remove($entity);
					$em->flush();
					
					return new Response("&");
				}
				catch (\Exception $e)
				{
					return new Response("%");
				}
			}
			else
				return $this->redirect($this->generateUrl('as_ubica'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
}