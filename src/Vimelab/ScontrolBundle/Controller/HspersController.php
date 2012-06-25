<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Hspers;
use Vimelab\ScontrolBundle\Form\HspersType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Hspers controller.
 *
 * @Route("/hspers")
 */
class HspersController extends Controller
{
    /**
     * Lists all Hspers entities.
     *
     * @Route("/", name="hspers")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Hspers')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Hspers');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Hspers:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Hspers entity.
     *
     * @Route("/{id}/show", name="hspers_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hspers')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hspers entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Hspers entity.
     *
     * @Route("/new", name="hspers_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Hspers();
			$form   = $this->createForm(new HspersType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Hspers entity.
     *
     * @Route("/create", name="hspers_create")
     * @Method("post")
     * @Template("ScontrolBundle:Hspers:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Hspers();
			$request = $this->getRequest();
			$form    = $this->createForm(new HspersType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('hspers_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Hspers entity.
     *
     * @Route("/{id}/edit", name="hspers_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hspers')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hspers entity.');
			}

			$editForm = $this->createForm(new HspersType(), $entity);
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
     * Edits an existing Hspers entity.
     *
     * @Route("/{id}/update", name="hspers_update")
     * @Method("post")
     * @Template("ScontrolBundle:Hspers:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hspers')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hspers entity.');
			}

			$editForm   = $this->createForm(new HspersType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('hspers_edit', array('id' => $id)));
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
     * Deletes a Hspers entity.
     *
     * @Route("/{id}/delete", name="hspers_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Hspers')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Hspers entity.');
				}

				$em->remove($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
			}

			return $this->redirect($this->generateUrl('hspers'));
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
