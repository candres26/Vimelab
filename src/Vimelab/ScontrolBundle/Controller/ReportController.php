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
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
			
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR SEXO');
		$pdf->SetSubject('Estadística por sexo en pacientes.');
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
		$pdf->setMemoTitle("<h2>REPORTE DE ESTADÍSTICA POR SEXO</h2>");
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
		$pdf->Rect(95, 180-$posthembra, 35, $posthembra, 'DF', $border_style, $fill_color = array(0,91,86,24)); // Rectángulo hembra

		$totalpersonas = $hembra + $varon;
		$html= '
		<table border="1">
			<tr>
				<td><b>Sexo</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> Varón</td>
				<td>'.$varon.'</td>
			</tr>
			<tr>
				<td align="left"> Hembra</td>
				<td>'.$hembra.'</td>
			</tr>
			<tr>
				<td align="left"> Total Personas</td>
				<td><b>'.$totalpersonas.'</b></td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 12);
		$pdf->writeHTMLCell(80,0,175,120,$html, '', 0, 0, true, 'C', true);
		$html = '
		<table>
			<tr>
				<td align="left">Varón</td>
			</tr>
			<tr>
				<td align="left">Hembra</td>
			</tr>
		</table>';
		$pdf->writeHTMLCell(80, 0, 180, 80, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td><b>Búsqueda</b></td>
				<td><b>Resultados</b></td>
			</tr>
			<tr>
				<td align="left"> Empresa</td>
				<td>'.$nombreempresa.'</td>
			</tr>
			<tr>
				<td align="left"> Fecha Inicial</td>
				<td>'.$inicio.'</td>
			</tr>
			<tr>
				<td align="left"> Fecha Final</td>
				<td>'.$fin.'</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 12);
		$pdf->writeHTMLCell(80,0,175,150,$html, '', 0, 0, true, 'C', true);
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(175, 81, 3, 3, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,91,86,24);
		$pdf->SetFillColor(0,91,86,24);
		$pdf->Rect(175, 86.5, 3, 3, 'DF', $border_style);
		
		$pdf->Output('estadisticasexo.pdf', 'I');
	
	}
	
	public function edadAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$pacientes = $em->getRepository('ScontrolBundle:Mdpaci')->find('1');
		
		$pdf = new \Tcpdf_Tcpdf('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('VIMELAB');
		$pdf->SetTitle('Estadística por sexo');
		$pdf->SetSubject('Estadística por edades en pacientes');
		
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetAutoPageBreak(FALSE, 0);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->AddPage();
		
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		
		$nacipaci = $pacientes->getNacimiento();
		$fechactual = date("j-m-Y");
		$html = '<b>Estadística de Edades</b>';
		$pdf->writeHTMLCell(100, 0, 100, 15, $html, '', 0, 0, true, 'C', true);
		$html = '<b>'.$nacipaci->format('m-d-Y').' Fecha Actual: '.$fechactual.'</b>';
		$pdf->writeHTMLCell(100, 0, 100, 30, $html, '', 0, 0, true, 'C', true);
		$html=
		'
		<table border="1">
			<tr>
				<td><b>Rangos</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td>Sin Calificar</td>
				<td>0</td>
			</tr>
			<tr>
				<td>menor de 16 años</td>
				<td>0</td>
			</tr>
			<tr>
				<td>de 17 a 20 años</td>
				<td>0</td>
			</tr>
			<tr>
				<td>de 21 a 35 años</td>
				<td>0</td>
			</tr>
			<tr>
				<td>de 36 a 45 años</td>
				<td>0</td>
			</tr>
			<tr>
				<td>de 45 a 55 años</td>
				<td>0</td>
			</tr>
			<tr>
				<td>de 55 a 65 años</td>
				<td>0</td>
			</tr>
			<tr>
				<td>más de 65 años</td>
				<td>0</td>
			</tr>
		</table>
		';
		$pdf->writeHTMLCell(100, 0, 100, 60, $html, '', 0, 0, true, 'C', true);
		
		$html=
		'
		<table border="1">
			<tr>
				<td></td>
				<td align="left"> Sin Calificar</td>
			</tr>
			<tr>
				<td></td>
				<td align="left"> menor de 16 años</td>
			</tr>
			<tr>
				<td></td>
				<td align="left"> de 17 a 20 años</td>
			</tr>
			<tr>
				<td></td>
				<td align="left"> de 21 a 35 años</td>
			</tr>
			<tr>
				<td></td>
				<td align="left"> de 36 a 45 años</td>
			</tr>
			<tr>
				<td></td>
				<td align="left"> de 45 a 55 años</td>
			</tr>
			<tr>
				<td></td>
				<td align="left"> de 55 a 65 años</td>
			</tr>
			<tr>
				<td></td>
				<td align="left"> más de 65 años</td>
			</tr>
		</table>
		';
		$pdf->writeHTMLCell(80, 0, 100, 120, $html, '', 0, 0, true, 'C', true);
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(135, 121, 3, 3, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,91,86,24);
		$pdf->SetFillColor(0,91,86,24);
		$pdf->Rect(135, 126.5, 3, 3, 'DF', $border_style);
		
		$pdf->SetDrawColor(2, 0, 0, 12);
		$pdf->SetFillColor(2, 0, 0, 12);
		$pdf->Rect(135, 131.6, 3, 3, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,91,86,24);
		$pdf->SetFillColor(0,91,86,24);
		$pdf->Rect(135, 137, 3, 3, 'DF', $border_style);
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(135, 142.4, 3, 3, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,91,86,24);
		$pdf->SetFillColor(0,91,86,24);
		$pdf->Rect(135, 147.6, 3, 3, 'DF', $border_style);
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(135, 152.8, 3, 3, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,91,86,24);
		$pdf->SetFillColor(0,91,86,24);
		$pdf->Rect(135, 157.9, 3, 3, 'DF', $border_style);
		
		$pdf->Output('estadisticaedad.pdf', 'I');
		
	}
}
