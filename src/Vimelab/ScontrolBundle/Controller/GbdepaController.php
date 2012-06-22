<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Gbdepa;
use Vimelab\ScontrolBundle\Form\GbdepaType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Gbdepa controller.
 *
 * @Route("/gbdepa")
 */
class GbdepaController extends Controller
{
    /**
     * Lists all Gbdepa entities.
     *
     * @Route("/", name="gbdepa")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Gbdepa')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Gbdepa');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Gbdepa:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Gbdepa entity.
     *
     * @Route("/{id}/show", name="gbdepa_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbdepa')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbdepa entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Gbdepa entity.
     *
     * @Route("/new", name="gbdepa_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Gbdepa();
			$form   = $this->createForm(new GbdepaType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Gbdepa entity.
     *
     * @Route("/create", name="gbdepa_create")
     * @Method("post")
     * @Template("ScontrolBundle:Gbdepa:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Gbdepa();
			$request = $this->getRequest();
			$form    = $this->createForm(new GbdepaType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('gbdepa_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Gbdepa entity.
     *
     * @Route("/{id}/edit", name="gbdepa_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbdepa')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbdepa entity.');
			}

			$editForm = $this->createForm(new GbdepaType(), $entity);
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
     * Edits an existing Gbdepa entity.
     *
     * @Route("/{id}/update", name="gbdepa_update")
     * @Method("post")
     * @Template("ScontrolBundle:Gbdepa:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbdepa')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbdepa entity.');
			}

			$editForm   = $this->createForm(new GbdepaType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('gbdepa_edit', array('id' => $id)));
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
     * Deletes a Gbdepa entity.
     *
     * @Route("/{id}/delete", name="gbdepa_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
		if(Tool::isGrant($this))
		{
			$form = $this->createDeleteForm($id);
			$request = $this->getRequest();

			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$entity = $em->getRepository('ScontrolBundle:Gbdepa')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Gbdepa entity.');
				}

				$em->remove($entity);
				$em->flush();
			}

			return $this->redirect($this->generateUrl('gbdepa'));
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
