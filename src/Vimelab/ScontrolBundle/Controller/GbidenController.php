<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Gbiden;
use Vimelab\ScontrolBundle\Form\GbidenType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Gbiden controller.
 *
 * @Route("/gbiden")
 */
class GbidenController extends Controller
{
    /**
     * Lists all Gbiden entities.
     *
     * @Route("/", name="gbiden")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Gbiden')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Gbiden');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Gbiden:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Gbiden entity.
     *
     * @Route("/{id}/show", name="gbiden_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbiden')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbiden entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Gbiden entity.
     *
     * @Route("/new", name="gbiden_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Gbiden();
			$form   = $this->createForm(new GbidenType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Gbiden entity.
     *
     * @Route("/create", name="gbiden_create")
     * @Method("post")
     * @Template("ScontrolBundle:Gbiden:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Gbiden();
			$request = $this->getRequest();
			$form    = $this->createForm(new GbidenType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('gbiden_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Gbiden entity.
     *
     * @Route("/{id}/edit", name="gbiden_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbiden')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbiden entity.');
			}

			$editForm = $this->createForm(new GbidenType(), $entity);
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
     * Edits an existing Gbiden entity.
     *
     * @Route("/{id}/update", name="gbiden_update")
     * @Method("post")
     * @Template("ScontrolBundle:Gbiden:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbiden')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbiden entity.');
			}

			$editForm   = $this->createForm(new GbidenType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('gbiden_edit', array('id' => $id)));
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
     * Deletes a Gbiden entity.
     *
     * @Route("/{id}/delete", name="gbiden_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Gbiden')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Gbiden entity.');
				}

				$em->remove($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
			}

			return $this->redirect($this->generateUrl('gbiden'));
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
