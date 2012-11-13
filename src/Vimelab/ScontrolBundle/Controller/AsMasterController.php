<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

class AsMasterController extends Controller
{
	public function indexAction()
	{
		if(Tool::isGrant($this))	
			return $this->render('ScontrolBundle:AsMaster:index.html.twig');
		else
			return $this->render('ScontrolBundle::alertas.html.twig');
	}
	
}
