<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

class ReportController extends Controller
{
	public function indexAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$empresas = $em->getRepository('ScontrolBundle:Gbempr')->findBy(array(),array('nombre' => 'ASC'));
		
		return $this->render('ScontrolBundle:Report:index.html.twig',array('empresas'=>$empresas));
	}
	
	public function sexoAction($empresa,$inicio,$fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$entity = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaSexo($empresa, $inicio, $fin);
			
		$pdf = new \Tcpdf_Tcpdf('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('VIMELAB');
		$pdf->SetTitle('Estadística por sexo');
		$pdf->SetSubject('Estadística por sexo en pacientes');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetAutoPageBreak(FALSE, 0);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->AddPage();

		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$pdf->SetFont('dejavusans', '', 8);

		$hembra = $entity[0];
		$varon = $entity[1];
		
		arsort($entity);
		$max = $entity[0];
		$max = intval(($max + 10) /10.0) * 10;
		
		$postvaron = ((150 * $varon)/$max);
		$posthembra = ((150 * $hembra)/$max);
		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 180-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		
		$pdf->Line(43, 25, 43, 180, $style1); // Eje Y
		$pdf->Line(43, 180, 150, 180, $style1); // Eje X
		
		$pdf->Rect(55, 180-$postvaron, 35, $postvaron, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo varón
		$pdf->Rect(95, 180-$posthembra, 35, $posthembra, 'DF', 'all', $fill_color = array(0,46,29,24)); // Rectángulo hembra
		
			
		$pdf->SetFont('dejavusans', '', 12);
		$html = '<b> Hembra '.$hembra.' Varón '.$varon.'</b>';
		$pdf->writeHTMLCell(216, 0, 0, 3, $html, '', 0, 0, true, 'C', true);
		
		$pdf->Output('infoaudi.pdf', 'I');
	
	}
	
	public function edadAction()
	{
		
	}
}
