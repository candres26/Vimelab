<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vimelab\ScontrolBundle\Entity\Gbvars;
use Symfony\Component\HttpFoundation\Response;
use Vimelab\ScontrolBundle\Tool\Tool;

class AsSecuController extends Controller
{
	public function indexAction()
	{
		if(Tool::isGrant($this))
        {		
			return $this->render('ScontrolBundle:AsSecu:index.html.twig');
		}
		else
			return $this->render('ScontrolBundle::alertas.html.twig');
	}
}