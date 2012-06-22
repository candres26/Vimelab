<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Mdpaci;
use Vimelab\ScontrolBundle\Form\MdpaciType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Mdpaci controller.
 *
 * @Route("/mdpaci")
 */
class MdpaciController extends Controller
{
    /**
     * Lists all Mdpaci entities.
     *
     * @Route("/", name="mdpaci")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Mdpaci')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Mdpaci');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Mdpaci:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Mdpaci entity.
     *
     * @Route("/{id}/show", name="mdpaci_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdpaci')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdpaci entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Mdpaci entity.
     *
     * @Route("/new", name="mdpaci_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Mdpaci();
			$form   = $this->createForm(new MdpaciType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Mdpaci entity.
     *
     * @Route("/create", name="mdpaci_create")
     * @Method("post")
     * @Template("ScontrolBundle:Mdpaci:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Mdpaci();
			$request = $this->getRequest();
			$form    = $this->createForm(new MdpaciType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('mdpaci_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Mdpaci entity.
     *
     * @Route("/{id}/edit", name="mdpaci_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdpaci')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdpaci entity.');
			}

			$editForm = $this->createForm(new MdpaciType(), $entity);
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
     * Edits an existing Mdpaci entity.
     *
     * @Route("/{id}/update", name="mdpaci_update")
     * @Method("post")
     * @Template("ScontrolBundle:Mdpaci:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdpaci')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdpaci entity.');
			}

			$editForm   = $this->createForm(new MdpaciType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('mdpaci_edit', array('id' => $id)));
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
     * Deletes a Mdpaci entity.
     *
     * @Route("/{id}/delete", name="mdpaci_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Mdpaci')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Mdpaci entity.');
				}

				$em->remove($entity);
				$em->flush();
			}

			return $this->redirect($this->generateUrl('mdpaci'));
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
