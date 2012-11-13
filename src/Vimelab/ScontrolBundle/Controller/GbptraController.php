<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Gbptra;
use Vimelab\ScontrolBundle\Form\GbptraType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Gbptra controller.
 *
 * @Route("/gbptra")
 */
class GbptraController extends Controller
{
    /**
     * Lists all Gbptra entities.
     *
     * @Route("/", name="gbptra")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Gbptra')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Gbptra');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Gbptra:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Gbptra entity.
     *
     * @Route("/{id}/show", name="gbptra_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbptra')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbptra entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Gbptra entity.
     *
     * @Route("/new", name="gbptra_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Gbptra();
			$form   = $this->createForm(new GbptraType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Gbptra entity.
     *
     * @Route("/create", name="gbptra_create")
     * @Method("post")
     * @Template("ScontrolBundle:Gbptra:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Gbptra();
			$request = $this->getRequest();
			$form    = $this->createForm(new GbptraType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('gbptra_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Gbptra entity.
     *
     * @Route("/{id}/edit", name="gbptra_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbptra')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbptra entity.');
			}

			$editForm = $this->createForm(new GbptraType(), $entity);
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
     * Edits an existing Gbptra entity.
     *
     * @Route("/{id}/update", name="gbptra_update")
     * @Method("post")
     * @Template("ScontrolBundle:Gbptra:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Gbptra')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Gbptra entity.');
			}

			$editForm   = $this->createForm(new GbptraType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('gbptra_show', array('id' => $id)));
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
     * Deletes a Gbptra entity.
     *
     * @Route("/{id}/delete", name="gbptra_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
		if(Tool::isGrant($this))
		{
			try
			{
				$form = $this->createDeleteForm($id);
				$request = $this->getRequest();
	
				$form->bindRequest($request);
	
				if ($form->isValid()) {
					$em = $this->getDoctrine()->getEntityManager();
					$entity = $em->getRepository('ScontrolBundle:Gbptra')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Gbptra entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $entity->getId());
				}
	
				return $this->redirect($this->generateUrl('gbptra'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('gbptra_edit', array('id' => $id)));
			}
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
