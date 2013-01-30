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
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR SEXO");
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
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 150, 193, $style1); // Eje X
		
		$pdf->Rect(55, 193-$postvaron, 35, $postvaron, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo varón
		$pdf->Rect(95, 193-$posthembra, 35, $posthembra, 'DF', $border_style, $fill_color = array(0,91,86,24)); // Rectángulo hembra

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
	
	public function edadAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$edades = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaEdad($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR EDAD');
		$pdf->SetSubject('Estadística por edades en pacientes.');
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
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR EDAD");
		$pdf->AddPage();

		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$rango1 = $edades['0-16'];
		$rango2 = $edades['17-20'];
		$rango3 = $edades['21-35'];
		$rango4 = $edades['36-45'];
		$rango5 = $edades['46-55'];
		$rango6 = $edades['56-65'];
		$rango7 = $edades['66-200'];
		
		arsort($edades);
		$max = max($edades);
		$max = intval(($max + 10) /10.0) * 10;
		
		$postrango1 = ((150 * $rango1)/$max);
		$postrango2 = ((150 * $rango2)/$max);
		$postrango3 = ((150 * $rango3)/$max);
		$postrango4 = ((150 * $rango4)/$max);
		$postrango5 = ((150 * $rango5)/$max);
		$postrango6 = ((150 * $rango6)/$max);
		$postrango7 = ((150 * $rango7)/$max);
		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 200, 193, $style1); // Eje X
		
		
		$pdf->Rect(55, 193-$postrango1, 10, $postrango1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo talla1
		$pdf->Rect(75, 193-$postrango2, 10, $postrango2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo talla2
		$pdf->Rect(95, 193-$postrango3, 10, $postrango3, 'DF', $border_style, $fill_color = array(0,2,43,4)); // Rectángulo talla3
		$pdf->Rect(115, 193-$postrango4, 10, $postrango4, 'DF', $border_style, $fill_color = array(52,0,42,2)); // Rectángulo talla4
		$pdf->Rect(135, 193-$postrango5, 10, $postrango5, 'DF', $border_style, $fill_color = array(0,100,100,50)); // Rectángulo talla5
		$pdf->Rect(155, 193-$postrango6, 10, $postrango6, 'DF', $border_style, $fill_color = array(0,60,15,1)); // Rectángulo talla6
		$pdf->Rect(175, 193-$postrango7, 10, $postrango7, 'DF', $border_style, $fill_color = array(94,40,0,18)); // Rectángulo talla7
		
	/*	foreach($edades as $key => $val)
		{
			$html .= $key.': '.$val.'<br>';
		}
		
		$pdf->writeHTMLCell(80, 0, 80, 45, $html, '', 0, 0, true, 'C', true);*/

		
		$html=
		'
		<table border="1">
			<tr>
				<td><b>Rangos</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td>menor de 16 años</td>
				<td>'.$rango1.'</td>
			</tr>
			<tr>
				<td>de 17 a 20 años</td>
				<td>'.$rango2.'</td>
			</tr>
			<tr>
				<td>de 21 a 35 años</td>
				<td>'.$rango3.'</td>
			</tr>
			<tr>
				<td>de 36 a 45 años</td>
				<td>'.$rango4.'</td>
			</tr>
			<tr>
				<td>de 46 a 55 años</td>
				<td>'.$rango5.'</td>
			</tr>
			<tr>
				<td>de 56 a 65 años</td>
				<td>'.$rango6.'</td>
			</tr>
			<tr>
				<td>más de 65 años</td>
				<td>'.$rango7.'</td>
			</tr>
		</table>
		';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(70, 0, 208, 120, $html, '', 0, 0, true, 'C', true);
		
		$html=
		'
		<table>
			<tr>
				<td align="left"> menor de 16 años</td>
			</tr>
			<tr>
				<td align="left"> de 17 a 20 años</td>
			</tr>
			<tr>
				<td align="left"> de 21 a 35 años</td>
			</tr>
			<tr>
				<td align="left"> de 36 a 45 años</td>
			</tr>
			<tr>
				<td align="left"> de 46 a 55 años</td>
			</tr>
			<tr>
				<td align="left"> de 56 a 65 años</td>
			</tr>
			<tr>
				<td align="left"> más de 65 años</td>
			</tr>
		</table>
		';
		
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(60, 0, 212, 70, $html, '', 0, 0, true, 'C', true);
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(210, 71, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,57,54,20);
		$pdf->SetFillColor(0,57,54,20);
		$pdf->Rect(210, 75.5, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,2,43,4);
		$pdf->SetFillColor(0,2,43,4);
		$pdf->Rect(210, 80, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(52,0,42,2);
		$pdf->SetFillColor(52,0,42,2);
		$pdf->Rect(210, 84.5, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,100,100,50);
		$pdf->SetFillColor(0,100,100,50);
		$pdf->Rect(210, 89, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,60,15,1);
		$pdf->SetFillColor(0,60,15,1);
		$pdf->Rect(210, 93.5, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(94,40,0,18);
		$pdf->SetFillColor(94,40,0,18);
		$pdf->Rect(210, 98, 2, 2, 'DF', $border_style);
		
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
		
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(70,0,208,160,$html, '', 0, 0, true, 'C', true);
		
		$pdf->Output('estadisticaedad.pdf', 'I');
		
	}
	
	public function althombresAction($empresa,$inicio,$fin)
	{
		$pdf = new \Tcpdf_Tcpdf('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$em = $this->getDoctrine()->getEntityManager();
		$entity = $em->getRepository('ScontrolBundle:Mdbiom')->getConsultaAlturaHombres($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR ALTURA EN HOMBRES');
		$pdf->SetSubject('Estadística por altura en pacientes hombres.');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(20, 38, 20);
		$pdf->SetHeaderMargin(2);
		$pdf->SetFooterMargin(15);
		$pdf->SetAutoPageBreak(FALSE, 21);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setTabl(true);
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR ALTURA EN HOMBRES");
		$pdf->AddPage();
		
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$pdf->SetFont('dejavusans', '', 11);
		
		$talla1 = $entity[0];
		$talla2 = $entity[1];
		$talla3 = $entity[2];
		$talla4 = $entity[3];
		$talla5 = $entity[4];
		$talla6 = $entity[5];
		$talla7 = $entity[6];
		
		arsort($entity);
		$max = $entity[0];
		$max = intval(($max + 10) /10.0) * 10;
		
		$posttalla1 = ((150 * $talla1)/$max);
		$posttalla2 = ((150 * $talla2)/$max);
		$posttalla3 = ((150 * $talla3)/$max);
		$posttalla4 = ((150 * $talla4)/$max);
		$posttalla5 = ((150 * $talla5)/$max);
		$posttalla6 = ((150 * $talla6)/$max);
		$posttalla7 = ((150 * $talla7)/$max);
		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 200, 193, $style1); // Eje X
		
		$pdf->Rect(55, 193-$posttalla1, 10, $posttalla1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo talla1
		$pdf->Rect(75, 193-$posttalla2, 10, $posttalla2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo talla2
		$pdf->Rect(95, 193-$posttalla3, 10, $posttalla3, 'DF', $border_style, $fill_color = array(0,2,43,4)); // Rectángulo talla3
		$pdf->Rect(115, 193-$posttalla4, 10, $posttalla4, 'DF', $border_style, $fill_color = array(52,0,42,2)); // Rectángulo talla4
		$pdf->Rect(135, 193-$posttalla5, 10, $posttalla5, 'DF', $border_style, $fill_color = array(0,100,100,50)); // Rectángulo talla5
		$pdf->Rect(155, 193-$posttalla6, 10, $posttalla6, 'DF', $border_style, $fill_color = array(0,60,15,1)); // Rectángulo talla6
		$pdf->Rect(175, 193-$posttalla7, 10, $posttalla7, 'DF', $border_style, $fill_color = array(94,40,0,18)); // Rectángulo talla7
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(206, 51, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,57,54,20);
		$pdf->SetFillColor(0,57,54,20);
		$pdf->Rect(206, 55.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,2,43,4);
		$pdf->SetFillColor(0,2,43,4);
		$pdf->Rect(206, 60, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(52,0,42,2);
		$pdf->SetFillColor(52,0,42,2);
		$pdf->Rect(206, 64.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,100,100,50);
		$pdf->SetFillColor(0,100,100,50);
		$pdf->Rect(206, 69, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,60,15,1);
		$pdf->SetFillColor(0,60,15,1);
		$pdf->Rect(206, 73.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(94,40,0,18);
		$pdf->SetFillColor(94,40,0,18);
		$pdf->Rect(206, 78, 2, 2, 'DF', $border_style);
		
		$html = '
		<table>
			<tr>
				<td align="left">menos de 1.40</td>
			</tr>
			<tr>
				<td align="left">de 1.41 a 1.50</td>
			</tr>
			<tr>
				<td align="left">de 1.51 a 1.60</td>
			</tr>
			<tr>
				<td align="left">de 1.61 a 1.70</td>
			</tr>
			<tr>
				<td align="left">de 1.71 a 1.80</td>
			</tr>
			<tr>
				<td align="left">de 1.81 a 1.90</td>
			</tr>
			<tr>
				<td align="left">más de 1.90</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(55, 0, 209, 50, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td><b>Alturas</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> menos de 1.40</td>
				<td>'.$talla1.'</td>
			</tr>
			<tr>
				<td align="left"> de 1.41 a 1.50</td>
				<td>'.$talla2.'</td>
			</tr>
			<tr>
				<td align="left"> de 1.51 a 1.60</td>
				<td>'.$talla3.'</td>
			</tr>
			<tr>
				<td align="left"> de 1.61 a 1.70</td>
				<td>'.$talla4.'</td>
			</tr>
			<tr>
				<td align="left"> de 1.71 a 1.80</td>
				<td>'.$talla5.'</td>
			</tr>
			<tr>
				<td align="left"> de 1.81 a 1.90</td>
				<td>'.$talla6.'</td>
			</tr>
			<tr>
				<td align="left"> más de 1.90</td>
				<td>'.$talla7.'</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(70,0,205,100,$html, '', 0, 0, true, 'C', true);
		
		
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
		
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(70,0,205,150,$html, '', 0, 0, true, 'C', true);
		
		$pdf->Output('estadisticaalturahombres.pdf', 'I');
	}
	
	public function altmujeresAction($empresa,$inicio,$fin)
	{
		$pdf = new \Tcpdf_Tcpdf('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$em = $this->getDoctrine()->getEntityManager();
		$entity = $em->getRepository('ScontrolBundle:Mdbiom')->getConsultaAlturaMujeres($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR ALTURA EN MUJERES');
		$pdf->SetSubject('Estadística por altura en pacientes mujeres.');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(20, 38, 20);
		$pdf->SetHeaderMargin(2);
		$pdf->SetFooterMargin(15);
		$pdf->SetAutoPageBreak(FALSE, 21);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setTabl(true);
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR ALTURA EN MUJERES");
		$pdf->AddPage();
		
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$pdf->SetFont('dejavusans', '', 11);
		
		$talla1 = $entity[0];
		$talla2 = $entity[1];
		$talla3 = $entity[2];
		$talla4 = $entity[3];
		$talla5 = $entity[4];
		$talla6 = $entity[5];
		$talla7 = $entity[6];
		
		arsort($entity);
		$max = $entity[0];
		$max = intval(($max + 10) /10.0) * 10;
		
		$posttalla1 = ((150 * $talla1)/$max);
		$posttalla2 = ((150 * $talla2)/$max);
		$posttalla3 = ((150 * $talla3)/$max);
		$posttalla4 = ((150 * $talla4)/$max);
		$posttalla5 = ((150 * $talla5)/$max);
		$posttalla6 = ((150 * $talla6)/$max);
		$posttalla7 = ((150 * $talla7)/$max);
		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 200, 193, $style1); // Eje X
		
		$pdf->Rect(55, 193-$posttalla1, 10, $posttalla1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo talla1
		$pdf->Rect(75, 193-$posttalla2, 10, $posttalla2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo talla2
		$pdf->Rect(95, 193-$posttalla3, 10, $posttalla3, 'DF', $border_style, $fill_color = array(0,2,43,4)); // Rectángulo talla3
		$pdf->Rect(115, 193-$posttalla4, 10, $posttalla4, 'DF', $border_style, $fill_color = array(52,0,42,2)); // Rectángulo talla4
		$pdf->Rect(135, 193-$posttalla5, 10, $posttalla5, 'DF', $border_style, $fill_color = array(0,100,100,50)); // Rectángulo talla5
		$pdf->Rect(155, 193-$posttalla6, 10, $posttalla6, 'DF', $border_style, $fill_color = array(0,60,15,1)); // Rectángulo talla6
		$pdf->Rect(175, 193-$posttalla7, 10, $posttalla7, 'DF', $border_style, $fill_color = array(94,40,0,18)); // Rectángulo talla7
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(206, 51, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,57,54,20);
		$pdf->SetFillColor(0,57,54,20);
		$pdf->Rect(206, 55.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,2,43,4);
		$pdf->SetFillColor(0,2,43,4);
		$pdf->Rect(206, 60, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(52,0,42,2);
		$pdf->SetFillColor(52,0,42,2);
		$pdf->Rect(206, 64.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,100,100,50);
		$pdf->SetFillColor(0,100,100,50);
		$pdf->Rect(206, 69, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,60,15,1);
		$pdf->SetFillColor(0,60,15,1);
		$pdf->Rect(206, 73.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(94,40,0,18);
		$pdf->SetFillColor(94,40,0,18);
		$pdf->Rect(206, 78, 2, 2, 'DF', $border_style);
		
		$html = '
		<table>
			<tr>
				<td align="left">menos de 1.40</td>
			</tr>
			<tr>
				<td align="left">de 1.41 a 1.50</td>
			</tr>
			<tr>
				<td align="left">de 1.51 a 1.60</td>
			</tr>
			<tr>
				<td align="left">de 1.61 a 1.70</td>
			</tr>
			<tr>
				<td align="left">de 1.71 a 1.80</td>
			</tr>
			<tr>
				<td align="left">de 1.81 a 1.90</td>
			</tr>
			<tr>
				<td align="left">más de 1.90</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(55, 0, 209, 50, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td><b>Alturas</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> menos de 1.40</td>
				<td>'.$talla1.'</td>
			</tr>
			<tr>
				<td align="left"> de 1.41 a 1.50</td>
				<td>'.$talla2.'</td>
			</tr>
			<tr>
				<td align="left"> de 1.51 a 1.60</td>
				<td>'.$talla3.'</td>
			</tr>
			<tr>
				<td align="left"> de 1.61 a 1.70</td>
				<td>'.$talla4.'</td>
			</tr>
			<tr>
				<td align="left"> de 1.71 a 1.80</td>
				<td>'.$talla5.'</td>
			</tr>
			<tr>
				<td align="left"> de 1.81 a 1.90</td>
				<td>'.$talla6.'</td>
			</tr>
			<tr>
				<td align="left"> más de 1.90</td>
				<td>'.$talla7.'</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(70,0,205,100,$html, '', 0, 0, true, 'C', true);
				
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
		
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(70,0,205,150,$html, '', 0, 0, true, 'C', true);
		
		$pdf->Output('estadisticaalturamujeres.pdf', 'I');
	}
	
	public function imchombresAction($empresa, $inicio, $fin)
	{
		$pdf = new \Tcpdf_Tcpdf('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$em = $this->getDoctrine()->getEntityManager();
		$pesos = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaImcHombres($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR IMC EN HOMBRES');
		$pdf->SetSubject('Estadística por imc en pacientes hombres.');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(20, 38, 20);
		$pdf->SetHeaderMargin(2);
		$pdf->SetFooterMargin(15);
		$pdf->SetAutoPageBreak(FALSE, 21);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setTabl(true);
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR IMC EN HOMBRES");
		$pdf->AddPage();
		
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$rango1 = $pesos['Delgadez'];
		$rango2 = $pesos['Peso Normal'];
		$rango3 = $pesos['Sobrepeso'];
		$rango4 = $pesos['Obesidad'];
		
		arsort($pesos);
		$max = max($pesos);
		$max = intval(($max + 10) /10.0) * 10;
		
		$postrango1 = ((150 * $rango1)/$max);
		$postrango2 = ((150 * $rango2)/$max);
		$postrango3 = ((150 * $rango3)/$max);
		$postrango4 = ((150 * $rango4)/$max);

		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 200, 193, $style1); // Eje X
		
		
		$pdf->Rect(55, 193-$postrango1, 10, $postrango1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo talla1
		$pdf->Rect(75, 193-$postrango2, 10, $postrango2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo talla2
		$pdf->Rect(95, 193-$postrango3, 10, $postrango3, 'DF', $border_style, $fill_color = array(0,2,43,4)); // Rectángulo talla3
		$pdf->Rect(115, 193-$postrango4, 10, $postrango4, 'DF', $border_style, $fill_color = array(52,0,42,2)); // Rectángulo talla4
		
		
		/*$html = '';
		foreach ($entity as $key => $val)
		{
			$html .= $key.':'.$val.'<br>';
		}*/
		
		$pdf->Output('estadisticaimchombres.pdf', 'I');
	}
	
	public function imcmujeresAction($empresa, $inicio, $fin)
	{
		$pdf = new \Tcpdf_Tcpdf('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$em = $this->getDoctrine()->getEntityManager();
		$pesos = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaImcMujeres($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR IMC EN HOMBRES');
		$pdf->SetSubject('Estadística por imc en pacientes hombres.');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(20, 38, 20);
		$pdf->SetHeaderMargin(2);
		$pdf->SetFooterMargin(15);
		$pdf->SetAutoPageBreak(FALSE, 21);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setTabl(true);
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR IMC EN HOMBRES");
		$pdf->AddPage();
		
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$rango1 = $pesos['Delgadez'];
		$rango2 = $pesos['Peso Normal'];
		$rango3 = $pesos['Sobrepeso'];
		$rango4 = $pesos['Obesidad'];
		
		arsort($pesos);
		$max = max($pesos);
		$max = intval(($max + 10) /10.0) * 10;
		
		$postrango1 = ((150 * $rango1)/$max);
		$postrango2 = ((150 * $rango2)/$max);
		$postrango3 = ((150 * $rango3)/$max);
		$postrango4 = ((150 * $rango4)/$max);

		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 200, 193, $style1); // Eje X
		
		
		$pdf->Rect(55, 193-$postrango1, 10, $postrango1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo talla1
		$pdf->Rect(75, 193-$postrango2, 10, $postrango2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo talla2
		$pdf->Rect(95, 193-$postrango3, 10, $postrango3, 'DF', $border_style, $fill_color = array(0,2,43,4)); // Rectángulo talla3
		$pdf->Rect(115, 193-$postrango4, 10, $postrango4, 'DF', $border_style, $fill_color = array(52,0,42,2)); // Rectángulo talla4
		
		
		/*$html = '';
		foreach ($entity as $key => $val)
		{
			$html .= $key.':'.$val.'<br>';
		}*/
		
		$pdf->Output('estadisticaimcmujeres.pdf', 'I');
	}
	
	public function fumadoresAction()
	{
		
	}
}
