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
    
    public function getConsultaAlturaHombres($empresa, $finicio, $ffinal)
    {
		if ($empresa != '@')
		{
			$em = $this->getEntityManager();
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla < 140 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla >= 141 AND b.talla <= 150 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul2 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla >= 151 AND b.talla <= 160 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul3 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla >= 161 AND b.talla <= 170 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul4 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla >= 171 AND b.talla <= 180 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul5 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla >= 181 AND b.talla <= 190 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul6 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla > 190 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul7 = count($querry->getResult());
			
			return array($resul, $resul2, $resul3, $resul4, $resul5, $resul6, $resul7);
		}
		else
		{
			$em = $this->getEntityManager();
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla < 140 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla >= 141 AND b.talla <= 150 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul2 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla >= 151 AND b.talla <= 160 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul3 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla >= 161 AND b.talla <= 170 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul4 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla >= 171 AND b.talla <= 180 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul5 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla >= 181 AND b.talla <= 190 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul6 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'M' AND b.talla > 190 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul7 = count($querry->getResult());
			
			return array($resul, $resul2, $resul3, $resul4, $resul5, $resul6, $resul7);
		}	
	}
    
    public function getConsultaAlturaMujeres($empresa, $finicio, $ffinal)
    {
		if ($empresa != '@')
		{
			$em = $this->getEntityManager();
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla < 140 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla >= 141 AND b.talla <= 150 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul2 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla >= 151 AND b.talla <= 160 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul3 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla >= 161 AND b.talla <= 170 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul4 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla >= 171 AND b.talla <= 180 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul5 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla >= 181 AND b.talla <= 190 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul6 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla > 190 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal' 
				AND e.id = '$empresa'");
			$resul7 = count($querry->getResult());
			
			return array($resul, $resul2, $resul3, $resul4, $resul5, $resul6, $resul7);
		}
		else
		{
			$em = $this->getEntityManager();
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla < 140 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla >= 141 AND b.talla <= 150 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul2 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla >= 151 AND b.talla <= 160 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul3 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla >= 161 AND b.talla <= 170 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul4 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla >= 171 AND b.talla <= 180 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul5 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla >= 181 AND b.talla <= 190 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul6 = count($querry->getResult());
			
			$querry = $em->createQuery("SELECT b FROM ScontrolBundle:Mdbiom b JOIN b.mdhist h, ScontrolBundle:Mdpaci p JOIN p.gbsucu s JOIN s.gbempr e 
				WHERE p.id = h.mdpaci AND b.mdhist = h.id AND p.sexo = 'F' AND b.talla > 190 AND h.fecha >= '$finicio' AND h.fecha <= '$ffinal'");
			$resul7 = count($querry->getResult());
			
			return array($resul, $resul2, $resul3, $resul4, $resul5, $resul6, $resul7);
		}	
	}

}
