<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Hslabo;
use Vimelab\ScontrolBundle\Form\HslaboType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Hslabo controller.
 *
 * @Route("/hslabo")
 */
class HslaboController extends Controller
{
    /**
     * Lists all Hslabo entities.
     *
     * @Route("/", name="hslabo")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Hslabo')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Hslabo')->getPage(20, $pag);

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
            $repo = $em->getRepository('ScontrolBundle:Hslabo');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Hslabo:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Hslabo entity.
     *
     * @Route("/{id}/show", name="hslabo_show")
     * @Template()
     */
    public function showAction($id, $lv)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hslabo')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hslabo entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			if($lv == 1)
				return array('entity' => $entity, 'delete_form' => $deleteForm->createView());
			else
				return $this->render("ScontrolBundle:Hslabo:_show.html.twig", array('entity' => $entity, 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Hslabo entity.
     *
     * @Route("/new", name="hslabo_new")
     * @Template()
     */
    public function newAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity = new Hslabo();
			$form   = $this->createForm(new HslaboType(), $entity);

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Hslabo:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Hslabo entity.
     *
     * @Route("/create", name="hslabo_create")
     * @Method("post")
     * @Template("ScontrolBundle:Hslabo:new.html.twig")
     */
    public function createAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Hslabo();
			$request = $this->getRequest();
			$form    = $this->createForm(new HslaboType(), $entity);
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
						return $this->redirect($this->generateUrl('hslabo_show', array('id' => $entity->getId())));
					else
					{	
						$entity  = new Hslabo();
						$form    = $this->createForm(new HslaboType(), $entity);
						return $this->render("ScontrolBundle:Hslabo:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '0-Antecedente Laboral Creado Con Exito!'));
					}
				}
				catch(\Exception $e)
				{
					if($lv == 1)
						return array('entity' => $entity, 'form'   => $form->createView());
					else	
						return $this->render("ScontrolBundle:Hslabo:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '1-Imposible Crear Antecedente Laboral!'));
				}
			}

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Hslabi:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Hslabo entity.
     *
     * @Route("/{id}/edit", name="hslabo_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hslabo')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hslabo entity.');
			}

			$editForm = $this->createForm(new HslaboType(), $entity);
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
     * Edits an existing Hslabo entity.
     *
     * @Route("/{id}/update", name="hslabo_update")
     * @Method("post")
     * @Template("ScontrolBundle:Hslabo:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hslabo')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hslabo entity.');
			}

			$editForm   = $this->createForm(new HslaboType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('hslabo_show', array('id' => $id)));
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
     * Deletes a Hslabo entity.
     *
     * @Route("/{id}/delete", name="hslabo_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Hslabo')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Hslabo entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $id);
				}
	
				return $this->redirect($this->generateUrl('hslabo'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('hslabo_edit', array('id' => $id)));
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
