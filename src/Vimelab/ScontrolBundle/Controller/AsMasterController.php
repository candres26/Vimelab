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
use Vimelab\ScontrolBundle\Entity\Mdprot;
use Vimelab\ScontrolBundle\Entity\Mdproc;
use Vimelab\ScontrolBundle\Entity\Mdques;
use Vimelab\ScontrolBundle\Entity\Mdresp;
use Vimelab\ScontrolBundle\Entity\Mdexam;
use Vimelab\ScontrolBundle\Entity\Mdlabo;

class AsMasterController extends Controller
{	
	public $_DIC = array(0 => 'No definido', 1 => 'Apto', 2 => 'Apto Condicional', 3 => 'No Apto');

	public function indexAction()
	{
		if(Tool::isGrant($this))
		{
			$secu = $this->get('security.context');
			$ussys = $secu->getToken()->getUser();
			
			$em = $this->getDoctrine()->getEntityManager();
			$entity = $em->getRepository('ScontrolBundle:Gbpers')->getForUser($ussys);
			$exams = $em->getRepository('ScontrolBundle:Mdexam')->findBy(array(), array('nombre' => 'ASC'));
				
			return $this->render('ScontrolBundle:AsMaster:index.html.twig', array('GbPers' => $entity, 'exams' => $exams, 'dicts' => $this->_DIC ,'LOAD' => 'NONE'));
		}
		else
			return $this->render('ScontrolBundle::alertas.html.twig');
	}
	
	public function loadAction($id)
	{
		if(Tool::isGrant($this))
		{
			$secu = $this->get('security.context');
			$ussys = $secu->getToken()->getUser();
			
			$em = $this->getDoctrine()->getEntityManager();
			$entity = $em->getRepository('ScontrolBundle:Gbpers')->getForUser($ussys);
			$exams = $em->getRepository('ScontrolBundle:Mdexam')->findBy(array(), array('nombre' => 'ASC'));
			
			$loader = array();
			
			$hist = $em->getRepository('ScontrolBundle:Mdhist')->find($id);
			$paci = $hist->getMdpaci();
			$audi = $em->getRepository('ScontrolBundle:Mdaudi')->findOneByMdhist($hist->getId());
			$audi = $audi != null ? $audi->getId() : -1;
			$visu = $em->getRepository('ScontrolBundle:Mdvisu')->findOneByMdhist($hist->getId());
			$visu = $visu != null ? $visu->getId() : -1;
			$biom = $em->getRepository('ScontrolBundle:Mdbiom')->findOneByMdhist($hist->getId());
			$biom = $biom != null ? $biom->getId() : -1;
			$espi = $em->getRepository('ScontrolBundle:Mdespi')->findOneByMdhist($hist->getId());
			$espi = $espi != null ? $espi->getId() : -1;
			$extr = $em->getRepository('ScontrolBundle:Mdextr')->findOneByMdhist($hist->getId());
			$extr = $extr != null ? $extr->getId() : -1;
			$sist = $em->getRepository('ScontrolBundle:Mdsist')->findOneByMdhist($hist->getId());
			$sist = $sist != null ? $sist->getId() : -1;
			
			$loader[] = array(
								$paci->getId(), $paci->getIdentificacion(), $paci->getFullName(), $paci->getGbSucu()->__toString(),
								$paci->getSexo(), $paci->getGbSucu()->getGbempr()->getId(), $paci->getGbptra()->getId(),
								$paci->getGbptra()->getNombre()
							);
							
			$loader[] = array($hist->getId(), $hist->getTcruta()->getId(), $hist->getTcruta()->__toString(), $hist->getTipo(), $hist->getDictamen(), $hist->getComentario());
			$loader[] = array($audi, $visu, $biom, $espi, $extr, $sist);
			
			$loader = Tool::toJail($loader);
				
			return $this->render('ScontrolBundle:AsMaster:index.html.twig', array('GbPers' => $entity, 'exams' => $exams, 'dicts' => $this->_DIC, 'LOAD' => $loader));
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
					$res[] = $caso->getId()."=>".$caso->getIdentificacion()."=>".$caso->getFullName()."=>".$caso->getGbSucu()->__toString()
					."=>".$caso->getSexo()."=>".$caso->getGbSucu()->getGbempr()->getId()."=>".$caso->getGbptra()->getId()
					."=>".$caso->getGbptra()->getNombre();
				
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
					$entity->setDictamen(0);
					
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
					$entity->setDictamen($request->request->get("jsComeDic"));
					$entity->setComentario($request->request->get("jsComeDta"));
					
					$em->persist($entity);
					$em->flush();
					return new Response("0:Ok Dictamen guardado con exito!");
				}
				catch(\Exception $e)
				{
					return new Response("1:Error, imposible guardar Dictamen!");
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
					if($min <= intval($caso->getMdgrup()->getId()) && $max > intval($caso->getMdgrup()->getId()))
						$res[] = $caso->getId()."=>".$caso->getCodigo()."=>".$caso->getNombre();
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
					if($min <= intval($caso->getMdpato()->getMdgrup()->getId()) && $max > intval($caso->getMdpato()->getMdgrup()->getId()))
						$res[] = $caso->getId()."=>".$caso->getMdpato()->getNombre();
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
	
	public function getProtocoloAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
        		$repo = $em->getRepository('ScontrolBundle:Mdproc');
        		$entities = $repo->findByGbptra($request->request->get("ptra"));	
								
				$res = array();
				foreach($entities as $caso)
				{
					$prot = $caso->getMdprot();
					$res[] = $prot->getId()."=>".$prot->__toString();
				}
				
				return new Response(join("|-|", $res));
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function getPreguntaAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
        		$repo = $em->getRepository('ScontrolBundle:Mdques');				
        		$entities = $repo->findByMdprot($request->request->get("jsProtOp"));	
				
				$resp = $em->getRepository('ScontrolBundle:Mdresp');
				$resus = $resp->findByMdhist($request->request->get("hist"));
								
				$res = array();
				foreach($entities as $caso)
				{
					$pic = array();
					
					$pic[] = $caso->getId();
					$pic[] = $caso->__toString();
					
					foreach ($resus as $resu) 
					{
						if($resu->getMdques()->getId() == $caso->getId())
						{
							$pic[] = $resu->getId();
							$pic[] = $resu->getResultado();
							$pic[] = $resu->getDetalle();
						}
					}	
					
					if(count($pic) == 2)
					{
						$pic[] = "{}";
						$pic[] = "{}";
						$pic[] = "{}";
					}	
					
					$res[] = join("=>", $pic);
				}
				
				return new Response(join("|-|", $res));
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function savRespuestaAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
					
					$histo = $em->getRepository('ScontrolBundle:Mdhist')->find($request->request->get("hist"));
					$preg = $em->getRepository('ScontrolBundle:Mdques')->find($request->request->get("preg"));
					
					if($request->request->get("resp") != "")
						$entity = $em->getRepository('ScontrolBundle:Mdresp')->find($request->request->get("resp"));
					else
						$entity = new Mdresp();
					
					$entity->setMdhist($histo);
					$entity->setMdques($preg);
					$entity->setResultado($request->request->get("resu"));
					$entity->setDetalle($request->request->get("deta"));
					
					
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

	public function delRespuestaAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
	        		$repo = $em->getRepository('ScontrolBundle:Mdresp');
	        		$entity = $repo->find($request->request->get("resp"));	
					
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
	
	public function getExamenAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
        		$repo = $em->getRepository('ScontrolBundle:Mdlabo');
        		$entities = $repo->findByMdhist($request->request->get("hist"));	
								
				$res = array();
				foreach($entities as $caso)
					$res[] = $caso->getId()."=>".$caso->getMdexam()->getNombre()."=>".$caso->getEstado()."=>".$caso->getResultado().
							"=>".$caso->getMdexam()->getId();
				
				return new Response(join("|-|", $res));
			}
			else
				return $this->redirect($this->generateUrl('as_master'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function savExamenAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
					
					$histo = $em->getRepository('ScontrolBundle:Mdhist')->find($request->request->get("hist"));
					$exam = $em->getRepository('ScontrolBundle:Mdexam')->find($request->request->get("jsExamEx"));
					
					$entity = new Mdlabo();
					$entity->setMdhist($histo);
					$entity->setMdexam($exam);
					$entity->setEstado($request->request->get("esta"));
					$entity->setResultado($request->request->get("jsExamDet"));
					
					
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

	public function delExamenAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
	        		$repo = $em->getRepository('ScontrolBundle:Mdlabo');
	        		$entity = $repo->find($request->request->get("exam"));	
					
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
