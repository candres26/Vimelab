<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Ctfact;
use Vimelab\ScontrolBundle\Entity\Ctdeta;
use Vimelab\ScontrolBundle\Form\CtfactType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Ctfact controller.
 *
 * @Route("/ctfact")
 */
class CtfactController extends Controller
{
    /**
     * Lists all Ctfact entities.
     *
     * @Route("/", name="ctfact")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Ctfact')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Ctfact')->getPage(20, $pag);

			return array('entities' => $entities, 'pages' => $pages, 'pag' => $pag);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();
            $repo = $em->getRepository('ScontrolBundle:Ctfact');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Ctfact:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Ctfact entity.
     *
     * @Route("/{id}/show", name="ctfact_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctfact')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctfact entity.');
			}

			return array('entity' => $entity);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Ctfact entity.
     *
     * @Route("/new", name="ctfact_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Ctfact();
			$form   = $this->createForm(new CtfactType(), $entity);

			$em = $this->getDoctrine()->getEntityManager();
            $servs = $em->getRepository('ScontrolBundle:Ctserv')->findBy(array(), array('nombre' => 'ASC'));

			return array('entity' => $entity, 'form'   => $form->createView(), 'servs' => $servs);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Ctfact entity.
     *
     * @Route("/create", name="ctfact_create")
     * @Method("post")
     * @Template("ScontrolBundle:Ctfact:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{	
			$entity  = new Ctfact();
			$request = $this->getRequest();
			$form    = $this->createForm(new CtfactType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) 
			{
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);

				$arr = $entity->getDetalle();
				$arr = Tool::ofJail($arr);

				foreach ($arr as $caso) 
				{
					$deta = new Ctdeta();
					$deta->setCantidad($caso[2]);
					$deta->setVuni($caso[3]);
					$deta->setViva($caso[5]);
					$deta->setTotal($caso[6]);
					$deta->setCtserv($em->getRepository('ScontrolBundle:Ctserv')->find($caso[0]));
					$deta->setCtfact($entity);

					$em->persist($deta);
				}

				if($entity->getEstado() == 'F')
				{	
					$cont = $entity->getCtcont();
					$cont->descontar($entity->getTotal());

					$em->persist($cont);
				}

				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctfact_show', array('id' => $entity->getId())));
			}

			return array('entity' => $entity,'form'   => $form->createView());
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
}
