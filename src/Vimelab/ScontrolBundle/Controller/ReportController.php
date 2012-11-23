<?php

namespace Vimelab\ScontrolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
	public function indexAction()
	{
		return $this->render('ScontrolBundle:Report:report.html.twig');
	}
}
