<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class GbdepaRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Gbdepa o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Gbdepa o ORDER BY o.nombre ASC");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Gbdepa m JOIN m.gbpais l WHERE m.nombre LIKE '%$parametro%' or m.codigo LIKE '%$parametro%' or l.nombre LIKE '%$parametro%' ORDER BY m.id ASC");
        return $querry->getResult();
    }
	
	public function getForPais($id)
	{
		$em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT d FROM ScontrolBundle:Gbdepa d JOIN d.gbpais p WHERE p.id = $id ORDER BY d.nombre ASC");
        return $querry->getResult();
	}
}
