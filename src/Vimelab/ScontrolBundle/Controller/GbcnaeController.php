<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Gbcnae;
use Vimelab\ScontrolBundle\Form\GbcnaeType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Gbcnae controller.
 *
 * @Route("/gbcnae")
 */
class GbcnaeController extends Controller
{
    /**
     * Lists all Gbcnae entities.
     *
     * @Route("/", name="gbcnae")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Gbcnae')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Gbcnae');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Gbcnae:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Gbcnae entity.
     *
     * @Route("/{id}/show", name="gbcnae_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbcnae')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbcnae entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Gbcnae entity.
     *
     * @Route("/new", name="gbcnae_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Gbcnae();
			$form   = $this->createForm(new GbcnaeType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

    /**
     * Creates a new Gbcnae entity.
     *
     * @Route("/create", name="gbcnae_create")
     * @Method("post")
     * @Template("ScontrolBundle:Gbcnae:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Gbcnae();
			$request = $this->getRequest();
			$form    = $this->createForm(new GbcnaeType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('gbcnae_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Gbcnae entity.
     *
     * @Route("/{id}/edit", name="gbcnae_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbcnae')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbcnae entity.');
			}

			$editForm = $this->createForm(new GbcnaeType(), $entity);
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
     * Edits an existing Gbcnae entity.
     *
     * @Route("/{id}/update", name="gbcnae_update")
     * @Method("post")
     * @Template("ScontrolBundle:Gbcnae:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbcnae')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbcnae entity.');
			}

			$editForm   = $this->createForm(new GbcnaeType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('gbcnae_show', array('id' => $id)));
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
     * Deletes a Gbcnae entity.
     *
     * @Route("/{id}/delete", name="gbcnae_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Gbcnae')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Gbcnae entity.');
				}

				$em->remove($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
			}

			return $this->redirect($this->generateUrl('gbcnae'));
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
