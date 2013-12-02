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
		$pdf->Line(43, 193, 170, 193, $style1); // Eje X
		
		
		$pdf->Rect(55, 193-$postrango1, 10, $postrango1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo rango1
		$pdf->Rect(75, 193-$postrango2, 10, $postrango2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo rango2
		$pdf->Rect(95, 193-$postrango3, 10, $postrango3, 'DF', $border_style, $fill_color = array(0,2,43,4)); // Rectángulo rango3
		$pdf->Rect(115, 193-$postrango4, 10, $postrango4, 'DF', $border_style, $fill_color = array(52,0,42,2)); // Rectángulo rango4
		
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
		
		$html = '
		<table>
			<tr>
				<td align="left">Delgadez</td>
			</tr>
			<tr>
				<td align="left">Peso normal</td>
			</tr>
			<tr>
				<td align="left">Sobrepeso</td>
			</tr>
			<tr>
				<td align="left">Obesidad</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(55, 0, 209, 50, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td><b>Clasificación</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> Delgadez</td>
				<td>'.$rango1.'</td>
			</tr>
			<tr>
				<td align="left"> Peso normal</td>
				<td>'.$rango2.'</td>
			</tr>
			<tr>
				<td align="left"> Sobrepeso</td>
				<td>'.$rango3.'</td>
			</tr>
			<tr>
				<td align="left"> Obesidad</td>
				<td>'.$rango4.'</td>
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
		$pdf->writeHTMLCell(70,0,205,130,$html, '', 0, 0, true, 'C', true);
		
		$pdf->Output('estadisticaimchombres.pdf', 'I');
	}
	
	public function imcmujeresAction($empresa, $inicio, $fin)
	{
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
		$pdf->Line(43, 193, 170, 193, $style1); // Eje X
		
		
		$pdf->Rect(55, 193-$postrango1, 10, $postrango1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo rango1
		$pdf->Rect(75, 193-$postrango2, 10, $postrango2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo rango2
		$pdf->Rect(95, 193-$postrango3, 10, $postrango3, 'DF', $border_style, $fill_color = array(0,2,43,4)); // Rectángulo rango3
		$pdf->Rect(115, 193-$postrango4, 10, $postrango4, 'DF', $border_style, $fill_color = array(52,0,42,2)); // Rectángulo rango4
		
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
		
		$html = '
		<table>
			<tr>
				<td align="left">Delgadez</td>
			</tr>
			<tr>
				<td align="left">Peso normal</td>
			</tr>
			<tr>
				<td align="left">Sobrepeso</td>
			</tr>
			<tr>
				<td align="left">Obesidad</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(55, 0, 209, 50, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td><b>Clasificación</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> Delgadez</td>
				<td>'.$rango1.'</td>
			</tr>
			<tr>
				<td align="left"> Peso normal</td>
				<td>'.$rango2.'</td>
			</tr>
			<tr>
				<td align="left"> Sobrepeso</td>
				<td>'.$rango3.'</td>
			</tr>
			<tr>
				<td align="left"> Obesidad</td>
				<td>'.$rango4.'</td>
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
		$pdf->writeHTMLCell(70,0,205,130,$html, '', 0, 0, true, 'C', true);
		
		$pdf->Output('estadisticaimchombres.pdf', 'I');
		
		$pdf->Output('estadisticaimcmujeres.pdf', 'I');
	}
	
	public function fumadoresAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$fumadores = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaFumadores($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR FUMADORES');
		$pdf->SetSubject('Estadística por fumadores.');
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
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR FUMADORES");
		$pdf->AddPage();
		
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$rango1 = $fumadores['No fumador'];
		$rango2 = $fumadores['Ex fumador'];
		$rango3 = $fumadores['Fumador esporádico'];
		$rango4 = $fumadores['de 0 a 5 cigarrillos'];
		$rango5 = $fumadores['de 6 a 10 cigarrillos'];
		$rango6 = $fumadores['de 11 a 20 cigarrillos'];
		$rango7 = $fumadores['de 21 a 40 cigarrillos'];
		$rango8 = $fumadores['Más de 40 cigarrillos'];
		$rango9 = $fumadores['Otros(Pipa, Otros ...)'];
		
		arsort($fumadores);
		$max = max($fumadores);
		$max = intval(($max + 10) /10.0) * 10;
		
		$postrango1 = ((150 * $rango1)/$max);
		$postrango2 = ((150 * $rango2)/$max);
		$postrango3 = ((150 * $rango3)/$max);
		$postrango4 = ((150 * $rango4)/$max);
		$postrango5 = ((150 * $rango5)/$max);
		$postrango6 = ((150 * $rango6)/$max);
		$postrango7 = ((150 * $rango7)/$max);
		$postrango8 = ((150 * $rango8)/$max);
		$postrango9 = ((150 * $rango9)/$max);

		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 175, 193, $style1); // Eje X
		
		$pdf->Rect(55, 193-$postrango1, 7, $postrango1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo rango1
		$pdf->Rect(65, 193-$postrango2, 7, $postrango2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo rango2
		$pdf->Rect(75, 193-$postrango3, 7, $postrango3, 'DF', $border_style, $fill_color = array(0,2,43,4)); // Rectángulo rango3
		$pdf->Rect(85, 193-$postrango4, 7, $postrango4, 'DF', $border_style, $fill_color = array(52,0,42,2)); // Rectángulo rango4
		$pdf->Rect(95, 193-$postrango5, 7, $postrango5, 'DF', $border_style, $fill_color = array(0,100,100,50)); // Rectángulo rango5
		$pdf->Rect(105, 193-$postrango6, 7, $postrango6, 'DF', $border_style, $fill_color = array(0,60,15,1)); // Rectángulo rango6
		$pdf->Rect(115, 193-$postrango7, 7, $postrango7, 'DF', $border_style, $fill_color = array(94,40,0,18)); // Rectángulo rango7
		$pdf->Rect(125, 193-$postrango8, 7, $postrango8, 'DF', $border_style, $fill_color = array(30,19,0,7)); // Rectángulo rango8
		$pdf->Rect(135, 193-$postrango9, 7, $postrango9, 'DF', $border_style, $fill_color = array(67,51,0,75)); // Rectángulo rango9
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(186, 51, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,57,54,20);
		$pdf->SetFillColor(0,57,54,20);
		$pdf->Rect(186, 55.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,2,43,4);
		$pdf->SetFillColor(0,2,43,4);
		$pdf->Rect(186, 60, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(52,0,42,2);
		$pdf->SetFillColor(52,0,42,2);
		$pdf->Rect(186, 64.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,100,100,50);
		$pdf->SetFillColor(0,100,100,50);
		$pdf->Rect(186, 69, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,60,15,1);
		$pdf->SetFillColor(0,60,15,1);
		$pdf->Rect(186, 73.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(94,40,0,18);
		$pdf->SetFillColor(94,40,0,18);
		$pdf->Rect(186, 78, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(30,19,0,7);
		$pdf->SetFillColor(30,19,0,7);
		$pdf->Rect(186, 82.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(67,51,0,75);
		$pdf->SetFillColor(67,51,0,75);
		$pdf->Rect(186, 87, 2, 2, 'DF', $border_style);
		
		$html = '
		<table>
			<tr>
				<td align="left">No fumador</td>
			</tr>
			<tr>
				<td align="left">Ex fumador</td>
			</tr>
			<tr>
				<td align="left">Fumador esporádico</td>
			</tr>
			<tr>
				<td align="left">de 0 a 5 cigarrillos</td>
			</tr>
			<tr>
				<td align="left">de 6 a 10 cigarrillos</td>
			</tr>
			<tr>
				<td align="left">de 11 a 20 cigarrillos</td>
			</tr>
			<tr>
				<td align="left">de 21 a 40 cigarrillos</td>
			</tr>
			<tr>
				<td align="left">Más de 40 cigarrillos</td>
			</tr>
			<tr>
				<td align="left">Otros(Pipa, Otros ...)</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(55, 0, 190, 50, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td><b>Alturas</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> No fumador</td>
				<td>'.$rango1.'</td>
			</tr>
			<tr>
				<td align="left"> Ex fumador</td>
				<td>'.$rango2.'</td>
			</tr>
			<tr>
				<td align="left"> Fumador esporádico</td>
				<td>'.$rango3.'</td>
			</tr>
			<tr>
				<td align="left"> de 0 a 5 cigarrillos</td>
				<td>'.$rango4.'</td>
			</tr>
			<tr>
				<td align="left"> de 6 a 10 cigarrillos</td>
				<td>'.$rango5.'</td>
			</tr>
			<tr>
				<td align="left"> de 11 a 20 cigarrillos</td>
				<td>'.$rango6.'</td>
			</tr>
			<tr>
				<td align="left"> de 21 a 40 cigarrillos</td>
				<td>'.$rango7.'</td>
			</tr>
			<tr>
				<td align="left"> Más de 40 cigarrillos</td>
				<td>'.$rango8.'</td>
			</tr>
			<tr>
				<td align="left"> Otros(Pipa, Otros ...)</td>
				<td>'.$rango9.'</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(90,0,185,100,$html, '', 0, 0, true, 'C', true);
				
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
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);

		
		$pdf->Output('estadisticafumadores.pdf', 'I');
	}
	
	public function presionAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$presionarte = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPresion($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR PRESION ARTERIAL');
		$pdf->SetSubject('Estadística por presion arterial.');
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
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR PRESION ARTERIAL");
		$pdf->AddPage();
		
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$presion1 = $presionarte['Óptima'];
		$presion2 = $presionarte['Normal'];
		$presion3 = $presionarte['Normal alta'];
		$presion4 = $presionarte['Hipertensión grado 1'];
		$presion5 = $presionarte['Hipertensión grado 2'];
		$presion6 = $presionarte['Hipertensión grado 3'];
		$presion7 = $presionarte['Hipertensión no identificada'];
		
		arsort($presionarte);
		$max = max($presionarte);
		$max = intval(($max + 10) /10.0) * 10;
		
		$postpresion1 = ((150 * $presion1)/$max);
		$postpresion2 = ((150 * $presion2)/$max);
		$postpresion3 = ((150 * $presion3)/$max);
		$postpresion4 = ((150 * $presion4)/$max);
		$postpresion5 = ((150 * $presion5)/$max);
		$postpresion6 = ((150 * $presion6)/$max);
		$postpresion7 = ((150 * $presion7)/$max);


		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 160, 193, $style1); // Eje X
		
		$pdf->Rect(55, 193-$postpresion1, 7, $postpresion1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo presion1
		$pdf->Rect(65, 193-$postpresion2, 7, $postpresion2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo presion2
		$pdf->Rect(75, 193-$postpresion3, 7, $postpresion3, 'DF', $border_style, $fill_color = array(0,2,43,4)); // Rectángulo presion3
		$pdf->Rect(85, 193-$postpresion4, 7, $postpresion4, 'DF', $border_style, $fill_color = array(52,0,42,2)); // Rectángulo presion4
		$pdf->Rect(95, 193-$postpresion5, 7, $postpresion5, 'DF', $border_style, $fill_color = array(0,100,100,50)); // Rectángulo presion5
		$pdf->Rect(105, 193-$postpresion6, 7, $postpresion6, 'DF', $border_style, $fill_color = array(0,60,15,1)); // Rectángulo presion6
		$pdf->Rect(115, 193-$postpresion7, 7, $postpresion7, 'DF', $border_style, $fill_color = array(94,40,0,18)); // Rectángulo presion7
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(186, 51, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,57,54,20);
		$pdf->SetFillColor(0,57,54,20);
		$pdf->Rect(186, 55.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,2,43,4);
		$pdf->SetFillColor(0,2,43,4);
		$pdf->Rect(186, 60, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(52,0,42,2);
		$pdf->SetFillColor(52,0,42,2);
		$pdf->Rect(186, 64.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,100,100,50);
		$pdf->SetFillColor(0,100,100,50);
		$pdf->Rect(186, 69, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(0,60,15,1);
		$pdf->SetFillColor(0,60,15,1);
		$pdf->Rect(186, 73.5, 2, 2, 'DF', $border_style);

		$pdf->SetDrawColor(94,40,0,18);
		$pdf->SetFillColor(94,40,0,18);
		$pdf->Rect(186, 78, 2, 2, 'DF', $border_style);
		
		$html = '
		<table>
			<tr>
				<td align="left">Óptima</td>
			</tr>
			<tr>
				<td align="left">Normal</td>
			</tr>
			<tr>
				<td align="left">Normal alta</td>
			</tr>
			<tr>
				<td align="left">Hipertensión grado 1</td>
			</tr>
			<tr>
				<td align="left">Hipertensión grado 2</td>
			</tr>
			<tr>
				<td align="left">Hipertensión grado 3</td>
			</tr>
			<tr>
				<td align="left">Hipertensión no identificada</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(55, 0, 190, 50, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td width="200"><b>Tipo</b></td>
				<td width="110"><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> Óptima</td>
				<td>'.$presion1.'</td>
			</tr>
			<tr>
				<td align="left"> Normal</td>
				<td>'.$presion2.'</td>
			</tr>
			<tr>
				<td align="left"> Normal alta</td>
				<td>'.$presion3.'</td>
			</tr>
			<tr>
				<td align="left"> Hipertensión grado 1</td>
				<td>'.$presion4.'</td>
			</tr>
			<tr>
				<td align="left"> Hipertensión grado 2</td>
				<td>'.$presion5.'</td>
			</tr>
			<tr>
				<td align="left"> Hipertensión grado 3</td>
				<td>'.$presion6.'</td>
			</tr>
			<tr>
				<td align="left"> Hipertensión no identificada</td>
				<td>'.$presion7.'</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(90,0,185,100,$html, '', 0, 0, true, 'C', true);
				
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
		$pdf->writeHTMLCell(90,0,185,145,$html, '', 0, 0, true, 'C', true);

		
		
		/*$html = '';
		
		foreach($presionarte as $key => $caso)
			$html .=$key.':'.$caso.'<br>';
			
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);*/

		
		$pdf->Output('estadisticapresionarterial.pdf', 'I');
	}
	
	public function espirometriaAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$espi = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPacientes($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR ESPIROMETRÍA');
		$pdf->SetSubject('Estadística por espirometria.');
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
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR ESPIROMETRÍA");
		$pdf->AddPage();
		
		$espiarreglo = array();
		$flag = -1;
		
		foreach ($espi as $caso)
		{
			if($caso->getMdpaci()->getId() != $flag)
			{
				$flag = $caso->getMdpaci()->getId();
				$espiarreglo[$flag] = array();
			}
			
			$diag = $em->getRepository('ScontrolBundle:Mddiag')->findByMdhist($caso->getId());
			
			foreach ($diag as $caso2)
				$espiarreglo[$flag][] = $caso2->getMdpato()->getCodigo();
		}
		
		$clases = array('Normal' => 0, 'Con patologías' => 0, 'No realizada' => 0);
		
		foreach ($espiarreglo as $caso)
		{
			if (in_array('1600', $caso))
				$clases['Normal'] += 1;
			else if($this->rangoInArray(1601, 1631, $caso))
				$clases['Con patologías'] += 1;
			else
				$clases['No realizada'] += 1;
		}
		
		/*$html = '';
		
		foreach($clases as $k => $v)
			$html .= $k.': '.$v.'<br>';
		
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);*/
			
			
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$espi1 = $clases['Normal'];
		$espi2 = $clases['Con patologías'];
		$espi3 = $clases['No realizada'];
		
		arsort($clases);
		$max = max($clases);
		$max = intval(($max + 10) /10.0) * 10;
		
		$postespi1 = ((150 * $espi1)/$max);
		$postespi2 = ((150 * $espi2)/$max);
		$postespi3 = ((150 * $espi3)/$max);


		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 160, 193, $style1); // Eje X
		
		$pdf->Rect(55, 193-$postespi1, 25, $postespi1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo espi1
		$pdf->Rect(85, 193-$postespi2, 25, $postespi2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo espi2
		$pdf->Rect(115, 193-$postespi3, 25, $postespi3, 'DF', $border_style, $fill_color = array(0,3,91,22)); // Rectángulo espi3
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(186, 71, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,57,54,20);
		$pdf->SetFillColor(0,57,54,20);
		$pdf->Rect(186, 75.5, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,3,91,22);
		$pdf->SetFillColor(0,3,91,22);
		$pdf->Rect(186, 79.5, 2, 2, 'DF', $border_style);

		
		$html = '
		<table>
			<tr>
				<td align="left">Normal</td>
			</tr>
			<tr>
				<td align="left">Con patología</td>
			</tr>
			<tr>
				<td align="left">No realizada</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(55, 0, 190, 70, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td><b>Tipo</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> Normal</td>
				<td>'.$espi1.'</td>
			</tr>
			<tr>
				<td align="left"> Con patología</td>
				<td>'.$espi2.'</td>
			</tr>
			<tr>
				<td align="left"> No realizada</td>
				<td>'.$espi3.'</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(90,0,185,100,$html, '', 0, 0, true, 'C', true);
				
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
		$pdf->writeHTMLCell(90,0,185,130,$html, '', 0, 0, true, 'C', true);
		
		/*$html = '';
		
		foreach($vision as $key => $caso)
			$html .=$key.':'.$caso.'<br>';
			
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);*/
		
		$pdf->Output('estadisticaespirometria.pdf', 'I');
	}

	
	public function visionAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$vision = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPacientes($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR CONTROL DE VISIÓN');
		$pdf->SetSubject('Estadística por control de visión.');
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
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR CONTROL DE VISIÓN");
		$pdf->AddPage();
		
		$visionarreglo = array();
		$flag = -1;
		
		foreach ($vision as $caso)
		{
			if($caso->getMdpaci()->getId() != $flag)
			{
				$flag = $caso->getMdpaci()->getId();
				$visionarreglo[$flag] = array();
			}
			
			$diag = $em->getRepository('ScontrolBundle:Mddiag')->findByMdhist($caso->getId());
			
			foreach ($diag as $caso2)
				$visionarreglo[$flag][] = $caso2->getMdpato()->getCodigo();
		}
		
		$clases = array('Con patologías' => 0, 'Normal' => 0, 'No realizada' => 0);
		
		foreach ($visionarreglo as $caso)
		{
			if (in_array('1400', $caso))
				$clases['Normal'] += 1;
			else if($this->rangoInArray(1413, 1487, $caso))
				$clases['Con patologías'] += 1;
			else
				$clases['No realizada'] += 1;
		}
		
		/*$html = '';
		
		foreach($clases as $k => $v)
			$html .= $k.': '.$v.'<br>';
		
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);*/
			
			
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$vision1 = $clases['Normal'];
		$vision2 = $clases['Con patologías'];
		$vision3 = $clases['No realizada'];
		
		arsort($clases);
		$max = max($clases);
		$max = intval(($max + 10) /10.0) * 10;
		
		$postvision1 = ((150 * $vision1)/$max);
		$postvision2 = ((150 * $vision2)/$max);
		$postvision3 = ((150 * $vision3)/$max);


		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 160, 193, $style1); // Eje X
		
		$pdf->Rect(55, 193-$postvision1, 25, $postvision1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo vision1
		$pdf->Rect(85, 193-$postvision2, 25, $postvision2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo vision2
		$pdf->Rect(115, 193-$postvision3, 25, $postvision3, 'DF', $border_style, $fill_color = array(0,3,91,22)); // Rectángulo vision3
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(186, 71, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,57,54,20);
		$pdf->SetFillColor(0,57,54,20);
		$pdf->Rect(186, 75.5, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,3,91,22);
		$pdf->SetFillColor(0,3,91,22);
		$pdf->Rect(186, 79.5, 2, 2, 'DF', $border_style);

		
		$html = '
		<table>
			<tr>
				<td align="left">Normal</td>
			</tr>
			<tr>
				<td align="left">Con patología</td>
			</tr>
			<tr>
				<td align="left">No realizada</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(55, 0, 190, 70, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td><b>Tipo</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> Normal</td>
				<td>'.$vision1.'</td>
			</tr>
			<tr>
				<td align="left"> Con patología</td>
				<td>'.$vision2.'</td>
			</tr>
			<tr>
				<td align="left"> No realizada</td>
				<td>'.$vision3.'</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(90,0,185,100,$html, '', 0, 0, true, 'C', true);
				
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
		$pdf->writeHTMLCell(90,0,185,130,$html, '', 0, 0, true, 'C', true);
		
		/*$html = '';
		
		foreach($vision as $key => $caso)
			$html .=$key.':'.$caso.'<br>';
			
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);*/
		
		$pdf->Output('estadisticacontrolvision.pdf', 'I');
	}

	public function audioAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$audiometria = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPacientes($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR AUDIOMETRÍA');
		$pdf->SetSubject('Estadística por audiometría.');
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
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR AUDIOMETRÍA");
		$pdf->AddPage();
		
		$audiometriaarreglo = array();
		$flag = -1;
		
		foreach ($audiometria as $caso)
		{
			if($caso->getMdpaci()->getId() != $flag)
			{
				$flag = $caso->getMdpaci()->getId();
				$audiometriaarreglo[$flag] = array();
			}
			
			$diag = $em->getRepository('ScontrolBundle:Mddiag')->findByMdhist($caso->getId());
			
			foreach ($diag as $caso2)
				$audiometriaarreglo[$flag][] = $caso2->getMdpato()->getCodigo();
		}
		
		$clases = array('Normal' => 0, 'Posible trauma acústico' => 0, 'Posible presbiacusia' => 0, 'Hipoacusia global' => 0, 'No realizada' => 0);
		
		foreach ($audiometriaarreglo as $caso)
		{
			if (in_array('1500', $caso))
				$clases['Normal'] += 1;
			else if($this->rangoInArray(1561, 1563, $caso))
				$clases['Posible trauma acústico'] += 1;
			else if($this->rangoInArray(1571, 1573, $caso) OR $this->rangoInArray(1551, 1553, $caso))
				$clases['Posible presbiacusia'] += 1;
			else if($this->rangoInArray(1511, 1547, $caso))
				$clases['Hipoacusia global'] += 1;
			else
				$clases['No realizada'] += 1;
		}
		
		/*$html = '';
		
		foreach($clases as $k => $v)
			$html .= $k.': '.$v.'<br>';
		
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);*/
			
			
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$audio1 = $clases['Normal'];
		$audio2 = $clases['Posible trauma acústico'];
		$audio3 = $clases['Posible presbiacusia'];
		$audio4 = $clases['Hipoacusia global'];
		$audio5 = $clases['No realizada'];
		
		arsort($clases);
		$max = max($clases);
		$max = intval(($max + 10) /10.0) * 10;
		
		$postaudio1 = ((150 * $audio1)/$max);
		$postaudio2 = ((150 * $audio2)/$max);
		$postaudio3 = ((150 * $audio3)/$max);
		$postaudio4 = ((150 * $audio4)/$max);
		$postaudio5 = ((150 * $audio5)/$max);


		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 160, 193, $style1); // Eje X
		
		$pdf->Rect(55, 193-$postaudio1, 10, $postaudio1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo audio1
		$pdf->Rect(75, 193-$postaudio2, 10, $postaudio2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo audio2
		$pdf->Rect(95, 193-$postaudio3, 10, $postaudio3, 'DF', $border_style, $fill_color = array(0,2,43,4)); // Rectángulo audio3
		$pdf->Rect(115, 193-$postaudio4, 10, $postaudio4, 'DF', $border_style, $fill_color = array(52,0,42,2)); // Rectángulo audio4
		$pdf->Rect(135, 193-$postaudio5, 10, $postaudio5, 'DF', $border_style, $fill_color = array(0,3,91,22)); // Rectángulo audio5
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(186, 71, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,57,54,20);
		$pdf->SetFillColor(0,57,54,20);
		$pdf->Rect(186, 75.5, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,2,43,4);
		$pdf->SetFillColor(0,2,43,4);
		$pdf->Rect(186, 79.5, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(52,0,42,2);
		$pdf->SetFillColor(52,0,42,2);
		$pdf->Rect(186, 84, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,3,91,22);
		$pdf->SetFillColor(0,3,91,22);
		$pdf->Rect(186, 88.5, 2, 2, 'DF', $border_style);

		
		$html = '
		<table>
			<tr>
				<td align="left">Normal</td>
			</tr>
			<tr>
				<td align="left">Posible trauma acústico</td>
			</tr>
			<tr>
				<td align="left">Posible presbiacusia</td>
			</tr>
			<tr>
				<td align="left">Hipoacusia global</td>
			</tr>
			<tr>
				<td align="left">No realizada</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(55, 0, 190, 70, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td><b>Tipo</b></td>
				<td width="90" ><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> Normal</td>
				<td>'.$audio1.'</td>
			</tr>
			<tr>
				<td align="left"> Posible trauma acústico</td>
				<td>'.$audio2.'</td>
			</tr>
			<tr>
				<td align="left"> Posible presbiacusia</td>
				<td>'.$audio3.'</td>
			</tr>
			<tr>
				<td align="left"> Hipoacusia global</td>
				<td>'.$audio4.'</td>
			</tr>
			<tr>
				<td align="left"> No realizada</td>
				<td>'.$audio5.'</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(105,0,185,100,$html, '', 0, 0, true, 'C', true);
				
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
		$pdf->writeHTMLCell(80,0,185,140,$html, '', 0, 0, true, 'C', true);
		
		/*$html = '';
		
		foreach($vision as $key => $caso)
			$html .=$key.':'.$caso.'<br>';
			
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);*/
		
		$pdf->Output('estadisticaaudiometría.pdf', 'I');
	}

	public function aparatoAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$pacientes = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPacientes($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR APARATO LOCOMOTOR');
		$pdf->SetSubject('Estadística por aparato locomotor.');
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
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR APARATO LOCOMOTOR");
		$pdf->AddPage();
		
		$aparatoarreglo = array();
		$flag = -1;
		
		foreach ($pacientes as $caso)
		{
			if($caso->getMdpaci()->getId() != $flag)
			{
				$flag = $caso->getMdpaci()->getId();
				$aparatoarreglo[$flag] = array();
			}
			
			$diag = $em->getRepository('ScontrolBundle:Mddiag')->findByMdhist($caso->getId());
			
			foreach ($diag as $caso2)
				$aparatoarreglo[$flag][] = $caso2->getMdpato()->getCodigo();
		}
		
		$clases = array('Normal' => 0, 'Alteraciones' => 0, 'Sin exploración' => 0);
		
		foreach ($aparatoarreglo as $caso)
		{
			if (in_array('1000', $caso))
				$clases['Normal'] += 1;
			else if($this->rangoInArray(1719, 1723, $caso))
				$clases['Alteraciones'] += 1;
			else if (in_array('1780', $caso))
				$clases['Sin exploración'] += 1;
		}
		
		/*$html = '';
		
		foreach($clases as $k => $v)
			$html .= $k.': '.$v.'<br>';
		
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);*/
			
			
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$aparato1 = $clases['Normal'];
		$aparato2 = $clases['Alteraciones'];
		$aparato3 = $clases['Sin exploración'];
		
		arsort($clases);
		$max = max($clases);
		$max = intval(($max + 10) /10.0) * 10;
		
		$postaparato1 = ((150 * $aparato1)/$max);
		$postaparato2 = ((150 * $aparato2)/$max);
		$postaparato3 = ((150 * $aparato3)/$max);


		$par = $max / 20;
		
		for($i = 1; $i <= 20; $i++)
		{
			$pos = 193-(150*($par*$i))/$max;
			$pdf->writeHTMLCell(20, 20, 20, $pos-2,'<div style="color: #000; text-align: rigth;"><b>'.$par*$i.'</b></div>');
			$pdf->Line(40, $pos, 46, $pos, $style1);
		}
		
		$pdf->Line(43, 38, 43, 193, $style1); // Eje Y
		$pdf->Line(43, 193, 160, 193, $style1); // Eje X
		
		$pdf->Rect(55, 193-$postaparato1, 25, $postaparato1, 'DF', $border_style, $fill_color = array(100,0,0,0)); // Rectángulo aparato1
		$pdf->Rect(85, 193-$postaparato2, 25, $postaparato2, 'DF', $border_style, $fill_color = array(0,57,54,20)); // Rectángulo aparato2
		$pdf->Rect(115, 193-$postaparato3, 25, $postaparato3, 'DF', $border_style, $fill_color = array(0,3,91,22)); // Rectángulo aparato3
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(186, 71, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,57,54,20);
		$pdf->SetFillColor(0,57,54,20);
		$pdf->Rect(186, 75.5, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,3,91,22);
		$pdf->SetFillColor(0,3,91,22);
		$pdf->Rect(186, 79.5, 2, 2, 'DF', $border_style);

		
		$html = '
		<table>
			<tr>
				<td align="left">Normal</td>
			</tr>
			<tr>
				<td align="left">Alteraciones</td>
			</tr>
			<tr>
				<td align="left">Sin exploración</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->writeHTMLCell(55, 0, 190, 70, $html, '', 0, 0, true, 'C', true);
		
		$html= '
		<table border="1">
			<tr>
				<td><b>Tipo</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td align="left"> Normal</td>
				<td>'.$aparato1.'</td>
			</tr>
			<tr>
				<td align="left"> Alteraciones</td>
				<td>'.$aparato2.'</td>
			</tr>
			<tr>
				<td align="left"> Sin exploración</td>
				<td>'.$aparato3.'</td>
			</tr>
		</table>';
		$pdf->SetFont('dejavusans', '', 11);
		$pdf->writeHTMLCell(90,0,185,100,$html, '', 0, 0, true, 'C', true);
				
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
		$pdf->writeHTMLCell(90,0,185,130,$html, '', 0, 0, true, 'C', true);
		
		/*$html = '';
		
		foreach($vision as $key => $caso)
			$html .=$key.':'.$caso.'<br>';
			
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);*/
		
		$pdf->Output('estadisticaaparatolocomotor.pdf', 'I');
	}
	
	public function memoriaAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$datosempresa = $em->getRepository('ScontrolBundle:Gbempr');
		$sucu = $em->getRepository('ScontrolBundle:Gbsucu')->find($empresa);
		$ciud = $sucu->getGbciud();
		$ries = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPacientes($empresa, $inicio, $fin);
		$casos = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaDictamen($empresa, $inicio, $fin);
		$imchombres = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaImcHombres($empresa, $inicio, $fin);
		$imcmujeres = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaImcMujeres($empresa, $inicio, $fin);
		$consulsexoedad = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaSexoEdad($empresa, $inicio, $fin);
		$fumadores = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaFumadores($empresa, $inicio, $fin);
		$presionarte = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPresion($empresa, $inicio, $fin);
		$espi = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPacientes($empresa, $inicio, $fin);
		$vision = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPacientes($empresa, $inicio, $fin);
		$audiometria = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPacientes($empresa, $inicio, $fin);
		$pacientes = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPacientes($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$meses = array('Enero','Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		
		$pdf = new \Tcpdf_Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('Memoria de Vigilancia de la Salud');
		$pdf->SetSubject('Memoria');
		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		//set margins
		$pdf->SetMargins(20, 35, 20);
		$pdf->SetHeaderMargin(2);
		$pdf->SetFooterMargin(15);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, 21);
		$pdf->setMkLateral(true);
		
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->AddPage();
		
		$html = 
		'
		<p style="font-size: 1.5em"><b>EMPRESA:</b> '.$datosempresa->find($empresa)->getNombre().'<br>
		<b>NIF:</b>'.$datosempresa->find($empresa)->getIdentificacion().'</p>
		<p>MEMORIA AÑO '.date('Y').'</p>
		<p>Periodo estudiado: '.$inicio.' '.$fin.'</p>
		<p>Fecha de realización: '.$meses[intval(date('m'))-1].' '.date('Y').'</p>
		<p><b>UNIDAD BASICA DE SALUD</b>
		<p>Dr. Ildefonso Tristán Burguesa <br>
		Especialista en Medicina del Trabajo</p>
        <p>Sra .Eva Real Real<br>
		Diplomada Universitaria en Enfermería de Empresa</p>
		';
		$pdf->SetFont('dejavusans', '', 12);
		$pdf -> writeHTMLCell(170, 0, 20, 45, $html, 0, 0, 0, true, 'J', true);
		$pdf->AddPage();
		$html = 
		'
		<table border="1">
		  <thead>
			<tr>
			  <th width="80%" style="font-size: 1.7em; border-top: none"><b>Sumario</b></th>
			  <th width="20%"></th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
				<td width="80%"></td>
				<td width="20%"></td>
			</tr>
			<tr>
			  <td>1. Marco Legal</td>
			  <td style="text-align: center">pag #</td>
			</tr>
			<tr>
			  <td>2. Presentación de la empresa</td>
			  <td style="text-align: center">pag #</td>
			</tr>
			<tr>
			  <td>3. Reconocimientos médicos laborales</td>
			  <td style="text-align: center">pag #</td>
			</tr>
			<tr>
			  <td>4. Resultados</td>
			  <td style="text-align: center">pag #</td>
			</tr>
			<tr>
			  <td>5. Principales conclusiones</td>
			  <td style="text-align: center">pag #</td>
			</tr>
			<tr>
			  <td>6. Formación</td>
			  <td style="text-align: center">pag #</td>
			</tr>
			<tr>
			  <td>7. Información y asesoramiento</td>
			  <td style="text-align: center">pag #</td>
			</tr>
			<tr>
			  <td>8. Estadística</td>
			  <td style="text-align: center">pag #</td>
			</tr>
		  </tbody>
		</table>
		';
		$pdf->SetFont('dejavusans', '', 12);
		$pdf -> writeHTMLCell(170, 0, 20, 45, $html, 0, 0, 0, true, 'J', true);
		$pdf->AddPage();
		$html = '
		<h3>1. Marco Legal</h3>

		<p>Según el Reglamento de los Servicios de Prevención, la elaboración de una Memoria anual, además de constituir una importante herramienta 
		técnica para la prevención de riesgos laborales, constituye una exigencia legal. Así, en el artículo 20 apartado 2 de dicha ley, se señala que:</p>
			
		<p>Las entidades especializadas que actúen como servicios de prevención.... deberán facilitar a las empresas para las que actúan como servicio 
		de prevención la memoria y la programación anual a las que se refiere el apartado 2 d) del artículo 39 de la Ley de Prevención de Riesgos Laborales, 
		afín de que pueda ser conocida por el comité de Seguridad y Salud en los términos previstos en el artículo citado.</p>

		<p>El artículo 39 de la Ley de Prevención de Riesgos Laborales, en su apartado 2 d) establece que:</p>

		<p>En el ejercicio de sus competencias, el Comité de Seguridad y Salud estará facultado para:
		d) Conocer e informar la memoria y programación anual de servicios de prevención.</p>

		<p>Este documento constituye la Memoria de actividades de Vigilancia de la Salud.</p>
		';
		$pdf->SetFont('dejavusans', '', 12);
		$pdf -> writeHTMLCell(170, 0, 20, 45, $html, 0, 0, 0, true, 'J', true);
		$pdf->AddPage();
		$html = '
		<h3>2. Presentación de la empresa</h3>

		<p><b>EMPRESA:</b> '.$datosempresa->find($empresa)->getNombre().', es una empresa cuyo domicilio social se encuentra ubicado  en '. $ciud->getNombre() .' .</p>
		
		<p><b>Domicilio Social:</b> '. $sucu->getDireccion() .' S/N C.P.: '. $ciud->getCodigo() .'</p>
		<p><b>Actividad principal:</b> '. $datosempresa->find($empresa)->getGbcnae() .'.</p>
		<p><b>Nº trabajadores:</b> Son un total de 192 trabajadores  en  5 centros de trabajo.</p>
		';
		$pdf->SetFont('dejavusans', '', 12);
		$pdf -> writeHTMLCell(170, 0, 20, 45, $html, 0, 0, 0, true, 'J', true);
		$pdf->AddPage();
		$html = '
		<!-- <h3>3. Reconocimientos Médicos Laborales</h3>

		<h4>Introducción:</h4>
		 
		<p>La obligatoriedad y necesidad de reconocimientos médicos laborales está recogida en diversas disposiciones legales.</p>

		<ul>
			<li>
			<strong>Ley de Prevención de Riesgos Laborales:</strong>
				<blockquote>
				<p>Artículo 14:</p>	
				<p style="text-align: justify">Los derechos de información, consulta y participación, formación en materia preventiva, paralización de la actividad en 
				caso de riesgo grave e inminente y vigilancia de su estado de salud, en los términos previstos en la presente Ley, forman parte 
				del derecho de los trabajadores a una protección eficaz en materia de seguridad y salud en el trabajo.</p>
				</blockquote>
			</li>
			<li>
			<strong>Vigilancia de la salud:</strong>
				<blockquote>
				<p>Artículo 22:</p>
				<p>El empresario garantizará a los trabajadores a su servicio la vigilancia periódica de su estado de salud en función de los 
				riesgos inherentes al trabajo.</p>
				</blockquote>
			</li>
			<li>
			<strong>Reglamento de los Servicios de Prevención:</strong>
				<blockquote>
				<p>Artículo 37.3:</p>	
				<p style="text-align: justify">Las funciones de vigilancia y control de la salud de los trabajadores serán desempeñadas por personal sanitario con competencia 
				técnica, formación y capacidad acreditada con arreglo a la normativa vigente y a lo establecido en los párrafos siguientes:</p>
				<ol type="a">
					<li> .../...</li>
					<li style="text-align: justify">En materia de vigilancia de la salud, la actividad sanitaria deberá abarcar, en las condiciones fijadas por el artículo 22 de la Ley 31/1995, de prevención de riesgos laborales:</li>
					<br>
						<ol>
							<li style="text-align: justify">Una evaluación de la salud de los trabajadores inicial, después de la incorporación al trabajo o después de la asignación de 
							tareas específicas con nuevos riesgos para la salud.</li>
							<br>
							<li style="text-align: justify">Una evaluación de la salud de los trabajadores que reanuden el trabajo tras una ausencia prolongada por motivos de salud, con 
							la finalidad de descubrir sus eventuales orígenes profesionales y recomendar una acción apropiada para proteger a los trabajadores.</li>
							<br>
							<li style="text-align: justify">Una vigilancia de la salud a intervalos periódicos.</li>
						</ol>
					<br>	
					<li style="text-align: justify">La vigilancia de la salud estará protegida  protocolos específicos u otros medios existentes con respecto a los factores de riesgo a los que esté expuesto el trabajador.</li>
				</ol>
			</blockquote>
			</li>
		</ul>

		Los reconocimientos médicos constituyen un conjunto de acciones orientadas a evaluar el estado de salud de un trabajador y resultan indispensables para cumplir el precepto legal de vigilancia de la salud por parte del empresario hacia sus trabajadores. El contenido de estos reconocimientos debe adaptarse a la prevención y detección de riesgos y patologías relacionadas con cada actividad laboral concreta.

		La información obtenida permite mejorar las condiciones de seguridad y salud de los trabajadores, reduce riesgos al proporcionar la información necesaria para cumplir el principio general de adaptar el trabajo a las personas y contribuye de manera significativa en la mejora de la productividad de la empresa. 
		
		<h4>4. Resultados</h4>
		
		<p><strong>4.1 Número total de reconocimientos efectuados: [155]</strong></p>
		
		<p>Riesgos laborales declarados</p>
		-->
		';
		$pdf->SetFont('dejavusans', '', 12);
		$pdf -> writeHTMLCell(170, 0, 20, 45,$html, 0, 0, 0, true, 'J', true);
		
		$boxes = array();
		$dboxes = array();
		
		$total = count($ries);
		
		foreach($ries as $caso)
		{
			$ptra = $caso->getMdpaci()->getGbptra();
			$procs = $em->getRepository('ScontrolBundle:Mdproc')->findByGbptra($ptra->getId());			
			
			foreach($procs as $uni)
			{
				$prot = $uni->getMdprot();
				
				if(isset($boxes[$prot->getCodigo()]))
					$boxes[$prot->getCodigo()] += 1;
				else
					$boxes[$prot->getCodigo()] = 1;
					
				if(!isset($dboxes[$prot->getCodigo()]))
					$dboxes[$prot->getCodigo()] = $prot->getNombre();
			}
			
		}			
				
		$row = '<table border="1">';
		$row .= '<tr style="background-color: #BFBFBF"; font-size: 2em><td>Código</td><td>Descripción</td><td>Cantidad de Casos</td><td>% Total Explorados</td></tr>';
		foreach($boxes as $key => $val)
		{
			$row .= '<tr>';
			$row .= '<td>'.$key.'</td>';
			$row .= '<td>'.$dboxes[$key].'</td>';
			$row .= '<td>'.$val.'</td>';
			$row .= '<td>'.round((($val/$total)*100),2)." %".'</td>';
			$row .= '</tr>';
			//$pdf->autoCell(0, 0, 20, $pdf->GetY(), $key." ".$dboxes[$key]." ".$val." ".round((($val/$total)*100),2)."%", 0, 2, false, true, 'C', true, 0);
		}
		$row .= '</table>';

		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $row, 0, 2, false, true, 'C', true, 10);
		
		$html = '<br/>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 10);
		
		$row = '<table border="1">';
		$row .= '<tr style="background-color: #BFBFBF"; font-size: 2em><td>Calificación</td><td>Número</td></tr>';			
		
		$apto = 0;
		$noapto = 0;
		$nocalificado = 0;
		$aptoconlimitaciones = 0;
		
		foreach($casos as $caso)
		{
			
			if($caso->getDictamen() == 0)
			{
				$nocalificado++;
			}elseif($caso->getDictamen() == 1){
				$apto++;
			}elseif($caso->getDictamen() == 2){
				$noapto++;
			}else{
				$aptoconlimitaciones++;
				
			}
		}
		$totalvalores = $apto + $noapto + $aptoconlimitaciones + $nocalificado;
		$row .= '<tr><td style="text-align: left; font-style: bold">Apto</td><td>'.$apto.'</td></tr>';
		$row .= '<tr><td style="text-align: left">No Apto</td><td>'.$noapto.'</td></tr>';
		$row .= '<tr><td style="text-align: left">Apto con limitaciones</td><td>'.$aptoconlimitaciones.'</td></tr>';
		$row .= '<tr><td style="text-align: left">No calificado</td><td>'.$nocalificado.'</td></tr>';
		$row .= '<tr><td>Total</td><td>'.$totalvalores.'</td></tr>';
		$row .= '</table>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $row, 0,2, false, true, 'C', true, 10);
		
		/*$html = '
		<p>Los casos no calificados se corresponden con reconocimientos incompletos, o denegación  
		del consentimiento para la realización del reconocimiento médico o la no asistencia por 
		parte del trabajador que no permiten asignar una calificación de aptitud para el trabajo.</p>
		';
		$pdf->writeHTMLCell(170, 0, 20, 45,$html, 0, 0, 0, true, 'J', true);*/

		$html = '<br/>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 10);
		$row = '<table border="1">';
		//foreach($consulsexoedad['0-16'] as $casosex)
		//{
			$row .= '<tr><td colspan="5">Resumen por edades y sexo</td></tr>';
			$row .= '<tr style="background-color: #BFBFBF"><td>Rangos</td><td>Hembras</td><td>%</td><td>Varones</td><td>%</td></tr>';
			$row .= '<tr><td>menos de 16 años</td><td>'.$valsem1 = $consulsexoedad[0]['0-16'].'</td><td>'.$porcen1 = round((($consulsexoedad[0]['0-16']/$total)*100),2).' %</td><td>'.$valseh1 = $consulsexoedad[1]['0-16'].'</td><td>'.$porcen8 = round((($consulsexoedad[1]['0-16']/$total)*100),2).' %</td></tr>';
			$row .= '<tr><td>de 17 a 20 años</td><td>'.$valsem2 = $consulsexoedad[0]['17-20'].'</td><td>'.$porcen2 = round((($consulsexoedad[0]['17-20']/$total)*100),2).' %</td><td>'.$valseh2 = $consulsexoedad[1]['17-20'].'</td><td>'.$porcen9 = round((($consulsexoedad[1]['17-20']/$total)*100),2).' %</td></tr>';
			$row .= '<tr><td>de 21 a 35 años</td><td>'.$valsem3 = $consulsexoedad[0]['21-35'].'</td><td>'.$porcen3 = round((($consulsexoedad[0]['21-35']/$total)*100),2).' %</td><td>'.$valseh3 = $consulsexoedad[1]['21-35'].'</td><td>'.$porcen10 = round((($consulsexoedad[1]['21-35']/$total)*100),2).' %</td></tr>';
			$row .= '<tr><td>de 36 a 45 años</td><td>'.$valsem4 = $consulsexoedad[0]['36-45'].'</td><td>'.$porcen4 = round((($consulsexoedad[0]['36-45']/$total)*100),2).' %</td><td>'.$valseh4 = $consulsexoedad[1]['36-45'].'</td><td>'.$porcen11 = round((($consulsexoedad[1]['36-45']/$total)*100),2).' %</td></tr>';
			$row .= '<tr><td>de 46 a 55 años</td><td>'.$valsem5 = $consulsexoedad[0]['46-55'].'</td><td>'.$porcen5 = round((($consulsexoedad[0]['46-55']/$total)*100),2).' %</td><td>'.$valseh5 = $consulsexoedad[1]['46-55'].'</td><td>'.$porcen12 = round((($consulsexoedad[1]['46-55']/$total)*100),2).' %</td></tr>';
			$row .= '<tr><td>de 56 a 65 años</td><td>'.$valsem6 = $consulsexoedad[0]['56-65'].'</td><td>'.$porcen6 = round((($consulsexoedad[0]['56-65']/$total)*100),2).' %</td><td>'.$valseh6 = $consulsexoedad[1]['56-65'].'</td><td>'.$porcen13 = round((($consulsexoedad[1]['56-65']/$total)*100),2).' %</td></tr>';
			$row .= '<tr><td>más de 65 años</td><td>'.$valsem7 = $consulsexoedad[0]['66-200'].'</td><td>'.$porcen7 = round((($consulsexoedad[0]['66-200']/$total)*100),2).' %</td><td>'.$valseh7 = $consulsexoedad[1]['66-200'].'</td><td>'.$porcen14 = round((($consulsexoedad[1]['66-200']/$total)*100),2).' %</td></tr>';
			$row .= '<tr style="background-color: #BFBFBF"><td>Total</td><td>'.$total1 = $valsem1 + $valsem2 + $valsem3 + $valsem4 + $valsem5 + $valsem6 + $valsem7 .'</td><td>'.$totalporc1 = $porcen1 + $porcen2 + $porcen3 + $porcen4 + $porcen5 + $porcen6 + $porcen7.' %</td><td>'.$total2 = $valseh1 + $valseh2 + $valseh3 + $valseh4 + $valseh5 + $valseh6 + $valseh7.'</td><td>'.$totalporc2 = $porcen8 + $porcen9 + $porcen10 + $porcen11 + $porcen12 + $porcen13 + $porcen14.' %</td></tr>';
		//}
		//$row .= '<tr style="bakground-color: #BFBFBF"><td>Rangos</td><td>Varones</td><td>%</td><td>Hembras</td><td>%</td></tr>';
		
		$row .= '</table>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $row, 0,2, false, true, 'C', true, 10);
		
		$html = '<br/>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 10);
		$row = '<table border="1">';
		$row .= '<tr><td colspan="5">Resumen masa corporal por sexos</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Peso</td><td>Hembras</td><td>%</td><td>Varones</td><td>%</td></tr>';
		$row .= '<tr><td>Delgadez</td><td>'.$valimcm1 = $imcmujeres['Delgadez'].'</td><td>'.$porcimcm1 = round((($imcmujeres['Delgadez']/$total)*100),2).' %</td><td>'.$valimch1 = $imchombres['Delgadez'].'</td><td>'.$porcimch1 = round((($imchombres['Delgadez']/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Peso Normal</td><td>'.$valimcm2 = $imcmujeres['Peso Normal'].'</td><td>'.$porcimcm2 = round((($imcmujeres['Peso Normal']/$total)*100),2).' %</td><td>'.$valimch2 = $imchombres['Peso Normal'].'</td><td>'.$porcimch2 = round((($imchombres['Peso Normal']/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Sobrepeso</td><td>'.$valimcm3 = $imcmujeres['Sobrepeso'].'</td><td>'.$porcimcm3 = round((($imcmujeres['Sobrepeso']/$total)*100),2).' %</td><td>'.$valimch3 = $imchombres['Sobrepeso'].'</td><td>'.$porcimch3 = round((($imchombres['Sobrepeso']/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Obesidad</td><td>'.$valimcm4 = $imcmujeres['Obesidad'].'</td><td>'.$porcimcm4 = round((($imcmujeres['Obesidad']/$total)*100),2).' %</td><td>'.$valimch4 = $imchombres['Obesidad'].'</td><td>'.$porcimch4 = round((($imchombres['Obesidad']/$total)*100),2).' %</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Total</td><td>'.$totalimcm = $valimcm1 + $valimcm2 + $valimcm3 + $valimcm4.'</td><td>'.$totalporcimcm = $porcimcm1 + $porcimcm2 + $porcimcm3 + $porcimcm4.' %</td><td>'.$totalimch = $valimch1 + $valimch2 + $valimch3 + $valimch4.'</td><td>'.$totalporcimch = $porcimch1 + $porcimch2 + $porcimch3 + $porcimch4.' %</td></tr>';
		$row .= '</table>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $row, 0,2, false, true, 'C', true, 10);
		
		$rango1 = $fumadores['No fumador'];
		$rango2 = $fumadores['Ex fumador'];
		$rango3 = $fumadores['Fumador esporádico'];
		$rango4 = $fumadores['de 0 a 5 cigarrillos'];
		$rango5 = $fumadores['de 6 a 10 cigarrillos'];
		$rango6 = $fumadores['de 11 a 20 cigarrillos'];
		$rango7 = $fumadores['de 21 a 40 cigarrillos'];
		$rango8 = $fumadores['Más de 40 cigarrillos'];
		$rango9 = $fumadores['Otros(Pipa, Otros ...)'];
		
		$html = '<br/>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 10);
		$row = '<table border="1">';
		$row .= '<tr><td colspan="3">Tabaquismo</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Consumo</td><td>Personas</td><td>%</td></tr>';
		$row .= '<tr><td>No fumador</td><td>'.$rango1.'</td><td>'.$porfum1 = round((($rango1/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Ex fumador</td><td>'.$rango2.'</td><td>'.$porfum2 = round((($rango2/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Fumador esporádico</td><td>'.$rango3.'</td><td>'.$porfum3 = round((($rango3/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>de 0 a 5 cigarillos</td><td>'.$rango4.'</td><td>'.$porfum4 = round((($rango4/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>de 6 a 10 cigarillos</td><td>'.$rango5.'</td><td>'.$porfum5 = round((($rango5/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>de 11 a 20 cigarillos</td><td>'.$rango6.'</td><td>'.$porfum6 = round((($rango6/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>de 21 a 40 cigarillos</td><td>'.$rango7.'</td><td>'.$porfum7 = round((($rango7/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Más de 40 cigarillos</td><td>'.$rango8.'</td><td>'.$porfum8 = round((($rango8/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Otros(Pipa, Otros ...)</td><td>'.$rango9.'</td><td>'.$porfum9 = round((($rango9/$total)*100),2).' %</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Total</td><td>'.$totalfum = $rango1 + $rango2 + $rango3 + $rango4 + $rango5 + $rango6 + $rango7 + $rango8 + $rango9.'</td><td>'.$totalporcfum = $porfum1 + $porfum2 + $porfum3 + $porfum4 + $porfum5 + $porfum6 + $porfum7 + $porfum8 + $porfum9.' %</td></tr>';
		$row .= '</table>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $row, 0,2, false, true, 'C', true, 10);
		
		$presion1 = $presionarte['Óptima'];
		$presion2 = $presionarte['Normal'];
		$presion3 = $presionarte['Normal alta'];
		$presion4 = $presionarte['Hipertensión grado 1'];
		$presion5 = $presionarte['Hipertensión grado 2'];
		$presion6 = $presionarte['Hipertensión grado 3'];
		$presion7 = $presionarte['Hipertensión no identificada'];
		
		$html = '<br/>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 10);
		$row = '<table border="1">';
		$row .= '<tr><td colspan="3">Presión Arterial</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Tipo</td><td>Personas</td><td>%</td></tr>';
		$row .= '<tr><td>Óptima</td><td>'.$presion1.'</td><td>'.$porpre1 = round((($presion1/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Normal</td><td>'.$presion2.'</td><td>'.$porpre2 = round((($presion2/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Normal alta</td><td>'.$presion3.'</td><td>'.$porpre3 = round((($presion3/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Hipertensión grado 1</td><td>'.$presion4.'</td><td>'.$porpre4 = round((($presion4/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Hipertensión grado 2</td><td>'.$presion5.'</td><td>'.$porpre5 = round((($presion5/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Hipertensión grado 3</td><td>'.$presion6.'</td><td>'.$porpre6 = round((($presion6/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Hipertensión no identificada</td><td>'.$presion7.'</td><td>'.$porpre7 = round((($presion7/$total)*100),2).' %</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Total</td><td>'.$totalpre = $presion1 + $presion2 + $presion3 + $presion4 + $presion5 + $presion6 + $presion7.'</td><td>'.$totalporcpre = $porpre1 + $porpre2 + $porpre3 + $porpre4 + $porpre5 + $porpre6 + $porpre7.' %</td></tr>';
		$row .= '</table>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $row, 0,2, false, true, 'C', true, 10);
		
		$html = '<br/><br/><br/><p>!!!!!!!!!! Pendiente tabla analíticas !!!!!!!!!¡¡¡¡¡¡¡¡¡¡¡¡¡¡</p>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 40);
		
		
		$html = '<br/>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 40);
		
		$espiarreglo = array();
		$flag = -1;
		
		foreach ($espi as $caso)
		{
			if($caso->getMdpaci()->getId() != $flag)
			{
				$flag = $caso->getMdpaci()->getId();
				$espiarreglo[$flag] = array();
			}
			
			$diag = $em->getRepository('ScontrolBundle:Mddiag')->findByMdhist($caso->getId());
			
			foreach ($diag as $caso2)
				$espiarreglo[$flag][] = $caso2->getMdpato()->getCodigo();
		}
		
		$clases = array('Normal' => 0, 'Con patologías' => 0, 'No realizada' => 0);
		
		foreach ($espiarreglo as $caso)
		{
			if (in_array('1600', $caso))
				$clases['Normal'] += 1;
			else if($this->rangoInArray(1601, 1631, $caso))
				$clases['Con patologías'] += 1;
			else
				$clases['No realizada'] += 1;
		}
		
		$espi1 = $clases['Normal'];
		$espi2 = $clases['Con patologías'];
		$espi3 = $clases['No realizada'];
		
		$row = '<table border="1">';
		$row .= '<tr><td colspan="3">Espirometría</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Tipo</td><td>Exploraciones</td><td>%</td></tr>';
		$row .= '<tr><td>Normal</td><td>'.$espi1.'</td><td>'.$porespi1 = round((($espi1/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Con patologías</td><td>'.$espi2.'</td><td>'.$porespi2 = round((($espi2/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>No realizada</td><td>'.$espi3.'</td><td>'.$porespi3 = round((($espi3/$total)*100),2).' %</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Total</td><td>'.$totalespi = $espi1 + $espi2 + $espi3.'</td><td>'.$totalporcespi = $porespi1 + $porespi2 + $porespi3.' %</td></tr>';
		$row .= '</table>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $row, 0,2, false, true, 'C', true, 10);
		
		$html = '<br/>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 40);
		
		$visionarreglo = array();
		$flag = -1;
		
		foreach ($vision as $caso)
		{
			if($caso->getMdpaci()->getId() != $flag)
			{
				$flag = $caso->getMdpaci()->getId();
				$visionarreglo[$flag] = array();
			}
			
			$diag = $em->getRepository('ScontrolBundle:Mddiag')->findByMdhist($caso->getId());
			
			foreach ($diag as $caso2)
				$visionarreglo[$flag][] = $caso2->getMdpato()->getCodigo();
		}
		
		$clases = array('Con patologías' => 0, 'Normal' => 0, 'No realizada' => 0);
		
		foreach ($visionarreglo as $caso)
		{
			if (in_array('1400', $caso))
				$clases['Normal'] += 1;
			else if($this->rangoInArray(1413, 1487, $caso))
				$clases['Con patologías'] += 1;
			else
				$clases['No realizada'] += 1;
		}
		
		$vision1 = $clases['Normal'];
		$vision2 = $clases['Con patologías'];
		$vision3 = $clases['No realizada'];
		
		$row = '<table border="1">';
		$row .= '<tr><td colspan="3">Agudeza Visual</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Tipo</td><td>Exploraciones</td><td>%</td></tr>';
		$row .= '<tr><td>Normal</td><td>'.$vision1.'</td><td>'.$porvision1 = round((($vision1/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Con patologías</td><td>'.$vision2.'</td><td>'.$porvision2 = round((($vision2/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>No realizada</td><td>'.$vision3.'</td><td>'.$porvision3 = round((($vision3/$total)*100),2).' %</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Total</td><td>'.$totalvision = $vision1 + $vision2 + $vision3.'</td><td>'.$totalporcvision = $porvision1 + $porvision2 + $porvision3.' %</td></tr>';
		$row .= '</table>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $row, 0,2, false, true, 'C', true, 10);
		
		$html = '<br/>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 40);
		
		$audiometriaarreglo = array();
		$flag = -1;
		
		foreach ($audiometria as $caso)
		{
			if($caso->getMdpaci()->getId() != $flag)
			{
				$flag = $caso->getMdpaci()->getId();
				$audiometriaarreglo[$flag] = array();
			}
			
			$diag = $em->getRepository('ScontrolBundle:Mddiag')->findByMdhist($caso->getId());
			
			foreach ($diag as $caso2)
				$audiometriaarreglo[$flag][] = $caso2->getMdpato()->getCodigo();
		}
		
		$clases = array('Normal' => 0, 'Posible trauma acústico' => 0, 'Posible presbiacusia' => 0, 'Hipoacusia global' => 0, 'No realizada' => 0);
		
		foreach ($audiometriaarreglo as $caso)
		{
			if (in_array('1500', $caso))
				$clases['Normal'] += 1;
			else if($this->rangoInArray(1561, 1563, $caso))
				$clases['Posible trauma acústico'] += 1;
			else if($this->rangoInArray(1571, 1573, $caso) OR $this->rangoInArray(1551, 1553, $caso))
				$clases['Posible presbiacusia'] += 1;
			else if($this->rangoInArray(1511, 1547, $caso))
				$clases['Hipoacusia global'] += 1;
			else
				$clases['No realizada'] += 1;
		}
		
		$audio1 = $clases['Normal'];
		$audio2 = $clases['Posible trauma acústico'];
		$audio3 = $clases['Posible presbiacusia'];
		$audio4 = $clases['Hipoacusia global'];
		$audio5 = $clases['No realizada'];
		
		$row = '<table border="1">';
		$row .= '<tr><td colspan="3">Audiometría</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Tipo</td><td>Exploraciones</td><td>%</td></tr>';
		$row .= '<tr><td>Normal</td><td>'.$audio1.'</td><td>'.$poraudio1 = round((($audio1/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Posible trauma acústico</td><td>'.$audio2.'</td><td>'.$poraudio2 = round((($audio2/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Posible presbiacusia</td><td>'.$audio3.'</td><td>'.$poraudio3 = round((($audio3/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Hipoacusia global</td><td>'.$audio4.'</td><td>'.$poraudio4 = round((($audio4/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>No realizada</td><td>'.$audio5.'</td><td>'.$poraudio5 = round((($audio5/$total)*100),2).' %</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Total</td><td>'.$totalaudio = $audio1 + $audio2 + $audio3 + $audio4 + $audio5.'</td><td>'.$totalporcaudio = $poraudio1 + $poraudio2 + $poraudio3 + $poraudio4 + $poraudio5.' %</td></tr>';
		$row .= '</table>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $row, 0,2, false, true, 'C', true, 10);
		
		
		$html = '<br/>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 40);
		
		$aparatoarreglo = array();
		$flag = -1;
		
		foreach ($pacientes as $caso)
		{
			if($caso->getMdpaci()->getId() != $flag)
			{
				$flag = $caso->getMdpaci()->getId();
				$aparatoarreglo[$flag] = array();
			}
			
			$diag = $em->getRepository('ScontrolBundle:Mddiag')->findByMdhist($caso->getId());
			
			foreach ($diag as $caso2)
				$aparatoarreglo[$flag][] = $caso2->getMdpato()->getCodigo();
		}
		
		$clases = array('Normal' => 0, 'Alteraciones' => 0, 'Sin exploración' => 0);
		
		foreach ($aparatoarreglo as $caso)
		{
			if (in_array('1000', $caso))
				$clases['Normal'] += 1;
			else if($this->rangoInArray(1719, 1723, $caso))
				$clases['Alteraciones'] += 1;
			else if (in_array('1780', $caso))
				$clases['Sin exploración'] += 1;
		}
		
		$aparato1 = $clases['Normal'];
		$aparato2 = $clases['Alteraciones'];
		$aparato3 = $clases['Sin exploración'];
		
		$row = '<table border="1">';
		$row .= '<tr><td colspan="3">Aparato Locomotor</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Tipo</td><td>Exploraciones</td><td>%</td></tr>';
		$row .= '<tr><td>Normal</td><td>'.$aparato1.'</td><td>'.$poraparato1 = round((($aparato1/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Alteraciones</td><td>'.$aparato2.'</td><td>'.$poraparato2 = round((($aparato2/$total)*100),2).' %</td></tr>';
		$row .= '<tr><td>Sin exploraciones</td><td>'.$aparato3.'</td><td>'.$poraparato3 = round((($aparato3/$total)*100),2).' %</td></tr>';
		$row .= '<tr style="background-color: #BFBFBF"><td>Total</td><td>'.$totalaparato = $aparato1 + $aparato2 + $aparato3.'</td><td>'.$totalporcaparato = $poraparato1 + $poraparato2 + $poraparato3.' %</td></tr>';
		$row .= '</table>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $row, 0,2, false, true, 'C', true, 10);
		
		$html = '<p>Aquí va la tabla de dictamen que hace falta ==================</p>';
		$pdf->autoCell(0,0,20, $pdf->GetY(), $html, 0,2, false, true, 'C', true, 40);
		
		$html = '
		<h4>6. Formación</h4>
		<p>La formación es un derecho de los trabajadores recogido en diferentes disposiciones legales:</p>

		<strong>Estatuto de los Trabajadores:</strong>

		<p><i>Artículo 19.4 señala:</i></p>

		<p><i>“El empresario está obligado a facilitar una formación práctica y adecuada en materia de seguridad e higiene a los trabajadores que 
		contrata, o cuando cambien de puesto de trabajo o tengan que aplicar nueva técnica..., ya sea con servicios propios, o con la intervención de 
		los servicios oficiales correspondientes.</i></p>

		<p>Ley de Prevención de Riesgos Laborales:</p>
 
		<p><i>Artículo 14, apartado 1 párrafo 3:</i></p>

		<p><i>Los derechos de información consulta y participación, formación en materia preventiva, paralización de la actividad en caso de riesgo grave e 
		inminente y vigilancia de su estado de salud, en los términos previstos en la presente Ley, forman parte del derecho de los trabajadores a una 
		protección eficaz en materia de seguridad y salud en el trabajo.</i></p>

		<p><i>Artículo 19. Formación de los trabajadores:</i></p>

		<p><i>En cumplimiento del deber de protección, el empresario deberá garantizar que cada trabajador reciba una formación teórica y práctica, 
		suficiente y adecuada, en materia preventiva, tanto en el momento de su contratación cualquiera que sea la modalidad o duración de ésta, como 
		cuando se produzcan cambios en las funciones que desempeñe o se introduzcan nuevas tecnologías o cambios en los equipos de trabajo.</i></p>
		
		<p><strong>Reglamento de los Servicios de Prevención:</strong></p>

		<p><i>Artículo 3, definición:</i></p>

		<p><i>Cuando de la evaluación realizada resulte necesaria la adopción de medidas preventivas deberán ponerse claramente de manifiesto las 
		situaciones en que sea necesario:</i></p>
		<ol type="a">
			<li>
			<p style="text-align: justify"><i>Eliminar o reducir el riesgo, mediante medidas de prevención en el origen, organizativas, de protección 
			colectiva, de protección individual, o de formación e información a los trabajadores</i></p>
			
			<p style="text-align: justify"><i>Artículo 18: Recursos materiales y humanos de las entidades especializadas que actúen 
			como servicios de prevención:</i></p>
			</li>
		</ol>
		
		<p><i>Los expertos en las especialidades mencionadas (las diferentes disciplinas preventivas) actuarán de forma coordinada, en particular en 
		relación con las funciones relativas al diseño preventivo de los puestos de trabajo, l identificación y evaluación de los riesgos, los planes 
		de prevención y los planes de formación de los trabajadores.</i></p>

		<p><i>La formación se concreta en forma de cursos, seminarios y otras actividades similares referidas al ámbito sanitario del trabajo, pero siempre 
		orientadas a objetivos específicos relacionados con las necesidades directas de la empresa.</i></p>
		
		<p><i>La formación es un derecho de los trabajadores, por lo que se trata de una actividad de realización obligatoria. Sin embargo, más allá de las 
		exigencias legales, la formación genera beneficios al promover la cultura preventiva dentro de la empresa y hacer más seguro el trabajo disminuyendo 
		los riesgos.</i></p>


		<p><strong>Número de trabajadores que han realizado cursos de formación:</strong></p>
		<ul>	
			<li>Primeros auxilios:   0</li>
		</ul>
		<p><strong>Número de trabajadores que han realizado  profilaxis riesgo biológico: 17</strong></p>
		';
		$pdf->SetFont('dejavusans', '', 12);
		$pdf -> writeHTMLCell(170, 0, 20, 45, $html, 0, 0, 0, true, 'J', true);
		$pdf->AddPage();
		$html= '
		<h4>7. Información y Asesoramiento</h4>

		<p>Las obligaciones derivadas del actual marco legal ocasionan la necesidad por parte del empresario de sentirse apoyado y respaldado en todo momento 
		por los servicios de prevención en materia de vigilancia de la salud: Dar respuesta a las dudas y necesidades e informar a la empresa en materia de 
		salud laboral es una faceta importante de la disciplina de Vigilancia a la Salud.</p>
		
		<p>Por otra parte, la información es un derecho de los trabajadores, que debe ser satisfecho bien directamente por el empresario, bien a través de 
		los órganos o personas que tengan establecida dicha labor.</p> 
		
		<p><strong>Ley de prevención de Riesgos Laborales:</strong></p>

		<p><i><Artículo 14.1.3</i></p>

		<p><i>Los derechos de información. . . en los términos previstos en la presente Ley,  forman parte del derecho de los trabajadores a una protección 
		eficaz en materia de seguridad y salud en el trabajo.</i></p>

		<p><strong>Reglamento de los Servicios de Prevención:</strong></p> 
		 
		<p><i>Artículo 3º:</i></p>

		<p><i>Cuando de la evaluación realizada resulte necesaria la adopción de medidas preventivas, deberán ponerse claramente de manifiesto las situaciones 
		en que sea necesario.</i></p>
		<ol type="a">
			<li><i>Eliminar o reducir el riesgo, mediante medidas de prevención en el origen, organizativas, de protección colectiva, de protección individual, 
			o de formación e información a los trabajadores.</i></li>
		</ol>
		
		<p><strong>Información, consulta y participación de los trabajadores:</strong></p>

		<p><i>Artículo 18:</i></p>
		<ol>
			<li>
			<p><i>A fin de dar cumplimiento al deber de protección establecido en la presente Ley, el empresario adoptará las medidas adecuadas para que los 
			trabajadores reciban todas las informaciones necesarias en relación con:</i></p>
			<ol type="a">
				<li style="text-align: justify"><i>Los riesgos para la seguridad y la salud de los trabajadores en el trabajo, tanto aquellos que afecten a la empresa en</i></li>
				<li style="text-align: justify"><i>Su conjunto como a cada tipo de puesto de trabajo o función.</i></li>
				<li style="text-align: justify"><i>Las medidas y actividades de protección y prevención aplicables a los riesgos señalados en el apartado anterior</i></li>
				<li style="text-align: justify"><i>Las medidas adoptadas de conformidad con lo dispuesto en el artículo 20 de la presente Ley.</i></li>
			</ol>
			</li>
		</ol>

		<p><i>La presente memoria es una relación de las actividades de Vigilancia de la Salud realizadas durante el periodo de vigencia del concierto.</i></p>
		<p style="text-align: right">Barcelona, '.$meses[intval(date('m'))-1].' '.date('Y').'</p>
		<br/><br/><br/>
		<p>Firmado:</p>
		<br/><br/><br/>
		<p>Dr. Ildefonso Tristán Burguesa</p>
		<p>Medico de Vigilancia de la Salud</p>
		<br/><br/><br/>
		<p>Sra. Eva Real Real.</p>
		<p>Diplomada Universitaria en Enfermería de Empresa</p>
		';
		$pdf->SetFont('dejavusans', '', 12);
		$pdf -> writeHTMLCell(170, 0, 20, 45, $html, 0, 0, 0, true, 'J', true);
		
		$pdf->Output('memoriaporempresa.pdf', 'I');
	}
    
    public function analiticaAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$hist = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaDictamen($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA DE ALTERACIONES ANÁLITICAS');
		$pdf->SetSubject('Estadística de alteraciones analiticas.');
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
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA DE ALTERACIONES ANÁLITICAS");
		$pdf->AddPage();
		
        $marcas = array();
        $marcas["Alteraciones Hematológicas"] = array("1201", "1202", "1203", "1206", "1214", "1240", "1246", "1275");
        $marcas["Alteraciones Hepáticas"] = array("1215", "1216", "1217", "1218", "1223", "1224", "1248");
        $marcas["Dislipemias"] = array("1210", "1211", "1212", "1270", "1271");
        $marcas["Glucosa"] = array("1208", "1220", "1221");
        $marcas["Normal"] = array("1200");
        
        $valores = array("Alteraciones Hematológicas" => 0, "Alteraciones Hepáticas" => 0, "Dislipemias" => 0, "Glucosa" => 0, "Normal" => 0, "No Evaluada" => 0);
        
        foreach($hist as $caso)
        {
            $diags = $em->getRepository('ScontrolBundle:Mddiag')->findByMdhist($caso->getId());
            $codes = array();
            
            foreach($diags as $uni)
                $codes[] = $uni->getMdpato()->getCodigo();
            
            $noev = true;
            
            if( $this->arrayVerify($codes, $marcas["Alteraciones Hematológicas"]) )
            {
                $valores["Alteraciones Hematológicas"] += 1;
                $noev = false;
            }
            
            if( $this->arrayVerify($codes, $marcas["Alteraciones Hepáticas"]) )
            {
                $valores["Alteraciones Hepáticas"] += 1;
                $noev = false;
            }
            
            if( $this->arrayVerify($codes, $marcas["Dislipemias"]) )
            {
                $valores["Dislipemias"] += 1;
                $noev = false;
            }
            
            if( $this->arrayVerify($codes, $marcas["Glucosa"]) )
            {
                $valores["Glucosa"] += 1;
                $noev = false;
            }
            
            if( $this->arrayVerify($codes, $marcas["Normal"]) )
            {
                $valores["Normal"] += 1;
                $noev = false;
            }
            
            if($noev)
                $valores["No Evaluada"] += 1;
        }
		
        foreach($valores as $k => $v)
            $pdf->autoCell(0, 0, 20, $pdf->GetY(), $k.": ".$v, 0, 2, false, true, 'C', true, 20);
        
		$pdf->Output('estadistica_alt_analitica.pdf', 'I');
	}
    
	public function dictamenAction($empresa, $inicio, $fin, $lv)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$casos = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaDictamen($empresa, $inicio, $fin);

		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('INFORME DE DICTAMEN MÉDICO');
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
		
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->setGrPaginate(true);

		if($lv == 1)
		{
			$pdf->setMkLateral(true);
		}
		else
		{
			$pdf->setWLogo(false);
			$pdf->setFoot(false);
		}

		if(count($casos) > 0)
		{
			$idx = -1;

			foreach ($casos as $caso) 
			{
				$sucu = $caso->getMdpaci()->getGbsucu();
				$emp = $sucu->getGbempr();

				if($sucu->getId() != $idx) 
				{
					if($idx != -1)
						$this->finalDicatmen($pdf);

					$idx = $sucu->getId();
					$pdf->startPageGroup();

					$pdf->AddPage();
					
					$html =  '<table style="border-bottom: 2px solid #000000;">';
					$html .= '<tr><td><h3>NOMBRE DE LA EMPRESA: '.$emp->getNombre().'</h3></td></tr>';
					$html .= '<tr><td><h3>CENTRO DE TRABAJO: '.$sucu->getNombre().'</h3></td></tr>';
					$html .= '</table>';

					$html .= '<p>A/A RESPONSABLE DE LA REVICIÓN</p>';
					$html .= '<p>Tras el examen de salud realizado al personal de su empresa en el periodo '.$inicio.' - '.$fin.' les informamos de las conclusiones en relación con las aptitudes:</p>';
					$pdf->autoCell(0, 0, 20, $pdf->GetY()-8, $html, 0, 2, false, true, 'J');
					$pdf->Ln(5);

					$head = '<tr bgcolor="#C9DEE9"><td><b>APELLIDOS Y NOMBRES</b></td><td><b>PUESTO DE TRABAJO</b></td><td><b>PROTOCOLOS</b></td><td><b>TIPO DE EXAMEN</b></td><td><b>RESULTADO</b></td></tr>';
					$mac = '<table border="1">'.$head.'</table>';
					$pdf->autoCell(0, 0, 20, $pdf->GetY(), $mac, 0, 2, false, true, 'C');
				}

				$prot = array();

				$res = $em->getRepository('ScontrolBundle:Mdresp')->findByMdhist($caso->getId());

				foreach ($res as $rq)
				{
					$npr = $rq->getMdques()->getMdprot()->getNombre();
					if(!in_array($npr, $prot))
						$prot[] = $npr;
				}
					
				$row = '<table border="1"><tr>';
				$row .= '<td>'.strtoupper($caso->getMdpaci()->getFullName()).'</td>';
				$row .= '<td>'.strtoupper($caso->getMdpaci()->getGbptra()->getNombre()).'</td>';
				$row .= '<td>'.join($prot, '+').'</td>';
				$row .= '<td>'.$caso->getSTipo().'</td>';
				$row .= '<td>'.$caso->getSDictamen().'</td>';
				$row .= '</tr></table>';
				
				$pdf->autoCell(0, 0, 20, $pdf->GetY(), $row, 0, 2, false, true, 'C', true, 10);
			}

			$this->finalDicatmen($pdf);
		}
		else
		{
			$pdf->AddPage();
			$pdf->autoCell(0, 0, 20, $pdf->GetY(), '<h1 color="red">NO SE HAN ENCONTRADO DATOS!</h1>', 0, 2, false, true, 'C', true, 10);
		}					

		ob_end_clean();
		$pdf->Output('r_Dictamen.pdf', 'I');
	}
	
	public function riesgosAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$ries = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaPacientes($empresa, $inicio, $fin);
		$nombreempresa = $em->getRepository('ScontrolBundle:Gbempr')->find($empresa);
		
		$pdf = new \Tcpdf_Tcpdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('REPORTE DE ESTADÍSTICA POR RIESGOS LABORALES');
		$pdf->SetSubject('Estadística por riesgos laborales.');
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
		$pdf->setMemoTitle("REPORTE DE ESTADÍSTICA POR RIESGOS LABORALES");
		$pdf->AddPage();
		
		$boxes = array();
		$dboxes = array();
		
		$total = count($ries);
		
		foreach($ries as $caso)
		{
			$ptra = $caso->getMdpaci()->getGbptra();
			$procs = $em->getRepository('ScontrolBundle:Mdproc')->findByGbptra($ptra->getId());			
			
			foreach($procs as $uni)
			{
				$prot = $uni->getMdprot();
				
				if(isset($boxes[$prot->getCodigo()]))
					$boxes[$prot->getCodigo()] += 1;
				else
					$boxes[$prot->getCodigo()] = 1;
					
				if(!isset($dboxes[$prot->getCodigo()]))
					$dboxes[$prot->getCodigo()] = $prot->getNombre();
			}
			
		}			
				
		$row = '<table border="1">';
		$row .= '<tr style="background-color: #BFBFBF"; font-size: 2em><td>Código</td><td>Descripción</td><td>Cantidad de Casos</td><td>% Total Explorados</td></tr>';
		foreach($boxes as $key => $val)
		{
			$row .= '<tr>';
			$row .= '<td>'.$key.'</td>';
			$row .= '<td>'.$dboxes[$key].'</td>';
			$row .= '<td>'.$val.'</td>';
			$row .= '<td>'.round((($val/$total)*100),2)." %".'</td>';
			$row .= '</tr>';
			//$pdf->autoCell(0, 0, 20, $pdf->GetY(), $key." ".$dboxes[$key]." ".$val." ".round((($val/$total)*100),2)."%", 0, 2, false, true, 'C', true, 0);
		}
		$row .= '</table>';
		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $row, 0, 2, false, true, 'C', true, 10);
		
		$pdf->Output('estadisticariesgos.pdf', 'I');
	}
	

	private function finalDicatmen($pdf)
	{
		$html = '<b><u>OBSERVACIONES:</u></b><br>';
		$html .= '<ul>';
		$html .= '<li>ESTA APTITUD ES EN RELACIÓN A SU PUESTO DE TRABAJO HABITUAL.</li>';
		$html .= '<li>SIENDO SU VALIDEZ DE UN AÑO.</li>';
		$html .= '</ul>';

		$pdf->Ln();
		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $html, 0, 2, false, true, 'J', true, 62);

		$html = "________________________________________________________<br><b>FIRMA Y SELLO DE QUIEN EXPIDE</b>";
		$pdf->Ln();
		$pdf->Ln();
		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $html, 0, 2, false, true, 'C', true, 0);
	}
	
	private function rangoInArray($ini, $fin, $arr)
	{
		$flag = false;
		
		for($i = $ini; $i <= $fin; $i++)
		{
			if(in_array(''.$i, $arr))
			{
				$flag = true;
				break;
			}
		}
		
		return $flag;
	}
    
    function arrayVerify($vals, $opts)
    {
        $flag = false;
        foreach($vals as $v)
        {
            if( in_array($v, $opts) )
            {
                $flag = true;
                break;
            }
        }
        
        return $flag;
    }
}
