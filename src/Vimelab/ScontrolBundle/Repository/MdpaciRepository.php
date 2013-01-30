<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class MdpaciRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Mdpaci o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Mdpaci o ORDER BY o.priape ASC");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Mdpaci m WHERE m.identificacion LIKE '%$parametro%' ORDER BY m.id ASC");
        return $querry->getResult();
    }
    
    public function getFor($par)
	{
		$em = $this->getEntityManager();
        if(substr($par, 0, 1) != "*")
            $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Mdpaci m WHERE m.identificacion LIKE '%$par%' or m.priape LIKE '%$par%' ORDER BY m.priape ASC");
        else
            $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Mdpaci m WHERE m.id = '".substr($par, 1)."' ORDER BY m.priape ASC");
        return $querry->getResult();
	}

}
