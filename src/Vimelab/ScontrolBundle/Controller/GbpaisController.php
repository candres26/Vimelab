<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Gbpais;
use Vimelab\ScontrolBundle\Form\GbpaisType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Gbpais controller.
 *
 * @Route("/gbpais")
 */
class GbpaisController extends Controller
{
    /**
     * Lists all Gbpais entities.
     *
     * @Route("/", name="gbpais")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Gbpais')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Gbpais');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Gbpais:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Gbpais entity.
     *
     * @Route("/{id}/show", name="gbpais_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbpais')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbpais entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Gbpais entity.
     *
     * @Route("/new", name="gbpais_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Gbpais();
			$form   = $this->createForm(new GbpaisType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Gbpais entity.
     *
     * @Route("/create", name="gbpais_create")
     * @Method("post")
     * @Template("ScontrolBundle:Gbpais:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Gbpais();
			$request = $this->getRequest();
			$form    = $this->createForm(new GbpaisType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('gbpais_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Gbpais entity.
     *
     * @Route("/{id}/edit", name="gbpais_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbpais')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbpais entity.');
			}

			$editForm = $this->createForm(new GbpaisType(), $entity);
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
     * Edits an existing Gbpais entity.
     *
     * @Route("/{id}/update", name="gbpais_update")
     * @Method("post")
     * @Template("ScontrolBundle:Gbpais:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbpais')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbpais entity.');
			}

			$editForm   = $this->createForm(new GbpaisType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				return $this->redirect($this->generateUrl('gbpais_edit', array('id' => $id)));
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
     * Deletes a Gbpais entity.
     *
     * @Route("/{id}/delete", name="gbpais_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Gbpais')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Gbpais entity.');
				}

				$em->remove($entity);
				$em->flush();
			}

			return $this->redirect($this->generateUrl('gbpais'));
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
