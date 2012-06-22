<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Mdresp;
use Vimelab\ScontrolBundle\Form\MdrespType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Mdresp controller.
 *
 * @Route("/mdresp")
 */
class MdrespController extends Controller
{
    /**
     * Lists all Mdresp entities.
     *
     * @Route("/", name="mdresp")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Mdresp')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Mdresp');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Mdresp:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Mdresp entity.
     *
     * @Route("/{id}/show", name="mdresp_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdresp')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdresp entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Mdresp entity.
     *
     * @Route("/new", name="mdresp_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Mdresp();
			$form   = $this->createForm(new MdrespType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Mdresp entity.
     *
     * @Route("/create", name="mdresp_create")
     * @Method("post")
     * @Template("ScontrolBundle:Mdresp:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Mdresp();
			$request = $this->getRequest();
			$form    = $this->createForm(new MdrespType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('mdresp_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Mdresp entity.
     *
     * @Route("/{id}/edit", name="mdresp_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdresp')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdresp entity.');
			}

			$editForm = $this->createForm(new MdrespType(), $entity);
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
     * Edits an existing Mdresp entity.
     *
     * @Route("/{id}/update", name="mdresp_update")
     * @Method("post")
     * @Template("ScontrolBundle:Mdresp:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdresp')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdresp entity.');
			}

			$editForm   = $this->createForm(new MdrespType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('mdresp_edit', array('id' => $id)));
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
     * Deletes a Mdresp entity.
     *
     * @Route("/{id}/delete", name="mdresp_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Mdresp')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Mdresp entity.');
				}

				$em->remove($entity);
				$em->flush();
			}

			return $this->redirect($this->generateUrl('mdresp'));
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
