<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Gbacls;
use Vimelab\ScontrolBundle\Form\GbaclsType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Gbacls controller.
 *
 * @Route("/gbacls")
 */
class GbaclsController extends Controller
{
    /**
     * Lists all Gbacls entities.
     *
     * @Route("/", name="gbacls")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Gbacls')->findAll();
			
			$query = $em->createQuery('SELECT a, u FROM ScontrolBundle:Gbacls a JOIN a.gbusua u WHERE 1 = 1 ORDER BY u.nombre ASC');
            $entities = $query->getResult();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Gbacls');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Gbacls:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Gbacls entity.
     *
     * @Route("/{id}/show", name="gbacls_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbacls')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbacls entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Gbacls entity.
     *
     * @Route("/new", name="gbacls_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{	
			$entity = new Gbacls();
			$form   = $this->createForm(new GbaclsType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Gbacls entity.
     *
     * @Route("/create", name="gbacls_create")
     * @Method("post")
     * @Template("ScontrolBundle:Gbacls:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Gbacls();
			$request = $this->getRequest();
			$form    = $this->createForm(new GbaclsType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('gbacls_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Gbacls entity.
     *
     * @Route("/{id}/edit", name="gbacls_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbacls')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbacls entity.');
			}

			$editForm = $this->createForm(new GbaclsType(), $entity);
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
     * Edits an existing Gbacls entity.
     *
     * @Route("/{id}/update", name="gbacls_update")
     * @Method("post")
     * @Template("ScontrolBundle:Gbacls:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbacls')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbacls entity.');
			}

			$editForm   = $this->createForm(new GbaclsType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('gbacls_show', array('id' => $id)));
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
     * Deletes a Gbacls entity.
     *
     * @Route("/{id}/delete", name="gbacls_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Gbacls')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Gbacls entity.');
				}

				$em->remove($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
			}

			return $this->redirect($this->generateUrl('gbacls'));
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
