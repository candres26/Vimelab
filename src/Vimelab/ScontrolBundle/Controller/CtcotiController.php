<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vimelab\ScontrolBundle\Entity\Ctcoti;
use Vimelab\ScontrolBundle\Form\CtcotiType;
use Vimelab\ScontrolBundle\Tool\Tool;

/**
 * Ctcoti controller.
 *
 * @Route("/ctcoti")
 */
class CtcotiController extends Controller
{
    /**
     * Lists all Ctcoti entities.
     *
     * @Route("/", name="ctcoti")
     * @Template()
     */
    public function indexAction($pag)
    {
		if(Tool::isGrant($this))
		{
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Ctcoti')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Ctcoti')->getPage(20, $pag);

			return array('entities' => $entities, 'pages' => $pages, 'pag' => $pag);	
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
		
    }
    
	public function filterAction($param = '')
    {
        if(Tool::isGrant($this))
        {
            $em = $this->getDoctrine()->getEntityManager();
            $repo = $em->getRepository('ScontrolBundle:Ctcoti');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Ctcoti:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Finds and displays a Ctcoti entity.
     *
     * @Route("/{id}/show", name="ctcoti_show")
     * @Template()
     */
    public function showAction($id, $lv)
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();
			$entity = $em->getRepository('ScontrolBundle:Ctcoti')->find($id);

			if($lv == 1){
				if (!$entity) {
					throw $this->createNotFoundException('Unable to find Ctcoti entity.');
				}

				$deleteForm = $this->createDeleteForm($id);

				return array(
					'entity'      => $entity,
					'delete_form' => $deleteForm->createView(),        );
			}
			else
			{
				$corp = $em->getRepository('ScontrolBundle:Gbcorp')->find('1');
				$empresa = $em->getRepository('ScontrolBundle:Gbempr')->find($id);
				$sucu = $em->getRepository('ScontrolBundle:Ctcont')->getSucursal($entity->getGbempr()->getId(),"PRINCIPAL");
				$corp = $em->getRepository('ScontrolBundle:Gbcorp')->find('1');
				
				$meses = array('Enero','Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
				
				$fecha = $entity->getFecha();
				// create new PDF document
				$pdf = new \Tcpdf_Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				
				// set document information
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('Vimelab');
				$pdf->SetTitle('Contrato de Prestación de Servicios de Prevención');
				$pdf->SetSubject('Contrato');
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
				
				//FORMATO DE PRESUPUESTO SHE
				
				/*$html=
				'
				<p><strong>Empresa: </strong>'.$entity->getGbempr().'</p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><strong>Asunto: </strong>OFERTA DE PRESTACIÓN DEL SERVICIO DE PREVENCIÓN AJENO</p>
				<p><strong>Especialidades Técnicas:</strong> SEGURIDAD EN EL TRABAJO, HIGIENE INDUSTRIAL Y ERGONOMIA PSICOSOCIOLOGIA</p>
				<p><&nbsp></p>

				<p>Distinguidos señores:</p>
				<p><&nbsp></p>
				<p>Nos es muy grato dirigirnos a Ud. para presentarle el PROYECTO - PRESUPUESTO INICIAL del SERVICIO de PREVENCIÓN AJENO, 
				confeccionado con la finalidad de dar respuesta al cumplimiento de la legislación en materia de Prevención de Riesgos Laborales, 
				en las disciplinas de Seguridad en el Trabajo, Higiene Industrial, Ergonomía y Psicosociología Aplicada y Vigilancia de la Salud.</p>

				<p>El presupuesto está calculado basándose en la actividad principal de su Empresa y para un número de   trabajador.</p>

				<p>Esperamos que esta propuesta sea de su interés y de este modo tener la oportunidad de contribuir a que su Empresa se beneficie 
				de nuestra colaboración como Servicio de Prevención Ajeno.</p>

				<p>Quedamos a su disposición para cualquier aclaración o consulta,</p>
				
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				
				<p>Cordialmente,</p>
				
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				
				<p><b>'.$corp->getNombre().'
				<br>SPA: 062-B</b></p>
				
				';	
				// set font
				$pdf->SetFont('dejavusans', '', 10);
				$pdf-> writeHTMLCell(170, 0, 20, 45, $html, 0, 0, 0, true, 'J', true);
				
				$pdf->AddPage();
				$html=
				'
				<p>1. <b>MEMORIA DEL PROYECTO:</b> Secuencia para el desarrollo e implantación del Plan de Prevención de Riesgos Laborales en la empresa de 
				acuerdo con la normativa vigente.</p>
				<table border="2", style="padding: 0.5%">
					<tr>
						<td colspan="2" style="text-align: center"><b>ACTIVIDADES CONCERTACIÓN ANUAL SERVICIO DE PREVENCIÓN AJENO</b></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center; background-color: #979292"><b>ORGANIZACIÓN Y GESTIÓN</b></td>
					</tr>
					<tr>
						<td style="text-align: center; width: 40%"><b>ACCIONES PROPUESTAS</b></td><td style="text-align: center; width: 60%"><b>OBJETIVOS</b></td>
					</tr>
					<tr>
						<td><b>1. Organización Empresarial</b> <i>Artículo 30 Ley 31/95</i></td><td>Reunión informativa con el Responsable de la Empresa.</td>
					</tr>
					<tr>
						<td><b>2. Consulta y Participación trabajadores:</b> <i>Art. 31 Ley 31/95</i></td><td>Consulta e información a los trabajadores en materia preventiva</td>
					</tr>
					<tr>
						<td>
							<b>3. Evaluación de Riesgos</b> <i>Art. 16 Ley 31/95</i>
							<br /><br /><b>Metodología,  Evaluación, Gestión y Control:</b> <i>Gestión Riesgos Laborales.</i>
						</td>
						<td>
							<p>Evaluación y Gestión del proceso preventivo.</p>
							<p>Análisis y definición:</p>
							<ul>
								<li>Empresa - Delegación - Áreas - Puestos de Trabajo</li>
								<li>Trabajador: situación laboral - situación personal - reconocimiento médico - equipos de protección - formación</li>
							</ul>
							<p>Cuestionarios automáticos de evaluación de factores de riesgo, en base a:</p>
							<ul>
								<li>Seguridad</li>
								<li>Higiene: Medioambientales</li>
								<li>Ergonomía y psicosociología Aplicada</li>
							</ul>
							<p>Análisis y asesoramiento para la planificación del Plan de Prevención.</p>
						</td>
					</tr>
					<tr>
						<td>
							<b>4. Formación/ Información</b> <i>Art. 18 y 19 Ley 31/95</i>
						</td>
						<td>
							<p>Formación a nivel de trabajadores: Normas de Prevención - Riesgo en su puesto de trabajo.</p>
							<p>Tríptico informativo genérico de cómo actuar en caso de emergencia.</p>
						</td>
					</tr>
					<tr>
						<td>
							<b>5. Medidas de emergencia</b> <i>Art. 20 Ley 31/95</i>    
						</td>
						<td>
							<p>Asesoramiento de las Medidas de Emergencias, implica los siguientes análisis:</p>
							<ol>
							<li>Análisis de situaciones de emergencia. Planes de emergencia</li>
							<li>Instalaciones de evacuación y emergencias: Señalización, iluminación,....</li>
							<li>Equipos de primeros auxilios / botiquines</li>
							<li>Elaboración del inventario de medios contra incendios.</li>
							<li>Descripción de la ubicación de los medios contra incendios y vías de evacuación.</li>
							</ol>
						</td>
					</tr>
					<tr>
						<td>
							<b>6. Trabajo Temporal</b> <i>Art. 28 Ley 31/95</i>
						</td>
						<td>
							<p>Establecer obligaciones ETT - Empresa Usuaria.</p> 
							<p>Documentación pertinente.</p>
						</td>
					</tr>
					<tr>
						<td>
							<b>7. Contratas y subcontratas</b> <i>Art. 24 Ley 31/95</i>
						</td>
						<td>
							<p>Coordinación de actividades y especificar obligaciones</p>
						</td>
					</tr>
					<tr>
						<td>
							<b>8. Documentación</b> <i>Art. 23 Ley 31/95</i>
						</td>
						<td>
							<p>Plan documental a disposición de la autoridad laboral competente.</p>
							<p>Documentación en materia preventiva aplicable.</p>
						</td>
					</tr>
				</table>
				<p><b>Relación de actividades no contempladas en este presupuesto:</b></p>
				<ul style="text-align: justify">
					<li>Elaboración de:</li>
						<ul style="text-align: justify">
							<li>Los estudios y planes de seguridad y salud contemplados en las obras de construcción, según R.D. 1627/97</li>
							<li>Ejecución de la coordinación de la Seguridad en obras de construcción.</li>
							<li>Puesta en conformidad de las máquinas, según R.D- 1215/97</li>
							<li>En relación con las Medidas higiénicas que, como resultado del Plan Preventivo, fueran necesarias efectuar, no se contemplan las horas técnicas de obtención de muestras ni los costes de laboratorio.</li>
						</ul>
					<li>Las actividades enumeradas anteriormente, así como cualquier otra no prevista que se presente  en el transcurso de la ejecución del Plan Preventivo, podrán realizarse previo acuerdo entre las partes.</li>
				</ul>

				<p><b>2.- SERVICIOS OBJETO DEL CONTRATO</b></p>
				
				<table border="2" style="padding: 0.5%">
					<tr>
						<td style="width: 40%"><b>Modalidad</b></td><td style="width: 60%">Especialidades Técnicas S.H.E. (Disciplinas)<br /> Concierto Anual.</td>
					</tr>
					<tr>
						<td><b>Empresa</b></td><td></td>
					</tr>
					<tr>
						<td style="vertical-align: middle"><b>Trabajadores</b></td><td>__________<br />(en caso fluctuaciones en  la plantilla de la empresa se efectuará el ajuste correspondiente a los costes indicados)</td>
					</tr>
				</table>
				
				<p><b>Disciplinas:</b></p>
				<ul>
					<li>SEGURIDAD EN EL TRABAJO</li>
					<li>HIGIENE INDUSTRIAL</li>
					<li>ERGONOMÍA Y PSICOSOCIOLOGÍA APLICADA</li>
				</ul>
				<p><b>Prestaciones:</b></p>
				<ul>
					<li>Evaluación Inicial de Riesgos por puesto de trabajo. Revisión anual.</li>
					<li>Establecimiento de las Medidas Correctoras.</li>
					<li>Análisis e investigación de las causas y factores determinantes de los accidentes de trabajo y
					   enfermedades profesionales.</li>
					<li>Documentación básica sobre la legislación aplicable.</li>
					<li>Formación/información a los trabajadores.</li>
					<li>Documentación para la comunicación a los trabajadores del concierto con VIMELAB, S.L., 
					   Servicio  de Prevención Ajeno de Riesgos Laborales.</li>
					<li>Información: Tríptico de como actuar en caso de emergencia para cada trabajador.</li>
					<li>Asesoramiento para la organización de la actividad preventiva:</li>
						<ul> 
							<li>Reuniones con la dirección y/o trabajadores encargados</li>
							<li>Asesoramiento en el trazado del plan de emergencia</li>
						</ul>
					<li>Verificación de las medidas correctoras establecidas en el Plan de Prevención de la Evaluación
						Inicial de Riesgos.</li>
					<li>Consultas en materia preventiva.</li>
				</ul>

				<p><b>3. DATOS ECONÓMICOS</b></p>
				<table border="2" style="padding: 0.5%">
					<tr style="text-align: center">
						<td>ACTIVIDAD</td><td>IMPORTE</td><td>IVA</td><td>VENCIMIENTO</td>
					</tr>
					<tr align="center">
						<td>PREVENCION SHE</td><td>'.$entity->getTotal().'</td><td>'.$entity->getIva().'% IVA no incluido</td><td>'.$entity->getVencimiento().'</td>
					</tr>
				</table>
				
				<p><b>CONDICIONES ECONOMICAS</b></p>	
					<ol type="a">
						<li>
							<p>Condiciones de pago:</p>
							<p>El pago de las Especialidades Técnicas (SHE) se realizará en el momento de la firma de los contratos de servicios entre las partes.</p>
						</li>
						<li>
							<p>Validez de la oferta:</p>
							<p>La presente oferta de servicios tendrá una vigencia de treinta días desde la fecha de su emisión.</p>
						</li>
					</ol>
				<p>En caso que se acepte este presupuesto, por favor enviar cumplimentada esta hoja, para realizar el contrato.</p>
				<p><b>DATOS DE LA EMPRESA (DOMICILIO SOCIAL A EFECTOS FISCALES).</b></p>
				<table style="padding: 0.5%" rules="none" border="1">
					<tr>
						<td style="width: 70%">Razón Social:   '.$entity->getGbempr().'</td><td colspan="2" style="width: 30%">No. Trab:  '. $entity->getTrabajadores() .'</td>
					</tr>
					<tr>
						<td style="width: 30%">CIF: '.$empresa->getIdentificacion().'</td><td style="width: 70%">Actividad: '.$empresa->getGbcnae().'</td>
					</tr>
					<tr>
						<td colspan="2">Domicilio:   '.$sucu->getDireccion().'</td>
					</tr>
					<tr>
						<td colspan="2">Código Postal y Localidad:</td>
					</tr>
					<tr>
						<td style="width: 33%">Teléfono: '.$sucu->getTelefono().'</td><td style="width: 33%">Fax: '.$sucu->getFax().'</td><td style="width: 34%">E-mail: '.$sucu->getCorreo().'</td>
					</tr>
				</table>
				
				<p><b>DATOS DEL REPRESENTANTE DE LA EMPRESA</b></p>
				
				<table border="1" style="padding: 3%">
					<tr>
						<td>
							D/Dña <b>'.$empresa->getRplegal().'</b>, con NIF <b>'.$empresa->getIdentrplegal().'</b> , en su
							condición de _____[               ]_____________de la empresa, con poder para la suscripción
							del presente documento.
						</td>
					</tr>
				</table>
				<p><&nbsp></p>
				<table border="1" style="padding: 2%">
					<tr>
						<td style="width: 20%">Modalidad: </td><td style="width: 80%">'.$entity->getModalidad().'</td>
					</tr>
				</table>
				<p><b>DOMICILIACIÓN BANCARIA:</b> Pueden domiciliar el pago remitiéndonos debidamente cumplimentada esta hoja 
				al fax Tel: 93.449.31.61 o bien al correo: vimelab@vimelab.com.</p>
				<table border="1"  style="padding: 0.7%">
					<tr>
						<td style="width: 40%">EMPRESA:</td><td style="width: 60%"></td>
					</tr>
					<tr>
						<td>BANCO:</td><td></td>
					</tr>
					<tr>
						<td>No. Cuenta - Entidad (4 dígitos):</td><td></td>
					</tr>
					<tr>
						<td>Sucursal (4 dígitos):</td><td></td>
					</tr>
					<tr>
						<td>Dígitos de Controll (2 dígitos):</td><td></td>
					</tr>
					<tr>
						<td>No. cuenta corriente (10 dígitos):</td><td></td>
					</tr>
				</table>
				
				<p>De acuerdo con lo establecido en la Ley 16/2009 de Servicio de Pago, les rogamos nos devuelvan la 
				siguiente autorización debidamente cumplimentada.</p>
				<h4 align="center">AUTORIZACIÓN CUENTA BANCARIA PARA GIRO DE RECIBOS</h4>
				
				<table border="1" style="padding: 0.5%">
					<tr>
						<td>* D/Dña:</td>
					</tr>
					<tr>
						<td>En representación de:</td>
					</tr>
					<tr>
						<td>Con CIF/NIF:</td>
					</tr>
					<tr>
						<td style="width: 70%">Domicilio:</td><td style="width: 30%">C.P:</td>
					</tr>
					<tr>
						<td style="width: 60%">Población:</td><td style="width: 40%">Provincia:</td>
					</tr>
				</table>
				
				<h4 align="center">AUTORIZA</h4>

				<p>A la empresa '.$corp->getNombre().', con CIF '.$corp->getIdentificacion().' a que desde la presente fecha y con carácter indefinido, 
				salvo modificación por escrito, a girar en la cuenta especificada en esta autorización, los recibos que se 
				originen como consecuencia de la relación comercial entre ambas compañías.</p>

				<p>De acuerdo con lo previsto en 23.1 de la Ley 16/2009 de Servicios de Pago se acuerdo expresamente la no 
				aplicación de lo dispuesto en el artículo 33, limitándose el plazo para la devolución de los recibos a siete 
				días desde su presentación.</p>
				
				<h4 align="center">DATOS Y CONFIRMACIÓN DE LA ENTIDAD BANCARIA</h4>
				
				<p>Nombre de la Entidad Bancaria:</p>
				<p>Nº de cuenta bancaria:………………../……………../……/…………………………………………….</p>

				<p>Firma del Representante de la Empresa y Sello de la Empresa</p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p align="right">El '.$fecha->format('d').' de '.$meses[intval($fecha->format('m'))-1].' de '.$fecha->format('Y').' </p>
				
				<p><&nbsp></p>
		
				<table style="padding: 0.4%; font-size: 0.8em; align: left">
					<tr>
						<td style="width: 20%">Puede enviárnosla:</td>
						<td style="width: 80%">
							<p>Por correo ordinario: c/ Pi i Margall 25 esc. B, entresuelo 1ª – 08024 Barcelona</p>
							<p>Por correo electrónico: vimelab@vimelab.com                Por fax: 93.334.60.72</p>
						</td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2">* Confirma el firmante que tiene poderes suficientes para la firma de la presente autorización.</td>
					</tr>
				</table>
				';*/
				//FORMATO DE PRESUPUESTO VIGILANCIA DE LA SALUD
				
				$html=
				'
				<table border="2" style="padding: 0.6%">
					<tr>
						<td>
							<h3 align="center">PRESUPUESTO DE PRESTACION DE SERVICIOS<br />
							SPA VIMELAB,S.L.<br />
							VIGILANCIA DE LA SALUD</h3>
						</td>
					</tr>
				</table>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<h3 align="center">EMPRESA</h3>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<table border="1" style="padding: 0.5%">
					<tr>
						<td align="center"><b>'.$entity->getGbempr().'</b></td>
					</tr>
				</table>
				<p><&nbsp></p>
				<p><&nbsp></p>
				<table border="1" style="padding: 0.5%">
					<tr>
						<td>Persona de Contacto: </td><td>Población: </td>
					</tr>
					<tr>
						<td>Dirección: </td><td>Actividad: </td>
					</tr>
					<tr>
						<td>Teléfono: </td><td>E-mail: </td>
					</tr>
					<tr>
						<td>Fax: </td><td>No. de Trabajadores: </td>
					</tr>
				</table>
				<p><&nbsp></p>
				<table border="1" style="padding: 0.5%">
					<tr>
						<td>Especialidad: Vigilancia de la salud</td>
					</tr>
				</table>
				<p><&nbsp></p>
				<p><&nbsp></p>
				
				<p><b>Vigilancia de la Salud:</b></p> 

				<p><b>Objetivos:</b></p>
				<ol>
					<li>Planificación de la Vigilancia de la Salud.</li>
					<li>Exámenes de salud específicos, según protocolo médico.</li>
					<li>Formación elemental de primeros auxilios (3 h.)</li>
					<li>Campañas de vacunación.</li>
					<li>Estudios epidemiológicos.</li>
				</ol>
				<p><&nbsp></p>
				<p><b>Funciones:</b></p> 
				<ol style="text-align: justify">
					<li><p>Reconocimiento específico inicial para cada trabajador por puesto de trabajo (Protocolos específicos)</p>

						<p>Examen de la Salud:</p>
						<ul>
							<li>Historia Clínica Laboral</li>
							<li>Anamnesis</li>
							<li>Exploración clínica y control biológico</li>
							<li>Estudios complementarios en función de los riesgos inherentes al trabajo</li>
							<li>Descripción detallada del puesto de trabajo</li>
							<li>Tiempo de permanencia en el mismo</li>
							<li>Medidas de protección adoptadas</li>
						</ul>
					</li>
					<p><&nbsp></p>
					<li>Información y seguimiento</li>
					<p><&nbsp></p>
					<li><p>Elaboración de documentación sanitaria.</p>
					<ul>
						<li>Informe médico</li> 
						<li>Listado de aptos</li>
						<li>Relación de accidentes de trabajo</li>
						<li>Relación de enfermedades profesionales</li>
						<li>Informe global de los controles del estado de salud de los trabajadores, estudio epidemiológico anual.</li>
						<li>Memoria anual de actividades sanitarias del servicio de prevención</li>
					</ul>
					</li>
					<p><&nbsp></p>
					<li>Información a las autoridades sanitarias.</li>
				</ol>
				
				<h4 align="center">CONTENIDO DEL RECONOCIMIENTO MEDICO DE VIGILANCIA DE LA SALUD</h4>
				
				<h5>I NIVEL PREVENTIVO:</h5>

				<h5>ANAMNESIS</h5>
				Recogida de antecedentes patológicos, fisiológicos y laborales, así como de hábitos tóxicos, mediante Cuestionario Auto cumplimentado.

				<h5>BIOMETRIA</h5>
				<ul>
					<li>Edad.</li>
					<li>Peso y talla.</li>
				</ul>

				<h5>EXPLORACION MÉDICA</h5>
				<ul>
					<li>Exploración de boca y garganta.</li>
					<li>Exploración de piel y mucosas.</li>
					<li>Exploración del Sistema Nervioso, Reflejos Osteotendinosos y Pupilas.</li>
					<li>Otoscopia bilateral.</li>
					<li>Auscultación respiratoria.</li>
					<li>Palpación abdominal.</li>
					<li>Puño percusión lumbar.</li>
					<li>Tensión arterial y Frecuencia cardíaca.</li>
				</ul>
				
				<h5>ANALITICA DE SANGRE</h5>
				<table>
					<tr>
						<td>
						<ul>
							<li>Hemoglobina.</li>
							<li>Hematocrito.</li>
							<li>Cifra de Hematíes.</li>
							<li>Volumen Corpuscular medio.</li>
							<li>Concentración de hemoglobina corpuscular media.</li>
							<li>Cifra de Leucocitos.</li>
							<li>Fórmula leucocitaria. </li>
						</ul>
						</td>
						<td>
						<ul>
							<li>Colesterol y Triglicéridos.</li>
							<li>Glucosa.</li>
							<li>Creatinina.</li>
							<li>Transaminasas G.O.T. y G.P.T.</li>
							<li>Gamma GT.</li>
							<li>Acido Úrico.</li>
							<li>(Sideremia si se detectan anomalías).</li>
						</ul>
						</td>
					</tr>
				</table>

				<h5>ANALITICA DE ORINA:</h5>
				<ul>
					<li>Ph.</li>
					<li>Glucosa.</li>
					<li>Proteínas.</li>
					<li>Sangre.</li>
					<li>Cuerpos cetónicos y Nitritos.</li>
					<li>Bilirrubina y Urobilinógeno.</li>
					<li>(Sedimento si se detectan anomalías)</li>
				</ul>

				<h5>ESPIROMETRIA:</h5>
				Capacidad Vital Forzada.

				<h5>CONTROL VISION:</h5>
				Estudio de Agudeza Visual lejana y cercana de forma mono y binocular.

				<h5>AUDIOMETRIA:</h5>
				<p>Audiometría tonal laminar, con estudio de los umbrales mínimos de audición para la vía aérea en las frecuencias de 500, 1000, 
				2000, 3000, 4000, 6000 y 8000 Hz., monoauralmente, según R.D. 1316/89 de Protección de los trabajadores frente a los riesgos 
				derivados de la exposición al ruido durante el trabajo.</p>

				<h5>ELECTROCARDIOGRAMA: A TODO EL PERSONAL.</h5>

				<h5>PRUEBAS COMPLEMENTARIAS:</h5>
				<ul>
					<li>Radiografía Tórax.</li>
					<li>Espirometría basal y prueba broncodilatación.</li>
					<li>Análisis especiales en sangre (según protocolo).</li>
					<li>Análisis de Orina:    	
						<ul>
							<li>Urinocultivo negativo.</li>
							<li>Urinocultivo positivo.</li>
						</ul>
					</li>
					<li>Vacunaciones:       
						<ul>
							<li>Vacuna Antigripal</li>
							<li>Vacuna antitetánica</li>
							<li>Vacuna antihepatitis A</li>
							<li>Vacuna antihepatitis B</li>
						</ul>
					</li>
				</ul>
				<p style="font-size: 0.7em"><i>Estas pruebas no se contemplan en el RECONOCIMIENTO MEDICO anteriormente detallado, por lo que su 
				precio quedará al margen del presupuesto inicial.</i></p>
				
				<p>El presente presupuesto es para la realización de todas las actividades relacionadas con la Vigilancia de la Salud en su centro 
				de trabajo y para un número total de_____horas anuales y '.$entity->getTrabajadores().' trabajadores de nivel preventivo bajo.</p>

				<p>Los Reconocimientos se realizarán en nuestra Unidad Básica de Salud o bien desplazando nuestra Unidad Móvil al centro de trabajo. 
				El cual tendrá un coste de 150.25 €, Si el número de trabajadores es menor de 15.</p>
				
				<h4 align="center">CONDICIONES ECONÓMICAS</h4>
				
				<ol type="a">
					<li>
						<p>Precios de los servicios</p>
						<table border="1" style="padding: 0.5%; width: 70%">
							<tr>
								<td>Número de trabajadores: </td><td></td>
							</tr>
							<tr>
								<td>Centros de trabajo: </td><td></td>
							</tr>
						</table>
						<p><&nbsp></p>
						<p><&nbsp></p>
						<table border="1" style="padding: 0.5%; width: 70%">
							<tr>
								<td style="width: 50%">Total Vigilancia de la Salud: </td><td style="width: 25%"></td><td style="width: 25%">€/año*</td>
							</tr>
						</table>
						<table style="padding: 0.5%; width: 70%">
							<tr>
								<td style="width: 25%"></td><td style="width: 25%"></td><td align="right" style="width: 50%">*IVA 21% no incluido.</td>
							</tr>
						</table>
						<p><&nbsp></p>
						<table border="1" style="padding: 0.5%; width: 70%">
							<tr>
								<td>Servicio Médico: </td><td>€</td><td>C/ Reconocimiento</td>
							</tr>
						</table>
					<p>Las pruebas especiales complementarias que indique el protocolo, se facturarán fuera del presupuesto establecido.</p>
					</li>
					
					<li>
					<p>Condiciones de pago:</p>

					<p>El pago de la Vigilancia de Salud, se realizará en el momento de la firma de los contratos de servicios entre las partes.  
					Y los reconocimientos médicos una vez realizados.</p>
					
					</li>

					<li>

					<p>Validez de la oferta:</p>

					<p>La presente oferta de servicios tendrá una vigencia de treinta días desde la fecha de su emisión.</p>
					
					</li>
				</ol>
				
				BARCELONA, '.$meses[intval($fecha->format('m'))-1].' de 2013.					VºBº
				';
				// set font
				$pdf->SetFont('dejavusans', '', 10);
				$pdf-> writeHTMLCell(170, 0, 20, 45, $html, 0, 0, 0, true, 'J', true);
			
				$pdf->Output('presupuesto No.pdf', 'I');
			}
		}
		else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to create a new Ctcoti entity.
     *
     * @Route("/new", name="ctcoti_new")
     * @Template()
     */
    public function newAction()
    {
		if(Tool::isGrant($this))
		{	
			$entity = new Ctcoti();
			$form   = $this->createForm(new CtcotiType(), $entity);

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Creates a new Ctcoti entity.
     *
     * @Route("/create", name="ctcoti_create")
     * @Method("post")
     * @Template("ScontrolBundle:Ctcoti:new.html.twig")
     */
    public function createAction()
    {
		if(Tool::isGrant($this))
		{	
			$entity  = new Ctcoti();
			$request = $this->getRequest();
			$form    = $this->createForm(new CtcotiType(), $entity);
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctcoti_show', array('id' => $entity->getId())));
				
			}

			return array(
				'entity' => $entity,
				'form'   => $form->createView()
			);
		}else
			return $this->render("ScontrolBundle::alertas.html.twig");
    }

    /**
     * Displays a form to edit an existing Ctcoti entity.
     *
     * @Route("/{id}/edit", name="ctcoti_edit")
     * @Template()
     */
    public function editAction($id)
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctcoti')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctcoti entity.');
			}

			$editForm = $this->createForm(new CtcotiType(), $entity);
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
     * Edits an existing Ctcoti entity.
     *
     * @Route("/{id}/update", name="ctcoti_update")
     * @Method("post")
     * @Template("ScontrolBundle:Ctcoti:edit.html.twig")
     */
    public function updateAction($id)
    {
		if(Tool::isGrant($this))
		{	
			$em = $this->getDoctrine()->getEntityManager();

			$entity = $em->getRepository('ScontrolBundle:Ctcoti')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Ctcoti entity.');
			}

			$editForm   = $this->createForm(new CtcotiType(), $entity);
			$deleteForm = $this->createDeleteForm($id);

			$request = $this->getRequest();

			$editForm->bindRequest($request);

			if ($editForm->isValid()) {
				$em->persist($entity);
				$em->flush();

				Tool::logger($this, $entity->getId());
				return $this->redirect($this->generateUrl('ctcoti_show', array('id' => $id)));
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
     * Deletes a Ctcoti entity.
     *
     * @Route("/{id}/delete", name="ctcoti_delete")
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
					$entity = $em->getRepository('ScontrolBundle:Ctcoti')->find($id);
	
					if (!$entity) {
						throw $this->createNotFoundException('Unable to find Ctcoti entity.');
					}
	
					$em->remove($entity);
					$em->flush();
					
					Tool::logger($this, $entity->getId());
				}
	
				return $this->redirect($this->generateUrl('ctcoti'));
			}
			catch(\Exception $ex)
			{
				$sesion = $this->getRequest()->getSession();
				$sesion->setFlash('MsgVar', 'Imposible Borrar esta entidad, integridad referencial!');
				
				return $this->redirect($this->generateUrl('ctcoti_edit', array('id' => $id)));
			}
		}else
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
