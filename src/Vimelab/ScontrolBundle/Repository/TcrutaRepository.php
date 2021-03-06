<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class TcrutaRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Tcruta o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Tcruta o ORDER BY o.fplaneada DESC");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Tcruta m JOIN m.ctcont l JOIN l.gbempr e WHERE l.id LIKE '%$parametro%' OR m.estado LIKE '%$parametro%' OR e.nombre LIKE '%$parametro%' OR m.fplaneada LIKE '%$parametro%' ORDER BY m.id ASC");
        return $querry->getResult();
    }
	
	public function getForEmpresa($par)
	{
		$em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT r FROM ScontrolBundle:Tcruta r JOIN r.ctcont c JOIN c.gbempr e WHERE e.id = '$par' ORDER BY r.id ASC");
        return $querry->getResult();
	}
}
