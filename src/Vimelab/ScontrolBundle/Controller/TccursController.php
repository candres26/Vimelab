<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Tccurs;
use Vimelab\ScontrolBundle\Form\TccursType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Tccurs controller.
 *
 * @Route("/tccurs")
 */
class TccursController extends Controller
{
    /**
     * Lists all Tccurs entities.
     *
     * @Route("/", name="tccurs")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Tccurs')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Tccurs')->getPage(20, $pag);
			$empresas = $em->getRepository('ScontrolBundle:Gbempr')->findBy(array(),array('nombre' => 'ASC'));

			return array('entities' => $entities, 'pages' => $pages, 'pag' => $pag, 'empresas' => $empresas);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();
            $repo = $em->getRepository('ScontrolBundle:Tccurs');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Tccurs:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Tccurs entity.
     *
     * @Route("/{id}/show", name="tccurs_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tccurs')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tccurs entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Tccurs entity.
     *
     * @Route("/new", name="tccurs_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Tccurs();
			$form   = $this->createForm(new TccursType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Tccurs entity.
     *
     * @Route("/create", name="tccurs_create")
     * @Method("post")
     * @Template("ScontrolBundle:Tccurs:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Tccurs();
			$request = $this->getRequest();
			$form    = $this->createForm(new TccursType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('tccurs_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Tccurs entity.
     *
     * @Route("/{id}/edit", name="tccurs_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tccurs')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tccurs entity.');
			}

			$editForm = $this->createForm(new TccursType(), $entity);
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
     * Edits an existing Tccurs entity.
     *
     * @Route("/{id}/update", name="tccurs_update")
     * @Method("post")
     * @Template("ScontrolBundle:Tccurs:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tccurs')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tccurs entity.');
			}

			$editForm   = $this->createForm(new TccursType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('tccurs_show', array('id' => $id)));
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
     * Deletes a Tccurs entity.
     *
     * @Route("/{id}/delete", name="tccurs_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Tccurs')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Tccurs entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $id);
				}
	
				return $this->redirect($this->generateUrl('tccurs'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('tccurs_edit', array('id' => $id)));
			}
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    public function reportAction($empr, $paci)
    {
    	$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE CURSOS');
		$pdf->SetSubject('R. Cursos');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(20, 38, 20);
		$pdf->SetHeaderMargin(2);
		$pdf->SetFooterMargin(15);
		$pdf->SetAutoPageBreak(TRUE, 21);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setTabl(true);
		$pdf->setMemoTitle("REPORTE DE CURSOS");
		$pdf->AddPage();
		
		$em = $this->getDoctrine()->getEntityManager();
		$casos = $em->getRepository('ScontrolBundle:Tccurs')->listReport($empr, $paci);
		$html = '<table border="1">';
		$html .= '<tr bgcolor="#CAC5C5"><td><b>PACIENTE</b></td><td><b>CAPACITACIÓN</b></td><td><b>F. CULMINACIÓN</b></td><td><b>EMPRESA</b></td></tr>';
		$pic = '#C7D8E9';

		foreach ($casos as $caso) 
		{
			$paci = $caso->getMdpaci();
			$capa = $caso->getTccapa();
			$empr = $paci->getGbsucu()->getGbempr();

			$pic = $pic == '#C7D8E9' ? '#FFFFFF' : '#C7D8E9';

			$html .= '<tr bgcolor="'.$pic.'">';
			$html .= '<td>'.strtoupper($paci->getFullName()).'</td>';
			$html .= '<td>'.strtoupper($capa->getNombre()).'</td>';
			$html .= '<td>'.$caso->getFin()->format('Y-m-d').'</td>';
			$html .= '<td>'.strtoupper($empr->getNombre()).'</td>';
			$html .= '</tr>';
		}

		$html .= '</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'C', true);
		
		$pdf->Output('r_curso_.pdf', 'I');
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
