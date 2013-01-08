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
    public function indexAction($pag)
    {
        if(Tool::isGrant($this))
        {
			$em = $this->getDoctrine()->getEntityManager();
			
			$pages = $em->getRepository('ScontrolBundle:Ctcont')->getCountPages(20);
			$pag = $pag < 1 ? 1 : $pag;
			$pag = $pag > $pages ? $pages: $pag;
			
			$entities = $em->getRepository('ScontrolBundle:Ctcont')->getPage(20, $pag);

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
            $repo = $em->getRepository('ScontrolBundle:Ctcont');
            $entities = $repo->getFilter($param);

            return $this->render("ScontrolBundle:Ctcont:index.html.twig", array('entities' => $entities, 'pages' => 1, 'pag' => 1));
        }
        else
            return $this->render("ScontrolBundle::alertas.html.twig");
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
				$meses = array('Enero','Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
				
                			
			    $sucu = $em->getRepository('ScontrolBundle:Ctcont')->getSucursal($entity->getGbempr()->getId(),"PRINCIPAL");
				
				$ciud = $sucu->getGbciud();
					
				
				$corp = $em->getRepository('ScontrolBundle:Gbcorp')->find('1');
				
				$ciudcorp = $corp->getGbciud();
				
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
				
				// ---------------------------------------------------------
				$fecha = $entity->getFecha();
				$fechafin = $entity->getFin();
				$iva = (intval($entity->getIva()))/1;
			
				// add a page
				$pdf->AddPage();
				$html='<h3 align="right">Contrato No. '.$id.' </h3>';
				$pdf->SetFont('helvetica','',10);
				$pdf -> writeHTMLCell(170, 0, 20, 17, $html, 0, 0, 0, true, 'J', true);
				$html = '<h4 align="right">CONTRATO DE PRESTACIÓN DE SERVICIOS DE PREVENCIÓN</h4>
				<p>En '.$entity->getFirmagbciud().', a '.$fecha->format('d').' de '.$meses[intval($fecha->format('m'))-1].' de ' .$fecha->format('Y').' </p>
				<h3 align="center">REUNIDOS</h3>
				<p>
				De una parte, '.$entity->getNombrecontratante().', mayor de edad, con N.I.F '.$entity->getIdentcontratante().' en representación de
				<b>'.$entity->getGbempr()->getNombre().'</b> en adelante Empresa, con domicilio social en '.$sucu->getDireccion().', CP '.$ciud->getCodigo().' '.$ciud->getNombre().', 
				provista de CIF Nº '.$entity->getGbempr()->getIdentificacion().'. Tel.: '.$sucu->getTelefono().', E-mail: '.$sucu->getCorreo().'.</p>
				<p>
				Y de otra, '.$entity->getNombrecontratista().', con NIF '.$entity->getIdentcontratista().' quien actúa en calidad de
				'.$entity->getCargocontratista().' de la entidad, '.$corp->getNombre().', en adelante VIMELAB, con 
				domicilio social en '.$corp->getDireccion().', '. $ciudcorp->getNombre(). ', con '.$corp->getIdentificacion().'.
				</p>
				<p>
				Ambas partes, en el concepto en que intervienen, se reconocen la necesaria capacidad legal para contratar
				y obligarse, y de común acuerdo, suscriben el presente concierto en materia de servicio de prevención de
				riesgos laborales, y al efecto:
				</p>
				<h3 align="center">MANIFIESTAN</h3>
				<p>
				<b>I.</b> Que VIMELAB es una Entidad acreditada por el Departament de Treball de la Generalitat de Catalunya
				como Servicio de Prevención Ajeno, acreditación SP-062-B.
				</p>
				<p>
				<b>II.</b> Que <b>'.$entity->getGbempr()->getNombre().'</b>, se halla interesada en
				contratar para sus centros de trabajo, que se especificarán en este contrato, los servicios de <b>[Seguridad,
				Higiene, Ergonomia i Psicosociologia Aplicada, i Vigilancia de la Salud]</b> que presta VIMELAB, y
				estando asimismo esta igualmente interesada, ambas partes acuerdan suscribir el presente contrato sujeto
				a las siguientes:
				</p>
				<h4>CLÁUSULAS:</h4>
				<p>
				<b>PRIMERA.</b> Que la Empresa concierta con VIMELAB la prestación del Servicio de Prevención Ajeno para
				sus centros de trabajo y trabajadores, que se detallarán en el correspondiente Anexo, y para los que se
				desarrollarán la actividad preventiva descrita en los anexos siguientes:
				</p>
				<p>
				ANEXO I. SEGURIDAD - HIGIENE Y ERGONOMÍA.
				ANEXO II. VIGILANCIA DE LA SALUD.
				ANEXO III. CENTROS CONTRATADOS Y CONDICIONES ECONÓMICAS.
				</p>
				<ul>
					<li>VIMELAB realizará su actividad de acuerdo con el número de trabajadores especificados en el presente
					contrato. (en caso de fluctuaciones del número de trabajadores, se efectuará el ajuste correspondiente a
					los costes indicados).</li>
				</ul>	
				<p>				
				<b>SEGUNDA.</b> La prestación de servicios y las recomendaciones que se deriven de la valoración de los riesgos
				existentes, se acomodará a los principios de la acción preventiva descritos en el art. 15 de la Ley 31/1995,
				de 9 de noviembre.
				</p>
				<p>
				<b>TERCERA.</b> En cualquier caso, y a fin de cumplir con el contenido contractual de este documento, la
				Empresa vendrá obligada frente al Servicio de Prevención a:
				</p>
				<ol align="justify">
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
				<p>
				<b>CUARTA.</b> La Empresa notificará a VIMELAB en un plazo no superior a 5 días hábiles, cualquier modificación
				que sufra la información facilitada en la cláusula TERCERA de este documento, mediante documento
				fehaciente.
				</p>
				<p>
				El incumplimiento por parte de la Empresa de la obligación establecida sobre modificación en las
				condiciones de trabajo en la Empresa, especialmente en el caso de falta de información o información
				incompleta o incorrecta, eximirá a VIMELAB de cualquier responsabilidad que de ello pudiera derivarse.
				</p>
				<p>
				<b>QUINTA.</b> VIMELAB como Servicio de Prevención, se obliga frente a la Empresa contratante del servicio
				a tener a su disposición cuantos cuadros técnicos y humanos sean necesarios para el desarrollo de la
				actividad preventiva concertada conforme a la información recibida según la cláusula TERCERA de este
				documento.
				</p>
				<p>
				Los servicios objeto del presente contrato podrán ser prestados por VIMELAB directamente a través de
				su propio personal e instalaciones, o bien mediante la subcontratación con terceros, sean éstos personas
				físicas o jurídicas.
				</p>
				<p>
				<b>SÉXTA.</b> La Empresa reconoce que cualquier datos obtenido por el Servicio de Prevención de VIMELAB
				están sujetos al principio de confidencialidad previsto en el art. 22 de la Ley de Prevención de Riesgos
				Laborales, no siendo requerible ni exigible por la Empresa contratante, ningún dato por ser todos de carácter
				confidencial.
				</p>
				<p>
				<b>SEPTIMA.</b> La falta de pago de cualquier plazo o el incumplimiento de cualquiera de los pactos del presente
				documento podrá ser causa de rescisión del presente contrato.
				</p>
				<p>
				VIMELAB en caso de rescindir el contrato, motivará la causa y la remitirá por correo certificado, quedando, a
				partir de la remisión, relegada de cualquier obligación o responsabilidad de prestar servicio.
				</p>
				<p>
				<b>OCTAVA.</b> La Empresa conociendo las obligaciones que legalmente le impone la Ley de Prevención de
				Riesgos Laborales, asume directamente y bajo su total responsabilidad la ejecución y puesta en práctica de
				las recomendaciones de VIMELAB como Servicio de Prevención Ajeno, dado que ésta carece de facultades
				de dirección de las actividades preventivas a aplicar en el interior de la Empresa.
				</p>
				<p>
				<b>NOVENA.</b> El presente contrato entrará en vigor tras la firma de este contrato y en el momento en que
				la Empresa proceda al pago del importe pactado en este contrato. El contrato tendrá una vigencia de un
				año, siendo revisable en todos sus términos; pudiendo ser indefinidamente prorrogado por periodos de
				igual duración, si ninguna de las dos partes lo denuncia de forma fehaciente y con sesenta días hábiles de
				antelación a la finalización del citado plazo o alguna de sus prórrogas.
				</p>
				<h4>DÉCIMA. ANEXOS</h4>
				
				<h4>ANEXO I. SEGURIDAD - HIGIENE - ERGONOMÍA. RELACIÓN DE ACTIVIDADES A PRESTAR POR VIMELAB COMO SERVICIO DE PREVENCIÓN</h4>

				<h4>1. ACTIVIDADES SHE</h4>
				<p>
				'.$corp->getNombre().', asume la realización, como servicio de prevención ajeno, de la actividad de Seguridad en el
				Trabajo, Higiene Industrial y Ergonomía y Psicosociología Aplicada y que consistirán en la realización de las
				siguientes actuaciones:
				</p>
				<ul align="justify">
					<li>Evaluación Inicial de Riesgos por puesto de trabajo. Revisión anual (en caso de prorrogarse el contrato)</li>
					<li>Establecimiento de la Planificación Preventiva.</li>
					<li>Análisis e investigación de las causas y factores determinantes de los accidentes de trabajo y
					enfermedades profesionales.</li>
					<li>Formación/información a los trabajadores.</li>
					<li>Asesoramiento para la organización de la actividad preventiva.</li>
					<li>Planes de emergencia.</li>
					<p><b>Relación de actividades no contempladas en este contrato:</b></p>
					<li>Elaboración de:</li>
						<ul align="justify">
							<li>Los estudios y planes de seguridad y salud contemplados en las obras de construcción, según R.D. 1627/97.</li>
							<li>Ejecución de la coordinación de la Seguridad en obras de construcción.</li>
							<li>Puesta en conformidad de las máquinas, según R.D. 1215/97.</li>
							<li>En relación con las medidas higiénicas y ergonómicas que, como resultado de la evaluación de
							riesgos, fueran necesarias efectuar, no se contemplan las horas técnicas de obtención de muestras
							ni los costes de laboratorio.</li>
						</ul>
				</ul>	
				
				<p>	
				Las actividades enumeradas anteriormente, así como cualquier otra no prevista que se presente en el
				transcurso de la ejecución del Plan Preventivo, podrán realizarse previo acuerdo entre las partes.
				</p>
				
				<h4>ANEXO II VIGILANCIA DE LA SALUD</h4>

				<p>Consistirá en la realización de las actuaciones siguientes:</p>
				<ol type = "a"  align="justify">
					<li>Asesorar a la empresa en cuanto a la idoneidad, contenido y periodicidad de las evaluaciones
					de salud en formato de reconocimientos médicos en función de los riesgos inherentes al puesto
					de trabajo, de las causas conocidas de absentismo de la normativa vigente, y de los protocolos
					específicos elaborados por el Ministerio de Sanidad y Consumo y las comunidades autónomas. Este
					asesoramiento únicamente podrá ser realizado por VIMELAB una vez recibida la Evaluación de
					riesgos general y por puesto de trabajo, y la información solicitada.</li>
					
					<li>VIMELAB realizará tantos reconocimientos médicos específicos de vigilancia de la salud como número de
					trabajadores vienen especificados en el presente contrato.</li>
					
					<li>
					Los reconocimientos médicos pueden incluir las pruebas siguientes:
						<ul align="justify">
							<li>Elaboración de la Historia Clínica Laboral.</li>
							<li>Exploración clínica básica.</li>
							<li>Electrocardiograma a criterio del médico.</li>
							<li>Espirometría a criterio del médico.</li>
							<li>Audiometría.</li>
							<li>Control de la agudeza visual.</li>
						</ul>
					</li>
					
					<li>
					La analítica básica en sangre y orina incluirá:
						<ul>
							<li>Hemograma</li>
							<li>Fórmula leucocitaria</li>
							<li>V.S.G.</li>
							<li>Bioquímica: Glicemia, ácido úrico, urea, colesterol. VASO, GPT, GGT.</li>
							<li>Orina : PH, albúmina, glucosa, acetona, sedimento.</li>
						</ul>
					<p align="justify">Pruebas de control biológico, que incluirán un perfil hematológico y bioquímico básicos, a saber: hemograma
					completo, velocidad de eritrosedimentación, fórmula leucocitaria, glucemia, colesterol total, creatinina,
					uricèmia, GPT, GGT. VASO, y análisis básico de orina.</p>
					</li>
					
					<li>El presente contrato no incluye el coste de las pruebas de control biológico no comprendidas el perfil
					básico mencionado, ni lo otros pruebas exploradoras o diagnósticas excepto las mencionadas en el apartado 
					del presente anexo, que en todo caso serán presupuestadas y facturadas a banda.</li>
					
					<li>De los reconocimientos médicos el empresario y las personas o órganos con responsabilidad en materia
					de prevención serán informados de las conclusiones que se deriven de los mismos en relación con la aptitud
					del trabajador para el ejercicio del puesto de trabajo o con la necesidad introducir o mejorar las medidas de
					protección y prevención
					</li>
					
					<li>Los resultados serán facilidades a cada trabajador, y no podrán ser conocidos por el empresario sin el
					consentimiento previo de aquel.</li>
					
					<li>VIMELAB tendrá que tener conocimiento de las situaciones de ausencia por incapacidad temporal para
					lo cual, la empresa comunicará a los servicios médicos de VIMELAB las bajas por I.T. con una periodicidad
					mensual u otra que en función de las condiciones de la empresa se determine, al único efecto de poder
					identificar cualquier relación entre la causa de enfermedad o de ausencia de riesgos para la salud que
					puedan presentarse a los puestos de trabajo.</li>
					
					<li>VIMELAB efectuará un análisis de la información obtenida, con criterios epidemiológicos, efectuando, si
					es necesario, propuesta de introducción o mejora de las medidas de protección o prevención.</li>
					
					<li>VIMELAB estudiará y valorará especialmente los riesgos que puedan afectar las trabajadoras en situación
					de embarazo y parte reciente, a los menores de edad y a los trabajadores especialmente sensibles a
					determinados riesgos, y propondrá las medidas preventivas adecuadas.</li>
					
					<li>Se realizará el asesoramiento pertinente para la implantación del protocolo para la prestación de los
					primeros auxilios a la empresa elaborado al efecto por VIMELAB.</li>
					
					<li>VIMELAB estará en disposición de proporcionar la adecuada formación en primeros auxilios al personal
					de la empresa que se considere conveniente de acuerdo con el protocolo mencionado en el párrafo anterior,
					mediante la formación impartida a las instalaciones de VIMELAB, o en la propia empresa, de acuerdo con el
					programa que VIMELAB elabora semestralmente.</li>

				</ol>

				<h4>ANEXO III CENTROS CONTRATADOS Y CONDICIONES ECONÓMICAS.</h4>

				<h5 align="center">RELACIÓN DE CENTROS DE LA EMPRESA EN LOS QUE VIMELAB DESARROLLARÁ LA ACTIVIDAD PREVENTIVA COMO SERVICIO DE PREVENCIÓN</h5>
				<p>
				<table border="1" align="center">
					<tr>
						<td>DENOMINACIÓN</td><td>DIRECCIÓN</td><td>C.P. LOCALIDAD</td><td> No. TRABAJADORES</td>
					</tr>
					<tr>
						<td>'.$entity->getGbempr()->getNombre().'</td><td>'.$sucu->getDireccion().'</td><td>'.$ciud->getCodigo().' '.$ciud->getNombre().'</td><td>'.$entity->getNtrabajadores().'</td>
					</tr>
				</table>
				</p>
				
				<h4>Condiciones económicas particulares del presente contrato.</h4>
				
				<p>Como contraprestación por los servicios prestados al amparo del presente contrato la Empresa abonará a 
				'.$corp->getNombre().', por los conceptos que se relacionan los siguientes importes:
				</p>
				
				<p>
				<table border="1" align="center">
					<tr>
						<td>ACTIVIDAD</td><td>IMPORTE</td><td>IVA</td><td>VENCIMIENTO</td>
					</tr>
					<tr>
						<td>'.$entity->getGbempr()->getNombre().'</td><td>'.$entity->getTotal().' €</td><td> IVA '.$iva.'% no incluido</td><td>'.$fechafin->format('d-m-Y').'</td>
					</tr>
				</table>
				</p>
				
				<p align="justify">El presente contrato devengará los siguientes honorarios:</p>

				<p align="justify">El coste de este servicio de Prevención de Riesgos Laborales asciende TRESCIENTOS SESENTA euros
				('.$entity->getTotal().' €), NO incluido IVA del '.$iva.'%, que se abonará en el momento de la firma del presente contrato.</p>

				<p align="justify">El Examen Médico Específico asciende a 37.00 € (TREINTA Y SIETE euros) de riesgo BAJO. (Se cobrará una vez
				realizado).</p>

				<p align="justify">El importe indicado no contiene en su caso, los costes de las pruebas complementarias que según la evaluación inicial y lo reflejado anteriormente en las actividades SHE, hubieran de realizarse. Los importes reflejados se revisarán anualmente en el mismo porcentaje que experimente el Índice de
				Precios al Consumo (I.P.C.), que facilita el Instituto Nacional de Estadística.</p>

				<p align="justify">La falta de pago o cualquier otro incumplimiento de los acuerdos firmados en el presente contrato, será
				causa de rescisión del mismo.</p>

				<p><b>UNDÉCIMA.</b> Para resolver cualquier diferencia que pudiera surgir de la aplicación del presente concierto,
				las partes, con renuncia del fuero que les pudiera corresponder, se someten a los Juzgados de la ciudad de
				'.$entity->getFirmagbciud().'.</p>
				
				<h4>RESPONSABILIDAD LIMITADA VIMELAB S.L</h4>
				
				<p>Nuestra responsabilidad se extiende al periodo de vigencia especificado y en los términos y alcance del
				trabajo acordados entre la Empresa y '.$corp->getNombre().'</p>

				<p>'.$corp->getNombre().' rechaza cualquier tipo de responsabilidad derivada de sucesos anteriores
				perfeccionamiento del presente contrato o posteriores a la finalización de la vigencia del mismo.</p>

				<p>'.$corp->getNombre().' rechaza cualquier tipo de responsabilidad producida entre la firma del presente documento, la
				constatación de los abonos correspondientes y la realización de los trabajos contratados, dentro del plazo
				establecido, o cuando la realización de éstos se retrase por impago o cualquier otra causa previa generada
				por el empresario contratante.</p>

				<p>'.$corp->getNombre().' declina cualquier tipo de responsabilidad en el caso de que la empresa hubiera aportado datos
				erróneos o falsos para la realización de los correspondientes informes.</p>
				
				<p align="center">ESTE CONTRATO NO TENDRÁ VALIDEZ SIN EL COMPROBANTE DE PAGO</p>
				
				<p>Y para que así conste y surta los efectos donde corresponda, siendo su validez, desde el 27 de Abril de
				2012 hasta el 27 de Abril de 2013.</p>

				<p>Se firma el presente CONCIERTO EN MATERIA DE PREVENCIÓN DE RIESGOS LABORALES, por
				duplicado en la ciudad y fecha en principio indicados.</p>
				
				<p>
				<table align="center" wight=50%>
					<tr>
						<td>Por la Empresa</td><td></td><td>Por '.$corp->getNombre().'</td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td><b>'.$entity->getNombrecontratante().'</b></td><td></td><td><b>'.$entity->getNombrecontratista().'</b></td>
					</tr>
				</table>
				</p>

				<p style="font-size: 0.7em">En conformidad con la Ley Orgánica 15/1999 de diciembre, de protección de datos de carácter personal, le informamos
				que sus datos personales se incorporarán en un fichero automatizado denominado GESTION DE CLIENTES del cual
				el titular es '.$corp->getNombre().' e inscrito en la Agencia de Protección de Datos, con la finalidad de gestionar Clientes y
				Proveedores. Le informamos que sus datos no se cederán a ninguna otra entidad y consiente expresamente que se
				traten por la finalidad indicada. Finalmente, le hacemos saber que puede ejercitar en cualquiera momento los derechos
				de acceso, rectificación, cancelación y oposición en los términos establecidos en la legislación vigente sobre protección
				de datos, dirigiéndose para escrito a la dirección: Calle Pi i Margall 25 escalera B entlo. 1ª; 08024 Barcelona.</p>				
				';
				
				// set font
				$pdf->SetFont('dejavusans', '', 10);
				$pdf -> writeHTMLCell(170, 0, 20, 45, $html, 0, 0, 0, true, 'J', true);
			
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
					
					Tool::logger($this, $id);
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
