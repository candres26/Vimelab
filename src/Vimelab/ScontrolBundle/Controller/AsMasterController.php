<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

use Vimelab\ScontrolBundle\Entity\Gbpers;
use Vimelab\ScontrolBundle\Entity\TcRuta;
use Vimelab\ScontrolBundle\Entity\Mdpaci;
use Vimelab\ScontrolBundle\Entity\Mdhist;
use Vimelab\ScontrolBundle\Entity\Mdpato;
use Vimelab\ScontrolBundle\Entity\Mddiag;

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
					$res[] = $caso->getId()."=>".$caso->getIdentificacion()."=>".$caso->getFullName()."=>".$caso->getGbSucu()->__toString()."=>".$caso->getSexo()."=>".$caso->getGbSucu()->getGbempr()->getId();
				
				return new Response(join("|-|", $res));
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function getRutaAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
        		$repo = $em->getRepository('ScontrolBundle:Tcruta');
        		$entities = $repo->getForEmpresa($request->request->get("param"));	
				
				$res = array();
				foreach($entities as $caso)
					$res[] = $caso->getId()."=>".$caso->__toString();
				
				return new Response(join("|-|", $res));
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function newHistoriaAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
				
					$entity = new Mdhist();
					$entity->setFecha(new \DateTime("now"));
					$entity->setMdpaci($em->getRepository('ScontrolBundle:Mdpaci')->find($request->request->get("jsPaciId")));
					$entity->setGbpers($em->getRepository('ScontrolBundle:Gbpers')->find($request->request->get("jsPersId")));
					$entity->setTcruta($em->getRepository('ScontrolBundle:Tcruta')->find($request->request->get("jsHistRut")));
					$entity->setMenstru($request->request->get("jsHistMes"));
					$entity->setTipo($request->request->get("jsHistTip"));
					
					$em->persist($entity);
					$em->flush();
					return new Response("0:Ok Revisión creada con exito!:".$entity->getId().":".$entity->getTcruta()->getId().":".$entity->getTcruta()->__toString().":".$entity->getTipo());
				}
				catch(\Exception $e)
				{
					return new Response("1:Error, imposible crear Revisión!");
				}
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function newComentarioAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
				
					$entity = $em->getRepository('ScontrolBundle:Mdhist')->find($request->request->get("jsHistId"));
					$entity->setComentario($request->request->get("jsComeDta"));
					
					$em->persist($entity);
					$em->flush();
					return new Response("0:Ok Comentario guardado con exito!");
				}
				catch(\Exception $e)
				{
					return new Response("1:Error, imposible guardar Comentario!");
				}
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function getPatologiaAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
        		$repo = $em->getRepository('ScontrolBundle:Mdpato');
        		$entities = $repo->getFilter($request->request->get("param"));	
				
				$min = intval($request->request->get("min"));
				$max = intval($request->request->get("max"));
				
				$res = array();
				foreach($entities as $caso)
				{
					if($min <= intval($caso->getCodigo()) && $max > intval($caso->getCodigo()))
						$res[] = $caso->getId()."=>".$caso->getCodigo()."=>".$caso->__toString();
				}
				
				return new Response(join("|-|", $res));
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function newDiagnosticoAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
				
					$histo = $em->getRepository('ScontrolBundle:Mdhist')->find($request->request->get("jsHistId"));
					$pato = $em->getRepository('ScontrolBundle:Mdpato')->find($request->request->get("jsPatoId"));
					
					$entity = new Mddiag();
					$entity->setMdhist($histo);
					$entity->setMdpato($pato);
					
					
					$em->persist($entity);
					$em->flush();
					return new Response("0");
				}
				catch(\Exception $e)
				{
					return new Response("1");
				}
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function getDiagnosticoAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
        		$repo = $em->getRepository('ScontrolBundle:Mddiag');
        		$entities = $repo->findByMdhist($request->request->get("param"));	
				
				$min = intval($request->request->get("min"));
				$max = intval($request->request->get("max"));
				
				$res = array();
				foreach($entities as $caso)
				{
					if($min <= intval($caso->getMdpato()->getCodigo()) && $max > intval($caso->getMdpato()->getCodigo()))
						$res[] = $caso->getId()."=>".$caso->getMdpato()->__toString();
				}
				
				return new Response(join("|-|", $res));
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function delDiagnosticoAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
	        		$repo = $em->getRepository('ScontrolBundle:Mddiag');
	        		$entity = $repo->find($request->request->get("param"));	
					
					$em->remove($entity);
					$em->flush();
					
					return new Response("0");
				}
				catch(\Exception $e)
				{
					return new Response("1");
				}
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
}
