<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Ctcont;
use Vimelab\ScontrolBundle\Entity\Gbsucu;
use Vimelab\ScontrolBundle\Form\CtcontType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Ctcont controller.
 *
 * @Route("/ctcont")
 */
class CtcontController extends Controller
{
    /**
     * Lists all Ctcont entities.
     *
     * @Route("/", name="ctcont")
     * @Template()
     */
    public function indexAction()
    {
        if(Tool::isGrant($this))
        {
			$em = $this->getDoctrine()->getEntityManager();

			$entities = $em->getRepository('ScontrolBundle:Ctcont')->findAll();
		
			return array('entities' => $entities);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }
    
	public function filterAction($param = '')
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('ScontrolBundle:Ctcont');
        $entities = $repo->getFilter($param);

        return $this->render("ScontrolBundle:Ctcont:index.html.twig", array('entities' => $entities));
    }

    /**
     * Finds and displays a Ctcont entity.
     *
     * @Route("/{id}/show", name="ctcont_show")
     * @Template()
     */
    public function showAction($id, $lv)
    {
		if(Tool::isGrant($this))
        {
			$em = $this->getDoctrine()->getEntityManager();
			$entity = $em->getRepository('ScontrolBundle:Ctcont')->find($id);
			
			if($lv == 1)
			{	
					
				if (!$entity) 
				{
					throw $this->createNotFoundException('Unable to find Ctcont entity.');
				}
	
				$deleteForm = $this->createDeleteForm($id);
	
				return array(
					'entity'      => $entity,
					'delete_form' => $deleteForm->createView(),        );
			}
			else
			{
				$sucu = $em->getRepository('ScontrolBundle:Ctcont')->getSucursal($entity->getGbempr()->getId(),"principal");
					if($sucu==null){
						$sucu = new Gbsucu();
					}
				// create new PDF document
				$pdf = new \Tcpdf_Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				
				// set document information
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('Vimelab');
				$pdf->SetTitle('Contrato');
				$pdf->SetSubject('Contrato');
				//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
				
				// set default header data
				$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
				
				// set header and footer fonts
				$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				
				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				
				//set margins
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				
				//set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				
				//set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				
				// ---------------------------------------------------------
				
				// set font
				$pdf->SetFont('dejavusans', '', 10);
				
				// add a page
				$pdf->AddPage();
				
				//$pdf->setJPEGQuality(75);
				//$pdf->Image('../../scontrol/imagenes/logo.jpg', 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
				
				$html = '<h2 align="right">Contrato No. '.$id.' </h2>
				<h4 align="right">CONTRATO DE PRESTACIÓN DE SERVICIOS DE PREVENCIÓN</h4>
				<b>En [ciudad], a [Fecha] </b>
				<h3 align="center">REUNIDOS</h3>
				<p>
				De una parte, '.$entity->getNombrecontratante().', mayor de edad, con N.I.F '.$entity->getIdentcontratante().' en representación de
				'.$entity->getGbempr()->getNombre().' en adelante Empresa, con domicilio social en '.$entity->getDireccioncontratante().', 
				provista de CIF Nº '.$entity->getGbempr()->getIdentificacion().'. Tel.: '.$sucu->getTelefono().', E-mail: '.$sucu->getCorreo().'.
				<br>
				<br>	
				Y de otra, '.$entity->getNombrecontratista().', con NIF '.$entity->getIdentcontratista().' quien actúa en calidad de
				'.$entity->getCargocontratista().' de la entidad, [VIMELAB, S.L. nombre de la empresa], en adelante VIMELAB, con 
				domicilio social en [direccioncontratista], con [CIF B62809306].
				<br>
				<br>
				Ambas partes, en el concepto en que intervienen, se reconocen la necesaria capacidad legal para contratar
				y obligarse, y de común acuerdo, suscriben el presente concierto en materia de servicio de prevención de
				riesgos laborales, y al efecto:
				</p>
				<h3 align="center">MANIFIESTAN</h3>
				<p>
				<b>I.</b> Que VIMELAB es una Entidad acreditada por el Departament de Treball de la Generalitat de Catalunya
				como Servicio de Prevención Ajeno, acreditación SP-062-B.
				<br>
				<br>
				<b>II.</b> Que [nombrecontratante], se halla interesada en
				contratar para sus centros de trabajo, que se especificarán en este contrato, los servicios de Seguridad,
				Higiene, Ergonomia i Psicosociologia Aplicada, i Vigilancia de la Salud que presta VIMELAB, y
				estando asimismo esta igualmente interesada, ambas partes acuerdan suscribir el presente contrato sujeto
				a las siguientes:
				<br>
				<br>
				<b>CLÁUSULAS:</b>
				<br>
				<br>
				<b>PRIMERA.</b> Que la Empresa concierta con VIMELAB la prestación del Servicio de Prevención Ajeno para
				sus centros de trabajo y trabajadores, que se detallarán en el correspondiente Anexo, y para los que se
				desarrollarán la actividad preventiva descrita en los anexos siguientes:
				<br>
				<br>
				ANEXO I. SEGURIDAD - HIGIENE Y ERGONOMÍA.
				ANEXO II. VIGILANCIA DE LA SALUD.
				ANEXO III. CENTROS CONTRATADOS Y CONDICIONES ECONÓMICAS.
				<ul>
					<li>VIMELAB realizará su actividad de acuerdo con el número de trabajadores especificados en el presente
					contrato. (en caso de fluctuaciones del número de trabajadores, se efectuará el ajuste correspondiente a
					los costes indicados).</li>
				</ul>	
				<br>
				<br>				
				<b>SEGUNDA.</b> La prestación de servicios y las recomendaciones que se deriven de la valoración de los riesgos
				existentes, se acomodará a los principios de la acción preventiva descritos en el art. 15 de la Ley 31/1995,
				de 9 de noviembre.
				<br>
				<br>
				<b>TERCERA.</b> En cualquier caso, y a fin de cumplir con el contenido contractual de este documento, la
				Empresa vendrá obligada frente al Servicio de Prevención a:
				<ol>
					<li>
						Facilitar a VIMELAB, con carácter previo al inicio de las actividades contratadas, toda la
						información relativa a la organización, características y complejidad del trabajo, procesos de
						producción de la Empresa, relación de materias primas y equipos de trabajo existentes en la
						Empresa, la información que conste a la Empresa sobre el estado de salud de los trabajadores, y la
						relación de trabajadores y de los puestos de trabajo que ocupen y las tareas que realicen en dichos
					</li>
					<li>
						Facilitar al Servicio de Prevención, relación expresa de cuantas actividades puedan entenderse
						incluidas en el Anexo I del R.D. 39/1997, por el que se aprueba el Reglamento de los Servicios de
						Prevención.
					</li>
					<li>
						Facilitar la entrada en todo momento y el acceso en cualquier circunstancia a los técnicos del 
						Servicio de Prevención en cualquier dependencia o zona de la Empresa.
					</li>
					<li>
						Firmar de forma expresa la recepción de informes y recomendaciones emitidos por VIMELAB
						como Servicio de Prevención de la Empresa.
					</li>
					<li>
						Asumir el cumplimiento expreso de todas las indicaciones que pueda llevar a cabo VIMELAB
						como Servicio de Prevención Ajeno de la Empresa y, en caso de estar disconforme con alguna de
						las que se realicen, comunicarlo motivadamente por escrito a VIMELAB.
					</li>
					<li>
						Integrar la actividad preventiva en la Empresa, conforme a lo previsto en el art. 1.1 del Real
						Decreto 39/1997 implicando de forma directa a todos los niveles de la Empresa.
					</li>
					<li>
						Comunicar cualquier modificación que afecte al objeto del presente contrato.
					</li>
					<li>
						La Empresa deberá comunicar dentro de la documentación necesaria para realizar el estudio de
						prevención, la información disponible en cuanto al estado de salud de los trabajadores, las posibles
						causas de enfermedades profesionales y las causas más frecuentes de accidentes.
						<br>
						Asimismo, deberá mantener actualizada la información y comunicación sobre las causas de I.T.
						(Incapacidad Temporal) por accidente de trabajo o enfermedad común que se produzcan, así como
						cualquier otra documentación o información de carácter médico disponible que sea solicitada por los
						equipos médicos de VIMELAB.
					</li>
					<li>
						Poner a disposición de VIMELAB, la información prevista en el art. 30.3 de la Ley de Prevención
						de Riesgos Laborales, en relación con los arts. 18 y 23 de la indicada Ley.
					</li>
					<li>
						Facilitar a VIMELAB listado actualizado de los trabajadores que formen parte de la plantilla de la
						Empresa cuando existan modificaciones respecto a la misma. Asimismo informar a VIMELAB de la
						contratación de trabajadores de Empresas de Trabajo Temporal (ETT).
					</li>
					<li>
						La ejecución y puesta en prácticas de las recomendaciones de VIMELAB, son de exclusiva
						responsabilidad de la Empresa.
					</li>
				</ol>
				<b>CUARTA.</b> La Empresa notificará a VIMELAB en un plazo no superior a 5 días hábiles, cualquier modificación
				que sufra la información facilitada en la cláusula TERCERA de este documento, mediante documento
				fehaciente.
				<br>
				<br>
				El incumplimiento por parte de la Empresa de la obligación establecida sobre modificación en las
				condiciones de trabajo en la Empresa, especialmente en el caso de falta de información o información
				incompleta o incorrecta, eximirá a VIMELAB de cualquier responsabilidad que de ello pudiera derivarse.
				<br>
				<br>
				<b>QUINTA.</b> VIMELAB como Servicio de Prevención, se obliga frente a la Empresa contratante del servicio
				a tener a su disposición cuantos cuadros técnicos y humanos sean necesarios para el desarrollo de la
				actividad preventiva concertada conforme a la información recibida según la cláusula TERCERA de este
				documento.
				<br>
				<br>
				Los servicios objeto del presente contrato podrán ser prestados por VIMELAB directamente a través de
				su propio personal e instalaciones, o bien mediante la subcontratación con terceros, sean éstos personas
				físicas o jurídicas.
				<br>
				<br>
				<b>SÉXTA.</b> La Empresa reconoce que cualquier datos obtenido por el Servicio de Prevención de VIMELAB
				están sujetos al principio de confidencialidad previsto en el art. 22 de la Ley de Prevención de Riesgos
				Laborales, no siendo requerible ni exigible por la Empresa contratante, ningún dato por ser todos de carácter
				confidencial.
				<br>
				<br>
				<b>SEPTIMA.</b> La falta de pago de cualquier plazo o el incumplimiento de cualquiera de los pactos del presente
				documento podrá ser causa de rescisión del presente contrato.
				<br>
				<br>
				VIMELAB en caso de rescindir el contrato, motivará la causa y la remitirá por correo certificado, quedando, a
				partir de la remisión, relegada de cualquier obligación o responsabilidad de prestar servicio.
				<br>
				<br>
				<b>OCTAVA.</b> La Empresa conociendo las obligaciones que legalmente le impone la Ley de Prevención de
				Riesgos Laborales, asume directamente y bajo su total responsabilidad la ejecución y puesta en práctica de
				las recomendaciones de VIMELAB como Servicio de Prevención Ajeno, dado que ésta carece de facultades
				de dirección de las actividades preventivas a aplicar en el interior de la Empresa.
				<br>
				<br>
				<b>NOVENA.</b> El presente contrato entrará en vigor tras la firma de este contrato y en el momento en que
				la Empresa proceda al pago del importe pactado en este contrato. El contrato tendrá una vigencia de un
				año, siendo revisable en todos sus términos; pudiendo ser indefinidamente prorrogado por periodos de
				igual duración, si ninguna de las dos partes lo denuncia de forma fehaciente y con sesenta días hábiles de
				antelación a la finalización del citado plazo o alguna de sus prórrogas.
				</p>';
				$pdf -> writeHTMLCell(190, 0, 10, 22, $html, 1, 0, 0, true, 'J', true);
			
				$pdf->Output('contrato No.pdf', 'I');
			}
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Ctcont entity.
     *
     * @Route("/new", name="ctcont_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
        {
			$entity = new Ctcont();
			$form   = $this->createForm(new CtcontType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Ctcont entity.
     *
     * @Route("/create", name="ctcont_create")
     * @Method("post")
     * @Template("ScontrolBundle:Ctcont:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
        {
			$entity  = new Ctcont();
			$request = $this->getRequest();
			$form    = $this->createForm(new CtcontType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctcont_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Ctcont entity.
     *
     * @Route("/{id}/edit", name="ctcont_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
        {	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctcont')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctcont entity.');
			}

			$editForm = $this->createForm(new CtcontType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			return array(
				'entity'      => $entity,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
			);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Edits an existing Ctcont entity.
     *
     * @Route("/{id}/update", name="ctcont_update")
     * @Method("post")
     * @Template("ScontrolBundle:Ctcont:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
        {	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctcont')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctcont entity.');
			}

			$editForm   = $this->createForm(new CtcontType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();
				
				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctcont_show', array('id' => $id)));
			}

			return array(
				'entity'      => $entity,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
			);
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Deletes a Ctcont entity.
     *
     * @Route("/{id}/delete", name="ctcont_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Ctcont')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Ctcont entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $entity->getId());
				}
	
				return $this->redirect($this->generateUrl('ctcont'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('ctcont_edit', array('id' => $id)));
			}
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
