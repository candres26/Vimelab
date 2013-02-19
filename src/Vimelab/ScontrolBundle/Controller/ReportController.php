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
				<td><b>Tipo</b></td>
				<td><b>Total</b></td>
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
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);

		
		
		/*$html = '';
		
		foreach($presionarte as $key => $caso)
			$html .=$key.':'.$caso.'<br>';
			
		$pdf->writeHTMLCell(90,0,185,155,$html, '', 0, 0, true, 'C', true);*/

		
		$pdf->Output('estadisticapresionarterial.pdf', 'I');
	}
	
	public function visionAction($empresa, $inicio, $fin)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$vision = $em->getRepository('ScontrolBundle:Mdhist')->getConsultaVisual($empresa, $inicio, $fin);
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
		
		$style1 = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 255, 0));
		$style3 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$style4 = array('width' => 10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
		$border_style = array('all' => array('width' => 0.8, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
		
		$vision1 = $vision['Normal'];
		$vision2 = $vision['Con patología'];
		
		arsort($vision);
		$max = max($vision);
		$max = intval(($max + 10) /10.0) * 10;
		
		$postvision1 = ((150 * $vision1)/$max);
		$postvision2 = ((150 * $vision2)/$max);


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
		
		$pdf->SetDrawColor(100, 0, 0, 0);
		$pdf->SetFillColor(100, 0, 0, 0);
		$pdf->Rect(186, 71, 2, 2, 'DF', $border_style);
		
		$pdf->SetDrawColor(0,57,54,20);
		$pdf->SetFillColor(0,57,54,20);
		$pdf->Rect(186, 75.5, 2, 2, 'DF', $border_style);

		
		$html = '
		<table>
			<tr>
				<td align="left">Normal</td>
			</tr>
			<tr>
				<td align="left">Con patología</td>
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

	
	public function memoriaAction($empresa)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$datosempresa = $em->getRepository('ScontrolBundle:Gbempr')->getEmpresa($empresa);
		
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
		
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->AddPage();
		 
		$html = 
		'
		<h4>EMPRESA:'.$datosempresa[0].'</h4>
		<p>NIF: B-60564077</p>
		';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf -> writeHTMLCell(170, 0, 20, 45, $html, 0, 0, 0, true, 'J', true);
		
		$pdf->Output('memoriaporempresa.pdf', 'I');
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

				$head = '<tr bgcolor="#C9DEE9"><td><b>APELLIDOS Y NOMBRES</b></td><td><b>PUESTO DE TRABAJO</b></td><td><b>PROTOCOLOS</b></td><td><b>TIPO DE EXAMEN</b></td><td><b>REESULTADO</b></td></tr>';
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

		ob_end_clean();
		$pdf->Output('r_Dictamen.pdf', 'I');
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
}
