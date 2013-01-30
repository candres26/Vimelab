<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Tcrevi;
use Vimelab\ScontrolBundle\Form\TcreviType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Tcrevi controller.
 *
 * @Route("/tcrevi")
 */
class TcreviController extends Controller
{
    /**
     * Lists all Tcrevi entities.
     *
     * @Route("/", name="tcrevi")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Tcrevi')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Tcrevi')->getPage(20, $pag);

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
            $repo = $em->getRepository('ScontrolBundle:Tcrevi');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Tcrevi:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Tcrevi entity.
     *
     * @Route("/{id}/show", name="tcrevi_show")
     * @Template()
     */
    public function showAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tcrevi')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tcrevi entity.');
			}

			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),        );
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Tcrevi entity.
     *
     * @Route("/new", name="tcrevi_new")
     * @Template()
     */
    public function newAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity = new Tcrevi();
			$form   = $this->createForm(new TcreviType(), $entity);

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Tcrevi:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Tcrevi entity.
     *
     * @Route("/create", name="tcrevi_create")
     * @Method("post")
     * @Template("ScontrolBundle:Tcrevi:new.html.twig")
     */
    public function createAction($lv)
    {
		if(Tool::isGrant($this))
		{
			$entity  = new Tcrevi();
			$request = $this->getRequest();
			$form    = $this->createForm(new TcreviType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) 
			{
				try
				{
					$em = $this->getDoctrine()->getEntityManager();
					$em->persist($entity);
					$em->flush();

					Tool::logger($this, $entity->getId());
					
					if($lv == 1)
						return $this->redirect($this->generateUrl('tcrevi_show', array('id' => $entity->getId())));
					else
					{
						$newEnt = new Tcrevi();
						$form   = $this->createForm(new TcreviType(), $newEnt);	
						return $this->render("ScontrolBundle:Tcrevi:_new.html.twig", array('entity' => $newEnt, 'form'   => $form->createView(), 'RMSG' => '0-Revisión Técnica Creada Con Exito!-'.$entity->getId()));
					}
					
				}
				catch(\Exception $e)
				{
					if($lv == 1)
						return array('entity' => $entity, 'form'   => $form->createView());
					else	
						return $this->render("ScontrolBundle:Tcrevi:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => '1-Imposible Crear Revisión Técnica!'));
				}
			}

			if($lv == 1)
				return array('entity' => $entity, 'form'   => $form->createView());
			else
				return $this->render("ScontrolBundle:Tcrevi:_new.html.twig", array('entity' => $entity, 'form'   => $form->createView(), 'RMSG' => 'LOAD'));
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Tcrevi entity.
     *
     * @Route("/{id}/edit", name="tcrevi_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tcrevi')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tcrevi entity.');
			}

			$editForm = $this->createForm(new TcreviType(), $entity);
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
     * Edits an existing Tcrevi entity.
     *
     * @Route("/{id}/update", name="tcrevi_update")
     * @Method("post")
     * @Template("ScontrolBundle:Tcrevi:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Tcrevi')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Tcrevi entity.');
			}

			$editForm   = $this->createForm(new TcreviType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('tcrevi_show', array('id' => $id)));
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
     * Deletes a Tcrevi entity.
     *
     * @Route("/{id}/delete", name="tcrevi_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Tcrevi')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Tcrevi entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $id);
				}
	
				return $this->redirect($this->generateUrl('tcrevi'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('tcrevi_edit', array('id' => $id)));
			}
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    public function controlAction($id)
    {
    	$pdf = new \Tcpdf_Tcpdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Vimelab');
		$pdf->SetTitle('Control De Visita');
		$pdf->SetSubject('R. Técnica');
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
		$pdf->setMemoTitle('<h3>CONTROL DE VISITA EFECTUADA EN LA EMPRESA</h3>');
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->AddPage();
		
		$em = $this->getDoctrine()->getEntityManager();
		$caso = $em->getRepository('ScontrolBundle:Tcrevi')->find($id);
		
		$pdf->ln(5);
		$html = '<table border="1">';
		$html .= '<tr>';
		$html .= '<td><b>Empresa:</b></td>';
		$html .= '<td>'.$caso->getGbsucu()->getGbempr()->getNombre().'</td>';
		$html .= '<td><b>Sucursal:</b></td>';
		$html .= '<td>'.$caso->getGbsucu()->getNombre().'</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td><b>Fecha:</b></td>';
		$html .= '<td>'.$caso->getFecha()->format('Y-m-d').'</td>';
		$html .= '<td><b>Horario:</b></td>';
		$html .= '<td>'.$caso->getInicio()->format('H:i').' a '.$caso->getFin()->format('H:i').'</td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td colspan="4"><b>PERSONAS ENTREVISTADAS</b></td>';
		$html .= '</tr>';
		
		$html .= '<tr>';
		$html .= '<td colspan="2">';
		$html .= '<br><br><br><br><br><br><br><br><br><br>';
		$html .= '<div style="border-top: 1px dotted black;"><b>Revisión Técnica: '.$id.'</b></div>';
		$html .= '</td>';

		$html .= '<td colspan="2">';
		$pers = explode("\n", $caso->getEntrevistados());
		$html .= '<ul>';
		foreach ($pers as $p) 
			$html .= '<li>'.$p.'</li>';
		$html .= '</ul>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '</table>';
		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'C', true);

		$pdf->ln(5);
		$html = '<table border="1"  style="margin: 2em 2em 2em 2em;"><tr><td><b>RESUMEN DE LA VISITA:</b><p>'.$caso->getResumen().'</p></td></tr></table>';
		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'J', true);

		$pdf->ln(5);
		$html = '<table>';
		$html .= '<tr>';
		$html .= '<td><b>CONFIRMACIÓN DE LA ASISTENCIA</b><br><i>Sello y firma de la empresa</i></td>';
		$html .= '<td><b>IC6 - PREVENCIÓN LABORAL</b><br><i>Nombre, apellidos y firma del Técnico</i></td>';
		$html .= '</tr>';
		$html .= '</table>';
		$pdf->autoCell(0, 0, 20, $pdf->GetY(), $html, 0, 1, 0, true, 'C', true);		
		
		ob_end_clean();
		$pdf->Output('c_rTecnica_'.$id.'.pdf', 'I');
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
