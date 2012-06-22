<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Hsfami;
use Vimelab\ScontrolBundle\Form\HsfamiType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Hsfami controller.
 *
 * @Route("/hsfami")
 */
class HsfamiController extends Controller
{
    /**
     * Lists all Hsfami entities.
     *
     * @Route("/", name="hsfami")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Hsfami')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Hsfami');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Hsfami:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Hsfami entity.
     *
     * @Route("/{id}/show", name="hsfami_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hsfami')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hsfami entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Hsfami entity.
     *
     * @Route("/new", name="hsfami_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Hsfami();
			$form   = $this->createForm(new HsfamiType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Hsfami entity.
     *
     * @Route("/create", name="hsfami_create")
     * @Method("post")
     * @Template("ScontrolBundle:Hsfami:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Hsfami();
			$request = $this->getRequest();
			$form    = $this->createForm(new HsfamiType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('hsfami_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Hsfami entity.
     *
     * @Route("/{id}/edit", name="hsfami_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hsfami')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hsfami entity.');
			}

			$editForm = $this->createForm(new HsfamiType(), $entity);
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
     * Edits an existing Hsfami entity.
     *
     * @Route("/{id}/update", name="hsfami_update")
     * @Method("post")
     * @Template("ScontrolBundle:Hsfami:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hsfami')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hsfami entity.');
			}

			$editForm   = $this->createForm(new HsfamiType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('hsfami_edit', array('id' => $id)));
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
     * Deletes a Hsfami entity.
     *
     * @Route("/{id}/delete", name="hsfami_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Hsfami')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Hsfami entity.');
				}

				$em->remove($entity);
				$em->flush();
			}

			return $this->redirect($this->generateUrl('hsfami'));
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
