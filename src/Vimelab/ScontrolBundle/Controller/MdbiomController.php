<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Mdbiom;
use Vimelab\ScontrolBundle\Form\MdbiomType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Mdbiom controller.
 *
 * @Route("/mdbiom")
 */
class MdbiomController extends Controller
{
    /**
     * Lists all Mdbiom entities.
     *
     * @Route("/", name="mdbiom")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Mdbiom')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Mdbiom')->getPage(20, $pag);

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
            $repo = $em->getRepository('ScontrolBundle:Mdbiom');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Mdbiom:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Mdbiom entity.
     *
     * @Route("/{id}/show", name="mdbiom_show")
     * @Template()
     */
    public function showAction($id, $lv)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdbiom')->find($id);
			
			if($lv == 1)
			{
				if (!$entity) 
				{
					throw $this->createNotFoundException('Unable to find Mdbiom entity.');
				}
	
				$deleteForm = $this->createDeleteForm($id);
	
				return array('entity' => $entity, 'delete_form' => $deleteForm->createView());
			}
			else if($lv == 2)
				return $this->render("ScontrolBundle:Mdbiom:_show.html.twig", array('entity' => $entity, 'RMSG' => $entity->getId()."-Biometría creada con exito!"));
			else if($lv == 4)
				return $this->render("ScontrolBundle:Mdbiom:_show.html.twig", array('entity' => $entity, 'RMSG' => 'NONE'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Mdbiom entity.
     *
     * @Route("/new", name="mdbiom_new")
     * @Template()
     */
    public function newAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity = new Mdbiom();
			$form   = $this->createForm(new MdbiomType(), $entity);

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Mdbiom:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Mdbiom entity.
     *
     * @Route("/create", name="mdbiom_create")
     * @Method("post")
     * @Template("ScontrolBundle:Mdbiom:new.html.twig")
     */
    public function createAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Mdbiom();
			$request = $this->getRequest();
			$form    = $this->createForm(new MdbiomType(), $entity);
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
						return $this->redirect($this->generateUrl('mdbiom_show', array('id' => $entity->getId())));
					else
						return $this->redirect($this->generateUrl('mdbiom_show', array('id' => $entity->getId(), 'lv' => '2')));
				}
				catch(\Exception $e)
				{
					if($lv == 1)
						return array('entity' => $entity, 'form'   => $form->createView());
					else	
						return $this->render("ScontrolBundle:Mdbiom:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '1-Imposible Crear Biometría, Error Referencial!'));
				}
			}

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Mdbiom:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Mdbiom entity.
     *
     * @Route("/{id}/edit", name="mdbiom_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdbiom')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdbiom entity.');
			}

			$editForm = $this->createForm(new MdbiomType(), $entity);
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
     * Edits an existing Mdbiom entity.
     *
     * @Route("/{id}/update", name="mdbiom_update")
     * @Method("post")
     * @Template("ScontrolBundle:Mdbiom:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdbiom')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdbiom entity.');
			}

			$editForm   = $this->createForm(new MdbiomType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('mdbiom_show', array('id' => $id)));
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
     * Deletes a Mdbiom entity.
     *
     * @Route("/{id}/delete", name="mdbiom_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Mdbiom')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Mdbiom entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $eid);
				}
	
				return $this->redirect($this->generateUrl('mdbiom'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('mdbiom_edit', array('id' => $id)));
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
