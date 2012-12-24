<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

use Vimelab\ScontrolBundle\Entity\Tcrevi;
use Vimelab\ScontrolBundle\Entity\Tcchec;
use Vimelab\ScontrolBundle\Entity\Tcaspe;
use Vimelab\ScontrolBundle\Entity\Tcdeta;

class AsRtecController extends Controller
{
	public function indexAction()
	{
		if(Tool::isGrant($this))
		{	
			return $this->render('ScontrolBundle:AsRtec:index.html.twig', array());
		}
		else
			return $this->render('ScontrolBundle::alertas.html.twig');
	}

	public function getRevisionAction()
	{
		if(Tool::isGrant($this))
		{
			$request = $this->getRequest();
			if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$repo = $em->getRepository('ScontrolBundle:Tcrevi');
				$repo2 = $em->getRepository('ScontrolBundle:Tcchec');
				$entities = $repo->getFor($request->request->get("param"));	
				
				$res = array();
				foreach($entities as $caso)
				{
					$chec = $repo2->findOneByTcrevi($caso->getId());

					if($chec != null)
						$chec = $chec->getId();
					else
						$chec = -1;

					$res[] = array
							(
								$caso->getId(), $caso->getFecha()->format('Y-m-d'), $caso->getGbSucu()->__toString(), $caso->getGbpers()->getFullName(),
								$caso->getInicio()->format("h:m"), $caso->getFin()->format("h:m"), $caso->getEntrevistados(), $caso->getResumen(), $chec
							);
				}

				return new Response(Tool::toJail($res));
			}
			else
				return $this->redirect($this->generateUrl('as_rtec'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function updateRevisionAction()
	{
		if(Tool::isGrant($this))
		{
			$request = $this->getRequest();
			if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$repo = $em->getRepository('ScontrolBundle:Tcrevi');
				$caso = $repo->find($request->request->get("id"));	
				
				try
				{
					$caso->setInicio(new \DateTime($request->request->get("hini")));	
					$caso->setFin(new \DateTime($request->request->get("hfin")));	
					$caso->setEntrevistados($request->request->get("entr"));	
					$caso->setResumen($request->request->get("resu"));

					$em->persist($caso);
					$em->flush();
					return new Response("Ok Revisión actualizada con exito!");
				}
				catch(\Exception $e)
				{
					return new Response("Error, imposible actualizar Revisión!");
				}

			}
			else
				return $this->redirect($this->generateUrl('as_rtec'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function getAspectoAction()
	{
		if(Tool::isGrant($this))
		{
			$request = $this->getRequest();
			if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$repo = $em->getRepository('ScontrolBundle:Tcaspe');
				$entities = $repo->findBy(array(), array("nombre" => "ASC"));
				
				$res = array();
				foreach($entities as $caso)
					$res[] = array($caso->getId(), $caso->getNombre());

				return new Response(Tool::toJail($res));
			}
			else
				return $this->redirect($this->generateUrl('as_rtec'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function getDetalleAction()
	{
		if(Tool::isGrant($this))
		{
			$request = $this->getRequest();
			if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$repo = $em->getRepository('ScontrolBundle:Tcdeta');
				$entities = $repo->findByTcrevi($request->request->get("id"));	
				
				$res = array();
				foreach($entities as $caso)
					$res[] = array
							(
								$caso->getId(), $caso->getTcaspe()->getId(), $caso->getTcaspe()->getNombre(), $caso->getEvitable(),
								$caso->getEstimacion(), $caso->getProbabilidad(), $caso->getConsecuencia(), $caso->getDetalle()
							);

				return new Response(Tool::toJail($res));
			}
			else
				return $this->redirect($this->generateUrl('as_rtec'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function savDetalleAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
					
					$revi = $em->getRepository('ScontrolBundle:Tcrevi')->find($request->request->get("revi"));
					$aspe = $em->getRepository('ScontrolBundle:Tcaspe')->find($request->request->get("aspecto"));
					
					if($request->request->get("id") != "")
						$entity = $em->getRepository('ScontrolBundle:Tcdeta')->find($request->request->get("id"));
					else
						$entity = new Tcdeta();
					
					$entity->setTcrevi($revi);
					$entity->setTcaspe($aspe);
					$entity->setEvitable($request->request->get("evitable"));
					$entity->setEstimacion($request->request->get("estimacion"));
					$entity->setProbabilidad($request->request->get("probabilidad"));
					$entity->setConsecuencia($request->request->get("consecuencia"));
					$entity->setDetalle($request->request->get("detalle"));

					$em->persist($entity);
					$em->flush();
					
					return new Response("0-Revisión De Aspectos Guardada Con Exito!");
				}
				catch(\Exception $e)
				{
					return new Response("1-Imposible Guardar Revisión De Aspectos!");
				}
			}
			else
				return $this->redirect($this->generateUrl('as_rtec'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function delDetalleAction()
	{
		if(Tool::isGrant($this))
		{
			$request = $this->getRequest();
			if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
					$repo = $em->getRepository('ScontrolBundle:Tcdeta');
					$entity = $repo->find($request->request->get("id"));	
					
					$em->remove($entity);
					$em->flush();
					
					return new Response("0-Revisión De Aspectos Eliminada Con Exito!");
				}
				catch(\Exception $e)
				{
					return new Response("1-Imposible Eliminar Revisión De Aspectos!");
				}
			}
			else
				return $this->redirect($this->generateUrl('as_rtec'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
}
