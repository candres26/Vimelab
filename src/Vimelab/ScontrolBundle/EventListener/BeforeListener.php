<?php

namespace Vimelab\ScontrolBundle\EventListener;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController;
use Vimelab\ScontrolBundle\Controller\GuardController;
use Symfony\Component\HttpFoundation\Request;

class BeforeListener
{

    public function __construct()
    {
        
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        
        if (!is_array($controller)) 
        {
            return;
        }

        if (!$controller[0] instanceof GuardController && !$controller[0] instanceof ProfilerController) 
        {
            $r = $event->getRequest();
            $s = $r->getSession();
            
            $ct = intval(microtime(true));
            
            if(!$s->has("idleTO"))
                $idl = $ct;
            else
                $idl = intval($s->get("idleTO"));
                
            $s->set("idleTO", $ct);
            
            $dif = $ct - $idl;
            
            if($dif >= intval(600))
            {
                $redirectUrl = $controller[0]->generateUrl('logout');
            
                $event->setController
                (
                    function() use ($redirectUrl) 
                    {
                        return new RedirectResponse($redirectUrl);
                    }
                );
            }
        }
    }
}
