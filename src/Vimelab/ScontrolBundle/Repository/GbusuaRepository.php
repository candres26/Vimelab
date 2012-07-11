<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class GbusuaRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Gbusua o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Gbusua o");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Gbusua m JOIN m.gbpers l WHERE m.nombre LIKE '%$parametro%' or l.identificacion LIKE '%$parametro%' ORDER BY m.id ASC");
        return $querry->getResult();
    }
	
	public function getForPersonal($id)
	{
		$em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT u FROM ScontrolBundle:Gbusua u JOIN u.gbpers p WHERE p.id = $id ORDER BY u.nombre ASC");
        return $querry->getResult();
	}
}
