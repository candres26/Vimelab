<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class CtcotiRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Ctcoti o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Ctcoti o ORDER BY o.fecha DESC");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Ctcoti m JOIN m.gbempr l WHERE m.fecha LIKE '%$parametro%' or l.nombre LIKE '%$parametro%'  or m.modalidad LIKE '%$parametro%' ORDER BY m.id ASC");
        return $querry->getResult();
    }
    
	public function getSucursal($empresa, $nombre)
    {
        $em = $this->getEntityManager();

		try
        {	
			$querry = $em->createQuery("SELECT s FROM ScontrolBundle:Gbsucu s JOIN s.gbempr e WHERE e.id = '$empresa' and s.nombre LIKE '%$nombre%' ORDER BY s.nombre ASC");
            $sucu = $querry->getSingleResult();
            return $sucu;
		}
		catch(\Exception $e)
		{
            try
            {
                $querry = $em->createQuery("SELECT s FROM ScontrolBundle:Gbsucu s JOIN s.gbempr e WHERE e.id = '$empresa' ORDER BY s.nombre ASC");
                $sucu = $querry->getSingleResult();
                return $sucu;
            }
            catch(\Exception $e)
            {
                return null;   
            }
		}
	}
}
