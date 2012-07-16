<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vimelab\ScontrolBundle\Entity\Gbcarg;
use Vimelab\ScontrolBundle\Entity\Gbpers;
use Vimelab\ScontrolBundle\Entity\Gbusua;
use Vimelab\ScontrolBundle\Entity\Gbvars;
use Vimelab\ScontrolBundle\Entity\Gbacls;
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
			
			return $this->render('ScontrolBundle:AsSecu:index.html.twig', array('cargos' => $cargos, 'modulos' => $this->getMod()));
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
					$pers = $em->getRepository('ScontrolBundle:Gbpers')->findOneById($request->request->get('selPers'));	
						
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
	
	public function getActAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$mod = $em->getRepository('ScontrolBundle:Gbvars')->findOneById($request->request->get('selMod'));
				
				$tar = explode('|-|', $mod->getValor());
				
				if(isset($tar[1]))
				{
					if($tar[1] == '*')
						$parr = '*=>Acceso Completo';
					else
						$parr = '*=>Acceso Completo|:|'.$tar[2];
				}
				else
					$parr = '%';
					
				return new Response($parr);
			}
			else
				return $this->redirect($this->generateUrl('as_secu'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function addAclAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$usu = $request->request->get('selUsua');
				$mod = $request->request->get('selMod');
				$act = $request->request->get('selAct');
				
				$ousu = $em->getRepository('ScontrolBundle:Gbusua')->findOneById($usu);
				$omod = $em->getRepository('ScontrolBundle:Gbvars')->findOneById($mod);
				
				$rmod = array();
				$ract = array();
				
				if($act == '*')
				{
					$tmp = explode('|-|', $omod->getValor());
					$tmp = explode('|:|', $tmp[2]);
						
					foreach($tmp as $caso)
					{
						$tcs = explode('=>', $caso);
						$tcs = explode('/', $tcs[0]);
						$rmod[] = $tcs[0];
						$ract[] = $tcs[1];
					}
					
				}
				else 
				{
					$tcs = explode('/', $act);
					$rmod[] = $tcs[0];
					$ract[] = $tcs[1];
				}
				
				$ct = 0;
				for($i = 0; $i < count($rmod); $i++)
				{
					$acls = $em->getRepository('ScontrolBundle:Gbacls')->getExist($ousu->getId(), $rmod[$i], $ract[$i]);
					if($acls == 0)
					{
						$ct += 1;
						$obj = new Gbacls();
						$obj->setGbusua($ousu);
						$obj->setModulo($rmod[$i]);
						$obj->setAccion($ract[$i]);
						$em->persist($obj);
					}
					
					$em->flush();
				}
				
				return new Response($ct.' Privilegios Asignados!');
			}
			else
				return $this->redirect($this->generateUrl('as_secu'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}
	
	public function delAclAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$usu = $request->request->get('selUsua');
				$acls = $em->getRepository('ScontrolBundle:Gbacls')->getInUser($usu);
				$ct = 0;
				
				foreach ($acls as $caso) 
				{
					$ct += 1;
					$em->remove($caso);
				}
				
				$em->flush();
				
				return new Response($ct.' Privilegios Eliminados!');
			}
			else
				return $this->redirect($this->generateUrl('as_secu'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

	public function getAclAction()
	{
		if(Tool::isGrant($this))
        {
        	$request = $this->getRequest();
        	if($request->isXmlHttpRequest())
			{
				$em = $this->getDoctrine()->getEntityManager();
				
				$usu = $request->request->get('selUsua');
				$acls = $em->getRepository('ScontrolBundle:Gbacls')->getInUser($usu);
				
				$tar = array();
				$tol = new Tool();
				$tol->initDic($this);
				foreach($acls as $caso)
				{
					if(isset($tar[$caso->getModulo()]))
						$tar[$caso->getModulo()] = $tar[$caso->getModulo()].','.$tol->traduce($caso->getAccion());
					else
						$tar[$caso->getModulo()] = $tol->traduce($caso->getAccion());
				}
				
				$parr = array();
				foreach($tar as $k => $v)
					$parr[] = $tol->traduce($k).':'.$v;
				
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
	
	private function getMod()
	{
		$em = $this->getDoctrine()->getEntityManager();
				
		$mods = $em->getRepository('ScontrolBundle:Gbvars')->findBy(array('tipo' => 'S'), array('nombre' => 'ASC'));
				
		$parr = array();
		foreach($mods as $caso)
		{
			$tmp = 	$this->exNom($caso);
			$parr[$tmp[0]] = $tmp[1];
		}
		
		return $parr;
	}
	
	private function exNom($caso)
	{
		$tmp = $caso->getValor();
		$tar = explode('|-|', $tmp);
		
		if($caso->getValor() != '')
			return array($caso->getId(), $tar[0]);
		else
			return array($caso->getId(), $caso->getNombre());
	}
}
