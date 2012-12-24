<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Tcchec;
use Vimelab\ScontrolBundle\Form\TcchecType;
use Vimelab\ScontrolBundle\Tool\Tool;

use Symfony\Component\HttpFoundation\Response;

/**
 * Tcchec controller.
 *
 * @Route("/tcchec")
 */
class TcchecController extends Controller
{
    /**
     * Lists all Tcchec entities.
     *
     * @Route("/", name="tcchec")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Tcchec')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Tcchec')->getPage(20, $pag);

			return array('entities' => $entities, 'pages' => $pages, 'pag' => $pag);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();
            $repo = $em->getRepository('ScontrolBundle:Tcchec');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Tcchec:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Tcchec entity.
     *
     * @Route("/{id}/show", name="tcchec_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tcchec')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tcchec entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Tcchec entity.
     *
     * @Route("/new", name="tcchec_new")
     * @Template()
     */
    public function newAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity = new Tcchec();
			$form   = $this->createForm(new TcchecType(), $entity);

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Tcchec:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Tcchec entity.
     *
     * @Route("/create", name="tcchec_create")
     * @Method("post")
     * @Template("ScontrolBundle:Tcchec:new.html.twig")
     */
    public function createAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Tcchec();
			$request = $this->getRequest();
			$form    = $this->createForm(new TcchecType(), $entity);
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
						return $this->redirect($this->generateUrl('tcchec_show', array('id' => $entity->getId())));
					else
						return $this->redirect($this->generateUrl('tcchec_edit', array('id' => $entity->getId(), 'lv' => 3)));

				}
				catch(\Exception $e)
				{
					if($lv == 1)
						return array('entity' => $entity, 'form'   => $form->createView());
					else	
						return $this->render("ScontrolBundle:Tcchec:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '1-Imposible Crear Lista De Chequeo!'));
				}
			}

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Tcchec:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Tcchec entity.
     *
     * @Route("/{id}/edit", name="tcchec_edit")
     * @Template()
     */
    public function editAction($id, $lv)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tcchec')->find($id);

			if (!$entity) 
			{
				throw $this->createNotFoundException('Unable to find Tcchec entity.');
			}

			$editForm = $this->createForm(new TcchecType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			if($lv == 1)
				return array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView());
			else if($lv == 2)
				return $this->render("ScontrolBundle:Tcchec:_edit.html.twig", array('entity' => $entity, 'edit_form' => $editForm->createView(), 'RMSG' => 'LOAD'));
			else
				return $this->render("ScontrolBundle:Tcchec:_edit.html.twig", array('entity' => $entity, 'edit_form' => $editForm->createView(), 'RMSG' => '0-Lista De Chequeo Actualizada Con Exito!'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
	}

    /**
     * Edits an existing Tcchec entity.
     *
     * @Route("/{id}/update", name="tcchec_update")
     * @Method("post")
     * @Template("ScontrolBundle:Tcchec:edit.html.twig")
     */
    public function updateAction($id, $lv)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tcchec')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tcchec entity.');
			}

			$editForm   = $this->createForm(new TcchecType(), $entity);
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
						return $this->redirect($this->generateUrl('tcchec_show', array('id' => $entity->getId())));
					else
						return $this->redirect($this->generateUrl('tcchec_edit', array('id' => $entity->getId(), 'lv' => 3)));
				}
				catch(\Exception $e)
				{
					if($lv == 1)
						return array('entity' => $entity, 'form'   => $form->createView());
					else	
						return $this->render("ScontrolBundle:Tcchec:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '1-Imposible Actualizar Lista De Chequeo!'));
				}
			}

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Tcchec:_edit.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Deletes a Tcchec entity.
     *
     * @Route("/{id}/delete", name="tcchec_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Tcchec')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Tcchec entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $id);
				}
	
				return $this->redirect($this->generateUrl('tcchec'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('tcchec_edit', array('id' => $id)));
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
