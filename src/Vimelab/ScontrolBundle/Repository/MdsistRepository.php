<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class MdsistRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Mdsist o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Mdsist o JOIN o.mdhist h JOIN h.mdpaci p ORDER BY p.priape ASC");
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
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Mdsist m JOIN m.mdhist l JOIN l.mdpaci k WHERE $sar ORDER BY m.id ASC");
        return $querry->getResult();
    }
}
