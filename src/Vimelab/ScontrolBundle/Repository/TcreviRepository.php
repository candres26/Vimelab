<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class TcreviRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Tcrevi o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Tcrevi o ORDER BY o.fecha DESC");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Tcrevi m JOIN m.gbsucu s JOIN s.gbempr e WHERE m.id LIKE '%$parametro%' OR m.fecha LIKE '%$parametro%' OR e.nombre LIKE '%$parametro%' ORDER BY m.id ASC");
        return $querry->getResult();
    }

    public function getFor($parametro)
    {
        $em = $this->getEntityManager();
        
        if(substr($parametro, 0, 1) == "*")
            $querry = $em->createQuery("SELECT r FROM ScontrolBundle:Tcrevi r JOIN r.gbsucu s JOIN s.gbempr e WHERE r.id = '".substr($parametro, 1)."'");
        else
            $querry = $em->createQuery("SELECT r FROM ScontrolBundle:Tcrevi r JOIN r.gbsucu s JOIN s.gbempr e WHERE r.id LIKE '%$parametro%' OR r.fecha LIKE '%$parametro%' OR e.nombre LIKE '%$parametro%' ORDER BY e.nombre, r.fecha ASC");
        
        return $querry->getResult();
    }
}
