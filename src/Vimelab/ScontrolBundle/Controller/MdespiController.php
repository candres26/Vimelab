<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Mdespi;
use Vimelab\ScontrolBundle\Form\MdespiType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Mdespi controller.
 *
 * @Route("/mdespi")
 */
class MdespiController extends Controller
{
    /**
     * Lists all Mdespi entities.
     *
     * @Route("/", name="mdespi")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Mdespi')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Mdespi')->getPage(20, $pag);

			return array('entities' => $entities, 'pages' => $pages, 'pag' => $pag);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();
            $repo = $em->getRepository('ScontrolBundle:Mdespi');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Mdespi:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Mdespi entity.
     *
     * @Route("/{id}/show", name="mdespi_show")
     * @Template()
     */
    public function showAction($id, $lv)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdespi')->find($id);
			
			if($lv == 1)
			{
				if (!$entity) 
				{
					throw $this->createNotFoundException('Unable to find Mdespi entity.');
				}
	
				$deleteForm = $this->createDeleteForm($id);
	
				return array('entity' => $entity, 'delete_form' => $deleteForm->createView());
			}
			else if($lv == 2)
				return $this->render("ScontrolBundle:Mdespi:_show.html.twig", array('entity' => $entity, 'RMSG' => $entity->getId()."-Espirometría creada con exito!"));
			else if($lv == 4)
				return $this->render("ScontrolBundle:Mdespi:_show.html.twig", array('entity' => $entity, 'RMSG' => 'NONE'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Mdespi entity.
     *
     * @Route("/new", name="mdespi_new")
     * @Template()
     */
    public function newAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity = new Mdespi();
			$form   = $this->createForm(new MdespiType(), $entity);

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Mdespi:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Mdespi entity.
     *
     * @Route("/create", name="mdespi_create")
     * @Method("post")
     * @Template("ScontrolBundle:Mdespi:new.html.twig")
     */
    public function createAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Mdespi();
			$request = $this->getRequest();
			$form    = $this->createForm(new MdespiType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) 
			{
				try
				{	
					$em = $this->getDoctrine()->getEntityManager();
					$em->persist($entity);
					$em->flush();
	
					Tool::logger($this, $entity->getId());
					
					if($lv == 1)
						return $this->redirect($this->generateUrl('mdespi_show', array('id' => $entity->getId())));
					else
						return $this->redirect($this->generateUrl('mdespi_show', array('id' => $entity->getId(), 'lv' => '2')));
					
				}
				catch(\Exception $e)
				{
					if($lv == 1)
						return array('entity' => $entity, 'form'   => $form->createView());
					else	
						return $this->render("ScontrolBundle:Mdespi:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '1-Imposible Crear Espirometría, Error Referencial!'));
				}
				
			}
		
			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Mdespi:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Mdespi entity.
     *
     * @Route("/{id}/edit", name="mdespi_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdespi')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdespi entity.');
			}

			$editForm = $this->createForm(new MdespiType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Edits an existing Mdespi entity.
     *
     * @Route("/{id}/update", name="mdespi_update")
     * @Method("post")
     * @Template("ScontrolBundle:Mdespi:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdespi')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdespi entity.');
			}

			$editForm   = $this->createForm(new MdespiType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('mdespi_show', array('id' => $id)));
			}

			return array(
				'entity'      => $entity,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Deletes a Mdespi entity.
     *
     * @Route("/{id}/delete", name="mdespi_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
		if(Tool::isGrant($this))
		{
			try
			{
				$form = $this->createDeleteForm($id);
				$request = $this->getRequest();
	
				$form->bindRequest($request);
	
				if ($form->isValid()) {
					$em = $this->getDoctrine()->getEntityManager();
					$entity = $em->getRepository('ScontrolBundle:Mdespi')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Mdespi entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $id);
				}
	
				return $this->redirect($this->generateUrl('mdespi'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('mdespi_edit', array('id' => $id)));
			}
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
