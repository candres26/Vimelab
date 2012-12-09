<?php

namespace Vimelab\ScontrolBundle\Repository;
use Doctrine\ORM\EntityRepository;

class MdquesRepository extends EntityRepository
{
    public function getCount()
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT COUNT(o) FROM ScontrolBundle:Mdques o");
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
        $querry = $em->createQuery("SELECT o FROM ScontrolBundle:Mdques o JOIN o.mdprot p ORDER BY p.nombre ASC");
        $querry->setFirstResult(($pagina-1)*$limite);
        $querry->setMaxResults($limite);
        return $querry->getResult();
    }

    public function getFilter($parametro)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT m FROM ScontrolBundle:Mdques m JOIN m.mdprot l WHERE m.pregunta LIKE '%$parametro%' or l.nombre LIKE '%$parametro%' ORDER BY m.id ASC");
        return $querry->getResult();
    }
	
	public function getForProtocolo($id)
	{
		$em = $this->getEntityManager();
        $querry = $em->createQuery("SELECT q FROM ScontrolBundle:Mdques q JOIN q.mdprot p WHERE p.id = $id ORDER BY q.pregunta ASC");
        return $querry->getResult();
	}
}
