<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Mdgrup;
use Vimelab\ScontrolBundle\Form\MdgrupType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Mdgrup controller.
 *
 * @Route("/mdgrup")
 */
class MdgrupController extends Controller
{
    /**
     * Lists all Mdgrup entities.
     *
     * @Route("/", name="mdgrup")
     * @Template()
     */
    public function indexAction($pag)
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();
            
            $pages = $em->getRepository('ScontrolBundle:Mdgrup')->getCountPages(20);
            $pag = $pag < 1 ? 1 : $pag;
            $pag = $pag > $pages ? $pages: $pag;
            
            $entities = $em->getRepository('ScontrolBundle:Mdgrup')->getPage(20, $pag);

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
            $repo = $em->getRepository('ScontrolBundle:Mdgrup');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Mdgrup:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Mdgrup entity.
     *
     * @Route("/{id}/show", name="mdgrup_show")
     * @Template()
     */
    public function showAction($id)
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();

            $entity = $em->getRepository('ScontrolBundle:Mdgrup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mdgrup entity.');
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
     * Displays a form to create a new Mdgrup entity.
     *
     * @Route("/new", name="mdgrup_new")
     * @Template()
     */
    public function newAction()
    {
        if(Tool::isGrant($this))
        {
            $entity = new Mdgrup();
            $form   = $this->createForm(new MdgrupType(), $entity);

            return array(
                'entity' => $entity,
                'form'   => $form->createView()
            );
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Mdgrup entity.
     *
     * @Route("/create", name="mdgrup_create")
     * @Method("post")
     * @Template("ScontrolBundle:Mdgrup:new.html.twig")
     */
    public function createAction()
    {
        if(Tool::isGrant($this))
        {
            $entity  = new Mdgrup();
            $request = $this->getRequest();
            $form    = $this->createForm(new MdgrupType(), $entity);
            $form->bindRequest($request);

            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                Tool::logger($this, $entity->getId());
                return $this->redirect($this->generateUrl('mdgrup_show', array('id' => $entity->getId())));
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
     * Displays a form to edit an existing Mdgrup entity.
     *
     * @Route("/{id}/edit", name="mdgrup_edit")
     * @Template()
     */
    public function editAction($id)
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();

            $entity = $em->getRepository('ScontrolBundle:Mdgrup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mdgrup entity.');
            }

            $editForm = $this->createForm(new MdgrupType(), $entity);
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
     * Edits an existing Mdgrup entity.
     *
     * @Route("/{id}/update", name="mdgrup_update")
     * @Method("post")
     * @Template("ScontrolBundle:Mdgrup:edit.html.twig")
     */
    public function updateAction($id)
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();

            $entity = $em->getRepository('ScontrolBundle:Mdgrup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mdgrup entity.');
            }

            $editForm   = $this->createForm(new MdgrupType(), $entity);
            $deleteForm = $this->createDeleteForm($id);

            $request = $this->getRequest();

            $editForm->bindRequest($request);

            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();

                Tool::logger($this, $entity->getId());
                return $this->redirect($this->generateUrl('mdgrup_show', array('id' => $id)));
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
     * Deletes a Mdgrup entity.
     *
     * @Route("/{id}/delete", name="mdgrup_delete")
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
                $entity = $em->getRepository('ScontrolBundle:Mdgrup')->find($id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Mdgrup entity.');
                }

                $em->remove($entity);
                $em->flush();
            }

            Tool::logger($this, $id);
            return $this->redirect($this->generateUrl('mdgrup'));
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
