<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Hsfami;
use Vimelab\ScontrolBundle\Form\HsfamiType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Hsfami controller.
 *
 * @Route("/hsfami")
 */
class HsfamiController extends Controller
{
    /**
     * Lists all Hsfami entities.
     *
     * @Route("/", name="hsfami")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Hsfami')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Hsfami')->getPage(20, $pag);

			return array('entities' => $entities, 'pages' => $pages, 'pag' => $pag);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Hsfami');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Hsfami:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
    }

    /**
     * Finds and displays a Hsfami entity.
     *
     * @Route("/{id}/show", name="hsfami_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hsfami')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hsfami entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Hsfami entity.
     *
     * @Route("/new", name="hsfami_new")
     * @Template()
     */
    public function newAction($lv)
	{
		if(Tool::isGrant($this))
		{
			$entity = new Hsfami();
			$form   = $this->createForm(new HsfamiType(), $entity);

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Hsfami:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Hsfami entity.
     *
     * @Route("/create", name="hsfami_create")
     * @Method("post")
     * @Template("ScontrolBundle:Hsfami:new.html.twig")
     */
    public function createAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Hsfami();
			$request = $this->getRequest();
			$form    = $this->createForm(new HsfamiType(), $entity);
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
						return $this->redirect($this->generateUrl('hsfami_show', array('id' => $entity->getId())));
					else
					{	
						$entity  = new Hsfami();
						$form    = $this->createForm(new HsfamiType(), $entity);
						return $this->render("ScontrolBundle:Hsfami:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '0-Antecedente Familiar Creado Con Exito!'));
					}
				}
				catch(\Exception $e)
				{
					if($lv == 1)
						return array('entity' => $entity, 'form'   => $form->createView());
					else	
						return $this->render("ScontrolBundle:Hsfami:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '1-Imposible Crear Antecedente Familiar!'));
				}
			}

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Hsfami:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Hsfami entity.
     *
     * @Route("/{id}/edit", name="hsfami_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hsfami')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hsfami entity.');
			}

			$editForm = $this->createForm(new HsfamiType(), $entity);
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
     * Edits an existing Hsfami entity.
     *
     * @Route("/{id}/update", name="hsfami_update")
     * @Method("post")
     * @Template("ScontrolBundle:Hsfami:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Hsfami')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Hsfami entity.');
			}

			$editForm   = $this->createForm(new HsfamiType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('hsfami_show', array('id' => $id)));
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
     * Deletes a Hsfami entity.
     *
     * @Route("/{id}/delete", name="hsfami_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Hsfami')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Hsfami entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $entity->getId());
				}
	
				return $this->redirect($this->generateUrl('hsfami'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('hsfami_edit', array('id' => $id)));
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
