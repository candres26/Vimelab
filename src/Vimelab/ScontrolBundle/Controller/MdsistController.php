<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Mdsist;
use Vimelab\ScontrolBundle\Form\MdsistType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Mdsist controller.
 *
 * @Route("/mdsist")
 */
class MdsistController extends Controller
{
    /**
     * Lists all Mdsist entities.
     *
     * @Route("/", name="mdsist")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Mdsist')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Mdsist');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Mdsist:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Mdsist entity.
     *
     * @Route("/{id}/show", name="mdsist_show")
     * @Template()
     */
    public function showAction($id, $lv)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdsist')->find($id);

			if($lv == 1)
			{
				if (!$entity) 
				{
					throw $this->createNotFoundException('Unable to find Mdextr entity.');
				}
	
				$deleteForm = $this->createDeleteForm($id);
	
				return array('entity' => $entity, 'delete_form' => $deleteForm->createView());
			}
			else
				return $this->render("ScontrolBundle:Mdsist:_show.html.twig", array('entity' => $entity, 'RMSG' => $entity->getId()."-R. Sistemas creada con exito!"));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Mdsist entity.
     *
     * @Route("/new", name="mdsist_new")
     * @Template()
     */
    public function newAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity = new Mdsist();
			$form   = $this->createForm(new MdsistType(), $entity);

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Mdsist:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Mdsist entity.
     *
     * @Route("/create", name="mdsist_create")
     * @Method("post")
     * @Template("ScontrolBundle:Mdsist:new.html.twig")
     */
    public function createAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Mdsist();
			$request = $this->getRequest();
			$form    = $this->createForm(new MdsistType(), $entity);
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
						return $this->redirect($this->generateUrl('mdsist_show', array('id' => $entity->getId())));
					else
						return $this->redirect($this->generateUrl('mdsist_show', array('id' => $entity->getId(), 'lv' => '2')));
					
				}
				catch(\Exception $e)
				{
					if($lv == 1)
						return array('entity' => $entity, 'form'   => $form->createView());
					else	
						return $this->render("ScontrolBundle:Mdsist:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '1-Imposible Crear R. Sistemas, Error Referencial!'));
				}
			}

		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Mdsist entity.
     *
     * @Route("/{id}/edit", name="mdsist_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdsist')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdsist entity.');
			}

			$editForm = $this->createForm(new MdsistType(), $entity);
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
     * Edits an existing Mdsist entity.
     *
     * @Route("/{id}/update", name="mdsist_update")
     * @Method("post")
     * @Template("ScontrolBundle:Mdsist:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdsist')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdsist entity.');
			}

			$editForm   = $this->createForm(new MdsistType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('mdsist_show', array('id' => $id)));
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
     * Deletes a Mdsist entity.
     *
     * @Route("/{id}/delete", name="mdsist_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Mdsist')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Mdsist entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $entity->getId());
				}
	
				return $this->redirect($this->generateUrl('mdsist'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('mdsist_edit', array('id' => $id)));
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
