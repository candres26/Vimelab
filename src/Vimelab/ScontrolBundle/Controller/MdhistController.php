<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Mdhist;
use Vimelab\ScontrolBundle\Form\MdhistType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Mdhist controller.
 *
 * @Route("/mdhist")
 */
class MdhistController extends Controller
{
    /**
     * Lists all Mdhist entities.
     *
     * @Route("/", name="mdhist")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Mdhist')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Mdhist')->getPage(20, $pag);

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
            $repo = $em->getRepository('ScontrolBundle:Mdhist');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Mdhist:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Mdhist entity.
     *
     * @Route("/{id}/show", name="mdhist_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdhist')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdhist entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Mdhist entity.
     *
     * @Route("/new", name="mdhist_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Mdhist();
			$form   = $this->createForm(new MdhistType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Mdhist entity.
     *
     * @Route("/create", name="mdhist_create")
     * @Method("post")
     * @Template("ScontrolBundle:Mdhist:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Mdhist();
			$request = $this->getRequest();
			$form    = $this->createForm(new MdhistType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('mdhist_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Mdhist entity.
     *
     * @Route("/{id}/edit", name="mdhist_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdhist')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdhist entity.');
			}

			$editForm = $this->createForm(new MdhistType(), $entity);
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
     * Edits an existing Mdhist entity.
     *
     * @Route("/{id}/update", name="mdhist_update")
     * @Method("post")
     * @Template("ScontrolBundle:Mdhist:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Mdhist')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Mdhist entity.');
			}

			$editForm   = $this->createForm(new MdhistType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('mdhist_show', array('id' => $id)));
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
     * Deletes a Mdhist entity.
     *
     * @Route("/{id}/delete", name="mdhist_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Mdhist')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Mdhist entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $id);
				}
	
				return $this->redirect($this->generateUrl('mdhist'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('mdhist_edit', array('id' => $id)));
			}
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    public function reportAction($id)
    {
    	if(Tool::isGrant($this))
		{

			$em = $this->getDoctrine()->getEntityManager();
			$entity = $em->getRepository('ScontrolBundle:Mdhist')->find($id);
			$paci = $entity->getMdpaci();
			$pers = $entity->getGbpers();

			$biom = $em->getRepository('ScontrolBundle:Mdbiom')->findOneByMdhist($entity->getId());
			$obAudi = $em->getRepository('ScontrolBundle:Mdaudi')->findOneByMdhist($entity->getId());
			
			$dermas = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 1);
			$ndermas = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("100");
			$pupila = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 2);
			$npupila = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("200");
			$boca = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 3);
			$nboca = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("300");
			$garga = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 4);
			$ngarga = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("400");
			$otod = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 5);
			$notod = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("500");
			$otoi = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 6);
			$notoi = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("600");
			$cardi = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 7);
			$ncardi = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("700");
			$respi = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 8);
			$nrespi = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("800");
			$diges = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 9);
			$ndiges = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("900");
			$loco = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 10);
			$nloco = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("1000");
			$nervi = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 11);
			$nnervi = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("1100");
			$anali = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 12);
			$nanali = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("1200");
			$elec = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 13);
			$nelec = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("1300");
			$visio = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 14);
			$nvisio = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("1400");
			$audio = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 15);
			$naudio = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("1500");
			$espi = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 16);
			$nespi = $em->getRepository('ScontrolBundle:Mdpato')->findOneByCodigo("1600");
			$comen = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 17);
			$cbiom = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 18);
			$reco = $em->getRepository('ScontrolBundle:Mddiag')->getByGrup($entity->getId(), 19);

			$pdf = new \Tcpdf_Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Vimelab');
			$pdf->SetTitle('INFORME DE RECONOCIMIENTO MÉDICO');
			$pdf->SetSubject('R. Médica');
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetMargins(20, 38, 20);
			$pdf->SetHeaderMargin(2);
			$pdf->SetFooterMargin(15);
			$pdf->SetAutoPageBreak(TRUE, 21);
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			$pdf->setRevi(true);
			$pdf->setEntity($entity);

			$pdf->AddPage();					
			$pdf->SetFont('dejavusans', '', 10);

			$html = '<h2>INFORME DE RECONOCIMIENTO MÉDICO</h2><br>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'C', true);

			$html = '<b>BIOMETRÍA:</b><br><br>';
			
			if ($biom)
			{	
				$html .= '<table align="left">';
				$html .= '<tr>';
				$html .= '<td>SEXO: '.$paci->getStrSexo().'</td>';
				$html .= '<td>EDAD: '.$paci->getEdad().' años.</td>';
				$html .= '<td>TALLA: '.intval($biom->getTalla()).' cm.</td>';
				$html .= '<td>PESO: '.intval($biom->getPeso()).' kg.</td>';
				$html .= '<td>PULSO: '.intval($biom->getPulso()).' p/min.</td>';
				$html .= '</tr>';
				$html .= '<tr>';
				$html .= '<td colspan="2">F. RESPIRATORIA: '.intval($biom->getFres()).' p/min.</td>';
				$html .= '<td colspan="3">P. ARTERIAL: '.intval($biom->getPasisto()).'/'.intval($biom->getPadiasto()).' mmHg.</td>';
				$html .= '</tr>';
				$html .= '</table>';
			}
			else
				$html .= '<b style="color: red;">SIN DATOS</b>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);

			$pdf->Ln(5);
			$html = '<b>DERMATOLOGÍA:</b>';
			$html .= '<ul>';
			if(count($dermas) >0 )
			{	
				foreach ($dermas as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$ndermas->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);

			$pdf->Ln(5);
			$html = '<b>PUPILAS:</b>';
			$html .= '<ul>';
			if(count($pupila) > 0)
			{
				foreach ($pupila as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$npupila->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>BOCA Y DENTICIÓN:</b>';
			$html .= '<ul>';
			if(count($boca) > 0)
			{
				foreach ($boca as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$nboca->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>GARGANTA:</b>';
			$html .= '<ul>';
			if(count($garga) > 0)
			{
				foreach ($garga as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$ngarga->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>OTOSCOPIA DERECHA:</b>';
			$html .= '<ul>';
			if(count($otod) > 0)
			{
				foreach ($otod as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$notod->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>OTOSCOPIA IZQUIERDA:</b>';
			$html .= '<ul>';
			if(count($otoi) > 0)
			{
				foreach ($otoi as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$notoi->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>APARATO CARDIOCIRCULATORIO:</b>';
			$html .= '<ul>';
			if(count($cardi) > 0)
			{
				foreach ($cardi as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$ncardi->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>APARATO RESPIRATORIO:</b>';
			$html .= '<ul>';
			if(count($respi) > 0)
			{
				foreach ($respi as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$nrespi->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>APARATO DIGESTIVO:</b>';
			$html .= '<ul>';
			if(count($diges) > 0)
			{
				foreach ($diges as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$ndiges->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>APARATO LOCOMOTOR:</b>';
			$html .= '<ul>';
			if(count($loco) > 0)
			{
				foreach ($loco as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$nloco->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>SISTEMA NERVIOSO:</b>';
			$html .= '<ul>';
			if(count($nervi) > 0)
			{
				foreach ($nervi as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$nnervi->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>ANALITICA:</b>';
			$html .= '<ul>';
			if(count($anali) > 0)
			{
				foreach ($anali as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$nanali->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>ELECTROCARDIOGRAMA:</b>';
			$html .= '<ul>';
			if(count($elec) > 0)
			{
				foreach ($elec as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$nelec->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>CONTROL DE VISIÓN:</b>';
			$html .= '<ul>';
			if(count($visio) > 0)
			{
				foreach ($visio as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$nvisio->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>AUDIOMETRÍA:</b>';
			$html .= '<ul>';
			if(count($audio) > 0)
			{
				foreach ($audio as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$naudio->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			$pdf->Ln(5);
			$html = '<b>ESPIROMETRÍA:</b>';
			$html .= '<ul>';
			if(count($espi) > 0)
			{
				foreach ($espi as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';
			}
			else
				$html .= '<li>'.$nespi->getNombre().'</li>';
			$html .= '</ul>';
			$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			
			if(count($comen) > 0)
			{
				$pdf->Ln(5);
				$html = '<b>COMENTARIOS:</b>';
				$html .= '<ul>';
			
				foreach ($comen as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';

				$html .= '</ul>';
				$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			}
			
			if(count($cbiom) > 0)
			{
				$pdf->Ln(5);
				$html = '<b>COMENTARIOS DE BIOMETRÍA:</b>';
				$html .= '<ul>';
			
				foreach ($cbiom as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';

				$html .= '</ul>';
				$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			}

			if(count($reco) > 0)
			{
				$pdf->Ln(5);
				$html = '<b>RECOMENDACIONES:</b>';
				$html .= '<ul>';
			
				foreach ($reco as $caso) 
					$html .= '<li>'.$caso->getMdpato()->getNombre().'</li>';

				$html .= '</ul>';
				$pdf->writeHTMLCell(170, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);
			}

			$pdf->AddPage();

			$style1 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
			$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
			$style3 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
			$style4 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
			
			
			$pdf->SetFont('dejavusans', '', 8);
			
			for($i = -5; $i <= 100; $i+=5)
			{
				$pdf->writeHTMLCell(10, 20, 18, 53.5+$i,'<div style="color: #000; text-align: rigth;"><b>'.$i.'</b></div>');
				$pdf->Line(27.5, 55+$i, 32.5, 55+$i, $style2);
			}
			
			$hrz = array(500, 1000, 2000, 3000, 4000, 6000, 8000);
			for($i = 0; $i < count($hrz); $i++)
			{
				$pdf->writeHTMLCell(20, 20, 35+($i*15), 163,'<div style="color: #000; text-align: center;"><b>'.$hrz[$i].'</b></div>');
				$pdf->Line(45+($i*15), 162.5, 45+($i*15), 157.5, $style2); 
			}
			
			$pdf->writeHTMLCell(20, 20, 25, 40,'<div style="color: #000;"><b>dBA</b></div>');
			$pdf->writeHTMLCell(20, 20, 150, 157.5,'<div style="color: #000;"><b>Hz</b></div>');
			$pdf->Line(30, 45, 30, 160, $style1);
			$pdf->Line(30, 160, 150, 160, $style1);
			
			$pdf->writeHTMLCell(30, 20, 157, 63,'<div style="color: #000;"><b>O. Izquierdo</b></div>');
			$pdf->writeHTMLCell(30, 20, 157, 68,'<div style="color: #000;"><b>O. Derecho</b></div>');
			$pdf->Line(150, 65, 155, 65, $style3);
			$pdf->Line(150, 70, 155, 70, $style4);
			
			if($obAudi && $obAudi->getRealizado() == 'S')
			{
				$arr = $obAudi->getInArray();
				$rder = "";
				$rizq = "";

				for($i = 1; $i < count($arr[0]); $i++)
				{
					$x1 = 45+(($i-1) * 15);
					$x2 = 45+(($i) * 15);
					
					$y1 = 55+intval($arr[0][$i-1]);
					$y2 = 55+intval($arr[0][$i]);;
					
					$y3 = 55+intval($arr[1][$i-1]);
					$y4 = 55+intval($arr[1][$i]);;
					
					$pdf->Line($x1, $y1, $x2, $y2, $style3);
					$pdf->Line($x1, $y3, $x2, $y4, $style4);
				}

				$rder = "";
				$rizq = "";

				for($i = 0; $i < count($arr[0]); $i++)
				{
					$rizq .= '<td>'.$arr[0][$i].'</td>';
					$rder .= '<td>'.$arr[1][$i].'</td>';
				}

				$tar = '<table border="1"><tr><td><b>Oido Drc.:</b></td>'.$rizq.'</tr><tr><td><b>Oido Izq.:</b></td>'.$rder.'</tr></table>';
				$pdf->writeHTMLCell(170, 0, 20, 170, $tar, '', 0, 0, true, 'C', true);
			}
			else
			{
				$pdf->SetFont('dejavusans', '', 20);
				$html = '<b color="red">NO REALIZADO</b>';
				$pdf->writeHTMLCell(216, 0, 0, 50, $html, '', 0, 0, true, 'C', true);
			}	
			
			$pdf->SetFont('dejavusans', '', 12);
			$html = "<b>Gráfica De Audiometría</b>";
			$pdf->writeHTMLCell(216, 0, 0, 40, $html, '', 0, 0, true, 'C', true);

			$pdf->SetFont('dejavusans', '', 10);

			$html = '<b>OBSERVACIONES FINALES:</b>';
			$html .= '<p>'.$entity->getComentario().'</p>';
			$pdf->writeHTMLCell(170, 0, 20, 185, $html, '', 0, 0, true, 'J', true);			

			$html = '<b>'.$pers->getFullname().'</b><br>';
			$html .= '<b>Identificación: '.$pers->getIdentificacion().'</b><br>';
			$html .= '<b>Colegiado: '.$pers->getNumcolegiado().'</b><br>';
			$html .= '<i>Médico Reconocedor</i><br>';
			$pdf->writeHTMLCell(216, 0, 0, 258, $html, '', 0, 0, true, 'C', true);
			$pdf->Line(50, 257, 160, 257, $style1);

			ob_end_clean();
			$pdf->Output('r_medica_'.$id.'.pdf', 'I');
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
