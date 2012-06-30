<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class MdprocRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Mdproc o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Mdproc o");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Mdproc m JOIN m.mdprot l JOIN m.gbptra k WHERE l.nombre LIKE '%$parametro%' OR k.nombre LIKE '%$parametro%' ORDER BY m.id ASC");
        return $querry->getResult();
    }
	
	public function getForTrab($id)
	{
		$em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT p FROM ScontrolBundle:Mdproc p JOIN p.gbptra g WHERE g.id = $id ORDER BY g.nombre ASC");
        return $querry->getResult();
	}
}
