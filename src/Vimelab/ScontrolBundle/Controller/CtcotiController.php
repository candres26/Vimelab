<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Ctcoti;
use Vimelab\ScontrolBundle\Form\CtcotiType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Ctcoti controller.
 *
 * @Route("/ctcoti")
 */
class CtcotiController extends Controller
{
    /**
     * Lists all Ctcoti entities.
     *
     * @Route("/", name="ctcoti")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Ctcoti')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Ctcoti')->getPage(20, $pag);

			return array('entities' => $entities, 'pages' => $pages, 'pag' => $pag);	
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
		
    }
    
	public function filterAction($param = '')
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();
            $repo = $em->getRepository('ScontrolBundle:Ctcoti');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Ctcoti:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Ctcoti entity.
     *
     * @Route("/{id}/show", name="ctcoti_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctcoti')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctcoti entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Ctcoti entity.
     *
     * @Route("/new", name="ctcoti_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{	
			$entity = new Ctcoti();
			$form   = $this->createForm(new CtcotiType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Ctcoti entity.
     *
     * @Route("/create", name="ctcoti_create")
     * @Method("post")
     * @Template("ScontrolBundle:Ctcoti:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{	
			$entity  = new Ctcoti();
			$request = $this->getRequest();
			$form    = $this->createForm(new CtcotiType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctcoti_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Ctcoti entity.
     *
     * @Route("/{id}/edit", name="ctcoti_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctcoti')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctcoti entity.');
			}

			$editForm = $this->createForm(new CtcotiType(), $entity);
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
     * Edits an existing Ctcoti entity.
     *
     * @Route("/{id}/update", name="ctcoti_update")
     * @Method("post")
     * @Template("ScontrolBundle:Ctcoti:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctcoti')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctcoti entity.');
			}

			$editForm   = $this->createForm(new CtcotiType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctcoti_show', array('id' => $id)));
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
     * Deletes a Ctcoti entity.
     *
     * @Route("/{id}/delete", name="ctcoti_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Ctcoti')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Ctcoti entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $entity->getId());
				}
	
				return $this->redirect($this->generateUrl('ctcoti'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('ctcoti_edit', array('id' => $id)));
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
