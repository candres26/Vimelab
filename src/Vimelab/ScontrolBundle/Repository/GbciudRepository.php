<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class GbciudRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Gbciud o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Gbciud o");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Gbciud m JOIN m.gbdepa l WHERE m.nombre LIKE '%$parametro%' or m.codigo LIKE '%$parametro%' or l.nombre LIKE '%$parametro%' ORDER BY m.id ASC");
        return $querry->getResult();
    }
    
    public function getForDepa($id)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT c FROM ScontrolBundle:Gbciud c JOIN c.gbdepa d WHERE d.id = $id ORDER BY c.nombre ASC");
        return $querry->getResult();
    }
}
