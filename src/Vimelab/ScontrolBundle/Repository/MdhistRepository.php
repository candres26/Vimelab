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
<<<<<<< HEAD
    
    public function getConsultaSexo($empresa,$finicio, $ffinal)
    {
		if ($empresa != '@')
		{
			$em = $this->getEntityManager();
			$querry = $em->createQuery("SELECT COUNT(h) FROM ScontrolBundle:Mdhist h JOIN h.mdpaci p JOIN p.gbsucu s JOIN s.gbempr e WHERE p.sexo = 'F' AND 
			e.id = '$empresa' AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'ORDER BY h.id ASC");
			$querry2 = $em->createQuery("SELECT COUNT(h) FROM ScontrolBundle:Mdhist h JOIN h.mdpaci p JOIN p.gbsucu s JOIN s.gbempr e WHERE p.sexo = 'F' AND 
			e.id = '$empresa' AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'ORDER BY h.id ASC");
			$resul = $querry->getSingleScalarResult();
			$resul2 = $querry2->getSingleScalarResult();
			return array($resul,$resul2);
		}
		else
		{
			$em = $this->getEntityManager();
			$querry = $em->createQuery("SELECT COUNT(h) FROM ScontrolBundle:Mdhist h JOIN h.mdpaci p WHERE p.sexo = 'F' AND 
			h.fecha >= '$finicio' AND h.fecha <= '$ffinal' ORDER BY h.id ASC");
			$querry2 = $em->createQuery("SELECT COUNT(h) FROM ScontrolBundle:Mdhist h JOIN h.mdpaci p WHERE p.sexo = 'M' AND 
			h.fecha >= '$finicio' AND h.fecha <= '$ffinal' ORDER BY h.id ASC");
			$resul = $querry->getSingleScalarResult();
			$resul2 = $querry2->getSingleScalarResult();
			return array($resul,$resul2);
        }
	}
=======

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
>>>>>>> 5ed93f94f3629a90a8caaa26ef0ed25b50f48d92
}
