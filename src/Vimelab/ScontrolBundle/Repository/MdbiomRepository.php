<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class MdbiomRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Mdbiom o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Mdbiom o JOIN o.mdhist h JOIN h.mdpaci p ORDER BY p.priape ASC");
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
			$sar[] = "k.identificacion LIKE '%$ced%'";
		if($nom != '')
			$sar[] = "k.prinom LIKE '%$nom%' or k.segnom LIKE '%$nom%' ";
		if($ape != '')
			$sar[] = "k.priape LIKE '%$ape%' or k.segape LIKE '%$ape%' ";
			
		$sar = join(' or ', $sar);
		
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Mdbiom m JOIN m.mdhist l JOIN l.mdpaci k WHERE $sar ORDER BY m.id ASC");
        return $querry->getResult();
    }
    
    public function getConsultaAltura($empresa, $finicio, $ffinal)
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
    
}
