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
            $cont = strtolower(str_replace('Controller', '', $arr2[0]));
            $acti = strtolower(str_replace('Action', '', $arr2[1]));

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
	
	public static function toJail($arr, $gl='{', $gr='}', $ms=TRUE)
	{
		$res = '';
		
		foreach ($arr as $cs) 
		{
			if(is_array($cs))
				$res .= $gl.Tool::toJail($cs, $gl, $gr, FALSE).$gr;
			else 
				$res .= $gl.$cs.$gr;
		}
		
		if($ms)
			$res = $gl.$res.$gr;
		
		return $res;
	}
	
	public static function ofJail($arr, $gl='{', $gr='}', $ms = TRUE)
	{
		$res = array();
		$isData = FALSE;
		
		$j = strlen($arr);
		$i = 0;
		while($i < $j)
		{
			if($arr[$i] == $gl)
			{
				$ix = Tool::getPiece($arr, $gl, $gr, $i);
				$tmp = substr($arr, $i+1, $ix-($i+1)); 
                $res[] = Tool::ofJail($tmp, $gl, $gr, FALSE);
				$i = $ix;
			}
			if($arr[$i] == $gr)
			{
				$i += 1;
			}
			else
			{
				$res[] = $arr;
				$isData = TRUE;
				$i = $j;
			}			 
		}
		
		if($ms || $isData)
			$res = $res[0];
		
		return $res;
	}

	public static function getPiece($arr, $gl, $gr, $or)
	{	
		$ct = 0;
		$ix = -1;
		
		$j = strlen($arr);
		for($i = $or; $i < $j; $i++)
		{
			if($arr[$i] == $gl)
			{
				$ct += 1;
			}
			else if($arr[$i] == $gr)
			{
				$ct -= 1;
			}
			
			if($ct == 0)
			{
				$ix = $i;
				break;
			}			 
		}
		
		return $ix;	
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
