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

    public function getAlertas()
    {
        $lim = new \DateTime();
        $lim->add(new \DateInterval('P30D'));

        $sub = new \DateTime();
        $sub->sub(new \DateInterval('P30D'));
        
        $em = $this->getEntityManager();
        //$querry = $em->createQuery("SELECT h FROM ScontrolBundle:Mdhist h JOIN h.mdpaci p WHERE h.fecha < '".$lim->format('Y-m-d')."' AND h.fecha > '".$sub->format('Y-m-d')."' ORDER BY p.priape ASC");
        $querry = $em->createQuery("SELECT h FROM ScontrolBundle:Mdhist h JOIN h.mdpaci p WHERE DATE_ADD(h.fecha, 12, 'MONTH') < '".$lim->format('Y-m-d')."' AND DATE_ADD(h.fecha, 12, 'MONTH') > '".$sub->format('Y-m-d')."' ORDER BY p.priape ASC");
        return $querry->getResult();
    }
}
