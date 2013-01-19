<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class TccursRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Tccurs o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Tccurs o JOIN o.mdpaci p ORDER BY p.priape ASC");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Tccurs m JOIN m.tccapa l JOIN m.mdpaci p WHERE m.empresa LIKE '%$parametro%' OR l.nombre LIKE '%$parametro%' OR p.identificacion LIKE '%$parametro%' ORDER BY m.id ASC");
        return $querry->getResult();
    }

    public function listReport($empr, $paci)
    {
        $em = $this->getEntityManager();

        if($empr == "@" && $paci == "@")
            $querry = $em->createQuery("SELECT c FROM ScontrolBundle:Tccurs c JOIN c.mdpaci p WHERE 1=1 ORDER BY p.priape ASC");
        else if($empr != "@" && $paci == "@")
            $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Tccurs m JOIN m.mdpaci p JOIN p.gbsucu s JOIN s.gbempr e WHERE e.id='$empr' ORDER BY p.priape ASC");
        else if($empr == "@" && $paci != "@")
            $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Tccurs m JOIN m.mdpaci p WHERE p.identificacion LIKE '%$paci%' ORDER BY p.priape ASC");
        else
            $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Tccurs m JOIN m.mdpaci p JOIN p.gbsucu s JOIN s.gbempr e WHERE p.identificacion LIKE '%$paci%' AND e.id='$empr' ORDER BY p.priape ASC");

        return $querry->getResult();
    }
}
