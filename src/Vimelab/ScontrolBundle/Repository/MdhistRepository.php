<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class MdhistRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Mdhist o");
        $resul = $querry->getSingleScalarResult();
        return $resul;
    }

    public function getCountPages($limite = 20)
    {
        $cantidad = $this->getCount();
        $numeropag = intval($cantidad / $limite);
        $numeropag = ($cantidad % $limite) > 0 ? $numeropag + 1 : $numeropag;
        return $numeropag;
    }

    public function getPage($limite = 20, $pagina = 1)
    {
        $pagina = $pagina < 1 ? 1 : $pagina;

        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Mdhist o ORDER BY o.fecha DESC");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
		$ape = '';
		$nom = '';
		$ced = '';
		
		$parametro = preg_replace('/: +/', ':', $parametro);
		
		$tmp = explode(' ', $parametro);
		foreach($tmp as $caso)
		{
			$tar = explode(':', $caso);
			if(count($tar) == 2)
			{
				if(trim(strtoupper($tar[0])) == 'A')
					$ape = trim($tar[1]);
				
				if(trim(strtoupper($tar[0])) == 'N')
					$nom = trim($tar[1]);
			}
			else
				$ced = $caso;
		}	
		
		$sar = array();
		if($ced != '')
			$sar[] = "l.identificacion LIKE '%$ced%'";
		if($nom != '')
			$sar[] = "l.prinom LIKE '%$nom%' or l.segnom LIKE '%$nom%' ";
		if($ape != '')
			$sar[] = "l.priape LIKE '%$ape%' or l.segape LIKE '%$ape%' ";
			
		$sar = join(' or ', $sar);
		
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Mdhist m JOIN m.mdpaci l WHERE $sar ORDER BY m.id ASC");
        return $querry->getResult();
    }
    
    public function getConsultaSexo($empresa, $finicio, $ffinal)
    {
		if ($empresa != '@')
		{
			$em = $this->getEntityManager();
			
			$querry = $em->createQuery("SELECT p FROM ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e, ScontrolBundle:Mdhist h WHERE p.id = h.mdpaci 
				AND p.sexo = 'F' AND h.fecha >= '$finicio' AND h.fecha < '$ffinal' AND e.id = '$empresa' ORDER BY h.id ASC");
			$resul = count($querry->getResult());

			$querry = $em->createQuery("SELECT p FROM ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e, ScontrolBundle:Mdhist h WHERE p.id = h.mdpaci 
				AND p.sexo = 'M' AND h.fecha >= '$finicio' AND h.fecha < '$ffinal' AND e.id = '$empresa' ORDER BY h.id ASC");
			$resul2 = count($querry->getResult());
			
			return array($resul, $resul2);
		}
		else
		{
			$em = $this->getEntityManager();
			
			$querry = $em->createQuery("SELECT p FROM ScontrolBundle:Mdpaci p, ScontrolBundle:Mdhist h WHERE p.id = h.mdpaci AND p.sexo = 'F' 
				AND h.fecha >= '$finicio' AND h.fecha < '$ffinal' ORDER BY h.id ASC");
			$resul = count($querry->getResult());

			$querry = $em->createQuery("SELECT p FROM ScontrolBundle:Mdpaci p, ScontrolBundle:Mdhist h WHERE p.id = h.mdpaci AND p.sexo = 'M' 
				AND h.fecha >= '$finicio' AND h.fecha < '$ffinal' ORDER BY h.id ASC");
			$resul2 = count($querry->getResult());
			
			return array($resul, $resul2);
        }
	}
	
	public function getConsultaEdad($empresa, $finicio, $ffinal)
	{
		$em = $this->getEntityManager();
		
		if ($empresa != '@')
			$querry = $em->createQuery("SELECT p FROM ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e, ScontrolBundle:Mdhist h WHERE p.id = h.mdpaci 
				AND h.fecha >= '$finicio' AND h.fecha < '$ffinal' AND e.id = '$empresa' ORDER BY h.id ASC");
		else
			$querry = $em->createQuery("SELECT p FROM ScontrolBundle:Mdpaci p, ScontrolBundle:Mdhist h WHERE p.id = h.mdpaci 
				AND h.fecha >= '$finicio' AND h.fecha < '$ffinal' ORDER BY h.id ASC");
		
		$resul = $querry->getResult();
		
		$edades = array('0-16'=> 0,'17-20'=> 0,'21-35'=> 0,'36-45'=> 0,'46-55'=> 0,'56-65'=> 0,'66-200'=> 0);
		
		foreach ($resul as $caso)
		{
			$edad  = $caso->getEdad();
			
			foreach($edades as $key => $val)
			{
				$lim = explode('-', $key);
				$inf = intval($lim[0]);
				$sup = intval($lim[1]);
				
				if ($edad >= $inf && $edad <= $sup)
				{
					$edades[$key] += 1;
					
					break;
				}
			}
		}
		
		ksort($edades);
		
		return $edades;
	}
	
	public function getConsultaImcHombres($empresa, $finicio, $ffinal)
	{
		$em = $this->getEntityManager();
		
		if ($empresa != '@')
		
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e
				WHERE h.id = b.mdhist AND p.id = h.mdpaci AND p.sexo = 'M' AND h.fecha >= '$finicio' AND h.fecha < '$ffinal' AND e.id = '$empresa'");
		else
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b, ScontrolBundle:Mdhist h, ScontrolBundle:Mdpaci p WHERE p.id = h.mdpaci 
			AND b.mdhist = h.id AND p.sexo = 'M' AND h.fecha >= '$finicio' AND h.fecha < '$ffinal'");
		
		$resul = $querry->getResult();
		
		$marcas = array('1' => 'Delgadez', '2' => 'Peso Normal', '3' => 'Sobrepeso', '4' => 'Obesidad');
		$pesos = array($marcas['1'] => 0, $marcas['2'] => 0, $marcas['3'] => 0, $marcas['4'] => 0);
		
		foreach($resul as $caso)
			$pesos[$marcas[''.$caso->getImc()]] += 1;
		
		return $pesos;
	}
	
	public function getConsultaImcMujeres($empresa, $finicio, $ffinal)
	{
		$em = $this->getEntityManager();
		
		if ($empresa != '@')
		
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e
			WHERE h.id = b.mdhist AND p.id = h.mdpaci AND p.sexo = 'F' AND h.fecha >= '$finicio' AND h.fecha < '$ffinal' AND e.id = '$empresa'");
		else
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b, ScontrolBundle:Mdhist h, ScontrolBundle:Mdpaci p WHERE p.id = h.mdpaci 
			AND b.mdhist = h.id AND p.sexo = 'F' AND h.fecha >= '$finicio' AND h.fecha < '$ffinal'");
		
		$resul = $querry->getResult();
		
		$marcas = array('1' => 'Delgadez', '2' => 'Peso Normal', '3' => 'Sobrepeso', '4' => 'Obesidad');
		$pesos = array($marcas['1'] => 0, $marcas['2'] => 0, $marcas['3'] => 0, $marcas['4'] => 0);
		
		foreach($resul as $caso)
			$pesos[$marcas[''.$caso->getImc()]] += 1;
		
		return $pesos;
	}
	
	public function getConsultaFumadores($empresa, $finicio, $ffinal)
	{
		$em = $this->getEntityManager();
		
		if ($empresa != '@')
		
			$querry = $em->createQuery("SELECT a FROM ScontrolBundle:Hspers a JOIN a.mdpaci p JOIN p.gbsucu s JOIN s.gbempr e, ScontrolBundle:Mdhist h  
			WHERE p.id = h.mdpaci AND h.fecha >= '$finicio' AND h.fecha < '$ffinal' AND e.id = '$empresa'");
		else
			$querry = $em->createQuery("SELECT a FROM ScontrolBundle:Hspers a JOIN a.mdpaci p, ScontrolBundle:Mdhist h  
			WHERE p.id = h.mdpaci AND h.fecha >= '$finicio' AND h.fecha < '$ffinal'");
		
		$resul = $querry->getResult();
		
		$marcas = array('0' => 'No fumador', '1' => 'Ex fumador', '2' => 'Fumador esporádico', '3' => 'de 0 a 5 cigarrillos', '4' => 'de 6 a 10 cigarrillos', '5' => 'de 11 a 20 cigarrillos', '6' => 'de 21 a 40 cigarrillos', '7' => 'Más de 40 cigarrillos', '8' => 'Otros(Pipa, Otros ...)');
		$fumador = array($marcas['0'] => 0, $marcas['1'] => 0, $marcas['2'] => 0, $marcas['3'] => 0, $marcas['4'] => 0, $marcas['5'] => 0, $marcas['6'] => 0, $marcas['7'] => 0, $marcas['8'] => 0);
		
		foreach($resul as $caso)
			$fumador[$marcas[''.$caso->getDetfumador()]] += 1;
		
		return $fumador;
	}
	
	public function getConsultaPresion($empresa, $finicio, $ffinal)
	{
		$em = $this->getEntityManager();
		
		if ($empresa != '@')

			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
			WHERE h.id = b.mdhist AND p.id = h.mdpaci AND h.fecha >= '$finicio' AND h.fecha < '$ffinal' AND e.id = '$empresa' ORDER by b.id");
		else
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p WHERE h.id = b.mdhist 
			AND p.id = h.mdpaci ORDER by b.id");
		
		$resul = $querry->getResult();
		
		$marcas = array('1' => 'Óptima', '2' => 'Normal', '3' => 'Normal alta', '4' => 'Hipertensión grado 1', '5' => 'Hipertensión grado 2', '6' => 'Hipertensión grado 3', '7' => 'Hipertensión no identificada');
		$presiones = array($marcas['1'] => 0, $marcas['2'] => 0, $marcas['3'] => 0, $marcas['4'] => 0, $marcas['5'] => 0, $marcas['6'] => 0, $marcas['7'] => 0);
		
		foreach($resul as $caso)
			$presiones[$marcas[''.$caso->getPresion()]] += 1;
		
		return $presiones; 
	}
	
	
    public function getAlertas()
    {
        $lim = new \DateTime();
        $lim->add(new \DateInterval('P30D'));

        $sub = new \DateTime();
        $sub->sub(new \DateInterval('P30D'));
        
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT h FROM ScontrolBundle:Mdhist h JOIN h.mdpaci p WHERE h.fecha < '".$lim->format('Y-m-d')."' AND h.fecha > '".$sub->format('Y-m-d')."' ORDER BY p.priape ASC");
        return $querry->getResult();
    }
}
