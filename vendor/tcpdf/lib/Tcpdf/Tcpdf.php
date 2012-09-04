<?php
# vendor/tcpdf/lib/Tcpdf/Tcpdf.php

require_once __DIR__.'/src/tcpdf.php';

class Tcpdf_Tcpdf extends TCPDF 
{
    /* --- */
    
    public function getDir()
	{
		return __DIR__.'/src';
	}
} 
