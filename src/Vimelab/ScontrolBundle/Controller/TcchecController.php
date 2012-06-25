<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Tcchec;
use Vimelab\ScontrolBundle\Form\TcchecType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Tcchec controller.
 *
 * @Route("/tcchec")
 */
class TcchecController extends Controller
{
    /**
     * Lists all Tcchec entities.
     *
     * @Route("/", name="tcchec")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Tcchec')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Tcchec');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Tcchec:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Tcchec entity.
     *
     * @Route("/{id}/show", name="tcchec_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tcchec')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tcchec entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Tcchec entity.
     *
     * @Route("/new", name="tcchec_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Tcchec();
			$form   = $this->createForm(new TcchecType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Tcchec entity.
     *
     * @Route("/create", name="tcchec_create")
     * @Method("post")
     * @Template("ScontrolBundle:Tcchec:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Tcchec();
			$request = $this->getRequest();
			$form    = $this->createForm(new TcchecType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('tcchec_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Tcchec entity.
     *
     * @Route("/{id}/edit", name="tcchec_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tcchec')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tcchec entity.');
			}

			$editForm = $this->createForm(new TcchecType(), $entity);
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
     * Edits an existing Tcchec entity.
     *
     * @Route("/{id}/update", name="tcchec_update")
     * @Method("post")
     * @Template("ScontrolBundle:Tcchec:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tcchec')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tcchec entity.');
			}

			$editForm   = $this->createForm(new TcchecType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('tcchec_edit', array('id' => $id)));
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
     * Deletes a Tcchec entity.
     *
     * @Route("/{id}/delete", name="tcchec_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Tcchec')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Tcchec entity.');
				}

				$em->remove($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
			}

			return $this->redirect($this->generateUrl('tcchec'));
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
