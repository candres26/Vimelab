<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Mdextr;
use Vimelab\ScontrolBundle\Form\MdextrType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Mdextr controller.
 *
 * @Route("/mdextr")
 */
class MdextrController extends Controller
{
    /**
     * Lists all Mdextr entities.
     *
     * @Route("/", name="mdextr")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Mdextr')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Mdextr');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Mdextr:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Mdextr entity.
     *
     * @Route("/{id}/show", name="mdextr_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdextr')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdextr entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Mdextr entity.
     *
     * @Route("/new", name="mdextr_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Mdextr();
			$form   = $this->createForm(new MdextrType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Mdextr entity.
     *
     * @Route("/create", name="mdextr_create")
     * @Method("post")
     * @Template("ScontrolBundle:Mdextr:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Mdextr();
			$request = $this->getRequest();
			$form    = $this->createForm(new MdextrType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('mdextr_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
			
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Mdextr entity.
     *
     * @Route("/{id}/edit", name="mdextr_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdextr')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdextr entity.');
			}

			$editForm = $this->createForm(new MdextrType(), $entity);
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
     * Edits an existing Mdextr entity.
     *
     * @Route("/{id}/update", name="mdextr_update")
     * @Method("post")
     * @Template("ScontrolBundle:Mdextr:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdextr')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdextr entity.');
			}

			$editForm   = $this->createForm(new MdextrType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('mdextr_edit', array('id' => $id)));
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
     * Deletes a Mdextr entity.
     *
     * @Route("/{id}/delete", name="mdextr_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Mdextr')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Mdextr entity.');
				}

				$em->remove($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
			}

			return $this->redirect($this->generateUrl('mdextr'));
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
