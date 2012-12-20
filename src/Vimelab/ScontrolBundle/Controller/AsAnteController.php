<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

use Vimelab\ScontrolBundle\Entity\Mdpaci;
use Vimelab\ScontrolBundle\Entity\Hsfami;
use Vimelab\ScontrolBundle\Entity\Hslabo;
use Vimelab\ScontrolBundle\Entity\Hspers;

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

	public function getFamiliarAction()
	{
		if(Tool::isGrant($this))
		{
			$request = $this->getRequest();
			if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$repo = $em->getRepository('ScontrolBundle:Hsfami');
				$entities = $repo->findByMdpaci($request->request->get("paci"));	
				
				$res = array();
				foreach($entities as $caso)
					$res[] = array($caso->getId(), $caso->getMdpato()->getNombre(), $caso->getFamiliar(), $caso->getDetalle());
				
				return new Response(Tool::toJail($res));
			}
			else
				return $this->redirect($this->generateUrl('as_ante'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function delFamiliarAction()
	{
		if(Tool::isGrant($this))
		{
			$request = $this->getRequest();
			if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
					$repo = $em->getRepository('ScontrolBundle:Hsfami');
					$entity = $repo->find($request->request->get("fami"));	
					
					$em->remove($entity);
					$em->flush();
					
					return new Response("0-Antecedente Familiar Eliminado Con Exito!");
				}
				catch(\Exception $e)
				{
					return new Response("1-Imposible Eliminar Antecedente Familiar!");
				}
			}
			else
				return $this->redirect($this->generateUrl('as_ante'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function getLaboralAction()
	{
		if(Tool::isGrant($this))
		{
			$request = $this->getRequest();
			if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$repo = $em->getRepository('ScontrolBundle:Hslabo');
				$entities = $repo->findByMdpaci($request->request->get("paci"));	
				
				$res = array();
				foreach($entities as $caso)
					$res[] = array($caso->getId(), $caso->getEmpresa(), $caso->getFingreso()->format('Y-m-d'), $caso->getPuesto());
				
				return new Response(Tool::toJail($res));
			}
			else
				return $this->redirect($this->generateUrl('as_ante'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function delLaboralAction()
	{
		if(Tool::isGrant($this))
		{
			$request = $this->getRequest();
			if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
					$repo = $em->getRepository('ScontrolBundle:Hslabo');
					$entity = $repo->find($request->request->get("labo"));	
					
					$em->remove($entity);
					$em->flush();
					
					return new Response("0-Antecedente Laboral Eliminado Con Exito!");
				}
				catch(\Exception $e)
				{
					return new Response("1-Imposible Eliminar Antecedente Laboral!");
				}
			}
			else
				return $this->redirect($this->generateUrl('as_ante'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function getPersonalAction()
	{
		if(Tool::isGrant($this))
		{
			$request = $this->getRequest();
			if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$repo = $em->getRepository('ScontrolBundle:Hspers');
				$entity= $repo->findOneByMdpaci($request->request->get("paci"));	
				
				if($entity != null)
					return new Response($entity->getId());
				else
					return new Response("-1");
			}
			else
				return $this->redirect($this->generateUrl('as_ante'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
}
