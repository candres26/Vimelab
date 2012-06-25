<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Gbusua;
use Vimelab\ScontrolBundle\Form\GbusuaType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Gbusua controller.
 *
 * @Route("/gbusua")
 */
class GbusuaController extends Controller
{
    /**
     * Lists all Gbusua entities.
     *
     * @Route("/", name="gbusua")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Gbusua')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Gbusua');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Gbusua:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Gbusua entity.
     *
     * @Route("/{id}/show", name="gbusua_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbusua')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbusua entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Gbusua entity.
     *
     * @Route("/new", name="gbusua_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Gbusua();
			$form   = $this->createForm(new GbusuaType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Gbusua entity.
     *
     * @Route("/create", name="gbusua_create")
     * @Method("post")
     * @Template("ScontrolBundle:Gbusua:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Gbusua();
			$request = $this->getRequest();
			$form    = $this->createForm(new GbusuaType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {

				$factory = $this->get('security.encoder_factory');
				$encoder = $factory->getEncoder($entity);
				$pass = $encoder->encodePassword($entity->getClave(), $entity->getSalt());
				$entity->setClave($pass);

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('gbusua_show', array('id' => $entity->getId())));

			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Gbusua entity.
     *
     * @Route("/{id}/edit", name="gbusua_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbusua')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbusua entity.');
			}

			$editForm = $this->createForm(new GbusuaType(), $entity);
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
     * Edits an existing Gbusua entity.
     *
     * @Route("/{id}/update", name="gbusua_update")
     * @Method("post")
     * @Template("ScontrolBundle:Gbusua:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbusua')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbusua entity.');
			}

			$editForm   = $this->createForm(new GbusuaType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('gbusua_edit', array('id' => $id)));
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
     * Deletes a Gbusua entity.
     *
     * @Route("/{id}/delete", name="gbusua_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Gbusua')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Gbusua entity.');
				}

				$em->remove($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
			}

			return $this->redirect($this->generateUrl('gbusua'));
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
