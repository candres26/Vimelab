<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class GbvarsRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Gbvars o");
        $resul = $querry->getSingleScalarResult();
        return $resul;
    }
}
