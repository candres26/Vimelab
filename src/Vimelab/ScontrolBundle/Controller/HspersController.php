<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Hspers;
use Vimelab\ScontrolBundle\Form\HspersType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Hspers controller.
 *
 * @Route("/hspers")
 */
class HspersController extends Controller
{
    /**
     * Lists all Hspers entities.
     *
     * @Route("/", name="hspers")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Hspers')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Hspers')->getPage(20, $pag);

			return array('entities' => $entities, 'pages' => $pages, 'pag' => $pag);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Hspers');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Hspers:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
    }

    /**
     * Finds and displays a Hspers entity.
     *
     * @Route("/{id}/show", name="hspers_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hspers')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hspers entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Hspers entity.
     *
     * @Route("/new", name="hspers_new")
     * @Template()
     */
    public function newAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity = new Hspers();
			$form   = $this->createForm(new HspersType(), $entity);

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Hspers:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Hspers entity.
     *
     * @Route("/create", name="hspers_create")
     * @Method("post")
     * @Template("ScontrolBundle:Hspers:new.html.twig")
     */
    public function createAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Hspers();
			$request = $this->getRequest();
			$form    = $this->createForm(new HspersType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) 
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
					$em->persist($entity);
					$em->flush();

					Tool::logger($this, $entity->getId());

					if($lv == 1)
						return $this->redirect($this->generateUrl('hspers_show', array('id' => $entity->getId())));
					else
						return $this->redirect($this->generateUrl('hspers_edit', array('id' => $entity->getId(), 'lv' => 3)));
				}
				catch(\Exception $e)
				{
					if($lv == 1)
						return array('entity' => $entity, 'form'   => $form->createView());
					else	
						return $this->render("ScontrolBundle:Hspers:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '1-Imposible Crear Antecedente Personal!'));
				}
			}

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Hspers:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Hspers entity.
     *
     * @Route("/{id}/edit", name="hspers_edit")
     * @Template()
     */
    public function editAction($id, $lv)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hspers')->find($id);

			if (!$entity) 
			{
				throw $this->createNotFoundException('Unable to find Hspers entity.');
			}

			$editForm = $this->createForm(new HspersType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			if($lv == 1)
				return array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView());
			else if($lv == 2)
				return $this->render("ScontrolBundle:Hspers:_edit.html.twig", array('entity' => $entity, 'form' => $editForm->createView(), 'RMSG' => 'LOAD'));
			else
				return $this->render("ScontrolBundle:Hspers:_edit.html.twig", array('entity' => $entity, 'form' => $editForm->createView(), 'RMSG' => 'Antecedente Personal Actualizado Con Exito!'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Edits an existing Hspers entity.
     *
     * @Route("/{id}/update", name="hspers_update")
     * @Method("post")
     * @Template("ScontrolBundle:Hspers:edit.html.twig")
     */
    public function updateAction($id, $lv)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hspers')->find($id);

			if (!$entity) 
			{
				throw $this->createNotFoundException('Unable to find Hspers entity.');
			}

			$editForm   = $this->createForm(new HspersType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) 
			{
				try
				{
					$em->persist($entity);
					$em->flush();

					Tool::logger($this, $entity->getId());

					if($lv == 1)
						return $this->redirect($this->generateUrl('hspers_show', array('id' => $entity->getId())));
					else
						return $this->redirect($this->generateUrl('hspers_edit', array('id' => $entity->getId(), 'lv' => 3)));
					
				}
				catch(\Exception $e)
				{
					if($lv == 1)
						return array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView());
					else	
						return $this->render("ScontrolBundle:Hspers:_edit.html.twig", array('entity' => $entity, 'form' => $editForm->createView(), 'RMSG' => '1-Imposible Crear Antecedente Personal!'));
				}
			}

			if($lv == 1)
				return array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView());
			else
				return $this->render("ScontrolBundle:Hspers:_edit.html.twig", array('entity' => $entity, 'form' => $editForm->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Deletes a Hspers entity.
     *
     * @Route("/{id}/delete", name="hspers_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Hspers')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Hspers entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $entity->getId());
				}
	
				return $this->redirect($this->generateUrl('hspers'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('hspers_edit', array('id' => $id)));
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
