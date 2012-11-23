<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Ctfact;
use Vimelab\ScontrolBundle\Form\CtfactType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Ctfact controller.
 *
 * @Route("/ctfact")
 */
class CtfactController extends Controller
{
    /**
     * Lists all Ctfact entities.
     *
     * @Route("/", name="ctfact")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Ctfact')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Ctfact');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Ctfact:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Ctfact entity.
     *
     * @Route("/{id}/show", name="ctfact_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctfact')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctfact entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Ctfact entity.
     *
     * @Route("/new", name="ctfact_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Ctfact();
			$form   = $this->createForm(new CtfactType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Ctfact entity.
     *
     * @Route("/create", name="ctfact_create")
     * @Method("post")
     * @Template("ScontrolBundle:Ctfact:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{	
			$entity  = new Ctfact();
			$request = $this->getRequest();
			$form    = $this->createForm(new CtfactType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctfact_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Ctfact entity.
     *
     * @Route("/{id}/edit", name="ctfact_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctfact')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctfact entity.');
			}

			$editForm = $this->createForm(new CtfactType(), $entity);
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
     * Edits an existing Ctfact entity.
     *
     * @Route("/{id}/update", name="ctfact_update")
     * @Method("post")
     * @Template("ScontrolBundle:Ctfact:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctfact')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctfact entity.');
			}

			$editForm   = $this->createForm(new CtfactType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctfact_show', array('id' => $id)));
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
     * Deletes a Ctfact entity.
     *
     * @Route("/{id}/delete", name="ctfact_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Ctfact')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Ctfact entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $entity->getId());
				}
	
				return $this->redirect($this->generateUrl('ctfact'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('ctfact_edit', array('id' => $id)));
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
