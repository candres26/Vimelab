<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
	public function indexAction()
	{
		return $this->render('ScontrolBundle:Home:home.html.twig');
	}
}

