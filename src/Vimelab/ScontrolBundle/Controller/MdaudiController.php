<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Mdaudi;
use Vimelab\ScontrolBundle\Form\MdaudiType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Mdaudi controller.
 *
 * @Route("/mdaudi")
 */
class MdaudiController extends Controller
{
    /**
     * Lists all Mdaudi entities.
     *
     * @Route("/", name="mdaudi")
     * @Template()
     */
    public function indexAction()
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Mdaudi')->findAll();

			return array('entities' => $entities);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Mdaudi');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Mdaudi:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Mdaudi entity.
     *
     * @Route("/{id}/show", name="mdaudi_show")
     * @Template()
     */
    public function showAction($id, $lv)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			$entity = $em->getRepository('ScontrolBundle:Mdaudi')->find($id);
			
			if($lv == 1)
			{	
				$em = $this->getDoctrine()->getEntityManager();
	
				$entity = $em->getRepository('ScontrolBundle:Mdaudi')->find($id);
	
				if (!$entity) 
				{
					throw $this->createNotFoundException('Unable to find Mdaudi entity.');
				}
	
				$deleteForm = $this->createDeleteForm($id);
	
				return array(
					'entity'      => $entity,
					'delete_form' => $deleteForm->createView(),        );
			}
			else
			{
				$pdf = new \Tcpdf_Tcpdf('L', PDF_UNIT, 'MEMO', true, 'UTF-8', false);

				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('VIMELAB');
				$pdf->SetTitle('Audiometria');
				$pdf->SetSubject('Audiometria');
		
				$pdf->setPrintHeader(false);
				$pdf->setPrintFooter(false);
		
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetAutoPageBreak(FALSE, 0);
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
				$pdf->AddPage();
		
				$style1 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
				$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
				$style3 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
				$style4 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
				
				
				$pdf->SetFont('dejavusans', '', 8);
				
				for($i = -5; $i <= 100; $i+=5)
				{
					$pdf->writeHTMLCell(10, 20, 18, 18.5+$i,'<div style="color: #000; text-align: rigth;"><b>'.$i.'</b></div>');
					$pdf->Line(27.5, 20+$i, 32.5, 20+$i, $style2);
				}
				
				$hrz = array(500, 1000, 2000, 3000, 4000, 6000, 8000);
				for($i = 0; $i < count($hrz); $i++)
				{
					$pdf->writeHTMLCell(20, 20, 35+($i*15), 128,'<div style="color: #000; text-align: center;"><b>'.$hrz[$i].'</b></div>');
					$pdf->Line(45+($i*15), 127.5, 45+($i*15), 122.5, $style2); 
				}
				
				$pdf->writeHTMLCell(20, 20, 25, 5,'<div style="color: #000;"><b>dBA</b></div>');
				$pdf->writeHTMLCell(20, 20, 150, 122.5,'<div style="color: #000;"><b>Hz</b></div>');
				$pdf->Line(30, 10, 30, 125, $style1);
				$pdf->Line(30, 125, 150, 125, $style1);
				
				$pdf->writeHTMLCell(30, 20, 157, 28,'<div style="color: #000;"><b>O. Izquierdo</b></div>');
				$pdf->writeHTMLCell(30, 20, 157, 33,'<div style="color: #000;"><b>O. Derecho</b></div>');
				$pdf->Line(150, 30, 155, 30, $style3);
				$pdf->Line(150, 35, 155, 35, $style4);
				
				$arr = $entity->getInArray();
				
				for($i = 1; $i < count($arr[0]); $i++)
				{
					$x1 = 45+(($i-1) * 15);
					$x2 = 45+(($i) * 15);
					
					$y1 = 20+intval($arr[0][$i-1]);
					$y2 = 20+intval($arr[0][$i]);;
					
					$y3 = 20+intval($arr[1][$i-1]);
					$y4 = 20+intval($arr[1][$i]);;
					
					$pdf->Line($x1, $y1, $x2, $y2, $style3);
					$pdf->Line($x1, $y3, $x2, $y4, $style4);
				}
				
				$pdf->SetFont('dejavusans', '', 12);
				$html = "<b>Gráfica De Audiometría</b>";
				$pdf->writeHTMLCell(216, 0, 0, 3, $html, '', 0, 0, true, 'C', true);
				
				$pdf->Output('example_012.pdf', 'I');
			}
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Mdaudi entity.
     *
     * @Route("/new", name="mdaudi_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Mdaudi();
			$form   = $this->createForm(new MdaudiType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Mdaudi entity.
     *
     * @Route("/create", name="mdaudi_create")
     * @Method("post")
     * @Template("ScontrolBundle:Mdaudi:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Mdaudi();
			$request = $this->getRequest();
			$form    = $this->createForm(new MdaudiType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('mdaudi_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Mdaudi entity.
     *
     * @Route("/{id}/edit", name="mdaudi_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdaudi')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdaudi entity.');
			}

			$editForm = $this->createForm(new MdaudiType(), $entity);
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
     * Edits an existing Mdaudi entity.
     *
     * @Route("/{id}/update", name="mdaudi_update")
     * @Method("post")
     * @Template("ScontrolBundle:Mdaudi:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdaudi')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdaudi entity.');
			}

			$editForm   = $this->createForm(new MdaudiType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('mdaudi_show', array('id' => $id)));
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
     * Deletes a Mdaudi entity.
     *
     * @Route("/{id}/delete", name="mdaudi_delete")
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
				$entity = $em->getRepository('ScontrolBundle:Mdaudi')->find($id);

				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Mdaudi entity.');
				}

				$em->remove($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
			}

			return $this->redirect($this->generateUrl('mdaudi'));
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
