<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Ctfact;
use Vimelab\ScontrolBundle\Entity\Ctdeta;
use Vimelab\ScontrolBundle\Form\CtfactType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Ctfact controller.
 *
 * @Route("/ctfact")
 */
class CtfactController extends Controller
{
    /**
     * Lists all Ctfact entities.
     *
     * @Route("/", name="ctfact")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Ctfact')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Ctfact')->getPage(20, $pag);

			return array('entities' => $entities, 'pages' => $pages, 'pag' => $pag);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();
            $repo = $em->getRepository('ScontrolBundle:Ctfact');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Ctfact:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    
    public function showAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $fac = $em->getRepository('ScontrolBundle:Ctfact')->find($id);
        $dts = $em->getRepository('ScontrolBundle:Ctdeta')->findByCtfact($id);
        $emp = $fac->getCtcont()->getGbempr();
        $act = $emp->getGbcnae();

		$pdf = new \Tcpdf_Tcpdf('l', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('Factura');
		$pdf->SetSubject('Factura');
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
		$pdf->setMemoTitle('<h2>FACTURA DE SERVICIOS PRESTADOS N° : '.$id.'</h2>');
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->AddPage();
		
		$html = '<table border="1" bgcolor="#E1EBF9">';
		$html .= '<tr>';
		$html .= '<td align="right"><b>Fecha:&nbsp;&nbsp;&nbsp;</b></td><td>'.$fac->getFecha()->format('Y-m-d').'</td>';		
		$html .= '<td align="right"><b>Vencimiento:&nbsp;&nbsp;&nbsp;</b></td><td>'.$fac->getVencimiento()->format('Y-m-d').'</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td align="right"><b>Periodo:&nbsp;&nbsp;&nbsp;</b></td><td colspan="3">'.$fac->getPerini()->format('Y-m-d').' <b>A</b> '.$fac->getPerfin()->format('Y-m-d').'</td>';		
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td align="right"><b>Cliente:&nbsp;&nbsp;&nbsp;</b></td><td>'.$emp->getNombre().'</td>';		
		$html .= '<td align="right"><b>NIF:&nbsp;&nbsp;&nbsp;</b></td><td>'.$emp->getIdentificacion().'</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td align="right"><b>Sector:&nbsp;&nbsp;&nbsp;</b></td><td colspan="3">'.$act->getActecon().'</td>';		
		$html .= '</tr>';		
		$html .= '</table>';
		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'C', true);

		$pdf->SetFont('dejavusansmono', '', 10);
		$pdf->ln(5);
		$html = '<table border="1">';
		$html .= '<tr bgcolor="#E3E3E3"><td><b>CÓDIGO</b></td><td><b>CONCEPTO</b></td><td><b>CANTIDAD</b></td><td><b>SUBTOTAL €</b></td><td><b>IVA €</b></td><td><b>TOTAL €</b></td></tr>';

		foreach ($dts as $caso) 
		{
			$ser = $caso->getCtserv();

			$html .= '<tr>';
			$html .= '<td>'.$ser->getCodigo().'</td><td>'.$ser->getNombre().'</td><td>'.$caso->getCantidad().'</td><td align="right">'.$this->separateChar($caso->getSub()).'&nbsp;&nbsp;&nbsp;</td><td align="right">'.$this->separateChar($caso->getViva()).'&nbsp;&nbsp;&nbsp;</td><td align="right">'.$this->separateChar($caso->getTotal()).'&nbsp;&nbsp;&nbsp;</td>';
			$html .= '</tr>';
		}

		$html .= '<tr bgcolor="#E3E3E3">';
		$html .= '<td colspan="3"><b>SUB TOTAL</b></td><td align="right"><b>'.$this->separateChar($fac->getSubtotal()).'</b>&nbsp;&nbsp;&nbsp;</td><td align="right"><b>'.$this->separateChar($fac->getIva()).'</b>&nbsp;&nbsp;&nbsp;</td><td align="right"><b>'.$this->separateChar($fac->getSupra()).'</b>&nbsp;&nbsp;&nbsp;</td>';
		$html .= '</tr>';
		$html .= '<tr bgcolor="#E3E3E3">';
		$html .= '<td colspan="3"><b>DESCUENTO</b></td><td align="right"><b>0.00&nbsp;&nbsp;&nbsp;</b></td><td align="right"><b>0.00&nbsp;&nbsp;&nbsp;</b></td><td align="right"><b>'.$this->separateChar($fac->getDescuento()).'</b>&nbsp;&nbsp;&nbsp;</td>';
		$html .= '</tr>';
		$html .= '<tr bgcolor="#E3E3E3">';
		$html .= '<td colspan="3"><b>TOTAL</b></td><td align="right"><b>'.$this->separateChar($fac->getSubtotal()).'</b>&nbsp;&nbsp;&nbsp;</td><td align="right"><b>'.$this->separateChar($fac->getIva()).'</b>&nbsp;&nbsp;&nbsp;</td><td align="right"><b>'.$this->separateChar($fac->getTotal()).'</b>&nbsp;&nbsp;&nbsp;</td>';
		$html .= '</tr>';
		$html .= '</table>';
		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'C', true);		
		
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->ln(5);
		$html = '<table border="1" bgcolor="#E1EBF9">';
		$html .= '<tr>';
		$html .= '<td><b>FACTURADO POR</b></td>';
		$html .= '<td><b>ESTADO</b></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td><br><br><br><br><br><br><br>_______________________________________________________<br><b>'.$fac->getGbpers()->getFullName().'</b><br><i>Id: '.$fac->getGbpers()->getIdentificacion().'</i></td>';
		$html .= '<td><br><br><br><h1>'.($fac->getEstado() == 'F' ? 'FACTURADA' : 'ANULADA').'</h1></td>';
		$html .= '</tr>';
		$html .= '</table>';
		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'C', true);		

		ob_end_clean();
		$pdf->Output('factura_'.$id.'.pdf', 'I');
    }

    /**
     * Displays a form to create a new Ctfact entity.
     *
     * @Route("/new", name="ctfact_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{
			$entity = new Ctfact();
			$form   = $this->createForm(new CtfactType(), $entity);

			$em = $this->getDoctrine()->getEntityManager();
            $servs = $em->getRepository('ScontrolBundle:Ctserv')->findBy(array(), array('nombre' => 'ASC'));

			return array('entity' => $entity, 'form'   => $form->createView(), 'servs' => $servs);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Ctfact entity.
     *
     * @Route("/create", name="ctfact_create")
     * @Method("post")
     * @Template("ScontrolBundle:Ctfact:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{	
			$entity  = new Ctfact();
			$request = $this->getRequest();
			$form    = $this->createForm(new CtfactType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) 
			{
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);

				$arr = $entity->getDetalle();
				$arr = Tool::ofJail($arr);

				foreach ($arr as $caso) 
				{
					$deta = new Ctdeta();
					$deta->setCantidad($caso[2]);
					$deta->setVuni($caso[3]);
					$deta->setViva($caso[5]);
					$deta->setTotal($caso[6]);
					$deta->setCtserv($em->getRepository('ScontrolBundle:Ctserv')->find($caso[0]));
					$deta->setCtfact($entity);

					$em->persist($deta);
				}

				if($entity->getEstado() == 'F')
				{	
					$cont = $entity->getCtcont();
					$cont->descontar($entity->getTotal());

					$em->persist($cont);
				}

				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctfact_show', array('id' => $entity->getId())));
			}

			return array('entity' => $entity,'form'   => $form->createView());
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    private function separateChar($str, $char='.', $len=3)
	{
		$str = "".$str;
		$tmp = explode(".", $str);
		
		$tmx = '';

		$tam = strlen($tmp[0]);
		$num = ($tam / $len) - 1;
		$sob = ($tam % $len) == 0 ? 1 : $len-($tam % $len)+1;
		
		if($num > 0)
		{
			for($i = 0; $i < $tam; $i++)
			{
				$tmx .= $tmp[0][$i];
				if( (($i+$sob) % $len) == 0 && $i < ($tam - 1))
					$tmx .= $char;
			}
		}
		else
			$tmx = $tmp[0];
		
		if(count($tmp) == 1)
			$tmp = $tmx.".00";
		else
			$tmp = $tmx.".".$tmp[1];

		return $tmp;
	}
    
}
