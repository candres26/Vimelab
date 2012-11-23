<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class GbpersRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Gbpers o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Gbpers o");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Gbpers m WHERE m.identificacion LIKE '%$parametro%' or m.estado LIKE '%$parametro%'  ORDER BY m.id ASC");
        return $querry->getResult();
    }
	
	public function getForCargo($id)
	{
		$em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT p FROM ScontrolBundle:Gbpers p JOIN p.gbcarg c WHERE c.id = $id and p.estado = 'A' ORDER BY p.priape ASC");
        return $querry->getResult();
	}
	
	public function getForUser($user)
	{
		try
		{
			$em = $this->getEntityManager();
        	$querry = $em->createQuery("SELECT u FROM ScontrolBundle:Gbusua u where u.nombre = '$user'")->setMaxResults(1);
        	$us = $querry->getSingleResult();
			
			$querry = $em->createQuery("SELECT p FROM ScontrolBundle:Gbpers p WHERE p.id = ".$us->getGbPers()->getId()." ORDER BY p.priape ASC")->setMaxResults(1);
			return $querry->getSingleResult();
		}
		catch(\Exception $e)
		{
			return null;
		}
	}
}
