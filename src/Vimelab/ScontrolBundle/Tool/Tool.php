<?php

namespace Vimelab\ScontrolBundle\Tool;

use Vimelab\ScontrolBundle\Entity\Gblogr;

class Tool
{
	public $mdic = array();
	
	public static function isGrant($controller)
	{
		
		$request = $controller->getRequest();
		$em = $controller->getDoctrine()->getEntityManager();
		$secu = $controller->get('security.context');
		
		$ussys = $secu->getToken()->getUser();

        if($ussys != 'root')
        {
            $arr1 = explode('\\', $request->attributes->get('_controller'));
            $arr2 = explode('::', $arr1[count($arr1)-1]);
            $cont = str_replace('Controller', '', $arr2[0]);
            $acti = str_replace('Action', '', $arr2[1]);

            $casos = $em->getRepository('ScontrolBundle:Gbacls')->findBy(array('modulo' => $cont, 'accion' => $acti));
            $user = $em->getRepository('ScontrolBundle:Gbusua')->findOneBy(array('nombre' => $ussys));

            $flag = false;

            foreach($casos as $caso)
            {
                if($caso->getGbUsua()->getId() == $user->getId())
                {
                    $flag = true;
                    break;
                }
            }

            return $flag;
        }
        else
            return true;
	}
	
	public static function logger($controller, $id)
	{
		$request = $controller->getRequest();
		$em = $controller->getDoctrine()->getEntityManager();
		$secu = $controller->get('security.context');
		
		$ussys = $secu->getToken()->getUser();
		$user = $em->getRepository('ScontrolBundle:Gbusua')->findOneBy(array('nombre' => $ussys));
		
		$arr1 = explode('\\', $request->attributes->get('_controller'));
		$arr2 = explode('::', $arr1[count($arr1)-1]);
		$cont = str_replace('Controller', '', $arr2[0]);
		$acti = str_replace('Action', '', $arr2[1]);
		
        $log = new Gblogr();
        $log->setFecha(new \DateTime("now"));
        $log->setModulo($cont);
        $log->setAccion($acti." ID: ".$id);
        $log->setGbusua($user);
        
        $em->persist($log);
		$em->flush();
	}
	
	public function initDic($controller, $dict='msdic')
	{
		$request = $controller->getRequest();
		$em = $controller->getDoctrine()->getEntityManager();
		
		$var = $em->getRepository('ScontrolBundle:Gbvars')->findOneByNombre($dict);
		
		$dic = explode('|-|', $var->getValor());
		$this->mdic = array();
		
		foreach($dic as $caso)
		{
			$tmp = explode('=>', $caso);
			$this->mdic[$tmp[0]] = $tmp[1];
		}
	}
	
	public function traduce($word)
	{
		if(isset($this->mdic[$word]))
			return $this->mdic[$word];
		else
			return $word;
	}
}
