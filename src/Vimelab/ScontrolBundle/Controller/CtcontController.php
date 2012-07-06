<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Ctcont;
use Vimelab\ScontrolBundle\Form\CtcontType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Ctcont controller.
 *
 * @Route("/ctcont")
 */
class CtcontController extends Controller
{
    /**
     * Lists all Ctcont entities.
     *
     * @Route("/", name="ctcont")
     * @Template()
     */
    public function indexAction()
    {
        if(Tool::isGrant($this))
        {
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Ctcont')->findAll();
		
			return array('entities' => $entities);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Ctcont');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Ctcont:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Ctcont entity.
     *
     * @Route("/{id}/show", name="ctcont_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
        {
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctcont')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctcont entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Ctcont entity.
     *
     * @Route("/new", name="ctcont_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
        {
			$entity = new Ctcont();
			$form   = $this->createForm(new CtcontType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Ctcont entity.
     *
     * @Route("/create", name="ctcont_create")
     * @Method("post")
     * @Template("ScontrolBundle:Ctcont:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
        {
			$entity  = new Ctcont();
			$request = $this->getRequest();
			$form    = $this->createForm(new CtcontType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctcont_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Ctcont entity.
     *
     * @Route("/{id}/edit", name="ctcont_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
        {	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctcont')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctcont entity.');
			}

			$editForm = $this->createForm(new CtcontType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
			);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Edits an existing Ctcont entity.
     *
     * @Route("/{id}/update", name="ctcont_update")
     * @Method("post")
     * @Template("ScontrolBundle:Ctcont:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
        {	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctcont')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctcont entity.');
			}

			$editForm   = $this->createForm(new CtcontType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctcont_show', array('id' => $id)));
			}

			return array(
				'entity'      => $entity,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
			);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Deletes a Ctcont entity.
     *
     * @Route("/{id}/delete", name="ctcont_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Ctcont')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Ctcont entity.');
				}

				$em->remove($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
			}

			return $this->redirect($this->generateUrl('ctcont'));
		}
		else
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
