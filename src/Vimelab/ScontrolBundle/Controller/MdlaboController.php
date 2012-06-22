<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Mdlabo;
use Vimelab\ScontrolBundle\Form\MdlaboType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Mdlabo controller.
 *
 * @Route("/mdlabo")
 */
class MdlaboController extends Controller
{
    /**
     * Lists all Mdlabo entities.
     *
     * @Route("/", name="mdlabo")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Mdlabo')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Mdlabo');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Mdlabo:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Mdlabo entity.
     *
     * @Route("/{id}/show", name="mdlabo_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdlabo')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdlabo entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Mdlabo entity.
     *
     * @Route("/new", name="mdlabo_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Mdlabo();
			$form   = $this->createForm(new MdlaboType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Mdlabo entity.
     *
     * @Route("/create", name="mdlabo_create")
     * @Method("post")
     * @Template("ScontrolBundle:Mdlabo:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Mdlabo();
			$request = $this->getRequest();
			$form    = $this->createForm(new MdlaboType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('mdlabo_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Mdlabo entity.
     *
     * @Route("/{id}/edit", name="mdlabo_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdlabo')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdlabo entity.');
			}

			$editForm = $this->createForm(new MdlaboType(), $entity);
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
     * Edits an existing Mdlabo entity.
     *
     * @Route("/{id}/update", name="mdlabo_update")
     * @Method("post")
     * @Template("ScontrolBundle:Mdlabo:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdlabo')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdlabo entity.');
			}

			$editForm   = $this->createForm(new MdlaboType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('mdlabo_edit', array('id' => $id)));
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
     * Deletes a Mdlabo entity.
     *
     * @Route("/{id}/delete", name="mdlabo_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Mdlabo')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Mdlabo entity.');
				}

				$em->remove($entity);
				$em->flush();
			}

			return $this->redirect($this->generateUrl('mdlabo'));
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
